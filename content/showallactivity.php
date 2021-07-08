<h2> Activity </h2>
<b>Choose your Activity Group:</b>
<br />
<form autocomplete="off" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?page=showallactivity"); ?>" enctype="multipart/form-data">

    <select name="activity">

        <?php

        $food_sql = "SELECT * FROM `Activity` ORDER BY `Activity_ID` ASC";
        $food_query = mysqli_query($dbconnect, $food_sql);
        $food_rs = mysqli_fetch_assoc($food_query);

        do {
            $brand_ID = $food_rs['Activity_ID'];
            $brand = $food_rs['Activity'];
        ?>

            <option value="<?php echo $brand_ID; ?>">
                <?php echo $brand; ?>
            </option>

        <?php

        } while ($food_rs = mysqli_fetch_assoc($food_query))

        ?>
    </select>


    <p>
        <input type="submit" value="Submit" />
    </p>

</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brandID = mysqli_real_escape_string($dbconnect, $_POST['activity']);

    $sql = "SELECT * FROM `Activity` WHERE `Activity_ID` = '$brandID'";
    $query = mysqli_query($dbconnect, $sql);
    $rs = mysqli_fetch_assoc($query);
?>
    <h2> You Chose <?php echo $rs['Activity']; ?></h2>
    <?php
    $find_sql = "SELECT * FROM `MET` WHERE `Activity_ID` = '$brandID' ORDER BY `MET`.`Description` ASC";
    $find_query = mysqli_query($dbconnect, $find_sql);
    $find_rs = mysqli_fetch_assoc($find_query);

    if (strlen($find_rs > 0)) {
        do {
            $description = $find_rs['Description'];
            $METS = $find_rs['METS'];
    ?>
            <div class="results">
                <p>
                    <?php echo $description; ?></a>
                </p>

                <!-- Brand and Category go here -->
                <p>
                    <span class="tag">
                        <?php echo $METS . " METS"; ?><br />
                        </a></span>

                    <?php

                    if (isset($_SESSION['admin'])) {

                    ?>
                <div class="edit-tools">
                    <a href="index.php?page=../admin/editactivity&itemID=<?php echo $find_rs['ID']; ?>" title="Edit Item"><i class="fa fa-edit fa-2x"></i></a>

                    &nbsp;&nbsp;

                    <a href="index.php?page=../admin/deleteactivity_confirm&itemID=<?php echo $find_rs['ID']; ?>" title="Delete Item"><i class="fa fa-trash fa-2x"></i></a>
                </div>
            <?php
                    }

            ?>


            </p>
            </div>

            <br />

    <?php
        } // end of 'do'

        while ($find_rs = mysqli_fetch_assoc($find_query));
    }
} 
 