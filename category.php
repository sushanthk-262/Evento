<!DOCTYPE html>
<html lang="en">
<?php error_reporting (E_ALL ^ E_NOTICE); ?> 
<?php

        $user = 'root';
  $password = 'Rishik@123';
   session_start();
   $database = 'dbmsmini';
 
$servername='localhost:3306';
$mysqli = new mysqli($servername, $user,
                $password, $database);
 

if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
if(isset($_POST['apply']))
{
    $_SESSION['city'] = $_POST['city'];
}
 if(!isset( $_SESSION['city']))
 {
    $_SESSION['city'] = $_POST['city'];
 }
        $date = date("Y-m-d");
        $sql1 = "select * from events where city_name = '".$_SESSION['city']."' and event_date >= '".$date."' and seats_available > 0";
    $sql2 = "select event_category from events where city_name = '".$_SESSION['city']."' and event_date >= '".$date."' and seats_available > 0";
    $result1 = $mysqli->query($sql1);
    $result2 = $mysqli->query($sql2);
    $mysqli->close();

?>
<?php
if(isset($_POST['submit']))
{
    $user = 'root';
$password = 'Rishik@123';
 
$database = 'dbmsmini';
 
$servername='localhost:3306';
$mysqli = new mysqli($servername, $user,
                $password, $database);
 
if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
    $date = date("Y-m-d");
    $cate = $_POST['cate'];
    $city = $_SESSION['city'];
    $sql2 = "select event_category from events where city_name = '".$city."' and seats_available > 0 and event_date >= '".$date."'";
    $sql1 = "select * from events where city_name = '".$city."' and event_category = '".$cate."' and seats_available > 0 and event_date >= '".$date."'";
    $result1 = $mysqli->query($sql1);
    $result2 = $mysqli->query($sql2);
    $mysqli->close();
}
?>
<?php
if(isset($_POST['buy']))
{
    if(!isset($_SESSION["username"]))
    {
        echo '<script>alert("Login First");window.location = "category.php";</script>';
    }
    $user = 'root';
$password = 'Rishik@123';
 
$database = 'dbmsmini';
 
$servername='localhost:3306';
$mysqli = new mysqli($servername, $user,
                $password, $database);
 
if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
    $name = $_POST['name'];
    $city = $_SESSION['city'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $user = $_POST['user'];
    $stock = $_POST['qty'];
    $status = $_POST['status'];
    $id = $_POST['id'];
    $sql3 = "select seats_available from events where id = ".$id;
    $result = $mysqli->query($sql3);
    if($stock <= 0)
    {
        echo '<script>alert("Enter Valid no of tickets");window.location = "category.php";</script>';
    }
    while($row = $result->fetch_assoc())
    {
        if($row['seats_available'] < $stock)
        {
            echo '<script>alert("Sorry no sufficient tickets");window.location = "category.php";</script>';
        }
    }
    if($stock > 0)
    {
    $sql = "insert into booked values('".$city."','".$name."','".$date."','".$time."','".$user."',".$stock.",'".$status."')";
    $sql2 = "update events set seats_available = seats_available - ".$stock." where id = ".$id;
    if ($mysqli->query($sql) === TRUE && $mysqli->query($sql2) === TRUE) {
        echo '<script>alert("Tickets Booked");window.location = "category.php";</script>';
      } else {
        echo '<script>alert("Error");window.location = "category.php";</script>';
      }
    }
    $mysqli->close();
}
?>
<head>
    <title>one8 Events</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="s3.css">
    <link rel="stylesheet" href="s4.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap">
    <style>
        .myButton {
	box-shadow:inset 0px 1px 0px 0px #97c4fe;
	background:linear-gradient(to bottom, #3d94f6 5%, #1e62d0 100%);
	background-color:#3d94f6;
	border-radius:15px;
	border:1px solid #337fed;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	
	font-weight:bold;
	padding:4px 17px;
	text-decoration:none;
	text-shadow:0px 1px 0px #1570cd;
}
.myButton:hover {
	background:linear-gradient(to bottom, #1e62d0 5%, #3d94f6 100%);
	background-color:#1e62d0;
}
.myButton:active {
	position:relative;
	top:1px;
}
.buy-button {
  background: #000000;
  background-image: -webkit-linear-gradient(top, #000000, #000000);
  background-image: -moz-linear-gradient(top, #000000, #000000);
  background-image: -ms-linear-gradient(top, #000000, #000000);
  background-image: -o-linear-gradient(top, #000000, #000000);
  background-image: linear-gradient(to bottom, #000000, #000000);
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0px;
  font-family: Georgia;
  color: #f2edf2;
  font-size: 20px;
  padding: 5px 3px 5px 3px;
  text-decoration: none;
}

.buy-button:hover {
  background: #f7f7f7;
  background-image: -webkit-linear-gradient(top, #f7f7f7, #121112);
  background-image: -moz-linear-gradient(top, #f7f7f7, #121112);
  background-image: -ms-linear-gradient(top, #f7f7f7, #121112);
  background-image: -o-linear-gradient(top, #f7f7f7, #121112);
  background-image: linear-gradient(to bottom, #f7f7f7, #121112);
  text-decoration: none;
}

    </style>
</head>

<body style="background-color: black;">
    <div id="blur">
        <nav class = navbar>
            <ul class="menu">
                <li>
                    <a href="#4" style = "color: white" onclick="window.location.href = 'user.php'"><i class="fa fa-home" style="font-size:35px" aria-hidden="true" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="#4" style = "color: white" onclick = "toggle()"><i class="fa fa-map-marker" style="font-size:35px"
                        aria-hidden="true"></i></a>
                </li>
            </ul>
        </nav><br>
        <center>
        <form method = "post" action = "category.php">
        <label for="cate" style = "color:white">Choose Category:</label>
<select name=  "cate" id="cate">
    <option name = "1">Select</option>
  <?php while($row = $result2->fetch_assoc()){?>
    <option value="<?php echo $row['event_category'];?>"><?php echo $row['event_category'];?></option>
  <?php }?>
</select>
<input type = "submit" class = "myButton" name = "submit">
</form><br>
</center>
            <?php $count = 0; while($row = $result1->fetch_assoc()){ 
                 if($count % 3 == 0)
                 {?>
                    <a href="#">
                    <div class="events" style = "margin-left: 200px;">
                    <div class="event-part">
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" alt="Avatar" class="image" style="width:100%"/> 
                    </div>
                    
                    <div class="desc" style="color: grey"><span><b style="font-size: 1.3rem;">
                     <?php echo ($row['event_name'])?><br>
                    <?php echo ($row['event_category'])?></b></span><br>
                    <?php echo ($row['event_date'])?> | <?php echo ($row['event_time'])?> <br> 
                    <?php echo ($row['city_name'])?><br>
                    Rs: <?php echo ($row['ticket_price'])?><br>
                    <form method = "post" action = "category.php">
                    <input type = "hidden" name = "city" value = "<?php echo ($row['city_name'])?>">
                    <input type = "hidden" name = "name" value = "<?php echo ($row['event_name'])?>">
                    <input type = "hidden" name = "date" value = "<?php echo ($row['event_date'])?>">
                    <input type = "hidden" name = "time" value = "<?php echo ($row['event_time'])?>">
                    <input type = "hidden" name = "user" value = "<?php echo $_SESSION['username']?>">
                    <input type = "hidden" name = "id" value = "<?php echo $row['id']?>">
                    <label for = "qty">Tickets: </label>
                   <input type = "number" id = "qty" name = "qty"min=1 style = "width:40px">
                   <input type = "hidden" name = "status" value = "booked">
                   <input type = "submit" name = "buy" value = "Book">
                   
                    </div>
                </div>
                </a> 
                <?php }
                else{?>
                    <a href="#">
                    <div class="events">
                    <div class="event-part">
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" alt="Avatar" class="image" style="width:100%"/> 
                    </div>
                    
                    <div class="desc" style="color: grey"><span><b style="font-size: 1.3rem;">
                     <?php echo ($row['event_name'])?><br>
                    <?php echo ($row['event_category'])?></b></span><br>
                    <?php echo ($row['event_date'])?> | <?php echo ($row['event_time'])?> <br> 
                    <?php echo ($row['city_name'])?><br>
                    Rs: <?php echo ($row['ticket_price'])?><br>
                    <form method = "post" action = "category.php">
                    <input type = "hidden" name = "city" value = "<?php echo ($row['city_name'])?>">
                    <input type = "hidden" name = "name" value = "<?php echo ($row['event_name'])?>">
                    <input type = "hidden" name = "date" value = "<?php echo ($row['event_date'])?>">
                    <input type = "hidden" name = "time" value = "<?php echo ($row['event_time'])?>">
                    <input type = "hidden" name = "user" value = "<?php echo $_SESSION['username']?>">
                    <input type = "hidden" name = "id" value = "<?php echo $row['id']?>">
                    <label for = "qty">Tickets: </label>
                   <input type = "number" id = "qty" name = "qty" style = "width:40px">
                   <input type = "hidden" name = "status" value = "booked">
                   <input type = "submit" name = "buy" value = "Book">
                   
                    </div>
                </div>
                </a> 
                <?php }
                $count++;
                 } 
                 $count = 0;?>
    </div>
    <div id="location">
        <label for="show" class="close-btn fas fa-times" title="close"></label>
        <div class="Add">
               Select Location
         </div>
        <form method ="post" action = "category.php">
        <label for="show" class="close-btn fas fa-times" title="close"></label>
        <div class="signin">
            PICK A CITY
         </div><br>
             <div class="formcate">
            <label for="city" style = "color:white" >Choose City:</label>

<select name="city" id="city">
  <option value="Hyderabad">Hyderabad</option>
  <option value="Chennai">Chennai</option>
  <option value="Delhi">Delhi</option>
  <option value="Mumbai">Mumbai</option>
</select>
            </div>
            <div class="btn">
                <div class="inner"></div>
                <button type="submit" name = "apply" onclick = "category.php">Apply</button>
            </div>
        </form>
        <div style="text-align: center;">
            <a href="#" style="text-align: center" onclick="toggle()">Close</a>
        </div>
    </div>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script type="text/javascript">
        $('.main-carousel').flickity({
            // options
            cellAlign: 'left',
            wrapAround: false,
            freeScroll: false
        });
        function toggle() {
            var blur = document.getElementById('blur');
            blur.classList.toggle('active');
            var location = document.getElementById('location');
            location.classList.toggle('active');
        }
        function redirect()
        {
            window.location = 'admin.php';
        }
    </script>
</body>

</html>