<?php
  $id=$_GET["emp"];
  echo"<center>";
  echo"<h1>SEARCH FOR THE MEDICINE<h2>";
  echo" type only Medicine id correctly<br>";
  echo "type any one box";
echo"
  <html>

<head>
<style>
body {
  background: url('pharmacistph.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
 
}

button {
  border: 2px solid black;
  color: black;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius:12px;
  background-color:lightskyblue;
}
</style>
</head>

<body>
  <form action='' method='POST'>
<label for='mid'>MEDICINE ID:</label><input type='text' id='mid' name='mid'><br><br>
<label for='mname'>MEDICINE NAME:</label><input type='text' id='mname' name='name'><br><br>
<button type ='submit' name='login'>SUBMIT</button></br>
</form>
</body>
</html>";
    $conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
   mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));
   $s="SELECT*FROM(employee INNER JOIN shop ON shop.e_id=employee.e_id)WHERE employee.e_id='$id'";
   $r=mysqli_query($conn,$s);
   $ro=mysqli_fetch_assoc($r);
   $sh=$ro["shop_id"];
   if(isset($_POST["login"]))
    {
      $m1=$_POST["mid"];
      $m2=$_POST["name"];
      
      if(empty($m1)&&empty($m2))
       {
         echo "type any one of the boxes !!!";
       }
       elseif(!empty("$m1")&&$m1!="M"&&$m1!="m")
       {
         //$sql="SELECT*FROM (medicine INNER JOIN from_shop_medicine ON  from_shop_medicine.med_id=medicine.med_id ) WHERE medicine.med_id like'%$m1%'AND from_shop_medicine.shop_id='$sh'";
          $sql="SELECT*FROM (((medicine INNER JOIN from_shop_medicine ON  from_shop_medicine.med_id=medicine.med_id) INNER JOIN kept_shop_medicine ON  kept_shop_medicine.shop_id=from_shop_medicine.shop_id AND kept_shop_medicine.med_id=medicine.med_id)INNER JOIN shelf ON shelf.shop_id=kept_shop_medicine.shop_id AND shelf.shelf_name=kept_shop_medicine.shelf_name) WHERE medicine.med_id like'%$m1%'AND from_shop_medicine.shop_id='$sh'";
         $result=mysqli_query($conn,$sql);
          echo "<table border= 1px solid black width='300' cellspacing='0'>";
          echo "<tr>";
          echo      "<th>S.no</th>";
          echo      "<th>MEDICINE_ID</th>";
          echo       "<th>NAME OF THE MEDICINE</th>";
          echo       "<th>MANUFACTURED DATE</th>";
          echo       "<th>EXPIRY DATE</th>";
          echo       "<th>MANUFACTURED COMPANY</th>";
          echo       "<th>MEDICINE TYPE</th>";
          echo       "<th>FORMULA</th>";
          echo       "<th>SHOP QUANTITY</th>";
          echo       "<th>SOLD QUANTITY</th>";
          echo       "<th>LEFT QUANTITY</th>";
          echo       "<th>PRICE</th>";
          echo       "<th>AMOUNT</th>";
          echo       "<th>BANNED OR NOT</th>";
          echo       "<th>SHELF NAME</th>";
          echo       "<th>UPDATE SHELF</th>";
           echo       "<th>DELETE</th>";
          echo "</tr>";
           $i=1;
           if(mysqli_num_rows($result)>0)
           {
                while($rows=mysqli_fetch_assoc($result))
                {
                     
                     echo "<tr>";
                     echo "<td>".$i."</td>";
                     echo "<td>".$rows["med_id"]."</td>";
                     echo "<td>".$rows["med_name"]."</td>";
                     echo "<td>".$rows["m_date"]."</td>";
                     echo "<td>".$rows["e_date"]."</td>";
                     echo "<td>".$rows["m_company"]."</td>";
                     echo "<td>".$rows["type"]."</td>";
                     echo "<td>".$rows["formula"]."</td>";
                     echo "<td>".$rows["shop_quantity"]."</td>";
                     echo "<td>".$rows["sold_quantity"]."</td>";
                     $x=$rows["shop_quantity"]-$rows["sold_quantity"];
                     echo "<td>".$x."</td>";
                     echo "<td>".$rows["price"]."</td>";
                     $a=$rows["sold_quantity"]*$rows["price"];
                      echo "<td>".$a."</td>";
                      echo "<td>".$rows["BANNED_OR_NOT"]."</td>";
                     $m=$rows["med_id"];
                     $n=$rows["shelf_name"];
                     echo "<td>".$rows["shelf_name"]."</td>";
                     echo "<td><a href='php_medicine_updateshelf.php?edit=$m&emp=$id&shop=$sh&name=$n'><button>update shelf</button></a></td>";
                     echo "<td><a href='php_medicine_delete.php?edit=$m&emp=$id&shop=$sh&name=$n'><button>delete medicine from shelf</button></a></td>";
                echo "</tr>";
               $i++;
                 }
        
             }
             else
             {
                
                 
                 $sql="SELECT*FROM (medicine INNER JOIN from_shop_medicine ON  from_shop_medicine.med_id=medicine.med_id ) WHERE medicine.med_id like'%$m1%'AND from_shop_medicine.shop_id='$sh'";
                 //$sql2= "INSERT INTO kept_shop_medicine(shop_id, shelf_name, med_id) VALUES ('$sh','00001','$m')"; 
                   $result=mysqli_query($conn,$sql);
                   //$result2=mysqli_query($conn,$sql);
           $i=1;
           if(mysqli_num_rows($result)>0)
           {
               $r='00001';
               
                 while($rows=mysqli_fetch_assoc($result))
                {
                     echo "<tr>";
                     echo "<td>".$i."</td>";
                     echo "<td>".$rows["med_id"]."</td>";
                     echo "<td>".$rows["med_name"]."</td>";
                     echo "<td>".$rows["m_date"]."</td>";
                     echo "<td>".$rows["e_date"]."</td>";
                     echo "<td>".$rows["m_company"]."</td>";
                     echo "<td>".$rows["type"]."</td>";
                     echo "<td>".$rows["formula"]."</td>";
                     echo "<td>".$rows["shop_quantity"]."</td>";
                     echo "<td>".$rows["sold_quantity"]."</td>";
                     $x=$rows["shop_quantity"]-$rows["sold_quantity"];
                     echo "<td>".$x."</td>";
                     echo "<td>".$rows["price"]."</td>";
                     $a=$rows["sold_quantity"]*$rows["price"];
                      echo "<td>".$a."</td>";
                     $m=$rows["med_id"];
                     echo "<td>".$rows["BANNED_OR_NOT"]."</td>";
                     echo "<td>NOT IN SHELF </td>";
                     echo "<td><a href='php_medicine_updateshelf2.php?edit=$m&emp=$id&shop=$sh'><button>update shelf</button></a></td>";
                      echo "</tr>";
                     $i++;
                     
                 }
        
             }
             else{
                    echo "no results type one letter in the box<br>"; 
                  }
             }
          
       }
       elseif(!empty("$m2"))
       {
           $sql="SELECT*FROM (medicine INNER JOIN from_shop_medicine ON  from_shop_medicine.med_id=medicine.med_id ) WHERE medicine.med_id like'%$m1%'AND from_shop_medicine.shop_id='$sh'";
          //$sql="SELECT*FROM (((medicine INNER JOIN from_shop_medicine ON  from_shop_medicine.med_id=medicine.med_id) INNER JOIN kept_shop_medicine ON  kept_shop_medicine.shop_id=from_shop_medicine.shop_id AND kept_shop_medicine.med_id=medicine.med_id)INNER JOIN shelf ON shelf.shop_id=kept_shop_medicine.shop_id AND shelf.shelf_name=kept_shop_medicine.shelf_name) WHERE medicine.med_name like'%$m2%' AND from_shop_medicine.shop_id='$sh'";
         $result=mysqli_query($conn,$sql);
          echo "<table border= 1px solid black width='300' cellspacing='0'>";
          echo "<tr>";
          echo      "<th>S.no</th>";
          echo      "<th>MEDICINE_ID</th>";
          echo       "<th>NAME OF THE MEDICINE</th>";
          echo       "<th>MANUFACTURED DATE</th>";
          echo       "<th>EXPIRY DATE</th>";
          echo       "<th>MANUFACTURED COMPANY</th>";
          echo       "<th>MEDICINE TYPE</th>";
          echo       "<th>FORMULA</th>";
          echo       "<th>SHOP QUANTITY</th>";
          echo       "<th>SOLD QUANTITY</th>";
          echo       "<th>LEFT QUANTITY</th>";
          echo       "<th>PRICE</th>";
          echo       "<th>AMOUNT</th>";
          echo       "<th>BANNED OR NOT</th>";
          
   
          echo "</tr>";
           $i=1;
           if(mysqli_num_rows($result)>0)
           {
                while($rows=mysqli_fetch_assoc($result))
                {
                     
                     echo "<tr>";
                     echo "<td>".$i."</td>";
                     echo "<td>".$rows["med_id"]."</td>";
                     echo "<td>".$rows["med_name"]."</td>";
                     echo "<td>".$rows["m_date"]."</td>";
                     echo "<td>".$rows["e_date"]."</td>";
                     echo "<td>".$rows["m_company"]."</td>";
                     echo "<td>".$rows["type"]."</td>";
                     echo "<td>".$rows["formula"]."</td>";
                     echo "<td>".$rows["shop_quantity"]."</td>";
                     echo "<td>".$rows["sold_quantity"]."</td>";
                     $x=$rows["shop_quantity"]-$rows["sold_quantity"];
                     echo "<td>".$x."</td>";
                     echo "<td>".$rows["price"]."</td>";
                     $a=$rows["sold_quantity"]*$rows["price"];
                      echo "<td>".$a."</td>";
                     $m=$rows["med_id"];
                     echo "<td>".$rows["BANNED_OR_NOT"]."</td>";
                     
                echo "</tr>";
               $i++;
                 }
        
             }
             else
             {
                   echo "no medicine available";
             }
             
       }
       elseif(!empty("$m1")&&$m1=="M"||$m1=="m")
             {
                   
                   $sql="SELECT*FROM (medicine INNER JOIN from_shop_medicine ON  from_shop_medicine.med_id=medicine.med_id ) WHERE medicine.med_id like'%$m1%'AND from_shop_medicine.shop_id='$sh'";
                   $result=mysqli_query($conn,$sql);
          echo "<table border= 1px solid black width='300' cellspacing='0'>";
          echo "<tr>";
          echo      "<th>S.no</th>";
          echo      "<th>MEDICINE_ID</th>";
          echo       "<th>NAME OF THE MEDICINE</th>";
          echo       "<th>MANUFACTURED DATE</th>";
          echo       "<th>EXPIRY DATE</th>";
          echo       "<th>MANUFACTURED COMPANY</th>";
          echo       "<th>MEDICINE TYPE</th>";
          echo       "<th>FORMULA</th>";
          echo       "<th>SHOP QUANTITY</th>";
          echo       "<th>SOLD QUANTITY</th>";
          echo       "<th>LEFT QUANTITY</th>";
          echo       "<th>PRICE</th>";
          echo       "<th>AMOUNT</th>";
          echo       "<th>BANNED OR NOT</th>";
          
          echo "</tr>";
           $i=1;
           if(mysqli_num_rows($result)>0)
           {
                while($rows=mysqli_fetch_assoc($result))
                {
                     
                     echo "<tr>";
                     echo "<td>".$i."</td>";
                     echo "<td>".$rows["med_id"]."</td>";
                     echo "<td>".$rows["med_name"]."</td>";
                     echo "<td>".$rows["m_date"]."</td>";
                     echo "<td>".$rows["e_date"]."</td>";
                     echo "<td>".$rows["m_company"]."</td>";
                     echo "<td>".$rows["type"]."</td>";
                     echo "<td>".$rows["formula"]."</td>";
                     echo "<td>".$rows["shop_quantity"]."</td>";
                     echo "<td>".$rows["sold_quantity"]."</td>";
                     $x=$rows["shop_quantity"]-$rows["sold_quantity"];
                     echo "<td>".$x."</td>";
                     echo "<td>".$rows["price"]."</td>";
                     $a=$rows["sold_quantity"]*$rows["price"];
                      echo "<td>".$a."</td>";
                      echo "<td>".$rows["BANNED_OR_NOT"]."</td>";
                     
                     $m=$rows["med_id"];
                    
                     
                echo "</tr>";
               $i++;
                 }
        
             }
             }
    }
    echo "<br><a href='DBMS5.php?emp=$id'><button>BACK</button></a>";
    echo"</center>";
?>