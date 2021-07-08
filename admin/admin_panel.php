<?PHP
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST['food_brand']){
        $brandID = mysqli_real_escape_string($dbconnect, $_POST['food_brand']);
     header("Location:index.php?page=../admin/deletebrand_confirm&brandID=$brandID");
    }
    else{
        $activityID = mysqli_real_escape_string($dbconnect, $_POST['activity']);
        header("Location:index.php?page=../admin/deleteactivitybrand_confirm&activityID=$activityID");
    }


}

?>

<h1>Admin Panel</h1>

<h2>Food & Activities</h2>
<p>
    To <a href="index.php?page=../admin/newfood"> add a food</a> or <a href="index.php?page=../admin/newactivity"> add an activity</a>
    use the preceding link or the '+' symbol at the top right of the screen.
</p>
<p>
    Entries can be editied / deleted by searching for an entry and then clicking
    on the 'edit' / 'delete' icons at the bottom right of each entry. 
    If you don't see the icons to edit / delete entries, it means that you are not logged in.
</p>

<hr />

<h2> Delete Brand</h2>
<form autocomplete="off" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?page=../admin/admin_panel");?>"
enctype="multipart/form-data">


<select name="food_brand">
            
            <?php
            
        $food_sql = "SELECT * FROM `Brand` ORDER BY `Brand` ASC";
        $food_query = mysqli_query($dbconnect,$food_sql);
        $food_rs = mysqli_fetch_assoc($food_query);

            do {
                $brand_ID =$food_rs['Brand_ID'];
                $brand = $food_rs['Brand'];
            ?>
            
            <option value="<?php echo $brand_ID;?>">
                <?php echo $brand; ?>
            </option>
            
            <?php

            }
            while($food_rs=mysqli_fetch_assoc($food_query))

            ?>
        </select>


        <p>
        <input type="submit" value="Submit" />
    </p>

</form>

<hr />

<h2> Delete Activity Group </h2>
<form autocomplete="off" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?page=../admin/admin_panel");?>"
enctype="multipart/form-data">


<select name="activity">
            
            <?php
            
        $food_sql = "SELECT * FROM `Activity` ORDER BY `Activity` ASC";
        $food_query = mysqli_query($dbconnect,$food_sql);
        $food_rs = mysqli_fetch_assoc($food_query);

            do {
                $activity_ID =$food_rs['Activity_ID'];
                $activity = $food_rs['Activity'];
            ?>
            
            <option value="<?php echo $activity_ID;?>">
                <?php echo $activity; ?>
            </option>
            
            <?php

            }
            while($food_rs=mysqli_fetch_assoc($food_query))

            ?>
        </select>


        <p>
        <input type="submit" value="Submit" />
    </p>

</form>