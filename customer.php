<?php
 $conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
   mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));
$b=$_GET["b"];
 $id=$_GET["emp"];
echo"<center>";
echo"<h1>CUSTOMER DETAILS</h1>";
echo"
<html>

<head>
<style>
body {
  background-image: url('Ph2.jpeg');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
}

input
{
   height:30px;
   width:300px;
   background-color:Aliceblue;
}


button
{
   background-color:Aliceblue;
   border:2px solid black;
   padding:10px 10px;
}
</style>
</head>
<right>
<body style='color:white'>
  <form action='' method='POST'>
<label for='mid'><b>CUSTOMER NAME:</b></label><input type='text' id='mid' name='name'><br><br>
<label for='mname'><b>PHONE NUMBER:</b></label><input type='text' id='mname' name='ph'><br><br>
<button type ='submit' name='login'>SUBMIT</button><br><br>
</form>

</body>
</right>
</html>";

if(isset($_POST["login"]))
{
   $c=$_POST["name"];
   $p=$_POST["ph"];
   $sql="UPDATE bills SET bills.cust_name='$c',bills.cust_ph_no='$p' WHERE bill_id='$b'";
   $result=mysqli_query($conn,$sql);
   header("LOCATION:invoice.php?emp=$id&b=$b");
}
?>