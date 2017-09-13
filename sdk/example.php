<?php

include("bc_ticker.php");
$ticker = new Ticker();
// Exemplo do createInstance
$ticker = $ticker->createInstance();
// Exemplo do save
$ticker->save();
// Exemplo do info
echo "Conteudo do createInstance()\n";
$ticker->info();
// Exemplo do getByDate
$ticker->getByDate($ticker->getDateUnix());
echo "Conteudo do getByDate()\n";
$ticker->info();
// Exemplo do getPeriod
echo "Conteudo do getByPeriod()\n";
$array_t = $ticker->getByPeriod($ticker->getDateUnix()-300,$ticker->getDateUnix(),60);
foreach($array_t as $k=>$cur){
    $cur->info();
}

?>
