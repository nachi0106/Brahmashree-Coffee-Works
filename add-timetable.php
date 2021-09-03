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
$subcode=$_POST['subcode'];
$subname=$_POST['subname'];
 $class=$_POST['class'];
 $day=$_POST['day'];
$period=$_POST['period'];



 
$sql="insert into tbltimetable(LecturerName,SubjectCode,SubjectName,Class,Day,Period)values(:tname,:subcode,:subname,:class,:day,:period)";
$query=$dbh->prepare($sql);
$query->bindParam(':tname',$tname,PDO::PARAM_STR);
$query->bindParam(':subcode',$subcode,PDO::PARAM_STR);
$query->bindParam(':subname',$subname,PDO::PARAM_STR);
$query->bindParam(':class',$class,PDO::PARAM_STR);
$query->bindParam(':day',$day,PDO::PARAM_STR);
$query->bindParam(':period',$period,PDO::PARAM_STR);

 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<scriptlert("Lecturer Time Table has been added.")</script>';
echo "<script>window.location.href ='add-timetable.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
   
    <title>Lecturer TimeTable</title>
  

    <link rel="apple-touch-icon" href="apple-icon.png">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>



</head>

<body>
    <!-- Left Panel -->

    <?php include_once('includes/sidebar.php');?>

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <?php include_once('includes/header.php');?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Lecture Details</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li><a href="add-timetable.php">Lecture Details</a></li>
                            <li class="active">Add</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-6">
                       <!-- .card -->

                    </div>
                    <!--/.col-->

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><strong>Lecture</strong><small> Details</small></div>
                            <form name="" method="post" action="" enctype="multipart/form-data">
		<div class="card-body card-block">
 				<div class="row form-group">
                                                <div class="col-12">
                                                    <div class="form-group"><label for="city" class=" form-control-label">Lecturer Name</label><select type="text" name="tname" id="tname" value="" class="form-control" required="true">
<option value="">Choose Lecturer Name</option>
                                                        <?php 

$sql2 = "SELECT * from   tblteacher ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row)
{          
    ?>  
<option value="<?php echo htmlentities($row->Name);?>"><?php echo htmlentities($row->Name);?></option>
 <?php } ?> 
            
                                                        
                                                    </select></div>
                                                    </div>
</div>
				<div class="row form-group">
                                                <div class="col-12">
                                                    <div class="form-group"><label for="city" class=" form-control-label">Subject Code</label><select type="text" name="subcode" id="subcode" value="" class="form-control" required="true">
<option value="">Choose Subject Code</option>
                                                        <?php 

$sql2 = "SELECT * from   tblsubjects ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row)
{          
    ?>  
<option value="<?php echo htmlentities($row->SubjectCode);?>"><?php echo htmlentities($row->SubjectCode);?></option>
 <?php } ?> 
            
                                                        
                                                    </select></div>
                                                    </div>
</div>
                                
				<div class="row form-group">
                                                <div class="col-12">
                                                    <div class="form-group"><label for="city" class=" form-control-label">Subject Name</label><select type="text" name="subname" id="subname" value="" class="form-control" required="true">
<option value="">Choose Subjects</option>
                                                        <?php 

$sql2 = "SELECT * from   tblsubjects ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row)
{          
    ?>  
<option value="<?php echo htmlentities($row->Subject);?>"><?php echo htmlentities($row->Subject);?></option>
 <?php } ?> 
            
                                                        
                                                    </select></div>
                                                    </div>
</div>
						<div class="row form-group">
                                                <div class="col-12">
                                                    <div class="form-group"><label for="city" class=" form-control-label">Lecturer Class</label><select type="text" name="class" id="class" value="" class="form-control" required="true">
<option value="">Choose Class</option>
                                                        <?php 

$sql2 = "SELECT * from   tblclass ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row)
{          
    ?>  
<option value="<?php echo htmlentities($row->Class);?>"><?php echo htmlentities($row->Class);?></option>
 <?php } ?> 
            
                                                        
                                                    </select></div>
                                                    </div>
						    </div>
						<div class="row form-group">
                                                <div class="col-12">
                                                    <div class="form-group"><label for="city" class=" form-control-label">Day</label><select type="text" name="day" id="day" value="" class="form-control" required="true">
<option value="">Choose Day</option>
                                                        <?php 

$sql2 = "SELECT * from   tblday ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row)
{          
    ?>  
<option value="<?php echo htmlentities($row->Day);?>"><?php echo htmlentities($row->Day);?></option>
 <?php } ?> 
            
                                                        
                                                    </select></div>
                                                    </div>
						    </div>
						<div class="row form-group">
                                                <div class="col-12">
                                                    <div class="form-group"><label for="city" class=" form-control-label">Period</label><select type="text" name="period" id="period" value="" class="form-control" required="true">
<option value="">Choose Period</option>
                                                        <?php 

$sql2 = "SELECT * from   tblperiod ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row)
{          
    ?>  
<option value="<?php echo htmlentities($row->Period);?>"><?php echo htmlentities($row->Period);?></option>
 <?php } ?> 
            
                                                        
                                                    </select></div>
                                                    </div>
						    </div>

                                               
                                                    
                                                  
                                                    </div>
                                                     <p style="text-align: center;"><button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit">
                                                            <i class="fa fa-dot-circle-o"></i>  Add
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
</body>
</html>
 <?php } ?>