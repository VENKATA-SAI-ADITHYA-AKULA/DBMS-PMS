<?php
session_start();
   $f=0;
 if(isset($_SESSION['f']))
 {
   $f=$_SESSION['f'];
   $f++;
 }
 else{
   $_SESSION['f']=$f;
 }
  echo $f;
  $b=1;
  if(isset($_SESSION['b']))
 {
   $b=$_SESSION['b'];
   //$f++;
 }
 else{
   $_SESSION['b']=$b;
 }
  $b=$_SESSION['b'];
  //$_SESSION['b']=$b;
  $id=$_GET["emp"];
  echo"<center>";
  echo"<h1>BILLING<h2>";
  echo" type only Medicine id correctly and quantity for billing<br>";
  echo "type M in medicine id to see all medicines or name and press search";
echo"
  <html>
<head>
<style>
body {
  background-image: url('Ph12.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
color:white;
}
</style>
</head>

<body>
  <form action='' method='POST'>
<label for='mid'>MEDICINE ID:</label><input type='text' id='mid' name='mid'><br><br>
<label for='mname1'>MEDICINE QUANTITY:</label><input type='text' id='mname1' name='mq'><br><br>
<label for='mname'>MEDICINE NAME:</label><input type='text' id='mname' name='name'><br><br>
<button type ='submit' name='add'>ADD TO BILL</button><br><br>
<button type ='submit' name='delete'>DELETE BILL</button><br><br>
<button type ='submit' name='login'>SUBMIT THE BILL</button><br><br>
<button type ='submit' name='search'>SEARCH </button><br><br>
<button type ='submit' name='back'>Terminate the Bill and Go BACK</button><br><br>
</form>

</body>
</html>";
    $conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
   mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));
   $s="SELECT*FROM(employee INNER JOIN shop ON shop.e_id=employee.e_id)WHERE employee.e_id='$id'";
   $r=mysqli_query($conn,$s);
   $ro=mysqli_fetch_assoc($r);
   $sh=$ro["shop_id"];
   if(isset($_POST["add"]))
   {
      $m1=$_POST["mid"];
       $m2=$_POST["mq"];
       if(empty($m1)&&strlen($m1)!=5||empty($m2))
       {
           echo "type the medicine id and quantity";
       }
       else
       {
          $bk="BANNED";
          $ek="EXPIRED";
          $q="SELECT * FROM (medicine INNER JOIN from_shop_medicine ON from_shop_medicine.med_id=medicine.med_id)  WHERE medicine.med_id='$m1' AND shop_id='$sh' AND BANNED_OR_NOT!='$bk' AND BANNED_OR_NOT!='$ek' ";
          $t=mysqli_query($conn,$q);
          if(mysqli_num_rows($t)>0){
          $sql1="SELECT MAX(bills.bill_id) as mb FROM bills";
          $result1=mysqli_query($conn,$sql1);
          $rows1=mysqli_fetch_assoc($result1);
          
          if($f==1)
           {
              if($rows1["mb"]==NULL)
               {
                  $b="B0001";
                  
               }
               else
               {
                  $b=$rows1["mb"];
                   ++$b;
               }
              echo $b;
              $f++;
              $_SESSION['f']=$f;
              $_SESSION['b']=$b;
              $dat=date("Y-m-d");
              
           $sql2="INSERT INTO bills VALUES('$b','$id','','','$dat')";
           $result2=mysqli_query($conn,$sql2);
           $sql3="INSERT INTO for_bill_medicine VALUES('$b','$m2','$m1')";
           $result3=mysqli_query($conn,$sql3);
           $sql4="UPDATE from_shop_medicine SET sold_quantity=sold_quantity+$m2 WHERE med_id='$m1' AND shop_id='$sh'";
           $result4=mysqli_query($conn,$sql4);
           }
           else
           {
              $b=$rows1["mb"];
              $dat=date("Y-m-d");
           $sql4="SELECT * FROM for_bill_medicine WHERE bill_id='$b' AND med_id='$m1'";
           $result=mysqli_query($conn,$sql4);
           if(mysqli_num_rows($result)==0)
           {
               $sql3="INSERT INTO for_bill_medicine VALUES('$b','$m2','$m1')";
           $result3=mysqli_query($conn,$sql3);
               $sql4="UPDATE from_shop_medicine SET sold_quantity=sold_quantity+$m2 WHERE med_id='$m1' AND shop_id='$sh'";
           $result4=mysqli_query($conn,$sql4);
           }
           else{
              echo "already in the bill";
           }
           
           
           }
           
           //echo $b;
       }
       
       else{
            echo"That medicine is not in shop";
         }       
   }
}
   if(isset($_POST["delete"]))
   {
       
      $m1=$_POST["mid"];
       //$m2=$_POST["mq"];
       if(empty($m1)&&strlen($m1)!=5)
       {
           echo "type the medicine id correctly to delete";
       }
        else
        {
           $b=$_SESSION['b'];
           $sql1="SELECT * FROM for_bill_medicine WHERE bill_id='$b'";
           $result1=mysqli_query($conn,$sql1);
           if(mysqli_num_rows($result1)>1)
           {
             $sql3="SELECT * FROM for_bill_medicine WHERE bill_id='$b' AND med_id='$m1'";
             $result3=mysqli_query($conn,$sql3); 
             $rows3=mysqli_fetch_assoc($result3);
             $so=$rows3["med_quantity"];
             $sql2="DELETE FROM for_bill_medicine WHERE med_id='$m1' AND bill_id='$b'";
             $result2=mysqli_query($conn,$sql2);
             $sql4="UPDATE from_shop_medicine SET sold_quantity=sold_quantity-$so WHERE med_id='$m1' AND shop_id='$sh'";
             $result4=mysqli_query($conn,$sql4);
           }
           elseif(mysqli_num_rows($result1)==1)
           {
             $sql5="SELECT * FROM for_bill_medicine WHERE bill_id='$b' AND med_id='$m1'";
             $result5=mysqli_query($conn,$sql5); 
             $row5=mysqli_fetch_assoc($result5);
             if(mysqli_num_rows($result5)>0){
             $so=$row5["med_quantity"];
             $sql2="DELETE FROM for_bill_medicine WHERE bill_id='$b' AND med_id='$m1' ";
             $result2=mysqli_query($conn,$sql2);
             $sql3="DELETE FROM bills WHERE bill_id='$b'";
             $result3=mysqli_query($conn,$sql3);
             $sql4="UPDATE from_shop_medicine SET sold_quantity=sold_quantity-$so WHERE med_id='$m1' AND shop_id='$sh'";
             $result4=mysqli_query($conn,$sql4);
             session_unset();
             header("LOCATION:DBMS5.php?emp=$id");
             }
             else
           {
              echo "NO MEDICNE TO DELETE";
           }
           }
           else
           {
              echo "NO MEDICNE TO DELETE";
           }
        }
   }
   if(isset($_POST["back"]))
   {
        $z=0;
        $b=$_SESSION['b'];
        $sql5="SELECT * FROM for_bill_medicine WHERE bill_id='$b'";
        $result5=mysqli_query($conn,$sql5);
         if(mysqli_num_rows($result5)>0)
         {
             while($row5=mysqli_fetch_assoc($result5))
             {
                 $m=$row5["med_id"];
                 $mq=$row5["med_quantity"];
                 $sql="UPDATE from_shop_medicine SET sold_quantity=sold_quantity-'$mq' WHERE med_id='$m' AND shop_id='$sh' ";
                 $result=mysqli_query($conn,$sql);
                 $sql2="DELETE FROM for_bill_medicine WHERE bill_id='$b' AND med_id='$m'";
                 $result2=mysqli_query($conn,$sql2);
             }
         }
         else{
             $z=1;
              session_unset();
        //session_destory();
        header("LOCATION:DBMS5.php?emp=$id");
        }
        if($z==0){
        $sql2="DELETE FROM bills WHERE bill_id='$b'";
        $result2=mysqli_query($conn,$sql2);
        }
        
        session_unset();
        //session_destory();
        header("LOCATION:DBMS5.php?emp=$id");
   }
    if(isset($_POST["login"]))
     {
        
        $b=$_SESSION['b'];
        $sql4="SELECT * FROM for_bill_medicine WHERE bill_id='$b'";
        $result4=mysqli_query($conn,$sql4);
        if(mysqli_num_rows($result4)>0){
        
        session_unset();
        //session_destory();
        header("LOCATION:customer.php?emp=$id&b=$b");
        }
        else
        {
          session_unset();
        //session_destory();
        header("LOCATION:DBMS5.php?emp=$id");
        }
     }
    if($b!=1){
    $b=$_SESSION['b'];
    }
   //echo $b;
   if(isset($_POST["search"]))
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
           $sql="SELECT*FROM (medicine INNER JOIN from_shop_medicine ON  from_shop_medicine.med_id=medicine.med_id ) WHERE medicine.med_name like'%$m2%'AND from_shop_medicine.shop_id='$sh'";
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
   $sq="SELECT medicine.med_id,medicine.med_name,medicine.m_company,medicine.m_date,medicine.e_date,medicine.type,medicine.price,from_shop_medicine.shop_quantity,for_bill_medicine.med_quantity,from_shop_medicine.shop_quantity-from_shop_medicine.sold_quantity as lef,medicine.price*for_bill_medicine.med_quantity FROM ((medicine INNER JOIN from_shop_medicine ON from_shop_medicine.med_id=medicine.med_id ) INNER JOIN for_bill_medicine ON for_bill_medicine.med_id=from_shop_medicine.med_id) WHERE shop_id='$sh' AND bill_id='$b'";
   $re=mysqli_query($conn,$sq);
   echo "<table border= 1px solid black width='300' cellspacing='0'>";
          echo "<tr>";
          echo      "<th>S.no</th>";
          echo      "<th>MEDICINE_ID</th>";
          echo       "<th>NAME OF THE MEDICINE</th>";
          echo       "<th>NAME OF THE COMPANY</th>";
          echo       "<th>MANUFACTURED DATE</th>";
          echo       "<th>EXPIRY DATE</th>";
          echo       "<th>MEDICINE TYPE</th>";      
          echo       "<th>PRICE</th>";
          //echo       "<th>AMOUNT</th>";
          echo       "<th>SHOP QUANTITY</th>";
          echo       "<th>MEDICINE QUANTITY BOUGHT</th>";
          echo       "<th>SHOP QUANTITY LEFT</th>";
           echo       "<th>AMOUNT</th>";
          echo "</tr>";
   $i=1;
   if(mysqli_num_rows($re)>0)
   {
       while($rows=mysqli_fetch_assoc($re))
       {
          echo "<tr>";
                     echo "<td>".$i."</td>";
                     echo "<td>".$rows["med_id"]."</td>";
                     echo "<td>".$rows["med_name"]."</td>";
                     echo "<td>".$rows["m_company"]."</td>";
                     echo "<td>".$rows["m_date"]."</td>";
                     echo "<td>".$rows["e_date"]."</td>";
                     
                     echo "<td>".$rows["type"]."</td>";
                     echo "<td>".$rows["price"]."</td>";
                     echo "<td>".$rows["shop_quantity"]."</td>";
                     echo "<td>".$rows["med_quantity"]."</td>";
                     $x=$rows["shop_quantity"]-$rows["med_quantity"];
                     echo "<td>".$x."</td>";
                     $a=$rows["med_quantity"]*$rows["price"];
                      echo "<td>".$a."</td>";
          echo "</tr>";
               $i++;
       }
   }
   else{
     echo " no billing";
   }
    echo"</center>";
?>