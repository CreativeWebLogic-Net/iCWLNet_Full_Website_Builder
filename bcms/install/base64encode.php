<?

// get contents of a file into a string
$filename = "./favicon.ico";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
echo base64_encode($contents);
fclose($handle);
?>