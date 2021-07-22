
<?php
include 'inc/functions.php';
include_once 'class/items.php';
checkMaintain(); 


if(isset($_POST['change'])){
    $member = new Members();
    $count = 0;
        $result = $member->getAllMem();
        while( $row = $result->fetch_assoc() ){
            if($row['username'] == $_REQUEST['username'] && $row['password'] == $_REQUEST['oldpass']) {
                 
                $query = sprintf("Update %s set 

                first_name = '%s', 
                last_name = '%s',
                username = '%s',
                email = '%s',
                password = '%s',
                memberscol  = '%s'
                where id = %d",
                 Members::$table_name,
                 
                  $row['first_name'],
                  $row['last_name'],
                  $row['username'],
                  $row['email'],
                  $_REQUEST['newpass'],
                  $row['memberscol'],
                  $row['id'],
                                );
                
                $member->query($query);
                ?> 
                <script>alert ("Password changed!");</script>
                <?php 
                $count++;
                break;
            }
            
        }
        if ($count == 0){
            ?>
                <script>alert  ("Username or old password incorrect !");</script>
            <?php 
        }
  
}

?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Change Password</title>
        <style>
            <?php 
            include 'design.css';
            ?>
            
        </style>
    </head>
    <body>
    <?php include 'inc/nav.php' ?>

<br>
<form class = "items" action="" method="post">
        <table>
        <tr>
        <td><label for="username">UserName</label></td>
        <td><input type="text" name="username"></td>
        </tr>
        <br>
        <tr>
        <td><label for="username">Old Password</label></td>
        <td><input type="text" name="oldpass"></td>
        </tr>
        <br>
        <tr>
        <td><label for="username">New Password</label></td>
        <td><input type="text" name="newpass"></td>
        </tr>
        <br>
        <tr>
        <td><input type="submit" name= "change" value="Change"></td>
        </tr>
        
    </table>
</form>

</body>
</html>
