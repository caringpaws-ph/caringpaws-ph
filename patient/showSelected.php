<?php
    session_start();
    include_once '../assets2/conn/dbconnect.php';   

    $P = isset($_POST['x']) ? $_POST['x'] : null;

    $con22 = mysqli_connect("sql6.freemysqlhosting.net", "sql6451028", "UssyZb8LGc", "sql6451028");
    $sql22 = "SELECT * from petprofile WHERE Pname = '$P'";
    $res22 = mysqli_query($con22, $sql22);

    while($petRow = mysqli_fetch_array($res22))
	{
        $pmale="";
        $pfemale="";
        
            if ($petRow['Sex']=='Male') {
                $pmale = "checked";	
            }elseif ($petRow['Sex']=='Female') {
                $pfemale = "checked";
            }
		?>
												<tr><td></td><td style="padding-right: 165px;">
												<?php if (!empty($msg)): ?>
														<div class="alert <?php echo $msg_class ?>" role="alert">
												<?php echo $msg; ?>
														</div>
												<?php endif; ?>
													
													<div class="form-group text-center" style="position: relative;" >
												
														<span class="img-div">
															
															<div class="text-center img-placeholder"  onClick="triggerClick2()">
																<h4 style="font-weight: bold;">Update Pet Image</h4>
															</div>		
														
													

														<img src="<?php if(empty($petRow['profile_image'])){
																				echo 'images2/petDefault.png';
																			}
																		else{
																				echo 'images2/' . $petRow['profile_image'];
																			};
																  ?>" style="width: 150px; height: 150px;" onClick="triggerClick2()" id="petDisplay">
														</span>	
														
														<input class="form-control" type="file" name="petImage" onChange="displayImage2(this)" id="petImage" style="display: none;">

													</div>
												</td>
												</tr>
            										<tr>
														<td style="font-weight: bold;">Breed</td>
														<td><input type="text" class="form-control" name="Breed" value="<?php echo $petRow['Breed']; ?>"  /></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Sex</td>
														<td>
															<div class="radio">
																<label><input type="radio" name="petSex" value="Male" <?php echo $pmale; ?>>Male</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="petSex" value="Female" <?php echo $pfemale; ?>>Female</label>
															</div>
														</td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Age</td>
														<td><input type="text" class="form-control" name="Age" value="<?php echo $petRow['Age']; ?>"  /></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Date of Birth</td>
														<!-- <td><input type="text" class="form-control" name="patientDOB" value="<?php echo $petRow['DateofBirth']; ?>"  /></td> -->
														<td>
															<div class="form-group ">
																
																<div class="input-group">
																	<div class="input-group-addon">
																		<i class="fa fa-calendar">
																		</i>
																	</div>
																	<input class="form-control" id="petDOB" name="petDOB" placeholder="YYYY/MM/DD" type="Date" value="<?php echo $petRow['DateofBirth']; ?>"/>
																</div>
															</div>
														</td>
														
													</tr>
													<tr>
														<td style="font-weight: bold;">Height</td>
														<td><input type="text" class="form-control" name="Height" value="<?php echo $petRow['Height']; ?>"  /></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Weight</td>
														<td><input type="text" class="form-control" name="Weight" value="<?php echo $petRow['Weight']; ?>"  /></td>
													</tr>							
													<tr>
														<td><input  type="submit" name="submit10" class="btn btn-info" value="Update"></td>
													
													
													</tr>
        <?php

	}	
?>