<?php
class FormModel{
    private $s;
    private $n;
    private $errors;

    function __construct(){
        if(isset($_POST['s'])){
            $this->s = $_POST['s'];
        }
        if(isset($_POST['n'])){
            $this->n = $_POST['n'];
        }
        $this->errors = array();
    }

    function validate(){
        if(empty($this->s)){
            $this->errors['s'] = "sの項目にアルファベットの文字を入力してください";
        }elseif(!ctype_alpha($this->s)){
            $this->errors['s'] = "sの項目にアルファベットの文字を入力してください";
        }

        if(empty($this->n)){
            $this->errors['n'] = "nの項目に正の数値を入力してください";
        }elseif (!ctype_digit($this->n)) {
            $this->errors['n'] = 'nが正の数字ではありません';
        }

        if(empty($this->errors)){
            if(strlen($this->s) < $this->n){
                $this->errors['n'] = "nは文字の長さより大きい必要があります";
            }
        }
    }

    /**
     * 文字列s の1番左の文字を1文字目として、n文字目のアルファベットを返す。
     * @return string n文字目のアルファベット
     */
    public function nextString(){
        return $this->s[$this->n-1];
    }

    /**
     * @return string[]
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function getS()
    {
        return $this->s;
    }

    /**
     * @return string
     */
    public function getN()
    {
        return $this->n;
    }

}
