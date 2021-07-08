<?php


if (isset($_SESSION['admin'])){

    $ID = $_REQUEST['itemID'];

    $find_sql = "SELECT * FROM `MET` WHERE `ID` = $ID";
    $find_query = mysqli_query($dbconnect, $find_sql);
    $find_rs = mysqli_fetch_assoc($find_query);

    $all_activities = "SELECT * FROM `Activity` ORDER BY `Activity` ";
    $all_activities_auto = autocomplete_list($dbconnect, $all_activities, 'Activity');

    $description = $find_rs['Description'];
    
    $activity_ID = $find_rs['Activity_ID'];
    $activity_rs = get_rs($dbconnect,
    "SELECT * FROM `Activity` WHERE `Activity_ID` = $activity_ID");
    $activity = $activity_rs['Activity'];

    $met = $find_rs['METS'];

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

    $letters = "/[a-zA-Z]/i";

    if(preg_match($letters, $met) == 1){
        $has_errors ="yes";
        $met_error = "error-text";  
        $met_field = "form-error";
    }

    if($has_errors != "yes"){
        $activity_ID = get_ID($dbconnect,'Activity','Activity_ID','Activity',$activity);

        $editactivity_sql = "UPDATE `MET` SET `Activity_ID` = '$activity_ID', `Description` = '$description', `METS` = '$met' WHERE `MET`.`ID` = $ID;";
        $editactivity_query = mysqli_query($dbconnect, $editactivity_sql);

        $get_description_sql = "SELECT * from `MET` WHERE `Description` = '$description';";
        $get_description_query = mysqli_query($dbconnect,$get_description_sql);
        $get_description_rs = mysqli_fetch_assoc($get_description_query);

        $description_ID = $get_description_rs['ID'];
        $_SESSION['Activity_success'] = $description_ID;
        header("Location:index.php?page=editactivity_success");
    }

}
}

else {

    $login_error =  'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");
}


?>

<h1> Edit entry </h1>

<form autocomplete="off" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?page=../admin/editactivity&itemID=$ID");?>"
enctype="multipart/form-data">

    <b> Activity Name:</b> <br />
    <div class="<?php echo $description_error; ?>">
        This field cannot be left blank
    </div>
    <textarea class="add-field <?php echo $description_field ?>" name="description" rows="2"><?php echo $description; ?>
    </textarea>
    <br /><br /> 


    <b>Category: </b>

    <div class="<?php echo $activity_error ?>">
        Please enter a category
    </div>
    <div class="autocomplete">
    <input class="add-field <?php echo $activity_field; ?>" id="activity"
    type="text" name="activity" placeholder="Category" value=<?php echo $activity; ?>>
    </div>

    <br /><br />
    <b>Number of MET(s): </b> <br />
    <div class="<?php echo $met_error; ?>">
        Please enter a MET amount (Must be a number)
    </div>
    
    <input class="add-field <?php echo $met_field; ?>" type="text" name="met" placeholder="MET's" value=<?php echo $met; ?>>

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