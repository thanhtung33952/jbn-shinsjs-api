<?php
namespace Controllers;
use Slim\Http\UploadedFile;
use DateTime;
class ArticleController
{
    private $db;
    private $upload_directory;

    // constructor receives container instance
    public function __construct($db, $upload_directory) {
        $this->db = $db;
        $this->upload_directory = $upload_directory;
    }

    //Get all tag
    public function getAllTags($request, $response, $args) {
        try{
            $sql = "SELECT id, tagName 
                    FROM tb_tag 
                    ORDER BY tagName ";
            
            $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
            $offset= isset($_GET['offset']) ? $_GET['offset'] : 0;
            if($limit>0){
                $sql .= "LIMIT $limit OFFSET $offset ";
            }
    
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $response->withJson($result);
        }
        // any errors from the above database queries will be catched
        catch (PDOException $e){
            // roll back transaction
            //return $response->write($e);
            return $response->withStatus(500);
            // log any errors to file
            ExceptionErrorHandler($e);
            exit;
        }
        
    }

    //update all tags
    public function updateTags($request, $response, $args) {
        $input = $request->getParsedBody();
    
        $this->db->beginTransaction();
        try {
            //update title
            foreach ($input as $item) {
                $sql = "UPDATE tb_tag SET tagName=:tagName WHERE id=:id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("tagName", $item['tagName']);
                $stmt->bindParam("id", $item['id']);
                $stmt->execute();
            }
            // $lastInsertID = $this->db->lastInsertId();
 
            $this->db->commit();
            return $response->withJson($input);
        }               
        // any errors from the above database queries will be catched
        catch (PDOException $e){
            // roll back transaction
            $this->db->rollback();
            //return $response->write($e);
            return $response->withStatus(500);
            // log any errors to file
            ExceptionErrorHandler($e);
            exit;
        }
    }

    //update all tags
    public function updateTagByTagId($request, $response, $args) {
        $id = $args['id'];
        $input = $request->getParsedBody();
        $this->db->beginTransaction();
        try {
            //update title
            $sql = "UPDATE tb_tag SET tagName=:tagName WHERE id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("tagName", $input['tagName']);
            $stmt->bindParam("id", $id);
            $stmt->execute();
            $input['id'] = $id;
 
            $this->db->commit();
            return $response->withJson($input);
        }               
        // any errors from the above database queries will be catched
        catch (PDOException $e){
            // roll back transaction
            $this->db->rollback();
            //return $response->write($e);
            return $response->withStatus(500);
            // log any errors to file
            ExceptionErrorHandler($e);
            exit;
        }
    }

    //get all title by tagId
    public function getAllTitleByTagId($request, $response, $args) {
        try{
            $sql = "SELECT tb2.id, tb2.title 
                    FROM tb_tag_details tb1 
                    INNER JOIN (SELECT id, title FROM tb_article) tb2 
                    ON tb1.articleId = tb2.id 
                    WHERE tb1.tagId=:id 
                    ORDER BY tb2.title ";
            
            $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
            $offset= isset($_GET['offset']) ? $_GET['offset'] : 0;
            if($limit>0){
                $sql .= "LIMIT $limit OFFSET $offset ";
            }
    
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("id", $args['id']);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $response->withJson($result);
        }
        // any errors from the above database queries will be catched
        catch (PDOException $e){
            // roll back transaction
            //return $response->write($e);
            return $response->withStatus(500);
            // log any errors to file
            ExceptionErrorHandler($e);
            exit;
        }
    }

