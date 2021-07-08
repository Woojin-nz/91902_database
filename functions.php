<?php 

// function to 'clean' data
function test_input($data) {
	$data = trim($data);	
	$data = htmlspecialchars($data); //  needed for correct special character rendering
	return $data;
}

// entity is subject, country, occupation etc
function autocomplete_list($dbconnect, $item_sql, $entity)
{
// Get entity / topic list from database
$all_items_query = mysqli_query($dbconnect, $item_sql);
$all_items_rs = mysqli_fetch_assoc($all_items_query); 
    
// Make item arrays for autocomplete functionality...
while($row=mysqli_fetch_array($all_items_query))
{
  $item=$row[$entity];
  $items[] = $item;
}

$all_items=json_encode($items);
return $all_items;
    
}


// function to get subject, country & career ID's
function get_ID($dbconnect, $table_name, $column_ID, $column_name, $entity)
{
    
    if($entity=="")
    {
        return 0;
    }
    
    
    // get entity ID if it exists
    $findid_sql = "SELECT * FROM $table_name WHERE $column_name LIKE '$entity'";
    $findid_query = mysqli_query($dbconnect, $findid_sql);
    $findid_rs = mysqli_fetch_assoc($findid_query);
    $findid_count=mysqli_num_rows($findid_query);
    
    // If subject ID does exists, return it...
    if($findid_count > 0) {
        $find_ID = $findid_rs[$column_ID];
        return $find_ID;
    }   // end if (entity existed, ID returned)
    

    else {
        $add_entity_sql = "INSERT INTO $table_name ($column_ID, $column_name) VALUES (NULL, '$entity');";
        $add_entity_query = mysqli_query($dbconnect, $add_entity_sql);
        
    $new_id_sql = "SELECT * FROM $table_name WHERE $column_name LIKE '$entity'";
    $new_id_query = mysqli_query($dbconnect, $new_id_sql);
    $new_id_rs = mysqli_fetch_assoc($new_id_query);
        
    $new_id = $new_id_rs[$column_ID];
    
    return $new_id;
        
    }   // end else (entity added to table and ID returned)
    
} // end get ID function


function get_rs($dbconnect, $sql)
{
    $find_sql = $sql;
    $find_query = mysqli_query($dbconnect, $find_sql);
    $find_rs = mysqli_fetch_assoc($find_query);
    
    return $find_rs;
}

// Function to get menu item 
function get_menu($dbconnect,$menu_sql,$menu_query,$menu_rs)
{
do {
    
    $item = preg_replace('/[^A-Za-z0-9.,?\s\'\-]/','',$menu_rs['Item']);

    // Brand and Category and Serving
    $brand = $menu_rs['Brand'];
    $category = $menu_rs['Category'];
    $serving = $menu_rs['Serving_Size'];

    ?>

<div class="results">
    <p>
        <a href="index.php?page=item&item_ID=<?php echo $menu_rs["Item_ID"]; ?>"> 
        <?php echo $item; ?></a>
        
        <a href="index.php?page=calculatorstats&ID=<?php echo $menu_rs["ID"];?>"> 
            <i class="fa fa-calculator"></i></a>
    </p>

    <!-- Serving size to differentiate by products -->
    <?php echo $serving; ?><br />

    <!-- Brand and Category go here -->
    <?php include("content/showstats.php"); ?>
</div>

<br />

<?php
} // end of 'do'

while($menu_rs = mysqli_fetch_assoc($menu_query));

}; 


// Function to get Activity
function get_activity($dbconnect,$find_sql,$find_query,$find_rs)
{

// Loop through results and display them... 
do {

    $activity = preg_replace('/[^A-Za-z0-9.,?\s\'\-]/','',$find_rs['Description']);

    //MET amount
    $MET = $find_rs['METS'];
    ?>
<div class="results">
    <p>
        <?php echo $activity; ?></a>
    </p>

    <!-- MET Amount -->
    <?php include("content/showactivity.php"); ?>
</div>
<br />
<?php
} // end of display results 'do'
while($find_rs = mysqli_fetch_assoc($find_query));

}

function convertToHoursMins($time, $format = '%02d:%02d') {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}

?>