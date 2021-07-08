<p>
    <a href="index.php?page=brand&brand_ID=<?php echo $menu_rs["Brand_ID"]; ?>">
        <span class="tag">
            <?php echo $brand; ?></a></span>
    <a href="index.php?page=category&category_ID=<?php echo $menu_rs["Category_ID"]; ?>">
        <span class="tag">
            <?php echo $category; ?><br />
    </a>
    </span>

<?php

if(isset($_SESSION['admin'])){
    
    ?>
<div class="edit-tools">
<a href="index.php?page=../admin/edititem&itemID=<?php echo $menu_rs['ID']; ?>"
title="Edit Item"><i class="fa fa-edit fa-2x"></i></a>

&nbsp;&nbsp;

<a href="index.php?page=../admin/deleteitem_confirm&itemID=<?php echo $menu_rs['ID']; ?>"
title="Delete Item"><i class="fa fa-trash fa-2x"></i></a>
</div>
<?php
}

?>


</p>