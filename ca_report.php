<?php require_once 'includes/ak_header.php'; ?>
<?php 
if(isset($_POST['from_date']))
{
     $from_date = $_POST['from_date'];
     $from_date1 = date("Y-m-d", strtotime($from_date));
     $to_date = $_POST['to_date'];
     $to_date1 = date("Y-m-d", strtotime($to_date));
    $sqlbil= "SELECT * FROM bill WHERE date >= '".$from_date1."' AND date <= '".$to_date."'  ORDER BY id DESC ";
    $result123 = mysqli_query($connect, $sqlbil);
    //print_r($result);
    // $sqlselr= "SELECT * FROM sealer_bill WHERE date >= '".$from_date1."' AND date <= '".$to_date1."'  ORDER BY id DESC ";
    // $resultselr = mysqli_query($connect, $sqlselr);
    // $dj = array();
    // while($whil = mysqli_fetch_assoc($resultselr))
    // {
    //     array_push($dj, $whil);
    // }
}
?>
<?php 
// $sql1 = "SELECT * FROM bill ";
// $clientr = mysqli_query($connect, $sql1); 
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
	<!-- CA REPORT -->

    <div class="container">
        <br><br>
        <section>
            <div class="card">
                <div class="card-header" style="text-align: center"><h4> <u>CA Transaction (Sell)</u></h4></div>
                <!-- <input type="text" readonly class="form-control-plaintext" id="curent_date" value="<?php echo date("d-m-Y"); ?> "> -->
                <div class="card-body">


                    <form action="" method="post">

                        <div class="row">
                            <div class="col-sm-4">
                                <div>
                                <div class="card-body">
                               
                                    <div class="row mb-1">
                                        <label for="from_date" class="col-sm-5 col-form-label">From Date</label>
                                        <div class="col-sm-7">
                                        <input type="date" class="form-control" id="from_date" name="from_date" value="<?php if(isset($_POST['from_date'])){
                                            echo $_POST['from_date'];
                                        }  ?>"  autocomplete="off"  />
                                            <!-- <datalist id="productName">
                                                <option value="Pen">Pen</option>
                                                <option value="Pencil">Pencil</option>
                                                <option value="Paper">Paper</option>
                                            </datalist> -->
                                        </div>
                                    </div>
                                
                                </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div>
                                <div class="card-body">
                             
                                    <div class="row mb-1">
                                        <label for="from_date" class="col-sm-5 col-form-label">To Date</label>
                                        <div class="col-sm-7">
                                        <input type="date" class="form-control" id="to_date" name="to_date"  value="<?php if(isset($_POST['to_date'])){
                                            echo $_POST['to_date'];
                                        }  ?>" autocomplete="off"  />
                                            <!-- <datalist id="productName">
                                                <option value="Pen">Pen</option>
                                                <option value="Pencil">Pencil</option>
                                                <option value="Paper">Paper</option>
                                            </datalist> -->
                                        </div>
                                    </div>
                                
                                </div>
                                </div>
                            </div>
                        
                            <div class="col-sm-1">
                                <div>
                                <div class="card-body">
                                   
                                        <div class="row mb-3">
                                        <button type="submit" class="btn btn-primary"    id="show"  onclick="show1()" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Show</button>
                                        </div>
                                    
                                </div>
                                </div>
                            </div>
                           
                            
                            <div class="col-sm-1">
                                <div >
                                <div class="card-body">
                                <form>
                                        <div class="row mb-3">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Excel</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>

                <div  class="tbl" style="overflow-x:auto;">
                    <table class="table" id="example" class="display nowrap" style="width:100%">

                            <thead>
                                <tr>
                                    <th>ID</th>
                                <th scope="col">Date</th>
                                <th scope="col">Bill No.</th>
                                <th scope="col">Client Name</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">CGST</th>
                                <th scope="col">SGST</th>
                                <th scope="col">IGST</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                            <?php  
                        
                          if(isset($result123))
                            {
                              $i = 1;   
                          while($row = mysqli_fetch_array($result123))  
                          {  
                               if($row['bill_no']!=''){
                                    
                              
                                $monthNum = $row['date'];
                                    $monthNum1 = $monthNum;
                                    $monthNum = date("m", strtotime($monthNum));
                                    $day = date("d", strtotime($monthNum1));
                                    $year = explode('-', $monthNum1);
                                    $dateid = $day." ".$monthName = date('M', mktime(0, 0, 0, $monthNum, 10))." ".$year[0]; 
                              
                             
                          ?>
                                <tr>
                                <th scope="row"><?php echo $i ?></th>
                                <td><?php echo $dateid; ?></td>
                                <td><?php echo $row["bill_no"]; ?></td>
                                <td><?php echo $row["client_id"]; ?></td>
                                <td><?php echo $row["total_amount"]; ?></td>
                                <td><?php if($row["pay_mode"]==1){ if($row["gst"]!=''){echo $row["gst"]/2;}else{echo 0;} } else{
                                    echo 0;
                                } ?></td>
                                <td><?php if($row["pay_mode"]==1){ if($row["gst"]!=''){echo $row["gst"]/2;}else{echo 0;} } else{
                                    echo 0;
                                } ?></td>
                                <td><?php if($row["pay_mode"]==2){ if($row["gst"]!=''){echo $row["gst"];}else{echo 0;} } else{
                                    echo 0;
                                } ?></td>
                                
                                    
                                    
                                    
                                    
                                    
                                    </tr>
                                    <?php 
                                    $i++;
                                      
                                }
                                }
                            }
                                ?>
                              
                                
                            </tbody>
                    </table>
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
<!-- <script>
      $(document).ready(function() {
                $('#example').DataTable();
            } );

         function show1(){
            //  var client_name = $("#client_name1").val();
             var from_date = $("#from_date").val();
             var to_date = $("#to_date").val();
                // alert('client_name');
              $.ajax({
               url:"show_carprt.php",
               method:"POST",
               data:{ f:from_date, t:to_date},
               success:function(data)
               {
                $('.tbl').html(data);
               }
              });
            }

