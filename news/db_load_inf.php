﻿<?php
   
   
  
	$s=OCIParse($c, "insert into INFORM (NAME_NEWS,DATE_NEWS,TEXT_NEWS,TEXT_NEWS2,TEXT_NEWS3,TEXT_NEWS4,IMG_NEWS,PREV_NEWS,SOURCE_NEWS,DESCRIPTION)
	values('".$name_news."','".$date_news."','".$text_news1."','".$text_news2."','".$text_news3."','".$text_news4."','','','".$source_news."','".$descr."')");
	
	OCIExecute($s, OCI_DEFAULT); 
	OCICommit($c); 

	

?>