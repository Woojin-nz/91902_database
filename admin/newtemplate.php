<?php


if (isset($_SESSION['admin'])){
    echo 'You are logged in';


}

else {

    $login_error =  'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");
}


?>