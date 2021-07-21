<?php
session_start();
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Search</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <style>
            <?php 
            include 'design.css';
            include 'inc/functions.php';
            
            ?>
        </style>
    </head>
    <body>

<?php
include 'inc/navAdmin.php';
?>



<form method = "post" class = "login">
    <input type="text" name = "keyword">
    <button>Search</button>
</form>
<?php
if (isset($_POST['keyword'])){
$keyword = $_POST['keyword'];
echo "SEARCH FOR: $keyword";
// search by enter keyword
admin_search($keyword);
}
?>



</body>
</html>
