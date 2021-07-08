
<?php

if(!isset($_REQUEST['item_ID']))
{
    header('Location:index.php');
}

$item_to_find = $_REQUEST['item_ID'];

$find_sql = "SELECT * FROM `Menu`
JOIN Item ON (`Item`.`Item_ID` = `Menu`.`Item_ID` ) JOIN Brand ON (`Brand`.`Brand_ID` =`Menu`.`Brand_ID`) JOIN Category ON ( `Category`.`Category_ID` = `Menu`.`Category_ID`)
WHERE `Menu`.`Item_ID` = $item_to_find
";
$find_query = mysqli_query($dbconnect, $find_sql);
$find_rs = mysqli_fetch_assoc($find_query);

?>

<br />

<div class="about">
    <h2> <?php echo $find_rs['Item']; ?>
      </h2>
      <a href="index.php?page=calculatorstats&ID=<?php echo $find_rs["ID"];?>"> 
            <i class="fa fa-calculator fa-3x"></i></a>
    <p><b>Brand:</b> <?php echo $find_rs['Brand']; ?> </p>
    <p><b>Category:</b> <?php echo $find_rs['Category']; ?> </p>
    <p><b>Serving Size:</b> <?php echo $find_rs['Serving_Size']; ?> </p>
    <p><b>Calories:</b> <?php echo $find_rs['Calories'].' cal'; ?> </p>
    <p><b>Fat:</b> <?php echo $find_rs['Fat']. ' g'; ?> </p>
    <p><b>Cholesterol:</b> <?php echo $find_rs['Cholesterol'].' g'; ?> </p>
    <p><b>Sodium:</b> <?php echo $find_rs['Sodium'].' mg'; ?> </p>
    <p><b>Carbohydrates:</b> <?php echo $find_rs['Carbohydrates'].' g'; ?> </p>
    <p><b>Sugar:</b> <?php echo $find_rs['Sugars'].' g'; ?> </p>
    <p><b>Protein:</b> <?php echo $find_rs['Protein'].' g'; ?> </p>
    <p><b>Caffeine:</b> <?php echo $find_rs['Caffeine'].' mg'; ?> </p>


</div>

<?php

if(isset($_SESSION['admin'])){
    
    ?>
<div class="edit-tools-item">

<a href="index.php?page=../admin/edititem&itemID=<?php echo $find_rs['ID']; ?>"
title="Edit Item"><i class="fa fa-edit fa-2x"></i></a>

&nbsp;&nbsp;

<a href="index.php?page=../admin/deleteitem_confirm&itemID=<?php echo $find_rs['ID']; ?>"
title="Delete Item"><i class="fa fa-trash fa-2x"></i></a>
</div>
<?php
}

?>
