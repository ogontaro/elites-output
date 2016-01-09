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
<ul>
<?php foreach(range(1,100) as $number){
  if(isPrimeNumber($number)){
    echo '<li>' . $number . '</li>';
  }
}
?>
</ul>
</body>
</html>