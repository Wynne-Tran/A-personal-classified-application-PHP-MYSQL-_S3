<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include 'inc/functions.php';
include_once 'class/items.php';
?>
<?php
    
    if(isset($_POST['Add']))
    {
        $nameImage = $_FILES['picture']['name'][0];
        if ($nameImage == null){
            $nameImage = "none.jpg";
        }
        //code for upload images
        if(isset($_FILES['picture'])  ){
            $image = move_uploaded_file($_FILES['picture']['tmp_name'][0], './images/category/' . $_FILES['picture']['name'][0]);
        }
        $con = mysqli_connect('127.0.0.1','root','','test');
        $id = mysqli_insert_id($con);
        $query1 = sprintf("insert into %s set id = '%s',
                                        name = '%s', 
                                        descrip = '%s',
                                        images = '%s',
                                        status = '%s'"
                                        , Categories::$table_name,
                                                        $id,
                                                        $_REQUEST['name'],
                                                        $_REQUEST['descrip'],
                                                        $nameImage,
                                                        $_REQUEST['status']
                                                        );
        
        mysqli_query($con,$query1);
        //echo ($query1);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
    <?php include 'design.css' ?>
    </style>
</head>
<body>
<?php include 'inc/navAdmin.php' ?>
    <form  method=post class = "items"  enctype="multipart/form-data">

    <table>
    <tr><td></td><th><h3>Add Category</h3></th>
    </tr>
    <tr>
    <td>Name:
    </td>
    <td><input type='text' name='name' value="" required>
    </td>
    
    <tr><td>Description:</td>
    <td><textarea name='descrip' required></textarea></td >
    
    <tr><td>Status:</td>
    <td>SHOW <input type = 'radio' name = 'status' value = "1">
                HIDE <input type = 'radio' name = 'status' value = "2"><br></td>
    </tr>
    
    <tr><td>Picture:</td>
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

