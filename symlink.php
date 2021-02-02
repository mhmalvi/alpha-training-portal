<?php
    
    $targetFolder = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/public/storage';
    
    $targetFolder2 = $_SERVER['DOCUMENT_ROOT'].'/public/blogImages';
    $linkFolder2 = $_SERVER['DOCUMENT_ROOT'].'/blogImages';
    
    symlink($targetFolder, $linkFolder);
    symlink($targetFolder2, $linkFolder2);
    
    echo "success";
    
?>