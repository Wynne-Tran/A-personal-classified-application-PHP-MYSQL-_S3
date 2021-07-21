<?php session_start();
include 'inc/functions.php';
include_once 'class/items.php';
?>
<?php
    
    
    $item = new Items();
    if(isset($_POST['Add']))
    {
        $nameImage = $_FILES['picture']['name'][0];
        if ($nameImage == null){
            $nameImage = "none.jpg";
        }
        //code for upload images
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
        
        //$con = mysqli_connect('gblearn.com','f0161665_admin','m5vlS]iH8{Z8','f0161665_test');
        $con = mysqli_connect('127.0.0.1','root','','test');
        $id = mysqli_insert_id($con);
        $query = sprintf("insert into %s set 
        id = '%d',
        title = '%s', 
        descrip = '%s',
        price = '%.2f',
        images = '%s',
        cat_id = '%s',
        status = '%s',
        front_page = '%s', 
        image2 = '%s',
        image3 = '%s',
        image4 = '%s',
        image5 = '%s'",
         Items::$table_name,
         $id,
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
                        $nameImage5
                        );
        
        mysqli_query($con,$query);
       

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
<?php include 'inc/navAdmin.php' ?>


    <form  method=post class = "items"  enctype="multipart/form-data">

    <table>
    <tr><td></td><th><h3>Add Item</h3></th>
    </tr>
    <tr>
    <td>Title:
    </td>
    <td><input type='text' name='title' value="" required>
    </td>
    </tr>
    <tr><td>Price:</td>
    <td><input type='text' name='price' value=""></td>
    </tr>
    <tr><td>Description:</td>
    <td><textarea name='descrip' required></textarea></td >
    </tr>
    <tr><td>Category: </td>
    <td>
    <select  name='cat_id'>
        <?php
        $category = new Categories();
        $result1 = $category->getAllCat();
        while( $row1 = $result1->fetch_assoc() ){ ?>
            <option><?php $id = $row1['id']; echo $id;?></option>
            <?php
            
        }
        ?>
    </select>
    </td>
    </tr>
    <tr><td>Status:</td>
    <td>SHOW <input type = 'radio' name = 'status' value = "1">
                HIDE <input type = 'radio' name = 'status' value = "2"><br></td>
    </tr>
    <tr><td>Front_page: </td>
    <td>YES <input type = 'radio' name = 'front_page' value = "1">
                NO <input type = 'radio' name = 'front_page' value = "2"><br></td>
    </tr>
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
    <td></td>
    <td><br>
        <input class = "modify" type="submit" name = "Add" value="Add"></td></tr>
    </table>

    </form>
</body>
</html>

