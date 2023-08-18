<!DOCTYPE html>
<html lang="en">
<?php error_reporting (E_ALL ^ E_NOTICE); ?> 
<?php session_start() ?> 
<?php
if(isset($_POST['submit']))
{
    $user = 'root';
  $password = 'Sushanth@123';
   $database = 'uday';
 
$servername='localhost:3306';
$mysqli = new mysqli($servername, $user,
                $password, $database);
 

if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
$city = $_POST['city'];
$date = date("Y-m-d");
$sql1 = "select * from events where city_name = '".$city."' and event_date >= '".$date."' and seats > 0";
$sql2 = "select event_category from events where city_name = '".$city."' and event_date >= '".$date."' and seats> 0";
$result1 = $mysqli->query($sql1);
$result2 = $mysqli->query($sql2);
$mysqli->close();
}
 ?>
 <?php
if(isset($_POST['apply']))
{
    $user = 'root';
  $password = 'Sushanth@123';
   $database = 'uday';
 
$servername='localhost:3306';
$mysqli = new mysqli($servername, $user,
                $password, $database);
 

if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
$city = $_POST['city'];
$cate = $_POST['cate'];
$date = date("Y-m-d");
$sql1 = "select * from events where city_name = '".$city."' and event_category = '".$cate."' and event_date >= '".$date."' and seats > 0";
$sql2 = "select event_category from events where city_name = '".$city."' and event_date >= '".$date."' and seats > 0";
$result1 = $mysqli->query($sql1);
$result2 = $mysqli->query($sql2);
$mysqli->close();
}
 ?>
 <?php
if(isset($_POST['book']))
{
    if(!isset($_SESSION["username"]))
    {
        echo '<script>alert("Login First");window.location = "userlogin.php";</script>';
    }
    $user = 'root';
  $password = 'Sushanth@123';
   $database = 'uday';
 
$servername='localhost:3306';
$mysqli = new mysqli($servername, $user,
                $password, $database);
 

if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
    $name = $_POST['name'];
    $city = $_POST['city'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $user = $_POST['user'];
    $stock = $_POST['qty'];
    $status = $_POST['status'];
    $id = $_POST['id'];
    echo "select seats from events where id = ".$id;
    $sql3 = "select seats from events where id = ".$id;
    $result = $mysqli->query($sql3);
    if($stock <= 0)
    {
        echo '<script>alert("Enter Valid no of tickets");window.location = "uday.php";</script>';
    }
    while($row = $result->fetch_assoc())
    {
        if($row['seats'] < $stock)
        {
            echo '<script>alert("Sorry no sufficient tickets");window.location = "uday.php";</script>';
        }
    }
    if($stock > 0)
    {
    $sql = "insert into booked values('".$city."','".$name."','".$date."','".$time."','".$user."',".$stock.",'".$status."',".$id.")";
    $sql2 = "update events set seats = seats - ".$stock." where id = ".$id;
    if ($mysqli->query($sql) === TRUE && $mysqli->query($sql2) === TRUE) {
        echo '<script>alert("Tickets Booked");window.location = "uday.php";</script>';
      } else {
        echo '<script>alert("Error");</script>';
      }
    }
    $mysqli->close();
}
 ?>
 <head>
    <title>one8 Events</title>
    <style>
        th,tr,td{
            text-align:center;
        }
        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(events.jpg);
            color: white;
            padding-top: 50px;
        }
        </style>
</head>
<body>
    <center>
    <h1 style = "font-size: 1.5rem" >FIND EVENTS</h1>
    </center>
<center>
        <form method = "post" action = "uday.php">
        <label for="city">Choose City:</label>
             <select name=  "city" id="city">
             <option name = "1">Select</option>
                <option value = "Hyderabad">Hyderabad</option>
                <option value = "Delhi">Delhi</option>
                <option value = "Chennai">Chennai</option>
                <option value = "Mumbai">Mumbai</option>
</select>
<input type = "submit" name = "submit" value = "Submit">
</form><br>
</center>
        <center>
        <form method = "post" action = "uday.php">
        <label for="cate">Choose Category:</label>
<select name=  "cate" id="cate">
    <option name = "1">Select</option>
  <?php while($row = $result2->fetch_assoc()){?>
    <option value="<?php echo $row['event_category'];?>"><?php echo $row['event_category'];?></option>
  <?php }?>
</select>
<input type = "hidden" name = "city" value = "<?php echo $city?>">
<input type = "submit"  name = "apply" value = "Apply">
</form><br>
</center>
<table style="width:100%">
    <tr><th>City Name</th><th>Event Name</th><th>Event Category</th><th>Event Date</th><th>Event Time</th><th>Ticket Price</th><th>Tickets Available</th><th>Edit</th>    </tr>
    <?php while($row = $result1->fetch_assoc()){?>
        <form method = "post" action = "uday.php">
                    <input type = "hidden" name = "city" value = "<?php echo ($row['city_name'])?>">
                    <input type = "hidden" name = "name" value = "<?php echo ($row['event_name'])?>">
                    <input type = "hidden" name = "date" value = "<?php echo ($row['event_date'])?>">
                    <input type = "hidden" name = "time" value = "<?php echo ($row['event_time'])?>">
                    <input type = "hidden" name = "user" value = "<?php echo $_SESSION['username']?>">
                    <input type = "hidden" name = "id" value = "<?php echo $row['Id']?>">
                    <input type = "hidden" name = "status" value = "booked">
    <tr><td><?php echo $row['city_name']; ?></td><td><?php echo $row['event_name']; ?></td><td><?php echo $row['event_category']; ?></td><td><?php echo $row['event_date']; ?></td><td><?php echo $row['event_time']; ?></td><td><?php echo $row['price']; ?></td><td><?php echo $row['seats']; ?></td><td><input type = "number" id = "qty" name = "qty" style = "width:40px"> <input type = "submit" name = "book" value = "book"></td></tr>
    </form>
  <?php }?>
</table>
<center>
<h1>Login Page</h1>
<input type = "submit" name = "login" value = "Home" onclick = "window.location.href = 'userlogin.php'">
</center>
<center>
<h1>LogOut</h1>
<input type = "submit" name = "logout" value = "LogOut" onclick = "window.location.href = 'logout.php'">
</center>
</body>

</html>
