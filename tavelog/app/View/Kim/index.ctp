<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$this->Html->script('jquery-2.2.1.min', array('inline' => false));
$this->Html->script('kim', array('inline' => false));
$this->Html->css('bootstrap.min.css', array('inline' => false));
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>
        <?php echo $cakeDescription ?>:
        <?php echo $this->fetch('title'); ?>
    </title>
    <?php
    echo $this->Html->meta('icon');


    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
</head>
<body>
<div id="container" class="container">
    <h1>KIM語変換</h1>
    <p>全角ひらがなと全角カタカナを半角カタカナに変換します。</p>
    <p>また、「あん」「いく」という単語には特別な処理を実施します。</p>

    <form id="convert-submit" action="convert" method="get">
        <div class="form-group">
            <label for="word">変換対象ワード</label>
            <input type="text" class="form-control" id="word" placeholder="あんでぃ" name="word">
        </div>
        <button type="submit" class="btn btn-default">変換</button>
    </form>

    <h2>KIM語変換結果</h2>
    <table class="table table-hover table-bordered result">

    </table>

</div>

</div>
</body>
</html>