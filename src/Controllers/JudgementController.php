<?php
namespace Controllers;

class JudgementController
{
    private $db;

    // constructor receives container instance
    public function __construct($db) {
        $this->db = $db;
    }

    // //Get Ground Survey Report by Id
    // public function getGroundSurveyReportById($request, $response, $args) {
    //     $survey_id = $args['id'];
        
    //     //get Survey
    //     $sql = "SELECT id, survey_id, id_ground_survey_report, userId, permission_range, last_display, author, edit_permission_range, status, ground_safe_house_app_ID, survey_ordering_company, ordering_person 
    //             FROM tb_ground_survey_report 
    //             WHERE survey_id=:survey_id";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bindParam("survey_id", $survey_id);
    //     $stmt->execute();
    //     $result = $stmt->fetchObject();
        
    //     return $response->withJson($result);
    // }

    //Get Judgement by Id
    public function getJudgementById($request, $response, $args) {
        $survey_id = $args['id'];
        
        //get Survey
        $sql = "SELECT id, survey_id, status, survey_data_topography, surrounding_situation, creation_status, ground_surface 
                FROM tb_judgement  
                WHERE survey_id=:survey_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("survey_id", $survey_id);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    // Add a new Judgement
    public function addNewJudgement($request, $response) {
        $input = $request->getParsedBody();
        $survey_id = $input['survey_id'];
        
        $status = $input['status'];
        $survey_data_topography = $input['survey_data_topography'];
        $surrounding_situation = $input['surrounding_situation'];
        $creation_status = $input['creation_status'];
        $ground_surface = $input['ground_surface'];
        
        $this->db->beginTransaction();
        try {
            //insert
            $sql = "INSERT INTO tb_judgement (survey_id, status, survey_data_topography, surrounding_situation, creation_status, ground_surface) 
                        VALUES (:survey_id, :status, :survey_data_topography, :surrounding_situation, :creation_status, :ground_surface)";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam('survey_id', $survey_id);

            $stmt->bindParam('status', $status);
            $stmt->bindParam('survey_data_topography', $survey_data_topography);
            $stmt->bindParam('surrounding_situation', $surrounding_situation);
            $stmt->bindParam('creation_status', $creation_status);
            $stmt->bindParam('ground_surface', $ground_surface);
             
    
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

    // Update Judgement with Id
    public function updateJudgementWithId($request, $response, $args) {
        $input = $request->getParsedBody();
        $survey_id = $args['id'];
        
        $status = $input['status'];
        $survey_data_topography = $input['survey_data_topography'];
        $surrounding_situation = $input['surrounding_situation'];
        $creation_status = $input['creation_status'];
        $ground_surface = $input['ground_surface'];

        $this->db->beginTransaction();
        try {
            $sql = "UPDATE tb_judgement SET status=:status, survey_data_topography=:survey_data_topography, surrounding_situation=:surrounding_situation, 
                            creation_status=:creation_status, ground_surface=:ground_surface 
                    WHERE survey_id=:survey_id";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam('survey_id', $survey_id);

            $stmt->bindParam('status', $status);
            $stmt->bindParam('survey_data_topography', $survey_data_topography);
            $stmt->bindParam('surrounding_situation', $surrounding_situation);
            $stmt->bindParam('creation_status', $creation_status);
            $stmt->bindParam('ground_surface', $ground_surface);
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
}