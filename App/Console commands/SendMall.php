<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

#[Signature('app:send-mail')]
#[Description('Command description')]
class SendMail extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
         $email = $this->argument('email');
    $bcc = $this->option('bcc');

    $send = Mail::to($email);

    if (!empty($bcc)) {
        $send->bcc($bcc);
    }

    $send->send(new VerifyEmail('Phùng Minh Châu'));
    $this->info('Mail sent to ' . $email . ' with bcc: ' . $bcc ?? '');

    return Command::SUCCESS;

    }
}

