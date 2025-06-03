<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompleteProfileMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;  // Pass user object instead of only link
    }

    public function build()
{
    return $this->subject('Complete Your Profile')
                ->view('emails.complete_profile')
                ->with([
                    'user' => $this->user,
                    'link' => route('verify-user', ['id' => $this->user->id]) 
                ]);
}

}