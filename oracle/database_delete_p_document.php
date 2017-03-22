<?php

    session_start();
    require('database_connect_PDO.php');
    require_once('../auth/ad_functions.php');
    modifyPost();

    $persons = $_POST['persons'];
    $fnrecDocument = $_POST['fnrec'];

    $query=$conn->prepare("Delete from p_documents where FCPERSON = :persons and FNREC = :nrec");
    $query->execute(array('persons' => $persons, 'nrec'=> $fnrecDocument));

    header('HTTP/1.1 200 OK');
    print_r(json_encode('deleted',JSON_UNESCAPED_UNICODE));
    @$conn=null;
 ?>
