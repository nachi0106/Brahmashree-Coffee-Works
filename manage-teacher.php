<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['trmsaid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from tblteacher  WHERE ID=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$_SESSION['delmsg']="Category deleted scuccessfully ";
header('location:manage-teacher.php');

}


  ?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    
    <title>Manage Lecturer</title>
    
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
                        <h1>Manage Lecturers</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li><a href="manage-teacher.php">Manage Lecturers</a></li>
                            <li class="active">Manage Lecturers</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Manage Lecturers</strong>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <tr>
                  <th>S.NO</th>
            
                  <th>Lecturer Name</th>
                  <th>Subject</th>
                    <th>Registration Date</th>       
                   <th>Action</th>
                </tr>
                                        </tr>
                                        </thead>
                                    <?php
$sql="SELECT * from tblteacher";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>   
              
                <tr>
                  <td><?php echo htmlentities($cnt);?></td>
            <td><?php  echo htmlentities($row->Name);?></td>
                  <td><?php  echo htmlentities($row->TeacherSub);?></td>
                  <td><?php  echo htmlentities($row->RegDate);?></td>
                  <td><a href="edit-teacher-detail.php?editid=<?php echo htmlentities ($row->ID);?>"><button class="btn btn-primary"><i class="fa fa-edit "></i>Edit </button></a></td>
		  <!---<td><a href="edit-teacher-detail.php?bookid=<?php echo htmlentities($row->ID);?>"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button></td>---> 
                  <td><a href="manage-teacher.php?del=<?php echo htmlentities($row->ID);?>" onclick="return confirm('Are you sure you want to delete?');"" > <button class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button></td>
                </tr>
               <?php $cnt=$cnt+1;}} ?>   

                                </table>
                            </div>
                        </div>
                    </div>



                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


</body>

</html>
<?php }  ?>