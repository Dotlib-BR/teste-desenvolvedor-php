<?php

namespace App\Http\Traits;

use App\Models\User;

trait NotificacaoTrait {

    public function notificacoesBase($subject,$greeting,$body,$thanks,$usuarioId){
        $user9 = User::find($usuarioId);
        $detalhes = [
            'subject' =>$subject,
            'greeting' => $greeting,
            'body' => $body,
            'thanks' => $thanks,
    ];
    return $user9->notify(new \App\Notifications\OrdemExecutada($detalhes));
    }

}