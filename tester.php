<?php
$response = file_get_contents('http://localhost/leave-application-services/classes/Employees.php?id=5');
print_r( json_decode($response) );
?>
<html>
<head>
</head>
<body>

<p><b>Start typing a name in the input field below:</b></p>
<form>
    Employee ID: <input type="number" onkeyup="getName(this.value)">
</form>
<p>Name: <span id="name"></span></p>



<script src="public/js/script.js"></script>
</body>
</html>