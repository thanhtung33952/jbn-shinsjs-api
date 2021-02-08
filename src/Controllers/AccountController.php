<?php
namespace Controllers;

class AccountController
{
    private $db;

    // constructor receives container instance
    public function __construct($db) {
        $this->db = $db;
    }

    public function register($request, $response) {
        $input = $request->getParsedBody();
        $id = $this->generateRandomString(10);
        $lastName = $input['lastName'];
        $firstName = $input['firstName'];
        $email = $input['email'];
        $password = $input['password'];
        $companyID = isset($input['companyID']) ? $input['companyID'] : NULL;

        //check exist email
        $sql = "SELECT count(*) FROM tb_users WHERE email=:email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("email", $email);
        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn(); 
        if($number_of_rows>0){
            $input['id'] = -1;
            return $response->withJson($input);
        }
        try {
            $this->db->beginTransaction();
            $sql = "INSERT INTO tb_users (`id`, `lastName`, `firstName`, `email`, `password`, `companyID`) 
                        VALUES (:id, :lastName, :firstName, :email, :password, :companyID)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("id", $id);
            $stmt->bindParam("lastName", $lastName);
            $stmt->bindParam("firstName", $firstName);
            $stmt->bindParam("email", $email);
            $stmt->bindParam("password", $password);
            $stmt->bindParam("companyID", $companyID);
            $stmt->execute();

            $this->db->commit();
            $input['id'] = $id;
            return $response->withJson($input);

        } catch(PDOException $e) {
            // roll back transaction
            $this->db->rollback();
            //return $response->write($e);
            return $response->withStatus(500);
            // log any errors to file
            ExceptionErrorHandler($e);
            exit;
        }
    }

