<?php
	session_start();
	//check if can login again
	if(isset($_SESSION['attempt_again'])){
		$now = time();
		if($now >= $_SESSION['attempt_again']){
			unset($_SESSION['attempt']);
			unset($_SESSION['attempt_again']);
		}
	}
	
?>
<!DOCTYPE html>
<html>


<head>
<style>

input
{
   height:30px;
   width:300px;
   background-color:Aliceblue;
}


body {
  background: url("Ph3.jpeg");
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
}

.center {
  margin: 0;
  position: absolute;
  top: 45%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  border:2px solid black;
  border-radius:16px;
   background-image: url("Ph3.jpeg");
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
   padding:10px 20px;
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
<center>
<div class="center">
<h1>EMPLOYEE LOGIN</h1>
      <form method="POST" action="php_employee_login.php">
			<label for="u">USERNAME:</label><input type="text" id="u" name="u"><br></br>
<label for="p">PASSWORD:</label><input type="password" id="p" name="p"><br></br>
<button type="submit" name="login" class="btn btn-primary">LOGIN</button><br><br>
	
				
							</form>
<a href="DBMS1.html"><button>BACK</button></a><br>


			<?php
				if(isset($_SESSION['error'])){
					?>
						<?php echo $_SESSION['error']; ?>
					<?php

					unset($_SESSION['error']);
				}

				if(isset($_SESSION['success'])){
					?>
					
						<?php echo $_SESSION['success']; ?>
                   

					<?php

					unset($_SESSION['success']);
				}
			?>

</div>
</body>
</center>
</html>


