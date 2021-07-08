<?php

$quick_find = mysqli_real_escape_string($dbconnect,$_POST['quick_search']);

$menu_sql = "SELECT * FROM `Menu` JOIN Item ON (`Item`.`Item_ID` = `Menu`.`Item_ID` ) 
		JOIN Brand ON (`Brand`.`Brand_ID` =`Menu`.`Brand_ID`) 
		JOIN Category ON ( `Category`.`Category_ID` = `Menu`.`Category_ID`)
		WHERE `Category` OR `Item` LIKE '%$quick_find%'";
$menu_query = mysqli_query($dbconnect, $menu_sql);
$menu_rs = mysqli_fetch_assoc($menu_query);

$activity_sql = "SELECT * FROM `MET` JOIN Activity ON (`Activity`.`Activity_ID` = `MET`.`Activity_ID`)
                WHERE `Activity` OR `Description` LIKE '%$quick_find%'";
$activity_query = mysqli_query($dbconnect, $activity_sql);
$activity_rs = mysqli_fetch_assoc($activity_query);

if(strlen($menu_rs == 0 and $activity_rs == 0)){
    ?>
    <h2>Oops!</h2>
    
    <div class="error">
        Sorry- there are no entries that match the search term <i><b><?php
        echo $quick_find ?></b></i>. Please Try Again.
    </div>
<?php    
}
elseif(strlen($menu_rs > 0)){
    ?>
    <h2>Here are your matching entries from the food menu for "<?php echo $quick_find?>"</h2>

    <?php
    get_menu($dbconnect,$menu_sql,$menu_query,$menu_rs);
}
else{
    ?>
    <h2>Here are your matching entires from the activity table for "<?php echo $quick_find?>"</h2>
    <?php
    get_activity($dbconnect,$activity_sql,$activity_query,$activity_rs);
}