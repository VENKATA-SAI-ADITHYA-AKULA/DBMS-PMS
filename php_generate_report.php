<?php
  
   $conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
   mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));
   $sql="SELECT medicine.med_id,medicine.med_name,medicine.m_company,medicine.m_date,medicine.e_date,medicine.type,medicine.formula,medicine.t_quantity as total_stock,SUM(from_shop_medicine.shop_quantity) AS quantity_of_medicine_in_shops,medicine.t_quantity-SUM(from_shop_medicine.shop_quantity) as warehouse_quantity,SUM(from_shop_medicine.sold_quantity) as sold,medicine.t_quantity-SUM(from_shop_medicine.sold_quantity) as unsold_quantity_overall,SUM(from_shop_medicine.shop_quantity)-SUM(from_shop_medicine.sold_quantity) as unsold_quantity_in_shops,medicine.price,medicine.BANNED_OR_NOT,SUM(from_shop_medicine.sold_quantity)*medicine.price as amount FROM (from_shop_medicine INNER JOIN medicine ON medicine.med_id=from_shop_medicine.med_id) GROUP BY medicine.med_id";
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
  echo       "<th>Total stock</th>";
  echo       "<th>Quantity of the medicine in all shops</th>";
  echo       "<th>Warehouse Quantity</th>";
  echo       "<th>Sold Quantity</th>";
  echo       "<th>Unsold quantity overall</th>";
  echo       "<th>Unsold Quantity in shops</th>";
    echo       "<th>BANNED OR NOT</th>";
  echo       "<th>Price</th>";
  echo       "<th>Amount</th>";
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
                     echo "<td>".$rows["total_stock"]."</td>";
                     echo "<td>".$rows["quantity_of_medicine_in_shops"]."</td>";
                     echo "<td>".$rows["warehouse_quantity"]."</td>";
                     echo "<td>".$rows["sold"]."</td>";
                     echo "<td>".$rows["unsold_quantity_overall"]."</td>";
                     echo "<td>".$rows["unsold_quantity_in_shops"]."</td>";
                     echo "<td>".$rows["BANNED_OR_NOT"]."</td>";
                     echo "<td>".$rows["price"]."</td>";
                     echo "<td>".$rows["amount"]."</td>";
                     $x+=$rows["amount"];
                

          echo "</tr>";
           $i++;
        }
        
   }
else
         {
               echo"no results";
         }
        
   echo "TOTAL AMOUNT =".$x."";
 ?>

<html>
<center>
<body>
<a href="DBMS4.php"><button>BACK</button></a><br><br>
</body>
</center>
</html>