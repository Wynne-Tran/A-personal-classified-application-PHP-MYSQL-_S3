<?php session_start();
include 'inc/functions.php';
?>
<?php
  include_once 'class/items.php';
    
    $item = new Items();
    $item_info = $item->getById($_REQUEST['id'])->fetch_assoc();
    
    if(empty($item_info)) die('cannot ');
    if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete')
    {
        $item->query('delete from items where id = ' . $_REQUEST['id']);
        ?> <script>alert ("Item <?= print $_REQUEST['title'] ?> deleted...");</script>
        
        <?php
        header('location: adminWatch.php');
    }
    if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'save')
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
        $query = sprintf("Update %s set title = '%s', 
                                        descrip = '%s',
                                        price = '%.2f',
                                        images = '%s',
                                        cat_id = '%s',
                                        status = '%s',
                                        front_page = '%s',
                                        image2 = '%s',
                                        image3 = '%s',
                                        image4 = '%s',
                                        image5 = '%s' 
                                        where id = %d", Items::$table_name,
                                                        $_REQUEST['title'],
                                                        $_REQUEST['descrip'],
                                                        $_REQUEST['price'],
                                                        $nameImage,
                                                        $_REQUEST['cat_id'],
                                                        $_REQUEST['status'],
                                                        $_REQUEST['front_page'],
                                                        
                                                        $nameImage2,
                                                        $nameImage3,
                                                        $nameImage4,
                                                        $nameImage5,
                                                    $_REQUEST['id']);
        //die("echo $query");
        

        $item->query($query);
        header('location: adminWatch.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
    <?php include 'design.css' ?>
    </style>
</head>
<body>
<?php include 'inc/navAdmin.php' ?>


    <form action='?action=save' method=post class = "items"  enctype="multipart/form-data">

    <table>
    <tr><td></td><th><h3>Edit Item</h3></th>
    </tr>
    <tr>
    <td>Title:
    </td>
    <td><input type='text' name='title' value="<?=$item_info['title']?>">
    </td>
    </tr>
    <tr><td>Price:</td>
    <td><input type='text' name='price' value="<?=$item_info['price']?>"></td>
    </tr>
    <tr><td>Description:</td>
    <td><textarea name='descrip'><?=$item_info['descrip']?></textarea></td>
    </tr>
    <tr><td>Category: </td>
    <td><input type='text' name='cat_id' value="<?=$item_info['cat_id']?>"></td>
    </tr>
    <tr><td>Status:</td>
    <td>SHOW<input type = 'radio' name = 'status' value = "1">
                HIDE<input type = 'radio' name = 'status' value = "2"><br></td>
    </tr>
    <tr><td>Front_page: </td>
    <td>YES<input type = 'radio' name = 'front_page' value = "1">
                NO<input type = 'radio' name = 'front_page' value = "2"><br></td>
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
    <td><input type="submit" class = "modify" value="update"></td>
    </tr>
    </table>

    </form>
</body>
</html>