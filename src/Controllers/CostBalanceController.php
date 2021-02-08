<?php
namespace Controllers;
use \Datetime;

class CostBalanceController
{
    private $db;

    // constructor receives container instance
    public function __construct($db) {
        $this->db = $db;
    }

    //Get CostBalance by Id
    public function getCostBalanceById($request, $response, $args) {
        $id = $args['id'];
        //get content by id
        $sql = "SELECT content FROM tb_cost_balance_main WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        if($stmt->rowCount()==0){
            return $response->withStatus(500);
        }
        $result = $stmt->fetchObject();
        $content = $result->content;

        $sql = "SELECT * FROM tb_cost_balance WHERE ".$content;

        $stmt = $this->db->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetchAll();
        
        return $response->withJson($result);
    }

    //Get getCostBalanceFilter By User Id
    public function getCostBalanceFilterByUserId($request, $response, $args) {
        $userId = $args['id'];
        
        //get
        $sql = "SELECT id, content, created
                FROM tb_cost_balance_main 
                WHERE userId=:userId 
                ORDER BY created DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("userId", $userId);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        return $response->withJson($result);
    }

    //Get getCostBalanceFilter By Id
    public function getCostBalanceFilterById($request, $response, $args) {
        $id = $args['id'];
        
        //get
        $sql = "SELECT id, content, created
                FROM tb_cost_balance_main 
                WHERE id=:id ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    // check Execute Sql Cost Balance
    public function checkExecuteSqlCostBalance($request, $response) {
        $input = $request->getParsedBody();
        $content = $input['content'];
    
        $this->db->beginTransaction();
        try {
            //insert cost_balance_main
            $sql = "SELECT * FROM tb_cost_balance WHERE ".$content;
            $stmt = $this->db->prepare($sql);
            
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

    // // Execute Sql Cost Balance
    // public function executeSqlCostBalance($request, $response) {
    //     $input = $request->getParsedBody();
    //     $userId = $input['userId'];
        
    
    //     $this->db->beginTransaction();
    //     try {
    //         //insert cost_balance_main
    //         $sql = $content;
    //         $stmt = $this->db->prepare($sql);
            
    //         $stmt->execute();
    
    //         $this->db->commit();
    //         return $response->withStatus(200);
    //     }               
    //     // any errors from the above database queries will be catched
    //     catch (PDOException $e){
    //         // roll back transaction
    //         $this->db->rollback();
    //         //return $response->write($e);
    //         return $response->withStatus(500);
    //         // log any errors to file
    //         ExceptionErrorHandler($e);
    //         exit;
    //     }
    // }

    // Add a new CostBalanceFilter
    public function addNewCostBalanceFilter($request, $response) {
        $input = $request->getParsedBody();
        $userId = $input['userId'];
        $content = $input['content'];
    
        $id = $this->generateId(8);

        $this->db->beginTransaction();
        try {
            //insert cost_balance_main
            $sql = "INSERT INTO tb_cost_balance_main (id, userId, content) 
                        VALUES (:id, :userId, :content)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("id", $id);
            $stmt->bindParam("userId", $userId);
            $stmt->bindParam("content", $content);
    
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

    // update CostBalanceFilter
    public function updateNewCostBalanceFilter($request, $response, $args) {
        $input = $request->getParsedBody();
        $id = $args['id'];
        $content = $input['content'];

        $this->db->beginTransaction();
        try {
            //insert cost_balance_main
            $sql = "UPDATE tb_cost_balance_main 
                    SET content = :content 
                    WHERE id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("id", $id);
            $stmt->bindParam("content", $content);
    
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

    // delete a CostBalanceFilter with Id
    public function deleteCostBalanceFilterWithId($request, $response, $args) {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare("DELETE FROM tb_cost_balance_main WHERE id=:id");
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