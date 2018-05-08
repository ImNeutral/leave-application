<?php
session_start();
//session_unset();
$accountTypeId = 0;
if(isset($_SESSION['account_type_id'])) {
    $accountTypeId = $_SESSION['account_type_id'];
}
if($accountTypeId == 1) { // user
    header("location: leave-application.php");
} else if($accountTypeId == 2) { // principal
    header("location: manage-applications-principal.php");
} else if($accountTypeId == 3) { // hr
    header("location: manage-applications-hr.php");
} else if($accountTypeId == 4) { // sds
    header("location: manage-applications-sds.php");
} else if($accountTypeId == 5) { // account manager
    header("location: manage-accounts.php");
} else {
    //do nothing
}

?>


<?php include ('layouts/header.php'); ?>

<section class="section section-loginform">
    <div class="container">
        <div class="row loginform eleven columns offset-by-three">
<!--            <div class="three columns" >-->
<!--                <img src="../public/images/logo150x179.png" alt="">-->
<!--            </div>-->
            <div class="seven columns form-container">
                <form action="#" method="POST" class="loginform-contents" id="login-form" onsubmit="return false">
                    <h4>Please Login</h4>
                    <div>
                        <label>Username:</label>
                        <input type="text" class="u-full-width" id="username">
                    </div>
                    <div>
                        <label>Password:</label>
                        <input type="password" class="u-full-width" id="password">
                    </div>
                    <div>
                        <a href="forgot-password.php">&nbsp;Forgot Password?</a>
                        <button type="submit" class="button-primary u-pull-right" id="submit-button">Login</button>
                    </div>
                </form>
                <div class="error-message danger" id="error-message" style="display: none;">
                    Username and Password do not match!
                </div>
                <div class="error-message" id="success-message" style="display: none;">
                    Logging in, please wait...
                </div>
            </div>
        </div>
    </div>
</section>


<script>

    (function(){
        var $loginForm = document.getElementById('login-form');

        if($loginForm.addEventListener){
            $loginForm.addEventListener("submit", login, false);  //Modern browsers
        }else if($loginForm.attachEvent){
            $loginForm.attachEvent('onsubmit', login);            //Old IE
        }

        document.body.className += 'login-body';
    })();

    function login() {
        var $errorMessage = document.getElementById('error-message');
        var $successMessage = document.getElementById('success-message');
        var $submitButton = document.getElementById('submit-button');
        $submitButton.innerHTML = "Logging in...";
        var $password = document.getElementById('password');
        var password = $password.value;
        var username = document.getElementById('username').value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var result = JSON.parse(this.responseText);
                if(result) {
                    $errorMessage.style.display = 'none';
                    $successMessage.style.display = 'block';
                    window.location.assign("/leave-application/site/manage-accounts.php");
                } else {
                    $errorMessage.style.display = 'block';
                    $password.value = "";
                    $submitButton.innerHTML = "Login";
                }
            }
        };

        xmlhttp.open("GET", "/leave-application/site/services/AccountChecker.php?username=" + username + "&password=" + password, true);
        xmlhttp.setRequestHeader("Content-type","application/json");
        xmlhttp.send();
    }

</script>
<?php include ('layouts/footer.php');?>
