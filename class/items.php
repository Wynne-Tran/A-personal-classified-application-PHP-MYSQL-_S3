<?php
    include __DIR__ . '/../libs/db.php';

    class Items extends Db{
        public  static $table_name = 'items';
        protected static $fields = array(
                                        'id'   => '',
                                        'title' => '',
                                        'descrip' => '',
                                        'price' => 0,
                                        'images' => 'none.jpg',
                                        'cat_id' => "",
                                        'status' => 'SHOW',
                                        'front_page' => 'YES');
//admin page show all item
        public function getAll(){
            return $this->query('SELECT * from ' . self::$table_name);
        }
// user page view item
        public function getAll_User(){
            return $this->query('SELECT * from ' . self::$table_name. ' where status = 1');
        }
// admin front page
        public function getAll_FrontPage(){
            return $this->query('SELECT * from ' . self::$table_name. ' where status = 1 && front_page = 1');
        }

        public function getById($id)
        {
            return $this->query('SELECT * from ' . self::$table_name . ' where id = '.  $id);
        }

         
    }


class Categories extends Db{
    public  static $table_name = 'category';
    protected static $fields = array(
                                    'id'   => '',
                                    'name' => '',
                                    'desc' => '',
                                    'images' => 'none.jpg',
                                    'status' => '1'
                                    );

    //print all category for admin page
    public function getAllCat(){
        return $this->query('SELECT * from ' . self::$table_name);
    }
    // print all category for user page
    public function getAllCat_User(){
        return $this->query('SELECT * from ' . self::$table_name. ' where status = 1');
    }

    public function getByIdCat($id)
    {
        return $this->query('SELECT * from ' . self::$table_name . ' where id = '.  $id);
    }

     
}

class Members extends Db{
    public  static $table_name = 'members';
    protected static $fields = array(
                                    'id'   => '',
                                    'first_name' => '',
                                    'last_name' => '',
                                    'username' => '',
                                    'email' => '',
                                    'password' => '',
                                    'memberscol ' => ''
                                    );

    public function getAllMem(){
        return $this->query('SELECT * from ' . self::$table_name);
    }
    

    public function getByIdMem($id)
    {
        return $this->query('SELECT * from ' . self::$table_name . ' where id = '.  $id);
    }

     
}

class Maintain extends Db{
    public  static $table_name = 'maintain';
    protected static $fields = array(
                                    'status'   => '2',
                                    );

    public function getstatus(){
        return $this->query('SELECT * from ' . self::$table_name);
    }
     
}





