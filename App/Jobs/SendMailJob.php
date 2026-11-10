<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $name;
    protected $content;

    public function __construct($email, $name = null, $content = null)
    {
        $this->email = $email;
        $this->name = $name;
        $this->content = $content;
    }

    public function handle(): void
    {
        Mail::to($this->email)->send(
            new VerifyEmail(
                $this->name ?? 'Người dùng',
                $this->content ?? 'Nội dung email từ Queue Job'
            )
        );
    }
}