</script> -->

<script src="custom/js/categories.js"></script>
<script src="custom/js/excel1.js"></script>
<script>
    function excel() {

        alert('hello');
        var createXLSLFormatObj = [];

        / XLS Head Columns /
        var xlsHeader = ["Id", "date", "Bill No", "Client Name", "Total Amount", " CGST", "SGST", "IGST", "Seller Name", "Bill No", "Total Amount", "GST"];

        / XLS Rows Data /
        $.ajax({
            url: "php_action/ca_excel.php",
            type: "post",
            data: {
                a: "a"
            },
            dataType: 'json',
            success: function(data) {
                alert(data.xls);
                adsn(data.xls);
            }
        });

        function adsn(fsg) {
            //alert(fsg);
            var xlsRows = fsg
            xlsRows = JSON.parse(xlsRows);
            //alert(xlsRows);
            createXLSLFormatObj.push(xlsHeader);
            $.each(xlsRows, function(index, value) {
                var innerRowData = [];
                $.each(value, function(ind, val) {

                    innerRowData.push(val);
                });
                createXLSLFormatObj.push(innerRowData);
            });


            / File Name /
            var filename = "ca_report.xlsx";

            / Sheet Name /
            var ws_name = "A.K.Bag House";

            if (typeof console !== 'undefined') console.log(new Date());
            var wb = XLSX.utils.book_new(),
                ws = XLSX.utils.aoa_to_sheet(createXLSLFormatObj);

            / Add worksheet to workbook /
            XLSX.utils.book_append_sheet(wb, ws, ws_name);

            / Write workbook and Download /
            if (typeof console !== 'undefined') console.log(new Date());
            XLSX.writeFile(wb, filename);
            if (typeof console !== 'undefined') console.log(new Date());

        }
    }
</script>
