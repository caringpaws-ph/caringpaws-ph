<?php
session_start();
include_once '../assets2/conn/dbconnect.php';
// include_once 'connection/server.php';
if(!isset($_SESSION['doctorSession']))
{
    header("Location: ../main.php");
}

$usersession = $_SESSION['doctorSession'];
$res=mysqli_query($con,"SELECT * FROM doctor WHERE doctorId=".$usersession);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
// insert
$res2 = mysqli_query($con, "SELECT doctorLastName FROM doctor WHERE doctorId=".$usersession);
$availDoc = mysqli_fetch_array($res2,MYSQLI_ASSOC);


if (isset($_POST['submit'])) {
$date = mysqli_real_escape_string($con,$_POST['date']);
$scheduleday  = mysqli_real_escape_string($con,$_POST['scheduleday']);
$starttime     = mysqli_real_escape_string($con,$_POST['starttime']);
$endtime     = mysqli_real_escape_string($con,$_POST['endtime']);
$bookavail         = mysqli_real_escape_string($con,$_POST['bookavail']);


//INSERT
$query = " INSERT INTO doctorschedule (  availDoctor, scheduleDate, scheduleDay, startTime, endTime,  bookAvail)
VALUES ( '{$availDoc['doctorLastName']}', '$date', '$scheduleday', '$starttime', '$endtime', '$bookavail' ) ";

$result = mysqli_query($con, $query);
// echo $result;
if( $result )
{
?>
<script type="text/javascript">
alert('Schedule added successfully.');
</script>
<?php
}
else
{
?>
<script type="text/javascript">
alert('Added fail. Please try again.');
</script>
<?php
}

}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>CaringPaws | Doctor Schedule</title>
        <!-- Bootstrap Core CSS -->
        <link href="../assets2/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/material.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="assets/css/sb-admin.css" rel="stylesheet">
        <link href="assets/css/time/bootstrap-clockpicker.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
        <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 

        <!--Font Awesome (added because you use icons in your prepend/append)-->
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

        <!-- Inline CSS based on choices in "Settings" tab -->
        <style>
        a {
  text-decoration: none;
  display: inline-block;
  padding: 8px 16px;
}

a:hover {
  background-color: #ddd;
  color: black;
}

.previous {
  background-color:  #2494f4;
  color: black;
}

.next {
  background-color: #2494f4;
  color: black;
}

