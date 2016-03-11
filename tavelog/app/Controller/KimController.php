<?php
App::uses('AppController', 'Controller');

class KimController extends AppController {


    public $uses = array();


    public function convert(){
        $word = $this->request->query('word');
        if(isset($word)){
            $options="kh";
            $converted = mb_convert_kana($word,$options);
            $converted2 = str_replace("ｱﾝ","ｱﾝｯ///",$converted);
            $converted3 = str_replace("ｲｸ","ｲｸｯｯ///",$converted2);
            $result = ['status' => 'complete', 'word' => $word,'result' => $converted3];

        }else{
            $result = ['status' => 'incomplete','word' => $word ,'result' => null];
        }
        $this->viewClass = 'Json';
        $this->set(compact('result'));
        $this->set('_jsonOptions', JSON_UNESCAPED_UNICODE+JSON_UNESCAPED_SLASHES);
        $this->set('_serialize', 'result');
    }



    public function index() {
        $this->autoLayout=false;
    }
}
