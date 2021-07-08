<p>
    <span class="tag">
    <?php echo $MET." METS"; ?><br />
    </a></span>

<?php

if(isset($_SESSION['admin'])){
    
?>
<div class="edit-tools">
<a href="index.php?page=../admin/editactivity&itemID=<?php echo $find_rs['ID']; ?>"
title="Edit Item"><i class="fa fa-edit fa-2x"></i></a>

&nbsp;&nbsp;

<a href="index.php?page=../admin/deleteactivity_confirm&itemID=<?php echo $find_rs['ID']; ?>"
title="Delete Item"><i class="fa fa-trash fa-2x"></i></a>
</div>
<?php
}

?>


</p>