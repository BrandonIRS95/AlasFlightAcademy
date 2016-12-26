<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Admission extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $payment_id;
    public $payer_id;
    public $date;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $payment_id, $payer_id, $date)
    {
        $this->email = $email;
        $this->payment_id = $payment_id;
        $this->payer_id = $payer_id;
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('alasflyacademy@gmail.com')->view('email.admissionPayment');
    }
}
