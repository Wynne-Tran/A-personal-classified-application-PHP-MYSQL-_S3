<?php
session_start(); 
    
?>
<?php 
  
  include 'inc/functions.php';
  include_once __DIR__. '/class/items.php';
  include_once 'class/items.php';
  if(isset($_POST['Login'])){
      $member = new Members();
          $result = $member->getAllMem();
          while( $row = $result->fetch_assoc() ){
              if($row['username'] == $_REQUEST['username'] && $row['password'] == $_REQUEST['password']) {
                $_SESSION['username'] = true;
                $_SESSION['username'] = $username;
                  header("Location:admin.php");
              }
          }
          ?>
          <script>alert  ("Username or password incorrect !");</script> 
          <?php
        }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Log In</title>
        <style>
            
            <?php include 'design.css';?>
        </style>
    </head>
    <body>
    <?php include 'inc/nav.php';?>
    <a href='addUser.php'><h3>Sign Up</h3> </a>
     <form class = "items" action= "" method="POST">
        <table>
        <tr>
        <th><h3>Please enter: </h3></th>
        </tr>
        <tr>
        <td><label for="username">UserName</label></td>
        <td><input type="text" id="username" name="username" placeholder="admin" value='admin'></td>
        </tr>
        <br>
        <tr>
        <td><label for="username">Password</label></td>
        <td><input type="text" id="password" name="password" placeholder="mypassword" value='mypassword'></td>
        </tr>
        <br>
        <tr>
        <td><input type="submit" name = "Login" value="Login"></td>
        <td><a href="changepassword_form.php">Change password</a></td>
        </tr>
        
    </table>
</form>


</body>
</html>

