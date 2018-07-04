<?php

namespace App;

use Folklore\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sentinel;

class User extends \Cartalyst\Sentinel\Users\EloquentUser
{
	const PUBLIC_STORAGE_DIR = '/user_photos/';

	const THUMB_MY_ACCOUNT = 'thumb_my_account';

	public static $rules = array(
		'first_name'  => 'required',
		'last_name'  => 'required',
		'email'  => 'required|email|unique:users',
		'password'  => 'required|confirmed',
		'password_confirmation'  => 'required',
		'photo'  => 'image'
	);

	protected $image_crops = array(self::THUMB_MY_ACCOUNT => array(150, 150, array('crop')));

	protected $appends = ['image_thumbnails'];

	protected $hidden = ['password'];

	protected $_uploaded_file;

	public function __construct(array $attributes = [], UploadedFile $uploaded_file = null)
	{
		parent::__construct($attributes);

		$this->_uploaded_file = $uploaded_file;
	}

	public function getAgency()
	{
		if ($this->agency_id > 0) {
			return Agency::find($this->agency_id);
		}

		return null;
	}

	public function save(array $options = [])
	{
		if ($this->_uploaded_file === false && $this->photo) {
			unlink(\App\Helpers\AppHelper::instance()->publicPath() . $this->photo);

			$this->photo = null;
		} else if ($this->_uploaded_file) {
			$save_public_path = self::getSaveDirectory();

			$this->_uploaded_file->move(\App\Helpers\AppHelper::instance()->publicPath() . $save_public_path, $this->_uploaded_file->getClientOriginalName());

			$this->photo = $save_public_path . $this->_uploaded_file->getClientOriginalName();

			if (@is_array(getimagesize(\App\Helpers\AppHelper::instance()->publicPath() . $this->photo))) {
				foreach ($this->image_crops as $image_crop) {
					if (!empty($image_crop[0]) && !empty($image_crop[1]) && isset($image_crop[2]) && is_array($image_crop[2])) {
						$crop_details = array();
						$crop_details['width'] = $image_crop[0];
						$crop_details['height'] = $image_crop[1];

						if ($image_crop[2]) {
							foreach ($image_crop[2] as $crop_spec) {
								if ($crop_spec) {
									$crop_details[$crop_spec] = true;
								}
							}
						}

						Image::make(\App\Helpers\AppHelper::instance()->publicPath() . $save_public_path . $this->_uploaded_file->getClientOriginalName(), $crop_details)
							->save(str_replace('//', '/', \App\Helpers\AppHelper::instance()->publicPath() . Image::url($save_public_path . $this->_uploaded_file->getClientOriginalName(), $image_crop[0], $image_crop[1], $image_crop[2])));
					}
				}
			}
		}

		return parent::save($options);
	}

	public function getImageThumbnailsAttribute()
	{
		$crop_urls = array();

		foreach ($this->image_crops as $crop_name => $image_crop) {
			if (!empty($image_crop[0]) && !empty($image_crop[1]) && isset($image_crop[2]) && is_array($image_crop[2])) {
				if (@is_array(getimagesize(\App\Helpers\AppHelper::instance()->publicPath() . $this->asset_image))) {
					if (!file_exists(str_replace('//', '/', \App\Helpers\AppHelper::instance()->publicPath() . Image::url($this->asset_image, $image_crop[0], $image_crop[1], $image_crop[2])))) {
						$crop_details = array();
						$crop_details['width'] = $image_crop[0];
						$crop_details['height'] = $image_crop[1];

						if ($image_crop[2]) {
							foreach ($image_crop[2] as $crop_spec) {
								if ($crop_spec) {
									$crop_details[$crop_spec] = true;
								}
							}
						}

						Image::make(\App\Helpers\AppHelper::instance()->publicPath() . $this->asset_image, $crop_details)
							->save(str_replace('//', '/', \App\Helpers\AppHelper::instance()->publicPath() . Image::url($this->asset_image, $image_crop[0], $image_crop[1], $image_crop[2])));
					}

					$crop_urls[$crop_name] = Image::url($this->asset_image, $image_crop[0], $image_crop[1], $image_crop[2]);
				}
			}
		}

		return $this->attributes['image_thumbnails'] = $crop_urls;
	}

	public function changePhoto(UploadedFile $uploaded_file)
	{
		$this->_uploaded_file = $uploaded_file;
	}

	public function deletePhoto()
	{
		$this->_uploaded_file = false;
	}

	public function setPasswordAttribute($value)
	{
		$hasher = Sentinel::getHasher();

		$this->attributes['password'] = $hasher->hash($value);
	}

	static public function getSaveDirectory()
	{
		return self::PUBLIC_STORAGE_DIR . self::getTimeBasedDirectories();
	}

	static public function getTimeBasedDirectories()
	{
		return date("Y/m/d/H/i/s/");
	}
}
