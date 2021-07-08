<?php

if(isset($_SESSION['admin'])) {

    $activity = $_REQUEST['activityID'];

    // Delete Items Associated
    $deleteitem_sql = "DELETE FROM `Activity` WHERE `Activity_ID` =".$_REQUEST['activityID'];
    $deleteitem_query = mysqli_query($dbconnect,$deleteitem_sql);

    //Delete the Brand
    $deletebrand_sql = "DELETE FROM `MET` WHERE `MET`.`Activity_ID`=".$_REQUEST['activityID'];
    $deletebrand_query = mysqli_query($dbconnect, $deletebrand_sql);
?>
<h1> Delete Success! </h1>

<p>The activity group and its associated entries have been successfully deleted </p>


<?php
}

else {

    $login_error = "Please login to access this page";
    header("Location: index.php?page=../admin/login&error=$login_error");
}

?>