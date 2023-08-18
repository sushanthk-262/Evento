<?php
if(isset($_POST['login']))
{
    $user = 'root';
    $password = 'Rishik@123';
     
    $database = 'uday';
     
    $servername='localhost:3306';
    $mysqli = new mysqli($servername, $user,
                    $password, $database);
     
    if ($mysqli->connect_error) {
        die('Connect Error (' .
        $mysqli->connect_errno . ') '.
        $mysqli->connect_error);
    }
    $name = $_POST['user'];
    $password = $_POST["pass"];
    $sql = "select * from login";
    $result2 = $mysqli->query($sql);
    while($row = $result2->fetch_assoc()){
        if($name == $row['user'])
        {
            if($password == $row['password'])
            {
                session_start();
                $_SESSION["username"] = $name;
                if($row['type'] == "admin")
                {
                    echo '<script>alert("Successfully Logged In as Admin");window.location = "uday.php";</script>';
                }
                else
                {
                    echo '<script>alert("Successfully Logged In as User");window.location = "uday.php";</script>';
                }
            }
            else
            {
                echo '<script>alert("Wrong Password");
                window.location = "userlogin.php";</script>';
            }
        }
    }
        echo '<script>alert("User Not Found");window.location = "userlogin.php";</script>';
    $mysqli->close();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<style>

body, html {
  height: 100%;
  margin: 0;
}

.submit_button{
	margin: 30px;
	padding: 10px 25px;
}
.box{
	border: 4px solid black;
	width : 400px;
	box-shadow: 7px 5px 20px 10px #aaaaaa;
	margin-top: 250px;
	color : white;
	padding: 40px
}
input{
	padding: 10px; 
	border: 1px solid black
}

table{
	font-size:20px;
}

body{
  background-image: url("loginbackground.jpg");
  height: 100%; 
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>User Login</title>
</head>
<body>
	<center>
	<div align="center">
		<div class = "box"> 
		
		<h1>User Login</h1>
		
		<form action="userlogin.php" method="post">
			<table>
				<tr>
					<td>
						Username :
					</td>
					<td>
						<input type="text" name="user" />
					</td>
				</tr>
				
				<tr>
					<td>
						Password :
					</td>
					<td>
						<input type="password" name="pass" />
					</td>
				</tr>
			</table>
			
			<input class="submit_button" type="submit" name = "login" value="Login"/>
		</form>
	</div>
	</div>
	</center>
</body>
</html>