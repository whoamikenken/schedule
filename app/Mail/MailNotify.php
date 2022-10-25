<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Attachment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    private $data = [];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('whoamikenken@gmail.com', 'Kingsmanpower')->subject($this->data['subject'])->view("email.status_email")->with('data', $this->data)->attach(Attachment::fromPath("https://media-v2.technic.com.hk/applicants/KMM1096AA/video%20-%201663904724547.mp4")
            ->as('TEst.mp4'));
    }
}
