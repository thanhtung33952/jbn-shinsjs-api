<?php
namespace Controllers;

class SurveyInfoController
{
    private $db;

    // constructor receives container instance
    public function __construct($db) {
        $this->db = $db;
    }

    //Get Survey info by Id
    public function getSurveyInfoById($request, $response, $args) {
        $survey_id = $args['id'];
        $measurement_point_no = isset($_GET['no']) ? $_GET['no'] : 0;

        //get Survey info
        $sql = "SELECT id, survey_id, site_name, weather, remarks, measurement_point_no, water_level, measurement_content, phenol_reaction 
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
        $survey_info_id = $result->id;
        //get Survey info wsw
        $sql = "SELECT wsw, half_revolution, shari, jari, gully, excavation, 
                        ston, sursul, yukuri, jinwali, number_of_hits, idling, sandy_soil, clay_soil, other 
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


    //Get Status Survey info by Id
    public function getStatusSurveyInfoById($request, $response, $args) {
        $survey_id = $args['id'];

        $maxNoActive=0;
        $details=[];
        //get max No Active info
        $sql = "SELECT measurement_point_no 
                FROM survey_info 
                WHERE survey_id=:survey_id 
                ORDER BY measurement_point_no DESC 
                LIMIT 1 ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("survey_id", $survey_id);
        $stmt->execute();
        $result = $stmt->fetchObject();
        if($stmt->rowCount()!=0){
            $maxNoActive=$result->measurement_point_no;
        }

        $data->maxNoActive = $maxNoActive;

        //get details active info
        $sql = "SELECT measurement_point_no AS No  
                FROM survey_info 
                WHERE survey_id=:survey_id 
                ORDER BY measurement_point_no";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("survey_id", $survey_id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if($stmt->rowCount()!=0){
            $details=array_column($result, "No");
        }
        $data->details = $details;
        return $response->withJson($data);
    }

