<?php

namespace Modules\FptService\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\FptService\Entities\FptServiceCustomer;

class SendRegistedCustomerDataMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $fptServiceCustomer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(FptServiceCustomer $fptServiceCustomer)
    {
        $this->fptServiceCustomer = $fptServiceCustomer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject("[FPT Telecom] Khách hàng {$this->fptServiceCustomer->name} vừa đăng ký dịch vụ")
            ->view('fptservice::emails.registed_customer', [
            'fptServiceCustomer' => $this->fptServiceCustomer
        ]);
    }
}