    public function login($request, $response) {
        $input = $request->getParsedBody();
        $email = $input["email"];
        $password = $input["password"];
        //check email   
        $sql = "SELECT id, email, lastName, firstName, companyID FROM tb_users WHERE email =:email AND password=:password";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("email", $email);
            $stmt->bindParam("password", $password);
            $stmt->execute();
            $result = $stmt->fetchObject();
            
            return $response->withJson($result);
        } catch(PDOException $e) {
            return $response->withStatus(500);
        }
    }

    public function forgetpassword($request, $response) {
        $input = $request->getParsedBody();
        $email = $input["email"];
        
        $passwordTemp = $this->generateRandomString(6);

        $sql = "SELECT id, lastName, firstName FROM tb_users WHERE email=:email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("email", $email);
        $stmt->execute();
        if($stmt->rowCount()==0){
            return $response->withStatus(500);
        }
        $result = $stmt->fetchObject();
        $userID = $result->id;

        if($this->sendMailForgetPass($email, $passwordTemp, $userID)){
            //update db
            $stmt = $this->db->prepare("UPDATE tb_users SET passwordTemp=:passwordTemp WHERE email=:email");
            $stmt->bindParam("passwordTemp", $passwordTemp);
            $stmt->bindParam("email", $email);
            $stmt->execute();

            return $response->withJson($input);
        }
        else{
            return $response->withStatus(500);
        }
    }

    //update password
    public function updatePassword($request, $response) {
        $input = $request->getParsedBody();
        $email = $input["email"];
        $odlPassword = $input["odlPassword"];
        $newPassword = $input["newPassword"];

        $sql = "SELECT id FROM tb_users WHERE email=:email AND password=:odlPassword";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("email", $email);
        $stmt->bindParam("odlPassword", $odlPassword);
        $stmt->execute();
        if($stmt->rowCount()==0){
            return $response->withStatus(500);
        }

        $this->db->beginTransaction();
        try {
            //update db
            $stmt = $this->db->prepare("UPDATE tb_users SET password=:newPassword WHERE email=:email");
            $stmt->bindParam("newPassword", $newPassword);
            $stmt->bindParam("email", $email);
            $stmt->execute();
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
        return $response->withStatus(200);
    }

    // check password
    public function checkPasswordTemp($request, $response) {
        $input = $request->getParsedBody();
        $userID = $input["userID"];
        $password = $input["password"];
        //check email
        $sql = "SELECT id 
                FROM tb_users 
                WHERE id =:userID AND passwordTemp=:password";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("userID", $userID);
            $stmt->bindParam("password", $password);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $input["result"]=true;
            } else{
                $input["result"]=false;
            }
            
            return $response->withJson($input);
        } catch(PDOException $e) {
            return $response->withStatus(500);
        }
    }

    // Search users with name
    public function seachUsersWithName($request, $response, $args) {
        $keySearch= isset($args['name'])? $args['name'] : "";
        try{
            $sql = "SELECT id, lastName, firstName 
                    FROM tb_users 
                    WHERE UPPER(lastName) LIKE :lastName OR UPPER(firstName) LIKE :firstName 
                    ORDER BY lastName, firstName ";
            
            $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
            $offset= isset($_GET['offset']) ? $_GET['offset'] : 0;
            if($limit>0){
                $sql .= "LIMIT $limit OFFSET $offset ";
            }
    
            $stmt = $this->db->prepare($sql);
            $query = "%".$keySearch."%";
            $stmt->bindParam("lastName", $query);
            $stmt->bindParam("firstName", $query);
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

    function sendMailForgetPass($email, $passwordTemp, $userID){
        // mb_language("Japanese");
        // mb_internal_encoding("utf-8");
    
        //宛先
        $to = $email;
        //差出人
        $header = "From: noreply@shinsjs.com";
        //$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
        //$header .= "MIME-Version: 1.0\r\n";
        //$header .= "Content-Type: text/html; charset=utf-8\r\n";
        //件名
        $subject = "パスワード再設定のお知らせ";
    
        ////////////
        $body = "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" . "\r\n";
        $body .= "ジバング－運営事務局". "\r\n";
        $body .= "パスワードをお忘れの方". "\r\n";
        $body .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━" . "\r\n";
        $body .= "パスワード: ".$passwordTemp."\r\n";
        $body .= "パスワード再設定: http://localhost:8080/forgetpass/".$userID."\r\n";
        
        //if(mb_send_mail($to,$subject,$body,$header)){
        if(mail($to,$subject,$body,$header)){
            return true;
        }else {
            return false;
        }
    }

    //Get user by userId
    public function getUserById($request, $response, $args) {
        $userID = $args['id'];

        //get user
        $sql = "SELECT `id`, `lastName`, `firstName`, `email`, `password`, `companyID`  
                FROM tb_users 
                WHERE id=:userID 
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("userID", $userID);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    // update info user
    public function updateInfoUser($request, $response) {
        $input = $request->getParsedBody();
        
        $userID = $input['userID'];
        $lastName = isset($input['lastName'])? $input['lastName'] : '';
        $firstName = isset($input['firstName'])? $input['firstName'] : '';
        $email = $input['email'];
        $password = isset($input['password'])? $input['password'] : '';
        $companyID = isset($input['password'])? $input['password'] : '';
        
        $this->db->beginTransaction();
        try {
            if($password!='' || $lastName!='' || $firstName!=''){
                //update password
                if($lastName=='' && $firstName==''){
                    $sql = "UPDATE tb_users 
                        SET password=:password, passwordTemp='' 
                        WHERE id=:userID";
                
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam("password", $password);
                    $stmt->bindParam("userID", $userID);
                    $stmt->execute();
                    $this->db->commit();
                    return $response->withJson($input);
                }

                $sql = "UPDATE tb_users 
                        SET lastName=:lastName, firstName=:firstName, password=:password, companyID=:companyID 
                        WHERE id=:userID";
                
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("lastName", $lastName);
                $stmt->bindParam("firstName", $firstName);
                $stmt->bindParam("password", $password);
                $stmt->bindParam("companyID", $companyID);
                $stmt->bindParam("userID", $userID);
                $stmt->execute();        

                $this->db->commit();
                return $response->withJson($input);
            }
            
            

            return $response->withStatus(500);
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

    function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    //get all user
    public function getAllUser($request, $response, $args) {
        try{
            $sql = "SELECT id AS userId, lastName, firstName, tb_users.companyID, companyDisplayName, group_id, email  
                    FROM tb_users 
                    LEFT JOIN (SELECT companyId, companyDisplayName FROM tb_company) AS tb_company 
                      ON tb_company.companyId = tb_users.companyID 
                    ORDER BY id ";
            
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
}