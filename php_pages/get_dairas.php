<?php
require_once "../php_pages/Location.php";  

if (isset($_POST['wilaya_id'])) {
    $wilaya_id = $_POST['wilaya_id'];
    $location = new Location();
    $dairas = $location->getDairasByWilaya($wilaya_id); 

    if ($dairas) {
        foreach ($dairas as $daira) {
            echo "<option value='{$daira['id']}'>{$daira['name_ar']} - {$daira['name_en']}</option>";
        }
    } else {
        echo "<option value=''>no daira</option>";
    }
}
?>
