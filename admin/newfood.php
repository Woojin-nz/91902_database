<?php
if (isset($_SESSION['admin'])){

    $food_sql = "SELECT * FROM `Brand` ORDER BY `Brand` ASC";
    $food_query = mysqli_query($dbconnect,$food_sql);
    $food_rs = mysqli_fetch_assoc($food_query);

    $brand = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $brand_ID = mysqli_real_escape_string($dbconnect,$_POST['food_brand']);
        $_SESSION['Add_Food'] = $brand_ID;
        header("Location: index.php?page=../admin/add_food");
    }

}

else {

    $login_error =  'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");
}


?>

<h1> Add a food </h1>
<p><i>
    To add a new food item, first select the brand and then press the 'next' button. <br />
    If your brand is not listed please choose the 'New Brand' option.
</i></p>

<form method="post" enctype="mutliform/form-data" 
action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?page=../admin/newfood");?>">

    <div>
        <b>Brand:</b> &nbsp;
    
        <select name="food_brand">
            <option value="unknown" selected> New Brand </option>

            <?php
            do {

                $brand = $food_rs['Brand'];
            ?>
            
            <option value="<?php echo $food_rs['Brand_ID'];?>">
                <?php echo $brand; ?>
            </option>

            <?php

            }
            while($food_rs=mysqli_fetch_assoc($food_query))

            ?>


        </select>

        &nbsp;
        <input class="short" type="submit" name="brand" value="Next" />
    
    </div>


</form>

&nbsp;