<?php
   $id=$_GET["edit"];
   $conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
   mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));
  if(isset($_GET["edit"]))
{
  $id=$_GET["edit"];
  $sql="SELECT * FROM medicine where medicine.med_id='$id'";
  $result=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($result);
  $m1=$row["med_name"];
  $m2=$row["m_date"];
  $m3=$row["e_date"];
  $m4=$row["m_company"];
  $m5=$row["type"];
  $m6=$row["formula"];
  $m7=$row["t_quantity"];
  $m8=$row["price"];
  $m9=$row["BANNED_OR_NOT"];
}

echo
"<html>

<head>
<style>
body {
  background: url('ph4.png');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
}
</style>
</head>
<center>
<body>
<h1>UPDATE MEDICINE</h1>
<form  method='POST'>

<label for='name'>NAME OF THE MEDICINE:</label><input type='text' id='name' value='$m1' name='name'><br><br>
<label for='edate'>EXPIRY DATE:</label><input type='text' id='edate' value='$m3' name='edate'><br><br>
<label for='mdate'>MANUFACTURED DATE:</label><input type='text' id='mdate' value='$m2' name='mdate'><br><br>
<label for='mcom'>MANUFACTURED COMPANY:</label><input type='text' id='mcom' value='$m4' name='mcom'><br><br>
<label for='type'>MEDICINE TYPE:</label><input type='text' id='type' value='$m5' name='type'><br><br>
<label for='formula'>FORMULA:</label><input type='text' id='formula' value='$m6' name='formula'><br><br>
<label for='t_quantity'>TOTAL QUANTITY:</label><input type='text' value='$m7' id='t_quqntity' name='t_quantity'><br><br>
<label for='price'>PRICE:</label><input type='text' value='$m8' id='price' name='price'><br><br>
<label for='ban'>BANNED OR NOT:</label><input type='text' value='$m9' id='ban' name='ban'><br><br>
<button type='submit' name='login'>SUBMIT</button><br><br>
</form>
<a href='DBMS42.html'><button>BACK</button></a>
</body>
</center>
</html> ";



if(isset($_POST["login"]))
{
  $e1=$_POST["name"];
  $e2=$_POST["edate"];
  $e3=$_POST["mdate"];
  $e4=$_POST["mcom"];
  $e5=$_POST["type"];
  $e6=$_POST["formula"];
  $e7=$_POST["t_quantity"];
  $e8=$_POST["price"];
  $e9=$_POST["ban"];
  $conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
   mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));
   $sql="UPDATE medicine SET med_name='$e1',m_date='$e3',e_date='$e2',m_company='$e4',type='$e5',formula='$e6',t_quantity='$e7',price='$e8',BANNED_OR_NOT='$e9' WHERE medicine.med_id='$id'";
   $result=mysqli_query($conn,$sql);
   echo "updated successfully";
}

?>