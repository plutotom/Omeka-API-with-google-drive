
<?php
echo "loaded omekaClient";

class OmekaClient {
    public $api_key;
    public $basePath;
    public $resource;

    function __construct($settings) {
        print_r($settings);
        $this->api_key = "?key=" . $settings["api_key"];
        $this->basePath = $settings["basePath"];
        $this->resource = $settings["resource"];
        // $this->service = new GuzzleHttp\Client();
    }

    public function getAllItems(){
        $url = $this->basePath . "/" . $this->resource . "/" . $this->api_key;
        // $urlTest = "http://localhost/omeka/api/"."items"."?key=43ca10306f312f2ac162de563a60e408db2c3d25";
        print_r(file_get_contents($url));
        $allItems = file_get_contents($url);
        return $allItems;
    }

    public function getItemById($id) {
        $url = $this->basePath . "/" . $this->resource . "/" . $id . $this->api_key;
        $item = file_get_contents($url);
        return $item;
      }

    public function createItem($body){
        $data = json_encode($body);

        $context_options = array (
            'http' => array (
                'method' => 'POST',
                'header'=> "Content-type: application/json\r\n",
                'content' => $data
                )
            );
        $url = $this->basePath . "/" . $this->resource . "/" . $this->api_key;
        $context  = stream_context_create($context_options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { /* Handle error */  echo "header error";}
        //compiling to JSON (as wrote above):
        $resultData = json_decode($result, TRUE);
        var_dump($resultData);
        echo "finished posting";
        return $result;
    }
}
?>



