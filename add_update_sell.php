<?php require_once 'includes/ak_header.php'; ?>
<?php



$sql1 = "SELECT * FROM godown_entry ";
$godownr = mysqli_query($connect, $sql1);
$godownr1 = $godownr;


$sql5 = "SELECT * FROM  client_detail ";
$client = mysqli_query($connect, $sql5);
$client1 = $client;
//print_r ($client);



$sql6 = "SELECT * FROM  customber_login ";
$sealer = mysqli_query($connect, $sql6);
$sealer1 = $sealer;

$sql2 = "SELECT * FROM color ";
$colorr = mysqli_query($connect, $sql2);


$sql3 = "SELECT * FROM gsm ";
$gsmr = mysqli_query($connect, $sql3);

$sql4 = "SELECT * FROM other ";
$otherr = mysqli_query($connect, $sql4);
$otherr1 = $otherr;

$sql5 = "SELECT * FROM material_enrty ";
$materialr = mysqli_query($connect, $sql5); 
$materialr1 = $materialr;

$amtsql = "SELECT * FROM bill ";
$gsmr = mysqli_query($connect, $amtsql);
$gsmr1 = $gsmr;


if (isset($_POST['submit'])) {

    $client_name = $_POST['client_name'];
    $godown_name = $_POST['godown_name'];
    $color = $_POST['color'];
    $gsm = $_POST['gsm'];
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
    $total_amount = $_POST['total_amount'];
    $cutting_charge = $_POST['cutting_charge'];
    $printing_charge = $_POST['printing_charge'];
    $fright = $_POST['fright'];
    //$other_charge = $_POST['other_charge'];
    $gst = $_POST['gst'];
    $amount = $_POST['amount'];
    $balance_amount = $_POST['balance_amount'];
    $paid_amount = $_POST['paid_amount'];
    $taken_by = $_POST['taken_by'];
    $pay_mode = $_POST['pay_mode'];
    $note = $_POST['note'];
    $grand_total = $_POST['grand_total'];
    $old_blance = $_POST['old_balance'];
    $amtsqla = "SELECT * FROM customber_login WHERE id='$client_name'";
    $gsmra = mysqli_query($connect, $amtsqla);
    $client_id1 = mysqli_fetch_assoc($gsmra);
    $client_id = $client_id1['username'];
    $material_name = $_POST['material_name'];
    $bill_no = $_POST['bill_no'];
    $orderDate = $_POST['orderDate'];
    $hsn = $_POST['hsn'];
    $discount = $_POST['discount'];

    $amtsqla = "UPDATE bill SET balance_amount='0' WHERE client_id='$client_name'";
    $gsmrA = mysqli_query($connect, $amtsqla);

    $sqlc="UPDATE invoice SET slip='".$bill_no."' WHERE id='1'";
    $resultp = mysqli_query($connect, $sqlc);

    $sqla = "INSERT INTO  `bill` (`discount`,`hsn`,`date`,`bill_no`,`material_name`,`client_name`,`grand_total`,`old_blance`,`client_id`, `godown_name`, `color`, `gsm`, `quantity`, `weight`, `rate`, `amount`, `cutting_charge`, `printing_charge`,`fright`, `gst`, `total_amount`, `balance_amount`, `paid_amount`, `taken_by` ,`pay_mode`, `note` ) VALUES('$discount','$hsn','$orderDate','$bill_no','$material_name','$client_id','$grand_total','$old_blance','$client_name', '$godown_name', '$color', '$gsm', '$quantity', '$weight', '$rate', '$amount', '$cutting_charge', '$printing_charge', '$fright','$gst' , '$total_amount' , '$balance_amount', '$paid_amount', '$taken_by', '$pay_mode', '$note') ";
    if (mysqli_query($connect, $sqla)) {
        $amtsql = "SELECT * FROM bill ORDER BY id DESC LIMIT 1";
        $gsmr = mysqli_query($connect, $amtsql);
        $list = mysqli_fetch_assoc($gsmr);

        echo "<script>
            window.location='manage_sell.php?id=".$list['id']."';
        </script>";
        // echo " data inserted succsessfully"; 
    } else {
        // echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }
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
<?php 
         if (isset($_POST['submit'])) {
          $client_name = $_POST['client_name'];

          $sellsql = " SELECT * FROM bill WHERE client_name = $client_name";
          $usell = mysqli_query($connect, $sellsql);
}
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
                <h3> Sell Report </h3>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <div class="col">

                            <div>

                                <?php 
                                $sql="SELECT slip FROM invoice ORDER BY id DESC LIMIT 1";
                                    $result = mysqli_query($conn, $sql);
                                    $invoice = mysqli_fetch_assoc($result);
                                    $slip = $invoice['slip']+1;
                                ?>
                                <div class="row mb-3">
                                    <label for="bill" class="col-sm-4 col-form-label">Bill NO.</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" value="<?php echo $slip; ?>" id="bill_no" name="bill_no" readonly>
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
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Select Customer</label>
                                    <div class="col-sm-8">
                                        <!--<select name="client_name" id="client" onchange="client()" onclick="client()" onkeyup="client()" style="width: 100%;" >-->
                                        <input type="text" name="client_name" id="client1" list="client" onchange="client()" onclick="client()" onkeyup="client()" style="width: 100%;"/>
                                         <datalist id="client">
                                        
                                        
                                            <!--<option value="select"> -- Select Customer  name -- </option>-->
                                            <?php

                                            while ($row = mysqli_fetch_array($gsmr)) {
                                            ?>
                                                <option value="<?php echo $row['client_name']; ?>"> <?php echo $row['client_name']; ?></option>
                                            <?php } ?>
                                            </datalist>

                                       <!--</select>-->

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
                            <label for="inputEmail3"  class="col-sm-4 col-form-label">Godown</label>
                            <div class="col-sm-8">
                                <select name="godown_name" onclick="godown()" onchange="godown()"  onkeyup="godown()" id="godown_name" style="width: 100%;">
                                    <option value="select"> -- Select Godown -- </option>
                                    <?php
                                    while ($row = mysqli_fetch_array($godownr)) {
                                    ?>
                                        <option value="<?php echo $row['godown_name']; ?>"> <?php echo $row['godown_name']; ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>


                    </div>
                </div>
                
                <script>
                    function godown()
                    {
                        var id = $("#godown_name").val();
                        $.ajax({
                          type:'post',
                          url:'fetch_gsm_other_color.php',
                          data:{id:id},
                          dataType:"json",
                          success:function(response) {
                            $("#color").html(response.color);
                            $("#other").html(response.other);
                            $("#gsm").html(response.gsm);
                          }
                         });
                        
                    }
                    
                    
                    
                </script>
               <!-- <div class="col">
                    <div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Material</label>
                            <div class="col-sm-8">
                                <select name="material_name" id="material_name" style="width: 100%;">
                                    <option value="select"> -- Select Material -- </option>
                                    <?php
                                    while ($row = mysqli_fetch_array($materialr)) {
                                    ?>
                                        <option value="<?php echo $row['material_name']; ?>"> <?php echo $row['material_name']; ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>


                    </div>
                </div>
-->
                
                <div class="col">
                    <div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Select Color</label>
                            <div class="col-sm-8">
                                <select name="color" id="color" style="width: 100%;">
                                    <option value="select"> -- Select Color -- </option>
                                    <?php
                                    while ($row = mysqli_fetch_array($colorr)) {
                                    ?>
                                        <option value="<?php echo $row['color']; ?>"> <?php echo $row['color']; ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col">
                    <div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Select GSM</label>
                            <div class="col-sm-8">
                                <select name="gsm" id="gsm" style="width: 100%;">
                                    <option value="select"> -- Select GSM -- </option>
                                    <?php
                                    while ($row = mysqli_fetch_array($gsmr)) {
                                    ?>
                                        <option value="<?php echo $row['gsm']; ?>"> <?php echo $row['gsm']; ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="col">
                    <div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Select Other</label>
                            <div class="col-sm-8">
                                <select name="other" id="other" style="width: 100%;">
                                    <option value="select"> -- Select Other -- </option>
                                    <?php
                                    while ($row = mysqli_fetch_array($otherr)) {
                                    ?>
                                        <option value="<?php echo $row['other']; ?>"> <?php echo $row['other']; ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>


                    </div>
                </div>
               
                <div class="col">
                    <div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">HSN code</label>
                            <div class="col-sm-8">
                                <input name="hsn" id="hsn" style="width: 100%;">
                                   
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
                        var quantity1 =  $('#quantity1').val();
                        // var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
                        var mult = rate * quantity1; // gives the value for subtract from main value
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
                        var quantity1 =  $('#quantity1').val();
                        // var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
                        var mult = rate * quantity1; // gives the value for subtract from main value
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
                        var weight = $('#weight').val();
                        // var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
                        // var mult = rate * weight; // gives the value for subtract from main value
                        var discont =  rate * weight;
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
                        var weight = $('#weight').val();
                        // var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
                        // var mult = rate * weight; // gives the value for subtract from main value
                        var discont =  rate * weight;
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
                                <input type="text" class="form-control" id="gst_amount" name="gst_amount">
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="cutting_charge" class="col-sm-6 col-form-label">Cutting Expencess</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="cutting_charge" name="cutting_charge">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="printing_charge" class="col-sm-6 col-form-label">Printing Expencess</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="printing_charge" name="printing_charge">
                            </div>
                        </div>

                    </div>

                </div>
                 
                <div class="col-sm-3">
                    <div>
                        <div class="card-body">

                            <div class="row mb-3">
                                <label for="firght" class="col-sm-6 col-form-label">Fright</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="fright" name="fright">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                

                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="total_amount" class="col-sm-6 col-form-label">Total</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="total_amount" name="total_amount" readonly>
                            </div>
                        </div>

                    </div>

                </div>
                <script type="text/javascript">
                    
                    $("#client").on("change, keyup, click", function()
                    {
                         var id = $("#client").val();
                         //console.log(id);
                         $.ajax({
                          type:'post',
                          url:'old_balance.php',
                          data:{id:id},
                          dataType:"json",
                          success:function(response) {
                            $("#old_balance").val(response.val);
                            if(response.val=='')
                            {
                                $("#old_balance").val(0);
                            }
                            $("#client_name_is").val(response.name);
                            //console.log(response);
                          }
                         });
                    });

                </script>
                
                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="old_amount" class="col-sm-6 col-form-label">OLD Balance</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="old_balance" name="old_balance" readonly>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="old_amount" class="col-sm-6 col-form-label">Discount</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="discount" name="discount">
                            </div>
                        </div>

                    </div>

                </div>
               
                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="grand_total" class="col-sm-6 col-form-label">Grand Total</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="grand_total" name="grand_total" readonly>
                            </div>
                        </div>

                    </div>

                </div>
                <script>
                    $(document).on("change keyup blur", "#fright", function() {
                        //var fright = $('#fright').val();
                        var total_amount = $('#total_amount').val();
                        var old_balance =  $('#old_balance').val();
                        var discount =  $('#discount').val();
                        console.log(total_amount);
                        console.log(old_balance);
                        var grand_total = parseFloat(total_amount) + parseFloat(old_balance) -  parseFloat(discount);
                        $('#grand_total').val(grand_total);
                    });

                $(document).on("change keyup blur", "#discount", function() {
                        //var fright = $('#fright').val();
                        var total_amount = $('#total_amount').val();
                        var old_balance =  $('#old_balance').val();
                        var discount =  $('#discount').val();
                        console.log(total_amount);
                        console.log(old_balance);
                        var grand_total = parseFloat(total_amount) + parseFloat(old_balance) -  parseFloat(discount);
                        $('#grand_total').val(grand_total);
                    });                </script>
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

                <div class="col-sm-3">

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="Payment_place" class="col-sm-6 col-form-label">Payment place</label>
                            <div class="col-sm-6">
                                <select type="text" class="form-control" id="pay_mode" name="pay_mode">
                                    <option value="1">In state</option>
                                    <option value="2">Out of state</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="row">



                
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
                <button class="btn btn-primary" type="submit" id="save" name="submit" style="width: 100px">UPDATE</button>

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
        var cutting_charge = parseFloat($('#cutting_charge').val());
        var printing_charge = parseFloat($('#printing_charge').val());
        var fright = parseFloat($('#fright').val());
        // var other_charge = parseFloat($('#other_charge').val());
        var gst = parseFloat($('#gst').val());
        var gst_amount = parseFloat($('#gst_amount').val());

        // var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
        var total =  cutting_charg + printing_charge + fright + gst_amount; // gives the value for subtract from main value
        //  var t_amount = quantity *  mult;
        $('#total_amount').val(total);
    });
</script>
<script>
    $(document).on("change keyup blur", "#cutting_charge", function() {
        var amount = parseFloat($('#amount2').val());
        var cutting_charge = parseFloat($('#cutting_charge').val());
        var printing_charge = parseFloat($('#printing_charge').val());
        var fright = parseFloat($('#fright').val());
        // var other_charge = parseFloat($('#other_charge').val());
        var gst = parseFloat($('#gst').val());
        var gst_amount = parseFloat($('#gst_amount').val());


        // var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
        var total = cutting_charge + printing_charge + fright+ gst_amount; // gives the value for subtract from main value
        //  var t_amount = quantity *  mult;
        $('#total_amount').val(total);
    });
</script>
<script>
    $(document).on("change keyup blur", "#printing_charge", function() {
        var amount = parseFloat($('#amount2').val());
        var cutting_charge = parseFloat($('#cutting_charge').val());
        var printing_charge = parseFloat($('#printing_charge').val());
        var fright = parseFloat($('#fright').val());
        // var other_charge = parseFloat($('#other_charge').val());
        var gst = parseFloat($('#gst').val());
        var gst_amount = parseFloat($('#gst_amount').val());


        // var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
        var total =  cutting_charge + printing_charge + fright + gst_amount; // gives the value for subtract from main value
        //  var t_amount = quantity *  mult;
        $('#total_amount').val(total);
    });
</script>
<script>
    $(document).on("change keyup blur", "#fright", function() {
        var amount = parseFloat($('#amount2').val());
        var cutting_charge = parseFloat($('#cutting_charge').val());
        var printing_charge = parseFloat($('#printing_charge').val());
        var fright = parseFloat($('#fright').val());
        // var other_charge = parseFloat($('#other_charge').val());
        var gst = parseFloat($('#gst').val());
        var gst_amount = parseFloat($('#gst_amount').val());


        // var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
        var total =  cutting_charge + printing_charge + fright + gst_amount; // gives the value for subtract from main value
        //  var t_amount = quantity *  mult;
        $('#total_amount').val(total);
    });
</script>
<script>
    $(document).on("change keyup blur", "#other_charge", function() {
        var amount = parseFloat($('#amount2').val());
        var cutting_charge = parseFloat($('#cutting_charge').val());
        var printing_charge = parseFloat($('#printing_charge').val());
        var fright = parseFloat($('#fright').val());
        // var other_charge = parseFloat($('#other_charge').val());
        var gst = parseFloat($('#gst').val());
        var gst_amount = parseFloat($('#gst_amount').val());


        // var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
        var total =  cutting_charge + printing_charge + fright + gst_amount; // gives the value for subtract from main value
        //  var t_amount = quantity *  mult;
        $('#total_amount').val(total);
    });
</script>


<script>
    $(document).on("change keyup blur", "#paid_amount", function() {
        var total_amount = $('#grand_total').val();
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
    
</script>
<?php require_once 'includes/footer.php'; ?>