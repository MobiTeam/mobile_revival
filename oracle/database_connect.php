<?php
    //Подключение через oci (UPDATE 16.05.2016)

    $c=@oci_connect("MOBILE", "kisupass1993", "(DESCRIPTION =
                                                  (ADDRESS_LIST =
                                                    (ADDRESS = (PROTOCOL = TCP)
                                                               (HOST = oradb.ugrasu.ru)
                                                               (PORT = 1521)
                                                    )
                                                  )
                                                  (CONNECT_DATA =
                                                    (SERVICE_NAME = gala)
                                                  )
                                                )", "AL32UTF8");
    if(!$c){
        echo('{"FIO":"undefined","serverRequest":"База данных сервера недоступна.","is_student":"0","groups":"", "errFlag":"0"}');
        die();
    }

?>
