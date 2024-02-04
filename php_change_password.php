<?php

$conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
   mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));
if(isset($_POST["login"]))
 {
    $u=$_POST["u"];
    $p1=$_POST["p1"];
    $p2=$_POST["p2"];
    $sql="SELECT * FROM (employee INNER JOIN employee_subschema ON employee.username=employee_subschema.username) WHERE employee.e_id=employee.mang_id AND employee_subschema.username='$u' AND employee_subschema.password='$p1'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)==1)
    {
        $sql2="UPDATE employee_subschema SET employee_subschema.password='$p2' WHERE employee_subschema.username='$u'";
         $result2=mysqli_query($conn,$sql2);
        echo"PASSWORD IS CHANGED<br>";
    }
    else
    {
       echo "username and password is wrong pls type correctly";
    }

 }
?>

<html>
<center>
<body>
<a href="DBMS4.php"><button>BACK</button></a><br><br>
</body>
</center>
</html>