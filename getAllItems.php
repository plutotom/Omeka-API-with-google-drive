
<html>
    <body>
    <a href="index.html">index.html</a>

    <form
      enctype="multipart/form-data"
      action="getAllItems.php"
      method="post"
    >
      <h3>Get item from Omeka API by id</h3>
      <p>
        <input type="text" id="endpoint" value="http://localhost/omeka/api/" />
        Endpoint
      </p>
      <p>
        <input
          type="text"
          id="key"
          value="43ca10306f312f2ac162de563a60e408db2c3d25"
        />
        Key
      </p>
      <div>
        <select name="resourcesList" id="resourcesList">
          <option value="items">items</option>
          <option value="tags">tags</option>
          <option value="collections">collections</option>
          <option value="files">files</option>
          <option value="item_types">item_types</option>
          <option value="elements">elements</option>
          <option value="element_sets">element_sets</option>
          <option value="users">users</option>
          <option value="simple_pages">simple_pages</option>
          <option value="site">site</option>
          <option value="resources">resources</option>
        </select>
        Resources
      </div>
      <input type="submit" value="Submit" name="submit" />
    </form>
    <pre id="output"></pre>
    </body>

<?php
include './gDriveApiClient/googleDriveClient.php'; // Importing DriveApi
include './omekaClientAPI.php';
// Error logging
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Defining google drive parent folder ids.
define("FOLDERCHAPELMESSAGES", "15UQ9dqIqjR5jqmzsT-ReJPisQncJQUvx");
define("FOLDERTREN", "15UQ9dqIqjR5jqmzsT-ReJPisQncJQUvx");
define("FOLDERHYMNAL", "15UQ9dqIqjR5jqmzsT-ReJPisQncJQUvx");

// destructinig html user input values.
$resource = $_POST["resourcesList"];
$key = "43ca10306f312f2ac162de563a60e408db2c3d25";
$settings = array("basePath"=>"http://localhost/omeka/api", "api_key" => $key, "resource" => $resource);


if (isset($_POST['submit'])) {
  $OmekaAPI = new OmekaClient($settings);
  print_r($OmekaAPI);
  $res = $OmekaAPI->getAllItems();
  print_r($res);
}
?>
</html>