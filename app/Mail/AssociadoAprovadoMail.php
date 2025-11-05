<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Associado;

class AssociadoAprovadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $associado;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Associado $associado)
    {
        $this->associado = $associado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Cadastro Aprovado - AEMP-MG')
            ->view('emails.associado-aprovado');
    }
}
