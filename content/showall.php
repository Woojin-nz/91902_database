<h2> Menu </h2>
<b>Choose your restaurant:</b>
<br />
<form autocomplete="off" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?page=showall"); ?>" enctype="multipart/form-data">

    <select name="food_brand">

        <?php

        $food_sql = "SELECT * FROM `Brand` ORDER BY `Brand` ASC";
        $food_query = mysqli_query($dbconnect, $food_sql);
        $food_rs = mysqli_fetch_assoc($food_query);

        do {
            $brand_ID = $food_rs['Brand_ID'];
            $brand = $food_rs['Brand'];
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
    $brandID = mysqli_real_escape_string($dbconnect, $_POST['food_brand']);
    $sql = "SELECT * FROM `Brand` WHERE `Brand_ID` = '$brandID'";
    $query = mysqli_query($dbconnect, $sql);
    $rs = mysqli_fetch_assoc($query);
    ?>
    <h2> You Chose <?php echo $rs['Brand']; ?></h2>
    <?php
    $find_sql = "SELECT * FROM `Menu` JOIN Item ON (`Item`.`Item_ID` = `Menu`.`Item_ID` ) JOIN Brand ON (`Brand`.`Brand_ID` =`Menu`.`Brand_ID`) JOIN Category ON ( `Category`.`Category_ID` = `Menu`.`Category_ID`) WHERE `Menu`.`Brand_ID` = '$brandID' ORDER BY `Item`.`Item` ASC";
    $find_query = mysqli_query($dbconnect, $find_sql);
    $find_rs = mysqli_fetch_assoc($find_query);

    do {
        
        $item = preg_replace('/[^A-Za-z0-9.,?\s\'\-]/','',$find_rs['Item']);

        ?>
    
    <div class="results">
        <p>
            <a href="index.php?page=item&item_ID=<?php echo $find_rs["Item_ID"]; ?>"> 
            <?php echo $item; ?></a>
            
            <a href="index.php?page=calculatorstats&ID=<?php echo $find_rs["ID"];?>"> 
            <i class="fa fa-calculator"></i></a>

        </p>
    
        <!-- Serving size to differentiate by products -->
        Serving Size: <?php echo $find_rs['Serving_Size']; ?><br />
        Calories: <?php echo $find_rs['Calories']. " cal"; ?><br />
    
        <!-- Brand and Category go here -->
        <p>
    <a href="index.php?page=brand&brand_ID=<?php echo $find_rs["Brand_ID"]; ?>">
        <span class="tag">
            <?php echo $find_rs['Brand']; ?></a></span>
    <a href="index.php?page=category&category_ID=<?php echo $find_rs["Category_ID"]; ?>">
        <span class="tag">
            <?php echo $find_rs['Category']; ?><br />
    </a>
    </span>


    <?php

    if(isset($_SESSION['admin'])){
        
        ?>
    <div class="edit-tools">
    <a href="index.php?page=../admin/edititem&itemID=<?php echo $find_rs['ID']; ?>"
    title="Edit Item"><i class="fa fa-edit fa-2x"></i></a>

    &nbsp;&nbsp;

    <a href="index.php?page=../admin/deleteitem_confirm&itemID=<?php echo $find_rs['ID']; ?>"
    title="Delete Item"><i class="fa fa-trash fa-2x"></i></a>
    </div>




    <?php
    }

    ?>


    </p>
    </div>
    
    <br />
    
    <?php
    } // end of 'do'
    
    while($find_rs = mysqli_fetch_assoc($find_query));
}
?>