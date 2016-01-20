<?php

class Homework5Model{
    private $records ;

    /**
     * Homework5Model constructor.
     */
    public function __construct()
{
    $file_path = "sales.csv";
    $file = new SplFileObject($file_path);
    $file->setFlags(SplFileObject::READ_CSV);
    $this->records = array();
    $ignore_first_flag = true;
    foreach ($file as $line) {
        if($ignore_first_flag){
            $ignore_first_flag = false;
            continue;
        }
        $this->records[] = $line;
    }
}

    /**
     * レコードの行数を返す
     * @return int レコードの行数
     */
    public function staff_num(){
       return count($this->records);
    }

    /**
     * 売上の最大値を返す
     * @return int 売上の最大値
     */
    public function sales_max(){
        return intval(max(array_map(function($v){
            return $v[1];
        },$this->records)));
    }

    /**
     * 売上の合計を返す
     * @return int 売上の合計
     */
    public function sales_sum(){
        return intval(array_reduce($this->records,function($carry,$record){
            $carry += $record[1];
            return $carry;
        } ));
    }

    /**
     * 一人あたりの売上の平均を返す
     * @return float 売上の平均
     */
    public function sales_ave(){
        return $this->sales_sum() / $this->staff_num();
    }

}
