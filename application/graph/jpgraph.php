<?php


// header("Content-Type: image/jpg; charset=utf-8");

include( dirname(__FILE__)."/_jpgraph/jpgraph.php");
include( dirname(__FILE__)."/_jpgraph/jpgraph_bar.php");
$datay = array(1,2,3,4,5,9,6,5,4,3,2,1);
$graph =new Graph(600,300,"auto");	
$graph->SetScale("textlin");
$graph->yaxis->scale->SetGrace(20); 
// $graph->SetShadow(  ); //  不起作用 Nouse
$graph->img->SetMargin(40,30,30,40);


$datay2 = array(2,1,4,3,2,7,6,5,4,3,2,1);



$bplot = new BarPlot( $datay );
// $bplot->SetFillColor( 'red' ); //不起作用
// $bplot->SetColor('red');
$bplot->SetColor( array(255,255,255));
// $bplot->value->Show();  //不起作用
$bplot->value->SetFormat( '%d' );

$bplot2 = new BarPlot( $datay2 );
$bplot2->SetFillColor( 'blue' ); //不起作用
// $bplot2->SetColor( array(0,0,0));
$bplot2->value->Show();  //不起作用
$bplot2->value->SetFormat( "%d" );

$graph->Add($bplot);
$graph->Add($bplot2);
// $graph->Add($bplot);
// $graph->Add($bplot);
$graph->SetMarginColor( 'lightblue' );
$title = 'test测试test';
$title=iconv("utf-8","gb2312",$title);
$graph->title->Set( $title );
$a = array(1,2,3,4,5,6,7,8,9,"10月份",11,12);
$graph->xaxis->SetTickLabels( $a );
$graph->title->SetFont(FF_SIMSUN);
$graph->xaxis->SetFont(FF_CHINESE);
$graph->Stroke();
?>