    //Get article by article id
    public function getArticleByArticleId($request, $response, $args) {
        $articleId = $args['id'];
        //get title
        $sql = "SELECT id, title FROM tb_article WHERE id=:articleId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("articleId", $articleId);
        $stmt->execute();
        $article = $stmt->fetchObject();
    
        //get all tags of article
        $sql = "SELECT tb2.id, tb2.tagName 
                FROM (SELECT tagId 
                      FROM tb_tag_details 
                      WHERE articleId=:articleId) tb1
                INNER JOIN tb_tag as tb2
                  ON tb1.tagId = tb2.id
                ORDER BY tb2.tagName";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("articleId", $articleId);
        $stmt->execute();
        $tags = $stmt->fetchAll();
    
        // get details
        $sql = "SELECT type, seq, val1, val2 
                FROM tb_article_details 
                WHERE articleId=:articleId ORDER BY seq";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("articleId", $articleId);
        $stmt->execute();
        $details = $stmt->fetchAll();
        
        // get history
        $sql = "SELECT updateBy AS useremail, updateTime 
                FROM tb_history 
                WHERE articleId=:articleId 
                ORDER BY updateTime desc";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("articleId", $articleId);
        $stmt->execute();
        $history = $stmt->fetchAll();

        $result = array(
            "article" => $article,
            "tags" => $tags,
            "details" => $details,
            "history" => $history);
        
        return $response->withJson($result);
    }
    
    // Search articles with title name
    public function seachArticlesWithTitle($request, $response, $args) {
        $keySearch= isset($args['title'])? $args['title'] : "";
        $result = array();
        try{
            $sql = "SELECT id, title 
                    FROM tb_article 
                    WHERE UPPER(title) LIKE :title 
                    ORDER BY title ";
            
            $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
            $offset= isset($_GET['offset']) ? $_GET['offset'] : 0;
            if($limit>0){
                $sql .= "LIMIT $limit OFFSET $offset ";
            }
    
            $stmt = $this->db->prepare($sql);
            $query = "%".$keySearch."%";
            $stmt->bindParam("title", $query);
            $stmt->execute();
            $articles = $stmt->fetchAll();
    
            foreach ($articles as $article) {
    
                $sql = "SELECT tb2.id, tb2.tagName 
                        FROM tb_tag_details tb1
                        INNER JOIN tb_tag tb2
                            ON tb1.tagId = tb2.id
                        WHERE tb1.articleId = :articleId
                        ORDER BY tb2.id";
    
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("articleId", $article["id"]);
                $stmt->execute();
                $tags = $stmt->fetchAll();
    
                array_push($result, array(
                    "article" => $article,
                    "tags" => $tags));
            }
            return $response->withJson($result);
        }
        // any errors from the above database queries will be catched
        catch (PDOException $e){
            // roll back transaction
            //return $response->write($e);
            return $response->withStatus(500);
            // log any errors to file
            ExceptionErrorHandler($e);
            exit;
        }
    }

    // Add a new title
    public function addNewTitle($request, $response) {
        $input = $request->getParsedBody();
        $title = $input['article']['title'];
        $useremail = $input['useremail'];
        $articleId = $this->generateId();
        $tagsJson = $input['tags'];
        $detailsJson = $input['details'];
    
        $this->db->beginTransaction();
        try {
            //insert title
            $sql = "INSERT INTO tb_article (id, title, createBy) VALUES (:id, :title, :useremail)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("id", $articleId);
            $stmt->bindParam("title", $title);
            $stmt->bindParam("useremail", $useremail);
            $stmt->execute();
            $input['article']['id'] = $articleId;
            
            //insert tags
            $tagsId = array();
            if(sizeof($tagsJson)==0){
                array_push($tagsId, 0);
                $tagsJson[0]['id'] = 0;
            }
            else{
                foreach ($tagsJson as $key => $item) {
                    if(isset($item['id'])){
                        array_push($tagsId, $item['id']);
                    } else{
                        //insert tag
                        $sql = "INSERT INTO tb_tag (tagName) VALUES (:tagName)";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindParam("tagName", $item["tagName"]);
                        $stmt->execute();
                        array_push($tagsId, $this->db->lastInsertId());
                        $tagsJson[$key]['id'] = $this->db->lastInsertId();
                    }
                    
                }
            }
            
            $input['tags'] = $tagsJson;
    
            $rowsInsert = array();
            foreach ($tagsId as $item) {
                array_push($rowsInsert, "('".$item."', '".$articleId."')");
            }
            $sql = "INSERT INTO tb_tag_details (tagId, articleId) VALUES " . implode(',', $rowsInsert);
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            
            //insert article details
            $rowsInsert = array();
            foreach ($detailsJson as $item) {
                $item['val2'] = isset($item['val2'])?$item['val2']:"";
                array_push($rowsInsert,"('".$articleId."','".$item['type']."','".$item['seq']."','".$item['val1']."','".$item['val2']."')");
            }
            $sql = "INSERT INTO tb_article_details (articleId, type, seq, val1, val2) VALUES " . implode(',', $rowsInsert);
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
    
            //save history
            $sql = "INSERT INTO tb_history (articleId, updateBy) VALUES (:articleId, :useremail)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("articleId", $articleId);
            $stmt->bindParam("useremail", $useremail);
            $stmt->execute();
    
            $this->db->commit();
            return $response->withJson($input);
        }               
        // any errors from the above database queries will be catched
        catch (PDOException $e){
            // roll back transaction
            $this->db->rollback();
            //return $response->write($e);
            return $response->withStatus(500);
            // log any errors to file
            ExceptionErrorHandler($e);
            exit;
        }
    }

