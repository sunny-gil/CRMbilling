<?php require_once 'php_action/core.php'; ?>

<?php
//fetch.php

// $connect = mysqli_connect("localhost", "root", "", "testing");
$output = '';
$search = $_POST['a'];
if(1)
{
//  $query= mysqli_real_escape_string($connect, $_POST["query"]);
$query = "SELECT * FROM   bill WHERE client_id LIKE '".$search."%'";
$result = mysqli_query($connect, $query);
}


if(mysqli_num_rows($result) > 0 && $search != "")
{
 $output .= '
 <div class="table-responsive">
 <table class="table table bordered" id="example" style="width:100%"> 
 
 <tr>
 <th>Bill Date</th>
 <th>Bill No.</th>
 <th>Customer name</th>
 <th>Old Balance</th>
 <th>Total Amount</th>
 <th>Amount Paid</th>
 <th>Balance</th>
 <th>Payment Mode</th>
 <th>Name Who Taken</th>

 <th>Action</th>
 </tr>';
 

 while($row = mysqli_fetch_array($result))
 {
     if($row["pay_mode"]==1)
     {
        $mode = "In State";
     }
     if($row["pay_mode"]==2)
     {
        $mode = "Out of State";
     }
      $monthNum = $row['date'];
                                    $monthNum1 = $monthNum;
                                    $monthNum = date("m", strtotime($monthNum));
                                    $day = date("d", strtotime($monthNum1));
                                    $year = explode('-', $monthNum1);
                                    $dateid = $day." ".$monthName = date('M', mktime(0, 0, 0, $monthNum, 10))." ".$year[0]; 
     
     
     
  $output .= '
   <tr>
    <td>'.$dateid.'</td>
    <td>'.$row["bill_no"].'</td>
    <td>'.$row["client_id"].'</td>
    <td>'.$row["old_blance"].'</td>
    <td>'.$row["total_amount"].'</td>
    <td>'.$row["paid_amount"].'</td>
    <td>'.$row["balance_amount"].'</td>
    <td>'.$mode.'</td>
    <td>'.$row["taken_by"].'</td>
    
    <td><a href="new_bill.php?client_id='.$row["id"].'"><i class="far fa-eye"></a></td>
     
   </tr>
   
  ';
 }
 
 $output .='</table>';
echo $output;
}
else
{
echo 'Data Not Found';
}

?>