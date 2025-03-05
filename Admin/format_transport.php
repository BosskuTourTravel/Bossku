<?php
$path = "http://www.2canholiday.com/Admin/excel/";
$filename = "format_input_transport.xlsx";

header("Content-Type:image/gif");
header("Content-Disposition: attachment; filename=".$filename);
header("Cache-control: private");
header('X-Sendfile: '.$path);
readfile($path);
exit;
?>
