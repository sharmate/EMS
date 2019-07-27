<?php


//explode(system('wmic csproduct get name 3>&1'))
//echo $data;
//print('systeminfo | findstr')
//system('systeminfo | findstr /C: "Total Physical Memory"')
print_r(getSystemMemoryInfo());
?>