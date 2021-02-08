<?php
namespace Controllers;
use \Datetime;
use \DateTimeZone;

class SecurityController
{
    private $db;

    // constructor receives container instance
    public function __construct($db) {
        $this->db = $db;
    }

    //Get company by companyId
    public function getSecurityByEmail($request, $response, $args) {
        $email = $args['id'];
        
        //get company
        $sql = "SELECT id, ip, location, machineName, machineVer, browserName, browserVer, dateTime 
                FROM tb_security 
                WHERE email=:email AND status = 1 
                ORDER BY dateTime";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("email", $email);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        return $response->withJson($result);
    }

    // Add a new info User registry
    public function addNewSecurity($request, $response) {
        $input = $request->getParsedBody();
        $email = $input['email'];
        $ip = $input['ip'];
        $location = $input['location'];
        $machineName = $input['machineName'];
        $machineVer = $input['machineVer'];
        $browserName = $input['browserName'];
        $browserVer = $input['browserVer'];
        
        $this->db->beginTransaction();
        try {
            //insert tb_security
            $sql = "INSERT INTO tb_security (email, ip, location, machineName, machineVer, browserName, browserVer) 
                        VALUES (:email, :ip, :location, :machineName, :machineVer, :browserName, :browserVer)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("email", $email);
            $stmt->bindParam("ip", $ip);
            $stmt->bindParam("location", $location);
            $stmt->bindParam("machineName", $machineName);
            $stmt->bindParam("machineVer", $machineVer);
            $stmt->bindParam("browserName", $browserName);
            $stmt->bindParam("browserVer", $browserVer);
    
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

    // check info User access
    public function checkSecurity($request, $response) {
        $input = $request->getParsedBody();
        $userName = $input['userName'];
        $email = $input['email'];
        $ip = $input['ip'];
        $location = $input['location'];
        $machineName = $input['machineName'];
        $machineVer = $input['machineVer'];
        $browserName = $input['browserName'];
        $browserVer = $input['browserVer'];

            //delete status = 0 by email
            $stmt = $this->db->prepare("DELETE FROM tb_security WHERE email=:email AND status=0");
            $stmt->bindParam("email", $email);
            $result = $stmt->execute();

            //
            $sql = "SELECT * FROM tb_security WHERE 
                        email=:email AND status = 1 AND (ip=:ip OR (location=:location AND location <> ''))";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("email", $email);
            $stmt->bindParam("ip", $ip);
            $stmt->bindParam("location", $location);
            $stmt->execute();
            
            if($stmt->rowCount()==0){
                //insert data temp
                $codeLogin = $this->generateId(8);
                $sql = "INSERT INTO tb_security (email, ip, location, machineName, machineVer, browserName, browserVer, codeLogin) 
                            VALUES (:email, :ip, :location, :machineName, :machineVer, :browserName, :browserVer, :codeLogin)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("email", $email);
                $stmt->bindParam("ip", $ip);
                $stmt->bindParam("location", $location);
                $stmt->bindParam("machineName", $machineName);
                $stmt->bindParam("machineVer", $machineVer);
                $stmt->bindParam("browserName", $browserName);
                $stmt->bindParam("browserVer", $browserVer);
                $stmt->bindParam("codeLogin", $codeLogin);

                $stmt->execute();

                //location is different
                $this->sendMailLocationDifferent($email, $ip, $userName, $location, $machineName, $machineVer, $browserName, $browserVer, $codeLogin);
                $input['checkMail']=1;
                return $response->withJson($input);
            }

            //
            $sql = "SELECT * FROM tb_security WHERE 
                        email=:email AND status = 1 AND browserName=:browserName AND machineName=:machineName AND machineVer=:machineVer";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("email", $email);
            $stmt->bindParam("browserName", $browserName);
            $stmt->bindParam("machineName", $machineName);
            $stmt->bindParam("machineVer", $machineVer);
            $stmt->execute();

            if($stmt->rowCount()==0){
                //insert data temp
                $codeLogin = $this->generateId(8);
                $sql = "INSERT INTO tb_security (email, ip, location, machineName, machineVer, browserName, browserVer, codeLogin) 
                            VALUES (:email, :ip, :location, :machineName, :machineVer, :browserName, :browserVer, :codeLogin)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("email", $email);
                $stmt->bindParam("ip", $ip);
                $stmt->bindParam("location", $location);
                $stmt->bindParam("machineName", $machineName);
                $stmt->bindParam("machineVer", $machineVer);
                $stmt->bindParam("browserName", $browserName);
                $stmt->bindParam("browserVer", $browserVer);
                $stmt->bindParam("codeLogin", $codeLogin);

                $stmt->execute();

                //browser is different
                $this->sendMailMachineOrBrowserDifferent($email, $ip, $userName, $location, $machineName, $machineVer, $browserName, $browserVer, $codeLogin);
                $input['checkMail']=1;
                return $response->withJson($input);
            }

            $input['checkMail']=0;
            return $response->withJson($input);
    }

    // check exist info User access
    public function checkExistSecurity($request, $response) {
        $input = $request->getParsedBody();
        $email = $input['email'];
        $ip = $input['ip'];
        $location = $input['location'];
        $machineName = $input['machineName'];
        $machineVer = $input['machineVer'];
        $browserName = $input['browserName'];
        $browserVer = $input['browserVer'];

        // //
        // $sql = "SELECT * FROM tb_security WHERE 
        //             email=:email AND status = 1 AND (ip=:ip OR (location=:location AND location <> ''))";
        // $stmt = $this->db->prepare($sql);
        // $stmt->bindParam("email", $email);
        // $stmt->bindParam("ip", $ip);
        // $stmt->bindParam("location", $location);
        // $stmt->execute();
        
        // if($stmt->rowCount()>0){
        //     $result['redirectLogin']=0;
        //     return $response->withJson($result);
        // }

        //
        $sql = "SELECT * FROM tb_security WHERE 
                    email=:email AND status = 1 AND (ip=:ip OR (location=:location)) AND browserName=:browserName AND machineName=:machineName AND machineVer=:machineVer";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("email", $email);
        $stmt->bindParam("location", $location);
        $stmt->bindParam("browserName", $browserName);
        $stmt->bindParam("machineName", $machineName);
        $stmt->bindParam("machineVer", $machineVer);
        $stmt->execute();

        if($stmt->rowCount()>0){
            $result['redirectLogin']=0;
            return $response->withJson($result);
        }

        $result['redirectLogin']=1;
        return $response->withJson($result);
    }

    // check info User access
    public function checkCodeLogin($request, $response) {
        $input = $request->getParsedBody();
        $email = $input['email'];
        $codeLogin = $input['codeLogin'];
        
            $sql = "SELECT * FROM tb_security WHERE 
                        email=:email AND status = 0 AND codeLogin = :codeLogin";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("email", $email);
            $stmt->bindParam("codeLogin", $codeLogin);
            $stmt->execute();
            
            if($stmt->rowCount()>0){
                //update data
                $this->db->beginTransaction();
                try {
        
                    $sql = "UPDATE tb_security SET status = 1, codeLogin=NULL 
                            WHERE email=:email AND status = 0 AND codeLogin = :codeLogin";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam("email", $email);
                    $stmt->bindParam("codeLogin", $codeLogin);
            
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
            }

            //sai code
            return $response->withStatus(500);
    }

    // update Device
    public function updateDevice($request, $response) {
        $input = $request->getParsedBody();
        $email = $input['email'];
        $ip = $input['ip'];
        $location = $input['location'];
        $machineName = $input['machineName'];
        $machineVer = $input['machineVer'];
        $browserName = $input['browserName'];
        $browserVer = $input['browserVer'];
        
        $this->db->beginTransaction();
        try {
            //update tb_security

            $sql = "UPDATE tb_security SET ip=:ip, location=:location, machineName=:machineName, machineVer=:machineVer, browserName=:browserName, browserVer=:browserVer 
                    WHERE email=:email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("email", $email);
            $stmt->bindParam("ip", $ip);
            $stmt->bindParam("location", $location);
            $stmt->bindParam("machineName", $machineName);
            $stmt->bindParam("machineVer", $machineVer);
            $stmt->bindParam("browserName", $browserName);
            $stmt->bindParam("browserVer", $browserVer);
    
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
    }

    // delete Security With Id
    public function deleteSecurityWithId($request, $response, $args) {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare("DELETE FROM tb_security WHERE id=:id");
            $stmt->bindParam("id", $args['id']);
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

    // delete Security With Id
    public function deleteSecurityWithEmail($request, $response, $args) {
        $input = $request->getParsedBody();
        $email = $input['email'];
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare("DELETE FROM tb_security WHERE email=:email");
            $stmt->bindParam("email", $email);
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

    function sendMailLocationDifferent($email, $ip, $userName, $location, $machineName, $machineVer, $browserName, $browserVer, $codeLogin){
        // mb_language("Japanese");
        // mb_internal_encoding("utf-8");
        
        $date = new DateTime("now", new DateTimeZone('Asia/Tokyo') );
        $date = $date->format('Y年m月d日 H時i分');
        //$date = date('Y年m月d日 H時i分');

        //宛先
        $to = $email;
        //差出人
        $header = "From: noreply@shinsjs.com\r\n";
        //$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-Type: text/html; charset=utf-8\r\n";
        //件名
        $subject = "SJS 2.0 Security";
    
        ////////////

        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">

            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>SJS</title>
                <style type="text/css">
                    body {
                        margin: 0;
                        padding: 0;
                        min-width: 100%!important;
                        margin: 0 auto;
                        font-size: 16px;
                        font-family: sans-serif;
                    }
                    
                    .content {
                        width: 100%;
                        max-width: 600px;
                    }
                    
                    img {
                        height: auto;
                    }
                    ._button_{
                        width: 430px;
                        height: 40px;
                        color: white;
                        background-color: #007B76;
                        padding-top: 20px;
                        margin-left: 40px;
                    }
                    a {
                        text-decoration: none;
                    }
                    
                    @media only screen and (min-device-width: 601px) {
                        .content {
                            width: 600px !important;
                        }
                    }

                </style>
            </head>

            <body yahoo bgcolor="#cbcbcb">
                <table border="1" cellpadding="0" cellspacing="0" style="width: 600px; height: 100%; margin: 10px auto; background-color: white;">
                    <tr>
                        <td>

                            <table class="content" align="center" cellpadding="0" cellspacing="20" border="0" style="width: 540px; margin: 10px auto; font-size: 14px;
                                                        padding: 20px; background-color: white;">
                                <tr>
                                    <td align="left">'.$userName.'さま<br /><br /> 
                                        SJS2.0 は、 '.$userName.'様の登録時と<span style="color: red;">異なる場所</span>からのサイン・オンを検知しました。登録情報を更新してください。
                                        <br />
                                    </td>
                                </tr>

                                <tr>
                                    <td align="left">
                                        <div style="margin-left: 65px;">
                                            日時：　'.$date.'<br />
                                            場所：　'.$location.'（ geolocation から）<br /> 
                                            デバイス：　'.$machineName.'　'.$machineVer.' <br />
                                        </div><br />
                                    </td>
                                </tr>

                                <tr>
                                    <td align="center" height="60px">
                                        <a href="https://jibannet-dev.com/changepass/'.$email.'" target="_blank">
                                        <div class="_button_">
                                        私ではありません。パスワードを変更します
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" height="60px">
                                        <a href="https://jibannet-dev.com/updatedevice?email='.$email.'&ip='.$ip.'&location='.$location.'&machineName='.$machineName.'&machineVer='.$machineVer.'&browserName='.$browserName.'&browserVer='.$browserVer.'&codeLogin='.$codeLogin.'" target="_blank">
                                        <div class="_button_">
                                        私です。この場所を追加してください
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="font-size: 11px; ">
                                        <hr /> 地盤ネット株式会社　情報システム部
                                        <br /> 住所　email <br />
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>

            </html>';
        
        //if(mb_send_mail($to,$subject,$body,$header)){
        if(mail($to,$subject,$body,$header)){
            return true;
        }else {
            return false;
        }
    }

    function sendMailMachineOrBrowserDifferent($email, $ip, $userName, $location, $machineName, $machineVer, $browserName, $browserVer, $codeLogin){
        // mb_language("Japanese");
        // mb_internal_encoding("utf-8");
        $date = new DateTime("now", new DateTimeZone('Asia/Tokyo') );
        $date = $date->format('Y年m月d日 H時i分');
        //宛先
        $to = $email;
        //差出人
        $header = "From: noreply@shinsjs.com\r\n";
        //$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-Type: text/html; charset=utf-8\r\n";
        //件名
        $subject = "SJS 2.0 Security";
    
        ////////////
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>SJS</title>
            <style type="text/css">
                body {
                    margin: 0;
                    padding: 0;
                    min-width: 100%!important;
                    margin: 0 auto;
                    font-size: 16px;
                    font-family: sans-serif;
                }
                
                .content {
                    width: 100%;
                    max-width: 600px;
                }
                
                img {
                    height: auto;
                }
                ._button_{
                    width: 430px;
                    height: 40px;
                    color: white;
                    background-color: #007B76;
                    padding-top: 20px;
                    margin-left: 40px;
                }
                a {
                    text-decoration: none;
                }
                
                @media only screen and (min-device-width: 601px) {
                    .content {
                        width: 600px !important;
                    }
                }

            </style>
        </head>

        <body yahoo bgcolor="#cbcbcb">
            <table border="1" cellpadding="0" cellspacing="0" style="width: 600px; height: 100%; margin: 10px auto; background-color: white;">
                <tr>
                    <td>

                        <table class="content" align="center" cellpadding="0" cellspacing="20" border="0" style="width: 540px; margin: 10px auto; font-size: 14px;
                                                    padding: 20px; background-color: white;">
                            <tr>
                                <td align="left">'.$userName.'さま<br /><br /> 
                                    SJS2.0 は、 '.$userName.'様の登録時と<span style="color: red;">異なるデバイス</span>からのサイン・オンを検知しました。登録情報を更新してください。
                                    <br />
                                </td>
                            </tr>

                            <tr>
                                <td align="left">
                                    <div style="margin-left: 65px;">
                                        日時：　'.$date.'<br />
                                        場所：　'.$location.'（ geolocation から）<br /> 
                                        デバイス：　'.$machineName.'　'.$machineVer.' <br />
                                    </div><br />
                                </td>
                            </tr>

                            <tr>
                                <td align="center" height="60px">
                                    <a href="https://jibannet-dev.com/changepass/'.$email.'" target="_blank">
                                    <div class="_button_">
                                    私ではありません。パスワードを変更します
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" height="60px">
                                <a href="https://jibannet-dev.com/updatedevice?email='.$email.'&ip='.$ip.'&location='.$location.'&machineName='.$machineName.'&machineVer='.$machineVer.'&browserName='.$browserName.'&browserVer='.$browserVer.'&codeLogin='.$codeLogin.'" target="_blank">
                                <div class="_button_">
                                私です。この場所を追加してください
                                    </div>
                                </a>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size: 11px; ">
                                    <hr /> 地盤ネット株式会社　情報システム部
                                    <br /> 住所　email <br />
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
        </body>

        </html>';
        
        
        // if(mb_send_mail($to,$subject,$body,$header)){
        if(mail($to,$subject,$body,$header)){
            return true;
        }else {
            return false;
        }
    }

    function generateId($l = 8){
        $date = new DateTime();
        $result = $date->format('Y-m-d H:i:s');
        $str = $this->generateRandomString().$result;
        return substr(MD5($str),0 , $l);
    }
    
    function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}