<?php
 $conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
  mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));
 $id=$_GET["emp"];
 $sh=$_GET["shop"];
 $m=$_GET["edit"];
 $sql="SELECT * FROM shelf WHERE shelf.shop_id='$sh'";
 $result=mysqli_query($conn,$sql);
 echo "<center>Medicine_id=".$m."</center>";
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
if(isset($_POST["login"]))
 {
    
     $t=$_POST["s"];
   $sql= "INSERT INTO kept_shop_medicine(shop_id, shelf_name, med_id) VALUES ('$sh','$t','$m')"; 
   $result=mysqli_query($conn,$sql);
   
    

      echo"<center>Updated successfully</center><br>";
 }
 echo "<center><a href='php_medicine_search.php?emp=$id'><button>BACK</button></a><center>";
?>