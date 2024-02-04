<?php
 $conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
   mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));
 if(isset($_POST["login"]))
  {
    $m1=$_POST["id"];
    $m2=$_POST["name"];
    $m3=$_POST["edate"];
    $m4=$_POST["mdate"];
    $m5=$_POST["mcom"];
    $m6=$_POST["type"];
    $m7=$_POST["formula"];
    $m8=$_POST["t_quantity"];
    $m9=$_POST["price"];
    if(empty($m1)||empty($m2)||empty($m3)||empty($m4)||empty($m5)||empty($m6)||empty($m7)||empty($m8)||empty($m9))
    {
       echo "type all the boxes !!!";
    }
    else
    {
       $sql="INSERT INTO medicine VALUES('$m1','$m2','$m4','$m3','$m5','$m6','$m7','$m8','$m9')";
       $result=mysqli_query($conn,$sql);
       echo "new medicine added successfully<br>";
       echo "<table border= 1px solid black width='300' cellspacing='0'>";
  echo "<tr>";
  echo      "<th>MEDICINE_ID</th>";
  echo       "<th>NAME OF THE MEDICINE</th>";
  echo       "<th>MANUFACTURED COMPANY</th>";
  echo       "<th>EXPIRY DATE</th>";
  echo       "<th>MANUFACTURED DATE</th>";
  
  echo       "<th>MEDICINE TYPE</th>";
  echo       "<th>FORMULA</th>";
  echo       "<th>TOTAL QUANTITY</th>";
  echo       "<th>PRICE</th>";
  
  echo "</tr>";
  echo "<tr>";
                     echo "<td>".$m1."</td>";
                     echo "<td>".$m2."</td>";
                     echo "<td>".$m5."</td>";
                     echo "<td>".$m3."</td>";
                     echo "<td>".$m4."</td>";
                     echo "<td>".$m6."</td>";
                     echo "<td>".$m7."</td>";
                     echo "<td>".$m8."</td>";
                     echo "<td>".$m9."</td>";
                     

          echo "</tr>";
  echo"</table>";
    }
  }

?>

<html>
<center>
<body>
<a href="DBMS42.html"><button>BACK</button></a><br><br>
</body>
</center>
</html>