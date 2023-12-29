<?php
$myfile = fopen("counter.txt", "w") or die("Unable to open file!");
$txt = "0";
fwrite($myfile, $txt);
fclose($myfile);
?>