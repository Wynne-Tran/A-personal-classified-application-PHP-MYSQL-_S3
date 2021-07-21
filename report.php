<?php


include 'class/items.php';
include 'inc/functions.php';


$date = date("Y-m-d");
$subject = "Report for '$date' ";
echo $subject;
echo ("<br>");
// count active item
$countItem = 0;
$item = new Items();
$result = $item->getAll_User();
while( $row = $result->fetch_assoc() ){ 
    if ($row['status'] == 'SHOW' ){
        $countItem++;
    }
}

//Count active categories
$countCat = 0;
$category = new Categories();
$result1 = $category->getAllCat_User();
while( $row1 = $result1->fetch_assoc() ){ 
    if ($row1['status'] == 'SHOW' ){
        $countCat++;
    }
}

function report($max_num_of_items = 10000){
    ?>
    <?php 

        $item = new Items();
        $result = $item->getAll();
        while( $row = $result->fetch_assoc() ){ 
            $query = sprintf("Update %s set 
            status = '%s',
            front_page = '%s' 
            where id = %d", Items::$table_name,
                            $row['status'],
                            $row['front_page'],
                            $row['id']);

            $item->query($query);
            printf("
            Name: %s  
            Description: %s  
            Category: %s  
            Price: %d "
                    ,$row['title'],$row['descrip'],$row['cat_id'], $row['price']); 
            echo ("<br>");
        } 
    ?> 
            
        <?php 
    }

report(5);
$to = "thihoangtram.tran@georgebrown.ca";


$txt =  "
Active Categories:  '$countCat' \n
Active Items:  '$countItem' ";

$headers = "From: https://f0161665.gblearn.com/comp1230" . "\r\n" .
"CC: wynnetran2018@gmail.com";


echo $txt;
//mail($to,$subject,$txt,$headers);



?>