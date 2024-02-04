<?php
 $conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
  mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));
 $id=$_GET["emp"];
 $sh=$_GET["shop"];
 $m=$_GET["edit"];
 $n=$_GET["name"];
 $sql="DELETE FROM kept_shop_medicine WHERE shop_id='$sh'AND shelf_name='$n'AND med_id='$m'";
 $result=mysqli_query($conn,$sql);
 echo "<center>Deleted successfully</center>";
 
 
 echo "<center><a href='php_medicine_search.php?emp=$id'><button>BACK</button></a><center>";
?>