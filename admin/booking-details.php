<?php
// Start the session to manage user authentication and session variables
session_start();

// Include the configuration file for database connection and other settings
include_once('../inc/config.php');

// Check if user is authenticated and has got a valid session
if(!isset($_SESSION['aid']) || strlen($_SESSION['aid'])==0) { 
  header('location:index.php');
} else {

//Code For Updation the Enrollment
if(isset($_POST['submit'])){
$bid=intval($_GET['bid']);
$estatus=$_POST['status'];
$oremark=$_POST['officialremak'];
$tbaleid=$_POST['table'];
$bdate=$_POST['bdate'];
 $btime=strtotime($_POST['btime']);
$endTime = date("H:i:s", strtotime('+30 minutes', $btime));

$ret=mysqli_query($con,"SELECT * FROM tblbookings where ('$btime' BETWEEN time(bookingTime) and '$endTime' || '$endTime' BETWEEN time(bookingTime) and '$endTime' || bookingTime BETWEEN '$btime' and '$endTime') and tableId='$tbaleid' and bookingDate='$bdate' and boookingStatus='Accepted'");
 $count=mysqli_num_rows($ret);
if($count>0){
echo "<script>alert('Table already booked for given Date and Time. please choose another table');</script>";
} else{
$query=mysqli_query($con,"update tblbookings set adminremark='$oremark',boookingStatus='$estatus',tableId='$tbaleid' where id='$bid'");

if($query){
echo "<script>alert('Booking Details Updated   successfully.');</script>";
//echo "<script type='text/javascript'> document.location = 'manage-classes.php'; </script>";
} else {
echo "<script>alert('Something went wrong. Please try again.');</script>";
}

}
}

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Restaurant Reservation System | Booking Details</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
<?php include_once("includes/navbar.php");?>
  <!-- /.navbar -->

 <?php include_once("includes/sidebar.php");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Booking Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Booking Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
        

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Booking Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
       
                  <tbody>
<?php $bid=intval($_GET['bid']);
$query=mysqli_query($con,"select * from tblbookings where id='$bid'");
$cnt=1;
while($result=mysqli_fetch_array($query)){
?>


       <tr>
                  <th>Booking Number</th>
                    <td colspan="3"><?php echo $result['bookingNo']?></td>
                  </tr>

                  <tr>
                  <th> Name</th>
                    <td><?php echo $result['fullName']?></td>
                    <th>Email Id</th>
                   <td> <?php echo $result['emailId']?></td>
                  </tr>
                  <tr>
                    <th> Mobile No</th>
                    <td><?php echo $result['phoneNumber']?></td>
                    <th>No of Adults</th>
                    <td><?php echo $result['noAdults']?></td>
                  </tr>
                  <tr>
                    <th>No of Childs</th>
                   <td><?php echo $result['noChildrens']?></td>
                   <th>Booking Date / Time</th>
                   <td><?php echo $date=$result['bookingDate']?> / <?php echo $btime=$result['bookingTime']?></td>
                 </tr>
                 <tr>
                  <th>Posting Date</th>
                    <td colspan="3"><?php echo $result['postingDate']?></td>
                  </tr>

 

<?php if($result['boookingStatus']!=''):?>
            <tr>
                  <th>Booking  Status</th>
                    <td><?php echo $result['boookingStatus']?></td>
                    <th>Updation Date</th>
                    <td><?php echo $result['updationDate']?></td>
                  </tr>

      <tr>
                  <th> Remark</th>
                    <td colspan="3"><?php echo $result['adminremark']?></td>
                  </tr>
<?php endif;?>
<?php if($result['boookingStatus']==''):?>
<tr>
  <td colspan="4" style="text-align:center;">
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Take Action</button>
</td>
<?php endif;?>

         <?php $cnt++;} ?>
             
                  </tbody>
     
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include_once('includes/footer.php');?>


</div>
<!-- ./wrapper -->


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Booking Satus</h4>
      </div>
      <div class="modal-body">
        <form name="takeaction" method="post">

          <p><select class="form-control" name="status" id="status" required>
            <option value="">Select Booking Status</option>
            <option value="Accepted">Accepted</option>
            <option value="Rejected">Rejected</option>
          </select></p>


          <p id='rtable'>
            <input type="hidden" name="bdate" value="<?php echo $date;?>">
            <input type="hidden" name="btime" value="<?php echo $btime;?>">
            <select class="form-control" name="table" id="table">
            <option value="">Select Table</option>
            <?php $ret=mysqli_query($con,"select id,tableNumber from tblrestables");
while($row=mysqli_fetch_array($ret)){
?>
            <option value="<?php echo $row['id'];?>"><?php echo $row['tableNumber'];?></option>
<?php } ?>
          </select></p>


        <p><textarea class="form-control" name="officialremak" placeholder="Official Remark" rows="5" required></textarea></p>
        <input type="submit" class="btn btn-primary" name="submit" value="update">

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>






<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script type="text/javascript">

  //For report file
  $('#rtable').hide();
  $(document).ready(function(){
  $('#status').change(function(){
  if($('#status').val()=='Accepted')
  {
  $('#rtable').show();
  jQuery("#table").prop('required',true);  
  }
  else{
  $('#rtable').hide();
  }
})}) 
</script>
</body>
</html>
<?php } ?>