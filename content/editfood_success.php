<h2> Edit Success! </h2>

<p> You have edited the following quote </p>

<?php

$food_ID = $_SESSION['Food_success'];
$find_sql = "SELECT * FROM `Item`
WHERE `Item_ID` = $food_ID";
$find_query = mysqli_query($dbconnect,$find_sql);
$find_rs = mysqli_fetch_assoc($find_query);

?>

<?php
do{

    $food = preg_replace('/[^A-Za-z0-9.,\s\'\-]/',' ', $find_rs['Item']);
    
    ?>
<div class="results">
    <p>
        <a href="index.php?page=item&item_ID=<?php echo $find_rs['Item_ID'];?>">
        <?php echo $food; ?>
        </a>
    </p>
</div>
    
<br />
<?php    

} // end of display results 'do'
while($find_rs = mysqli_fetch_assoc($find_query))
?>