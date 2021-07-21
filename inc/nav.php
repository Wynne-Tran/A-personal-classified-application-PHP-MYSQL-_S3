
<ul>
        <li><b class="titlename"><a href='index.php'>My Classifieds</a></b></li>      
        <li><a href="index.php">Home</a></li>
        <li><a href="items.php">Items</a></li>
        <li><a href="categories.php">Categories</a>
        </li>
        <li><a href="search.php">Search</a></li>
        <?php if(can_access()):?>
            <li class = "login" ><a  href="login.php">Hi <?=$_SESSION['user_name']?>,  Logout</a></li>
        <?php else:?>
            <li class = "login" ><a  href="login.php">Login</a></li>
        <?php endif;?>
        
    </ul>