    // delete a article with given id
    public function deleteArticleByArticleId($request, $response, $args) {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare("DELETE FROM tb_article WHERE id=:id");
            $stmt->bindParam("id", $args['id']);
            $result = $stmt->execute();
    
            $stmt = $this->db->prepare("DELETE FROM tb_article_details WHERE articleId=:articleId");
            $stmt->bindParam("articleId", $args['id']);
            $result = $stmt->execute();
            
            $this->db->commit();
            return $response->withStatus(200);
        }               
        // any errors from the above database queries will be catched
        catch (PDOException $e){
            // roll back transaction
            $this->db->rollback();
            //return $response->write($e);
            return $response->withStatus(500);
            // log any errors to file
            ExceptionErrorHandler($e);
            exit;
        }
    }

    // Update tb_article_details with articleId
    public function updateArticle($request, $response, $args) {
        $input = $request->getParsedBody();
        $articleId = $args['id'];
        $title = $input['article']['title'];
        $useremail = $input['useremail'];
        $tagsJson = $input['tags'];
        $detailsJson = $input['details'];
    
        $this->db->beginTransaction();
        try {
            //update title
            $sql = "UPDATE tb_article SET title=:title WHERE id=:articleId";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("title", $title);
            $stmt->bindParam("articleId", $articleId);
            $stmt->execute();
    
            //update tags
            $tagsId = array();
            $tagsId = array();
            if(sizeof($tagsJson)==0){
                array_push($tagsId, 0);
                $tagsJson[0]['id'] = 0;
            }
            else{
                foreach ($tagsJson as $key => $item) {
                    if(isset($item['id'])){
                        array_push($tagsId, $item['id']);
                    } else{
                        //insert tag
                        $sql = "INSERT INTO tb_tag (tagName) VALUES (:tagName)";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindParam("tagName", $item["tagName"]);
                        $stmt->execute();
                        array_push($tagsId, $this->db->lastInsertId());
                        $tagsJson[$key]['id'] = $this->db->lastInsertId();
                    }
                }
            }
            //update id tags
            $input['tags'] = $tagsJson;
    
            $stmt = $this->db->prepare("DELETE FROM tb_tag_details WHERE articleId=:articleId");
            $stmt->bindParam("articleId", $articleId);
            $stmt->execute();
    
            $rowsInsert = array();
            foreach ($tagsId as $item) {
                array_push($rowsInsert, "('".$item."', '".$articleId."')");
            }
            $sql = "INSERT INTO tb_tag_details (tagId, articleId) VALUES " . implode(',', $rowsInsert);
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
    
            //update details
            $stmt = $this->db->prepare("DELETE FROM tb_article_details WHERE articleId=:articleId");
            $stmt->bindParam("articleId", $articleId);
            $stmt->execute();
    
            $rowsInsert = array();
            foreach ($detailsJson as $item) {
                $item['val2'] = isset($item['val2'])?$item['val2']:"";
                array_push($rowsInsert,"('".$articleId."','".$item['type']."','".$item['seq']."','".$item['val1']."','".$item['val2']."')");
            }
            $sql = "INSERT INTO tb_article_details (articleId, type, seq, val1, val2) VALUES " . implode(',', $rowsInsert);
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            
            // $lastInsertID = $this->db->lastInsertId();
    
            //save history
            $sql = "INSERT INTO tb_history (articleId, updateBy) VALUES (:articleId, :useremail)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("articleId", $articleId);
            $stmt->bindParam("useremail", $useremail);
            $stmt->execute();
            
            $this->db->commit();
            return $response->withJson($input);
        }               
        // any errors from the above database queries will be catched
        catch (PDOException $e){
            // roll back transaction
            $this->db->rollback();
            //return $response->write($e);
            return $response->withStatus(500);
            // log any errors to file
            ExceptionErrorHandler($e);
            exit;
        }
    }

    // API upload photo
    public function uploadphoto($request, $response) {
        $directory = $this->upload_directory;
        $extArr = array("jpg", "jpg", "png", "gif");
        try {
            $uploadedFiles = $request->getUploadedFiles();
            // handle single input with single file upload
            if(!isset($uploadedFiles['my_file'])){
                $response->write("No file uploaded or invalid file type");
                return $response->withStatus(500);
            }
            $uploadedFile = $uploadedFiles['my_file'];
            
            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                $ext = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
                if (!in_array($ext, $extArr)) {
                    throw new \Exception();
                }
                $filename = $this->moveUploadedFile($directory, $uploadedFile);
                $response->write($filename);
            }
        } catch(\Exception $e) {
            $response->write("No file uploaded or invalid file type");
            return $response->withStatus(500);
        }
    }

    // API upload file
    public function uploadfile($request, $response) {
        $directory = $this->upload_directory;
        $extArr = array("pdf", "docx", "xlsx");
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
                    $ext = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
                    if (!in_array($ext, $extArr)) {
                        throw new \Exception("No negative number please!");
                    }
                } else{
                    throw new \Exception();
                }
            }
            
            // handle single input with multiple file uploads
            foreach ($uploadedFiles['my_file'] as $uploadedFile) {
                $filename = $this->moveUploadedFile($directory, $uploadedFile);
                array_push($result, $filename);
            }
            return $response->withJson((array('data' => $result)));

        } catch(\Exception $e) {
            //$response->write($e);
            $err =  '{"error": {"text": "'.$e->getMessage().'"}}';
            $response->write($err);
            return $response->withStatus(500);
        }
    }

    // // get info history [{username1, updatetime1}, {username2, updatetime2}, {username3, updatetime3}]
    // public function getHistoryWithId($request, $response, $args) {
    //     $articleId = $args['id'];
    //     try{
    //         $sql = "SELECT updateBy AS userName, updateTime 
    //                 FROM tb_history 
    //                 WHERE articleId=:articleId 
    //                 ORDER BY updateTime desc ";
            
    //         $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
    //         $offset= isset($_GET['offset']) ? $_GET['offset'] : 0;
    //         if($limit>0){
    //             $sql .= "LIMIT $limit OFFSET $offset ";
    //         }
    
    //         $stmt = $this->db->prepare($sql);
    //         $stmt->bindParam("articleId", $articleId);
    //         $stmt->execute();
    //         $result = $stmt->fetchAll();
    //         return $response->withJson($result);
    //     }
    //     // any errors from the above database queries will be catched
    //     catch (PDOException $e){
    //         // roll back transaction
    //         //return $response->write($e);
    //         return $response->withStatus(500);
    //         // log any errors to file
    //         ExceptionErrorHandler($e);
    //         exit;
    //     }
    // }

    function moveUploadedFile($directory, $uploadedFile){
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
        $filename = sprintf('%s.%0.8s', $basename, $extension);
    
        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
    
        return $filename;
    }
    
    function generateId(){
        $date = new DateTime();
        $result = $date->format('Y-m-d H:i:s');
        $str = $this->generateRandomString().$result;
        return MD5($str);
    }
    
    function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}