.round {
  border-radius: 50%;
}
        
        
        
        .bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>

        <!-- Custom Fonts -->
    </head>
    <body>
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="doctordashboard.php">
                    <img  src="assets/logo.png" height="25px"><!-- Dr. <?php //echo $userRow['doctorLastName'];?> Dashboard -->
                    </a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-nav navbar-right">
                    
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Dr. <?php echo $userRow['doctorFirstName']; ?> <?php echo $userRow['doctorLastName']; ?><b class="caret"></b></a>
                       
                        <ul class="dropdown-menu">
                            <li>
                                <a href="doctorprofile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                            </li>
                           
                            <li class="divider"></li>

                            <li>
                                <a href="logout.php?logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>

                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li>
                            <a href="doctordashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li class="active">
                            <a href="addschedule.php"><i class="fa fa-fw fa-table"></i> Doctor Schedule</a>
                        </li>
                        <li>
                            <a href="patientlist.php"><i class="fa fa-fw fa-edit"></i> Pet Owner List</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>
            <!-- navigation end -->

            <div id="page-wrapper">
                <div class="container-fluid">
                    
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 style="font-weight: bold;" class="page-header">
                            Create Schedule
                            </h3>
                            <ol class="breadcrumb">
                                <li class="active">
                                    <i class="fa fa-calendar"></i> Schedule
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- Page Heading end-->

                    <!-- panel start -->
                    <div class="panel panel-primary">

                        <!-- panel heading starat -->
                        <div class="panel-heading">
                            <h3 class="panel-title" style="font-weight: bold;">Add Schedule</h3>
                        </div>
                        <!-- panel heading end -->

                        <div class="panel-body">
                        <!-- panel content start -->
                            <div class="bootstrap-iso">
                             <div class="container-fluid">
                              <div class="row">
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                <form class="form-horizontal" method="post">
                                 <div class="form-group form-group-lg">
                                  <label class="control-label col-sm-2 requiredField" for="date">
                                   Date
                                   <span class="asteriskField">
                                    *
                                   </span>
                                  </label>
                                  <div class="col-sm-10">
                                   <div class="input-group">
                                    <div class="input-group-addon">
                                     <i class="fa fa-calendar">
                                     </i>
                                    </div>
                                    <input class="form-control" id="dated" name="date" type="text" required/>
                                   </div>
                                  </div>
                                 </div>
                                 <div class="form-group form-group-lg">
                                  <label class="control-label col-sm-2 requiredField" for="scheduleday">
                                   Day
                                   <span class="asteriskField">
                                    *
                                   </span>
                                  </label>
                                  <div class="col-sm-10">
                        <table class="col-sm-12">
                            <tbody>
                                <tr>
                                   <td id="scheduled" ><input type="text" class="form-control" id="scheduleday" name="scheduleday"></td>
                                </tr>
                            </tbody>
                        </table>
                                </div>
                                 </div>
                                 <div class="form-group form-group-lg">
                                  <label class="control-label col-sm-2 requiredField" for="starttime">
                                   Start Time
                                   <span class="asteriskField">
                                    *
                                   </span>
                                  </label>

                                  <div class="col-sm-10">
                                   <div class="input-group clockpicker"  data-align="top" data-autoclose="true">
                                    <div class="input-group-addon">
                                     <i class="fa fa-clock-o">
                                     </i>
                                    </div>
                                    <input class="form-control" id="starttime" name="starttime" type="text" required/>
                                   </div>
                                  </div>
                                 </div>
                                 <div class="form-group form-group-lg">
                                  <label class="control-label col-sm-2 requiredField" for="endtime">
                                   End Time
                                   <span class="asteriskField">
                                    *
                                   </span>
                                  </label>
                                  <div class="col-sm-10">
                                   <div class="input-group clockpicker"  data-align="top" data-autoclose="true">
                                    <div class="input-group-addon">
                                     <i class="fa fa-clock-o">
                                     </i>
                                    </div>
                                    <input class="form-control" id="endtime" name="endtime" type="text" required/>
                                   </div>
                                  </div>
                                 </div>
                                 <div class="form-group form-group-lg">
                                  <label class="control-label col-sm-2 requiredField" for="bookavail">
                                   Availabilty
                                   <span class="asteriskField">
                                    *
                                   </span>
                                  </label>
                                  <div class="col-sm-10">
                                   <select class="select form-control" id="bookavail" name="bookavail" required>
                                    <option value="Available">
                                     Available
                                    </option>
                                    <option value="Not Available">
                                    Not Available
                                    </option>
                                   </select>
                                  </div>
                                 </div>
                                 <div class="form-group">
                                  <div class="col-sm-10 col-sm-offset-2">
                                   <button style="border-color: #FF2121; background-color: #FF2121;" class="btn btn-primary " name="submit" type="submit">
                                    Submit
                                   </button>
                                  </div>
                                 </div>
                                </form>
                               </div>
                              </div>
                             </div>
                            </div>                        
                        <!-- panel content end -->
                        <!-- panel end -->
                        </div>
                    </div>
                    <!-- panel start -->

                     <!-- panel start -->
                    <div class="panel panel-primary filterable">

                        <!-- panel heading starat -->
                        <div class="panel-heading">
                            <h3 class="panel-title" style="font-weight: bold;">List of Pet Owners</h3>
                            <div class="pull-right">
                            <button class="btn btn-default btn-xs btn-filter"><span class="fa fa-filter"></span> Filter</button>
                        </div>
                        </div>
                        <!-- panel heading end -->

                        <div class="panel-body">
                        <!-- panel content start -->
                           <!-- Table -->
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="filters">
                                    <th><input type="text" class="form-control" placeholder="Scheduled ID" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Scheduled Date" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Scheduled Day" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Start Time" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="End Time" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Book Availability" disabled></th>
                                </tr>
                            </thead>
                            
                            <?php 
                            //define how many results you want per page
                            $results_per_page = 5;


                            //find out the number of results stored in database
                            $sql = "SELECT * FROM doctorschedule";
                            $result=mysqli_query($con, $sql);
                            $number_of_results = mysqli_num_rows($result);

                            //determine number of total pages available
                            $number_of_pages = ceil($number_of_results / $results_per_page);

                            //determine which page number the visitor is currently on
                             if(!isset($_GET['page'])){
                             $page = 1;
                             } else {
                             $page = $_GET['page'];
                             }

                            //determine the sql LIMIT starting number for the results on the displaying page
                             $this_page_first_result = ($page - 1) * $results_per_page;

                            //retrieve selected results from database and display them on page
                            $sql = "SELECT * FROM doctorschedule LIMIT " . $this_page_first_result . ',' . $results_per_page;
                            $result = mysqli_query($con, $sql); 
                            while ($doctorschedule=mysqli_fetch_array($result)) {
                                
                              
                                echo "<tbody>";
                                echo "<tr>";
                                    echo "<td>" . $doctorschedule['scheduleId'] . "</td>";
                                    echo "<td>" . $doctorschedule['scheduleDate'] . "</td>";
                                    echo "<td>" . $doctorschedule['scheduleDay'] . "</td>";
                                    echo "<td>" . $doctorschedule['startTime'] . "</td>";
                                    echo "<td>" . $doctorschedule['endTime'] . "</td>";
                                    echo "<td>" . $doctorschedule['bookAvail'] . "</td>";
                                    echo "<form method='POST'>";
                                    echo "<td class='text-center'><a href='#' id='".$doctorschedule['scheduleId']."' class='delete'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                            </td>";
                               
                            }
                      
                            
                                echo "</tr>";
                           echo "</tbody>";
                       echo "</table>";
                      
                      //display the links to the pages
                      if($page>1){
                        echo "<a href='addschedule.php?page=".($page-1)."' class='previous round'>&#8249</a>";
                      }
                      

                      for ($i = 1; $i <= $number_of_pages; $i++) {
                          echo '<a style="color: black" href="addschedule.php?page=' . $i . '">' . $i . '</a>';
                      }
                      
                   
                      if($i>$page){
                        echo "<a href='addschedule.php?page=".($page+1)."' class='next round'>&#8250</a>";
                    }



                       echo "<div class='panel panel-default'>";
                       echo "<div class='col-md-offset-3 pull-right'>";
                       echo "<button class='btn btn-primary' type='submit' value='Submit' name='submit'>Update</button>";
                        echo "</div>";
                        echo "</div>";
                        ?>
                        <!-- panel content end -->
                        <!-- panel end -->
                        </div>
                    </div>
                    <!-- panel start -->
                </div>
            </div>
        <!-- /#wrapper -->


       
        <!-- jQuery -->
        <script src="../patient/assets/js/jquery.js"></script>
        
        <!-- Bootstrap Core JavaScript -->
        <script src="../patient/assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-clockpicker.js"></script>
        <!-- Latest compiled and minified JavaScript -->
         <!-- script for jquery datatable start-->
        <!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
    $(document).ready(function(){
        var date_input=$('input[name="date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>

<script>
			var x = document.getElementById("dated");
			
			x.onchange = function(){
				var enterdate = this.value;	
                
                //alert(enterdate);

				$.ajax({
					url:"https://caringpaws-ph.herokuapp.com/doctor/showDay.php",
					method: "POST",
					data:{ enterdate : enterdate },
					success:function(data){
						$("#scheduled").html(data);
					}
				})
			}
</script>





<script type="text/javascript">
    $('.clockpicker').clockpicker();
</script>
 <script type="text/javascript">
$(function() {
$(".delete").click(function(){
var element = $(this);
var id = element.attr("id");
var info = 'id=' + id;
if(confirm("Are you sure you want to delete this?"))
{
 $.ajax({
   type: "POST",
   url: "deleteschedule.php",
   data: info,
   success: function(){
 }
});
  $(this).parent().parent().fadeOut(300, function(){ $(this).remove();});
 }
return false;
});
});
</script>
<script type="text/javascript">
            /*
            Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
            */
            $(document).ready(function(){
                $('.filterable .btn-filter').click(function(){
                    var $panel = $(this).parents('.filterable'),
                    $filters = $panel.find('.filters input'),
                    $tbody = $panel.find('.table tbody');
                    if ($filters.prop('disabled') == true) {
                        $filters.prop('disabled', false);
                        $filters.first().focus();
                    } else {
                        $filters.val('').prop('disabled', true);
                        $tbody.find('.no-result').remove();
                        $tbody.find('tr').show();
                    }
                });

                $('.filterable .filters input').keyup(function(e){
                    /* Ignore tab key */
                    var code = e.keyCode || e.which;
                    if (code == '9') return;
                    /* Useful DOM data and selectors */
                    var $input = $(this),
                    inputContent = $input.val().toLowerCase(),
                    $panel = $input.parents('.filterable'),
                    column = $panel.find('.filters th').index($input.parents('th')),
                    $table = $panel.find('.table'),
                    $rows = $table.find('tbody tr');
                    /* Dirtiest filter function ever ;) */
                    var $filteredRows = $rows.filter(function(){
                        var value = $(this).find('td').eq(column).text().toLowerCase();
                        return value.indexOf(inputContent) === -1;
                    });
                    /* Clean previous no-result if exist */
                    $table.find('tbody .no-result').remove();
                    /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
                    $rows.show();
                    $filteredRows.hide();
                    /* Prepend no-result row if all rows are filtered */
                    if ($filteredRows.length === $rows.length) {
                        $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
                    }
                });
            });
        </script>

    </body>
</html>