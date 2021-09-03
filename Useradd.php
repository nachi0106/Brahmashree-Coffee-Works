<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['trmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {

$trmsaid=$_SESSION['trmsaid'];
 $tname=$_POST['tname'];
$email=$_POST['email'];
$mobnum=$_POST['mobilenumber'];
$address=$_POST['address'];
$quali=$_POST['qualifications'];
$tsubjects=$_POST['tsubjects'];
$tdate=$_POST['joiningdate'];
$propic=$_FILES["propic"]["name"];
$propic=($propic);
 move_uploaded_file($_FILES["propic"]["tmp_name"],"images/".$propic);
$sql="insert into tblteacher(Name,Picture,Email,MobileNumber,Qualifications,Address,TeacherSub,JoiningDate)values(:tname,:tpics,:email,:mobilenumber,:qualifications,:address,:tsubjects,:joiningdate)";
$query=$dbh->prepare($sql);
$query->bindParam(':tname',$tname,PDO::PARAM_STR);
$query->bindParam(':tpics',$propic,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':qualifications',$quali,PDO::PARAM_STR);
$query->bindParam(':mobilenumber',$mobnum,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':tsubjects',$tsubjects,PDO::PARAM_STR);
$query->bindParam(':joiningdate',$tdate,PDO::PARAM_STR);
 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Lecturer Detail has been added.")</script>';
echo "<script>window.location.href ='add-teacher.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}
}

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
   
    <title>Add Lecturers</title>
  

    <link rel="apple-touch-icon" href="apple-icon.png">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>



</head>

<body  oncontextmenu ="return false;">
    <!-- Left Panel -->

    <?php include_once('includes/sidebar.php');?>

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <?php include_once('includes/header.php');?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Details</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li class="active">Add</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-3">
                       <!-- .card -->

                    </div>
                    <!--/.col-->

                    <div class="col-lg-6">
                        <div class="card">
                            
                            <form name="" method="post" action="" enctype="multipart/form-data">
                                
                            <div class="card-body card-block">

                                <div class="form-group"><label for="company" class=" form-control-label" style="font-size: 20px">Customer Name</label><input type="text" name="tname" id="tname" value="" class="form-control" required pattern="[a-zA-Z\s]+" ></div>
                                <div class="form-group"><label for="company" class=" form-control-label" style="font-size: 20px">Mobile Number</label><input type="text" name="propic" value="" class="form-control" id="propic" required="true" pattern="[6-9]{1}[0-9]{9}"></div>
                                 <div class="form-group"><label for="company" class=" form-control-label" style="font-size: 20px">City</label><input type="text" name="propic" value="" class="form-control" id="propic" required="true"></div>                                         
                                       
                                           <div class="form-group"><label for="company" class=" form-control-label" style="font-size: 20px">Number of Grams(COFFEE SEEDS)</label><input type="number" name="propic" value="" class="form-control" id="propic" required="true" pattern="[0-9]{10}"></div>
                                            <div class="form-group"><label for="company" class=" form-control-label" style="font-size: 20px">Amount Per Kg</label><input type="text" name="propic" value="" class="form-control" id="propic" required="true"></div>
                                                   
                                                    
                                                    
                                                  <div class="form-group"><label for="company" class=" form-control-label" style="font-size: 20px">Percentage</label><input type="text" name="propic" value="" class="form-control" id="propic" required="true"></div>
                                                    <div class="form-group"><label for="company" class=" form-control-label" style="font-size: 20px">Date</label><input type="datetime-local" name="propic" value="" class="form-control" id="propic" required="true"></div>                                                                  
						
                                                    
                                               
                                                    
                               
                                                     <p style="text-align: center;"><button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit" style="font-size: 25px; padding: 5px 150px;">
                                                             SUBMIT
                                                        </button></p>
                                                    
                                                </div>
                                                </form>
                                            </div>



                                           
                                            </div>
                                        </div><!-- .animated -->
                                    </div><!-- .content -->
                                </div><!-- /#right-panel -->
                                <!-- Right Panel -->


                            <script src="vendors/jquery/dist/jquery.min.js"></script>
                            <script src="vendors/popper.js/dist/umd/popper.min.js"></script>

                            <script src="vendors/jquery-validation/dist/jquery.validate.min.js"></script>
                            <script src="vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js"></script>

                            <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
                            <script src="assets/js/main.js"></script>


<script language="javascript">
document.onmousedown=disableclick;
status="Right Click Disabled";
function disableclick(event)
{
  if(event.button==2)
   {
     alert(status);
     return true;    
   }
}
</script>
<script>
document.onkeydown = function(e) {
  if(event.keyCode == 123) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
     return false;
  }
}
</script>
</body>
</html>
