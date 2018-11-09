<?php
   class database{
        protected $bp=null;
        public static function connect($database,$uid,$pwd);
        if(!empty(database::$dp)) return;
        $dsn="$mysql:host=localhost;dbname=$database";
    try{
        database::$dp=new PDO($dsn,$uid,$pwd);

    }catch(PDOException $e){
        echo $e->getMessage();
    }


}