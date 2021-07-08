<?php

$description_ID = $_SESSION['Activity_success'];
$find_sql = "SELECT * FROM `MET` WHERE `ID` = $description_ID";
$find_query = mysqli_query($dbconnect,$find_sql);
$find_rs = mysqli_fetch_assoc($find_query);


?>
<h2> Success! </h2>

<p> You have added the following activity into the database </p>

<?php

// Loop through results and display them... 
do {

    $activity = preg_replace('/[^A-Za-z0-9.,?\s\'\-]/','',$find_rs['Description']);

    //MET amount
    $MET = $find_rs['METS'];
    ?>
<div class="results">
    <p>
        <?php echo $activity; ?></a>
    </p>

    <!-- MET Amount -->
    <p>
    <span class="tag">
    <?php echo $MET." METS"; ?><br /></a></span>
</div>
<br />
<?php
} // end of display results 'do'
while($find_rs = mysqli_fetch_assoc($find_query));

?>