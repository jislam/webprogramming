<?php
if (!defined('WEB_ROOT')) {
	exit;
}


if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
	$catId = (int)$_GET['catId'];
	$sql2 = " AND p.cat_id = $catId ";
	$queryString = "catId=$catId";
} else {
	$catId = 0;
	$sql2  = '';
	$queryString = '';
}

// for paging
// how many rows to show per page
$rowsPerPage = 5;
$sql = "SELECT prod_id, c.cat_id, cat_name, prod_name, prod_thumbnail
        FROM product p, tbl_category c
		WHERE p.prod_publish='Y' and c.cat_publish='Y' and p.cat_id = c.cat_id $sql2
		ORDER BY prod_name";
$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
$pagingLink = getPagingLink($sql, $rowsPerPage, $queryString);

$categoryList = buildCategoryOptions($catId);

?>



<div align="center">
  <h2><img src="../images/shop_products.png" width="48" height="48">Product Information </h2>
</div>
<form action="processProduct.php?action=addProduct" method="post"  name="frmListProduct" id="frmListProduct">
 <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td align="right"><span class="text"><strong>View products in : 
           <select name="cboCategory" class="box" id="cboCategory" onChange="viewProduct();">
           <option selected>All Category</option>
	      <span class="text"> <?php echo $categoryList; ?></span>
        </select>
       </strong></span></td>
    </tr>
 </table>
 <br>
 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
    <tr align="center" id="listTableHeader"> 
      <td><span class="text"><strong>Product Name</strong></span></td>
      <td width="75"><span class="text"><strong>Thumbnail</strong></span></td>
      <td width="75"><span class="text"><strong>Category</strong></span></td>
      <td width="70"><span class="text"><strong>Modify</strong></span></td>
      <td width="70"><span class="text"><strong>Delete</strong></span></td>
    </tr>
    <?php
$parentId = 0;
if ($result->num_rows > 0) {
	$i = 0;
	
	while($row = dbFetchAssoc($result)) {
		extract($row);
		
		if ($prod_thumbnail) 
		{
			$prod_thumbnail = WEB_ROOT . 'images/product/' . $prod_thumbnail;
		} else 
		{
			$prod_thumbnail = WEB_ROOT . 'images/no-image-small.png';
		}	
		
		
		
		if ($i%2) {
			$class = 'row1';
		} else {
			$class = 'row2';
		}
		$i += 1;
?>
    <tr class="<?php echo $class; ?>"> 
      <td><span class="text"><a href="index.php?view=detail&productId=<?php echo $prod_id; ?>"><?php echo $prod_name; ?></a></span></td>
      <td width="75" align="center"><span class="text"><img src="<?php echo $prod_thumbnail; ?>"></span></td>
      <td width="75" align="center"><span class="text"><a href="?c=<?php echo $cat_id; ?>"><?php echo $cat_name; ?></a></span></td>
      <td width="70" align="center"><span class="text"><a href="javascript:modifyProduct(<?php echo $prod_id; ?>);">Modify</a></span></td>
      <td width="70" align="center"><span class="text"><a href="javascript:deleteProduct(<?php echo $prod_id; ?>, <?php echo $catId; ?>);">Delete</a></span></td>
    </tr>
    <?php
	} // end while
?>
    <tr> 
      <td colspan="5" align="center">
         <span class="text">
         <?php 
echo $pagingLink;
   ?>
      </span></td>
    </tr>
    <?php	
} else {
?>
    <tr> 
      <td colspan="5" align="center"><span class="text"><strong>No Products Yet</strong></span></td>
    </tr>
    <?php
}
?>
    <tr> 
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="5" align="right"><span class="text">
        <input name="btnAddProduct" type="button" id="btnAddProduct" value="Add Product" class="bluebox" onClick="addProduct(<?php echo $catId; ?>)">
      </span></td>
    </tr>
 </table>
 <p>&nbsp;</p>
</form>
