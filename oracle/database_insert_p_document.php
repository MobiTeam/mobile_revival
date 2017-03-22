<?php
        session_start();

        require('database_connect_PDO.php');
        require_once('../auth/ad_functions.php');

        modifyPost();
        $persons = $_POST['persons'];

        // $persons = '75e4190cf4676e63f278b741aeb3ca91fb669a22';
        // Принимаем параметры
        $fYear = $_POST['p_document_year'];
        $fSection = $_POST['p_type_activity'];
        $fTypeDoc = $_POST['p_document_type'];
        $fNameDoc = $_POST['p_document_fname'];

        // Проверяем, что файл пришел
        if (empty($_FILES)) {
            header('HTTP/1.1 500 Internal Server Error');
            exit;
        }
        // Проверяем размер файла (5 мб)
        if (($_FILES['p_document_file']['error'] === UPLOAD_ERR_INI_SIZE) || ($_FILES['p_document_file']['size'] > 5000000)) {
            header('HTTP/1.1 500 Internal Server Error');
            exit;
        }
        // Проверяем расширение файла
        $availExt = ['jpg', 'jpeg', 'png', 'bmp', 'pdf', 'doc', 'docx', 'xsl', 'xslx'];
        $fileName = $_FILES['p_document_file']['name'];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        if(!in_array($ext,$availExt) ) {
            header('HTTP/1.1 500 Internal Server Error');
            exit;
        }
        // Если файл прошел все проверки, то загружаем файл
        $fileDoc = $_FILES['p_document_file'];

        // Создаём директорию пользователя
        $dir = '../files/portfolio/' . $persons . '/';
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        // Загружаем файл
        $tmpFile = $_FILES["p_document_file"]["tmp_name"];
        $fileName = date('H.i').'_'.translit($fileName);
        move_uploaded_file($tmpFile, "$dir/$fileName");

        $query=$conn->prepare("Insert into P_DOCUMENTS
					(FYEAR,FCPERSON,FCSECTION,FCTYPEDOC, FURLFILE,FNAMEFILE)
					values(:fyear, :fperson, :fsection, :ftypedoc, :urlfile, :namefile)");
		$query->execute(array('fyear' => $fYear,'fperson' => $persons,'fsection' => $fSection,
                            'ftypedoc' => $fTypeDoc,'urlfile' => "/files/portfolio/".$persons."/".$fileName,'namefile' => $fNameDoc));

        @$conn=null;                    
        header('HTTP/1.1 200 OK');
        exit;

        // Функция транслитирации
        function translit($str) {
            $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
            $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
            return str_replace($rus, $lat, $str);
        }
 ?>
