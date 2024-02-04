<?php
    $conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
   mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));
    $sql5="SELECT * FROM ((((notification INNER JOIN gets_employee_notification ON gets_employee_notification.notification_id=notification.notification_id) INNER JOIN employee ON gets_employee_notification.e_id=employee.e_id)INNER JOIN shop ON shop.e_id=employee.e_id)INNER JOIN shop_subschema ON shop_subschema.shop_pincode=shop.shop_pincode) WHERE gets_employee_notification.e_id!='E0001' ORDER BY notification.n_date DESC";

    $results5=mysqli_query($conn,$sql5);
    if(mysqli_num_rows($results5)>0)
    {
        echo "<center><table border= 1px solid black width='300' cellspacing='0'></center>";
          echo "<tr>";
          echo      "<th>S.no</th>";
          echo      "<th>Notification type</th>";
          echo       "<th>message</th>";
          echo       "<th>date</th>";
          echo       "<th>employee eid</th>";
          echo       "<th>employee name</th>";
          echo       "<th>shop id</th>";
          echo       "<th>shop name</th>";
          echo       "<th>shop state</th>";
          echo "</tr>";
          $i=1;
        while($rows=mysqli_fetch_assoc($results5))
        {
           echo "<tr>";
                     echo "<td>".$i."</td>";
                     echo "<td>".$rows["notification_type"]."</td>";
                     echo "<td>".$rows["message"]."</td>";
                     echo "<td>".$rows["n_date"]."</td>";
                     echo "<td>".$rows["e_id"]."</td>";
                     echo "<td>".$rows["e_name"]."</td>";
                     echo "<td>".$rows["shop_id"]."</td>";
                     echo "<td>".$rows["shop_name"]."</td>";
                     echo "<td>".$rows["shop_state"]."</td>";
                     echo "</tr>";
             $i++;
        }
    }
    else
    {
       echo "NO NOTIFICATION";
    }
    echo "<center><a href='DBMS4.php'><button>BACK</button></a><center>";

?>