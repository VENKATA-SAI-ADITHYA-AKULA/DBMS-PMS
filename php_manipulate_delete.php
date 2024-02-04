<?php
 $f=0;
 $conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
   mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));
  if(isset($_GET["del"]))
{
 
  $id=$_GET["del"];
  if(isset($_GET["del1"])){
  $mid=$id[0].$id[1].$id[2];
  $id=$mid;
  }
  echo $id;
  $sql1="SELECT * FROM medicine WHERE medicine.med_id LIKE '%$id%'";
  $result1=mysqli_query($conn,$sql1);
  $row=mysqli_fetch_assoc($result1);
 echo mysqli_num_rows($result1);
if(mysqli_num_rows($result1)>1){
while($row=mysqli_fetch_assoc($result1)){
  if($row["e_date"]<date("Y-m-d"))
  {
    //echo GETDATE();
    $mess="BANNED";
    //$sql="DELETE FROM from_shop_medicine WHERE from_shop_medicine.med_id LIKE '%$id%'";
  $sql2="UPDATE medicine SET medicine.BANNED_OR_NOT='$mess' WHERE medicine.med_id LIKE '%$id%'";
  
  //$result=mysqli_query($conn,$sql);
   $result2=mysqli_query($conn,$sql2);
  }
  /*elseif($row["e_date"]<date("Y-m-d")&&$row["BANNED_OR_NOT"]!="NOT")
  {
    $mess="EXPIRED AND BANNED";
    //$sql="DELETE FROM from_shop_medicine WHERE from_shop_medicine.med_id LIKE '%$id%'";
  $sql2="UPDATE medicine SET medicine.BANNED_OR_NOT='$mess' WHERE medicine.med_id LIKE '%$id%'";
   //$result=mysqli_query($conn,$sql);
   $result2=mysqli_query($conn,$sql2);
  }*/
  else
  {
    $mess="BANNED";
    //$sql="DELETE FROM from_shop_medicine WHERE from_shop_medicine.med_id LIKE '%$id%'";
  $sql2="UPDATE medicine SET medicine.BANNED_OR_NOT='$mess' WHERE medicine.med_id LIKE '%$id%'";
   //$result=mysqli_query($conn,$sql);
   $result2=mysqli_query($conn,$sql2);
  }
}
}
else{
    if($row["e_date"]<date("Y-m-d")&&$row["BANNED_OR_NOT"]=="NOT"){
    $mess="EXPIRED";
   // $sql="DELETE FROM from_shop_medicine WHERE from_shop_medicine.med_id like '%$id%'";
  $sql2="UPDATE medicine SET medicine.BANNED_OR_NOT='$mess' WHERE medicine.med_id like '%$id%'";
  //$result=mysqli_query($conn,$sql);
   $result2=mysqli_query($conn,$sql2);
   }
   elseif($row["e_date"]>date("Y-m-d")&&$row["BANNED_OR_NOT"]=="NOT" )
   {
       $mess="BANNED";
    //$sql="DELETE FROM from_shop_medicine WHERE from_shop_medicine.med_id like '%$id%'";
  $sql2="UPDATE medicine SET medicine.BANNED_OR_NOT='$mess' WHERE medicine.med_id like '%$id%'";
  //$result=mysqli_query($conn,$sql);
   $result2=mysqli_query($conn,$sql2);
   }
   elseif($row["e_date"]<date("Y-m-d")){
      $mess=" EXPIRED AND BANNED";
    //$sql="DELETE FROM from_shop_medicine WHERE from_shop_medicine.med_id like '%$id%'";
  $sql2="UPDATE medicine SET medicine.BANNED_OR_NOT='$mess' WHERE medicine.med_id like '%$id%'";
  //$result=mysqli_query($conn,$sql);
   $result2=mysqli_query($conn,$sql2);
   }
   else
   {
          $f=1;
       echo "no need to update it";
   }

}
  
  
  if($f==0){
  echo"updated successfully";
  }
 
}
?>

<html>
<center>
<body>
<a href="DBMS422.html"><button>BACK</button></a><br><br>
</body>
</center>
</html>