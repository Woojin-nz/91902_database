<?php

if(isset($_SESSION['admin'])) {

    $deleteactivitysql = "DELETE FROM `MET` WHERE `ID`=".$_REQUEST['itemID'];
    $deleteactivityquery = mysqli_query($dbconnect, $deleteactivitysql);

?>

<h1> Delete Success </h1>

<p>The activity has been deleted </p>

<?php  

}

else {

    $login_error = "Please login to access this page";
    header("Location: index.php?page=../admin/login&error=$login_error");
}

?>