<?php
namespace Controllers;

class GroundSurveyReportController
{
    private $db;

    // constructor receives container instance
    public function __construct($db) {
        $this->db = $db;
    }

    //Get Ground Survey Report by Id
    public function getGroundSurveyReportById($request, $response, $args) {
        $survey_id = $args['id'];
        
        //get Survey
        $sql = "SELECT id, survey_id, id_ground_survey_report, userId, permission_range, last_display, author, edit_permission_range, status, ground_safe_house_app_ID, survey_ordering_company, ordering_person 
                FROM tb_ground_survey_report 
                WHERE survey_id=:survey_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("survey_id", $survey_id);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    //Get Ground Survey Report 1 And 2 by Id
    public function getGroundSurveyReport1And2ById($request, $response, $args) {
        $id_ground_survey_report = $args['id'];
        
        //get Survey
        $sql = "SELECT id, property_name, survey_site, survey_date, survey_equipment, person_in_charge, id_ground_survey_report 
                FROM tb_ground_survey_report_1_2  
                WHERE id_ground_survey_report=:id_ground_survey_report";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("id_ground_survey_report", $id_ground_survey_report);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    // Add a new Ground Survey Report 1 And 2
    public function addNewGroundSurveyReport1And2($request, $response) {
        $input = $request->getParsedBody();
        $id_ground_survey_report = $input['id_ground_survey_report'];
        
        $property_name = $input['property_name'];
        $survey_site = $input['survey_site'];
        $survey_date = $input['survey_date'];
        $survey_equipment = $input['survey_equipment'];
        $person_in_charge = $input['person_in_charge'];
        
        $this->db->beginTransaction();
        try {
            //insert
            $sql = "INSERT INTO tb_ground_survey_report_1_2 (id_ground_survey_report, property_name, survey_site, survey_date, survey_equipment, person_in_charge) 
                        VALUES (:id_ground_survey_report, :property_name, :survey_site, :survey_date, :survey_equipment, :person_in_charge)";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam('id_ground_survey_report', $id_ground_survey_report);

            $stmt->bindParam('property_name', $property_name);
            $stmt->bindParam('survey_site', $survey_site);
            $stmt->bindParam('survey_date', $survey_date);
            $stmt->bindParam('survey_equipment', $survey_equipment);
            $stmt->bindParam('person_in_charge', $person_in_charge);
             
    
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

    // Update Ground Survey Report 1 And 2 with Id
    public function updateGroundSurveyReport1And2WithId($request, $response, $args) {
        $input = $request->getParsedBody();
        $id_ground_survey_report = $args['id'];
        
        $property_name = $input['property_name'];
        $survey_site = $input['survey_site'];
        $survey_date = $input['survey_date'];
        $survey_equipment = $input['survey_equipment'];
        $person_in_charge = $input['person_in_charge'];

        $this->db->beginTransaction();
        try {
            $sql = "UPDATE tb_ground_survey_report_1_2 SET property_name=:property_name, survey_site=:survey_site, survey_date=:survey_date, survey_equipment=:survey_equipment, person_in_charge=:person_in_charge  
                    WHERE id_ground_survey_report=:id_ground_survey_report";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam('id_ground_survey_report', $id_ground_survey_report);

            $stmt->bindParam('property_name', $property_name);
            $stmt->bindParam('survey_site', $survey_site);
            $stmt->bindParam('survey_date', $survey_date);
            $stmt->bindParam('survey_equipment', $survey_equipment);
            $stmt->bindParam('person_in_charge', $person_in_charge);
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


    //************************************************* */
    //Get Ground Survey Report 4 by Id
    public function getGroundSurveyReport4ById($request, $response, $args) {
        $id_ground_survey_report = $args['id'];
        
        //get Survey
        $sql = "SELECT id, temporary_address, final_address, coordinates, id_ground_survey_report 
                FROM tb_ground_survey_report_4  
                WHERE id_ground_survey_report=:id_ground_survey_report";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("id_ground_survey_report", $id_ground_survey_report);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    // Add a new Ground Survey Report 4
    public function addNewGroundSurveyReport4($request, $response) {
        $input = $request->getParsedBody();
        $id_ground_survey_report = $input['id_ground_survey_report'];
        
        $temporary_address = $input['temporary_address'];
        $final_address = $input['final_address'];
        $coordinates = $input['coordinates'];
        
        $this->db->beginTransaction();
        try {
            //insert
            $sql = "INSERT INTO tb_ground_survey_report_4 (id_ground_survey_report, temporary_address, final_address, coordinates) 
                        VALUES (:id_ground_survey_report, :temporary_address, :final_address, :coordinates)";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam('id_ground_survey_report', $id_ground_survey_report);

            $stmt->bindParam('temporary_address', $temporary_address);
            $stmt->bindParam('final_address', $final_address);
            $stmt->bindParam('coordinates', $coordinates);
    
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

    // Update Ground Survey Report 4 with Id
    public function updateGroundSurveyReport4WithId($request, $response, $args) {
        $input = $request->getParsedBody();
        $id_ground_survey_report = $args['id'];
        
        $temporary_address = $input['temporary_address'];
        $final_address = $input['final_address'];
        $coordinates = $input['coordinates'];

        $this->db->beginTransaction();
        try {
            $sql = "UPDATE tb_ground_survey_report_4 SET temporary_address=:temporary_address, final_address=:final_address, coordinates=:coordinates  
                    WHERE id_ground_survey_report=:id_ground_survey_report";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam('id_ground_survey_report', $id_ground_survey_report);

            $stmt->bindParam('temporary_address', $temporary_address);
            $stmt->bindParam('final_address', $final_address);
            $stmt->bindParam('coordinates', $coordinates);
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


    //************************************************* */
    //Get Ground Survey Report 5 by Id
    public function getGroundSurveyReport5ById($request, $response, $args) {
        $id_ground_survey_report = $args['id'];
        
        //get Survey
        $sql = "SELECT id, file, e_adjacent_ground_level_difference, e_retaining_wall, e_type, e_distance, 
                                w_adjacent_ground_level_difference, w_retaining_wall, w_type, w_distance, 
                                s_adjacent_ground_level_difference, s_retaining_wall, s_type, s_distance, 
                                n_adjacent_ground_level_difference, n_retaining_wall, n_type, n_distance
                FROM tb_ground_survey_report_5  
                WHERE id_ground_survey_report=:id_ground_survey_report";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("id_ground_survey_report", $id_ground_survey_report);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    // Add a new Ground Survey Report 5
    public function addNewGroundSurveyReport5($request, $response) {
        $input = $request->getParsedBody();
        $id_ground_survey_report = $input['id_ground_survey_report'];
        
        $file = $input['file'];
        $e_adjacent_ground_level_difference = $input['e_adjacent_ground_level_difference'];
        $e_retaining_wall = $input['e_retaining_wall'];
        $e_type = $input['e_type'];
        $e_distance = $input['e_distance'];

        $w_adjacent_ground_level_difference = $input['w_adjacent_ground_level_difference'];
        $w_retaining_wall = $input['w_retaining_wall'];
        $w_type = $input['w_type'];
        $w_distance = $input['w_distance'];

        $s_adjacent_ground_level_difference = $input['s_adjacent_ground_level_difference'];
        $s_retaining_wall = $input['s_retaining_wall'];
        $s_type = $input['s_type'];
        $s_distance = $input['s_distance'];

        $n_adjacent_ground_level_difference = $input['n_adjacent_ground_level_difference'];
        $n_retaining_wall = $input['n_retaining_wall'];
        $n_type = $input['n_type'];
        $n_distance = $input['n_distance'];
        
        $this->db->beginTransaction();
        try {
            //insert
            $sql = "INSERT INTO tb_ground_survey_report_5 (id_ground_survey_report, file, e_adjacent_ground_level_difference, e_retaining_wall, e_type, e_distance, 
                                                                                        w_adjacent_ground_level_difference, w_retaining_wall, w_type, w_distance, 
                                                                                        s_adjacent_ground_level_difference, s_retaining_wall, s_type, s_distance, 
                                                                                        n_adjacent_ground_level_difference, n_retaining_wall, n_type, n_distance) 
                        VALUES (:id_ground_survey_report, :file, :e_adjacent_ground_level_difference, :e_retaining_wall, :e_type, :e_distance, 
                                                                :w_adjacent_ground_level_difference, :w_retaining_wall, :w_type, :w_distance, 
                                                                :s_adjacent_ground_level_difference, :s_retaining_wall, :s_type, :s_distance, 
                                                                :n_adjacent_ground_level_difference, :n_retaining_wall, :n_type, :n_distance)";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam('id_ground_survey_report', $id_ground_survey_report);

            $stmt->bindParam('file', $file);
            $stmt->bindParam('e_adjacent_ground_level_difference', $e_adjacent_ground_level_difference);
            $stmt->bindParam('e_retaining_wall', $e_retaining_wall);
            $stmt->bindParam('e_type', $e_type);
            $stmt->bindParam('e_distance', $e_distance);

            $stmt->bindParam('w_adjacent_ground_level_difference', $w_adjacent_ground_level_difference);
            $stmt->bindParam('w_retaining_wall', $w_retaining_wall);
            $stmt->bindParam('w_type', $w_type);
            $stmt->bindParam('w_distance', $w_distance);

            $stmt->bindParam('s_adjacent_ground_level_difference', $s_adjacent_ground_level_difference);
            $stmt->bindParam('s_retaining_wall', $s_retaining_wall);
            $stmt->bindParam('s_type', $s_type);
            $stmt->bindParam('s_distance', $s_distance);

            $stmt->bindParam('n_adjacent_ground_level_difference', $n_adjacent_ground_level_difference);
            $stmt->bindParam('n_retaining_wall', $n_retaining_wall);
            $stmt->bindParam('n_type', $n_type);
            $stmt->bindParam('n_distance', $n_distance);
    
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

    // Update Ground Survey Report 5 with Id
    public function updateGroundSurveyReport5WithId($request, $response, $args) {
        $input = $request->getParsedBody();
        $id_ground_survey_report = $args['id'];
        
        $file = $input['file'];
        $e_adjacent_ground_level_difference = $input['e_adjacent_ground_level_difference'];
        $e_retaining_wall = $input['e_retaining_wall'];
        $e_type = $input['e_type'];
        $e_distance = $input['e_distance'];

        $w_adjacent_ground_level_difference = $input['w_adjacent_ground_level_difference'];
        $w_retaining_wall = $input['w_retaining_wall'];
        $w_type = $input['w_type'];
        $w_distance = $input['w_distance'];

        $s_adjacent_ground_level_difference = $input['s_adjacent_ground_level_difference'];
        $s_retaining_wall = $input['s_retaining_wall'];
        $s_type = $input['s_type'];
        $s_distance = $input['s_distance'];

        $n_adjacent_ground_level_difference = $input['n_adjacent_ground_level_difference'];
        $n_retaining_wall = $input['n_retaining_wall'];
        $n_type = $input['n_type'];
        $n_distance = $input['n_distance'];

        $this->db->beginTransaction();
        try {
            $sql = "UPDATE tb_ground_survey_report_5 SET file=:file, e_adjacent_ground_level_difference=:e_adjacent_ground_level_difference, e_retaining_wall=:e_retaining_wall, e_type=:e_type, e_distance=:e_distance, 
                                                                w_adjacent_ground_level_difference=:w_adjacent_ground_level_difference, w_retaining_wall=:w_retaining_wall, w_type=:w_type, w_distance=:w_distance, 
                                                                s_adjacent_ground_level_difference=:s_adjacent_ground_level_difference, s_retaining_wall=:s_retaining_wall, s_type=:s_type, s_distance=:s_distance, 
                                                                n_adjacent_ground_level_difference=:n_adjacent_ground_level_difference, n_retaining_wall=:n_retaining_wall, n_type=:n_type, n_distance=:n_distance  
                    WHERE id_ground_survey_report=:id_ground_survey_report";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam('id_ground_survey_report', $id_ground_survey_report);

            $stmt->bindParam('file', $file);
            $stmt->bindParam('e_adjacent_ground_level_difference', $e_adjacent_ground_level_difference);
            $stmt->bindParam('e_retaining_wall', $e_retaining_wall);
            $stmt->bindParam('e_type', $e_type);
            $stmt->bindParam('e_distance', $e_distance);

            $stmt->bindParam('w_adjacent_ground_level_difference', $w_adjacent_ground_level_difference);
            $stmt->bindParam('w_retaining_wall', $w_retaining_wall);
            $stmt->bindParam('w_type', $w_type);
            $stmt->bindParam('w_distance', $w_distance);

            $stmt->bindParam('s_adjacent_ground_level_difference', $s_adjacent_ground_level_difference);
            $stmt->bindParam('s_retaining_wall', $s_retaining_wall);
            $stmt->bindParam('s_type', $s_type);
            $stmt->bindParam('s_distance', $s_distance);

            $stmt->bindParam('n_adjacent_ground_level_difference', $n_adjacent_ground_level_difference);
            $stmt->bindParam('n_retaining_wall', $n_retaining_wall);
            $stmt->bindParam('n_type', $n_type);
            $stmt->bindParam('n_distance', $n_distance);
    
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


    //************************************************* */
    //Get Ground Survey Report 6 by Id
    public function getGroundSurveyReport6ById($request, $response, $args) {
        $id_ground_survey_report = $args['id'];
        
        //get Survey
        $sql = "SELECT id, survey_topography, rivers_and_irrigation_canals_0, rivers_and_irrigation_canals_1, rivers_and_irrigation_canals_2, surrounding_buildings, 
                        overview_abnormal_0, overview_abnormal_1, overview_abnormal_2, overview_abnormal_3, crack, deflection, slope, pavement, abnormal, adjacent_land
                FROM tb_ground_survey_report_6  
                WHERE id_ground_survey_report=:id_ground_survey_report";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("id_ground_survey_report", $id_ground_survey_report);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    // Add a new Ground Survey Report 6
    public function addNewGroundSurveyReport6($request, $response) {
        $input = $request->getParsedBody();
        $id_ground_survey_report = $input['id_ground_survey_report'];
        
        $survey_topography = $input['survey_topography'];
        $rivers_and_irrigation_canals_0 = $input['rivers_and_irrigation_canals_0'];
        $rivers_and_irrigation_canals_1 = $input['rivers_and_irrigation_canals_1'];
        $rivers_and_irrigation_canals_2 = $input['rivers_and_irrigation_canals_2'];
        $surrounding_buildings = $input['surrounding_buildings'];
        $overview_abnormal_0 = $input['overview_abnormal_0'];
        $overview_abnormal_1 = $input['overview_abnormal_1'];
        $overview_abnormal_2 = $input['overview_abnormal_2'];
        $overview_abnormal_3 = $input['overview_abnormal_3'];
        $crack = $input['crack'];
        $deflection = $input['deflection'];
        $slope = $input['slope'];
        $pavement = $input['pavement'];
        $abnormal = $input['abnormal'];
        $adjacent_land = $input['adjacent_land'];


        $this->db->beginTransaction();
        try {
            //insert
            $sql = "INSERT INTO tb_ground_survey_report_6 (id_ground_survey_report, survey_topography, 
                                rivers_and_irrigation_canals_0, rivers_and_irrigation_canals_1, rivers_and_irrigation_canals_2, surrounding_buildings, 
                                overview_abnormal_0, overview_abnormal_1, overview_abnormal_2, overview_abnormal_3, crack, deflection, slope, pavement, abnormal, adjacent_land) 
                        VALUES (:id_ground_survey_report, :survey_topography, :rivers_and_irrigation_canals_0, :rivers_and_irrigation_canals_1, :rivers_and_irrigation_canals_2, 
                                :surrounding_buildings, :overview_abnormal_0, :overview_abnormal_1, :overview_abnormal_2, :overview_abnormal_3, :crack, :deflection, :slope, :pavement, :abnormal, :adjacent_land)";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam('id_ground_survey_report', $id_ground_survey_report);

            $stmt->bindParam('survey_topography', $survey_topography);
            $stmt->bindParam('rivers_and_irrigation_canals_0', $rivers_and_irrigation_canals_0);
            $stmt->bindParam('rivers_and_irrigation_canals_1', $rivers_and_irrigation_canals_1);
            $stmt->bindParam('rivers_and_irrigation_canals_2', $rivers_and_irrigation_canals_2);
            $stmt->bindParam('rivers_and_irrigation_canals_0', $rivers_and_irrigation_canals_0);

            $stmt->bindParam('surrounding_buildings', $surrounding_buildings);
            $stmt->bindParam('overview_abnormal_0', $overview_abnormal_0);
            $stmt->bindParam('overview_abnormal_1', $overview_abnormal_1);
            $stmt->bindParam('overview_abnormal_2', $overview_abnormal_2);
            $stmt->bindParam('overview_abnormal_3', $overview_abnormal_3);

            $stmt->bindParam('crack', $crack);
            $stmt->bindParam('deflection', $deflection);
            $stmt->bindParam('slope', $slope);
            $stmt->bindParam('pavement', $pavement);
            $stmt->bindParam('abnormal', $abnormal);
            $stmt->bindParam('adjacent_land', $adjacent_land);
    
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

    // Update Ground Survey Report 6 with Id
    public function updateGroundSurveyReport6WithId($request, $response, $args) {
        $input = $request->getParsedBody();
        $id_ground_survey_report = $args['id'];
        
        $survey_topography = $input['survey_topography'];
        $rivers_and_irrigation_canals_0 = $input['rivers_and_irrigation_canals_0'];
        $rivers_and_irrigation_canals_1 = $input['rivers_and_irrigation_canals_1'];
        $rivers_and_irrigation_canals_2 = $input['rivers_and_irrigation_canals_2'];
        $surrounding_buildings = $input['surrounding_buildings'];
        $overview_abnormal_0 = $input['overview_abnormal_0'];
        $overview_abnormal_1 = $input['overview_abnormal_1'];
        $overview_abnormal_2 = $input['overview_abnormal_2'];
        $overview_abnormal_3 = $input['overview_abnormal_3'];
        $crack = $input['crack'];
        $deflection = $input['deflection'];
        $slope = $input['slope'];
        $pavement = $input['pavement'];
        $abnormal = $input['abnormal'];
        $adjacent_land = $input['adjacent_land'];

        $this->db->beginTransaction();
        try {
            $sql = "UPDATE tb_ground_survey_report_6 SET survey_topography=:survey_topography, rivers_and_irrigation_canals_0=:rivers_and_irrigation_canals_0, 
            rivers_and_irrigation_canals_1=:rivers_and_irrigation_canals_1, rivers_and_irrigation_canals_2=:rivers_and_irrigation_canals_2, surrounding_buildings=:surrounding_buildings, 
            overview_abnormal_0=:overview_abnormal_0, overview_abnormal_1=:overview_abnormal_1, overview_abnormal_2=:overview_abnormal_2, overview_abnormal_3=:overview_abnormal_3, 
            crack=:crack, deflection=:deflection, slope=:slope, pavement=:pavement, abnormal=:abnormal, adjacent_land=:adjacent_land  
                    WHERE id_ground_survey_report=:id_ground_survey_report";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam('id_ground_survey_report', $id_ground_survey_report);

            $stmt->bindParam('survey_topography', $survey_topography);
            $stmt->bindParam('rivers_and_irrigation_canals_0', $rivers_and_irrigation_canals_0);
            $stmt->bindParam('rivers_and_irrigation_canals_1', $rivers_and_irrigation_canals_1);
            $stmt->bindParam('rivers_and_irrigation_canals_2', $rivers_and_irrigation_canals_2);

            $stmt->bindParam('surrounding_buildings', $surrounding_buildings);
            $stmt->bindParam('overview_abnormal_0', $overview_abnormal_0);
            $stmt->bindParam('overview_abnormal_1', $overview_abnormal_1);
            $stmt->bindParam('overview_abnormal_2', $overview_abnormal_2);
            $stmt->bindParam('overview_abnormal_3', $overview_abnormal_3);
            
            $stmt->bindParam('crack', $crack);
            $stmt->bindParam('deflection', $deflection);
            $stmt->bindParam('slope', $slope);
            $stmt->bindParam('pavement', $pavement);
            $stmt->bindParam('abnormal', $abnormal);
            $stmt->bindParam('adjacent_land', $adjacent_land);
    
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


    //************************************************* */
    //Get Ground Survey Report 7 by Id
    public function getGroundSurveyReport7ById($request, $response, $args) {
        $id_ground_survey_report = $args['id'];
        
        //get Survey
        $sql = "SELECT id, creation_status, ground_surface, soil_quality, moisture_content, underground_objects, current_situation,
                    existing_building0, existing_building1, existing_building2, existing_building3, crack, deflection, slope, 
                    carry_in0, carry_in1, carry_in2, carry_in3, carry_in4 
                FROM tb_ground_survey_report_7  
                WHERE id_ground_survey_report=:id_ground_survey_report";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("id_ground_survey_report", $id_ground_survey_report);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    // Add a new Ground Survey Report 7
    public function addNewGroundSurveyReport7($request, $response) {
        $input = $request->getParsedBody();
        $id_ground_survey_report = $input['id_ground_survey_report'];
        
        $creation_status = $input['creation_status'];
        $ground_surface = $input['ground_surface'];
        $soil_quality = $input['soil_quality'];
        $moisture_content = $input['moisture_content'];
        $underground_objects = $input['underground_objects'];
        $current_situation = $input['current_situation'];
        $existing_building0 = $input['existing_building0'];
        $existing_building1 = $input['existing_building1'];
        $existing_building2 = $input['existing_building2'];
        $existing_building3 = $input['existing_building3'];
        $crack = $input['crack'];
        $deflection = $input['deflection'];
        $slope = $input['slope'];
        $carry_in0 = $input['carry_in0'];
        $carry_in1 = $input['carry_in1'];
        $carry_in2 = $input['carry_in2'];
        $carry_in3 = $input['carry_in3'];
        $carry_in4 = $input['carry_in4'];


        $this->db->beginTransaction();
        try {
            //insert
            $sql = "INSERT INTO tb_ground_survey_report_7 (id_ground_survey_report, creation_status, 
                                ground_surface, soil_quality, moisture_content, underground_objects, 
                                current_situation, existing_building0, existing_building1, existing_building2, existing_building3, crack, deflection, slope, 
                                carry_in0, carry_in1, carry_in2, carry_in3, carry_in4) 
                        VALUES (:id_ground_survey_report, :creation_status, 
                                :ground_surface, :soil_quality, :moisture_content, :underground_objects, 
                                :current_situation, :existing_building0, :existing_building1, :existing_building2, :existing_building3, :crack, :deflection, :slope, 
                                :carry_in0, :carry_in1, :carry_in2, :carry_in3, :carry_in4)";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam('id_ground_survey_report', $id_ground_survey_report);

            $stmt->bindParam('creation_status', $creation_status);
            $stmt->bindParam('ground_surface', $ground_surface);
            $stmt->bindParam('soil_quality', $soil_quality);
            $stmt->bindParam('moisture_content', $moisture_content);
            $stmt->bindParam('underground_objects', $underground_objects);

            $stmt->bindParam('current_situation', $current_situation);
            $stmt->bindParam('existing_building0', $existing_building0);
            $stmt->bindParam('existing_building1', $existing_building1);
            $stmt->bindParam('existing_building2', $existing_building2);
            $stmt->bindParam('existing_building3', $existing_building3);

            $stmt->bindParam('crack', $crack);
            $stmt->bindParam('deflection', $deflection);
            $stmt->bindParam('slope', $slope);
            $stmt->bindParam('carry_in0', $carry_in0);
            $stmt->bindParam('carry_in1', $carry_in1);
            $stmt->bindParam('carry_in2', $carry_in2);
            $stmt->bindParam('carry_in3', $carry_in3);
            $stmt->bindParam('carry_in4', $carry_in4);
    
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

    // Update Ground Survey Report 7 with Id
    public function updateGroundSurveyReport7WithId($request, $response, $args) {
        $input = $request->getParsedBody();
        $id_ground_survey_report = $args['id'];
        
        $creation_status = $input['creation_status'];
        $ground_surface = $input['ground_surface'];
        $soil_quality = $input['soil_quality'];
        $moisture_content = $input['moisture_content'];
        $underground_objects = $input['underground_objects'];
        $current_situation = $input['current_situation'];
        $existing_building0 = $input['existing_building0'];
        $existing_building1 = $input['existing_building1'];
        $existing_building2 = $input['existing_building2'];
        $existing_building3 = $input['existing_building3'];
        $crack = $input['crack'];
        $deflection = $input['deflection'];
        $slope = $input['slope'];
        $carry_in0 = $input['carry_in0'];
        $carry_in1 = $input['carry_in1'];
        $carry_in2 = $input['carry_in2'];
        $carry_in3 = $input['carry_in3'];
        $carry_in4 = $input['carry_in4'];

        $this->db->beginTransaction();
        try {
            $sql = "UPDATE tb_ground_survey_report_7 SET creation_status=:creation_status, 
                        ground_surface=:ground_surface, soil_quality=:soil_quality, moisture_content=:moisture_content, underground_objects=:underground_objects, 
                        current_situation=:current_situation, existing_building0=:existing_building0, existing_building1=:existing_building1, existing_building2=:existing_building2, existing_building3=:existing_building3, crack=:crack, deflection=:deflection, slope=:slope, 
                        carry_in0=:carry_in0, carry_in1=:carry_in1, carry_in2=:carry_in2, carry_in3=:carry_in3, carry_in4=:carry_in4  
                    WHERE id_ground_survey_report=:id_ground_survey_report";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam('id_ground_survey_report', $id_ground_survey_report);

            $stmt->bindParam('creation_status', $creation_status);
            $stmt->bindParam('ground_surface', $ground_surface);
            $stmt->bindParam('soil_quality', $soil_quality);
            $stmt->bindParam('moisture_content', $moisture_content);
            $stmt->bindParam('underground_objects', $underground_objects);

            $stmt->bindParam('current_situation', $current_situation);
            $stmt->bindParam('existing_building0', $existing_building0);
            $stmt->bindParam('existing_building1', $existing_building1);
            $stmt->bindParam('existing_building2', $existing_building2);
            $stmt->bindParam('existing_building3', $existing_building3);

            $stmt->bindParam('crack', $crack);
            $stmt->bindParam('deflection', $deflection);
            $stmt->bindParam('slope', $slope);
            $stmt->bindParam('carry_in0', $carry_in0);
            $stmt->bindParam('carry_in1', $carry_in1);
            $stmt->bindParam('carry_in2', $carry_in2);
            $stmt->bindParam('carry_in3', $carry_in3);
            $stmt->bindParam('carry_in4', $carry_in4);
    
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


    //************************************************* */
    //Get Ground Survey Report 8 by Id
    public function getGroundSurveyReport8ById($request, $response, $args) {
        $survey_id = $args['id'];
        $measurement_point_no = isset($_GET['no']) ? $_GET['no'] : 1;
        


        //get Survey info
        //$sql = "SELECT id, survey_id, site_name, weather, remarks, measurement_point_no, water_level, measurement_content, phenol_reaction 
        $sql = "SELECT id
                FROM survey_info 
                WHERE survey_id=:survey_id AND measurement_point_no=:measurement_point_no";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("survey_id", $survey_id);
        $stmt->bindParam("measurement_point_no", $measurement_point_no);
        $stmt->execute();
        $result = $stmt->fetchObject();
        if($stmt->rowCount()==0){
            return $response->withJson($result);
        }
        $result->survey_name = "小林　裕二　様邸";
        $result->survey_location = "東京都日野市大字川辺堀之内542-1";
        $result->hole_mouth_elevation = "KBM ±0.00 m";
        //$hole_water_level = "";
        $result->remarks = "";
        $result->station_number = "2";
        $result->survey_date = "2019年07月08日";
        $result->final_penetration_depth = "5.55 m";
        $result->tester = "新留　徹";

        $survey_info_id = $result->id;
        //get Survey info wsw
        $sql = "SELECT wsw, half_revolution, '25' as penetration_amount, '16' as nws, '' as sound_and_feel, 
        '' as intrusion_status, '粘性土' as soil_name, '3.8' as conversion_N_value, '40.2' as allowable_bearing_capacity
                FROM survey_info_wsw 
                WHERE survey_info_id=:survey_info_id 
                ORDER BY id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("survey_info_id", $survey_info_id);
        $stmt->execute();
        $details = $stmt->fetchAll();
        $m = array("0.25", "0.50", "0.75", "1.00", "1.25", "1.50", "1.75", "2.00", "2.25", "2.50", "2.75", "3.00", "3.25", "3.50", "3.75", "4.00", "4.25", "4.50", "4.75", "5.00", "5.25", "5.50", "5.75", "6.00", "6.25", "6.50", "6.75", "7.00", "7.25", "7.50", "7.75", "8.00", "8.25", "8.50", "8.75", "9.00", "9.25", "9.50", "9.75", "10.00"); 
        foreach ($m as $key => $value) {
            $result->$value=$details[$key];
        }
        
        return $response->withJson($result);
    }

    //************************************************* */
    //Get Ground Survey Report 13 by Id
    public function getGroundSurveyReport13ById($request, $response, $args) {
        $survey_id = $args['id'];
        $number = isset($_GET['number']) ? $_GET['number'] : 1;
        $offset= $number-1;


        //get Survey info
        //$sql = "SELECT id, survey_id, site_name, weather, remarks, measurement_point_no, water_level, measurement_content, phenol_reaction 
        $sql = "SELECT id, measurement_point_no
                FROM survey_info 
                WHERE survey_id=:survey_id 
                LIMIT $limit 1 OFFSET $offset ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("survey_id", $survey_id);
        $stmt->execute();
        $result = $stmt->fetchObject();
        if($stmt->rowCount()==0){
            return $response->withJson($result);
        }
        $result->final_penetration_depth = "5.55 m";
        $result->hole_mouth_elevation = "±0.00 m";
        

        $survey_info_id = $result->id;
        //get Survey info wsw
        $sql = "SELECT wsw, '16' as nsw 
                FROM survey_info_wsw 
                WHERE survey_info_id=:survey_info_id 
                ORDER BY id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("survey_info_id", $survey_info_id);
        $stmt->execute();
        $details = $stmt->fetchAll();
        $m = array("0.25", "0.50", "0.75", "1.00", "1.25", "1.50", "1.75", "2.00", "2.25", "2.50", "2.75", "3.00", "3.25", "3.50", "3.75", "4.00", "4.25", "4.50", "4.75", "5.00", "5.25", "5.50", "5.75", "6.00", "6.25", "6.50", "6.75", "7.00", "7.25", "7.50", "7.75", "8.00", "8.25", "8.50", "8.75", "9.00", "9.25", "9.50", "9.75", "10.00"); 
        foreach ($m as $key => $value) {
            $result->$value=$details[$key];
        }
        
        return $response->withJson($result);
    }

    //************************************************* */
    //Get Ground Survey Report 14 by Id
    public function getGroundSurveyReport14ById($request, $response, $args) {
        $id_ground_survey_report = $args['id'];
        
        //get Survey
        $sql = "SELECT id, front_road_east_side, front_road_south_side, western_border, east_border, southern_boundary, north_border 
                FROM tb_ground_survey_report_14  
                WHERE id_ground_survey_report=:id_ground_survey_report";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("id_ground_survey_report", $id_ground_survey_report);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    // Add a new Ground Survey Report 14
    public function addNewGroundSurveyReport14($request, $response) {
        $input = $request->getParsedBody();
        $id_ground_survey_report = $input['id_ground_survey_report'];
        
        $front_road_east_side = $input['front_road_east_side'];
        $front_road_south_side = $input['front_road_south_side'];
        $western_border = $input['western_border'];
        $east_border = $input['east_border'];
        $southern_boundary = $input['southern_boundary'];
        $north_border = $input['north_border'];

        $this->db->beginTransaction();
        try {
            //insert
            $sql = "INSERT INTO tb_ground_survey_report_14 (id_ground_survey_report, front_road_east_side, front_road_south_side, western_border, east_border, southern_boundary, north_border) 
                        VALUES (:id_ground_survey_report, :front_road_east_side, :front_road_south_side, :western_border, :east_border, :southern_boundary, :north_border)";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam('id_ground_survey_report', $id_ground_survey_report);

            $stmt->bindParam('front_road_east_side', $front_road_east_side);
            $stmt->bindParam('front_road_south_side', $front_road_south_side);
            $stmt->bindParam('western_border', $western_border);
            $stmt->bindParam('east_border', $east_border);
            $stmt->bindParam('southern_boundary', $southern_boundary);
            $stmt->bindParam('north_border', $north_border);
            
    
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

    // Update Ground Survey Report 14 with Id
    public function updateGroundSurveyReport14WithId($request, $response, $args) {
        $input = $request->getParsedBody();
        $id_ground_survey_report = $args['id'];
        
        $front_road_east_side = $input['front_road_east_side'];
        $front_road_south_side = $input['front_road_south_side'];
        $western_border = $input['western_border'];
        $east_border = $input['east_border'];
        $southern_boundary = $input['southern_boundary'];
        $north_border = $input['north_border'];

        $this->db->beginTransaction();
        try {
            $sql = "UPDATE tb_ground_survey_report_14 SET id_ground_survey_report=:id_ground_survey_report, front_road_east_side=:front_road_east_side, front_road_south_side=:front_road_south_side, 
                            western_border=:western_border, east_border=:east_border, southern_boundary=:southern_boundary, north_border=:north_border  
                    WHERE id_ground_survey_report=:id_ground_survey_report";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam('id_ground_survey_report', $id_ground_survey_report);

            $stmt->bindParam('front_road_east_side', $front_road_east_side);
            $stmt->bindParam('front_road_south_side', $front_road_south_side);
            $stmt->bindParam('western_border', $western_border);
            $stmt->bindParam('east_border', $east_border);
            $stmt->bindParam('southern_boundary', $southern_boundary);
            $stmt->bindParam('north_border', $north_border);
    
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