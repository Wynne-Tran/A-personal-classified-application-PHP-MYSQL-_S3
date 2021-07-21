<?php 
session_start();
  // include files
  include_once 'class/items.php';
    include 'inc/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Category</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <style>
            <?php include 'design.css';?>
        </style>
    </head>
    <body>
    <?php include 'inc/navAdmin.php';?>
    <a href='categories_form.php' style='float:right' class='btn btn-success'>Add New Category</a>
<br>
<?php get_categories();?>
</body>
</html>