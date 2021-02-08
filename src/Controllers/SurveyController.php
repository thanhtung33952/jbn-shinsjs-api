<?php
namespace Controllers;

class SurveyController
{
    private $db;

    // constructor receives container instance
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function getAllSurvey($request, $response, $args) {
        $userId = isset($_GET['userId']) ? $_GET['userId'] : '';
        try{
            $sql = "SELECT tb_survey.id, userId, tb_company.a_company_name, tb_users.a_contact_name, tb_users.a_email, a_contacts_etc, c_company_id, c_business_name,
                           c_contact_name, c_email, c_contacts_etc, property_name, furigana, number_of_applications, 
                           division, location_prefecture, city_or_county, street_address, location_information, 
                           construction_number, tb_company1.scheduled_survey_company, scheduled_survey_company_id, survey_date, first_choice_from, 
                           first_choice_to, first_choice_hour, second_choice_from, second_choice_to, second_choice_hour, 
                           time_specification,survey_method, witness, final_investigation_company, final_survey_date, proceed_after_survey,
                           collateral_liability_insurance_corporation, building_confirmation_application_organization, 
                           building_structure, building_floor_number, total_floor_area, design_ground_pressure, 
                           building_division, usage_classification, basic_shape, rooting_depth, deep_foundation_available, 
                           foundation_work_schedule, foundation_work_schedule_date, 
                           slope, field_situation, height_disorder, building_drawing_set, site_photo, construction_quotation, 
                           construction_examination_book, construction_report, status, statusPublic 
                    FROM tb_survey 
                    LEFT JOIN (SELECT id, CONCAT(lastName,' ',firstName) AS a_contact_name, email AS a_email, companyID FROM tb_users) AS tb_users 
                        ON tb_survey.userId = tb_users.id 
                    LEFT JOIN (SELECT companyDisplayName AS a_company_name, companyId FROM tb_company) AS tb_company 
                        ON tb_users.companyID = tb_company.companyId 
                    LEFT JOIN (SELECT companyDisplayName AS scheduled_survey_company, companyId FROM tb_company) AS tb_company1 
                        ON scheduled_survey_company_id = tb_company1.companyId ";
                    IF($userId != ''){
                        $sql .= "WHERE tb_survey.userId=:userId ";
                    }
                    
                    $sql .= "ORDER BY tb_survey.id ";
            
            $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
            $offset= isset($_GET['offset']) ? $_GET['offset'] : 0;
            if($limit>0){
                $sql .= "LIMIT $limit OFFSET $offset ";
            }
    
            $stmt = $this->db->prepare($sql);
            IF($userId != ''){
                $stmt->bindParam("userId", $userId);
            }
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

    //Get Survey by Id
    public function getSurveyById($request, $response, $args) {
        $id = $args['id'];
        
        //get Survey
        $sql = "SELECT tb_survey.id, userId, tb_company.a_company_name, tb_users.a_contact_name, tb_users.a_email, a_contacts_etc, c_company_id, c_business_name, 
                        c_contact_name, c_email, c_contacts_etc, property_name, furigana, number_of_applications, 
                        division, location_prefecture, city_or_county, street_address, location_information, 
                        construction_number, tb_company1.scheduled_survey_company, scheduled_survey_company_id, survey_date, first_choice_from,first_choice_to,
                        first_choice_hour,second_choice_from,second_choice_to,second_choice_hour,time_specification, 
                        survey_method, witness, final_investigation_company, final_survey_date, proceed_after_survey,
                        collateral_liability_insurance_corporation, building_confirmation_application_organization, 
                        building_structure, building_floor_number, total_floor_area, design_ground_pressure, 
                        building_division, usage_classification, basic_shape, rooting_depth, deep_foundation_available, 
                        foundation_work_schedule, foundation_work_schedule_date, 
                        slope, field_situation, height_disorder, building_drawing_set, site_photo, construction_quotation, 
                        construction_examination_book, construction_report, status, statusPublic 
                FROM tb_survey 
                LEFT JOIN (SELECT id, CONCAT(lastName,' ',firstName) AS a_contact_name, email AS a_email, companyID FROM tb_users) AS tb_users 
                    ON tb_survey.userId = tb_users.id 
                LEFT JOIN (SELECT companyDisplayName AS a_company_name, companyId FROM tb_company) AS tb_company 
                    ON tb_users.companyID = tb_company.companyId 
                LEFT JOIN (SELECT companyDisplayName AS scheduled_survey_company, companyId FROM tb_company) AS tb_company1 
                    ON scheduled_survey_company_id = tb_company1.companyId 
                WHERE tb_survey.id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    // Add a new Survey or Save Draft Survey
    public function addNewSurvey($request, $response) {
        $input = $request->getParsedBody();
        // $a_company_name = $input['a_company_name'];
        // $a_contact_name = $input['a_contact_name'];
        // $a_email = $input['a_email'];

        //step 1
        $userId = $input['userId'];
        $a_contacts_etc = $input['a_contacts_etc'];

        //step 2
        $c_company_id = isset($input['c_company_id']) ? $input['c_company_id'] : NULL;
        $c_business_name = isset($input['c_business_name']) ? $input['c_business_name'] : NULL;
        $c_contact_name = isset($input['c_contact_name']) ? $input['c_contact_name'] : NULL;
        $c_email = isset($input['c_email']) ? $input['c_email'] : NULL;
        $c_contacts_etc = isset($input['c_contacts_etc']) ? $input['c_contacts_etc'] : NULL;

        //step 3
        $property_name = isset($input['property_name']) ? $input['property_name'] : NULL;
        $furigana = isset($input['furigana']) ? $input['furigana'] : NULL;
        $number_of_applications = isset($input['number_of_applications']) ? $input['number_of_applications'] : NULL;
        $division = isset($input['division']) ? $input['division'] : NULL;
        $location_prefecture = isset($input['location_prefecture']) ? $input['location_prefecture'] : NULL;
        $city_or_county = isset($input['city_or_county']) ? $input['city_or_county'] : NULL;
        $street_address = isset($input['street_address']) ? $input['street_address'] : NULL;
        $location_information = isset($input['location_information']) ? $input['location_information'] : NULL;
        $construction_number = isset($input['construction_number']) ? $input['construction_number'] : NULL;

        //step 4
        $collateral_liability_insurance_corporation = isset($input['collateral_liability_insurance_corporation']) ? $input['collateral_liability_insurance_corporation'] : NULL;
        $building_confirmation_application_organization = isset($input['building_confirmation_application_organization']) ? $input['building_confirmation_application_organization'] : NULL;
        $building_structure = isset($input['building_structure']) ? $input['building_structure'] : NULL;
        $building_floor_number = isset($input['building_floor_number']) ? $input['building_floor_number'] : NULL;
        $total_floor_area = isset($input['total_floor_area']) ? $input['total_floor_area'] : NULL;
        $design_ground_pressure = isset($input['design_ground_pressure']) ? $input['design_ground_pressure'] : NULL;
        $building_division = isset($input['building_division']) ? $input['building_division'] : NULL;
        $usage_classification = isset($input['usage_classification']) ? $input['usage_classification'] : NULL;
        
        $building_drawing_set = isset($input['building_drawing_set']) ? $input['building_drawing_set'] : NULL;
        $site_photo = isset($input['site_photo']) ? $input['site_photo'] : NULL;
        $construction_quotation = isset($input['construction_quotation']) ? $input['construction_quotation'] : NULL;
        $construction_examination_book = isset($input['construction_examination_book']) ? $input['construction_examination_book'] : NULL;
        $construction_report = isset($input['construction_report']) ? $input['construction_report'] : NULL;

        //step 5
        $basic_shape = isset($input['basic_shape']) ? $input['basic_shape'] : NULL;
        $rooting_depth = isset($input['rooting_depth']) ? $input['rooting_depth'] : NULL;
        $deep_foundation_available = isset($input['deep_foundation_available']) ? $input['deep_foundation_available'] : NULL;
        $foundation_work_schedule = isset($input['foundation_work_schedule']) ? $input['foundation_work_schedule'] : NULL;
        $foundation_work_schedule_date = isset($input['foundation_work_schedule_date']) ? $input['foundation_work_schedule_date'] : NULL;

        //step 6
        $slope = isset($input['slope']) ? $input['slope'] : NULL;
        $field_situation = isset($input['field_situation']) ? $input['field_situation'] : NULL;
        $height_disorder = isset($input['height_disorder']) ? $input['height_disorder'] : NULL;

        //step 7
        $scheduled_survey_company_id = isset($input['scheduled_survey_company_id']) ? $input['scheduled_survey_company_id'] : NULL;
        $survey_date = isset($input['survey_date']) ? $input['survey_date'] : NULL;
        $first_choice_from = isset($input['first_choice_from']) ? $input['first_choice_from'] : NULL;
        $first_choice_to = isset($input['first_choice_to']) ? $input['first_choice_to'] : NULL;
        $first_choice_hour = isset($input['first_choice_hour']) ? $input['first_choice_hour'] : NULL;
        $second_choice_from = isset($input['second_choice_from']) ? $input['second_choice_from'] : NULL;
        $second_choice_to = isset($input['second_choice_to']) ? $input['second_choice_to'] : NULL;
        $second_choice_hour = isset($input['second_choice_hour']) ? $input['second_choice_hour'] : NULL;
        $time_specification = isset($input['time_specification']) ? $input['time_specification'] : NULL;
        $survey_method = isset($input['survey_method']) ? $input['survey_method'] : NULL;
        $witness = isset($input['witness']) ? $input['witness'] : NULL;
        $final_investigation_company = isset($input['final_investigation_company']) ? $input['final_investigation_company'] : NULL;
        $final_survey_date = isset($input['final_survey_date']) ? $input['final_survey_date'] : NULL;
        $proceed_after_survey = isset($input['proceed_after_survey']) ? $input['proceed_after_survey'] : NULL;
         
        //step 11
        //todo

        $statusPublic = $input['statusPublic'];
        
        $this->db->beginTransaction();
        try {
            // check data set status
            $status = 1;

            if($c_company_id!=NULL){
                $status = 2;
            }
            if($property_name!=NULL){
                $status = 3;
            }
            if($collateral_liability_insurance_corporation!=NULL){
                $status = 4;
            }
            if($basic_shape!=NULL){
                $status = 5;
            }
            if($slope!=NULL){
                $status = 6;
            }
            if($scheduled_survey_company_id!=NULL){
                $status = 7;
            }
            //todo 8->11
            // if($!=NULL){
            //     $input['status'] = 11;
            // }
            
            $input['status']=$status;
            //insert
            $sql = "INSERT INTO tb_survey (userId, a_contacts_etc, c_company_id, c_business_name, 
                            c_contact_name, c_email, c_contacts_etc, property_name, furigana, number_of_applications, 
                            division, location_prefecture, city_or_county, street_address, location_information, 
                            construction_number, scheduled_survey_company_id, survey_date, first_choice_from, first_choice_to, 
                            first_choice_hour, second_choice_from, second_choice_to, second_choice_hour, time_specification, 
                            survey_method, witness, final_investigation_company, final_survey_date, proceed_after_survey,
                            collateral_liability_insurance_corporation, building_confirmation_application_organization, 
                            building_structure, building_floor_number, total_floor_area, design_ground_pressure, 
                            building_division, usage_classification, basic_shape, rooting_depth, deep_foundation_available, foundation_work_schedule, foundation_work_schedule_date, 
                            slope, field_situation, height_disorder, building_drawing_set, site_photo, construction_quotation, 
                            construction_examination_book, construction_report, status, statusPublic) 
                        VALUES (:userId, :a_contacts_etc, :c_company_id, :c_business_name, 
                            :c_contact_name, :c_email, :c_contacts_etc, :property_name, :furigana, :number_of_applications, 
                            :division, :location_prefecture, :city_or_county, :street_address, :location_information, 
                            :construction_number, :scheduled_survey_company_id, :survey_date, :first_choice_from, :first_choice_to, 
                            :first_choice_hour, :second_choice_from, :second_choice_to, :second_choice_hour, :time_specification, 
                            :survey_method, :witness, :final_investigation_company, :final_survey_date, :proceed_after_survey,
                            :collateral_liability_insurance_corporation, :building_confirmation_application_organization, 
                            :building_structure, :building_floor_number, :total_floor_area, :design_ground_pressure, 
                            :building_division, :usage_classification, :basic_shape, :rooting_depth, :deep_foundation_available, :foundation_work_schedule, :foundation_work_schedule_date,
                            :slope, :field_situation, :height_disorder, :building_drawing_set, :site_photo, :construction_quotation, 
                            :construction_examination_book, :construction_report, :status, :statusPublic)";
            $stmt = $this->db->prepare($sql);
            // $stmt->bindParam('a_company_name', $a_company_name);
            // $stmt->bindParam('a_contact_name', $a_contact_name);
            // $stmt->bindParam('a_email', $a_email);
            $stmt->bindParam('userId', $userId);
            $stmt->bindParam('a_contacts_etc', $a_contacts_etc);
            $stmt->bindParam('c_company_id', $c_company_id);
            $stmt->bindParam('c_business_name', $c_business_name);
            $stmt->bindParam('c_contact_name', $c_contact_name);
            $stmt->bindParam('c_email', $c_email);
            $stmt->bindParam('c_contacts_etc', $c_contacts_etc);
            $stmt->bindParam('property_name', $property_name);
            $stmt->bindParam('furigana', $furigana);
            $stmt->bindParam('number_of_applications', $number_of_applications);
            $stmt->bindParam('division', $division);
            $stmt->bindParam('location_prefecture', $location_prefecture);
            $stmt->bindParam('city_or_county', $city_or_county);
            $stmt->bindParam('street_address', $street_address);
            $stmt->bindParam('location_information', $location_information);
            $stmt->bindParam('construction_number', $construction_number);
            $stmt->bindParam('scheduled_survey_company_id', $scheduled_survey_company_id);
            $stmt->bindParam('survey_date', $survey_date);
            $stmt->bindParam('first_choice_from', $first_choice_from);
            $stmt->bindParam('first_choice_to', $first_choice_to);
            $stmt->bindParam('first_choice_hour', $first_choice_hour);
            $stmt->bindParam('second_choice_from', $second_choice_from);
            $stmt->bindParam('second_choice_to', $second_choice_to);
            $stmt->bindParam('second_choice_hour', $second_choice_hour);
            $stmt->bindParam('time_specification', $time_specification);
            $stmt->bindParam('survey_method', $survey_method);
            $stmt->bindParam('witness', $witness);
            $stmt->bindParam('final_investigation_company', $final_investigation_company);
            $stmt->bindParam('final_survey_date', $final_survey_date);
            $stmt->bindParam('proceed_after_survey', $proceed_after_survey);
            $stmt->bindParam('collateral_liability_insurance_corporation', $collateral_liability_insurance_corporation);
            $stmt->bindParam('building_confirmation_application_organization', $building_confirmation_application_organization);
            $stmt->bindParam('building_structure', $building_structure);
            $stmt->bindParam('building_floor_number', $building_floor_number);
            $stmt->bindParam('total_floor_area', $total_floor_area);
            $stmt->bindParam('design_ground_pressure', $design_ground_pressure);
            $stmt->bindParam('building_division', $building_division);
            $stmt->bindParam('usage_classification', $usage_classification);
            $stmt->bindParam('basic_shape', $basic_shape);
            $stmt->bindParam('rooting_depth', $rooting_depth);
            $stmt->bindParam('deep_foundation_available', $deep_foundation_available);
            $stmt->bindParam('foundation_work_schedule', $foundation_work_schedule);
            $stmt->bindParam('foundation_work_schedule_date', $foundation_work_schedule_date);
            $stmt->bindParam('slope', $slope);
            $stmt->bindParam('field_situation', $field_situation);
            $stmt->bindParam('height_disorder', $height_disorder);
            $stmt->bindParam('building_drawing_set', $building_drawing_set);
            $stmt->bindParam('site_photo', $site_photo);
            $stmt->bindParam('construction_quotation', $construction_quotation);
            $stmt->bindParam('construction_examination_book', $construction_examination_book);
            $stmt->bindParam('construction_report', $construction_report);
            $stmt->bindParam('status', $status);
            $stmt->bindParam('statusPublic', $statusPublic);
    
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

    // Update Survey with Id
    public function updateSurveyWithId($request, $response, $args) {
        $input = $request->getParsedBody();
        $id = $args['id'];
        $userId = $input['userId'];
        $a_contacts_etc = $input['a_contacts_etc'];
        $c_company_id = $input['c_company_id'];
        $c_business_name = $input['c_business_name'];
        $c_contact_name = $input['c_contact_name'];
        $c_email = $input['c_email'];
        $c_contacts_etc = $input['c_contacts_etc'];
        $property_name = $input['property_name'];
        $furigana = $input['furigana'];
        $number_of_applications = $input['number_of_applications'];
        $division = $input['division'];
        $location_prefecture = $input['location_prefecture'];
        $city_or_county = $input['city_or_county'];
        $street_address = $input['street_address'];
        $location_information = $input['location_information'];
        $construction_number = $input['construction_number'];
        $scheduled_survey_company_id = $input['scheduled_survey_company_id'];
        $survey_date = $input['survey_date'];
        $first_choice_from = $input['first_choice_from'];
        $first_choice_to = $input['first_choice_to'];
        $first_choice_hour = $input['first_choice_hour'];
        $second_choice_from = $input['second_choice_from'];
        $second_choice_to = $input['second_choice_to'];
        $second_choice_hour = $input['second_choice_hour'];
        $time_specification = $input['time_specification'];
        $survey_method = $input['survey_method'];
        $witness = $input['witness'];
        $final_investigation_company = $input['final_investigation_company'];
        $final_survey_date = $input['final_survey_date'];
        $proceed_after_survey = $input['proceed_after_survey'];
        $collateral_liability_insurance_corporation = $input['collateral_liability_insurance_corporation'];
        $building_confirmation_application_organization = $input['building_confirmation_application_organization'];
        $building_structure = $input['building_structure'];
        $building_floor_number = $input['building_floor_number'];
        $total_floor_area = $input['total_floor_area'];
        $design_ground_pressure = $input['design_ground_pressure'];
        $building_division = $input['building_division'];
        $usage_classification = $input['usage_classification'];
        $basic_shape = $input['basic_shape'];
        $rooting_depth = $input['rooting_depth'];
        $deep_foundation_available = $input['deep_foundation_available'];
        $foundation_work_schedule = $input['foundation_work_schedule'];
        $foundation_work_schedule_date = $input['foundation_work_schedule_date'];
        $slope = $input['slope'];
        $field_situation = $input['field_situation'];
        $height_disorder = $input['height_disorder'];
        $building_drawing_set = $input['building_drawing_set'];
        $site_photo = $input['site_photo'];
        $construction_quotation = $input['construction_quotation'];
        $construction_examination_book = $input['construction_examination_book'];
        $construction_report = $input['construction_report'];
        $statusPublic = $input['statusPublic'];

        $this->db->beginTransaction();
        try {
            // check data set status
            $status = 1;

            if($c_company_id!=NULL){
                $status = 2;
            }
            if($property_name!=NULL){
                $status = 3;
            }
            if($collateral_liability_insurance_corporation!=NULL){
                $status = 4;
            }
            if($basic_shape!=NULL){
                $status = 5;
            }
            if($slope!=NULL){
                $status = 6;
            }
            if($scheduled_survey_company_id!=NULL){
                $status = 7;
            }
            $sql = "UPDATE tb_survey SET userId=:userId,a_contacts_etc=:a_contacts_etc,c_company_id=:c_company_id,c_business_name=:c_business_name,
                        c_contact_name=:c_contact_name,c_email=:c_email,c_contacts_etc=:c_contacts_etc,
                        property_name=:property_name,furigana=:furigana,number_of_applications=:number_of_applications,
                        division=:division,location_prefecture=:location_prefecture,city_or_county=:city_or_county,
                        street_address=:street_address,location_information=:location_information,
                        construction_number=:construction_number,scheduled_survey_company_id=:scheduled_survey_company_id,
                        survey_date=:survey_date,first_choice_from=:first_choice_from,first_choice_to=:first_choice_to,
                        first_choice_hour=:first_choice_hour,second_choice_from=:second_choice_from,
                        second_choice_to=:second_choice_to,second_choice_hour=:second_choice_hour,time_specification=:time_specification,
                        survey_method=:survey_method,witness=:witness,final_investigation_company=:final_investigation_company,final_survey_date=:final_survey_date,proceed_after_survey=:proceed_after_survey,
                        collateral_liability_insurance_corporation=:collateral_liability_insurance_corporation,
                        building_confirmation_application_organization=:building_confirmation_application_organization,
                        building_structure=:building_structure,building_floor_number=:building_floor_number,
                        total_floor_area=:total_floor_area,design_ground_pressure=:design_ground_pressure,
                        building_division=:building_division,usage_classification=:usage_classification,
                        basic_shape=:basic_shape,rooting_depth=:rooting_depth,deep_foundation_available=:deep_foundation_available,
                        foundation_work_schedule=:foundation_work_schedule,foundation_work_schedule_date=:foundation_work_schedule_date,
                        slope=:slope,field_situation=:field_situation,height_disorder=:height_disorder,
                        building_drawing_set=:building_drawing_set,site_photo=:site_photo,construction_quotation=:construction_quotation,
                        construction_examination_book=:construction_examination_book,construction_report=:construction_report,
                        status=:status, statusPublic=:statusPublic 
                    WHERE id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('userId', $userId);
            $stmt->bindParam('a_contacts_etc', $a_contacts_etc);
            $stmt->bindParam('c_company_id', $c_company_id);
            $stmt->bindParam('c_business_name', $c_business_name);
            $stmt->bindParam('c_contact_name', $c_contact_name);
            $stmt->bindParam('c_email', $c_email);
            $stmt->bindParam('c_contacts_etc', $c_contacts_etc);
            $stmt->bindParam('property_name', $property_name);
            $stmt->bindParam('furigana', $furigana);
            $stmt->bindParam('number_of_applications', $number_of_applications);
            $stmt->bindParam('division', $division);
            $stmt->bindParam('location_prefecture', $location_prefecture);
            $stmt->bindParam('city_or_county', $city_or_county);
            $stmt->bindParam('street_address', $street_address);
            $stmt->bindParam('location_information', $location_information);
            $stmt->bindParam('construction_number', $construction_number);
            $stmt->bindParam('scheduled_survey_company_id', $scheduled_survey_company_id);
            $stmt->bindParam('survey_date', $survey_date);
            $stmt->bindParam('first_choice_from', $first_choice_from);
            $stmt->bindParam('first_choice_to', $first_choice_to);
            $stmt->bindParam('first_choice_hour', $first_choice_hour);
            $stmt->bindParam('second_choice_from', $second_choice_from);
            $stmt->bindParam('second_choice_to', $second_choice_to);
            $stmt->bindParam('second_choice_hour', $second_choice_hour);
            $stmt->bindParam('time_specification', $time_specification);
            $stmt->bindParam('survey_method', $survey_method);
            $stmt->bindParam('witness', $witness);
            $stmt->bindParam('final_investigation_company', $final_investigation_company);
            $stmt->bindParam('final_survey_date', $final_survey_date);
            $stmt->bindParam('proceed_after_survey', $proceed_after_survey);
            $stmt->bindParam('collateral_liability_insurance_corporation', $collateral_liability_insurance_corporation);
            $stmt->bindParam('building_confirmation_application_organization', $building_confirmation_application_organization);
            $stmt->bindParam('building_structure', $building_structure);
            $stmt->bindParam('building_floor_number', $building_floor_number);
            $stmt->bindParam('total_floor_area', $total_floor_area);
            $stmt->bindParam('design_ground_pressure', $design_ground_pressure);
            $stmt->bindParam('building_division', $building_division);
            $stmt->bindParam('usage_classification', $usage_classification);
            $stmt->bindParam('basic_shape', $basic_shape);
            $stmt->bindParam('rooting_depth', $rooting_depth);
            $stmt->bindParam('deep_foundation_available', $deep_foundation_available);
            $stmt->bindParam('foundation_work_schedule', $foundation_work_schedule);
            $stmt->bindParam('foundation_work_schedule_date', $foundation_work_schedule_date);
            $stmt->bindParam('slope', $slope);
            $stmt->bindParam('field_situation', $field_situation);
            $stmt->bindParam('height_disorder', $height_disorder);
            $stmt->bindParam('building_drawing_set', $building_drawing_set);
            $stmt->bindParam('site_photo', $site_photo);
            $stmt->bindParam('construction_quotation', $construction_quotation);
            $stmt->bindParam('construction_examination_book', $construction_examination_book);
            $stmt->bindParam('construction_report', $construction_report);
            $stmt->bindParam('status', $status);
            $stmt->bindParam('statusPublic', $statusPublic);
            $stmt->bindParam("id", $id);
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

    // delete a Survey with Id
    public function deleteSurveyWithId($request, $response, $args) {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare("DELETE FROM tb_survey WHERE id=:id");
            $stmt->bindParam("id", $args['id']);
            $result = $stmt->execute();


            $stmt = $this->db->prepare("DELETE FROM survey_info_wsw WHERE survey_info_id=(SELECT id FROM survey_info WHERE survey_id=:survey_id)");
            $stmt->bindParam("survey_id", $args['id']);
            $result = $stmt->execute();

            $stmt = $this->db->prepare("DELETE FROM survey_info WHERE survey_id=:id");
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

    // get permission
    public function getPermissionByUserId($request, $response, $args) {
        $input = $request->getParsedBody();
        $id = $input['id'];
        $userId = $input['userId'];
        
        //get company + status Survey
        $sql = "SELECT status, scheduled_survey_company_id, userId  
                FROM tb_survey 
                WHERE id=:id ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        
        if($stmt->rowCount()==0){
            return $response->withStatus(500);
        }

        $result = $stmt->fetchObject();
        $status = $result->status;
        $scheduled_survey_company_id = $result->scheduled_survey_company_id;
        $userIdCreate = $result->userId;

        //check công ty khảo sát
        $sql = "SELECT companyID 
                FROM tb_users 
                WHERE id = :userId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("userId", $userId);
        $stmt->execute();
        if($stmt->rowCount()==0){
            return $response->withStatus(500);
        }
        $result = $stmt->fetchObject();
        $companyID = $result->companyID;

        if($status == 1 && $userId==$userIdCreate){
            return $response->withJson(array('permission' => 'RWE'));
        }

        if($status == 1 && $companyID==$scheduled_survey_company_id){
            return $response->withJson(array('permission' => 'R'));
        }

        

        return $response->withJson(array('permission' => 'R'));
    }

    function sendMailSurvey($request, $response, $args){
        $input = $request->getParsedBody();
        $email = isset($_GET['email']) ? $_GET['email'] : '';
        $companyDisplayName = isset($input['companyDisplayName']) ? $input['companyDisplayName'] : '';
        $surveyDate = isset($input['surveyDate']) ? $input['surveyDate'] : '';
        $time = isset($input['time']) ? $input['time'] : '';
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
        $subject = "Survey notifications";
    
        ////////////
        $body = "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" . "\r\n";
        $body .= $companyDisplayName . "調査会社様". "\r\n". "\r\n";
        $body .= "左記の日程で地盤調査を申込を申込ます。". "\r\n". "\r\n";
        $body .= "地盤調査が可能な日時をおしらせください。". "\r\n". "\r\n";
        $body .= "⬜︎ いずれの候補も都合がつきません。". "\r\n";
        $body .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━" . "\r\n";
        

        if($surveyDate!==''){
            $body = "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" . "\r\n";
            $body .= $companyDisplayName . "ビルダー様". "\r\n". "\r\n";
            $body .= "下記の日程で地盤調査を実施できます。". "\r\n". "\r\n";
            $body .= "調査日：". $surveyDate . "\r\n";
            $body .= "時間　：". $time . "\r\n";
            $body .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━" . "\r\n";
        }

        //if(mb_send_mail($to,$subject,$body,$header)){
        if(mail($to,$subject,$body,$header)){
            return true;
        }else {
            return false;
        }
    }

    // Update status Survey with Id
    public function updateStatusSurveyWithId($request, $response, $args) {
        $input = $request->getParsedBody();
        $id = $args['id'];
        $status = $input['status'];

        $this->db->beginTransaction();
        try {
            $sql = "UPDATE tb_survey SET status=:status 
                    WHERE id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('status', $status);
            $stmt->bindParam("id", $id);
            $stmt->execute();
            
            if($status==2){
                // select user đăng kí
                $sql = "SELECT userId FROM tb_survey WHERE id=:id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("id", $id);
                $stmt->execute();
                $result = $stmt->fetchObject();
                $userId = $result->userId;
                // xoa data 
                // delete notify
                $stmt = $this->db->prepare("DELETE FROM tb_inbox WHERE id=:surveyId AND flag=1");
                $stmt->bindParam("surveyId", $id);
                $result = $stmt->execute();

                //insert
                $sql = "INSERT INTO tb_inbox (flag, id, userId_target) 
                            VALUES (2, :id, :userId_target)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam('id', $id);
                $stmt->bindParam('userId_target', $userId);
            	$result = $stmt->execute();
            }

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

    //Get sum Survey by status in id
    //todo
    public function totalSuveyByStatus($request, $response, $args) {
        $input = $request->getParsedBody();
        $userId = $input['userId'];
        $statusPublic = $input['statusPublic'];
		
        //get Survey
        $sql = "SELECT count(statusPublic) as total 
                FROM tb_survey 
                WHERE statusPublic=:statusPublic AND userId=:userId";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("statusPublic", $statusPublic);
        $stmt->bindParam("userId", $userId);
						 
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    //Get details Survey by status in id
    //todo
    public function detailSuveyByStatus($request, $response, $args) {
        $input = $request->getParsedBody();
        $userId = $input['userId'];
        $statusPublic = $input['statusPublic'];
        
        //get Survey
        $sql = "SELECT id, update_date 
                FROM tb_survey 
                WHERE statusPublic=:statusPublic AND userId=:userId 
                ORDER BY update_date DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("statusPublic", $statusPublic);
        $stmt->bindParam("userId", $userId);							
		 
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        return $response->withJson($result);
    }

    //Get sum Survey by status in id
    //todo
    public function totalSuveyByStatus1($request, $response, $args) {
        $input = $request->getParsedBody();
        $userId = $input['userId'];
        
        //get Survey
        $sql = "SELECT count(*) as total 
                FROM (SELECT companyID FROM tb_users WHERE id=:userId) AS tb_users 
                INNER JOIN (SELECT id, scheduled_survey_company_id, update_date 
                            FROM tb_survey
                            WHERE statusPublic=1 ) AS tb_survey 
                    ON tb_users.companyID = tb_survey.scheduled_survey_company_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("userId", $userId);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    //Get details Survey by status in id
    //todo
    public function detailSuveyByStatus1($request, $response, $args) {
        $input = $request->getParsedBody();
        $userId = $input['userId'];
        $statusPublic = $input['statusPublic'];
        
        //get Survey
        $sql = "SELECT tb_survey.id, tb_survey.update_date 
                FROM (SELECT companyID FROM tb_users WHERE id=:userId) AS tb_users 
                INNER JOIN (SELECT id, scheduled_survey_company_id, update_date 
                            FROM tb_survey
                            WHERE statusPublic=1 ) AS tb_survey 
                    ON tb_users.companyID = tb_survey.scheduled_survey_company_id 
                ORDER BY tb_survey.update_date DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("userId", $userId);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        return $response->withJson($result);
    }


    //Get sum Survey by status=1 in id
    //todo
    public function totalSuveyByStatusEq1($request, $response, $args) {
        $input = $request->getParsedBody();
        $userId = $input['userId'];
        $status = $input['status'];
        
        //get company
        $sql = "SELECT companyID 
        FROM tb_users 
        WHERE id=:userId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("userId", $userId);
        $stmt->execute();
        $result = $stmt->fetchObject();

        $companyID = $result->companyID;

        //get Survey
        $sql = "SELECT count(id) as total 
                FROM tb_survey 
                WHERE statusPublic=1 AND status=:status AND (scheduled_survey_company_id = :companyID OR userId=:userId)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("userId", $userId);
        $stmt->bindParam("companyID", $companyID);
        $stmt->bindParam("status", $status);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    //Get details Survey by status in id
    //todo
    public function detailSuveyByStatusEq1($request, $response, $args) {
        $input = $request->getParsedBody();
        $userId = $input['userId'];
        $status = $input['status'];

        //get company
        $sql = "SELECT companyID 
        FROM tb_users 
        WHERE id=:userId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("userId", $userId);
        $stmt->execute();
        $result = $stmt->fetchObject();

        $companyID = $result->companyID;

        //get Survey
        $sql = "SELECT id, update_date 
                FROM tb_survey 
                WHERE statusPublic=1 AND status=:status AND (scheduled_survey_company_id = :companyID OR userId=:userId) 
                ORDER BY update_date DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("userId", $userId);
        $stmt->bindParam("companyID", $companyID);
        $stmt->bindParam("status", $status);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        return $response->withJson($result);
    }


    //check Survey by Id
    public function checkSurveyById($request, $response, $args) {
        $id = $args['id'];
        
        try{
            //get Survey
            $sql = "SELECT id 
                    FROM tb_survey 
                    WHERE tb_survey.id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("id", $id);
            $stmt->execute();
            if($stmt->rowCount()==0){
                return $response->withStatus(500);
            }
            return $response->withStatus(200);
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


    // màn hình map-survey
    public function totalSuveyMap($request, $response, $args) {
        $input = $request->getParsedBody();
        $userId = $input['userId'];
		
        //get Survey
        $sql = "SELECT count(statusPublic) as total, SUM(CASE WHEN statusSurvey = '成立済' THEN 1 ELSE 0 END) AS totalEstablished 
                FROM tb_survey 
                WHERE statusPublic=1 AND userId=:userId";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("userId", $userId);
						 
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }


    public function getAllSurveyMap($request, $response, $args) {
        $input = $request->getParsedBody();
        $userId = $input['userId'];
        try{
            $sql = "SELECT id, location_information, statusSurvey, property_name, c_business_name, survey_date, street_address, survey_method, note 
                    FROM tb_survey 
                    WHERE userId=:userId AND statusPublic=1";
            
            $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
            $offset= isset($_GET['offset']) ? $_GET['offset'] : 0;
            if($limit>0){
                $sql .= "LIMIT $limit OFFSET $offset ";
            }
    
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("userId", $userId);
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
    // màn hình map-survey
}