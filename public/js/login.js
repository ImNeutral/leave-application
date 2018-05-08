// (function() {
//
//
// })();


(function(){
    var $loginForm = document.getElementById('login-form');

    if($loginForm.addEventListener){
        $loginForm.addEventListener("submit", login, false);  //Modern browsers
    }else if($loginForm.attachEvent){
        $loginForm.attachEvent('onsubmit', login);            //Old IE
    }

})();

function login() {
    var $errorMessage;
    var $submitButton = document.getElementById('submit-button');
    $submitButton.innerHTML = "Logging in...";
    $password = document.getElementById('password');
    password = $password.value;
    username = document.getElementById('username').value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var result = JSON.parse(this.responseText);
            if(result) {
                window.location.assign("/leave-application/site/manage-accounts.php");
            } else {
                $errorMessage = document.getElementById('error-message');
                $errorMessage.style.opacity = '1';
                $password.value = "";
                $submitButton.innerHTML = "Login";
            }
        }
    }

    xmlhttp.open("GET", "/leave-application/site/services/Accounts.php?username=" + username + "&password=" + password, true);
    xmlhttp.setRequestHeader("Content-type","application/json");
    xmlhttp.send();
}
