<?php

$directory = 'uploads/business'; // Change this to the directory you want to list files from
$files = array();
header('Content-Type: application/json');
if (is_dir($directory)) {
    $files = array_diff(scandir($directory), array('..', '.'));
    
    $fileList = array();
    foreach ($files as $file) {
        $filePath = $directory . '/' . $file;
        if (is_file($filePath)) {
            $fileInfo = array(
                'filename' => $file,
                'size' => filesize($filePath),
                'modified' => filemtime($filePath)
            );
            $fileList[] = $fileInfo;
        }
    }
    
    echo json_encode($fileList, JSON_PRETTY_PRINT);
} else {
    echo json_encode(array('error' => 'Invalid directory'), JSON_PRETTY_PRINT);
}


echo $jsonResponse;
