<link rel="icon" href="../pagelogo.png" sizes="16x16" type="image/png">
<?php
session_start();
include_once '../assets2/conn/dbconnect.php';
if (isset($_GET['appid'])) {
$appid=$_GET['appid'];
}
$res=mysqli_query($con, "SELECT a.*, b.*,c.* FROM patient a
JOIN appointment b
On a.icPatient = b.patientIc
JOIN doctorschedule c
On b.scheduleId=c.scheduleId
WHERE b.appId  =".$appid);

$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);


$res2 = mysqli_query($con, "SELECT petprofile.profile_image, appointment.ChosenPet, appointment.appid FROM petprofile, appointment WHERE appid='" . $appid . "' AND Pname=ChosenPet ");
$userRow2 = mysqli_fetch_array($res2, MYSQLI_ASSOC);

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Caring Paws | Print Appointment Details</title>
        
        <link rel="stylesheet" type="text/css" href="assets/css/invoice.css">
    </head>
    <body>
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="assets/logo.png" style="width:100%; max-width:300px;">
                                </td>
                                
                                <td style="font-weight: bold;">
                                    Appointment Slip No. : <?php echo $userRow['appId'];?><br>
                                    Created: <?php echo date("d-m-Y");?><br>
                                </td>

                                
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                
                                <td style="font-weight: bold;">
                                   <img src="<?php echo 'images2/' .  $userRow['profile_image']; ?>" style="width:20%; max-width:300px;">
                                   <br>
                                   <img src="<?php echo 'images2/' .  $userRow2['profile_image']; ?>" style="width:20%; max-width:300px;">
                                   <br>
                                </td>
                                
                                <td style="font-weight: bold;">IC No. <?php echo $userRow['patientIc'];?><br>
                                <?php echo $userRow['patientAddress'];?><br>
                                    <?php echo $userRow['fname'];?> <?php echo $userRow['lname'];?><br>
                                    <?php echo $userRow['username'];?>
                                    <br>
                                    <br>
                                    <br>
                                    Pet Name: <?php echo $userRow['ChosenPet'];?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                
                
                <tr class="heading">
                    <td style="font-weight: bold;">
                        Appointment Details
                    </td>
                    
                    <td style="font-weight: bold;">
                        No.
                    </td>
                </tr>
                
                <tr class="item">
                    <td style="font-weight: bold;">
                        Appointment ID
                    </td>
                    
                    <td>
                       <?php echo $userRow['appId'];?>
                    </td>
                </tr>
                
                <tr class="item">
                    <td style="font-weight: bold;">
                        Schedule ID
                    </td>
                    
                    <td>
                        <?php echo $userRow['scheduleId'];?>
                    </td>
                </tr>

                <tr class="item">
                    <td style="font-weight: bold;"> 
                        Appointment Day
                    </td>
                    
                    <td >
                        <?php echo $userRow['scheduleDay'];?>
                    </td>
                </tr>
                

                 <tr class="item">
                    <td style="font-weight: bold;">
                        Appointment Date
                    </td>
                    
                    <td>
                        <?php echo $userRow['scheduleDate'];?>
                    </td>
                </tr>

                 <tr class="item">
                    <td style="font-weight: bold;">
                        Appointment Time
                    </td>
                    
                    <td>
                        <?php echo $userRow['startTime'];?> untill <?php echo $userRow['endTime'];?>
                    </td>
                </tr>

                 <tr class="item">
                    <td style="font-weight: bold;">
                        Pet Symptom/s
                    </td>
                    
                    <td >
                        <?php echo $userRow['appSymptom'];?> 
                    </td>
                </tr>

                <tr class="item">
                    <td style="font-weight: bold;">
                        Pet Remarks
                    </td>
                    
                    <td >
                        <?php echo $userRow['appComment'];?> 
                    </td>
                </tr>
                
                
                
                
            </table>
        </div>
        <div class="print">
        <button onclick="myFunction()" style="font-weight: bold;">Print this page</button>
</div>
<script>
function myFunction() {
    window.print();
}
</script>
    </body>
</html>