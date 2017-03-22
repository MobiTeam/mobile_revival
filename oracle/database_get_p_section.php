<?php

	require('database_connect_PDO.php');

    $data = [];

    // Получаем все разделы
    $query=$conn->query("Select FNREC, FNAME from p_section");
    $dataSection = $query->fetchAll();
    // Получаем все типы документов
    $query=$conn->query("Select FNREC, FNAME from p_type_doc");
    $dataTypeDoc = $query->fetchAll();
    // формируем массив
    $data = ['section'=>$dataSection, 'type_doc' => $dataTypeDoc];
    // Возвращение JSON данных
	print_r(json_encode($data,JSON_UNESCAPED_UNICODE));

    @$conn=null;
 ?>
