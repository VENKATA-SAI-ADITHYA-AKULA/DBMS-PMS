<?php
$id=$_GET["emp"];
$conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
   mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));
   $sql1="SELECT * FROM ((shop INNER JOIN shop_subschema ON shop.shop_pincode=shop_subschema.shop_pincode)INNER JOIN employee ON employee.e_id=shop.e_id) WHERE employee.e_id='$id'";
  $result1=mysqli_query($conn,$sql1);
  $rows=mysqli_fetch_assoc($result1);
  echo"<center>";
  $sh=$rows["shop_id"];
  echo "Shop ID :".$rows["shop_id"]."<br>";
  echo "Shop name :".$rows["shop_name"]."<br>";
  echo "Shop address :".$rows["shop_street"]."";
  echo "Shop  state:".$rows["shop_state"]."<br>";
  echo "Shop ph_no :".$rows["shop_ph_no"]."<br>";
  echo "Employee ID :".$rows["e_id"]."<br>";
  echo "Employee Name:".$rows["e_name"]."<br>";
  echo "Employee ph_no :".$rows["ph_no"]."<br>";
  echo"</center>";
$sql="SELECT medicine.med_id,medicine.med_name,medicine.m_company,medicine.m_date,medicine.e_date,medicine.type,medicine.formula,medicine.t_quantity as total_stock,SUM(from_shop_medicine.shop_quantity) AS quantity_of_medicine_in_shops,medicine.t_quantity-SUM(from_shop_medicine.shop_quantity) as warehouse_quantity,SUM(from_shop_medicine.sold_quantity) as sold,medicine.t_quantity-SUM(from_shop_medicine.sold_quantity) as unsold_quantity_overall,SUM(from_shop_medicine.shop_quantity)-SUM(from_shop_medicine.sold_quantity) as unsold_quantity_in_shops,medicine.price,SUM(from_shop_medicine.sold_quantity)*medicine.price as amount,medicine.BANNED_OR_NOT FROM (from_shop_medicine INNER JOIN medicine ON medicine.med_id=from_shop_medicine.med_id) WHERE from_shop_medicine.shop_id='$sh' GROUP BY medicine.med_id";

   $result=mysqli_query($conn,$sql);
   echo "<center><table border= 1px solid black width='300' cellspacing='0'>";
  echo "<tr>";
  echo      "<th>S.no</th>";
  echo       "<th>Medicine id</th>";
  echo       "<th>Medicine name</th>";
  echo       "<th>Company</th>";
  echo       "<th>Manufacture date</th>";
  echo       "<th>expiry date</th>";
  echo       "<th>type</th>";
  echo       "<th>formula</th>";
  //echo       "<th>Total stock</th>";
  echo       "<th>Quantity of the medicine in all shops</th>";
  //echo       "<th>Warehouse Quantity</th>";
  echo       "<th>Sold Quantity</th>";
  //echo       "<th>Unsold quantity overall</th>";
  echo       "<th>Unsold Quantity in shops</th>";
  echo       "<th>Price</th>";
  echo       "<th>Amount</th>";
  echo       "<th>BANNED_OR_NOT</th>";
  echo "</tr>";
  $i=1;$x=0;
  if(mysqli_num_rows($result)>0)
   {
        while($rows=mysqli_fetch_assoc($result))
        {
          echo "<tr>";
                     echo "<td>".$i."</td>";
                     echo "<td>".$rows["med_id"]."</td>";
                     echo "<td>".$rows["med_name"]."</td>";
                     echo "<td>".$rows["m_company"]."</td>";
                     echo "<td>".$rows["m_date"]."</td>";
                     echo "<td>".$rows["e_date"]."</td>";
                     echo "<td>".$rows["type"]."</td>";
                     echo "<td>".$rows["formula"]."</td>";
                     //echo "<td>".$rows["total_stock"]."</td>";
                     echo "<td>".$rows["quantity_of_medicine_in_shops"]."</td>";
                     //echo "<td>".$rows["warehouse_quantity"]."</td>";
                     echo "<td>".$rows["sold"]."</td>";
                     //echo "<td>".$rows["unsold_quantity_overall"]."</td>";
                     echo "<td>".$rows["unsold_quantity_in_shops"]."</td>";
                     echo "<td>".$rows["price"]."</td>";
                     echo "<td>".$rows["amount"]."</td>";
                     echo "<td>".$rows["BANNED_OR_NOT"]."</td>";
                     $x+=$rows["amount"];
                

          echo "</tr>";
           $i++;
        }
        
   }
   else
         {
               echo"no results";
         }
        
   echo "TOTAL AMOUNT =".$x."<br>";
 
  echo"<center><a href='DBMS5.php?emp=$id'><button>BACK</button></a></center><br>";
?>

