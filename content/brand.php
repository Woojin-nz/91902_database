
<?php

if(!isset($_REQUEST['brand_ID']))
{
    header('Location:index.php');
}

$brand_to_find = $_REQUEST['brand_ID'];

$find_sql = "SELECT * FROM `Menu`
JOIN Item ON (`Item`.`Item_ID` = `Menu`.`Item_ID` ) JOIN Brand ON (`Brand`.`Brand_ID` =`Menu`.`Brand_ID`) JOIN Category ON ( `Category`.`Category_ID` = `Menu`.`Category_ID`)
WHERE `Menu`.`Brand_ID` = $brand_to_find ORDER BY `Item`.`Item` ASC
";
$find_query = mysqli_query($dbconnect, $find_sql);
$find_rs = mysqli_fetch_assoc($find_query);
?>

<h2> <?php echo $find_rs['Brand'] ?> </h2>

<?php

// Loop through results and display them... 
do {
    
    $item = preg_replace('/[^A-Za-z0-9.,?\s\'\-]/','',$find_rs['Item']);

    // Brand and Category and Serving
    $brand = $find_rs['Brand'];
    $category = $find_rs['Category'];
    $serving = $find_rs['Serving_Size'];

    ?>
<div class="results">
    <p>
        <a href="index.php?page=item&item_ID=<?php echo $find_rs["Item_ID"]; ?>"> 
        <?php echo $item; ?></a>
    </p>

    <!-- Serving size to differentiate by products -->
    <?php echo $serving; ?><br />

    <!-- Brand and Category go here -->
    <p>
    <a href="index.php?page=brand&brand_ID=<?php echo $find_rs["Brand_ID"];?>">
    <span class="tag">
    <?php echo $brand; ?></a></span>
    <a href="index.php?page=category&category_ID=<?php echo $find_rs["Category_ID"];?>">
    <span class="tag">
    <?php echo $category; ?><br /></a></span>
</div>

<br />

<?php

} // end of display results 'do'

while($find_rs = mysqli_fetch_assoc($find_query))

?>