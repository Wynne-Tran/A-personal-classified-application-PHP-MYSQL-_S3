<?php
include_once 'class/items.php';

const ITEMS_FILE = __DIR__ . '/../data/items.txt';
const CATEGORY_FILE = __DIR__ . '/../data/categories.txt';
const PASSWORD_FILE = __DIR__ . '/../data/pass.txt';
const IMAGES_PATH = __DIR__ . '/../images/';
const IMAGES_ITEM_PATH =  'images/items';
const IMAGES_CATEGORY_PATH =   'images/category';

//function get content "post" from form
function get($name,$def=''){
    return (isset($_REQUEST[$name]) ? $_REQUEST[$name] : $def);
}

function check_access(){
    if(!isset($_SESSION['username']) || $_SESSION['username'] != true){
        header('Location: admin.php?err=please login');
    }
}

function can_access(){
    return (isset($_SESSION['username']) && $_SESSION['username'] == true);
}

// show items
function get_items_user($max_num_of_items = 10000){
   ?>
            <table class = "table table-hover">
            <tr>
                <th>NAME</th>
                <th>DESCRIBE</th>
                <th>$PRICE</th>
                <th>PICTURE</th>
                
            </tr>
            <?php 

        $item = new Items();
        $result = $item->getAll_User();
       
        while( $row = $result->fetch_assoc() ){ 
            //here code check status of category, if HIDE--> item HIDE
            $category = new Categories();
            $result1 = $category->getAllCat();
            while( $row1 = $result1->fetch_assoc() ){
                if($row['cat_id'] == $row1['id']){
                    $row['status'] = $row1['status'];
                    If($row['status'] == "SHOW"){
                        $row['front_page'] = "YES";
                    }else{$row['front_page'] = "NO";}
                    
                }
            }
            $query = sprintf("Update %s set 
            status = '%s',
            front_page = '%s' 
            where id = %d", Items::$table_name,
                            $row['status'],
                            $row['front_page'],
                            $row['id']);

            $item->query($query);
            printf("<tr>
                       <td>%s</td>
                       <td>%s</td>
                       <td>$%.2f</td>
                       <td><a href='viewItemDetail.php?id=%d'><img src='" . IMAGES_ITEM_PATH . "/%s' width='100px' height = '100px' alt='item'></a></td>
                       
                    </tr>",$row['title'],$row['descrip'], $row['price'], $row['id'], $row['images']); 
        } 
             ?> 
            </table>  
        <?php 
    }

    // front page
    function get_items_Frontpage($max_num_of_items = 10000){
        ?>
                 <table class = "table table-hover">
                 <tr>
                     <th>NAME</th>
                     <th>DESCRIBE</th>
                     <th>CATEGORY</th>
                     <th>$PRICE</th>
                     <th>PICTURE</th>
                     
                 </tr>
                 <?php 
     
             $item = new Items();
             $result = $item->getAll_FrontPage();
            
             while( $row = $result->fetch_assoc() ){ 

                $category = new Categories();
            $result1 = $category->getAllCat();
            while( $row1 = $result1->fetch_assoc() ){
                if($row['cat_id'] == $row1['id']){
                    $row['status'] = $row1['status'];
                    If($row['status'] == "SHOW"){
                        $row['front_page'] = "YES";
                    }else{$row['front_page'] = "NO";}
                }
            }
            $query = sprintf("Update %s set 
            status = '%s',
            front_page = '%s' 
            where id = %d", Items::$table_name,
                            $row['status'],
                            $row['front_page'],
                            $row['id']);

            $item->query($query);
                 printf("<tr> 
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>$%.2f</td>
                            <td><img src='" . IMAGES_ITEM_PATH . "/%s' width='100px' height = '100px' alt='item'></td>
                            
                         </tr>",$row['title'],$row['descrip'], $row['cat_id'], $row['price'], $row['images']); 
             } 
                  ?> 
                 </table>  
             <?php 
         }



// AdminItem page
function get_items($max_num_of_items = 10000){
    ?>
            <table class = "table table-hover">
            <tr>
                <th>NAME</th>
                <th>DESCRIBE</th>
                <th>CATEGORY</th>
                <th>$PRICE</th>
                <th>PICTURE</th>
                <th>STATUS</th>
                <th>FRONT_PAGE</th>
                <th>ACTION</th>
              
        </tr>
    <?php 

        $item = new Items();
        $result = $item->getAll();
       
        while( $row = $result->fetch_assoc() ){ 
            $category = new Categories();
            $result1 = $category->getAllCat();
            while( $row1 = $result1->fetch_assoc() ){
                if($row['cat_id'] == $row1['id']){
                    $row['status'] = $row1['status'];
                    If($row['status'] == "SHOW"){
                        $row['front_page'] = "YES";
                    }else{$row['front_page'] = "NO";}
                    
                }
            }
            $query = sprintf("Update %s set 
            status = '%s',
            front_page = '%s' 
            where id = %d", Items::$table_name,
                            $row['status'],
                            $row['front_page'],
                            $row['id']);

            $item->query($query);
            printf("<tr>
                       <td>%s</td>
                       <td>%s</td>
                       <td>%s</td>
                       <td>$%.2f</td>
                       <td>
                       <img src='" . IMAGES_ITEM_PATH . "/%s' width='100px' height = '100px' alt='item'>
                       <br><a href = 'modifyImageItem.php?id=%d'><h6>Modify Image</h6></a>
                       </td>
                       <td>%s</td>
                       <td>%s</td>
                       <td><a href='itemManage.php?id=%d'>Edit</a> |
                       <a href='itemManage.php?id=%d&action=delete'>Delete</a></td>
                       
                    </tr>",$row['title'],$row['descrip'],$row['cat_id'], $row['price'], $row['images'], $row['id'], $row['status'],$row['front_page'],$row['id'],$row['id']); 
        } 
    ?> 
            </table>  
        <?php 
    }


function get_categories_user(){
?>
            <table class = "table table-hover">
            <tr>
                <td><h3>NAME</h3></td>
                <td><h3>DESCRIBE</h3></td>
                <td><h3>PICTURE</h3></td>
            </tr>
            <?php 

            $category = new Categories();
            $result = $category->getAllCat_User();
            while( $row = $result->fetch_assoc() ){ 

                //update item status
            $item = new Items();
            $result1 = $item->getAll();
            while( $row1 = $result1->fetch_assoc() ){
                if($row1['cat_id'] == $row['id']){
                    $row1['status'] = $row['status'];
                    If($row['status'] == "SHOW"){
                        $row['front_page'] = "YES";
                    }else{$row['front_page'] = "NO";}
                    $query = sprintf("Update %s set 
                        status = '%s',
                        front_page = '%s' 
                        where id = %d", Items::$table_name,
                            $row1['status'],
                            $row1['front_page'],
                            $row1['id']);

            $item->query($query);
                }
            }
            

            printf("<tr>
                       <td>%s</td>
                       <td>%s</td>
                       <td><img src='" . IMAGES_CATEGORY_PATH . "/%s' width='100px' height = '100px' alt='item'></td>
                       
                    </tr>",$row['name'],$row['descrip'], $row['images']); 
            } 
                
             ?> 
            </table>  
        <?php 
    }
    

function get_categories(){
?>
        
    <table class = "table table-hover">
    <tr>
        <th>ID</th>
        <th>NAME</th>
        <th>DESCRIBE</th>
        <th>NUMBER OF ITEMS</th>
        <th>STATUS</th>
        <th>ACTION</th>
     
    </tr>
    <?php 
        $item = new Categories();
        $result = $item->getAllCat();
        while( $row = $result->fetch_assoc() ){ 

            // here is code for counting items in 1 category id
            $item = new Items();
            $result1 = $item->getAll();
            $count = 0;
            while( $row1 = $result1->fetch_assoc() ){
                if($row1['cat_id'] == $row['id']){
                    $count++;
                }
            }
        printf("<tr>
           <td>%s</td>
           <td>%s</td>
           <td>%s</td>
           <td>%s</td>
           <td>%s</td>
           <td><a href='manage-category.php?id=%d'>Edit</a> |
           <a href='manage-category.php?id=%d&action=delete'>Delete</a></td>
           
           
        </tr>", $row['id'], $row['name'],$row['descrip'], $count, $row['status'],$row['id'],$row['id']); 
            } 
        ?> 
    </table>  
    <?php 
    }
   


    function user_search($keyword){
        ?>
                 <table class = "table table-hover">
                 <tr>
                     <th>NAME</th>
                     <th>DESCRIBE</th>
                     <th>$PRICE</th>
                     <th>PICTURE</th>
                     
                 </tr>
                 <?php 
     
             $item = new Items();
             $result = $item->getAll_User();
             
                while( $row = $result->fetch_assoc() ){ 
                    if(strstr( $row['title'], $keyword) == true || strstr( $row['descrip'], $keyword) == true){
                    printf("<tr>
                               <td>%s</td>
                               <td>%s</td>
                               <td>$%.2f</td>
                               <td><img src='" . IMAGES_ITEM_PATH . "/%s' width='100px' height = '100px' alt='item'></td>
                               
                            </tr>",$row['title'],$row['descrip'], $row['price'], $row['images']); 
                } 
            }
             
                  ?> 
                 </table>  
             <?php 
         }


 function admin_search($keyword){
            ?>
                     <table class = "table table-hover">
                     <tr>
                         <th>NAME</th>
                         <th>DESCRIBE</th>
                         <th>$PRICE</th>
                         <th>PICTURE</th>
                         
                     </tr>
                     <?php 
         
                 $item = new Items();
                 $result = $item->getAll();
                 
                    while( $row = $result->fetch_assoc() ){ 
                        
                        if(strstr( $row['title'], $keyword) == true || strstr( $row['descrip'], $keyword) == true){
                        printf("<tr>
                                   <td>%s</td>
                                   <td>%s</td>
                                   <td>$%.2f</td>
                                   <td><img src='" . IMAGES_ITEM_PATH . "/%s' width='100px' alt='item'></td>
                                   
                                </tr>",$row['title'],$row['descrip'], $row['price'], $row['images']); 
                    } 
                }
                 
                      ?> 
                     </table>  
                 <?php 
             }


function checkMaintain(){
    $status= new Maintain();
    $result = $status->getstatus();
    $row = $result->fetch_assoc();
    If($row['status'] == "SHOW" || $row['status'] == 1){
        header('Location: maintain.php');
    }

}
?>