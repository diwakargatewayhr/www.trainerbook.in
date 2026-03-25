<?php
include("../includes/config.php");
$category_id = $_POST["category_id"];
$result = mysqli_query($CONN, "SELECT * FROM `subcategory` WHERE `category_id` = $category_id");
?>
<option value="">Select Sub Category...</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
    <option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
<?php
}
?>