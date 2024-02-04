<?php
 $b=$_GET["b"];
 $id=$_GET["emp"];
 echo"<center>";
 $conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
   mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));
   $sql="SELECT * FROM (((((bills INNER JOIN for_bill_medicine ON for_bill_medicine.bill_id=bills.bill_id)INNER JOIN employee ON employee.e_id=bills.e_id )INNER JOIN shop ON shop.e_id=employee.e_id)INNER JOIN shop_subschema ON shop_subschema.shop_pincode=shop.shop_pincode) INNER JOIN medicine ON medicine.med_id=for_bill_medicine.med_id) WHERE bills.bill_id='$b'";
   $result=mysqli_query($conn,$sql);
   echo "<table border= 1px solid black width='300' cellspacing='0'>";
          echo "<tr>";
          echo      "<th>S.no</th>";
          //echo      "<th>MEDICINE_ID</th>";
          echo       "<th>NAME OF THE MEDICINE</th>";
          //echo       "<th>MANUFACTURED DATE</th>";
          //echo       "<th>EXPIRY DATE</th>";
          echo       "<th>MANUFACTURED COMPANY</th>";
          echo       "<th>MEDICINE TYPE</th>";
          //echo       "<th>FORMULA</th>";
          //echo       "<th>SHOP QUANTITY</th>";
          echo       "<th>QUANTITY</th>";
          //echo       "<th>LEFT QUANTITY</th>";
          echo       "<th>PRICE</th>";
          echo       "<th>AMOUNT</th>";
          //echo       "<th>BANNED OR NOT</th>";
          //echo       "<th>SHELF NAME</th>";
          //echo       "<th>UPDATE SHELF</th>";
           //echo       "<th>DELETE</th>";
          echo "</tr>";
   $i=1;
   $x=0;
   while($rows=mysqli_fetch_assoc($result))
   {
                  echo "<tr>";
                     echo "<td>".$i."</td>";
                     //echo "<td>".$rows["med_id"]."</td>";
                     echo "<td>".$rows["med_name"]."</td>";
                     echo "<td>".$rows["m_company"]."</td>";
                     //echo "<td>".$rows["m_date"]."</td>";
                     //echo "<td>".$rows["e_date"]."</td>";
                     echo "<td>".$rows["type"]."</td>";
                     //echo "<td>".$rows["formula"]."</td>";
                     //echo "<td>".$rows["total_stock"]."</td>";
                     //echo "<td>".$rows["quantity_of_medicine_in_shops"]."</td>";
                     //echo "<td>".$rows["warehouse_quantity"]."</td>";
                     echo "<td>".$rows["med_quantity"]."</td>";
                     //echo "<td>".$rows["unsold_quantity_overall"]."</td>";
                    // echo "<td>".$rows["unsold_quantity_in_shops"]."</td>";
                     echo "<td>".$rows["price"]."</td>";
                     $p=$rows["price"]*$rows["med_quantity"];
                     echo "<td>".$p."</td>";
                     //echo "<td>".$rows["BANNED_OR_NOT"]."</td>";
                     $x+=$p;
                  echo "</tr>";
   }
 echo "<br>".$x."";
 echo "<br><a href='DBMS5.php?emp=$id'><button>BACK</button></a>";
 echo"</center>";
  
?>