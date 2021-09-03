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
$file=$_FILES["file"]["name"];
$md5=$_POST['md5'];
$sha1=$_POST['sha1'];
$total=$_POST['total'];
$positives=$_POST['positives'];
$lastscanned=$_POST['lastscanned'];





$file=($file);
 move_uploaded_file($_FILES["file"]["tmp_name"],"images/".$file);
$md5=md5($file);
 move_uploaded_file($_FILES["md5"]["tmp_name"],"images/".$file);
$sha1=sha1($file);
 move_uploaded_file($_FILES["sha1"]["tmp_name"],"images/".$file);

					
$post = array('apikey' => '66b67e3bc6f1eabfb2aef46a8ad1c460f9b993ae29452fd5ab0702c717608937','resource'=>"$md5");
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.virustotal.com/vtapi/v2/file/report');
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_VERBOSE, 1); // remove this if your not debugging
curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate'); // please compress data
curl_setopt($ch, CURLOPT_USERAGENT, "gzip, My php curl client");
curl_setopt($ch, CURLOPT_RETURNTRANSFER ,true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

$result=curl_exec ($ch);

$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

  $js = json_decode($result, true);
if ($status_code == 200 && $js["response_code"]==1) { // OK
  
  
$total = $js["total"];
$positives = $js["positives"];

} elseif ($status_code == 200 && $js["response_code"]==0) {


$total="NA";
$positives="NA";
}
 else {  // Error occured
  echo '<script>alert("Something Went Wrong. Please try again")</script>';
}
curl_close ($ch); 


$sql="insert into tblhash(File,md5,sha1,total,positives,lastscanned)values(:file,:md5,:sha1,:total,:positives,:lastscanned)";
$query=$dbh->prepare($sql);
$query->bindParam(':file',$file,PDO::PARAM_STR);
$query->bindParam(':md5',$md5,PDO::PARAM_STR);
$query->bindParam(':sha1',$sha1,PDO::PARAM_STR);
$query->bindParam(':total',$total,PDO::PARAM_STR);
$query->bindParam(':positives',$positives,PDO::PARAM_STR);
$query->bindParam(':lastscanned',$lastscanned,PDO::PARAM_STR);


 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    
echo '<script>alert("Something Went Wrong. Please try again")</script>';
echo "<script>window.location.href ='add-file.php'</script>";
  }
  else
    {
         echo '<script>alert("File has been added.")</script>';
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
                        <h1>File Details</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li><a href="add-file.php">File Details</a></li>
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
                            <div class="card-header"><strong>File </strong><small> Details</small></div>
                            <form name="" method="post" action="" enctype="multipart/form-data">
                                
                            <div class="card-body card-block">

                                
                                <div class="form-group"><label for="company" class=" form-control-label">Choose File</label><input type="file" name="file" value="" class="form-control" id="file" required="true"></div>
                                                                          
                    
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
<?php } ?>