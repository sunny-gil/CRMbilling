<?php require_once 'includes/ak_header.php'; ?>
<?php 
if(isset($_POST['submit']))
{
$client_name = $_POST['username'];
$address =$_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$gender = $_POST['gender'];
$phone_no = $_POST['phone_no'];
$mobile_no = $_POST['mobile_no'];
$email = $_POST['email'];
$gst_no = $_POST['gst_no'];


$selct="SELECT * FROM customber_login WHERE mobile_no = '$mobile_no' || email = '$email' ";
$result = mysqli_query($connect, $selct);

if (mysqli_num_rows($result)== 0) {

    $query ="INSERT INTO `customber_login`(`username`, `address`, `city`, `state`, `gender`, `phone_no`, `mobile_no`, `email`, `gst_no` ) VALUES ('$client_name', '$address', '$city', '$state', '$gender', '$phone_no', '$mobile_no', '$email', '$gst_no' )";

    if (mysqli_query($connect, $query)) {
        // echo "New record created successfully";
  } else {
        // echo "Error: " . $sql . "<br>" . mysqli_error($connect);
  }
}
else{
    // echo "o result";
}
//   mysqli_close($connect);

}

?>
    


<?php 

$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM orders WHERE order_status = 1";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;



$totalRevenue = 0;
while ($orderResult = $orderQuery->fetch_assoc()) {
	$totalRevenue += $orderResult['paid'];
}

$lowStockSql = "SELECT * FROM product WHERE quantity <= 3 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

$userwisesql = "SELECT users.username , SUM(orders.grand_total) as totalorder FROM orders INNER JOIN users ON orders.user_id = users.user_id WHERE orders.order_status = 1 GROUP BY orders.user_id";
$userwiseQuery = $connect->query($userwisesql);
$userwieseOrder = $userwiseQuery->num_rows;


?>



<?php 
if(isset($_POST['gstn']))
{
$gstn2 = $_POST['gstn'];
$sqlvn = "UPDATE gstn SET gstn='$gstn2' WHERE id='1'";
$resultan = $connect->query($sqlvn);
}
$sql = "SELECT gstn FROM gstn ORDER BY id DESC LIMIT 1";
$result = $connect->query($sql);
if($result->num_rows > 0) { 
 $rowbc = $result->fetch_array();
} // if num_rows 


?>




<style type="text/css">
	.ui-datepicker-calendar {
		display: none;
	}
	.row{
		margin-top: 2%;
		margin-bottom: 3%;
	}
	.badge{
		float: right !important;

        background-color: red !important;
		border-radius: 50% !important;
		color: #fff !important;
	}
	.card-body{
		padding: 0.7rem 1rem;
	}
</style>

<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">
	<!-- client entry -->
<br><br>
    <div class="container">
        
            <section>
                <div class="card">
                    <div class="card-header" style="text-align: center"><h4> <u> Client Entry </u></h4></div>
                    <div class="card-body">
    
  
                        <form action="" method="post">

                             <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-3">
                                <input type="text"  class="form-control-plaintext" id="curent_date" value="<?php echo date("d-m-Y"); ?>">
                                </div>
                            </div>
                            <!-- <div class="mb-3 row">
                                <label for="ClientId" class="col-sm-2 col-form-label">Client Id</label>
                                <div class="col-sm-3">
                                <input type="text" class="form-control" id="client_id" name="clent_id" readonly >
                                </div>
                            </div> -->
                            <div class="mb-3 row">
                                <label for="ClientName" class="col-sm-2 col-form-label">Client Name</label>
                                <div class="col-sm-10">
                                <input type="text"  class="form-control" id="client_name" name="username"  required >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="ClientAddress" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                <textarea  class="form-control" id="address" name="address"></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="City" class="col-sm-2 col-form-label">City</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="city" name="city"  required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="ClientState" class="col-sm-2 col-form-label">State</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="state" name="state" required >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="Clientgender" class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                                    <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                    <label class="form-check-label" for="femaile">Female</label>
                                </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="ClientName" class="col-sm-2 col-form-label">Phone No.</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone_no" name="phone_no"  >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="ClientName" class="col-sm-2 col-form-label">Mobile No.</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="mobile_no" name="mobile_no" required >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="ClientName" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" required >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="ClientName" class="col-sm-2 col-form-label">GST No.</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="gst_no" name="gst_no" required >
                                </div>
                            </div>
                            <br>
                            <div class=" gap-2 col-4 mx-auto" style="text-align:center">
                                <button class="btn btn-primary" type="submit" id="save" name="submit">submit</button>
                                <button class="btn btn-primary" type="reset" id="reset" name="reset">Reset</button>
                            </div>
                        </form>
                        
                     </div>
                     
                </div>
                <br><br><br><br>
            </section>
        </div>



<!-- fullCalendar 2.2.5 -->
<script src="assests/plugins/moment/moment.min.js"></script>
<script src="assests/plugins/fullcalendar/fullcalendar.min.js"></script>


<script type="text/javascript">
	$(function () {
			// top bar active
	$('#navDashboard').addClass('active');

      //Date for the calendar events (dummy data)
      var date = new Date();
      var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();

      $('#calendar').fullCalendar({
        header: {
          left: '',
          center: 'title'
        },
        buttonText: {
          today: 'today',
          month: 'month'          
        }        
      });


    });
</script>

<?php require_once 'includes/footer.php'; ?>