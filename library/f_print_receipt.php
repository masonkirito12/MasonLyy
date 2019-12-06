<?php
include_once("connection/db.php");
mysqli_set_charset($conn, 'utf8');

$date = date('Y-m-d');
//Select Book List
$select = "SELECT o.id oid,m.name mname,m.ic mic,b.image bimage,b.name bname,bd.barcode barcode,o.borrow_date borrow_date,o.return_date return_date,o.status ostatus,o.pay_price pay_price,o.return_status return_status FROM borrow o
           INNER JOIN member m ON m.id = o.member_id
           INNER JOIN book_detail bd ON bd.id = o.book_id
           INNER JOIN book b ON b.id = bd.book_id
           WHERE o.status = 'success' AND o.id = '".$_GET['id']."'";
$result = mysqli_query($conn,$select);
$row = mysqli_fetch_assoc($result);
?>

<style type="text/css" media="print">
    @page 
    {
        size:  auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }

    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  /* this affects the margin on the html before sending to printer */
    }

    body
    {
        /*border: solid 1px blue ;*/
        margin: 10mm 0mm 10mm 0mm; /* margin you want for the content */
    }
</style>

<style>
table {
    border-collapse: collapse;
}

.border{
    border: 1px solid black;
}
.bottomleft {
  position: fixed;
  bottom: 60px;
}

</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Receipt</title>
</head>

<body onLoad="window.print()" style="font-family: Arial;">
<div style=" width:90%; margin-left:auto; margin-right:auto; padding:10px">
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td width="1%" valign="middle"><div><img src="images/download.png" width="201" height="167" alt=""/></div></td>
        <td colspan="3" width="100%">
          <div style="display:inline-block; padding:0px 20px">
            <p><small><span style="font-size:20px; font-weight:bold">Library Central Academy Sdn Bhd (189213 - K)</span></small><br />
            <small>
            Email : Library@admin.com.my<br />
            Tel : 04-3984787/04-3904189 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp	Fax : 04-3984787<br />
            No. 6, 8, 10, Jalan Perai Jaya 1, Bandar Perai Jaya, 13600 Perai, Penang.<br />
            No. 32, 34, 40, 42, 44, 46, 48, Jalan Perai Jaya 4, Bandar Perai Jaya, 13600 Perai, Penang.
            </small></p>
          </div>
        </td>
    </tr>
    
    <tr>
      <td colspan="2">
      <br />
      <br />
        <table width="70%">
          <tr>
            <td align="left">
            Name: <?php echo $row['mname']; ?>
            </td>
          </tr>
          <tr>
            <td align="left">
            IC: <?php echo $row['mic']; ?>
            </td>
          </tr>
        </table>
      </td>
    
      <td colspan="1" valign="bottom" width="10%" align="right">
        <div style="<!--direction:rtl-->;text-align: left;margin-left: 100px;">
          <strong>Official Receipt </strong><br />
          <strong>No </strong>:<?php echo $row['barcode'];?> / <?php echo $row['oid'] ?>
          <br /><strong>Date </strong>:<?php echo $date; ?>
        </div>
      </td>
    </tr>
  </table>
  <hr />
  <br />
  
  <table width="100%" border="0" cellspacing="2" cellpadding="4" style="font-size:14px">
  
  <tr bgcolor="#999999">
    <th rowspan="2" align="center" class="border" colspan="2" width="70%">Description</th>
    <th colspan="2" align="center" class="border" width="30%">Amount</th>
  </tr>
  <tr bgcolor="#999999">
    <th align="center" class="border">RM</th>
    <th align="center" class="border">Cts</th>
  </tr>

  <tr style="height:30px;">
    <td align="center" class="border" colspan="2"><p style="float:left;"><?=$row['bname']." [".$row['barcode']."] - ".$row['return_status']?></p></td>
  <?php 
    $str = $row['pay_price'];
		$new_str = explode(".",$str);
		$rm = $new_str[0];
		
		if(!empty($new_str[1])){
			$length1 = strlen($new_str[1]);
			if($length1 == 1){
				$new_cts = $new_str[1]*10;
			}elseif($length1 == 2){
				$new_cts = $new_str[1];
			}
		}else{
			$new_cts = '00';
		}
  ?>
    <td align="center" class="border">
      <?php if($row['return_status'] == "late" ){ ?>
      <span style="margin-left:-10px"><?php echo $rm;?></span>
      <?php }elseif($row['return_status'] == "missing" ){ ?>
      <span style="margin-left:-10px"><?php echo $rm;?></span>
      <?php }?>
    </td>
      
    <td align="center" class="border" colspan="2">
      <?php if($row['return_status'] == "late" ){ ?>
      <span style="margin-left:-10px"><?php echo $new_cts;?></span>
      <?php }elseif($row['return_status'] == "missing" ){ ?>
      <span style="margin-left:-10px"><?php echo $new_cts;?></span>
      <?php }?>
    </td>
  </tr>

  <tr>
    <td style="border:0px"><p>* Fee Paid are not returnable</p></td>
    <td style="border:0px" align="right"><p>Total</p></td>
    <td bgcolor="#E9E9E9" align="center" class="border">
      <?php if($row['return_status'] == "late" ){
        echo $rm;
      }else if($row['return_status'] == "missing"){
        echo $rm;
      }?>
    </td>
    <td bgcolor="#E9E9E9" align="center" class="border">
      <?php if($row['return_status'] == "late" ){
        echo $new_cts;
      }else if($row['return_status'] == "missing"){
        echo $new_cts;
      }?>
    </td>	
  </tr>
    
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr> 
  
    <tr>
        <td colspan=""> 
        <div class="bottomleft">
        <table width="30%">
                <tr >
                    <td colspan="2" align="center" valign="bottom">
                    __________________________
                    </td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2" align="center" valign="bottom">
                    __________________________
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" align="center">
                    	<i>Issue by</i>
                    </td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2" align="center" >
                    	<i>Student Signature</i>
                    </td>
                </tr> 
            </table>
          </div>
        </td>
    </tr>
  </table>	
  </div>	
</body>
