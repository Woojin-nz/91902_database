<?php

if(isset($_SESSION['admin'])) {

    $deleteitemsql = "DELETE FROM `Menu` WHERE `ID`=".$_REQUEST['itemID'];
    $deleteitemquery = mysqli_query($dbconnect, $deleteitemsql);

?>

<h1> Delete Success </h1>

<p>The item has been deleted </p>

<?php  

}

else {

    $login_error = "Please login to access this page";
    header("Location: index.php?page=../admin/login&error=$login_error");
}

?>