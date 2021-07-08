<h1>Calculator</h1>

<p class="error"> <b>DISCLAMER!</b><br />
    The calorie burnt will not be accurate for everyone, some people would need to exercise more or less. <br />
    Please use this tool just for fun as this calculator assumes that you are a typical white male.</p>

<!-- Trigger/Open The Modal -->
<button id="myBtn">Click here to see the math</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>
    The method in which we measure the amount of calories burnt is done using "METS"</p>
<p>One “MET” is roughly equivalent to the energy cost of sitting quietly and can be considered 1 kcal/kg/hour. </p>
<p>A 70 kg person would burn 70 calories (cal) if they sat quietly for an hour.</p>
<p>If an activity’s MET value was two, that same person would burn 140 calories in an hour.</p>
<p>Of course the rate at which calories burn differs per person hence this website will not be an accurate representation of the amount of work required</p>
<p>Please use this website as if it is a simple fun tool and not for real meal preperation or diet scheduling </p>
<b>Calories Burnt per Hour = [METS] * [MASS in kg] </b>
  </div>

</div>

<?php

$has_errors = "no";

$calories_error = $met_error = $mass_error = "no-error";
$calories_field = "tag-ok";
$met_field = "tag-ok";
$mass_field = "tag-ok";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $calories = mysqli_real_escape_string($dbconnect, $_POST['calories']);
    $ID = mysqli_real_escape_string($dbconnect, $_POST['METS']);
    $mass = mysqli_real_escape_string($dbconnect, $_POST['mass']);


    if ($calories == "") {
        $has_errors = "yes";
        $calories_field = "form-error";
        $calories_error = "error-text";
    }

    $letters = "/[a-zA-Z]/i";

    if(preg_match($letters, $calories) == 1 ){
        $has_errors = "yes";
        $calories_field = "form-error";
        $calories_error = "error-text";
    }

    if(preg_match($letters, $mass) == 1){
        $has_errors = "yes";
        $mass_field = "form-error";
        $mass_error = "error-text";
    }

    if ($ID == "" or $ID == 0) {
        $has_errors = "yes";
        $met_field = "form-error";
        $met_error = "error-text";
    }

    if ($mass == "") {
        $has_errors = "yes";
        $mass_field = "form-error";
        $mass_error = "error-text";
    }

    if ($has_errors != "yes") {

            
        $met_sql = "SELECT * FROM `MET` JOIN Activity ON (`Activity`.`Activity_ID` = `MET`.`Activity_ID`)  WHERE `ID` = '$ID'";
        $met_query = mysqli_query($dbconnect, $met_sql);
        $met_rs = mysqli_fetch_assoc($met_query);

        $met = $met_rs['METS'];
        $description = $met_rs['Activity'];

        $calories_burnt = $met * $mass;
        $time = $calories / $calories_burnt;
        $time_needed = $time * 60;
        $hours_needed = intval($time_needed/60);
        $minutes_needed = $time_needed -($hours_needed * 60);
        ?>
        <br /> <br />
        <?php
        if($hours_needed == 0){
        
        echo $calories . " cal of calories"; ?> <br /> <br />
        <?php echo $calories_burnt . " cal burnt per hour"; ?> <br /> <br />
        <?php echo "It would take you "?><b><?php echo round($minutes_needed, 0). " minute(s) ";?></b><?php echo " of";?><b><?php echo" $description";?></b><?php echo" to burn off $calories calories"; 

        }
        elseif($minutes_needed == 0){
            echo $calories . " cal of calories"; ?> <br /> <br />
        <?php echo $calories_burnt . " cal burnt per hour"; ?> <br /> <br />
       <?php echo "It would take you "?><b><?php echo round($hours_needed,0) . " hour(s) "; ?></b><?php echo" of";?><b><?php echo " $description";?></b><?php echo " to burn off $calories calories"; 
        }
        else{
        echo $calories . " cal of calories"; ?> <br /> <br />
        <?php echo $calories_burnt . " cal burnt per hour"; ?> <br /> <br />
       <?php echo "It would take you "?><b><?php echo round($hours_needed,0) . " hour(s) ". round($minutes_needed, 0). " minute(s)"; ?></b><?php echo" of";?><b><?php echo " $description";?></b><?php echo " to burn off $calories calories"; 
        }
        ?> <br /> <br />
        <h3> Recalcuate? </h3>
<?php
    }
}
?>
<form autocomplete="off" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?page=calculator"); ?>" enctype="multipart/form-data">

    <b>Activity:</b>
    <br />
    <div class="<?php echo $met_error; ?>">
        Please Select an activity
    </div>
    <select class="add-field" name="METS">
    <option value="0" selected> 
                <?php echo "Select"; ?>
            </option>

        <?php

        $met_sql = "SELECT * FROM `MET` ORDER BY `MET`.`Description` ASC";
        $met_query = mysqli_query($dbconnect, $met_sql);
        $met_rs = mysqli_fetch_assoc($met_query);

        do {
            $ID = $met_rs['ID'];
            $description = $met_rs['Description'];
            $METS = $met_rs['METS'];
        ?>

            <option value="<?php echo $ID; ?>">
                <?php echo $description." ($METS METS)"; ?>
            </option>

        <?php

        } while ($met_rs = mysqli_fetch_assoc($met_query))

        ?>
    </select>

    <br />
    <b>Calories(cal):</b>
    <br />
    <div class="<?php echo $calories_error; ?>">
        Please enter a number (Can't be left blank)
    </div>
    <input class="add-field <?php echo $calories_field ?>" type='text' name='calories' placeholder="Calories(cal)" />
    <br />



    <b>Your Mass(kg):</b>
    <br />
    <div class="<?php echo $mass_error; ?>">
        Please enter a number (Can't be left blank)
    </div>
    <input class="add-field <?php echo $mass_field ?>" type='text' name='mass' placeholder="Mass(kg)" />

    <p>
        <input class="add-field" type="submit" value="Submit" />
    </p>

</form>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>