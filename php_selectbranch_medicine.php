<!DOCTYPE html>
<html>
<head>
<style>
body {
  background: url("Ph14.jpg");
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
}
</style>
</head>
<center>
<body>
<h1>UPDATE QUANTITY OF THE MEDICINE</h1>
<h1>Give negative value for delete but shop_quantity should be 0</h1>
<form action="" method="post" >
<label for="m1"> EXTRA QUANTITY: TO BE ADDED</label><input type="text" id="m1" name="t"><br><br>
<button type="submit" name="insert" class="btn btn-default">SUBMIT</button><br><br>
</form>

 
<h3>if u do not know the name of the medicine then type any one letter present in the name !!</h3>

</body>


</center>
</html>
<?php
 $conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
   mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));
 $a1=$_GET["edit"];
 $a2=$_GET["sname"];
 if(isset($_POST["insert"]))
 {
      $f=1;
      $sql1="SELECT * FROM from_shop_medicine WHERE from_shop_medicine.med_id='$a1' AND from_shop_medicine.shop_id='$a2' ";
    $result1=mysqli_query($conn,$sql1);
    $rows=mysqli_fetch_assoc($result1);
      $m=$_POST["t"];
      $r=(int)$rows["shop_quantity"];
      $s=(int)$rows["sold_quantity"];
     if($m<0&&$r==0)
     {
        $f=0;
        $sql2="DELETE  FROM from_shop_medicine WHERE from_shop_medicine.med_id='$a1' AND from_shop_medicine.shop_id='$a2' ";
        $result2=mysqli_query($conn,$sql2);
        //$rows=mysqli_fetch_assoc($result2);
        echo "DELETED SUCCESSFULLY";
     }
      elseif($m<0&&$r>0){
               $f=0;
               $q=$m;
               $sql="UPDATE  from_shop_medicine SET from_shop_medicine.shop_quantity='$r'+'$q' WHERE from_shop_medicine.med_id='$a1' AND from_shop_medicine.shop_id='$a2' ";
               $result=mysqli_query($conn,$sql);
               echo "<center>UPDATED SUCCESSFULLY</center>";
               //echo"<center>you cannot delete this</center>";
        
     }
     elseif($m<0){
          $f=0;
          echo "cannot delete this";  
     }
    
     if($f==1){
     $q=(int)$rows["shop_quantity"]+(int)$m;
   $sql="UPDATE  from_shop_medicine SET from_shop_medicine.shop_quantity='$q' WHERE from_shop_medicine.med_id='$a1' AND from_shop_medicine.shop_id='$a2' ";
   $result=mysqli_query($conn,$sql);
   echo "UPDATED SUCCESSFULLY";
   }
   
 }
echo "<center><a href='php_selectbranch_medicinesearch.php?id=$a2'><button>BACK</button></a><br></center>";
?>