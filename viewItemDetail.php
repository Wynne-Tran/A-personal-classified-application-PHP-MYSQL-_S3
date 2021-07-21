<?php session_start();
include 'inc/functions.php';
include_once 'class/items.php';
//$con = mysqli_connect('gblearn.com','f0161665_admin','m5vlS]iH8{Z8','f0161665_test');
$con = mysqli_connect('127.0.0.1','root','','test');
$date = date("Y-m-d");
$id = $_REQUEST['id'];
$query = "SELECT * FROM `count_view` WHERE `id_item` = '$id'";
$result = mysqli_query($con, $query);

if(!isset($_COOKIE['visitor'])){
    $time = strtotime('nextday 00:00');
    setcookie('visitor', 'hey', $time);
}

$count = 0;
while($row = $result->fetch_assoc()){
    if($row['id_item'] == $_REQUEST['id'])
    {
        $count = $row['daily_count'];
        $updateQuery = "UPDATE `count_view` SET `id_item` = '$id', `date_count`='$date', `daily_count` = $count + 1 WHERE `id_item` = '$id'";
        mysqli_query($con, $updateQuery);
        $count = 0;
        //echo $updateQuery;
    break;
    }
}

if ($result ->num_rows == 0 || $count = 0){
    $insertQuery = "INSERT INTO `count_view` (`id_item`, `date_count`) VALUES ('$id', '$date')";
    mysqli_query($con, $insertQuery);
}

    


?>
<?php
    include_once __DIR__. '/class/items.php';
    
?>
<?php
$item = new Items();
$item_info = $item->getById($_REQUEST['id'])->fetch_assoc();

    if(empty($item_info)) die('cannot ');
    if(isset($_REQUEST['Add']) && $_REQUEST['Add'] = 'save')
    {


        $nameImage = $_FILES['picture']['name'][0];
        if ($nameImage == null){
            $nameImage = "none.jpg";
        }

        if(isset($_FILES['picture'])  ){
            $image = move_uploaded_file($_FILES['picture']['tmp_name'][0], './images/items/' . $_FILES['picture']['name'][0]);
        }

        $nameImage2 = $_FILES['picture']['name'][1];
        if ($nameImage2 == null){
            $nameImage2 = "none.jpg";
        }
        //code for upload images
        if(isset($_FILES['picture'])  ){
            $image = move_uploaded_file($_FILES['picture']['tmp_name'][1], './images/items/' . $_FILES['picture']['name'][1]);
        }

        $nameImage3 = $_FILES['picture']['name'][2];
        if ($nameImage3 == null){
            $nameImage3 = "none.jpg";
        }
        //code for upload images
        if(isset($_FILES['picture'])  ){
            $image = move_uploaded_file($_FILES['picture']['tmp_name'][2], './images/items/' . $_FILES['picture']['name'][2]);
        }

        $nameImage4 = $_FILES['picture']['name'][3];
        if ($nameImage4 == null){
            $nameImage4 = "none.jpg";
        }
        //code for upload images
        if(isset($_FILES['picture'])  ){
            $image = move_uploaded_file($_FILES['picture']['tmp_name'][3], './images/items/' . $_FILES['picture']['name'][3]);
        }

        $nameImage5 = $_FILES['picture']['name'][4];
        if ($nameImage5 == null){
            $nameImage5 = "none.jpg";
        }
        if(isset($_FILES['picture'])  ){
            $image = move_uploaded_file($_FILES['picture']['tmp_name'][4], './images/items/' . $_FILES['picture']['name'][4]);
        }
        //var_dump('<pre>',$_REQUEST);
        $query = sprintf("Update %s set 
                                        images = '%s',
                                        image2 = '%s',
                                        image3 = '%s',
                                        image4 = '%s',
                                        image5 = '%s' 
                                        where id = %d", Items::$table_name,
                                                        $nameImage,
                                                        $nameImage2,
                                                        $nameImage3,
                                                        $nameImage4,
                                                        $nameImage5,
                                                    $_REQUEST['id']);
        //die("echo $query");
        

        $item->query($query);
        header('location: admin.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Item Detail</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
    <?php include 'design.css' ?>
    </style>
</head>
<body>
<?php include 'inc/nav.php'?>
<h3>Daily_View: <?php $view = $row['daily_count']; echo $view; ?></h3>
    <table class = "table table-hover">
                 <tr>
                    <th>TITLE</th>
                    <th>PRICE</th>
                     <th>PICTURE_1</th>
                     <th>PICTURE_2</th>
                     <th>PICTURE_3</th>
                     <th>PICTURE_4</th>
                     <th>PICTURE_5</th>
                     
                 </tr>
    <?php
    printf("<tr>
        <td>%s</td>
        <td>$%.2f</td>
        <td><img src='" . IMAGES_ITEM_PATH . "/%s' width='100px' height = '100px' alt='item'> </td>
        <td><img src='" . IMAGES_ITEM_PATH . "/%s' width='100px' height = '100px' alt='item'> </td>
        <td><img src='" . IMAGES_ITEM_PATH . "/%s' width='100px' height = '100px' alt='item'> </td>
        <td><img src='" . IMAGES_ITEM_PATH . "/%s' width='100px' height = '100px' alt='item'> </td>
        <td><img src='" . IMAGES_ITEM_PATH . "/%s' width='100px' height = '100px' alt='item'> </td>
        
        </tr>",$item_info['title'], $item_info['price'], $item_info['images'],$item_info['image2'],$item_info['image3'],$item_info['image4'],$item_info['image5']); 
    ?>
    
    
</body>
</html>

