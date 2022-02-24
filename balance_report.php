<?php require_once 'includes/ak_header.php'; ?>
<?php 
if(isset($_POST['gst']))
{
$gs = $_POST['gst'];
$sqlv = "INSERT INTO gst (gst) VALUES ('$gs')";
$resulta = $connect->query($sqlv);
}
$sql = "SELECT gst FROM gst ORDER BY id DESC LIMIT 1";
$result = $connect->query($sql);
if($result->num_rows > 0) { 
 $rowb = $result->fetch_array();
} // if num_rows 


?>
<?php 
$sql1 = "SELECT * FROM bill ";
$clientr = mysqli_query($connect, $sql1); 
// $godownr1 = $godownr;


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">
	<!-- Balance REPORT -->
<br><br>
    <div class="container">
        
        <section>
            <div class="card">
                <div class="card-header" style="text-align: center"><h4> <u> Balance Transaction</u></h4></div>
                <!-- <input type="text" readonly class="form-control-plaintext" id="curent_date" value="<?php echo date("d-m-Y"); ?> "> -->
                <div class="card-body">


                    
                <form action="" method="post">

                    <div class="row">
                        <div class="col-sm-5">
                            <div>
                            <div class="card-body">
                            <form>
                                <div class="row mb-1">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">FROM DATE</label>
                                    <div class="col-sm-9">
                                    <input type="date" class="form-control" id="from_date" name="from_date" autocomplete="off"  />
                                        <!-- <datalist id="productName">
                                            <option value="Pen">Pen</option>
                                            <option value="Pencil">Pencil</option>
                                            <option value="Paper">Paper</option>
                                        </datalist> -->
                                    </div>
                                </div>
                            </form>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div>
                            <div class="card-body">
                            <form>
                                <div class="row mb-1">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">TO DATE</label>
                                    <div class="col-sm-9">
                                    <input type="date" class="form-control" id="to_date" name="to_date"  autocomplete="off"  />
                                        <!-- <datalist id="productName">
                                            <option value="Pen">Pen</option>
                                            <option value="Pencil">Pencil</option>
                                            <option value="Paper">Paper</option>
                                        </datalist> -->
                                    </div>
                                </div>
                            </form>
                            </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="row">
                    <div class="col-sm-5">
                    
                                <div>
                                <div class="card-body">
                                <form>
                                    <!--<div class="row mb-1">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Client Name</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="client_name1" name="client_name"  autocomplete="off"  list="client_name"/>
                                        <datalist id="client_name">
                                                <?php
                                                while($row = mysqli_fetch_array($clientr))
                                                        {
                                                            ?>
                                                           <option value="<?php echo $row['client_name']; ?>"> <?php echo $row['client_name']; ?></option>
                                                       <?php } ?>  
                                                </datalist>
                                        </div>
                                    </div>-->
                                </form>
                                </div>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div>
                                <div class="card-body">
                                    <form>
                                        <div class="row mb-3">
                                        <button type="button" class="btn btn-primary" 
                                        id="show"  onclick="show1()"data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Show</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            <!--<div class="col-sm-1">-->
                            <!--    <div>-->
                            <!--    <div class="card-body">-->
                            <!--    <form>-->
                            <!--            <div class="row mb-3">-->
                            <!--            <button type="button" class="btn btn-primary" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i>Reset</button>-->
                            <!--            </div>-->
                            <!--        </form>-->
                            <!--    </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="col-sm-1">-->
                            <!--    <div >-->
                            <!--    <div class="card-body">-->
                            <!--    <form>-->
                            <!--            <div class="row mb-3">-->
                            <!--            <button type="button" class="btn btn-primary" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i>Print</button>-->
                            <!--            </div>-->
                            <!--        </form>-->
                            <!--    </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="col-sm-1">-->
                            <!--    <div >-->
                            <!--    <div class="card-body">-->
                            <!--    <form>-->
                            <!--            <div class="row mb-3">-->
                            <!--            <button type="button" class="btn btn-primary" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i>Excel</button>-->
                            <!--            </div>-->
                            <!--        </form>-->
                            <!--    </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                         </div>
                </form>
                

                <div class="tbl"  style="overflow-x:auto;">
   
                    <!-- <table class="table" id="example" class="display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Bill No.</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Amount Paid</th>
                                <th scope="col">Balance Amount</th>
                                <th scope="col">Payment Mode</th>
                                <th scope="col">Bank Name</th>
                                <th scope="col">Cheque Number</th>
                                <th scope="col">Account Name</th>
                                <th scope="col">Taken By</th>
                                
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                
                                <td>@mdo</td>
                                <td><a href=""><i class="far fa-edit"></i></a> <a href=""><i class="far fa-trash-alt"></i></a></td>
                                
                                </tr>
                                <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                </tr>
                                <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                                </tr>
                            </tbody>
                    </table> -->
                    </div>
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

<script src="https://code.jquery.com/jquery-3.5.1.js" async defer></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" async defer></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js" async defer></script>
<script>
      $(document).ready(function() {
                $('#example').DataTable();
            } );

         function show1(){
             //var client_name = $("#client_name1").val();
             var from_date = $("#from_date").val();
             var to_date = $("#to_date").val();
                //alert(to_date);
              $.ajax({
               url:"show_blnc_rprt.php",
               method:"POST",
               data:{f:from_date, t:to_date},
               success:function(data)
               {
                $('.tbl').html(data);
               }
              });
            }

</script>