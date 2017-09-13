<?php

include("bc_quote.php");
require_once('bc_quote.php');
$json = file_get_contents('https://www.mercadobitcoin.net/api/v2/ticker/');
$obj = json_decode($json);
$ticker = new Ticker($obj->ticker);
$ticker->info();

?>
