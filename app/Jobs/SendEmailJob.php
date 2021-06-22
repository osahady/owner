<?php

namespace App\Jobs;

use App\Mail\Gmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $ad;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ad)
    {
        $this->ad = $ad;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $details = [
            'title' => 'حياك الله',
            'body' => 'يرجى الاطلاع على الإعلان ' . $this->ad->title . ' ولك الشكر!',
        ];
        Mail::to('osahady@gmail.com')
            ->cc('seeosahady@gmail.com')
            ->send(new Gmail($details));
    }
}
