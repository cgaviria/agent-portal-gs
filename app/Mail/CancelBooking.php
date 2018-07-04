<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CancelBooking extends Mailable
{
	use Queueable, SerializesModels;

	/**
	 * The booking object instance.
	 *
	 * @var Demo
	 */
	public $booking;

	/**
	 * The user object instance.
	 *
	 * @var Demo
	 */
	public $user;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($booking, $user)
	{
		$this->booking = $booking;
		$this->user = $user;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->from('no_reply@shoreexcursionsgroup.com')
			->view('mails.cancel_booking')
			->text('mails.cancel_booking_plain')
			->with(
				[
					'booking' => $this->booking,
					'user' => $this->user,
				]);
	}
}