    // Add a new SurveyInfo
    public function addNewSurveyInfo($request, $response) {
        $input = $request->getParsedBody();
        
        $survey_id = $input['survey_id'];
        $site_name = $input['site_name'];
        $weather = $input['weather'];
        $remarks = $input['remarks'];
        $measurement_point_no = $input['measurement_point_no'];
        $water_level = $input['water_level'];
        $measurement_content = $input['measurement_content'];
        $phenol_reaction = $input['phenol_reaction'];

        $this->db->beginTransaction();
        try {
            //insert
            $sql = "INSERT INTO survey_info (survey_id, site_name, weather, remarks, measurement_point_no, water_level, measurement_content, phenol_reaction) 
                        VALUES (:survey_id, :site_name, :weather, :remarks, :measurement_point_no, :water_level, :measurement_content, :phenol_reaction)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('survey_id', $survey_id);
            $stmt->bindParam('site_name', $site_name);
            $stmt->bindParam('weather', $weather);
            $stmt->bindParam('remarks', $remarks);
            $stmt->bindParam('measurement_point_no', $measurement_point_no);
            $stmt->bindParam('water_level', $water_level);
            $stmt->bindParam('measurement_content', $measurement_content);
            $stmt->bindParam('phenol_reaction', $phenol_reaction);
    
            $stmt->execute();
            $survey_info_id = $this->db->lastInsertId();
    


            $m = array("0.25", "0.50", "0.75", "1.00", "1.25", "1.50", "1.75", "2.00", "2.25", "2.50", "2.75", "3.00", "3.25", "3.50", "3.75", "4.00", "4.25", "4.50", "4.75", "5.00", "5.25", "5.50", "5.75", "6.00", "6.25", "6.50", "6.75", "7.00", "7.25", "7.50", "7.75", "8.00", "8.25", "8.50", "8.75", "9.00", "9.25", "9.50", "9.75", "10.00"); 
            foreach ($m as $value) {
                $wsw = $input[$value]['wsw'];
                $half_revolution = $input[$value]['half_revolution'];
                $penetration_depth = $value;
                $shari = $input[$value]['shari'];
                $jari = $input[$value]['jari'];
                $gully = $input[$value]['gully'];
                $excavation = $input[$value]['excavation'];
                $ston = $input[$value]['ston'];
                $sursul = $input[$value]['sursul'];
                $yukuri = $input[$value]['yukuri'];
                $jinwali = $input[$value]['jinwali'];
                $number_of_hits = $input[$value]['number_of_hits'];
                $idling = $input[$value]['idling'];
                $sandy_soil = $input[$value]['sandy_soil'];
                $clay_soil = $input[$value]['clay_soil'];
                $other = $input[$value]['other'];

                //insert
                $sql = "INSERT INTO survey_info_wsw (survey_info_id, wsw, half_revolution, penetration_depth, shari, jari, gully, excavation, 
                                    ston, sursul, yukuri, jinwali, number_of_hits, idling, sandy_soil, clay_soil, other) 
                            VALUES (:survey_info_id, :wsw, :half_revolution, :penetration_depth, :shari, :jari, :gully, :excavation, 
                                    :ston, :sursul, :yukuri, :jinwali, :number_of_hits, :idling, :sandy_soil, :clay_soil, :other)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam('survey_info_id', $survey_info_id);
                $stmt->bindParam('wsw', $wsw);
                $stmt->bindParam('half_revolution', $half_revolution);
                $stmt->bindParam('penetration_depth', $penetration_depth);
                $stmt->bindParam('shari', $shari);
                $stmt->bindParam('jari', $jari);
                $stmt->bindParam('gully', $gully);
                $stmt->bindParam('excavation', $excavation);
                $stmt->bindParam('ston', $ston);
                $stmt->bindParam('sursul', $sursul);
                $stmt->bindParam('yukuri', $yukuri);
                $stmt->bindParam('jinwali', $jinwali);
                $stmt->bindParam('number_of_hits', $number_of_hits);
                $stmt->bindParam('idling', $idling);
                $stmt->bindParam('sandy_soil', $sandy_soil);
                $stmt->bindParam('clay_soil', $clay_soil);
                $stmt->bindParam('other', $other);
        
                $stmt->execute();
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

    // Update Survey with Id
    public function updateSurveyInfoWithId($request, $response, $args) {
        $input = $request->getParsedBody();
        $survey_id = $args['id'];
        $site_name = $input['site_name'];
        $weather = $input['weather'];
        $remarks = $input['remarks'];
        $measurement_point_no = $input['measurement_point_no'];
        $water_level = $input['water_level'];
        $measurement_content = $input['measurement_content'];
        $phenol_reaction = $input['phenol_reaction'];


        $this->db->beginTransaction();
        try {
            //insert
            $sql = "UPDATE survey_info SET site_name=:site_name, weather=:weather, remarks=:remarks, 
                            water_level=:water_level, measurement_content=:measurement_content, phenol_reaction=:phenol_reaction 
                    WHERE survey_id=:survey_id AND measurement_point_no=:measurement_point_no";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('survey_id', $survey_id);
            $stmt->bindParam('site_name', $site_name);
            $stmt->bindParam('weather', $weather);
            $stmt->bindParam('remarks', $remarks);
            $stmt->bindParam('measurement_point_no', $measurement_point_no);
            $stmt->bindParam('water_level', $water_level);
            $stmt->bindParam('measurement_content', $measurement_content);
            $stmt->bindParam('phenol_reaction', $phenol_reaction);
    
            $stmt->execute();
            // $survey_info_id = $this->db->lastUpdateId();
            
            $stmt = $this->db->prepare("SELECT id FROM survey_info WHERE survey_id=:survey_id AND measurement_point_no=:measurement_point_no");
            $stmt->bindParam('survey_id', $survey_id);
            $stmt->bindParam('measurement_point_no', $measurement_point_no);
            $stmt->execute();
            $row =$stmt->fetchObject();
            $survey_info_id = $row->id;


            $m = array("0.25", "0.50", "0.75", "1.00", "1.25", "1.50", "1.75", "2.00", "2.25", "2.50", "2.75", "3.00", "3.25", "3.50", "3.75", "4.00", "4.25", "4.50", "4.75", "5.00", "5.25", "5.50", "5.75", "6.00", "6.25", "6.50", "6.75", "7.00", "7.25", "7.50", "7.75", "8.00", "8.25", "8.50", "8.75", "9.00", "9.25", "9.50", "9.75", "10.00"); 
            foreach ($m as $value) {
                $wsw = $input[$value]['wsw'];
                $half_revolution = $input[$value]['half_revolution'];
                $penetration_depth = $value;
                $shari = $input[$value]['shari'];
                $jari = $input[$value]['jari'];
                $gully = $input[$value]['gully'];
                $excavation = $input[$value]['excavation'];
                $ston = $input[$value]['ston'];
                $sursul = $input[$value]['sursul'];
                $yukuri = $input[$value]['yukuri'];
                $jinwali = $input[$value]['jinwali'];
                $number_of_hits = $input[$value]['number_of_hits'];
                $idling = $input[$value]['idling'];
                $sandy_soil = $input[$value]['sandy_soil'];
                $clay_soil = $input[$value]['clay_soil'];
                $other = $input[$value]['other'];

                //update
                $sql = "UPDATE survey_info_wsw SET wsw=:wsw, half_revolution=:half_revolution, shari=:shari, 
                            jari=:jari, gully=:gully, excavation=:excavation, ston=:ston, sursul=:sursul, yukuri=:yukuri, jinwali=:jinwali, number_of_hits=:number_of_hits, 
                            idling=:idling, sandy_soil=:sandy_soil, clay_soil=:clay_soil, other=:other 
                        WHERE survey_info_id=:survey_info_id AND penetration_depth=:penetration_depth";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam('survey_info_id', $survey_info_id);
                $stmt->bindParam('wsw', $wsw);
                $stmt->bindParam('half_revolution', $half_revolution);
                $stmt->bindParam('penetration_depth', $penetration_depth);
                $stmt->bindParam('shari', $shari);
                $stmt->bindParam('jari', $jari);
                $stmt->bindParam('gully', $gully);
                $stmt->bindParam('excavation', $excavation);
                $stmt->bindParam('ston', $ston);
                $stmt->bindParam('sursul', $sursul);
                $stmt->bindParam('yukuri', $yukuri);
                $stmt->bindParam('jinwali', $jinwali);
                $stmt->bindParam('number_of_hits', $number_of_hits);
                $stmt->bindParam('idling', $idling);
                $stmt->bindParam('sandy_soil', $sandy_soil);
                $stmt->bindParam('clay_soil', $clay_soil);
                $stmt->bindParam('other', $other);
        
                $stmt->execute();
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

    // delete a SurveyInfo with Id
    public function deleteSurveyInfoWithId($request, $response, $args) {
        $input = $request->getParsedBody();
        $survey_id = $args['id'];
        $measurement_point_no = $input['measurement_point_no'];

        $this->db->beginTransaction();
        try {
            //get id SurveyInfo
            $sql = "SELECT id 
            FROM survey_info 
            WHERE survey_id=:survey_id AND measurement_point_no=:measurement_point_no";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("survey_id", $survey_id);
            $stmt->bindParam("measurement_point_no", $measurement_point_no);
            $stmt->execute();
            
            if($stmt->rowCount()!=0){
                $result = $stmt->fetchObject();
                $survey_info_id=$result->id;

                //delete info
                $stmt = $this->db->prepare("DELETE FROM survey_info WHERE survey_id=:survey_id AND measurement_point_no=:measurement_point_no");
                $stmt->bindParam("survey_id", $survey_id);
                $stmt->bindParam("measurement_point_no", $measurement_point_no);
                $result = $stmt->execute();

                //delete info sws
                $stmt = $this->db->prepare("DELETE FROM survey_info_wsw WHERE survey_info_id=:survey_info_id");
                $stmt->bindParam("survey_info_id", $survey_info_id);
                $result = $stmt->execute();
            }
            
            // update No SurveyInfo
            for ($x = $measurement_point_no + 1; $x <= 10; $x++) {
                $noNew=$x-1;
                $sql = "UPDATE survey_info SET measurement_point_no=:noNew 
                        WHERE survey_id=:survey_id AND measurement_point_no=:x";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("survey_id", $survey_id);
                $stmt->bindParam('noNew', $noNew);
                $stmt->bindParam('x', $x);
                $stmt->execute();
            }

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