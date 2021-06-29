<?php
// logs erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    include './gDriveApiClient/googleDriveClient.php';
    
    // //! Uploading file to google drive and getting file id and file share link
    // $fileToUpload["podcast_mp3_file"] =  file_get_contents("./test_file_for_uploading.mp3");
    // // file_get_contents("./test_file_for_uploading.mp3");
    // $DriveApi = new DriveApi($client);
    // // TODO make $Driveapi->uplaod_fileC return file id and file share link
    // $mimeType = 'audio/mpeg';
    // $returned_file = $DriveApi->upload_file($fileToUpload["file_name"], $parent_folder_id = "15UQ9dqIqjR5jqmzsT-ReJPisQncJQUvx", $fileToUpload["podcast_mp3_file"], $mimeType);
   
    // $fileToUpload["podcastFileURL"] = $DriveApi->get_file_share_link($returned_file->id);; 
    
    // print_r("File share link: ". $fileToUpload["podcastFileURL"] ."\n");
    // print_r("uploaded file id: " . $returned_file->id);

    

?>