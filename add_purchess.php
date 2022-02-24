<?php require_once 'includes/ak_header.php'; ?>
<?php



$sql1 = "SELECT * FROM godown_entry ";
$godownr = mysqli_query($connect, $sql1);
$godownr1 = $godownr;


$sql5 = "SELECT * FROM  client_detail ";
$client = mysqli_query($connect, $sql5);
$client1 = $client;
//print_r ($client);



$sql6 = "SELECT * FROM  sealer_detail ";
$sealer = mysqli_query($connect, $sql6);
$sealer1 = $sealer;

$sql2 = "SELECT * FROM color ";
$colorr = mysqli_query($connect, $sql2);


$sql3 = "SELECT * FROM gsm ";
$rgsm = mysqli_query($connect, $sql3);

$sql4 = "SELECT * FROM other ";
$otherr = mysqli_query($connect, $sql4);
$otherr1 = $otherr;

$sql5 = "SELECT * FROM material_enrty ";
$materialr = mysqli_query($connect, $sql5); 
$materialr1 = $materialr;

$amtsql = "SELECT * FROM bill ";
$gsmr = mysqli_query($connect, $amtsql);


if (isset($_POST['submit'])) {
    $bill_no = $_POST['bill_no'];
    // $$date =date("Y-m-d");
    $sealer_name = $_POST['sealer_name'];
   
    // $material_name = $_POST['material_name'];
    $color = $_POST['color'];
    $gsm = $_POST['gsm'];
    $other = $_POST['other'];
    // $quantity = $_POST['quantity'];
    // $weight = $_POST['weight'];
    // $rate = $_POST['rate'];
    $total_amount = $_POST['total_amount'];
    // $cutting_charge = $_POST['cutting_charge'];
    // $printing_charge = $_POST['printing_charge'];
    // $fright = $_POST['fright'];
    // $other_charge = $_POST['other_charge'];
    $gst = $_POST['gst'];
    $amount = $_POST['amount'];
    $balance_amount = $_POST['balance_amount'];
    $paid_amount = $_POST['paid_amount'];
    $taken_by = $_POST['taken_by'];
    // $pay_mode = $_POST['pay_mode'];
    $note = $_POST['note'];
    // $redio = $_POST['redio'];
    $orderDate = $_POST['orderDate'];
    // if($radio == "roll"){
    //     $quantity = $_POST['quantity1'];
    //     $weight = $_POST['weight1'];
    //     $rate = $_POST['rate1'];
    // }
    // if($radio == "bag"){
    //     $quantity = $_POST['quantity'];
    //     $weight = $_POST['weight'];
    //     $rate = $_POST['rate'];
    // }
    $gst_amount = $_POST['gst_amount'];
    
    if($_POST['redio']=='bag')
    {
        $quantity = $_POST['quantity'];
        $weight = $_POST['weight'];
        $rate = $_POST['rate'];
    }
    if($_POST['redio']=='roll')
    {
        $quantity = $_POST['quantity1'];
        $weight = $_POST['weight1'];
        $rate = $_POST['rate1'];
    }



    $sqls = "INSERT INTO  `sealer_bill` (`sealer_name`,  `color`, `gsm`, `other`, `quantity`, `weight`, `rate`, `amount`, `gst`, `total_amount`, `balance_amount`, `paid_amount`, `taken_by` , `note`,`bill_no`,`date` ) VALUES('$sealer_name',  '$color', '$gsm', '$other', '$quantity', '$weight', '$rate', '$amount', '$gst' , '$gst_amount' , '$balance_amount', '$paid_amount', '$taken_by', '$note', '$bill_no','$orderDate' ) ";
    if (mysqli_query($connect, $sqls)) {
        
        // echo " data inserted succsessfully"; 
    } else {
        // echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }
    
    
}
// echo "<script>window.location ='manage_purches.php'; </script>"
//  header("location: manage_purches.php");
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
if (isset($_POST['gstn'])) {
    $gstn2 = $_POST['gstn'];
    $sqlvn = "UPDATE gstn SET gstn='$gstn2' WHERE id='1'";
    $resultan = $connect->query($sqlvn);
}
$sql = "SELECT gstn FROM gstn ORDER BY id DESC LIMIT 1";
$result = $connect->query($sql);
if ($result->num_rows > 0) {
    $rowbc = $result->fetch_array();
} // if num_rows 


?>




<style type="text/css">
    .ui-datepicker-calendar {
        display: none;
    }

    .row {
        margin-top: 2%;
        margin-bottom: 3%;
    }

    .badge {
        float: right !important;

        background-color: red !important;
        border-radius: 50% !important;
        color: #fff !important;
    }

    .card-body {
        padding: 0.7rem 1rem;
    }

    .row {
        margin-top: 0% !important;
        margin-bottom: 0% !important;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">


<!-- fullCalendar 2.2.5-->
<link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
<link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- client entry -->
<br><br>

<div class="container">
    <section>
        <div class="card">
            <div class="card-header" style="text-align: center">
                <h3> Purchess Report </h3>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <div class="col">

                            <div>


                                <div class="row mb-3">
                                    <label for="bill" class="col-sm-4 col-form-label">Bill NO.</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="bill_no" name="bill_no">
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col">
                            <div>

                                <div class="row mb-3">
                                    <label for="billType" class="col-sm-4 col-form-label">Bill</label>
                                    <div class="col-sm-8">
                                        <!-- <select class="form-select" id="bill_type" name="bill_type">
                                            <option selected disabled value="">Select</option>
                                            <option>ESTIMATED MEMO</option>
                                            <option>TAX INVOICE</option>
                                        </select> -->

                                        <input type="text" value="TAX INVOICE" class="form-control" autocomplete="off" readonly />
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col">
                            <div> 

                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" value="<?php echo date("Y-m-d") ?>" class="form-control" id="orderDate" name="orderDate" autocomplete="off" />
                                    </div>
                                </div>
                                

                            </div>
                        </div>
                        <div class="col">
                            <div>

                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Sealer  Name</label>
                                    <div class="col-sm-8">
                                        
                                        
                                        <input type="text" id="sealer_name" name="sealer_name"  class="form-control" autocomplete="off"  />
                                        
                                       


                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>

            </div>
            <hr>
           

            <div class="row row-cols-1 row-cols-md-3 g-4">
                
                <div class="col">
                    <div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Material</label>
                            <div class="col-sm-8">
                                   
                                <input type="text"  class="form-control" name="material_name" id="material_name">

                            </div>
                        </div>


                    </div>
                </div>
                
    <!--            <input type="text" name="product" list="productName"/>-->
    <!--<datalist id="productName">-->
    <!--    <option value="Pen">Pen</option>-->
    <!--    <option value="Pencil">Pencil</option>-->
    <!--    <option value="Paper">Paper</option>-->
    <!--</datalist>-->

                
                <div class="col">
                    <div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label"> Color</label>
                            <div class="col-sm-8">
                                
                                 <input type="text"  class="form-control" name="color" id="color" >
                                 
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col">
                    <div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label"> GSM</label>
                            <div class="col-sm-8">
                                
                                <input type="text" class="form-control" name="gsm" id="gsm">
                                
                            </div>
                        </div>


                    </div>
                </div>

               <div class="col ">
                    <div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">HSN code</label>
                            <div class="col-sm-8">
                                <input type="text" name="hsn" id="hsn" style="width: 100%;">
                                   
                            </div>
                        </div>
                    </div>
                </div>
               

            </div>


            <div class="col">
                <div>

                    <div class="row mb-3">
                        <label for="type" class="col-sm-4 col-form-label" style="text-align: center;">Select Type of Order </label>
                        <div class="col-sm-5">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="redio" id="roll" value="roll">
                                <label class="form-check-label" for="colorgsm">ROLL</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="redio" id="bag" value="bag">
                                <label class="form-check-label" for="other">BAG</label>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="row box roll selectt">
                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="quantity" class="col-sm-6 col-form-label">Quantity</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="quantity1" name="quantity1">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="weight" class="col-sm-6 col-form-label">Weight(kg)</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="weight1" name="weight1">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="rate" class="col-sm-6 col-form-label">Rate(per kg)</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="rate1" name="rate1">
                            </div>
                        </div>

                    </div>

                </div>




                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="amount" class="col-sm-6 col-form-label">Amount</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="amount1" name="amount" readonly>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- var fright = parseFloat($('#fright').val()); -->


                <script>
                    $(document).on("change keyup blur", "#rate1", function() {
                        // var quantity = $('#quantity').val();
                        var rate =$('#rate1').val();
                        var weight =$('#weight1').val();
                        var gst =  $('#gst').val();
                        // var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
                        var mult = rate * weight; // gives the value for subtract from main value
                        // var discont = quantity * mult;

                        $('#amount1').val(mult);
                        $('#amount2').val(mult);

                        var gst_amt = mult*(gst/100);
                            //  alert(gst_amt);
                        var gst_amount = mult + gst_amt;
                            // alert(gst_amount);
                        $('#gst_amount').val(gst_amount);
                    });
                </script>

                <script>
                    $(document).on("change keyup blur", "#weight1", function() {
                        // var quantity = $('#quantity').val();
                        var rate = $('#rate1').val();
                        var weight = $('#weight1').val();
                        var gst =  $('#gst').val();
                        // var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
                        var mult = rate * weight; // gives the value for subtract from main value
                        // var discont = quantity * mult;
                        $('#amount1').val(mult);
                        $('#amount2').val(mult);

                        var gst_amt = mult*(gst/100);
                            //  alert(gst_amt);
                        var gst_amount = mult + gst_amt;
                            // alert(gst_amount);
                        $('#gst_amount').val(gst_amount);
                    });
                </script>

            </div>

            <div class="row box bag selectt">
                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="quantity" class="col-sm-6 col-form-label">Quantity</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="quantity" name="quantity">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="weight" class="col-sm-6 col-form-label">Weight(kg)</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="weight" name="weight">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="rate" class="col-sm-6 col-form-label">Rate(per kg)</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="rate" name="rate">
                            </div>
                        </div>

                    </div>

                </div>




                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="amount" class="col-sm-6 col-form-label"> Amount</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="amount" name="amount" readonly>
                            </div>
                        </div>

                    </div>

                </div>


                <script>
                    $(document).on("change keyup blur", "#rate", function() {
                        var quantity = $('#quantity').val();
                        var rate = $('#rate').val();
                        var gst =  $('#gst').val();
                        // var weight = $('#weight').val();
                        // var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
                        // var mult = rate * weight; // gives the value for subtract from main value
                        var discont = quantity * rate;
                        $('#amount').val(discont);
                        $('#amount2').val(discont);

                        var gst_amt = discont*(gst/100);
                            //  alert(gst_amt);
                        var gst_amount = discont + gst_amt;
                            // alert(gst_amount);
                        $('#gst_amount').val(gst_amount);

                    });
                </script>
                <script>
                    $(document).on("change keyup blur", "#quantity", function() {
                        var quantity = $('#quantity').val();
                        var rate = $('#rate').val();
                        var gst =  $('#gst').val();
                        // var weight = $('#weight').val();
                        // var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
                        // var mult = rate * weight; // gives the value for subtract from main value
                        var discont = quantity * rate;
                        $('#amount').val(discont);
                        $('#amount2').val(discont);
                        var gst_amt = discont*(gst/100);
                            //  alert(gst_amt);
                        var gst_amount = discont + gst_amt;
                            // alert(gst_amount);
                        $('#gst_amount').val(gst_amount);
                    });
                </script>


            </div>

            <hr>

            <div class="row">
                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="amount" class="col-sm-6 col-form-label">Taxabal Amount</label>
                            <div class="col-sm-6">


                                <!-- <input type="text" name= "total_amount" id="total_amount" value= ""> -->



                                <input type="text" class="form-control" id="amount2" name="amount" readonly>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="gst" class="col-sm-6 col-form-label">GST %</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="gst" name="gst">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="gst" class="col-sm-6 col-form-label">Amount</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="gst_amount" name="gst_amount" readonly>
                            </div>
                        </div>

                    </div>

                </div>

                <!--<div class="col-sm-3">-->

                <!--    <div class="card-body">-->

                <!--        <div class="row mb-3">-->
                <!--            <label for="cutting_charge" class="col-sm-6 col-form-label">Cutting Expencess</label>-->
                <!--            <div class="col-sm-6">-->
                <!--                <input type="text" class="form-control" id="cutting_charge" name="cutting_charge">-->
                <!--            </div>-->
                <!--        </div>-->

                <!--    </div>-->

                <!--</div>-->
                <!--<div class="col-sm-3">-->

                <!--    <div class="card-body">-->

                <!--        <div class="row mb-3">-->
                <!--            <label for="printing_charge" class="col-sm-6 col-form-label">Printing Expencess</label>-->
                <!--            <div class="col-sm-6">-->
                <!--                <input type="text" class="form-control" id="printing_charge" name="printing_charge">-->
                <!--            </div>-->
                <!--        </div>-->

                <!--    </div>-->

                <!--</div>-->
                <!--<div class="col-sm-3">-->
                <!--    <div>-->
                <!--        <div class="card-body">-->

                <!--            <div class="row mb-3">-->
                <!--                <label for="firght" class="col-sm-6 col-form-label">Fright</label>-->
                <!--                <div class="col-sm-6">-->
                <!--                    <input type="text" class="form-control" id="fright" name="fright">-->
                <!--                </div>-->
                <!--            </div>-->

                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->


                <!--<div class="col-sm-3">-->

                <!--    <div class="card-body">-->

                <!--        <div class="row mb-3">-->
                <!--            <label for="total_amount" class="col-sm-6 col-form-label">Total</label>-->
                <!--            <div class="col-sm-6">-->
                <!--                <input type="text" class="form-control" id="total_amount" name="total_amount" readonly>-->
                <!--            </div>-->
                <!--        </div>-->

                <!--    </div>-->

                <!--</div>-->
                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="amount_paid" class="col-sm-6 col-form-label">Amount Paid</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="paid_amount" name="paid_amount">
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="row">



                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="balance" class="col-sm-6 col-form-label">Balance</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="balance_amount" name="balance_amount" readonly>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">

                    <label for="taken_by" class="col-sm-6 col-form-label">Extra Note:- </label>
                    <textarea id="note" class="note" name="note" rows="3" cols="50">

                                </textarea>


                </div>
                <div class="col-sm-3"></div>


                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="taken_by" class="col-sm-6 col-form-label">Taken By</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="taken_by" name="taken_by">
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div style="text-align:end">
                <a href="dashboard.php"><button class="btn btn-primary" type="button" id="prt" name="prt" style="width: 200px">Cancel</button></a>
               <button class="btn btn-primary" type="submit" id="save" name="submit" style="width: 100px">ADD</button>
<!--                 <a href="puarchess_bill.php"><button class="btn btn-primary" type="button" id="prt" name="prt" style="width: 200px">PRINT BILL</button></a> -->

            </div>

            
            </form>
           


        </div>
</div>



</section>

</div>

<br><br><br>

<!-- calculation -->



<script>
    $(document).on("change keyup blur", "#gst", function() {
        var amount = parseFloat($('#amount2').val());
        // var cutting_charge = parseFloat($('#cutting_charge').val());
        // var printing_charge = parseFloat($('#printing_charge').val());
        // var fright = parseFloat($('#fright').val());
        // var other_charge = parseFloat($('#other_charge').val());
        var gst_amount = parseFloat($('#gst_amount').val());

        // var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
        var total =  gst_amount; // gives the value for subtract from main value
        //  var t_amount = quantity *  mult;
        $('#total_amount').val(total);
    });
</script>



<script>
    $(document).on("change keyup blur", "#paid_amount", function() {
        var total_amount = $('#gst_amount').val();
        var paid_amount = $('#paid_amount').val();



        // var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
        var total = (total_amount - paid_amount); // gives the value for subtract from main value
        //  var t_amount = quantity *  mult;
        $('#balance_amount').val(total);
    });
</script>





<!-- fullCalendar 2.2.5 -->
<script src="assests/plugins/moment/moment.min.js"></script>
<script src="assests/plugins/fullcalendar/fullcalendar.min.js"></script>


<script type="text/javascript">
    $(function() {
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


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(".roll").hide();
    $(".bag").hide();

    $(document).ready(function() {
        $('input[type="radio"]').click(function() {
            var inputValue = $(this).attr("value");
            if (inputValue == "bag") {
                var bagamt = $('#amount').val();
                var baggst = $('#gst').val();
                $(".roll").not(targetBox).hide();
                $(".box").show();
                $(".roll").hide();
                $('#amount2').val(bagamt);
                $('#gst').val(18);
            }
            if (inputValue == "roll") {
                var targetBox = $("." + inputValue);
                var rollamt = $('#amount1').val();
                var rollgst = $('#gst').val();

                $(".box").not(targetBox).hide();
                $(targetBox).show();
                $(".bag").hide();
                $('#amount2').val(rollamt);
                $('#gst').val(12);
            }
        });
    });
</script>

<!-- <script>
    $(".bag").hide();
    $(document).ready(function() {
        $('input[type="radio"]').click(function() {
            var inputValue = $(this).attr("value");
            var targetBox = $("." + inputValue);
            var bagamt = $('#amount').val();
            $(".box").not(targetBox).hide();
            $(targetBox).show();
            $('#amount2').val(bagamt);
        });
    });
</script> -->


<script>
    function client() {

    }
</script>
<?php require_once 'includes/footer.php'; ?>