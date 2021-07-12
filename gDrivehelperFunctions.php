<?php
include './gDriveApiClient/googleDriveClient.php'; // Importing DriveApi

// Defining google drive parent folder ids.
define("FOLDERCHAPELMESSAGES", "15UQ9dqIqjR5jqmzsT-ReJPisQncJQUvx");
define("FOLDERTREN", "15UQ9dqIqjR5jqmzsT-ReJPisQncJQUvx");
define("FOLDERHYMNAL", "15UQ9dqIqjR5jqmzsT-ReJPisQncJQUvx");


function upLoadFile($folderId, $mimeType, $fileName, $file){
    $DriveApi = new DriveApi();
    // TODO make $Driveapi->uplaod_fileC return file_id, and file_name
    // $mimeType = 'audio/mpeg';
    $returned_file = $DriveApi->upload_file($fileName, $folderId, $file, $mimeType);
    try {
        $fileToUpload["podcastFileURL"] = $DriveApi->get_file_share_link($returned_file->id);; 
    } catch (Exception $th) {
        echo "cought exception: ", $th->getMessage(), "\n";
        //throw $th;
    }
    // print_r("File share link: ". $fileToUpload["podcastFileURL"] ."\n");
    // print_r("uploaded file id: " . $returned_file->id);
    $obj = [
        "fileShareLink" => $fileToUpload["podcastFileURL"],
        "fileId" => $returned_file->id
    ];
    return $obj;
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
?>