<?php
require "homework5_model.php";

$hmodel = new Homework5Model();
$csv = "社員数,売上合計,売上平均\n";
$csv .= $hmodel->staff_num().",".$hmodel->sales_sum().",".$hmodel->sales_ave();

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=report.csv");

echo $csv;