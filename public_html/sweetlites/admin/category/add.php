<?php
if (!defined('WEB_ROOT')) {
	exit;
}


$parentId = (isset($_GET['parentId']) && $_GET['parentId'] > 0) ? $_GET['parentId'] : 0;

?>
 

<form action="processCategory.php?action=add" method="post" enctype="multipart/form-data" name="frmCategory" id="frmCategory">
 <p align="center" class="formTitle"><strong>Add Category</strong></p>
 
 <table width="80%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label"><strong>Category Name</strong></td>
   <td class="content"><strong> 
     <input name="txtName" type="text" class="box" id="txtName" size="30" maxlength="50">
   </strong></td>
  </tr>
  <tr> 
   <td width="150" class="label"><strong>Description</strong></td>
   <td class="content"><strong> 
     <textarea name="mtxDescription" cols="50" rows="4" class="box" id="mtxDescription"></textarea>
   </strong></td>
  </tr>
 
  <tr> 
   <td width="150" class="label"><strong>Image</strong></td>
   <td class="content"><strong> 
     <input name="fleImage" type="file" id="fleImage" class="box"> 
     <input name="hidParentId" type="hidden" id="hidParentId" value="<?php echo $parentId; ?>">
   </strong></td>
  </tr>
   <tr> 
   <td width="150" class="label"><strong>Publish</strong></td>
   <td class="content"><strong>

   <select name="publish" id="publish">
     <option selected>YES</option>
     <option>NO</option>
   </select>
</strong></td>
  </tr>
  
 </table>
 <p align="center"> 

  <input name="btnAddCategory" type="button" id="btnAddCategory" value="Add Category" onClick="checkCategoryForm();" class="bluebox">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php?catId=<?php echo $parentId; ?>';" class="bluebox">  
 </p>
</form>
