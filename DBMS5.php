<?php
$f=0;
$eid=$_GET["emp"];
$conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
   mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));
$sql="SELECT * FROM (employee INNER JOIN shop ON shop.e_id=employee.e_id) WHERE employee.e_id='$eid'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$sh=$row["shop_id"];
$man=$row["mang_id"];
echo "<center> shop id:".$row["shop_id"]."<br></center>";
echo "<center> shop name:".$row["shop_name"]."<br></center>";
echo "<center> employee id:".$row["e_id"]."<br></center>";
echo "<center> employee name:".$row["e_name"]."<br></center>";
echo "<center> shelf type:".$row["shelf_type"]."<br></center>";
echo"<center>";
echo"<h1>PHARMACIST</h1>";
echo"<a href='php_notification_pharmacist.php?emp=$eid&shop=$sh&man=$man'><button>NOTIFY TO MANAGER</button></a><br><br>";
echo "<a href='php_medicine_search.php?emp=$eid'><button>MEDICINE</button></a><br><br>";
echo "<a href='php_billing.php?emp=$eid&fi=$f'><button>BILLING</button></a><br><br>";
echo "<a href='php_shelf.php?emp=$eid&shop=$sh'><button>ADD A SHELVE TO THE SHOP</button></a><br><br>";
echo "<a href='php_shop_sales.php?emp=$eid'.html'><button>SHOP SALES</button></a><br><br>";
echo"<a href='pharmacist_changepassword.php?emp=$eid'><button>CHANGE PASSWORD</button></a><br><br>";
echo"<a href='DBMS3.php?emp=$eid'><button>BACK</button></a><br><br>";
echo"</center>";

?>