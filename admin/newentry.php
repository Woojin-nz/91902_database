
<h1 style="text-align: center"> Add a new entry </h1>
<p style="text-align: center;"><i>
    Please select if you wish to enter a new <b>food</b> item or a new <b>activity</b>
</i></p>


<?php


if (isset($_SESSION['admin'])){
?>
<div style="text-align: center;" >
<a href="index.php?page=../admin/newfood" class="button1">Food</a>
<span>&nbsp; &nbsp;</span>
<a href="index.php?page=../admin/newactivity" class="button1">Activity</a>
</div>
<?php
}
else {

    $login_error =  'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");
}


?>
