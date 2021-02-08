<?php
namespace Controllers;

class HistoryChatController
{
    private $db;

    // constructor receives container instance
    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllMessage($request, $response, $args) {
        $sender = isset($_GET['sender']) ? $_GET['sender'] : '';
        $receiver = isset($_GET['receiver']) ? $_GET['receiver'] : '';
        try{
            if($sender == '' || $receiver == ''){
                return $response->withStatus(500);
            }
            
            $sql = "SELECT sender, receiver, message, created 
                    FROM tb_history_chat 
                    WHERE (sender = :sender AND receiver = :receiver) 
                        OR (sender = :receiver AND receiver = :sender) 
                    ORDER BY created ";
            
            $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
            $offset= isset($_GET['offset']) ? $_GET['offset'] : 0;
            if($limit>0){
                $sql .= "LIMIT $limit OFFSET $offset ";
            }
    
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("sender", $sender);
            $stmt->bindParam("receiver", $receiver);
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

    // Add a new message
    public function addNewMessage($request, $response) {
        $input = $request->getParsedBody();
        $sender = $input['sender'];
        $receiver = $input['receiver'];
        $message = $input['message'];
        
        $this->db->beginTransaction();
        try {
            //insert message
            $sql = "INSERT INTO tb_history_chat (sender, receiver, message) 
                        VALUES (:sender, :receiver, :message)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("sender", $sender);
            $stmt->bindParam("receiver", $receiver);
            $stmt->bindParam("message", $message);
    
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
}