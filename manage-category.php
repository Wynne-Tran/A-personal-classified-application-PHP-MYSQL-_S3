<?php session_start();
include 'inc/functions.php';
include_once 'class/items.php';
?>
<?php
    include_once __DIR__. '/class/items.php';
    
    $category = new Categories();
    $category_info = $category->getByIdCat($_REQUEST['id'])->fetch_assoc();
    
    if(empty($category_info)) die('cannot access');
    if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete')
    {
        ?> <script>alert ("Category  deleted...");</script>
        
        <?php
        $category->query('delete from catagory where id = ' . $_REQUEST['id']);
        
        header('location: adminCategories.php');
    }
    if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'save')
    {
        $nameImage = $_FILES['picture']['name'][0];
        //code for upload images
        if(isset($_FILES['picture'])){
            $image = move_uploaded_file($_FILES['picture']['tmp_name'][0], './images/category/' . $_FILES['picture']['name'][0]);
        }
        //var_dump('<pre>',$_REQUEST);
        $query1 = sprintf("Update %s set name = '%s', 
                                        descrip = '%s',
                                        images = '%s',
                                        status = '%s'
                                        where id = %d", Categories::$table_name,
                                                        $_REQUEST['name'],
                                                        $_REQUEST['descrip'],
                                                        $nameImage,
                                                        $_REQUEST['status'],
                                                        $_REQUEST['id']);
        //echo $query1;
        
        $category->query($query1);
        header('location: adminCategories.php');
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
    <tr>
    <td></td>
    <th><h3>Edit Category</h3></th>
    </tr>
    
    <tr>
    <td>Name:</td>
    <td><input type='text' name='name' value="<?=$category_info['name']?>"></td>
    </tr>
    <tr>
    <td>
    Description:
    </td>
    <td>
    <textarea name='descrip'><?=$category_info['descrip']?></textarea>
    </td>
    </tr>
    <tr>
    <td>
    Status:
    </td>
    <td>
    SHOW<input type = 'radio' name = 'status' value = "1">
    HIDE<input type = 'radio' name = 'status' value = "2">
    </td>
    </tr>
    <tr>
    <td>
    Picture:
    </td>
    <td>
    <input type="file" name="picture[]">
        <input type='hidden' name='id' value="<?=$category_info['id']?>">
        <br>
        <input type="submit" value="update">
    </td>
    </tr>
    </table>
    </form>
</body>
</html>