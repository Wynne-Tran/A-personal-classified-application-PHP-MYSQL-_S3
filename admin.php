<?php 
session_start();
  /// include files
    include 'inc/functions.php';
    include_once 'class/items.php';
    $status= new Maintain();
    $result = $status->getstatus();
    
    $row = $result->fetch_assoc();
    if (isset($_POST['maintain'])){
        If($row['status'] == "SHOW"){
         $row['status'] = 2;
        }
        else{
            $row['status'] = 1;
        }
        
            $query = sprintf("Update %s set 
            status = '%s' WHERE '%s'", Maintain::$table_name,
            $row['status'], '1');
        
        $status->query($query);
        //echo $query;
        
    }
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
    <?php include 'inc/navAdmin.php';?>
    <h1>Hello, Welcome to My Classified</h1>
    <div><a href='admin2.php' style='float:right' class='btn btn-success'>View all items</a></div>
    
    <form method=post>
    <input type="submit" class='btn btn-success' name='maintain' value = 'Maintain <?php $s=$row['status']; echo $s;?>'>
    </form>
    <?php get_items_Frontpage(5);?>
    
</body>
</html>