<?php
require_once('Db.php');
$db = new Db();
$id = $_POST['id'];
$result = $db->query("SELECT * FROM villages WHERE district_id=" . $id . " ORDER BY villages.name");

echo '<option selected value="0">Pilih desa</option>';

while ($val = $result->fetch_assoc()) {
    echo '<option value="' . $val['id'] . '">' . $val['name'] . '</option>';
}
