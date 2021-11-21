<?php

function formatarData($data){
    return date("d/m/Y", strtotime($data));
}

function formatarTexto($texto, $limite=10) {

    $tamanho = strlen($texto);

    if ($tamanho <= $limite) {
        return $texto;
    } else {
        $resultado = substr($texto, 0, $limite);
        $espaco = strrpos($resultado, ' ');
        if($espaco){
            $resultado = substr($resultado, 0, $espaco);
        }
        return $resultado.'...';
    }
}

function formatarStatusVaga($status){
    if ($status==1) {
        $msg='<span class="badge badge-success pull-right m-t-6">Ativo</span>';
    } else {
        $msg='<span class="badge badge-danger pull-right m-t-6">Inativo</span>';
    }
    echo $msg;
    return;
}

function formatarValoresReal($numero){
    return 'R$ '.number_format($numero, 2, ',', '.');
}

function formatarPerfil($perfil1, $perfil2){

    $msg='';
    if($perfil1 == 1 || $perfil2==1){
            if($perfil1==1 &&  $perfil2==0){
                $msg='<span class="badge badge-success pull-right m-t-6">Adm</span>';
            }elseif($perfil2==1 &&  $perfil1==0){
                $msg='<span class="badge badge-success pull-right m-t-6">Usuário</span>';
            } else {
                $msg='<span class="badge badge-success pull-right m-t-6">Adm/Usuário</span>';
            }
        }else {
            $msg='<span class="badge badge-danger pull-right m-t-6">Inativo</span>';
        }
    echo $msg;
}
