<?php

class LogDB
{

    const USER = 'root';
    const PASSWORD = 'root';
    const DB = 'cowrie';
    const HOST = '127.0.0.1';
    const PORT = 8889;
    const SOCKET = 'localhost:/Applications/MAMP/tmp/mysql/mysql.sock';

    public $link;
    public $count;

    function __construct(){
        $this->link = mysqli_init();
        if(!$this->link){
            die('mysqli_init failed');
        }
        $success = mysqli_real_connect(
           $this->link,
           self::HOST,self::USER,
           self::PASSWORD,self::DB,
           self::PORT,self::SOCKET
       );
        if(!$success){
            printf("connect failed: %s\n",$this->link->connect_error);
            exit();
        }
    }

    function __destruct(){
        $this->link->close();
    }

    function query($sql){
        $result = $this->link->query($sql);

        if($result == FALSE){
            $error = $this->link->error . ": " . $this->link->error;
            $rt = array(
                'status' => FALSE,
                'count'  => 0,
                'result' => "",
                'error'  => $error
            );
            return json_encode($rt);
        } else {
            $this->count = $result->num_rows;

            $data = array();
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            $result->close();
            $rt = array(
                'status' => TRUE,
                'count'  => $this->count,
                'result' => $data,
                'error'  => ""
            );
            return json_encode($rt);
        }
    }

}
?>
