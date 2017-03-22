<?php

    session_start();
    require('database_connect_PDO.php');
    require_once('../auth/ad_functions.php');
    modifyPost();
    if(isset($_SESSION['persons'])){
        $persons = $_SESSION['persons'];
    } else {
        $persons = $_POST['persons'];
    }
    // $persons = '75e4190cf4676e63f278b741aeb3ca91fb669a22';

    // Получаем все разделы
    $query=$conn->prepare("Select * from v_p_documents where FCPERSON = :persons");
    $query->execute(array('persons' => $persons));
    $dataAllDocument = $query->fetchAll();

    // Возвращение JSON данных
	print_r(json_encode($dataAllDocument,JSON_UNESCAPED_UNICODE));

    @$conn=null;
?>
