<?php
require_once('Db.php');
$db = new Db();
$id = $_POST['id'];
$result = $db->query("SELECT * FROM districts WHERE regency_id=" . $id . " ORDER BY districts.name");

echo '<option selected value="0">Pilih kecamatan</option>';

while ($val = $result->fetch_assoc()) {
    echo '<option value="' . $val['id'] . '">' . $val['name'] . '</option>';
}
