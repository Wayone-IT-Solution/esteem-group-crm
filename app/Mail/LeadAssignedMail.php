<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeadAssignedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $assigneeName;

    public function __construct($assigneeName)
    {
        $this->assigneeName = $assigneeName;
    }

    public function build()
    {
        return $this->subject('New Lead Assigned')
            ->view('emails.lead_assigned');
    }
}
