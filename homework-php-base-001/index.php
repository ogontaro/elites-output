<?php

/**
 * 引数の数字が素数か判定する
 * @param int $number 判定対象の数字
 * @return boolean 素数ならtrueを返す
 */
function isPrimeNumber($number){
    if($number == 2){
        return true;
    }
    foreach(range(2,$number-1) as $counter){
        if($number % $counter == 0){
            return false;
        }
    }
  return true;
}

/**
 * 指定した範囲内の素数のリストを作る
 * @param int $low 範囲の下限
 * @param int $max 範囲の上限
 * @return array 素数のリスト
 */
function createPrimeNumbers($low, $max){
    return array_filter(range($low,$max),"isPrimeNumber");
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>素数列挙</title>
</head>
<body>
<h1>素数列挙</h1>
<p>1から100までの数字のうち、素数を出力する</p>
<?php
$firstFlug=true;
foreach(createPrimeNumbers(1,100) as $primeNumber){
    if($firstFlug){
        echo $primeNumber;
        $firstFlug=false;
    }else{
        echo ', ' . $primeNumber;
    }
}
?>
</body>
</html>