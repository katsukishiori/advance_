<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AnnouncementEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.announcement')
            ->with([
                'user' => $this->user,
                'verificationUrl' => $this->verificationUrl($this->user)
            ]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function verificationUrl($user)
    {
        // メール認証機能を使用して、ユーザーのメール確認用のURLを生成する
        // 具体的な実装はアプリケーションの要件による
        return route('verification.verify', [
            'id' => $user->id,
            'hash' => sha1($user->email),
        ]);
    }
}
