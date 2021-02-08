<?php
namespace Controllers;
use Firebase\JWT\JWT;
use Tuupola\Base62;
use DateTime;

class CommonController
{
    private $db, $upload_directory;

    // constructor receives container instance
    public function __construct($db, $upload_directory) {
        $this->db = $db;
        $this->upload_directory = $upload_directory;
    }

    public function zipaddress($request, $response, $args) {
        $zipcode = isset($args['zipcode'])?$args['zipcode']:"";
    
        // create a new cURL resource
        $ch = curl_init();
    
        // set URL and other appropriate options
        $url = "https://api.zipaddress.net?zipcode=".$zipcode;
    
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        // grab URL and pass it to the browser
        $curl_response = curl_exec($ch);
    
        // close cURL resource, and free up system resources
        curl_close($ch);
    
        $decoded = json_decode($curl_response);
        
        return $response->withJson($decoded);
    }

    //public function getToken($request, $response, $args) use ($container){
    public function getToken($request, $response, $args) {
        /* Here generate and return JWT to the client. */
        //$valid_scopes = ["read", "write", "delete"]
     
          $requested_scopes = $request->getParsedBody() ?: [];
     
        $now = new DateTime();
        $future = new DateTime("+1 minutes");
        $server = $request->getServerParams();
        $jti = (new Base62)->encode(random_bytes(16));
        $payload = [
            "iat" => $now->getTimeStamp(),
            "exp" => $future->getTimeStamp(),
            "jti" => $jti,
            "sub" => $server["PHP_AUTH_USER"]
        ];
        $secret = "123456789helo_secret";
        $token = JWT::encode($payload, $secret, "HS256");
        $data["token"] = $token;
        $data["expires"] = $future->getTimeStamp();
        return $response->withStatus(201)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }

    
    //$app->post('/downloadFile', 'authenticate', function() use ($app) 
    public function downloadFile($request, $response, $args){
        try
        {
            $filename = $args['filename'];
            $file = dirname(__DIR__ ).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR .$filename;
            if (!file_exists($file) ) {
                //throw new Exception('File not found.');
                throw new \Exception('File not found.');
            }
            $fh = fopen($file, 'rb');

            $stream = new \Slim\Http\Stream($fh); // create a stream instance for the response body

            return $response->withHeader('Content-Type', 'application/force-download')
                            ->withHeader('Content-Type', 'application/octet-stream')
                            ->withHeader('Content-Type', 'application/download')
                            ->withHeader('Content-Description', 'File Transfer')
                            ->withHeader('Content-Transfer-Encoding', 'binary')
                            ->withHeader('Content-Disposition', 'attachment; filename="' . basename($file) . '"')
                            ->withHeader('Expires', '0')
                            ->withHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
                            ->withHeader('Pragma', 'public')
                            ->withBody($stream); // all stream contents will be sent to the response
        } catch(\Exception $e) {
            $response->write($e->getMessage());
            return $response->withStatus(500);
        }
    }

    // API upload file
    public function uploadfile($request, $response) {
        //$date = date("Ymd");
        $directory = $this->upload_directory;
        // if (!file_exists($directory)) {
        //     mkdir($directory, 0777, true);
        // }
        
        $result = array();
        try {
            $uploadedFiles = $request->getUploadedFiles();
            // handle single input with single file upload
            if(!isset($uploadedFiles['my_file'])){
                throw new \Exception();
            }
            
            // handle single input with multiple file uploads
            foreach ($uploadedFiles['my_file'] as $uploadedFile) {
                $filename = $this->moveUploadedFile($directory, $uploadedFile);
                array_push($result, $filename);
            }


            return $response->withJson((array('data' => $result)));
        } catch(\Exception $e) {
            $err =  '{"error": {"text": "'.$e->getMessage().'"}}';
            $response->write($err);
            return $response->withStatus(500);
        }
    }

