<?php

if(isset($_GET['row']) && isset($_GET['col'])) {
    $win = false;
    $loss = false;
    $decision = null;
    $row = $_GET['row'];
    $col = $_GET['col'];
    $mix = $row.','.$col;
    
    $conn = mysqli_connect('localhost', 'root', '','wumpus');
    if (!$conn) {
        echo "Connection failed";
    }
    
    $query = "SELECT * from wumpuses Where location = '$mix'";
    $result = mysqli_query($conn, $query);
    if ($result) {
       if (mysqli_num_rows($result) > 0){
        $win = true;
        $loss = false;
        $decision = 1;
       } else {
        $loss = true;
        $win= false;
        $decision = 0;
       }
    } else {
        echo 'wrong entry';
    }

} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/wumpus.css">
    <title>Result</title>
</head>
<body>
        <div style="max-width:550px; margin-left: 350px">
            <div style="margin-bottom:100px">
                <center>
                    <?php 
                        if($win == true){
                            echo "<img height='550px' src='./imgs/champ.gif'>";
                        } else {
                            echo "<img src='./imgs/fail.jpg'>";
                        }
                    ?> 
                </center>
            </div>
            <form action="save.php" method="post">
                <div class="section">
                    <label for="">Email Address</label> <br>
                    <input type="text" style="width:100%" required class="email" name="email">
                    <input type="hidden" name="decision" value="<?php echo $decision; ?>">
                </div>
                <div style="margin-top:30px">
                    <input type="submit" style="width:100%; background-color: green; color:white; border:none" name="submit" value="Submit" >
                </div>
            </form>
        </div>
    
</body>
</html>