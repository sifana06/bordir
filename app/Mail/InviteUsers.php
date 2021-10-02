<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteUsers extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $pwd)
    {
        $this->data['user'] = $user;
        $this->data['pwd'] = $pwd;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown( 'emails.sendInvitationUsers' )
            ->subject( '[' . config('app.name') . '] Undangan untuk masuk tim' )
            ->with( $this->data );
    }
}
