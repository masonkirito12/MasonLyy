  <style>
.numberCircle {
border-radius: 50%;
behavior: url(PIE.htc);
/* remove if you don't care about IE8 */
padding: 2px;
background: #fff;
border: 2px solid #666;
color: #666;
text-align: center;
font: 15px Arial, sans-serif;
}
</style>
  <div class="logo">
                <center>
                    <a style="text-transform:uppercase; font-size:20px; color:black; font-family:'Bowlby One SC';" href="information_book.php">
                    <?php echo $_SESSION['name']; ?>
                      <span>
                         <a onclick="return confirm('Are you sure you want to Logout');" style="float:right;" href="../logout.php" >
                            <label>Logout</label>
                          <i class="material-icons">input</i>
                        </a>
                      </span> 
                    </a>
                </center>
            </div>
<div class="sidebar-wrapper">
    <ul class="nav">
        <li class="active">
            <a href="information_book.php">
                <i class="material-icons">dashboard</i>
                <p>Book Information</p>
            </a>
        </li>
        <li class="active">
            <a href="add_cart.php">
                <i class="material-icons">shopping_cart</i>
                <p>Book Cart</p>
            </a>
        </li>
        <li class="active">
            <a href="reserve1.php">
                <i class="material-icons">shopping</i>
                <p>Reserve</p>
            </a>
        </li>
        <li class="active">
            <a href="history.php">
                <i class="material-icons">history</i>
                <p>History Record</p>
            </a>
        </li>
        <li class="active">
        <a href="member_notifications.php">
            <i class="material-icons">notifications</i>
            <span>Notifications</span><br><br>
            <?php if(!empty($rowborrow)){ ?>
            <span>Borrowing : 
                <span style="color:red;" class="numberCircle"><?php echo $rowborrow ?></span>
            </span>
            <?php }else{ ?>
            <span>Borrowing : 
                <span style="color:red;" class="numberCircle"> 0 </span>
            </span>
            <?php }?>
            <?php if(!empty($rowpending)){ ?>
            <span>Pending : 
                <span style="color:green;" class="numberCircle"><?php echo $rowpending ?></span>
            </span>
            <?php }else{ ?>
            <span>Pending : 
                <span style="color:green;" class="numberCircle"> 0 </span>
            </span>
            <?php }?>
        </a>
        </li>
    </ul>   
</div>