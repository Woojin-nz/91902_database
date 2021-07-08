<?php


if (isset($_SESSION['admin'])){
    $ID = $_REQUEST['itemID'];

    $find_sql = "SELECT * FROM `Menu`
    JOIN Item ON (`Item`.`Item_ID` = `Menu`.`Item_ID` ) JOIN Brand ON (`Brand`.`Brand_ID` =`Menu`.`Brand_ID`) JOIN Category ON ( `Category`.`Category_ID` = `Menu`.`Category_ID`)
    WHERE `Menu`.`ID` = $ID";

    $find_query = mysqli_query($dbconnect, $find_sql);
    $find_rs = mysqli_fetch_assoc($find_query);

    $item_ID = $find_rs['Item_ID'];
    $item_rs = get_rs($dbconnect, "SELECT * FROM `Item` WHERE Item_ID = $item_ID");
    $item = $item_rs['Item'];

    $brand_ID = $find_rs['Brand_ID'];
    $brand_rs = get_rs($dbconnect, "SELECT * FROM `Brand` WHERE Brand_ID = $brand_ID");
    $current_brand = $brand_rs['Brand'];

    $category_ID = $find_rs['Category_ID'];
    $category_rs = get_rs($dbconnect, "SELECT * FROM `Category` WHERE Category_ID = $category_ID");
    $category = $category_rs['Category'];

    $serving = $find_rs['Serving_Size'];
    $calories =$find_rs['Calories'];
    $fat = $find_rs['Fat'];
    $cholesterol =$find_rs['Cholesterol'];
    $sodium = $find_rs['Sodium'];
    $carbs=$find_rs['Carbohydrates'];  
    $sugars=$find_rs['Sugars'];
    $protein=$find_rs['Protein'];
    $caffeine=$find_rs['Caffeine'];
    
    $all_categories = "SELECT * FROM `Category` ORDER BY `Category` ";
    $all_categories_auto = autocomplete_list($dbconnect, $all_categories, 'Category');

    $all_items = "SELECT * FROM `Item` ORDER BY `Item`";
    $all_items_auto = autocomplete_list($dbconnect,$all_items,'Item');

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
   
    $brand_ID = mysqli_real_escape_string($dbconnect, $_POST['food_brand']);
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
        $item_ID = get_ID($dbconnect, 'Item', 'Item_ID', 'Item',$item);
       
        $editfood_sql = "UPDATE `Menu` SET `Brand_ID` = '$brand_ID', `Category_ID` = '$category_ID', `Item_ID` = '$item_ID', `Serving_Size` = '$serving', `Calories` = '$calories', `Fat` = '$fat', `Cholesterol` = '$cholesterol', `Sodium` = '$sodium', `Carbohydrates` = '$carbs', `Sugars` = '$sugars', `Protein` = '$protein', `Caffeine` = '$caffeine' WHERE `Menu`.`ID` = $ID;";
        $editfood_query = mysqli_query($dbconnect, $editfood_sql);

        $get_food_sql = "SELECT * from `Menu` WHERE `Item_ID` = '$item_ID'";
        $get_food_query = mysqli_query($dbconnect,$get_food_sql);
        $get_food_rs = mysqli_fetch_assoc($get_food_query);

        $food_ID = $get_food_rs['Item_ID'];
        $_SESSION['Food_success'] = $food_ID;
        header("Location:index.php?page=editfood_success");
    }

    }
    
}




else {

    $login_error =  'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");
}


?>


<h1> Edit entry </h1>

<form autocomplete="off" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?page=../admin/edititem&itemID=$ID");?>"
enctype="multipart/form-data">

<p><i>If you need to change this item and the brand you need is NOT in the list below. Please <a href="index.php?page=../admin/newfood" target="_blank">add the brand</a>. Then come back and reload this page to refresh the list.</i></p>

