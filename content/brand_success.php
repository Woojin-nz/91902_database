<?php

$newbrand_ID = $_SESSION['Brand_success'];

$find_sql = "SELECT * FROM `Brand` WHERE `Brand_ID` = $newbrand_ID";
$find_query = mysqli_query($dbconnect,$find_sql);
$find_rs = mysqli_fetch_assoc($find_query);

$brand = "";

?>
<h2> Success! </h2>

<p> You have added the following brand into the database </p>
<?php
do{

    $brand = preg_replace('/[^A-Za-z0-9.,\s\'\-]/',' ', $find_rs['Brand']);
    
    ?>
<div class="results">
    <p>
        <?php echo $brand; ?><br />
    </p>
</div>
    
<br />
<?php    

} // end of display results 'do'
while($find_rs = mysqli_fetch_assoc($find_query))
?>