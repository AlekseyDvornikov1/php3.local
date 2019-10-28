<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email with the number of visits to the site';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = [
            'name' => 'Aleksey',
            'body' => 'A test mail every minutes'
        ];
        Mail::send('emails.mail', $data, function ($message) {
            $message->to('lesha.dvornikov1@gmail.com', 'Lesha')->subject('Привет!');
            $message->from('lesha.dvornikov1@gmail.com', 'test');
        });
    }
}

