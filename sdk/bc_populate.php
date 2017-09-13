<?php
require_once("bc_ticker.php");
/*
    Script responsavel por armazenar as informacoes disponibilizadas pelo link
    'https://www.mercadobitcoin.net/api/v2/ticker/'
    no banco de dados por meio da Classe Auxiliar 'Ticker'.
*/
while(TRUE){
    // Criacao do objeto contendo as informacoes disponibilizadas pelo JSON e insercao no banco
    $ticker = new Ticker();
    $ticker->createInstance();
    $ticker->save();
    $ticker->info();
    // Tempo entre armazenamento de cada uma das requisicoes.
    $get_time = 60;
    sleep($get_time);
}
?>
