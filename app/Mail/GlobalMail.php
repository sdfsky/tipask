<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class GlobalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $blade; // 视图模板
    public $sub; // 主题
    public $data; // 参数
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($blade, $sub, $data=[])
    {
        //
        $this->blade = $blade;
        $this->sub = $sub;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::info('GlobalMail_'.$this->blade,$this->data);
        return $this->subject($this->sub)->view('emails.'.$this->blade)->with($this->data);
    }
}
