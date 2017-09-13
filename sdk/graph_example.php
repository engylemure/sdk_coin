<?php
require_once("bc_ticker.php");
require_once ("jpgraph/src/jpgraph.php");
require_once ("jpgraph/src/jpgraph_line.php");
echo "ok";
$datay1 = array();
$datay2 = array();
$datax = array();
$ticker = new Ticker();
$day_unix = 3600*24;
$ticker->createInstance();
$array_ticker = $ticker->getByPeriod($ticker->getDateUnix()-$day_unix,$ticker->getDateUnix(),3600);
foreach($array_ticker as $k => $var){
    array_push($datay1, $var->getHigh());
    array_push($datay2, $var->getLow());
    array_push($datax, $var->getDate());
}
// Setup the graph
$graph = new Graph(600,500);
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('BitCoin Graph Example - With Bc_Ticker');
$graph->SetBox(false);

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels($datax);
$graph->xgrid->SetColor('#E3E3E3');

// Create the first line
$p1 = new LinePlot($datay1);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend('High');

// Create the second line
$p2 = new LinePlot($datay2);
$graph->Add($p2);
$p2->SetColor("#B22222");
$p2->SetLegend('Low');


$graph->legend->SetFrameWeight(1);

// Output line
$graph->Stroke();
?>