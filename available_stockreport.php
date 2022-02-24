<?php require_once 'includes/ak_header.php'; ?>

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
	<!-- client details REPORT -->
<br><br>
 
<div class="container">
        
        <section>
            <div class="card">
                <div class="card-header" style="text-align: center"><h4> <u> Stock Report</u></h4></div>
                <!-- <input type="text" readonly class="form-control-plaintext" id="curent_date" value="<?php echo date("d-m-Y"); ?> "> -->
                <div class="card-body">


                    <!--<form action="" method="post">-->

                    <!--    <div class="row">-->
                    <!--        <div class="col-sm-4">-->
                    <!--            <div>-->
                    <!--            <div class="card-body">-->
                    <!--            <form>-->
                    <!--                <div class="row mb-1">-->
                    <!--                    <label for="from_date" class="col-sm-5 col-form-label">From Date</label>
                    <!--                    <div class="col-sm-7">-->
                    <!--                    <input type="date" class="form-control" value="<?php echo date("Y-m-d") ?>" id="from_date" name="from_date" autocomplete="off"  />-->
                    <!--                         <datalist id="productName">-->
                    <!--                            <option value="Pen">Pen</option>-->
                    <!--                            <option value="Pencil">Pencil</option>-->
                    <!--                            <option value="Paper">Paper</option>-->
                    <!--                        </datalist> -->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </form>-->
                    <!--            </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="col-sm-4">-->
                    <!--            <div>-->
                    <!--            <div class="card-body">-->
                    <!--            <form>-->
                    <!--                <div class="row mb-1">-->
                    <!--                    <label for="from_date" class="col-sm-5 col-form-label">To Date</label>-->
                    <!--                    <div class="col-sm-7">-->
                    <!--                    <input type="date" class="form-control" value="<?php echo date("Y-m-d") ?>" id="to_date" name="to_date" autocomplete="off"  />
                    <!--                         <datalist id="productName">
                    <!--                            <option value="Pen">Pen</option>-->
                    <!--                            <option value="Pencil">Pencil</option>-->
                    <!--                            <option value="Paper">Paper</option>-->
                    <!--                        </datalist> -->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </form>-->
                    <!--            </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div class="row">-->
                    <!--        <div class="col-sm-5">-->
                    <!--                <div>-->
                    <!--                <div class="card-body">-->
                                   
                    <!--                </div>-->
                    <!--                </div>-->
                    <!--            </div>-->

                    <!--        <div class="col-sm-1">-->
                    <!--            <div>-->
                    <!--            <div class="card-body">-->
                    <!--                <form>-->
                    <!--                    <div class="row mb-3">-->
                    <!--                    <button type="button" id="show" onclick="show1()" class="btn btn-primary" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Show</button>-->
                    <!--                    </div>-->
                    <!--                </form>-->
                    <!--            </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                       
                    <!--        <div class="col-sm-1">-->
                    <!--            <div >-->
                    <!--            <div class="card-body">-->
                    <!--            <form>-->
                    <!--                    <div class="row mb-3">-->
                    <!--                     <button type="button" class="btn btn-primary" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i>print</button> -->
                    <!--                    </div>-->
                    <!--                </form>-->
                    <!--            </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="col-sm-1">-->
                    <!--            <div >-->
                    <!--            <div class="card-body">-->
                    <!--            <form>-->
                    <!--                    <div class="row mb-3">-->
                    <!--                     <button type="button" class="btn btn-primary" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Excel</button> -->
                    <!--                    </div>-->
                    <!--                </form>-->
                    <!--            </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</form>-->

                    <div class="tbl"  style="overflow-x:auto;">
                    <table class="table" id="example" class="display nowrap" style="width:100%">
    
                         <div class="table-responsive">
                         <table class="table table bordered" id="example" style="width:100%"> 
                         
                             <tr>
                            
                             <th scope="col">Godown Name</th>
                             <th scope="col">Material Name</th>
                             <th scope="col">Other Material Name</th>
                             <th scope="col"> Color</th>
                             <th scope="col">GSM</th>
                              <th scope="col">weight</th>
                             <th scope="col">Quantity</th>
                            
                             </tr>
                             <?php
                             
                            $date = date("Y-m-d");
                            
                                  $query = "SELECT * FROM  stock WHERE date = '$date'  ORDER BY godown_name ASC ";
                                    $result = mysqli_query($connect, $query);
                                    while($row = mysqli_fetch_array($result))
                                    {
   
                                  ?>
                              <tr>
                                  
                                  
                                  
                               
                               
                                <td><?php echo $row['godown_name']; ?></td>
                                 <td><?php echo $row['material_name']; ?></td>
                                <td><?php echo $row['other']; ?></td>
                               
                                <td><?php echo $row['color']; ?></td>
                                <td><?php echo $row['gsm']; ?></td>
                                <td><?php echo $row['weight']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                
                                <?php } ?>
                               </tr>
                           
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
        
        <script>
             $(document).ready(function() {
                $('#example').DataTable();
            } );


            function show1(){
            //  var material_name = $("#material_name1").val();
             var from_date = $("#from_date").val();
             var to_date = $("#to_date").val();
                // alert(from_date);
              $.ajax({
               url:"stock_avlbl.php",
               method:"POST",
               data:{f:from_date, t:to_date},
               success:function(data)
               {
                $('.tbl').html(data);
               }
              });
            }
        </script>

