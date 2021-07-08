<?php


if (isset($_SESSION['admin'])){
    $brand_ID = $_SESSION['Add_Food'];

    if($brand_ID =="unknown"){
        $all_brand_sql = "SELECT * FROM `Brand` ORDER BY `Brand`ASC";
        
        $brand = "";

        $brand_ID = 0;

        $brand_error = "no-error";
        $brand_field = "form-ok";
    }

    $all_categories = "SELECT * FROM `Category` ORDER BY `Category` ";
    $all_categories_auto = autocomplete_list($dbconnect, $all_categories, 'Category');

    $all_items = "SELECT * FROM `Item` ORDER BY `Item`";
    $all_items_auto = autocomplete_list($dbconnect,$all_items,'Item');


    $item = "Please enter the food name";
    $category = "";
    $serving="";
    $calories ="";
    $fat = "";
    $cholesterol ="";
    $sodium = "";
    $carbs="";  
    $sugars="";
    $protein="";
    $caffeine="";

    $fat = $cholesterol = $sodium = $carbs = $sugars = $protein = $caffeine = 0;

    $has_errors = "no";

    $item_error = $category_error = $serving_error = $calories_error = $fat_error = $cholesterol_error = $sodium_error = $carbs_error = $sugars_error = $protein_error = $caffeine_error = "no-error";
    $item_field = "form-ok";
    $category_field = "tag-ok";
    $serving_field = "tag-ok";
    $calories_field = "tag-ok";
    $fat_field = "tag-ok";
    $cholesterol_field = "tag-ok";
    $sodium_field = "tag-ok";
    $carbs_field = "tag-ok";
    $sugars_field = "tag-ok";
    $protein_field = "tag-ok";
    $caffeine_field = "tag-ok";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($brand_ID == "unknown"){
        $brand = mysqli_real_escape_string($dbconnect,$_POST['brand']);

        if($brand == ""){
            $has_errors ="yes";
            $brand_error="error-text";
            $brand_field="form-error";
        }

        if($has_errors != "yes"){
            $addbrand_sql = "INSERT INTO `Brand` (`Brand_ID`, `Brand`) VALUES (NULL, '$brand');";
            $addbrand_query = mysqli_query($dbconnect,$addbrand_sql);
            
            $get_brand_sql = "SELECT * from `Brand` WHERE `Brand` = '$brand'";
            $get_brand_query = mysqli_query($dbconnect,$get_brand_sql);
            $get_brand_rs = mysqli_fetch_assoc($get_brand_query);
            
            $newbrand_ID = $get_brand_rs['Brand_ID'];
            $_SESSION['Brand_success'] = $newbrand_ID;
            header("Location:index.php?page=brand_success");
        }   
    }
    else{
        $item = mysqli_real_escape_string($dbconnect,$_POST['item']);
        $category = mysqli_real_escape_string($dbconnect, $_POST['category']);
        $serving = mysqli_real_escape_string($dbconnect,$_POST['serving']);
        $calories = mysqli_real_escape_string($dbconnect,$_POST['calories']);
        $fat = mysqli_real_escape_string($dbconnect, $_POST['fat']);
        $cholesterol = mysqli_real_escape_string($dbconnect, $_POST['cholesterol']);
        $sodium = mysqli_real_escape_string($dbconnect, $_POST['sodium']);
        $carbs = mysqli_real_escape_string($dbconnect, $_POST['carbs']);
        $sugars = mysqli_real_escape_string($dbconnect, $_POST['sugars']);
        $protein = mysqli_real_escape_string($dbconnect, $_POST['protein']);
        $caffeine = mysqli_real_escape_string($dbconnect, $_POST['caffeine']);


        if($item == "" or $item == "Please enter the food name"){
            $has_errors = "yes";
            $item_error = "error-text";
            $item_field = "form-error";
        }

        if($category ==""){
            $has_errors = "yes";
            $category_error = "error-text";
            $category_field = "form-error";
        }

        if($serving == ""){
            $has_errors="yes";
            $serving_error ="error-text";
            $serving_field = "form-error";
        }

        $letters = "/[a-zA-Z]/i";

        if(preg_match($letters, $serving) == 1 ){
            $has_errors = "yes";
            $serving_field = "form-error";
            $serving_error = "error-text";
        }

        if($calories ==""){
            $has_errors = "yes";
            $calories_error="error-text";
            $calories_field="form-error";
        }

        if(preg_match($letters, $calories) == 1){
            $has_errors = "yes";
            $calories_error = "error-text";
            $calories_field = "form-error";
        }
        if($fat == ""){
            $fat = 0;
        }

        if(preg_match($letters, $fat) == 1){
            $has_errors = "yes";
            $fat_error = "error-text";
            $fat_field = "form-error";
        }

        if($cholesterol == ""){
            $cholesterol = 0;
        }

        if(preg_match($letters, $cholesterol) == 1){
            $has_errors = "yes";
            $cholesterol_error = "error-text";
            $cholesterol_field = "form-error";
        }

        if($sodium == ""){
            $sodium = 0;
        }

        if(preg_match($letters, $sodium) == 1){
            $has_errors = "yes";
            $sodium_error = "error-text";
            $sodium_field = "form-error";
        }

        if($carbs == ""){
            $carbs = 0;
        }

        if(preg_match($letters, $carbs) == 1){
            $has_errors = "yes";
            $carbs_error = "error-text";
            $carbs_field = "form-error";
        }

        if($sugars == ""){
            $sugars = 0;
        }

        if(preg_match($letters, $sugars) == 1){
            $has_errors = "yes";
            $sugars_error = "error-text";
            $sugars_field = "form-error";
        }

        if($protein == ""){
            $protein = 0;
        }

        if(preg_match($letters, $protein) == 1){
            $has_errors = "yes";
            $protein_error = "error-text";
            $protein_field = "form-error";
        }

        if($caffeine == ""){
            $caffeine = 0;
        }

        if(preg_match($letters, $caffeine) == 1){
            $has_errors = "yes";
            $caffeine_error = "error-text";
            $caffeine_field = "form-error";
        }


        if($has_errors != "yes"){
            $category_ID = get_ID($dbconnect,'Category','Category_ID','Category',$category);
            $item_ID = get_ID($dbconnect,'Item','Item_ID','Item',$item);
            
            $addfood_sql = "INSERT INTO `Menu` 
            (`ID`, `Brand_ID`, `Category_ID`, `Item_ID`, `Serving_Size`, `Calories`, `Fat`, `Cholesterol`, `Sodium`, `Carbohydrates`, `Sugars`, `Protein`, `Caffeine`) 
            VALUES (NULL, '$brand_ID', '$category_ID', $item_ID, $serving, $calories, $fat, $cholesterol, $sodium, $carbs, $sugars, $protein, $caffeine);";
            $addfood_query = mysqli_query($dbconnect, $addfood_sql);

            $get_food_sql = "SELECT * from `Menu` WHERE `Item_ID` = '$item_ID'";
            $get_food_query = mysqli_query($dbconnect,$get_food_sql);
            $get_food_rs = mysqli_fetch_assoc($get_food_query);

            $food_ID = $get_food_rs['Item_ID'];
            $_SESSION['Food_success'] = $food_ID;
            header("Location:index.php?page=food_success");
        }

    }
    
}
}



