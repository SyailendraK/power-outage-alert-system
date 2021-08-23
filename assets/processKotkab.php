<?php
require_once('Db.php');
$db = new Db();
$result = $db->query("SELECT * FROM regencies WHERE province_id=" . $_POST['id'] . " ORDER BY regencies.name");

echo '<option selected value="0">Pilih kota/kabupaten</option>';

while ($val = $result->fetch_assoc()) {
    echo '<option value="' . $val['id'] . '">' . $val['name'] . '</option>';
}
