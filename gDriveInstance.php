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

// destructinig html user input values.
$fileName = $_POST["fileName"];
$mimeType = $_POST["mimeType"];
$folder = $_POST["folderSelect"];
$file = $_FILES["file"];
$autherName = $_POST["author"];
$omekaFilePreview = $_POST["omekaFilePreview"];


function upLoadFile($folderId, $mimeType, $fileName, $file){
    $DriveApi = new DriveApi();
    // TODO make $Driveapi->uplaod_fileC return file_id, and file_name
    // $mimeType = 'audio/mpeg';
    $returned_file = $DriveApi->upload_file($fileName, $folderId, $file, $mimeType);
    $fileToUpload["podcastFileURL"] = $DriveApi->get_file_share_link($returned_file->id);; 
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

// uploading file to google drive
$folderId = parentFolder($folder); // returns the folder ID acording to folder name
$gDriveFileInfo = upLoadFile($folderId, $file["type"], $fileName, file_get_contents($_FILES["file"]["tmp_name"])); // uplaods file to google drive then returns the files share URL.

$gDriveShareLink = $gDriveFileInfo["fileShareLink"];
$gDriveFileId = $gDriveFileInfo["fileId"];
echo "finished uplaod to google drive";



//! checking if share link should be preview or view.
if($omekaFilePreview != null){
    //TODO change gdriveURL from veiw to preview
    $gDriveShareLink = "https://drive.google.com/file/d/" . $gDriveFileId . "/preview";

}
//! creating omeka body
$obj = [
    'item_type' => 
    [
      'id' => 20,
    ],
    'public' => true,
    'featured' => false,
    'tags' => 
    [
      0 => 
      [
        'name' => 'foo',
      ],
      1 => 
      [
        'name' => 'undergrad',
      ],
    ],
    'element_texts' => [],
];

$title = [
  'html' => false,
  'text' => $fileName,
  'element' => 
  [
    'id' => 50,
  ],
];
$author = [
    'html' => false,
    'text' => $autherName,
    'element' => 
    [
        'id' => 56,
    ],
];
$gFileID =  [
    'html' => false,
    'text' => $gDriveFileId,
    'element' => 
    [
        'id' => 67,
    ],
];
$dateRecored = [
    'html' => false,
    'text' => 'July 3, 2021',
    'element' => 
    [
      'id' => 55,
    ],
];
$gDriveURL = [
    'html' => false,
    'text' => $gDriveShareLink,
    'element' => 
    [
        'id' => 28,
    ],
];

// Pushing elements into array for body
$obj["element_texts"][] = $title;
$obj["element_texts"][] = $author;
$obj["element_texts"][] = $gFileID;
$obj["element_texts"][] = $dateRecored;
$obj["element_texts"][] = $gDriveURL;


//! calling Omeka api to uplaod item
echo "calling omekaAPI";
$key = "43ca10306f312f2ac162de563a60e408db2c3d25";
// $body = OmekaClient->createItem Example body
$settings = array("basePath"=>"http://localhost/omeka/api", "api_key" => $key, "resource" => "items");
$OmekaAPI = new OmekaClient($settings);
$res = $OmekaAPI->createitem($obj);
print_r($res);
echo "\n END \n";

//TODO edit/update/put requestion.
//TODO DELETE request.
//TODO make the html work for the full thing
?>