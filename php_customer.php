<?php
    if(isset($_POST["insert"]))
{  
   $e1=$_POST["m1"];
   $e6=$_POST["loc"];
   $link=mysqli_connect("localhost","root","") or die(my_sqli_error($link));
   mysqli_select_db($link,"xyz") or die(my_sqli_error($link));
   if(empty($e6))
   {
      echo"location should be selected ";
   }
else if(!empty($e1)){
   echo "location:$e6";
   /*$sql="SELECT medicine.med_name,medicine.m_company,medicine.type,medicine.formula,medicine.price,shop.shop_name,shop.shop_street,shop.shop_ph_no,SUM(for_bill_medicine.med_quantity)as sold_out,from_shop_medicine.shop_quantity as total_stock FROM ((((((employee INNER JOIN bills ON bills.e_id=employee.e_id)INNER JOIN for_bill_medicine ON for_bill_medicine.bill_id=bills.bill_id)INNER JOIN shop ON shop.e_id=employee.e_id)INNER JOIN shop_subschema ON shop_subschema.shop_pincode=shop.shop_pincode AND shop_subschema.shop_state='$e6')INNER JOIN medicine ON medicine.med_id=for_bill_medicine.med_id)INNER JOIN from_shop_medicine ON from_shop_medicine.shop_id=shop.shop_id AND from_shop_medicine.med_id=medicine.med_id) WHERE medicine.med_name LIKE '%$e1%' GROUP BY 
shop.shop_name,medicine.med_id,medicine.med_name  
ORDER BY for_bill_medicine.med_id ASC";*/
//$sql="SELECT * FROM medicine ";
$b="BANNED";
$e="EXPIRED";
$sql="SELECT medicine.med_name,medicine.m_company,medicine.type,medicine.formula,medicine.price,shop.shop_name,shop.shop_street,shop.shop_ph_no,from_shop_medicine.shop_quantity,from_shop_medicine.sold_quantity FROM (((shop_subschema INNER JOIN shop ON shop_subschema.shop_pincode=shop.shop_pincode AND shop_subschema.shop_state='$e6')INNER JOIN from_shop_medicine ON from_shop_medicine.shop_id=shop.shop_id )INNER JOIN medicine ON medicine.med_id=from_shop_medicine.med_id) WHERE medicine.med_name LIKE '%$e1%' AND medicine.BANNED_OR_NOT !='$b' AND medicine.BANNED_OR_NOT!='$e' GROUP BY medicine.med_name,shop.shop_name";
 



 $result=mysqli_query($link,$sql);
 echo "<center><table border= 1px solid black width='300' cellspacing='0'>";
  echo "<tr>";
  echo      "<th>S.no</th>";
  echo       "<th>Medicine Name</th>";
  echo       "<th>Company manfactured</th>";
  echo       "<th>type</th>";
  echo       "<th>formulae</th>";
  echo       "<th>price</th>";
  echo       "<th>shope name</th>";
  echo       "<th>shop address</th>";
  echo       "<th>shop phone number</th>";
  echo       "<th>number of quantity sold out</th>";
  echo       "<th>total number of quantity in the shop has </th>";
  echo       "<th>number of medicine quantity left</th>";
  echo "</tr>";
  $i=1;
   if(mysqli_num_rows($result)>0)
   {
        while($rows=mysqli_fetch_assoc($result))
        {
          echo "<tr>";
                     echo "<td>".$i."</td>";
                     echo "<td>".$rows["med_name"]."</td>";
                     echo "<td>".$rows["m_company"]."</td>";
                     echo "<td>".$rows["type"]."</td>";
                     echo "<td>".$rows["formula"]."</td>";
                     echo "<td>".$rows["price"]."</td>";
                     echo "<td>".$rows["shop_name"]."</td>";
                     echo "<td>".$rows["shop_street"]."</td>";
                     echo "<td>".$rows["shop_ph_no"]."</td>";
                     echo "<td>".$rows["sold_quantity"]."</td>";
                     echo "<td>".$rows["shop_quantity"]."</td>";
                     $x=(int)$rows["shop_quantity"]-$rows["sold_quantity"];
                     echo "<td>".$x."</td>";

          echo "</tr>";
           $i++;
        }
        
   }
     else
       {
          echo " no results found<br>";
          echo "if u do not know the name of the medicine then type any one letter present in the name";
       }
  
 }
mysqli_close($link);


}

?>

<html>
<center>
<body>
<a href="DBMS2.html"><button>BACK</button></a><br><br>
</body>
</center>
</html>