<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "esp32";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}


if (isset($_POST['toggle_LED'])) {
	$sql = "SELECT * FROM LED_status;";
	$result   = mysqli_query($conn, $sql);
	$row  = mysqli_fetch_assoc($result);
	
	if($row['status'] == 0){
		$update = mysqli_query($conn, "UPDATE LED_status SET status = 1 WHERE id = 1;");		
	}		
	else{
		$update = mysqli_query($conn, "UPDATE LED_status SET status = 0 WHERE id = 1;");		
	}
}



$sql = "SELECT * FROM LED_status;";
$result   = mysqli_query($conn, $sql);
$row  = mysqli_fetch_assoc($result);	

?>



<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js" type="text/javascript"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="mx-auto bg-gray-200 max-w-screen-sm rounded-2xl p-10 text-center"> 
    <div class="flex items-center justify-between text-left">
        <div id="refresh" class="text-left">
            <h1 class="text-center">El estado de la lampara es: <?php echo $row['status']; ?></h1>
            
            <form action="index.php" method="post" id="LED" enctype="multipart/form-data" class="mt-4">            
                <input id="submit_button" type="submit" name="toggle_LED" value="Switch" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            </form>
            <br><br><br><br><br><br>
            <h1 class="text-left">Temperatura: 15°C</h1>
        </div>

        
        
        <?php if ($row['status'] == 0): ?>
            <img id="contest_img" src="led_off.png" alt="LED Off" class="w-60 h-60 p-10">
        <?php else: ?>
            <img id="contest_img" src="led_on.png" alt="LED On" class="w-60 h-60 p-10">
        <?php endif; ?>
    </div>
</div>

</body>
</html>
