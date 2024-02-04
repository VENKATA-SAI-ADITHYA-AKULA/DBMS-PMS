<?php
  $id=$_GET["emp"];
  $sh=$_GET["shop"];
  $man=$_GET["man"];
$conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
   mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));
   $sql="SELECT * FROM (medicine INNER JOIN from_shop_medicine ON from_shop_medicine.med_id=medicine.med_id) WHERE from_shop_medicine.shop_id='$sh'";
   $results=mysqli_query($conn,$sql);
   if(mysqli_num_rows($results)>0)
   {
          while($rows=mysqli_fetch_assoc($results))
          {
             if($rows["shop_quantity"]-$rows["sold_quantity"]<=20)
              {
                  $sql2="SELECT MAX(notification_id) as notify  FROM notification";
                  $result2=mysqli_query($conn,$sql2);
                  if(mysqli_num_rows($result2)>=1)
                  {
                     $rows2=mysqli_fetch_assoc($result2);
                     if($rows2["notify"]==NULL)
                     {
                        $not_id="N0001";
                     }
                     else{
                        $not_id=$rows2["notify"];
                        ++$not_id;
                      }
                     $type="stock is low";
                     $mess="medicine id:".$rows["med_id"]." medicine name=".$rows["med_name"]."is out of stock with quantity ".$rows["shop_quantity"]-$rows["sold_quantity"]."";
                     $dat=date("Y-m-d");
                     $s="SELECT * FROM (notification INNER JOIN gets_employee_notification ON notification.notification_id=gets_employee_notification.notification_id) WHERE gets_employee_notification.e_id='$id' AND notification.notification_type='$type' AND notification.message='$mess'AND notification.n_date='$dat'";
                     $r=mysqli_query($conn,$s);
                     $row=mysqli_fetch_assoc($r);
                     if(mysqli_num_rows($r)==0){
                     $sql3="INSERT INTO notification VALUES('$not_id','$type','$mess','$dat')";
                     $result3=mysqli_query($conn,$sql3);
                     $sql4="INSERT INTO gets_employee_notification VALUES('$not_id','$id')";
                     $sql5="INSERT INTO gets_employee_notification VALUES('$not_id','$man')";
                     
                     $result4=mysqli_query($conn,$sql4);
                     mysqli_query($conn,$sql5);
                     }
                  }
                  /*else
                 {
                    $not_id="N0001";
                     $type="stock is low";
                     $mess="medicine id:".$rows["med_id"]." medicine name=".$rows["med_name"]."is out of stock with quantity ".$rows["shop_quantity"]-$rows["sold_quantity"]."";
                     $dat=date("Y-m-d");
                     $sql3="INSERT INTO notification VALUES('$not_id','$type','mess','$dat')";
                     $result3=mysqli_query($conn,$sql3);
                     $sql4="INSERT INTO gets_employee_notification VALUES('$not_id','$id')";
                     $result4=mysqli_query($conn,$sql4);
                 }*/

              }
              
          }
    }

    $sql1="SELECT * FROM (medicine INNER JOIN from_shop_medicine ON from_shop_medicine.med_id=medicine.med_id) WHERE from_shop_medicine.shop_id='$sh'";
   $results1=mysqli_query($conn,$sql1);
    echo "<center><a href='DBMS5.php?emp=$id'><button>BACK</button></a><center>";
    if(mysqli_num_rows($results1)>0)
   {
          while($rows=mysqli_fetch_assoc($results1))
          {
             if($rows["e_date"]<date("Y-m-d"))
              {
                  $sql2="SELECT MAX(notification_id) as notify  FROM notification";
                  $result2=mysqli_query($conn,$sql2);
                  if(mysqli_num_rows($result2)>=1)
                  {
                     $rows2=mysqli_fetch_assoc($result2);
                     if($rows2["notify"]==NULL)
                     {
                        $not_id="N0001";
                     }
                     else{
                        $not_id=$rows2["notify"];
                        ++$not_id;
                      }
                      
                       $type="EXPIRED";
                      }
                     $mess="medicine id:".$rows["med_id"]." medicine name=".$rows["med_name"]."is expired ";
                     $dat=date("Y-m-d");
                     $s="SELECT * FROM (notification INNER JOIN gets_employee_notification ON notification.notification_id=gets_employee_notification.notification_id) WHERE gets_employee_notification.e_id='$id' AND notification.notification_type='$type' AND notification.message='$mess'";
                     $r=mysqli_query($conn,$s);
                     $row=mysqli_fetch_assoc($r);
                     if(mysqli_num_rows($r)==0){
                     $sql3="INSERT INTO notification VALUES('$not_id','$type','$mess','$dat')";
                     $result3=mysqli_query($conn,$sql3);
                     $sql4="INSERT INTO gets_employee_notification VALUES('$not_id','$id')";
                     $sql5="INSERT INTO gets_employee_notification VALUES('$not_id','$man')";
                     
                     $result4=mysqli_query($conn,$sql4);
                     mysqli_query($conn,$sql5);
                     }
                  }
                  /*else
                 {
                    $not_id="N0001";
                     $type="stock is low";
                     $mess="medicine id:".$rows["med_id"]." medicine name=".$rows["med_name"]."is out of stock with quantity ".$rows["shop_quantity"]-$rows["sold_quantity"]."";
                     $dat=date("Y-m-d");
                     $sql3="INSERT INTO notification VALUES('$not_id','$type','mess','$dat')";
                     $result3=mysqli_query($conn,$sql3);
                     $sql4="INSERT INTO gets_employee_notification VALUES('$not_id','$id')";
                     $result4=mysqli_query($conn,$sql4);
                 }*/

              }
              
          }
    
    $sql5="SELECT * FROM (notification INNER JOIN gets_employee_notification ON gets_employee_notification.notification_id=notification.notification_id  ) WHERE gets_employee_notification.e_id='$id' ORDER BY notification.n_date DESC";
    $results5=mysqli_query($conn,$sql5);
    if(mysqli_num_rows($results5)>0)
    {
        echo "<center><table border= 1px solid black width='300' cellspacing='0'></center>";
          echo "<tr>";
          echo      "<th>S.no</th>";
          echo      "<th>Notification type</th>";
          echo       "<th>message</th>";
          echo       "<th>date</th>";
          echo "</tr>";
          $i=1;
        while($rows=mysqli_fetch_assoc($results5))
        {
           echo "<tr>";
                     echo "<td>".$i."</td>";
                     echo "<td>".$rows["notification_type"]."</td>";
                     echo "<td>".$rows["message"]."</td>";
                     echo "<td>".$rows["n_date"]."</td>";
                     echo "</tr>";
             $i++;
        }
    }
    else
    {
       echo "NO NOTIFICATION";
    }

?>