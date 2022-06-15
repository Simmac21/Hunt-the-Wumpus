<?php
$conn = mysqli_connect('localhost', 'root', '','wumpus');
if (!$conn) {
    echo "Connection failed";
}
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $decision = $_POST['decision'];
    $date = date('Y/m/d');
    $win = 0;
    $loses = 0;

    if($decision == 1){
        $win = 1;
    } else {
        $loses = 1;
    }
   
    

    $query = "SELECT * from players Where email_address = '$email'";
    $result = mysqli_query($conn, $query);
    if ($result) {
       if (mysqli_num_rows($result) > 0){
            $player = mysqli_fetch_assoc($result);
            if($decision == 1) {
                $wins = $player['wins'];
                $wins = $wins + 1;
                $query = "UPDATE players SET wins= '$wins' WHERE email_address='$email'";
                $fire = mysqli_query($conn,$query);
            } else {
                $loses = $player['loses'];
                $loses = $loses + 1;
                $query = "UPDATE players SET loses= '$loses' WHERE email_address='$email'";
                $fire = mysqli_query($conn,$query);
            }
       } else {
        $query = "INSERT INTO players(email_address, wins, loses, date_last_played) VALUES('$email','$win','$loses','$date')";
        $fire = mysqli_query($conn,$query);
        echo "<script> alert('Player Added!') </script>";
       }
    } else {
        echo 'wrong entry';
    }
    header('location:save.php?msg=Your Game has been Recorded!&email='.$email.'');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/wumpus.css">
    <title>Records</title>


    <style>
        #players {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #players td, #players th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        #players th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
        }
</style>

</head>
<body>
    <?php
    $msg = null;
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }

    $current_player_wins = null;
    $current_player_loses = null;

    if(isset($_GET['email'])){
        $email = $_GET['email'];
        $query = "SELECT * from players Where email_address = '$email'";
        $result = mysqli_query($conn, $query);
        $current_player = mysqli_fetch_assoc($result);
        $current_player_wins = $current_player['wins'];
        $current_player_loses = $current_player['loses'];
    }
    ?>

    <div>
        <div style="margin-top:60px;">
        <center><span style="padding:30px; background-color:red; color:white; font-size:35px"><?php echo $msg; ?></span> </center> 
        </div>

        <div style="margin-top:55px;">
          <p>  Your Email: <span style="color:red"><?php echo $_GET['email']; ?> </span> &nbsp;&nbsp;
           Wins: <span style="color:red"><?php echo $current_player_wins; ?> </span> &nbsp;&nbsp;
           Loses: <span style="color:red"><?php echo $current_player_loses; ?> </span></p> 
        </div>

        <table id="players" style="margin-top:60px;">
        <tr>
            <th>Email</th>
            <th>Wins</th>
            <th>Loses</th>
        </tr>

        <?php
        $query1 = "SELECT * FROM players order by wins DESC limit 10 ";
        $fire1 = mysqli_query($conn,$query1);
        if (mysqli_num_rows($fire1)>0){
            while ($players = mysqli_fetch_assoc($fire1)){ ?>
        <tr>
            <td> <?php echo $players['email_address']; ?> </td>
            <td> <?php echo $players['wins']; ?></td>
            <td> <?php echo $players['loses']; ?> </td>
        </tr>
                <?php  
            }
        } else { ?>
                <tr>
                    <td colspan="2" class="text-center">
                    <h2 class="text-muted"> There is no Data to Show!!</h2>
                    </td>
                </tr>
            <?php } ?>  
        </table>
    </div>

   <center>
        <div style='width:230px; margin-top:50px;'>
            <a href="index.php">Play Again</a>
        </div>
   </center>
    
</body>
</html>