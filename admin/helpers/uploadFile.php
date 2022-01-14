<?php

function uploadFile($row, $id, $folder, $validationOptions = [])
{
    $allowedTypes = [
        'image' => [
            'image/png' => 'png',
            'image/jpeg' => 'jpg'
        ],
        'favicon' => [
            'image/x-icon' => 'favicon',
            'image/png' => 'favicon',
        ],
        'video' => [
            'video/mp4' => 'video',
        ],
        'pdf' => [
            'application/pdf' => 'pdf',
        ],
        'csv' => [
            'text/csv' => 'csv',
            'application/csv' => 'csv',
            'text/plain' => 'csv'
        ]
    ];

    $file_name = '';

    if (isset($_FILES[$id]) && $_FILES[$id] != '' && $_FILES[$id]['name'] != '') {
        $file_name = time() . $_FILES[$id]['name'];
        $file_tmp = $_FILES[$id]['tmp_name'];

        $file_size = filesize($file_tmp);
        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($file_info, $file_tmp);

        if ($file_size === 0) {
            throw new Exception('The file is empty.');
        }

        if (isset($validationOptions['type']) && !in_array($file_type, array_keys($allowedTypes[$validationOptions['type']]))) {
            throw new Exception('File not allowed.');
        }

        $target_dir = "../admin/uploads/" . $folder . "/";
        $target_file = $target_dir . basename($file_name);
        $moveres = move_uploaded_file($file_tmp, $target_file);
    } else {
        if((isset($row) && $row[$id] == null && !isset($validationOptions['type'])) || $row == null) {
            throw new Exception('There is no file to upload.');
        }
    }


    if (isset($moveres) && $moveres != 0) {
        $url = "admin/uploads/" . $folder . "/" . $file_name;
    } else {
        $url = $row[$id] ?? null;
    }

    return $url;
}
?>