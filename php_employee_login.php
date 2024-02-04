<?php
	session_start();

	if(isset($_POST['login'])){
		//connection
		$conn = mysqli_connect('localhost', 'root', '')or die(my_sqli_error($conn));
   mysqli_select_db($conn,"xyz") or die(my_sqli_error($conn));

		//set login attempt if not set
		if(!isset($_SESSION['attempt'])){
			$_SESSION['attempt'] = 0;
		}

		//check if there are 3 attempts already
		if($_SESSION['attempt'] == 3){
            
			$_SESSION['error'] = "<script>location.href='DBMS1.html'</script>";
            unset($_SESSION['attempt']);
		}
		else{
			//get the user with the email
            $f=0;
            $u=$_POST["u"];
            $p=$_POST["p"];
			$sql = "SELECT * FROM employee_subschema WHERE employee_subschema.username = '$u'AND employee_subschema.password='$p'";
           
			$query = mysqli_query($conn,$sql);
			if(mysqli_num_rows($query) > 0){
                 
               $sql2="SELECT * FROM (employee INNER JOIN employee_subschema ON employee.username=employee_subschema.username) WHERE employee.e_id=employee.mang_id AND employee_subschema.username='$u' AND employee_subschema.password='$p'";
               $result2=mysqli_query($conn,$sql2);
              if(mysqli_num_rows($result2)==1)
              { 
                 unset($_SESSION['attempt']);  
                 $_SESSION["success"]="<script>location.href='DBMS4.php'</script>";   
               }
              else
                {
                    unset($_SESSION['attempt']);
                    $sql1 = "SELECT * FROM (employee INNER JOIN employee_subschema ON employee_subschema.username=employee.username ) WHERE employee_subschema.username = '$u'AND employee_subschema.password='$p'";
                     $query1 = mysqli_query($conn,$sql1);
                      $r=mysqli_fetch_assoc($query1);
                        $e=$r["e_id"];
                   $_SESSION["success"]="<a href='DBMS5.php?emp=$e'><button>you are a pharmacist then hit this to login to your page</button></a>";
              }
       
	                
	
                   
				}
				else{
					$_SESSION['error'] = "fill correct login credintals";
					//this is where we put our 3 attempt limit
					$_SESSION['attempt'] += 1;
					if($_SESSION['attempt'] == 3){
            
			           $_SESSION['error'] = "<script>location.href='DBMS1.html'</script>";
                        unset($_SESSION['attempt']);
		                   }
					}
				}
			}

		


  
	header('location: DBMS3.php');

?>