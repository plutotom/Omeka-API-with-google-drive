<?php
require __DIR__ . '/vendor/autoload.php'; // inports google php client

print("Loaded googleDriveClient.php \n");

class DriveApi {
  public $client;
  public $service;
  public $drive;
  public $file;
  public $permission;
  public function __construct() {
  // puts service account's credentials into env.
  putenv('GOOGLE_APPLICATION_CREDENTIALS=./service-account.json'); 
  // checks to see if service account creds exists.
  // service account creds
  $application_creds = __DIR__ . '/service-account.json';
  $this->client = new Google\Client();

  if ($credentials_file =  file_exists($application_creds) ? $application_creds : false) {
    // set the location manually
    $this->client->setAuthConfig($credentials_file);
  } elseif (getenv('GOOGLE_APPLICATION_CREDENTIALS')) {
    // use the application default credentials
    $this->client->useApplicationDefaultCredentials();
  } else {
    // echo missingServiceAccountDetailsWarning();
    echo "missingServiceAccountDetailsWarning";
  };
  
  
  
    $this->service = new Google_Service_Drive($this->client);
    $this->client = $this->client->setScopes("https://www.googleapis.com/auth/drive");
    $this->drive = new Google_Service_Drive_Drive();
    $this->file = new Google_Service_Drive_Drivefile();
    $this->permission = new Google_Service_Drive_Permission();
  }

  // uploading file to google drive name: uplaod_fileC, where C is for inside class.
  public function upload_file($file_name, $parent_folder_id, $file_content, $mimeType){
    $this->file = new Google_Service_Drive_Drivefile(array(
      'name' => $file_name,
      'parents'=> [$parent_folder_id] // must be in list -> []
    ));
    // $mimeType='audio/mpeg';
    try {
      $uploaded_file = $this->service->files->create($this->file, array(
        'data' => $file_content,
        'mimeType' => $mimeType,
        'fields' => 'id',
        'uploadType' => "media"));
    } catch (Exception $th) {
      echo "cought exception: ", $th->getMessage(), "\n";

      // throw $th;
    }
    $this->set_file_permissions($uploaded_file->id);

    return $uploaded_file;
  }

  // takes a service, permission objects and a file id that is goign to be chaged
  public function set_file_permissions($file_id){
    $this->permission->setType('anyone');
    $this->permission->setRole('reader');
    $this->permission->setAllowFileDiscovery( True ); // should make file searcherable(?).
    try {
      $returned_permissions = $this->service->permissions->create($file_id, $this->permission);
    } catch (Exception $th) {
      echo "cought exception: ", $th->getMessage(), "\n";
      //throw $th;
    }
    
    return $returned_permissions;
  }

  // Takes file id and the google service and returns the web view link (i.e., the file share link)
  public function get_file_share_link($file_id){
    try {
      $file_info = $this->service->files->get($file_id, array("fields"=>"webViewLink"));
    } catch (Exception $th) {
      echo "cought exception: ", $th->getMessage(), "\n";

      //throw $th;
    }
    try {
      $web_link_view = $file_info->getWebViewLink();
    } catch (Exception $th) {
      echo "cought exception: ", $th->getMessage(), "\n";
      //throw $th;
    }
    
    // print_r("web link URL: " .$web_link_view);
    return $web_link_view;
  }
}
