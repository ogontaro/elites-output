<?php
require "homework5_model.php";

$hmodel = new Homework5Model();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>NOWALL | 課題「CSVファイルの読み込みと出力」</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>課題006「CSVファイルの読み込みと出力」</h1>
    <h2>課題内容</h2>
    <p>下記のようなCSV形式の売上データが与えられている。</p>
    <p>このCSVファイルを読み込んで、社員数、売上合計、売上平均を出力せよ。</p>
    <a href="sales.csv">sales.csv</a>
    <pre>社員名,売上
Kashiwagi,1000
Hidaka,500
Ohira,300</pre>
    <h2>読込結果</h2>
    <a href="report.php">reports.csv</a>

    <table class="table">
        <tr>
            <th>社員数</th>
            <th>売上合計</th>
            <th>売上平均</th>
        </tr>
        <tr>
            <td><?php echo $hmodel->staff_num() ?></td>
            <td><?php echo $hmodel->sales_sum() ?></td>
            <td><?php echo $hmodel->sales_ave() ?></td>
        </tr>
    </table>

</div>
</body>
</html>