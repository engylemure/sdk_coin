<?php

include("bc_ticker.php");
$ticker = new Ticker();
$ticker->createInstance();
$ticker->info();
$array_t = $ticker->getPeriod($ticker->date_unix-3000,$ticker->date_unix,5);
foreach($array_t as $k=>$cur){
    $cur->info();
}

?>
