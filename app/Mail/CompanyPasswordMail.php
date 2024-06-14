<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class CompanyPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }


    public function build()
    {

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject($this->details['subject'])
            ->markdown('emails.setPassword')
            ->with('details', $this->details);

    }
}
