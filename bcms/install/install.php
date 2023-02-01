<?php
set_time_limit();
$zip = new ZipArchive;
$res = $zip->open('bcms.zip');
if ($res === TRUE) {
    echo 'ok';
    $zip->extractTo('./');
    $zip->close();
} else {
    echo 'failed, code:' . $res;
}

mkdir("./templates", 0777);

$zip = new ZipArchive;
$res = $zip->open('templates-1.zip');
if ($res === TRUE) {
    echo 'ok';
    $zip->extractTo('./templates');
    $zip->close();
} else {
    echo 'failed, code:' . $res;
}

$zip = new ZipArchive;
$res = $zip->open('templates-2.zip');
if ($res === TRUE) {
    echo 'ok';
    $zip->extractTo('./templates');
    $zip->close();
} else {
    echo 'failed, code:' . $res;
}


$zip = new ZipArchive;
$res = $zip->open('templates-3.zip');
if ($res === TRUE) {
    echo 'ok';
    $zip->extractTo('./templates');
    $zip->close();
} else {
    echo 'failed, code:' . $res;
}
?>