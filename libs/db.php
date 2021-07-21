<?php
    class Db extends mysqli{
        protected static $instance;
        public function __construct($host = '127.0.0.1',$username = 'root',$password ='',$database = 'test',$port ='3306',$socket=false){
        //public function __construct($host = 'gblearn.com',$username = 'f0161665_admin',$passwrod ='m5vlS]iH8{Z8',$database = 'f0161665_test',$port ='3306',$socket=false){
            mysqli_report(MYSQLI_REPORT_OFF);
            parent::__construct($host,$username,$password,$database,$port,$socket);
            if($this->connect_errno)
            {
                // throw exception.
                echo 'cannot access database';
            }
        }
        public static function getInstance(){
            if(!self::$instance)
                self::$instance = new self();
            return self::$instance;
        }
        
        /*
        public function query($query, $resultMode = NULL)
        {
            
         if( !$this->real_query($query) ) {
            throw new exception( $this->error, $this->errno );
        }
            return new mysqli_result($this);
        }
        */
    }
/*
    try{

    $sql = Db::getInstance();

    $result = $sql->query("select * from test");
 
    
    // Fetch the results of the query 
    while( $row = $result->fetch_array() ){ 
        printf("%s (%s)\n", $row[0], $row[1]); 
    } 

}catch(Exception $ex)
{

    //print_r($ex);
    echo $ex->getMessage();
}
*/