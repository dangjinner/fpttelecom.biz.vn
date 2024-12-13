<?php

namespace Modules\FptService\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Modules\FptService\Emails\SendRegistedCustomerDataMail;
use Modules\FptService\Entities\FptServiceCustomer;

class SendRegistedCustomerDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $fptServiceCustomer;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FptServiceCustomer $fptServiceCustomer)
    {
        $this->fptServiceCustomer = $fptServiceCustomer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to(setting('store_email'))->send(new SendRegistedCustomerDataMail($this->fptServiceCustomer));
    }
}
