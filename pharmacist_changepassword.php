<?php
  $id=$_GET["emp"];
  
echo"

<html>
<head>
<style>

<style>

input
{
   height:30px;
   width:300px;
   background-color:Aliceblue;
}


body {
  background: url('Ph3.jpeg');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
}

.center {
  margin: 0;
  position: absolute;
  top: 45%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  border:2px solid black;
  border-radius:16px;
   background-image: url('Ph3.jpeg');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
  padding:10px 20px;
} 

button {
  border: 2px solid black;
  color: black;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius:12px;
  background-color:lightskyblue;
}
</style>
</head>


<center>
<body>
<div class='center'>
<h1>EMPLOYEE CHANGE LOGIN</h1>
<form action='pharmacist_changepassword2.php?emp=$id' method='POST'>
<label for='u'>USERNAME:</label><input type='text' id='u' name='u'><br><br>
<label for='p'>OLD PASSWORD:</label><input type='password' id='p' name='p1'><br><br>
<label for='p'>NEW PASSWORD:</label><input type='password' id='p' name='p2'><br><br>
<button type='submit' name ='login'>SUBMIT</button><br>
</form>
<center><a href='DBMS5.php?emp=$id'><button>BACK</button></a></center>
</div>
</body>
</center>
</html>";
?>
