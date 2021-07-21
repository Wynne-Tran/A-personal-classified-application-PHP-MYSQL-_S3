<?php 
    include 'inc/functions.php';
    include_once 'class/items.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Home</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <style>
            <?php include 'design.css';?>
        </style>
    </head>
    <body>
    <?php include 'inc/nav.php';?>
    <h1>Hello, Welcome to My Classified</h1>
    
    <?php get_items_Frontpage(5);?>

</body>
</html>