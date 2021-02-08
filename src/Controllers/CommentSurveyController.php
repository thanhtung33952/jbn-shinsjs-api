<?php
namespace Controllers;

class CommentSurveyController
{
    private $db;

    // constructor receives container instance
    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllComment($request, $response, $args) {
        $surveyId = isset($_GET['surveyId']) ? $_GET['surveyId'] : '';
        try{
            if($surveyId == ''){
                return $response->withStatus(500);
            }
            //get total
            //get Survey
            $sql = "SELECT count(*) as total 
                    FROM tb_comment_survey 
                    WHERE surveyId = :surveyId";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("surveyId", $surveyId);
            $stmt->execute();
            $result = $stmt->fetchObject();

            $sql = "SELECT tb_comment_survey.id, surveyId, userId, tb_users.name, comment, created 
                    FROM tb_comment_survey 
                    INNER JOIN (SELECT id, CONCAT(lastName,' ',firstName) AS name FROM tb_users) AS tb_users 
                        ON tb_comment_survey.userId = tb_users.id 
                    WHERE (surveyId = :surveyId) 
                    ORDER BY created DESC ";
            
            $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
            $offset= isset($_GET['offset']) ? $_GET['offset'] : 0;
            if($limit>0){
                $sql .= "LIMIT $limit OFFSET $offset ";
            }
    
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("surveyId", $surveyId);
            $stmt->execute();
            $result->details = $stmt->fetchAll();
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

    // Add a new comment
    public function addNewComment($request, $response) {
        $input = $request->getParsedBody();
        $surveyId = $input['surveyId'];
        $userId = $input['userId'];
        $comment = $input['comment'];
        
        $this->db->beginTransaction();
        try {
            //insert comment
            $sql = "INSERT INTO tb_comment_survey (surveyId, userId, comment) 
                        VALUES (:surveyId, :userId, :comment)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("surveyId", $surveyId);
            $stmt->bindParam("userId", $userId);
            $stmt->bindParam("comment", $comment);
    
            $stmt->execute();
            $input['id'] = $this->db->lastInsertId();
            
            // delete notify
            $stmt = $this->db->prepare("DELETE FROM tb_inbox WHERE id=:surveyId AND flag=1");
            $stmt->bindParam("surveyId", $surveyId);
            $result = $stmt->execute();

            $userId_target = null;
            $group_target = null;
            
            //check user
            $sql = "SELECT userId FROM tb_survey WHERE userId=:userId AND id=:surveyId";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("userId", $userId);
            $stmt->bindParam("surveyId", $surveyId);
            $stmt->execute();
            $result = $stmt->fetchObject();
            if($stmt->rowCount()> 0){
                //check COMPANY
                $sql = "SELECT scheduled_survey_company_id as companyID FROM tb_survey WHERE id=:surveyId";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("surveyId", $surveyId);
                $stmt->execute();
                $result = $stmt->fetchObject();
                $group_target = $result->companyID;
            } else{
                $sql = "SELECT userId FROM tb_survey WHERE id=:surveyId";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("surveyId", $surveyId);
                $stmt->execute();
                $result = $stmt->fetchObject();
                $userId_target = $result->userId;
            }
            
            //insert
            $sql = "INSERT INTO tb_inbox (flag, id, userId_target, group_target) 
                        VALUES (1, :id, :userId_target, :group_target)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('id', $surveyId);
            $stmt->bindParam('userId_target', $userId_target);
            $stmt->bindParam('group_target', $group_target);
    
            $stmt->execute();
            $survey_info_id = $this->db->lastInsertId();
        
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

    // Update comment with companyId
    public function updateCommentWithId($request, $response, $args) {
        $input = $request->getParsedBody();
        $id = $args['id'];
        $userId = $input['userId'];
        $comment = $input['comment'];
        
        $this->db->beginTransaction();
        try {
            $sql = "UPDATE tb_comment_survey 
                    SET comment = :comment 
                    WHERE id=:id AND userId=:userId";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("comment", $comment);
            $stmt->bindParam("id", $id);
            $stmt->bindParam("userId", $userId);
            
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

    // delete a comment
    public function deleteComment($request, $response, $args) {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare("DELETE FROM tb_comment_survey WHERE  id=:id");
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
}