<b>Brand:</b> <br />

        <select name="food_brand">
            <option value="<?php echo $brand_ID; ?>" selected> 
                <?php echo $current_brand; ?>
            </option>
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
    <br /><br />
    <b>Item:</b>
    <br />
    <div class="<?php echo $item_error; ?>">
        This field cannot be left blank
    </div>
    <div>
    <input class="add-field <?php echo $item_field?>"  type ='text' id="item" name="item" rows="2" value=<?php echo $item; ?>>
    </div>
    <br />

    <b>Category:</b> &nbsp;
    <div class="<?php echo $category_error ?>">
        Please enter a category
    </div>
    <div class="autocomplete">
    <input class="add-field <?php echo $category_field; ?>" id="category"
    type="text" name="category" placeholder="Category" value=<?php echo $category; ?>>
    </div>
    <br /> <br /> 

    <b>Serving Size:</b> &nbsp;
    <div class="<?php echo $serving_error; ?>">
        Please enter a serving size (Must be a number)
    </div>
    <div>
    <input class="add-field <?php echo $serving_field; ?>" type='text' name='serving' placeholder="Serving size" value=<?php echo $serving; ?>>
    </div>
    <br />
    
    <b>Calories(cal):</b> &nbsp;

    <div class="<?php echo $calories_error; ?>">
    Please enter the amount of calories (Must be a number)
    </div>
    <div>
    <input class="add-field <?php echo $calories_field; ?>" type="text"name="calories" placeholder="Calories (cal)" value=<?php echo $calories; ?>></div>

    <br />
    <b> Fat(g):</b> &nbsp;
    <div class="<?php echo $fat_error; ?>">
    Please enter a number or leave blank if unknown
    </div>
    <div>
    <input class="add-field <?php echo $fat_field; ?>" id="fat" type="text" name="fat" placeholder="Fat (g)" value =<?php echo $fat; ?>></div>
    <br />
    <b>Cholesterol(g):</b> &nbsp;

    <div class="<?php echo $cholesterol_error; ?>">
    Please enter a number or leave blank if unknown
    </div>
    <div>
    <input class="add-field <?php echo $cholesterol_field; ?>" id="cholesterol" type="text" name="cholesterol" placeholder="Cholesterol (g)" value=<?php echo $cholesterol; ?>>
    </div>

    <br />
    <b>Sodium(mg):</b> &nbsp;
        
    <div class="<?php echo $sodium_error; ?>">
    Please enter a number or leave blank if unknown
    </div>
    <div>
    <input class="add-field <?php echo $sodium_field; ?>" id="sodium" type="text" name="sodium" placeholder="Sodium (mg)" value=<?php echo $sodium; ?>></div>

    <br />
    <b>Carbohydrates(g):</b> &nbsp;
    <div class="<?php echo $carbs_error; ?>">
    Please enter a number or leave blank if unknown
    </div>
    <div>
    <input class="add-field <?php echo $carbs_field; ?>" id="carbs" type="text" name="carbs" placeholder="Carbohydrates (g)" value=<?php echo $carbs; ?>></div>

    <br />
    <b>Sugars(g):</b> &nbsp;
    <div class="<?php echo $sugars_error; ?>">
    Please enter a number or leave blank if unknown
    </div>
    <div>
    <input class="add-field <?php echo $sugars_field; ?>" id="sugars" type="text" name="sugars" placeholder="Sugar (g)" value = <?php echo $sugars; ?>></div>

    <br />
    <b>Protein(g):</b>&nbsp;
    <div class="<?php echo $protein_error; ?>">
    Please enter a number or leave blank if unknown
    </div>
    <div>
    <input class="add-field <?php echo $protein_field; ?>" id="protein" type="text" name="protein" placeholder="Protein (g)" value = <?php echo $protein; ?>></div>

    <br />
    <b>Caffeine(mg):</b>&nbsp;
    <div class="<?php echo $caffeine_error; ?>">
    Please enter a number or leave blank if unknown
    </div>
    <div>
    <input class="add-field <?php echo $caffeine_field; ?>" id="caffeine" type="text" name="caffeine" placeholder="Caffeine (mg)" value = <?php echo $caffeine; ?>></div>


    <br /> 


    <p>
        <input class="add-field" type="submit" value="Submit" />
    </p>




</form>
<?php
?>

<script>

<?php include("autocomplete.php"); ?>

var category = <?php print("$all_categories_auto"); ?>;
autocomplete(document.getElementById("category"), category);

</script>