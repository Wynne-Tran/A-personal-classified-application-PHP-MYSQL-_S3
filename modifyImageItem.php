<?php session_start();
include 'inc/functions.php';
include_once 'class/items.php';
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
    <title>Add Item</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
    <?php include 'design.css' ?>
    </style>
</head>
<body>
<?php include 'inc/navAdmin.php'?>
<?php //modifyImageAdmin(); 
?>
    <table class = "table table-hover">
                 <tr>
                    <th>TITLE</th>
                     <th>PICTURE_1</th>
                     <th>PICTURE_2</th>
                     <th>PICTURE_3</th>
                     <th>PICTURE_4</th>
                     <th>PICTURE_5</th>
                     
                 </tr>
    <?php
    printf("<tr>
        <td>%s</td>
        <td><img src='" . IMAGES_ITEM_PATH . "/%s' width='100px' height = '100px' alt='item'> </td>
        <td><img src='" . IMAGES_ITEM_PATH . "/%s' width='100px' height = '100px' alt='item'> </td>
        <td><img src='" . IMAGES_ITEM_PATH . "/%s' width='100px' height = '100px' alt='item'> </td>
        <td><img src='" . IMAGES_ITEM_PATH . "/%s' width='100px' height = '100px' alt='item'> </td>
        <td><img src='" . IMAGES_ITEM_PATH . "/%s' width='100px' height = '100px' alt='item'> </td>
        
        </tr>",$item_info['title'], $item_info['images'],$item_info['image2'],$item_info['image3'],$item_info['image4'],$item_info['image5']); 
    ?>
    </table>
    <form  action = '' method=post class = "items"  enctype="multipart/form-data">
    
    <table>
    <th>ADD OR EDIT IMAGE</th>
    <tr><td>Picture 1:</td>
    <td>
    <input type="file" name="picture[]">
    </td>
    </tr>
    <tr><td>Picture 2:</td>
    <td>
    <input type="file" name="picture[]">
    </td>
    </tr>
    <tr><td>Picture 3:</td>
    <td>
    <input type="file" name="picture[]">
    </td>
    </tr>
    <tr><td>Picture 4:</td>
    <td>
    <input type="file" name="picture[]">
    </td>
    </tr>
    <tr><td>Picture 5:</td>
    <td>
    <input type="file" name="picture[]">
    </td>
    </tr>
    <tr>
    <td>
    
    <input type='hidden' name='id' value="<?=$item_info['id']?>"><br>
    <br>
    
</td>
    <td><br>
        <input class = "modify" type="submit" name = "Add" value="Add"></td></tr>
    </table>

    </form>

    
</body>
</html>

