function getName(id) {
    if( id <= 0) {
        document.getElementById('name').innerHTML = "Employee Not Found!";
    } else {
        document.getElementById('name').innerHTML = "...";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var result = JSON.parse(this.responseText);
                document.getElementById("name").innerHTML = result['first_name'] + " " + result['middle_name'] + " " + result['last_name'];
            }
        }
        xmlhttp.open("GET", "http://localhost/leave-application-services/classes/Employees.php?id=" + id, true);
        xmlhttp.setRequestHeader("Content-type","application/json");
        xmlhttp.send();
    }
}

