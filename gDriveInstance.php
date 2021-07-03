<?php
include './gDriveApiClient/googleDriveClient.php'; // Importing DriveApi
include './omekaClientAPI.php';
// Error logging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Defining google drive parent folder ids.
define("FOLDERCHAPELMESSAGES", "15UQ9dqIqjR5jqmzsT-ReJPisQncJQUvx");
define("FOLDERTREN", "15UQ9dqIqjR5jqmzsT-ReJPisQncJQUvx");
define("FOLDERHYMNAL", "15UQ9dqIqjR5jqmzsT-ReJPisQncJQUvx");


$fileName = $_POST["fileName"];
$mimeType = $_POST["mimeType"];
$folder = $_POST["folderSelect"];
$file = $_FILES["file"];


function upLoadFile($folderId, $mimeType, $fileName, $file){
    $DriveApi = new DriveApi();
    // TODO make $Driveapi->uplaod_fileC return file_id, and file_name
    // $mimeType = 'audio/mpeg';
    $returned_file = $DriveApi->upload_file($fileName, $folderId, $file, $mimeType);
    $fileToUpload["podcastFileURL"] = $DriveApi->get_file_share_link($returned_file->id);; 
    // print_r("File share link: ". $fileToUpload["podcastFileURL"] ."\n");
    // print_r("uploaded file id: " . $returned_file->id);
    return $fileToUpload["podcastFileURL"];
}   

// Checks for what folder user selected for uplaod and returns that folder's id.
function parentFolder($userSelect) {
    if($userSelect == "Chapel Messages"){
        return FOLDERCHAPELMESSAGES;
    }
    if($userSelect == "TREN"){
        return FOLDERTREN;
    }
    if($userSelect == "Stone-Campbell Hymnal Collection"){
        return FOLDERHYMNAL;
    }  
}
// $folderId = parentFolder($folder); // returns the folder ID acording to folder name
// $gDriveShareLink = upLoadFile($folderId, $file["type"], $fileName, file_get_contents($_FILES["file"]["tmp_name"])); // uplaods file to google drive then returns the files share URL.




//TODO uploadToOmeka($gDriveShareLink);
?>