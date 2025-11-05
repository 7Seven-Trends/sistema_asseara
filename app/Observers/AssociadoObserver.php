<?php

namespace App\Observers;

use App\Models\Associado;
use App\Mail\AssociadoAprovadoMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AssociadoObserver
{
    /**
     * Handle the Associado "updating" event.
     * Detecta quando situação muda de "Em análise" (0) para "Aprovado" (1)
     *
     * @param  \App\Models\Associado  $associado
     * @return void
     */
    public function updating(Associado $associado)
    {
        // Verifica se a coluna 'situacao' foi alterada
        if ($associado->isDirty('situacao')) {
            $situacaoOriginal = $associado->getOriginal('situacao');
            $situacaoNova = $associado->situacao;

            // Verifica se mudou de "Em análise" (0) para "Aprovado" (1)
            if ($situacaoOriginal == 0 && $situacaoNova == 1) {
                try {
                    // Envia email de aprovação
                    Mail::to($associado->email)->send(new AssociadoAprovadoMail($associado));

                    Log::channel('single')->info('Email de aprovação enviado para: ' . $associado->email);
                } catch (\Exception $e) {
                    Log::channel('single')->error('Erro ao enviar email de aprovação: ' . $e->getMessage());
                }
            }
        }
    }
}
