<?php
    session_start();
    include_once '../assets2/conn/dbconnect.php';   

    $selectedDay = isset($_POST['enterdate']) ? $_POST['enterdate'] : null;

    //Our YYYY-MM-DD date string.
    $date = $selectedDay;

    //Convert the date string into a unix timestamp.
    $unixTimestamp = strtotime($date);

    //Get the day of the week using PHP's date function.
    $dayOfWeek = date("l", $unixTimestamp);

	?>
	    <td id="scheduled"><input type="text" class="select form-control" id="scheduleday" name="scheduleday" value="<?php echo $dayOfWeek; ?>"></td>
    <?php

?>