<html>
    <body>
    <a href="index.html">index.html</a>

    <form
      enctype="multipart/form-data"
      action="addTranscript.php"
      method="post"
    >
      <h3>Upload Item to Google drive and Omeka</h3>
      <p>
        <select name="folderSelect" id="folderSelect">
          <option value="Chapel Messages">Chapel Messages</option>
          <option value="TREN">TREN</option>
          <option value="Stone-Campbell Hymnal Collection">
            Stone-Campbell Hymnal Collection
          </option>
        </select>
        Google Drive Folder
      </p>

      <p><input name="tFile" type="file" id="file" />Upload transcript file here</p>
      <p>
        <input name="fileName" type="text" id="file" /> Google drive file name
      </p>
      <p>
        <select name="mimeType" id="mimeType">
          <option value="plan/text">plan/text</option>
          <option value="audio/mpeg">audio/mpeg</option>
          <option value="application/msword">application/msword</option>
        </select>
        MimeType
      </p>
      <p>
        <select name="folderSelect" id="folderSelect">
          <option value="Chapel Messages">Chapel Messages</option>
          <option value="TREN">TREN</option>
          <option value="Stone-Campbell Hymnal Collection">
            Stone-Campbell Hymnal Collection
          </option>
        </select>
        Google Drive Folder
      </p>
      <div>
        <input
          type="checkbox"
          id="omekaFilePreview"
          name="omekaFilePreview"
          value="omeka File Preview"
        />
        <label for="omekaFilePreview">True == preview, false == hyperlink</label>
      </div>

      <br />

    <pre id="output"></pre>


<?php
include './gDriveHelperFunctions.php'; // imports parentFolder and upLoadFile functions.
include './omekaClientAPI.php';
// include './gDriveInstance.php';
// Error logging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
echo "TESTING";
// Defining google drive parent folder ids.
define("FOLDERCHAPELMESSAGES", "15UQ9dqIqjR5jqmzsT-ReJPisQncJQUvx");
define("FOLDERTREN", "15UQ9dqIqjR5jqmzsT-ReJPisQncJQUvx");
define("FOLDERHYMNAL", "15UQ9dqIqjR5jqmzsT-ReJPisQncJQUvx");



//! On load get all omeka items so we can select one to edit
// destructinig html user input values.

$key = "43ca10306f312f2ac162de563a60e408db2c3d25";
$item = "items?collection=4"; // this returns only items in collection of Chapel messages (chepel message id = 4)
$settings = array("basePath"=>"http://localhost/omeka/api",
    "api_key" => $key,
    "resource" => $item);

$tfile = $_FILES["tFile"];
$fileName = $_POST["fileName"];
$omekaFilePreview = $_POST["omekaFilePreview"];

    // Getting all items to populate select Item List.
    $OmekaAPI = new OmekaClient($settings);
    $res = $OmekaAPI->getAllItems();
    // print_r(gettype(json_encode($res)));
    $resJson = json_decode($res, JSON_PRETTY_PRINT);
    // putting all items names and ids in select dropdown
    
try {
  //code...
} catch (\Exception $th) {
  //throw $th;
}

    echo "<div>";
    echo " <select name=itemsList id=selectItemList >";
    foreach ($resJson as &$value) {
        foreach($value["element_texts"] as &$value2){
            if ($value2["element"]["name"] === "Title"){
                // print_r($value2["text"]);
                echo '<option value="'.$value['id']. '">'.$value2["text"].'</option>';
            }
        }
    }
    echo "</select>";
    echo "</div>";
    unset($value);
    unset($value2); // break the reference with the last element
// End getting items.

  if(isset($_POST['submit'])){
    //! uploading transcript file to google drive
    // getting user inputs from HTML form.
    $fileName = $_POST["fileName"];
    $mimeType = $_POST["mimeType"];
    $folder = $_POST["folderSelect"];
    $fileContent = file_get_contents($_FILES["tFile"]["tmp_name"]);
    $omekaFilePreview = $_POST["omekaFilePreview"];

    // Getting folder ID based on user selected option.
    // Folder IDs are hard coded in gDriveHelperFunctions
    $folderId = parentFolder($folder); 
    $gDriveFile = upLoadFile($folderId, $mimeType, $fileName, $fileContent); // Uploads new transcripe file to Google drive.

    $fileId = $gDriveFile["fileId"];
    $fileShareLink = $gDriveFile["fileShareLink"];
    $selectedItemId = $_POST["itemsList"];
    echo $fileId;
    echo "<br />";
    echo $fileShareLink;
    //TODO make put request to Omeka item with $fileShareLink  
  }
?>
<p>is there thigns her</p>
<input type="submit" value="submit" name="submit"/>
</form>
</html>