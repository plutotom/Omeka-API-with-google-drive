
<?php
echo "loaded omekaClient";

class OmekaClient {
    public $api_key;
    public $basePath;
    public $resource;
    protected $service;


    function __constructor($settings) {
        $this->api_key = "?key=" + $settings->api_key;
        $this->basePath = "http://localhost/omeka/api";
        $this->resource = $settings->resource;
        $this->service = new GuzzleHttp\Client();
    }

    public function getAllItems(){
        $url = $this->basePath . "/" . $this->resource . "/" . $this->api_key;
        $urlTest = "http://localhost/omeka/api/"."items"."?key=43ca10306f312f2ac162de563a60e408db2c3d25";
        print_r(file_get_contents($urlTest));
        $allItems = file_get_contents($urlTest);
        return $allItems;
    }

    public function getItemById($id) {
        $url = $this->basePath + "/" + $this->resource + "/" + $id + $this->api_key;
        $item = file_get_contents($url);
        return $item;
      }

    public function createItem($body){
        // not create, only template
        // TODO make this work for Omeka.
        $data = array ('foo' => 'bar', 'bar' => 'baz');
        $data = http_build_query($data);
        
        $context_options = array (
            'http' => array (
                'method' => 'POST',
                'header'=> "Content-type: application/x-www-form-urlencoded\r\n"
                    . "Content-Length: " . strlen($data) . "\r\n",
                'content' => $data
                )
            );
        $context = stream_context_create($context_options);
        $fp = fopen('https://url', 'r', false, $context);
    }
    public function request($url, $options = []){
        $headers = [
            "Content-type" => "application/json",
        ];
        $config = [
            // ..options,
            // ..headers
        ];
        // return fetch(url, config).then((res) => {
        //     if (res.ok) {
        //       return res.json();
        //     }
        //     throw new Error(res);
        //     return res.status;
        //   });
        
    }
}
?>