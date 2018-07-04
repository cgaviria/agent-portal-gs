<?php

namespace App\Helpers;

class AppHelper
{
	public function publicPath()
	{
		return dirname(public_path()) . '/httpdocs';
	}

	public static function instance()
	{
		return new AppHelper();
	}
}