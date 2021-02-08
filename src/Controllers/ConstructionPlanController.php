<?php
namespace Controllers;

class ConstructionPlanController
{
    private $db;

    // constructor receives container instance
    public function __construct($db) {
        $this->db = $db;
    }

    //Get ConstructionPlan by Id
    public function getConstructionPlanById($request, $response, $args) {
        $survey_id = $args['id'];
        
        //get Survey
        $sql = "SELECT id, survey_id, building_structure, number_of_floors, foundation_shape, foundation_area, 
                necessary_ground_strength, total_building_weight, station_number, middle_layer_soil, 
                soil_name_at_the_tip, improved_body_tip_depth, improved_ground_short_side_width, 
                outer_circumference 
                FROM tb_constructionplan  
                WHERE survey_id=:survey_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("survey_id", $survey_id);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    // Add a new ConstructionPlan
    public function addNewConstructionPlan($request, $response) {
        $input = $request->getParsedBody();
        $survey_id = $input['survey_id'];
        
        $building_structure = $input['building_structure'];
        $number_of_floors = $input['number_of_floors'];
        $foundation_shape = $input['foundation_shape'];
        $foundation_area = $input['foundation_area'];
        $necessary_ground_strength = $input['necessary_ground_strength'];
        $total_building_weight = $input['total_building_weight'];
        $station_number = $input['station_number'];
        $middle_layer_soil = $input['middle_layer_soil'];
        $soil_name_at_the_tip = $input['soil_name_at_the_tip'];
        $improved_body_tip_depth = $input['improved_body_tip_depth'];
        $improved_ground_short_side_width = $input['improved_ground_short_side_width'];
        $outer_circumference = $input['outer_circumference'];
        
        $this->db->beginTransaction();
        try {
            //insert
            $sql = "INSERT INTO tb_constructionplan (survey_id, building_structure, number_of_floors, foundation_shape, foundation_area, 
                                necessary_ground_strength, total_building_weight, station_number, middle_layer_soil, 
                                soil_name_at_the_tip, improved_body_tip_depth, improved_ground_short_side_width, 
                                outer_circumference) 
                        VALUES (:survey_id, :building_structure, :number_of_floors, :foundation_shape, :foundation_area, 
                                :necessary_ground_strength, :total_building_weight, :station_number, :middle_layer_soil, 
                                :soil_name_at_the_tip, :improved_body_tip_depth, :improved_ground_short_side_width, 
                                :outer_circumference)";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam('survey_id', $survey_id);

            $stmt->bindParam('building_structure', $building_structure);
            $stmt->bindParam('number_of_floors', $number_of_floors);
            $stmt->bindParam('foundation_shape', $foundation_shape);
            $stmt->bindParam('foundation_area', $foundation_area);
            $stmt->bindParam('necessary_ground_strength', $necessary_ground_strength);
            $stmt->bindParam('total_building_weight', $total_building_weight);
            $stmt->bindParam('station_number', $station_number);
            $stmt->bindParam('middle_layer_soil', $middle_layer_soil);
            $stmt->bindParam('soil_name_at_the_tip', $soil_name_at_the_tip);
            $stmt->bindParam('improved_body_tip_depth', $improved_body_tip_depth);
            $stmt->bindParam('improved_ground_short_side_width', $improved_ground_short_side_width);
            $stmt->bindParam('outer_circumference', $outer_circumference);
             
    
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

    // Update ConstructionPlan with Id
    public function updateConstructionPlanWithId($request, $response, $args) {
        $input = $request->getParsedBody();
        $survey_id = $args['id'];
        
        $status = $input['status'];
        $survey_data_topography = $input['survey_data_topography'];
        $surrounding_situation = $input['surrounding_situation'];
        $creation_status = $input['creation_status'];
        $ground_surface = $input['ground_surface'];

        $this->db->beginTransaction();
        try {
            $sql = "UPDATE tb_constructionplan SET building_structure=:building_structure, number_of_floors=:number_of_floors, foundation_shape=:foundation_shape, foundation_area=:foundation_area, 
            necessary_ground_strength=:necessary_ground_strength, total_building_weight=:total_building_weight, station_number=:station_number, middle_layer_soil=:middle_layer_soil, 
            soil_name_at_the_tip=:soil_name_at_the_tip, improved_body_tip_depth=:improved_body_tip_depth, improved_ground_short_side_width=:improved_ground_short_side_width, 
            outer_circumference=:outer_circumference 
                    WHERE survey_id=:survey_id";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam('survey_id', $survey_id);

            $stmt->bindParam('building_structure', $building_structure);
            $stmt->bindParam('number_of_floors', $number_of_floors);
            $stmt->bindParam('foundation_shape', $foundation_shape);
            $stmt->bindParam('foundation_area', $foundation_area);
            $stmt->bindParam('necessary_ground_strength', $necessary_ground_strength);
            $stmt->bindParam('total_building_weight', $total_building_weight);
            $stmt->bindParam('station_number', $station_number);
            $stmt->bindParam('middle_layer_soil', $middle_layer_soil);
            $stmt->bindParam('soil_name_at_the_tip', $soil_name_at_the_tip);
            $stmt->bindParam('improved_body_tip_depth', $improved_body_tip_depth);
            $stmt->bindParam('improved_ground_short_side_width', $improved_ground_short_side_width);
            $stmt->bindParam('outer_circumference', $outer_circumference);
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