
<header class="top-nav">
    <div class="row">
        <div class="u-pull-right dropdown dropbtn" onclick="dropdownFunction()">
            <a href="#" class="user-name dropbtn"> <?php echo $_SESSION['full_name'] ?> </a>
            &nbsp;
            <img src="../public/images/caret-down.png" alt="" class="dropbtn" width="12px">
            <div id="myDropdown" class="dropdown-content">
                <a href="change-password.php">Change Password</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</header>