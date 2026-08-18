<?php
echo "PAGE LOADED <br>";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    echo "FORM SUBMITTED <br>";
    var_dump($_POST);
}
?>

<form method="POST">
    <input type="text" name="name">
    <input type="submit" value="Submit">
</form>