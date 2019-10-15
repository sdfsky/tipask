<?php

namespace App\Jobs;

use App\Mail\GlobalMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $blade;
    protected $subject;
    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $subject, $data=[], $blade)
    {
        //
        $this->email = $email;
        $this->blade = $blade;
        $this->subject = $subject;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Log::info('SendEmail_to_'.$this->email.'_start');
        Mail::to($this->email)->send(new GlobalMail($this->blade, $this->subject, $this->data));
    }
}
