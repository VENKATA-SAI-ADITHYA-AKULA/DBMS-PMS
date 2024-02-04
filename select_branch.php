<?php
 $link=mysqli_connect("localhost","root","") or die(my_sqli_error($link));
   mysqli_select_db($link,"xyz") or die(my_sqli_error($link));
   if(isset($_POST["submit"]))
   {
      $l=$_POST["loc"];
      if(empty($l))
      {
        echo "SELECT THE STATE !!";
      }
      else
      {
         echo "$l";
         $sql="SELECT shop.shop_id,shop.shop_name,shop.shop_street,shop.shop_ph_no FROM (shop INNER JOIN shop_subschema ON shop_subschema.shop_pincode=shop.shop_pincode) WHERE shop_subschema.shop_state='$l'";
         $result=mysqli_query($link,$sql);
         echo "<center><table border= 1px solid black width='300' cellspacing='0'>";
          echo "<tr>";
          echo      "<th>S.no</th>";
          echo      "<th>Shop ID</th>";
          echo       "<th>Shop Name</th>";
          echo       "<th>Address</th>";
          echo       "<th>Shop phone number</th>";
          echo       "<th>Action</th>";
          echo       "<th>Action</th>";
          echo "</tr>";
           $i=1;
           if(mysqli_num_rows($result)>0)
           {
                while($rows=mysqli_fetch_assoc($result))
                {
                     
                     echo "<tr>";
                     echo "<td>".$i."</td>";
                     echo "<td>".$rows["shop_id"]."</td>";
                     echo "<td>".$rows["shop_name"]."</td>";
                     echo "<td>".$rows["shop_street"]."</td>";
                     echo "<td>".$rows["shop_ph_no"]."</td>";
                     $m=$rows["shop_id"];
                     echo "<td><a href='php_selectbranch_medicinesearch.php?id=$m'><button>select</button></a></td>";
                     echo "<td><a href='shop_reports.php?id=$m'><button>shop reports</button></a></td>";
                echo "</tr>";
               $i++;
                 }
        
             }
             else
             {
                   echo "no shops";
             }
      }
   }
?>

<html>
<center>
<body>
<a href="select_shop_state.html"><button>BACK</button></a><br><br>
</body>
</center>
</html>