else {

    $login_error =  'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");
}


?>


<h1> Add a food </h1>

<form autocomplete="off" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?page=../admin/add_food");?>"
enctype="multipart/form-data">

    <?php

    if($brand_ID == "unknown") {

        ?>
        <div class="<?php echo $brand_error; ?>">
            You must enter a Brand name
        </div>
        <input class="add-field <?php echo $brand_field; ?>" type="text" name="brand" value="<?php echo $brand; ?>" placeholder="Brand name"/>
        <br /> <br />
        
        <p>
            <input class="add-field" type="submit" value="Submit" />
        </p>

        <?php
    }
    else{
    ?>

    <div class="<?php echo $item_error; ?>">
        This field cannot be left blank
    </div>
    <b>Food:</b>
    <br />
    <input class="add-field <?php echo $item_field?>"  name='item' rows="2" placeholder="<?php echo $item; ?>"> 
    <br /> <br />  
    <b>Category:</b>
    <br />
    <div class="<?php echo $category_error ?>">
        Please enter a category
    </div>

    <div class="autocomplete">
    <input class="add-field <?php echo $category_field; ?>" id="category"
    type="text" name="category" placeholder="Category">
    </div>
    <br /><br />
    <b>Serving Size:</b>
    <br />
    <div class="<?php echo $serving_error; ?>">
        Please enter a serving size (Must be a number)
    </div>
    
    <input class="add-field <?php echo $serving_field; ?>" type='text' name='serving' placeholder="Serving size"/>

    <br /><br />
    <b>Calories(cal):</b>
    <br />
    <div class="<?php echo $calories_error; ?>">
    Please enter the amount of calories (Must be a number)
    </div>

    <input class="add-field <?php echo $calories_field; ?>" type="text"name="calories" placeholder="Calories (cal)" />

    <br /> <br />
    <b>Fat(g):</b>
    <br />
    <div class="<?php echo $fat_error; ?>">
    Please enter a number or leave blank if unknown
    </div>
    <input class="add-field <?php echo $fat_field; ?>" id="fat" type="text" name="fat" placeholder="Fat (g)">

    <br /> <br />
    <b>Cholesterol(g):</b>
    <br />
    <div class="<?php echo $cholesterol_error; ?>">
    Please enter a number or leave blank if unknown
    </div>
    <input class="add-field <?php echo $cholesterol_field; ?>" id="cholesterol" type="text" name="cholesterol" placeholder="Cholesterol (g)">

    <br /> <br />
    <b>Sodium(mg):</b>
    <br />
    <div class="<?php echo $sodium_error; ?>">
    Please enter a number or leave blank if unknown
    </div>
    <input class="add-field <?php echo $sodium_field; ?>" id="sodium" type="text" name="sodium" placeholder="Sodium (mg)">

    <br /> <br />
    <b>Carbohydrates(g):</b>
    <br />
    <div class="<?php echo $carbs_error; ?>">
    Please enter a number or leave blank if unknown
    </div>
    <input class="add-field <?php echo $carbs_field; ?>" id="carbs" type="text" name="carbs" placeholder="Carbohydrates (g)">

    <br /> <br />
    <b>Sugar(g):</b>
    <br />
    <div class="<?php echo $sugars_error; ?>">
    Please enter a number or leave blank if unknown
    </div>
    <input class="add-field <?php echo $sugars_field; ?>" id="sugars" type="text" name="sugars" placeholder="Sugar (g)">

    <br /> <br />
    <b>Protein(g):</b>
    <br />
    <div class="<?php echo $protein_error; ?>">
    Please enter a number or leave blank if unknown
    </div>
    <input class="add-field <?php echo $protein_field; ?>" id="protein" type="text" name="protein" placeholder="Protein (g)">

    <br /> <br />
    <b>Caffeine(mg):</b>
    <br />
    <div class="<?php echo $caffeine_error; ?>">
    Please enter a number or leave blank if unknown
    </div>
    <input class="add-field <?php echo $caffeine_field; ?>" id="caffeine" type="text" name="caffeine" placeholder="Caffeine (mg)">

    <br /> <br />


    <p>
        <input class="add-field" type="submit" value="Submit" />
    </p>




</form>
<?php
};
?>

<script>

<?php include("autocomplete.php"); ?>

var category = <?php print("$all_categories_auto"); ?>;
autocomplete(document.getElementById("category"), category);

</script>