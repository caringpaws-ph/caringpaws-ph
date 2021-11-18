<?php
    session_start();
    include_once '../assets2/conn/dbconnect.php';   

    $birthDate = isset($_POST['birthdate']) ? $_POST['birthdate'] : null;

	$bday = new DateTime($birthDate); // Your date of birth
	$today = new Datetime(date('m.d.y'));
	$diff = $today->diff($bday);

		?>
					<td id="agecompute"><input type="text" style="font-weight: bold;" class="form-control" name="AgeReg" value="<?php echo $diff->y; ?>"/></td>
        <?php

?>