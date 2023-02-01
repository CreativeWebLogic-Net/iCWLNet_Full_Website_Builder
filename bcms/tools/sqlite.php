<?php

$db = new SQLite3('../db/bubblelite.db');

$version = $db->querySingle('SELECT SQLITE_VERSION()');

echo $version . "\n";

$res = $db->query("SELECT * FROM administrators");

while ($row = $res->fetchArray()) {
    //echo "{$row['id']} {$row['name']} {$row['email']} \n";
    print_r($row);
}
?>