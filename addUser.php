<?php
session_start(); 
   
include 'inc/functions.php';
include_once 'class/items.php';
checkMaintain(); 
?>
<?php
    $member = new Members();
    if(isset($_POST['Add']))
    {
        
        //$con = mysqli_connect('gblearn.com','f0161665_admin','m5vlS]iH8{Z8','f0161665_test');
        $con = mysqli_connect('127.0.0.1','root','','test');
        $id = mysqli_insert_id($con);
        $query = sprintf("insert into %s set 
        id = '%d',
        first_name = '%s', 
        last_name = '%s',
        username = '%s',
        email = '%s',
        password = '%s',
        memberscol  = '%s'",
         Members::$table_name,
         $id,
                        $_REQUEST['first_name'],
                        $_REQUEST['last_name'],
                        $_REQUEST['username'],
                        $_REQUEST['email'],
                        $_REQUEST['password'],
                        $_REQUEST['memberscol']
                        
                        );
        
        mysqli_query($con,$query);
        //echo $query;
        
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
    <?php include 'design.css' ?>
    </style>
</head>
<body>
<?php include 'inc/nav.php' ?>
<br>
<form class = "items" action="" method="post">
        <table>
        <tr><td></td>
        <th><h3>Please enter:</h3></th></tr>
        <br>
        <tr>
        <td><label >First Name:</label></td>
        <td><input type="text" name='first_name' required></td>
        </tr>
        <tr>
        <td><label>Last Name</label></td>
        <td><input type="text" name='last_name' required></td>
        </tr>
        <tr>
        <td><label>UserName</label></td>
        <td><input type="text"name='username' required></td>
        </tr>
        <tr>
        <td><label >Email </label></td>
        <td><input type="text"  name='email' placeholder = "abc@gmail.com" required></td>
        </tr>
        <tr>
        <td><label>Password</label></td>
        <td><input type="text" name='password' required></td>
        </tr>
        <br>
        <tr>
        <td><label>Memberscol</label></td>
        <td><input type="text" name='memberscol' required></td>
        </tr>
        <br>
        <tr>
        <td></td>
        <td><input class = "modify" type="submit" name = 'Add' value="Add"></td>
        </tr>
        
    </table>
</form>



</body>
</html>
