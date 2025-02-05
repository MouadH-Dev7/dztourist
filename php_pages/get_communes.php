<?php
if (isset($_POST['daira_id']) && !empty($_POST['daira_id'])) {
    require_once "../php_pages/Location.php";
    $location = new Location();
    $communes = $location->getCommunesByDaira($_POST['daira_id']);

    if ($communes) {
        echo "<option value=''>اختر بلدية</option>";
        foreach ($communes as $commune) {
            echo "<option value='{$commune['id']}'>{$commune['name_ar']} - {$commune['name_en']}</option>";
        }
    } else {
        echo "<option value=''>no</option>";
    }
} else {
    echo "<option value=''>no</option>";
}
?>
