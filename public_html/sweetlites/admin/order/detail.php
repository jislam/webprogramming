<?php
if (!defined('WEB_ROOT')) {
	exit;
}

if (!isset($_GET['oid']) || (int)$_GET['oid'] <= 0) {
	header('Location: index.php');
}

$orderId = (int)$_GET['oid'];

// get ordered items
$sql = "SELECT prod_name, prod_price, oi.prod_qty
	    FROM order_item oi, product p
		WHERE oi.prod_id = p.prod_id and oi.order_id = $orderId
		ORDER BY order_id ASC";

$result = dbQuery($sql);
$orderedItem = array();
if($result->num_rows >0){
    while ($row = $result->fetch_assoc()){
        $orderedItem[] = $row;
    }
}
// get order information
$sql = "SELECT order_date, order_last_update, order_status, order_shipping_recipient, order_shipping_address1,
               order_shipping_address2, order_shipping_phone, order_shipping_state, order_shipping_city, order_shipping_zip, order_shipping_cost,
			   order_payment_fname, order_payment_lname, order_payment_address1, order_payment_address2, order_payment_phone,
			   order_payment_state, order_payment_city , order_payment_zip,
			   order_memo
	    FROM order_info
		WHERE order_id = $orderId";

$result = dbQuery($sql);
extract(dbFetchAssoc($result));

$orderStatus = array('New', 'Paid', 'Shipped', 'Completed', 'Cancelled');
$orderOption = '';
foreach ($orderStatus as $status) {
	$orderOption .= "<option value=\"$status\"";
	if ($status == $order_status) {
		$orderOption .= " selected";
	}
	
	$orderOption .= ">$status</option>\r\n";
}
?>
<p>&nbsp;</p>
<form action="" method="get" name="frmOrder" id="frmOrder">
    <table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
        <tr> 
            <td colspan="2" align="center" id="infoTableHeader">Order Detail</td>
        </tr>
        <tr> 
            <td width="150" class="label">Order Number</td>
            <td class="content"><?php echo $orderId; ?></td>
        </tr>
        <tr> 
            <td width="150" class="label">Order Date</td>
            <td class="content"><?php echo $order_date; ?></td>
        </tr>
        <tr> 
            <td width="150" class="label">Last Update</td>
            <td class="content"><?php echo $order_last_update; ?></td>
        </tr>
        <tr> 
            <td class="label">Status</td>
            <td class="content"> <select name="cboOrderStatus" id="cboOrderStatus" class="box">
                    <?php echo $orderOption; ?> </select> <input name="btnModify" type="button" id="btnModify" value="Modify Status" class="box" onClick="modifyOrderStatus(<?php echo $orderId; ?>);"></td>
        </tr>
    </table>
</form>
<p>&nbsp;</p>
<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
    <tr id="infoTableHeader"> 
        <td colspan="3">Ordered Item</td>
    </tr>
    <tr align="center" class="label"> 
        <td>Item</td>
        <td>Unit Price</td>
        <td>Total</td>
    </tr>
    <?php
$numItem  = count($orderedItem);
$subTotal = 0;
for ($i = 0; $i < $numItem; $i++) {
	extract($orderedItem[$i]);
	$subTotal += $prod_price * $prod_qty;
?>
    <tr class="content"> 
        <td><?php echo "$prod_qty X $prod_name"; ?></td>
        <td align="right"><?php echo displayAmount($prod_price); ?></td>
        <td align="right"><?php echo displayAmount($prod_qty * $prod_price); ?></td>
    </tr>
    <?php
}
?>
    <tr class="content"> 
        <td colspan="2" align="right">Sub-total</td>
        <td align="right"><?php echo displayAmount($subTotal); ?></td>
    </tr>
    <tr class="content"> 
        <td colspan="2" align="right">Shipping</td>
        <td align="right"><?php echo displayAmount($order_shipping_cost); ?></td>
    </tr>
    <tr class="content"> 
        <td colspan="2" align="right">Total</td>
        <td align="right"><?php echo displayAmount($order_shipping_cost + $subTotal); ?></td>
    </tr>
</table>
<p>&nbsp;</p>
<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
    <tr id="infoTableHeader"> 
        <td colspan="2">Shipping Information</td>
    </tr>
    <tr> 
        <td width="150" class="label">Recipient Name</td>
        <td class="content"><?php echo $order_shipping_recipient; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">Address1</td>
        <td class="content"><?php echo $order_shipping_address1; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">Address2</td>
        <td class="content"><?php echo $order_shipping_address2; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">Phone Number</td>
        <td class="content"><?php echo $order_shipping_phone; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">Province / State</td>
        <td class="content"><?php echo $order_shipping_state; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">City</td>
        <td class="content"><?php echo $order_shipping_city; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">Postal Code</td>
        <td class="content"><?php echo $order_shipping_zip; ?> </td>
    </tr>
</table>
<p>&nbsp;</p>
<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
    <tr id="infoTableHeader"> 
        <td colspan="2">Payment Information</td>
    </tr>
    <tr> 
        <td width="150" class="label">First Name</td>
        <td class="content"><?php echo $order_payment_fname; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">Last Name</td>
        <td class="content"><?php echo $order_payment_lname; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">Address1</td>
        <td class="content"><?php echo $order_payment_address1; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">Address2</td>
        <td class="content"><?php echo $order_payment_address2; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">Phone Number</td>
        <td class="content"><?php echo $order_payment_phone; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">Province / State</td>
        <td class="content"><?php echo $order_payment_state; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">City</td>
        <td class="content"><?php echo $order_payment_city; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">Postal Code</td>
        <td class="content"><?php echo $order_payment_zip; ?> </td>
    </tr>
</table>
<p>&nbsp;</p>
<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
    <tr id="infoTableHeader"> 
        <td colspan="2">Buyer's Memo</td>
    </tr>
    <tr> 
        <td colspan="2" class="label"><?php echo nl2br($order_memo); ?> </td>
    </tr>
</table>
<p>&nbsp;</p>
<p align="center"> 
    <input name="btnBack" type="button" id="btnBack" value="Back" class="box" onClick="window.history.back();">
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
