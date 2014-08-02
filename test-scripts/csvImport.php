<?php
	$file = fopen("EGA_CSV_Stripped.csv","r");
	while(($array=fgetcsv($file))!== FALSE){
		print_r($array[0]);
		print_r($array[1]);
		echo "<br><br>";
	}
	fclose($file);
?>