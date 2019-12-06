<style>
.numberCircle {
border-radius: 50%;
behavior: url(PIE.htc);
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
        <a style="text-transform:uppercase; font-size:20px; color:black; font-family:'Bowlby One SC';" href="dashboard.php">
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
           <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="material-icons">dashboard</i>
             <p>Book Information</p>
            </a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
               <li style="margin-top: 25px;
                          margin-left: 30px;">
            <a href="dashboard.php">
                <i class="material-icons">photo_album</i>
                <p style="margin: -20px;">Book List</p>
            </a>
        </li>
        <li style="margin: 30px;">
            <a href="add_category.php">
                <i class="material-icons" >add_box</i>
                <p style="margin-top: -20px;">Add Book</p>
            </a>
        </li>
        <li style="margin: 30px;">
            <a href="add_book.php">
                <i class="material-icons" style="margin-top: -20px">note_add</i>
                <p style="margin: -40px;">Add Quantity</p>
            </a>
        </li>
                 
            </ul>
        </li>
       
        <?php if($_SESSION['type'] == "superadmin"){?>
        <li class="active">
        <a href="#main" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="material-icons">person</i>
        <p>Admin</p>
        </a>
        <ul class="collapse list-unstyled" id="main">
        <li style="margin: 20px;">
        <a href="admin.php">
        <i class="material-icons">person</i>
        <p style="margin: -18px;">Add Admin</p>
        </a>
        </li>
        <li  style="margin: 20px;">
        <a href="admin_list.php">
        <i class="material-icons">library_books</i>
        <p style="margin-top: -18px;">Admin List</p>
        </a>
        </li> 
        </ul>
        </li>
       
      
        <li class="active">
         <a href="#kim" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="material-icons">person</i>
             <p>User</p>
             </a>
               <ul class="collapse list-unstyled" id="kim">
               <li style="margin: 20px;">
            <a href="user.php">
                <i class="material-icons">person</i>
                <p style="margin-top: -18px;">Add User</p>
            </a>
        </li>
        <li style="margin: 20px;">
            <a href="information_user.php">
                <i class="material-icons">library_books</i>
                <p style="margin-top: -18px;">User List</p>
            </a>
        </li> 
        </ul>
        </li>
       
       
        <?php }else{?>
        <li class="active">
          <a href="#home" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="material-icons">person</i>
             <p>User</p>
            </a>
             <ul class="collapse list-unstyled" id="home">
             <li>
            <a href="user.php">
                <i class="material-icons" style="margin: 30px;">perm_contact_calendar</i>
                <p style="padding: 8px;">Add User</p>
            </a>
        </li>
         <li>
            <a href="information_user.php">
                <i class="material-icons" style="margin-left: -60px;">supervisor_account</i>
                <p style="margin: -22px;">User List</p>
            </a>
        </li>
        </ul>
        </li> 
       
        <?php }?>
        <li class="active">
         <a href="#notifications" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
           <i class="material-icons" style="margin-top: -5px;">
                import_contacts</i>
                  <span>Confirmation</span>
                </a>
                 <ul class="collapse list-unstyled" id="notifications">
                 <li style="margin: 20px;">
            <a href="notifications.php">
              <i class="material-icons">book</i>
                <?php if(!empty($rows)){?>
                <span style="color:red; float:right;" class="numberCircle"><?php if(!empty($rows))
                {echo $rows;}else{"";} ?></span>
                <?php }else{"";}?>
                <p style="margin: -18px;">Borrow Book</p>
            </a>
        </li>
        <li style="margin: 20px;">
            <a href="return_book.php">
              <i class="material-icons">restore_page</i>
                <p style="margin: -18px;">Return Book</p>
            </a>
        </li>
                   </ul>
        </li>
         <li class="active">
            <a href="#jam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="material-icons">local_library</i>
                <p>Book Record</p>
            </a>
             <ul class="collapse list-unstyled" id="jam">
         <li style="margin: 20px;">
            <a href="table.php">
               <i class="material-icons">content_paste</i>
                <p style="margin: -18px;"> All Record</p>
            </a>
        </li>
        
        <li style="margin: 20px;">
            <a href="book_list.php">
              <i class="material-icons">history</i>
                <p style="margin: -18px;">All Reserve </p>
            </a>
        </li>
       
         </ul>
         </li>
        <li class="active">
            <a href="return_notifications.php">
                <i class="material-icons text-gray" style="margin-top: -5px;">notifications_active</i>
                <span>Expired</span>
                <?php if(!empty($rows1)){ ?>
                <span style="color:red; float:right;" class="numberCircle"><?php if(!empty($rows1))
				{echo $rows1;}else{"";} ?></span>
                <?php }else{"";}?>
            </a>
        </li>
        <li class="active">
            <a href="resit.php">
              <i class="material-icons text-gray" style="margin-top: -5px;">credit_card</i>
              <span>Receipt</span>
            </a>
        </li>
    </ul>
</div>
<script>
    var deleteLinks = document.querySelectorAll('.delete');
    
    for (var i = 0; i < deleteLinks.length; i++) {
        deleteLinks[i].addEventListener('click', function(event) {
            event.preventDefault();
            
            var choice = confirm(this.getAttribute('data-confirm'));
            
            if (choice) {
                window.location.href = this.getAttribute('href');
            }
        });
    }
</script>

