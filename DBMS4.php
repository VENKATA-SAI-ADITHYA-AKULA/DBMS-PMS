<?php

//include "php_employee_login.php";
//echo "$u $p";

?>
<!DOCTYPE html>
<html>
<head>
<style>

h1
{
  font-family:monospace;
  font-size:30px;
  color:black;
}

body
{
 background-image:url("Ph6.jpg");
 background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
  background-opacity:0.5;
}

.button:hover {background-color: grey}

.button:active {
  background-color: grey;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

.center {
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
} 

img
{
    width:50%;
    height:30%;
}


</style>
</head>

<center>
<body>
<div class="center">
<h2>HELLO MANAGER</h2>
<h1>Click on any image button you want to work on</h1>
<table>

<tr>
<td><a href="php_notification.php"><button class="button"><img src="notification.png"></button></a></td>
<td><h2>Notification</h2></td>
</tr>

<tr>
<td><a href="DBMS42.html"><button class="button" ><img src="medicine.png"></button></a></td>
<td><h2>Medicine</h2></td>
</tr>

<tr>
<td><a href="php_generate_report.php"><button class="button"><img src="report.png"></button></a></td>
<td><h2>Generate Report</h2></td>
</tr>

<tr>
<td><a href="php_shop_management.html"><button class="button"><img src="shopmanagement.png"></button></a></td>
<td><h2>Shop management</h2></td>
</tr>

<tr>
<td><a href="DBMS45.html"><button class="button"><img src="changepassword.png"></button></a></td>
<td><h2>Change Password</h2></td>
</tr>

<tr>
<td><a href="DBMS3.php"><button class="button"><img src="goback.png"></button></a></td>
<td><h2>Go back</h2></td>
</tr>

</table>
</div>
</body>
</center>
</html>