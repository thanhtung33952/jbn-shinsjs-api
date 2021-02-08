<?php
namespace Controllers;

class SurveyChatController
{
    private $db;

    // constructor receives container instance
    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllMessage($request, $response, $args) {
        $survey_id = isset($_GET['survey_id']) ? $_GET['survey_id'] : '';
        //$receiver = isset($_GET['receiver']) ? $_GET['receiver'] : '';
        try{
            $sql = "SELECT sender, lastName, firstName, is_builder, message, created 
                    FROM tb_survey_chat 
                    LEFT JOIN (SELECT id, lastName, firstName FROM tb_users) AS tb_users 
                        ON tb_users.id = tb_survey_chat.sender 
                    WHERE survey_id = :survey_id 
                    ORDER BY created ";
            
            $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
            $offset= isset($_GET['offset']) ? $_GET['offset'] : 0;
            if($limit>0){
                $sql .= "LIMIT $limit OFFSET $offset ";
            }
    
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("survey_id", $survey_id);
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
        $survey_id = $input['survey_id'];
        $sender = $input['sender'];
        //$receiver = $input['receiver'];
        $is_builder = $input['is_builder']; // 1: is builder , 0: chousa
        $message = $input['message'];
        
        $this->db->beginTransaction();
        try {
            //insert message
            $sql = "INSERT INTO tb_survey_chat (survey_id, sender, is_builder, message) 
                        VALUES (:survey_id, :sender, :is_builder, :message)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("survey_id", $survey_id);
            $stmt->bindParam("sender", $sender);
            $stmt->bindParam("is_builder", $is_builder);
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