<?php 
	
	require('../oracle/database_connect_PDO.php');

	$stmt=$conn->prepare("SELECT * FROM P_STUDENTS");
	$stmt->execute();
	$result = $stmt->fetchAll();
	$hash = [];

	for ($i = 0; $i < count($result); $i++) {
		$hash[$result[$i]['SH1PERSON']] = $result[$i]['FCPERSON'];
	}
	
	$dir = opendir("../files/portfolio");
	$file_dir = dirname(__FILE__);

	while (($f = readdir($dir)) !== false) {
		$path_to_dir = '../files/portfolio/' . $f;

		if (!is_dir($f) && !is_file($path_to_dir)) {
			copy_directory($path_to_dir, $file_dir . '/files/' . $hash[$f]);
		}
	}
	
	closedir($dir);

	function copy_directory($src, $dst) {
	    $dir = opendir($src);
	    @mkdir($dst);
	    while(false !== ( $file = readdir($dir)) ) {
	        if (( $file != '.' ) && ( $file != '..' )) {
	            if ( is_dir($src . '/' . $file) ) {
	                recurse_copy($src . '/' . $file,$dst . '/' . $file);
	            }
	            else {
	                copy($src . '/' . $file,$dst . '/' . $file);
	            }
	        }
	    }
	    closedir($dir);
	}
?>