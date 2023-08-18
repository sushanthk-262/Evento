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
if(isset($_POST['submit']))
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
    $name = $_POST['u'];
    $password = $_POST["p"];
    $sql = "select * from login";
    $result2 = $mysqli->query($sql);
    while($row = $result2->fetch_assoc()){
        if($name == $row['username'])
        {
            if($password == $row['password'])
            {
                session_start();
                $_SESSION["username"] = $name;
                if($row['type'] == "admin")
                {
                    echo '<script>alert("Successfully Logged In as Admin");window.location = "admin.php";</script>';
                }
                else
                {
                    echo '<script>alert("Successfully Logged In as User");window.location = "user.php";</script>';
                }
            }
            else
            {
                echo '<script>alert("Wrong Password");
                window.location = "user.php";</script>';
            }
        }
    }
        echo '<script>alert("User Not Found");window.location = "user.php";</script>';
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
                <li><a href="user.php" style = "color: white" onclick="window.location.href = 'user.php'"><i class="fa fa-home" style="font-size:35px" aria-hidden="true"></i></a></li>
                <li><a href="#" style = "color: white" onclick = "toggle()"><i class="fa fa-user" style="font-size:35px"
                    aria-hidden="true"></i></a></li>
                <li>
                    <a href="#4" style = "color: white" onclick="toggle2()"><i class="fa fa-map-marker" style="font-size:35px"
                        aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="user.php" style = "color: white" onclick="window.location.href = 'logout.php'"><i class="fa fa-sign-out" style="font-size:35px" aria-hidden="true"></i></a>
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
    <div id="popup">
        <label for="show" class="close-btn fas fa-times" title="close"></label>
        <div class="signin">
            Sign In or Sign Up
        </div>
        <form action="user.php" method = "post">
            <div class="data">
                <label>Email or Phone</label>
                <input type="text" name = "u" required>
            </div>
            <div class="data">
                <label>Password</label>
                <input type="password" name = "p" required>
            </div>
            <div class="btn">
                <div class="inner"></div>
                <button type="submit" name = "submit">login</button>
            </div>
        </form>
        <div style="text-align: center;">
            <a href="#" style="text-align: center" onclick="toggle()">Close</a>
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
        function toggle() 
        {   
           <?php 
           if(isset($_SESSION["username"])){
            ?>
            alert("Already Logged In");
           <?php }
           else{
            ?>
            var blur = document.getElementById('blur');
            blur.classList.toggle('active');
            var popup = document.getElementById('popup');
            popup.classList.toggle('active');
            <?php }?>
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