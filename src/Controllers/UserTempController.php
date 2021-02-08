<?php
namespace Controllers;
use DateTime;
class UserTempController
{
    private $db;

    // constructor receives container instance
    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllUser($request, $response, $args) {
        try{
            $sql = "SELECT id, email, lastName, firstName, password, status 
                    FROM tb_user_temp 
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

    //Get user by userId
    public function getUserByUserId($request, $response, $args) {
        $userId = $args['id'];
        
        //get user
        $sql = "SELECT id, email, lastName, firstName, password, status 
                FROM tb_user_temp WHERE id=:userId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("userId", $userId);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    // Add a new user
    public function addNewUser($request, $response) {
        $input = $request->getParsedBody();
        $userId = $this->generateId();
        $email = $input['email'];
        $lastName = isset($input['lastName']) ? $input['lastName'] : NULL;
        $firstName = $input['firstName'];
        $companyName = $input['companyName'];
        
        $password = $this->generateRandomString(10);
        // $status = $input['status'];
        
        $this->db->beginTransaction();
        try {
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
            
            $stmt = $this->db->prepare("DELETE FROM tb_user_temp WHERE email=:email");
            $stmt->bindParam("email", $email);
            $result = $stmt->execute();
            //insert user
            $sql = "INSERT INTO tb_user_temp (id, email, lastName, firstName, password) 
                        VALUES (:id, :email, :lastName, :firstName, :password)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("id", $userId);
            $stmt->bindParam("email", $email);
            $stmt->bindParam("lastName", $lastName);
            $stmt->bindParam("firstName", $firstName);
            $stmt->bindParam("password", $password);
    
            $stmt->execute();
            $input['id'] = $userId;
            
            $this->db->commit();

            //send mail
            $input['sendMail']= $this->sendMailRegister($email, $password, $firstName, $companyName);

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

    // Update user with userId
    public function updateUserWithUserId($request, $response, $args) {
        $input = $request->getParsedBody();
        $userId = $args['id'];
        $email = $input['email'];
        $lastName = isset($input['lastName']) ? $input['lastName'] : NULL;
        $firstName = $input['firstName'];
        $password = $input['password'];
        // $status = $input['status'];
    
        $this->db->beginTransaction();
        try {
            //update user
            $stmt = $this->db->prepare("DELETE FROM tb_user_temp WHERE id=:userId");
            $stmt->bindParam("userId", $userId);
            $stmt->execute();
    
            $sql = "INSERT INTO tb_user_temp (id, email, lastName, firstName, password)  
                        VALUES (:userId, :email, :lastName, :firstName, :password)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("userId", $userId);
            $stmt->bindParam("email", $email);
            $stmt->bindParam("lastName", $lastName);
            $stmt->bindParam("firstName", $firstName);
            $stmt->bindParam("password", $password);
            $stmt->execute();
            $input['id'] = $this->db->lastInsertId();
            
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

    // delete a user with userId
    public function deleteUserWithUserId($request, $response, $args) {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare("DELETE FROM tb_user_temp WHERE id=:userId");
            $stmt->bindParam("userId", $args['id']);
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

    // check password
    public function checkPassword($request, $response, $args) {
        $input = $request->getParsedBody();
        //$userId = $input['id'];
        $password = $input['password'];

        //get user
        $sql = "SELECT *  
                FROM tb_user_temp WHERE password = :password";
        $stmt = $this->db->prepare($sql);
        //$stmt->bindParam("userId", $userId);
        $stmt->bindParam("password", $password);
        $stmt->execute();
        $result = $stmt->fetchObject();

        if($stmt->rowCount()>0){
            return $response->withJson($result);
        } else
            return $response->withJson(NULL); 
    }

    // check User Temp
    public function checkExistUserTemp($request, $response, $args) {
        $input = $request->getParsedBody();
        $userId = $input['id'];

        //get user
        $sql = "SELECT id FROM tb_users 
                INNER JOIN (SELECT email FROM tb_user_temp WHERE id=:id) AS tb_user_temp
                ON tb_users.email=tb_user_temp.email ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("id", $userId);
        $stmt->execute();
        $result = $stmt->fetchObject();

        if($stmt->rowCount()>0){
            return $response->withJson($result);
        } else
            return $response->withStatus(500);
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

    function sendMailRegister($email, $tmpPassword, $firstName, $companyName){
        // mb_language("Japanese");
        // mb_internal_encoding("utf-8");
    
        //宛先
        $to = $email;

        //差出人
        $header = "From: noreply@shinsjs.com\r\n";
        //$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-Type: text/html; charset=utf-8\r\n";
        //件名
        $subject = "取引先新規登録、登録ユーザーの確認";
    
        ////////////
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
            
        <head>
            <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
            <style type="text/css">
                a {
                    color: inherit;
                }
                
                a:hover {
                    text-decoration: underline !important;
                }
                
                table[class="col-25-percent"] {
                    width: 135px;
                }
                
                .mobile-padding {
                    font-size: 0px;
                    line-height: 0px;
                    padding: 0px;
                }
                
                .title {
                    font-size: 1.2em;
                    color: #666;
                }
                
                .bodyText {
                    color: #666;
                    padding: 0 20px;
                }
                .tmpAccount {
                    margin: 0 50px;
                }
                
                @media only screen and (max-width: 662px) {
                    body {
                        padding: 0px 10px !important;
                        box-sizing: border-box;
                    }
                    table[class="header"] img {
                        max-width: 100% !important;
                        height: auto !important;
                    }
                    table[class="container"] {
                        width: 100% !important;
                    }
                    table[class="content"] {
                        font-size: 14px !important;
                    }
                    table[class="main-content"] img {
                        height: auto !important;
                        max-width: 100% !important;
                        display: block !important;
                        margin-left: auto !important;
                        margin-right: auto !important;
                    }
                    span[class="headline"] {
                        font-size: 20px !important;
                    }
                    table[class="image-column"] {
                        width: 100% !important;
                    }
                    table[class="col-50-percent"] {
                        width: 100% !important;
                    }
                    td[class="hidable-spacer"] {
                        display: none !important;
                    }
                    td[class="mobile-padding"] {
                        height: 20px !important;
                    }
                    table[class="column-33-percent"] {
                        width: 100% !important;
                    }
                    table[class="column-33-percent"] img {
                        margin: 0px auto !important;
                        width: auto !important;
                        max-width: 100% !important;
                    }
                    table[class="column-200"] img {
                        margin: 0px auto !important;
                        float: none !important;
                    }
                    table[class="column-200"] {
                        width: 100% !important;
                        display: table !important;
                    }
                    table[class="column-398"] {
                        width: 100% !important;
                        font-size: 18px !important;
                        display: table !important;
                    }
                    table[class="column-200"] img {
                        margin: 0px auto !important;
                        max-width: 100% !important;
                        height: auto !important;
                    }
                    td[class="td"] {
                        display: table-cell !important;
                    }
                    span[class="title"] {
                        font-size: 28px !important;
                        color: red;
                    }
                }
                
                @media only screen and (max-width: 352px) {
                    table[class="col-25-percent"] img,
                    table[class="col-25-percent"] {
                        max-width: 100% !important;
                        height: auto !important;
                    }
                }
            
            </style>
            <!--[if gte mso 9]>
        <style>
        .hidable-spacer, .hidable-spacer td {
            width: 25px !important;
        }
        </style>
        <![endif]-->
            <title>SJS 2</title>
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            
        </head>
            
        <body style="margin: 0px; padding: 0px; font-family: Helvetica, Arial, sans-serif;">
            <center>
            <table border="1" cellpadding="0" cellspacing="0" style="width: 600px; height: 100%; margin: 10px auto; background-color: white;">
                    <tbody>
                        <tr>
                            <td align="center">
                                
                            <table class="content" align="center" cellpadding="0" cellspacing="20" border="0" style="width: 540px; margin: 10px auto; font-size: 14px; padding: 20px; background-color: white;">
                                    <tbody>
                                        <tr>
                                        <!-- <td align="center">
                                                <img src="https://jibannet.online/img/sjsLogo.png" width="200" /><br />
                                                <p class="title">取引先新規登録、登録ユーザーの確認</p>
            
                                            </td>
                                            -->
                                            <td>
                                                <p class="bodyText">
                                                    株式会社'.$companyName.'<br />
                                                    '.$firstName.'様
                                                    </p>
                                                <p class="bodyText">
                                                    この度はSJS2.0のご利用のお申し込みいただきありがとうございます。
                                                    <div class="tmpAccount">
                                                        確認コード：'.$tmpPassword.'
                                                    </div>
                                                </p>
                                                <p class="bodyText">
                                                    下記のURLにアクセスして本登録を行ってください。<br />
                                                <a href="https://jibannet-dev.com/company">https://jibannet-dev.com/company</a>
                                                </p>
                                                <p class="bodyText">
                                                本アドレスは送信専用です。<br />
                                                返信いただいてもお答え出来ませんので、ご注意ください。
                                            
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size: 11px; ">
                                                <hr /> 地盤ネット株式会社　情報システム部
                                                <br /> 住所　email <br />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table height="20" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td height="20" style="height:20px; font-size:0px; line-height: 0px"> </td>
                        </tr>
                    </tbody>
                </table>
            </center>
        </body>
            
        </html>';
        
        //if(mb_send_mail($to,$subject,$body,$header)){
        if(mail($to,$subject,$body,$header)){
            return true;
        }else {
            return false;
        }
    }
}