<?php
$conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
  mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));
 $id=$_GET["emp"];
 $sh=$_GET["shop"];
 $sql="SELECT * FROM shelf WHERE shelf.shop_id='$sh'";
 $result=mysqli_query($conn,$sql);
 echo "<center>ADD A SHELF</center>";
 if(mysqli_num_rows($result)>0)
 {
     echo"<center> shelf present in the shop are:</center><br>";
     while($rows=mysqli_fetch_assoc($result))
     {
         echo"<center>". $rows["shelf_name"]."</center><br>";
     }
 }
 else
{
   echo "no shelf present in the shops";
}
echo "
 <html>
<head>
<style>
body {
  background:#ffe6e6;
 
}
</style>
</head>


<body>
<center>
 <form method ='POST'>
   <label for='s'>type the shelf_name:</label><input type='text' id='s' name='s'><br><br>
    <button type ='submit' name='login'>SUBMIT</button><br><br>
 </form>
</center>
</body>
</html>
";
 echo "<center><a href='DBMS5.php?emp=$id'><button>BACK</button></a><center>";

 if(isset($_POST["login"]))
 {
     $n=$_POST["s"];
      $sql= "INSERT INTO shelf(shop_id, shelf_name) VALUES ('$sh','$n')"; 
      $result=mysqli_query($conn,$sql);
      
      echo"<center>Updated successfully</center><br>";
      
       
 }
 
 

?>