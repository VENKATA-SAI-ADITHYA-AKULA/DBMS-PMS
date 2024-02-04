<?php
  $conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
   mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));
   if(isset($_POST["login"]))
    {
      $m1=$_POST["mid"];
      $m2=$_POST["name"];
      $m3=$_POST["mty"];
      $m4=$_POST["mcom"];
      if(empty($m1)&&empty($m2)&&empty($m3)&&empty($m4))
       {
         echo "type any one of the boxes !!!";
       }
       elseif(!empty("$m1")&&strlen($m1)==5)
       {
         $sql="SELECT*FROM medicine WHERE medicine.med_id like'%$m1%'";
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
          echo       "<th>TOTAL QUANTITY</th>";
          echo       "<th>PRICE</th>";
          echo       "<th>BANNED OR NOT</th>";
          echo       "<th>Action</th>";
          echo       "<th>Action</th>";
          echo "</tr>";
           $i=1;
           if(mysqli_num_rows($result)==1)
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
                     echo "<td>".$rows["t_quantity"]."</td>";
                     echo "<td>".$rows["price"]."</td>";
                     echo "<td>".$rows["BANNED_OR_NOT"]."</td>";
                     
                     $m=$rows["med_id"];                   
                          
                     echo "<td><a href='php_manipulate_delete.php?del=$m'><button>BAN OR Expiry button</button></a></td>";
                     echo "<td><a href='php_manipulate_update.php?edit=$m'><button>update</button></a></td>";
                echo "</tr>";
               $i++;
                 }
        
             }
             elseif(mysqli_num_rows($result)>1)
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
                     echo "<td>".$rows["t_quantity"]."</td>";
                     echo "<td>".$rows["price"]."</td>";
                     echo "<td>".$rows["BANNED_OR_NOT"]."</td>";
                     echo "<td>No you cannot update the quantity</td>";
                     $id=$rows["med_id"];
                      $m=$id[0].$id[1].$id[2];                   
                          
                     echo "<td><a href='php_manipulate_delete.php?del=$id&del1=$m'><button>BAN OR Expiry button</button></a></td>";
                     //echo "<td><a href='php_manipulate_update.php?edit=$m'><button>update</button></a></td>";
                echo "</tr>";
               $i++;
                 }
             }
             else
             {
                echo "no results type one letter in the box";
             }
          
       }
       elseif(!empty("$m1")&&strlen($m1)<5)
       {
         $sql="SELECT*FROM medicine WHERE medicine.med_id like'%$m1%'";
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
          echo       "<th>TOTAL QUANTITY</th>";
          echo       "<th>PRICE</th>";
          echo       "<th>BANNED OR NOT</th>";
          echo       "<th>Action</th>";
          echo       "<th>Action</th>";
          echo "</tr>";
           $i=1;
   
             if(mysqli_num_rows($result)==1)
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
                     echo "<td>".$rows["t_quantity"]."</td>";
                     echo "<td>".$rows["price"]."</td>";
                     echo "<td>".$rows["BANNED_OR_NOT"]."</td>";
                     echo "<td>No you cannot update the quantity</td>";
                     $id=$rows["med_id"];
                      $m=$id[0].$id[1].$id[2];                   
                          
                     echo "<td><a href='php_manipulate_delete.php?del=$id&del1=$m'><button>BAN OR Expiry button</button></a></td>";
                     //echo "<td><a href='php_manipulate_update.php?edit=$m'><button>update</button></a></td>";
                echo "</tr>";
               $i++;
                 }
             }
             elseif(mysqli_num_rows($result)>=1)
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
                     echo "<td>".$rows["t_quantity"]."</td>";
                     echo "<td>".$rows["price"]."</td>";
                     echo "<td>".$rows["BANNED_OR_NOT"]."</td>";
                     echo "<td>No you cannot update the quantity</td>";
                     $id=$rows["med_id"];
                      $m=$id[0].$id[1].$id[2];                   
                          
                     echo "<td><a href='php_manipulate_delete.php?del=$id&del1=$m'><button>BAN OR Expiry button</button></a></td>";
                     //echo "<td><a href='php_manipulate_update.php?edit=$m'><button>update</button></a></td>";
                echo "</tr>";
               $i++;
                 }
             }
             else{
                      echo "no results type one letter in the box";
                }
       }
       elseif(!empty("$m2"))
       {
         $sql="SELECT*FROM medicine WHERE medicine.med_name like'%$m2%'";
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
          echo       "<th>TOTAL QUANTITY</th>";
          echo       "<th>PRICE</th>";
          echo "<td>BANNED OR NOT</td>";
          
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
                     echo "<td>".$rows["t_quantity"]."</td>";
                     echo "<td>".$rows["price"]."</td>";
                     echo "<td>".$rows["BANNED_OR_NOT"]."</td>";
                     $m=$rows["med_id"];
                     
                echo "</tr>";
               $i++;
                 }
        
             }
             else
             {
                echo"no results type one letter in the box";
             }
          
       }
       elseif(!empty("$m3"))
       {
         $sql="SELECT*FROM medicine WHERE medicine.type like'%$m3%'";
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
          echo       "<th>TOTAL QUANTITY</th>";
          echo       "<th>PRICE</th>";
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
                     echo "<td>".$rows["t_quantity"]."</td>";
                     echo "<td>".$rows["price"]."</td>";
                     echo "<td>".$rows["BANNED_OR_NOT"]."</td>";
                     $m=$rows["med_id"];
                     

                echo "</tr>";
               $i++;
                 }
        
             }
             else
             {
                echo "no results type one letter in the box";
             }
          
       }
       elseif(!empty("$m4"))
       {
         $sql="SELECT*FROM medicine WHERE medicine.m_company like'%$m4%'";
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
          echo       "<th>TOTAL QUANTITY</th>";
          echo       "<th>PRICE</th>";
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
                     echo "<td>".$rows["t_quantity"]."</td>";
                     echo "<td>".$rows["price"]."</td>";
                      echo "<td>".$rows["BANNED_OR_NOT"]."</td>";
                      $m=$rows["med_id"];
                     

                echo "</tr>";
               $i++;
                 }
        
             }
             else
             {
                echo "no results!!! type one letter in the box";
             }
          
       }
    }


?>

<html>
<center>
<body>
<a href="DBMS422.html"><button>BACK</button></a><br><br>
</body>
</center>
</html>