<?php


if (isset($_SESSION['admin'])){

    $all_activities = "SELECT * FROM `Activity` ORDER BY `Activity` ";
    $all_activities_auto = autocomplete_list($dbconnect, $all_activities, 'Activity');

    $description = "Please enter the activity name";
    $activity = "";
    $met = "";

    $met = 0;

    $has_errors = "no";

    $description_error = $activity_error = $met_error = "no-error";
    $description_field = "form-ok"; 
    $activity_field = "tag-ok";
    $met_field = "tag-ok";


if($_SERVER["REQUEST_METHOD"] == "POST"){

    $description = mysqli_real_escape_string($dbconnect, $_POST['description']);
    $activity = mysqli_real_escape_string($dbconnect,$_POST['activity']);
    $met = mysqli_real_escape_string($dbconnect,$_POST['met']);

    if($activity == "" or $activity == "Please enter the activity name"){
        $has_errors = "yes";
        $activity_error = "error-text";
        $activity_field = "form-error";
    }

    if($description == ""){
        $has_errors = "yes";
        $description_error = "error-text";
        $description_field = "form-error";
    }

    if($met == ""){
        $has_errors="yes";
        $met_error ="error-text";
        $met_field = "form-error";
    }

    $letters = "/[A-Z]/";

    if(preg_match($letters, $met)){
        $has_errors ="yes";
        $met_error = "error-text";  
        $met_field = "form-error";
    }

    if($has_errors != "yes"){
        $activity_ID = get_ID($dbconnect,'Activity','Activity_ID','Activity',$activity);
        $addactivity_sql = "INSERT INTO `MET` (`ID`, `Activity_ID`, `Description`, `METS`) VALUES (NULL,'$activity_ID','$description','$met');";
        $addactivity_query = mysqli_query($dbconnect, $addactivity_sql);

        $get_description_sql = "SELECT * from `MET` WHERE `Description` = '$description'";
        $get_description_query = mysqli_query($dbconnect,$get_description_sql);
        $get_description_rs = mysqli_fetch_assoc($get_description_query);

        $description_ID = $get_description_rs['ID'];
        $_SESSION['Activity_success'] = $description_ID;
        header("Location:index.php?page=activity_success");
    }

}
}

else {

    $login_error =  'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");
}


?>

<h1> Add an activity</h1>

<form autocomplete="off" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?page=../admin/newactivity");?>"
enctype="multipart/form-data">

    <div class="<?php echo $description_error; ?>">
        This field cannot be left blank
    </div>

    <input class="add-field <?php echo $description_field ?>" name="description" rows="2" placeholder="<?php echo $description; ?>">
    <br /><br /> 

    <div class="<?php echo $activity_error ?>">
        Please enter a category
    </div>

    <div class="autocomplete">
    <input class="add-field <?php echo $activity_field; ?>" id="activity"
    type="text" name="activity" placeholder="Category">
    </div>

    <br /><br />

    <div class="<?php echo $met_error; ?>">
        Please enter a MET amount (Must be a number)
    </div>
    
    <input class="add-field <?php echo $met_field; ?>" type='text' name='met' placeholder="MET's"/>

    <br /><br />

    <p>
        <input class="add-field" type="submit" value="Submit" />
    </p>


</form>



<script>

<?php include("autocomplete.php"); ?>

var activity = <?php print("$all_activities_auto"); ?>;
autocomplete(document.getElementById("activity"), activity);

</script>   