    // API upload photo
    public function uploadphoto($request, $response) {
        //$date = date("Ymd");
        $directory = $this->upload_directory;
        // if (!file_exists($directory)) {
        //     mkdir($directory, 0777, true);
        // }
        
        $extArr = array("jpg", "jpg", "png", "gif");
        $result = array();
        try {
            $uploadedFiles = $request->getUploadedFiles();
            // handle single input with single file upload
            if(!isset($uploadedFiles['my_file'])){
                throw new \Exception();
            }
             //check extension
             foreach ($uploadedFiles['my_file'] as $uploadedFile) {
                if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                    $ext = strtolower(pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION));
                    if (!in_array($ext, $extArr)) {
                        throw new \Exception("No negative number please!");
                    }
                } else{
                    throw new \Exception();
                }
            }
            
            // handle single input with multiple file uploads
            foreach ($uploadedFiles['my_file'] as $uploadedFile) {
                $filename = $this->moveUploadedPhoto($directory, $uploadedFile);
                array_push($result, $filename);
            }


            return $response->withJson((array('data' => $result)));
        } catch(\Exception $e) {
            $err =  '{"error": {"text": "'.$e->getMessage().'"}}';
            $response->write($err);
            return $response->withStatus(500);
        }
    }

    function moveUploadedFile($directory, $uploadedFile){
        $date = date("Ymd");
        $filename = $uploadedFile->getClientFilename();
        // $targetFull = $directory . DIRECTORY_SEPARATOR .$date;

        // // create folder full
        // if (!file_exists($targetFull)) {
        //     mkdir($targetFull, 0777, true);
        // }
        $tagetFile=$directory. DIRECTORY_SEPARATOR . $filename;
        $uploadedFile->moveTo($tagetFile);
        
        return $filename;
        
    }

    function moveUploadedPhoto($directory, $uploadedFile){
        $date = date("Ymd");
        $filename = $uploadedFile->getClientFilename();
        $targetThumb = $directory . DIRECTORY_SEPARATOR .'thumbnails';

        
        $tagetFile=$directory. DIRECTORY_SEPARATOR . $filename;
        $uploadedFile->moveTo($tagetFile);
        
        // create folder full
        if (!file_exists($targetThumb)) {
            mkdir($targetThumb, 0777, true);
        }
        $this->resize($tagetFile, $targetThumb . DIRECTORY_SEPARATOR . $filename, 260, 0);

        return $filename;
        
    }

    function resize($filename, $outputFile, $max_width, $max_height){
        ini_set('memory_limit', '-1');
        //ini_set('MAX_EXECUTION_TIME', 3000);
        
        list($orig_width, $orig_height) = getimagesize($filename);
        
        $width = $orig_width;
        $height = $orig_height;
    
        // width
        if ($width > $max_width && $max_width!=0) {
            $height = ($max_width / $width) * $height;
            $width = $max_width;
        }
    
        // height; $max_height = 0 not check height
        if ($height > $max_height && $max_height!=0) {
            $width = ($max_height / $height) * $width;
            $height = $max_height;
        }
        
        $image_p = imagecreatetruecolor($width, $height);
        
        $type = exif_imagetype($filename);
        $allowedTypes = array( 
            1,  // [] gif 
            2,  // [] jpg 
            3,  // [] png 
            6   // [] bmp 
        ); 
        if (!in_array($type, $allowedTypes)) { 
            return false; 
        } 
        switch ($type) {
            //case 'jpg':
            case 2:
                $image = imagecreatefromjpeg($filename);
                break;
            case 1:
                $image = imagecreatefromgif($filename);
                break;
            case 3:
                $image = imageCreateFromPng($filename);
                break;
            case 6:
                $image = imageCreateFromBmp($filename);
                break;
            default:
                $image = false;
                break;
        }
        
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);
        
        //check folder target exist
        $pathTarget = dirname($outputFile);
        if (!file_exists($pathTarget)) {
            mkdir($pathTarget, 0777, true);
        }
    
        // Save the image as outputFile
        try{
            if(imagejpeg($image_p, $outputFile)){
                imagedestroy($image_p);
                return true;
            }
            else{
                imagedestroy($image_p);
                return false;
            }
        } catch (Exception $e) {
        }
        
    } 
}