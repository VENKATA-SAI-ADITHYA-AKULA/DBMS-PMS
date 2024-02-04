<html>
<head>
<style>

body {
  background: url("Ph13.jpg");
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
  color:black;
}

</style>
</head>

</

<body>
<center>
<h1>MANIPULATE MEDICINE </h1>
<h1>Type only one box</h1>
<h1>Type correct medicine mid</h1>
<form action="" method="POST">
<label for="mid">MEDICINE ID:</label><input type="text" id="mid" name="mid"><br><br>
<button type ="submit" name="login">SUBMIT</button><br><br>
</form>
<a href="select_shop_state.html"><button>BACK</button></a><br>

</center>
</body>
</html>

<?php
  $sd=$_GET["id"];
  $conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
   mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));
   if(isset($_POST["login"]))
    {
      $m1=$_POST["mid"];
      if(empty($m1))
       {
         echo "type correct medicine id!!!";
       }
       else
       {
         $me="BANNED";
         $ex="EXPIRED";
         //echo "<center>no medicine in the shop</center>";
         $sql="SELECT medicine.med_id,medicine.med_name,from_shop_medicine.shop_quantity,from_shop_medicine.sold_quantity,from_shop_medicine.shop_quantity-from_shop_medicine.sold_quantity AS lef,medicine.BANNED_OR_NOT FROM (medicine INNER JOIN from_shop_medicine ON medicine.med_id=from_shop_medicine.med_id) WHERE from_shop_medicine.shop_id='$sd' AND medicine.med_id='$m1'";
         $result=mysqli_query($conn,$sql);
          echo "<center><table border= 1px solid black width='300' cellspacing='0'>";
          echo "<tr>";
          echo      "<th>S.no</th>";
          echo      "<th>MEDICINE_ID</th>";
          echo       "<th>NAME OF THE MEDICINE</th>";
          echo       "<th>TOTAL SHOP QUANTITY</th>";
          echo       "<th>SOLD QUANTITY</th>";
          echo       "<th>LEFT QUANTITY</th>";
          echo       "<th>BANNED OR NOT</th>";
          echo       "<th>Action</th>";
          //echo "<th>Action</th>";
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
                     echo "<td>".$rows["shop_quantity"]."</td>";
                     echo "<td>".$rows["sold_quantity"]."</td>";
                     echo "<td>".$rows["lef"]."</td>";
                     echo "<td>".$rows["BANNED_OR_NOT"]."</td>";
                     $m=$rows["med_id"];
                     if($rows["BANNED_OR_NOT"]!="BANNED"&&$rows["BANNED_OR_NOT"]!="EXPIRED"){
                     echo "<td><a href='php_selectbranch_medicine.php?edit=$m&sname=$sd'><button>update_quantity</button></a></td>";
                     }
                     else{
                        echo "<td>you cannot update this</td>";
                      }
                     //echo "<td><a href='php_selectbranch_medicine_delete.php?edit=$m&sname=$sd'><button>Delete this medicine</button></a></td>";

                echo "</tr>";
               $i++;
                 }
        
             }
             else
             {
                $me="BANNED";
                $ex="EXPIRED";
                
                $s="SELECT * FROM medicine WHERE medicine.med_id='$m1' AND medicine.BANNED_OR_NOT!='$me' AND medicine.BANNED_OR_NOT!='$ex'";
                $q=mysqli_query($conn,$s);
                 
                if(mysqli_num_rows($q)>0)
               {
                $sql1="INSERT INTO from_shop_medicine VALUES('$sd','$m1','0','0')";
                $res1=mysqli_query($conn,$sql1);
                $sql2="SELECT medicine.med_id,medicine.med_name,from_shop_medicine.shop_quantity,from_shop_medicine.sold_quantity,from_shop_medicine.shop_quantity-from_shop_medicine.sold_quantity AS lef,medicine.BANNED_OR_NOT FROM (medicine INNER JOIN from_shop_medicine ON medicine.med_id=from_shop_medicine.med_id) WHERE from_shop_medicine.shop_id='$sd' AND medicine.med_id='$m1'";

                $res=mysqli_query($conn,$sql2);
                $i=1;
                if(mysqli_num_rows($res)>0)
                 {
                while($rows=mysqli_fetch_assoc($res))
                {
                     
                     echo "<tr>";
                     echo "<td>".$i."</td>";
                     echo "<td>".$rows["med_id"]."</td>";
                     echo "<td>".$rows["med_name"]."</td>";
                     echo "<td>".$rows["shop_quantity"]."</td>";
                     echo "<td>".$rows["sold_quantity"]."</td>";
                     echo "<td>".$rows["lef"]."</td>";
                     echo "<td>".$rows["BANNED_OR_NOT"]."</td>";
                     $m=$rows["med_id"];
                      if($rows["BANNED_OR_NOT"]!="BANNED"&&$rows["BANNED_OR_NOT"]!="EXPIRED"){
                     echo "<td><a href='php_selectbranch_medicine.php?edit=$m&sname=$sd'><button>update_quantity</button></a></td>";
                     }
                     else{
                        echo "<td>you cannot update this</td>";
                      }
                    
                     //echo "<td><a href='php_selectbranch_medicine.php?edit=$m&sname=$sd'><button>update_quantity</button></a></td>";
                     //echo "<td><a href='php_selectbranch_medicine_delete.php?edit=$m&sname=$sd'><button>Delete this medicine</button></a></td>";
                echo "</tr>";
               $i++;
                 }//while1
        
             }//if1
             
      
            }            
                         
            
             
             elseif(strlen($m1)==5&&mysqli_num_rows($q)==0)
             {
                 echo"you cannot add this  medicine because it is banned or expired or given wrong medicine id ";
             }
             else{
                    echo "give correct id";
              }
             
          
           }
       }
    }


?>

