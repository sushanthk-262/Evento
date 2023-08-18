<!DOCTYPE html>
<html lang="en">
<?php
$user = 'root';
$password = 'Rishik@123';
 
$database = 'dbmsmini';
 
// Server is localhost with
// port number 3306
$servername='localhost:3306';
$mysqli = new mysqli($servername, $user,
                $password, $database);
 
// Checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
$date = date("Y-m-d");
$sql = " SELECT * FROM events where event_date >= '".$date."' and seats_available > 0";
$result = $mysqli->query($sql);
$mysqli->close();
?>
<?php
if(isset($_POST['add']))
{
    $user = 'root';
    $password = 'Rishik@123';
     
    $database = 'dbmsmini';
     
    // Server is localhost with
    // port number 3306
    $servername='localhost:3306';
    $mysqli = new mysqli($servername, $user,
                    $password, $database);
     
    // Checking for connections
    if ($mysqli->connect_error) {
        die('Connect Error (' .
        $mysqli->connect_errno . ') '.
        $mysqli->connect_error);
    }
    $name = $_POST['name'];
    $city = $_POST['city'];
    $cate = $_POST['cate'];
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $price = $_POST['price'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $stock = $_POST['ticket'];
    $sql = "insert into events(city_name,event_category,event_name,event_date,event_time,seats_available,ticket_price,image) values('".$city."','".$cate."','".$name."','".$date."','".$time."',".$stock.",".$price.",'".$image."')";
    if ($mysqli->query($sql) === TRUE) {
        echo '<script>alert("Event Added");window.location = "admin.php";</script>';;
      } else {
        echo '<script>alert("Error");window.location = "admin.php";</script>';
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
    <link rel="stylesheet" href="s4.css">
    <link rel="stylesheet" href="s3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap">
</head>

<body style="background-color: black;">
    <div id="blur">
        <nav class = navbar>
            <ul class="menu">
                <li><a href="admin.php" style = "color: white" onclick="window.location.href = 'admin.php'"><i class="fa fa-home" style="font-size:35px" aria-hidden="true"></i></a></li>
                <li><a href="#2" style = "color: white" onclick="toggle1()"><i class="fa fa-plus"style="font-size:35px" aria-hidden="true"></i></a></li>
                <li><a href="#4" style = "color: white" onclick = "toggle2()"><i class="fa fa-map-marker" style="font-size:35px"
                        aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="admin.php" style = "color: white" onclick="window.location.href = 'user.php'" ><i class="fa fa-sign-out" style="font-size:35px" aria-hidden="true"></i></a>
                </li>
            </ul>
        </nav><br>
        <center>
        <h1 style = "color:white">One8 Events</h1>
</center>
        <center>
         <h1 style = "color:white">Future Events: </h1>
</center>
        <div class="main-carousel">
            <?php $row = $result->fetch_assoc() ?> 
                    <a href="#">
                    <div class="events" style="margin-left:150px">
                    <div class="event-part">
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" alt="Avatar" class="image" style="width:100%"/>
                    </div>
                    <div class="desc" style="color: grey"><span><b style="font-size: 1.3rem;">
                     <?php echo ($row['event_name'])?><br>
                      </b></span>
                    </div>
                </div>
                </a> 
            <?php while($row = $result->fetch_assoc()){ ?> 
                    <a href="#">
                    <div class="events">
                    <div class="event-part">
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" alt="Avatar" class="image" style="width:100%"/> 
                    </div>
                    <div class="desc" style="color: grey"><span><b style="font-size: 1.3rem;">
                     <?php echo ($row['event_name'])?><br>
                    </b></span>
                    </div>
                </div>
                </a> 
        <?php } ?>
        </div>
    </div>
    <div id="popupadd">
        <label for="show" class="close-btn fas fa-times" title="close"></label>
        <div class="Add">
               Add Events
         </div>
        <form method ="post" enctype="multipart/form-data" action = "admin.php">
            <div class="data">
                <label>Event Name: </label>
                <input type="text" name = "name" required>
            </div>
            <div class="formcate">
                <label>Choose City: </label>
                 <select id = "city" name = "city">
            <option value = "Hyderabad">Hyderabad</option>
            <option value = "Chennai">Chennai</option>
            <option value = "Mumbai">Mumbai</option>
            <option value = "Delhi">Delhi</option>
            </select>
            </div>
             <div class="formcate">
                <label>Choose Category: </label>
                 <select id = "cate" name = "cate">
            <option value = "Music">Music</option>
            <option value = "Dance">Dance</option>
            <option value = "Sports">Sports</option>
            <option value = "Comedy">Comedy</option>
            <option value = "Motivational Talks">Motivational Talks</option>
            <option value = "Exhibition">Exhibition</option>
            </select>
            </div>
            <div class="data">
                <label>Event Date: </label>
                <input type="date" name = "date" required>
            </div>
            <div class="data">
                <label>Event Time: </label>
                <input type="time" name = "time" required>
            </div>
            <div class="data">
                <label>Ticket Price: </label>
                <input type="text" name = "price" required>
            </div>
            <div class="data">
                <label>Tickets Available: </label>
                <input type="text" name = "ticket" required>
            </div>
            <div class = "formimage">
            <label>Event Image: </label>
           <input type="file" name = "image" required/>
            </div>
            <div class="btn">
                <div class="inner"></div>
                <button type="submit" name = "add">Add</button>
            </div>
        </form>
        <div style="text-align: center;">
            <a href="#" style="text-align: center" onclick="toggle1()">Close</a>
        </div>
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
            <a href="#" style="text-align: center" onclick="toggle2()">Close</a>
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
        function toggle1() 
        {   
            var blur = document.getElementById('blur');
            blur.classList.toggle('active');
            var popupadd = document.getElementById('popupadd');
            popupadd.classList.toggle('active');
        }
        function toggle2()
        {
            var blur = document.getElementById('blur');
            blur.classList.toggle('active');
            var location = document.getElementById('location');
            location.classList.toggle('active');
        }
    </script>
</body>
</html>