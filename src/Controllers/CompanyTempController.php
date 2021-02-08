<?php
namespace Controllers;

class CompanyTempController
{
    private $db;

    // constructor receives container instance
    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllCompany($request, $response, $args) {
        try{
            $sql = "SELECT companyId, name, shortName, shortNameYomi, type, legalName, phone, fax, 
                           email, url, president, establishDate, capital, employee, status, client_uid 
                    FROM tb_company_temp 
                    ORDER BY name ";
            
            $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
            $offset= isset($_GET['offset']) ? $_GET['offset'] : 0;
            if($limit>0){
                $sql .= "LIMIT $limit OFFSET $offset ";
            }
    
            $stmt = $this->db->prepare($sql);
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

    //Get company by companyId
    public function getCompanyByCompanyId($request, $response, $args) {
        $companyId = $args['id'];
        
        //get company
        $sql = "SELECT companyId, name, shortName, shortNameYomi, type, legalName, phone, fax, 
                       email, url, president, establishDate, capital, employee, status, client_uid  
                FROM tb_company_temp WHERE companyId=:companyId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("companyId", $companyId);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    // Add a new company
    public function addNewCompany($request, $response) {
        $input = $request->getParsedBody();
        $name = $input['name'];
        $shortName = $input['shortName'];
        $shortNameYomi = $input['shortNameYomi'];
        $type = $input['type'];
        $legalName = $input['legalName'];
        $phone = $input['phone'];
        $fax = $input['fax'];
        $email = $input['email'];
        $url = $input['url'];
        $president = $input['president'];
        $establishDate = $input['establishDate'];
        $capital = $input['capital'];
        $employee = $input['employee']; 
        $status = $input['status'];
        $client_uid = $input['client_uid'];
        
        $this->db->beginTransaction();
        try {
            //insert company
            $sql = "INSERT INTO tb_company_temp (name, shortName, shortNameYomi, type, legalName, phone, fax, email, url, president, establishDate, capital, employee, status, client_uid) 
                        VALUES (:name, :shortName, :shortNameYomi, :type, :legalName, :phone, :fax, :email, :url, :president, :establishDate, :capital, :employee, 
                                :status, :client_uid)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("name", $name);
            $stmt->bindParam("shortName", $shortName);
            $stmt->bindParam("shortNameYomi", $shortNameYomi);
            $stmt->bindParam("type", $type);
            $stmt->bindParam("legalName", $legalName);
            $stmt->bindParam("phone", $phone);
            $stmt->bindParam("fax", $fax);
            $stmt->bindParam("email", $email);
            $stmt->bindParam("url", $url);
            $stmt->bindParam("president", $president);
            $stmt->bindParam("establishDate", $establishDate);
            $stmt->bindParam("capital", $capital);
            $stmt->bindParam("employee", $employee);
            $stmt->bindParam("status", $status);
            $stmt->bindParam("client_uid", $client_uid);
    
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

    // Update company with companyId
    public function updateCompanyWithCompanyId($request, $response, $args) {
        $input = $request->getParsedBody();
        $companyId = $args['id'];
        $name = $input['name'];
        $shortName = $input['shortName'];
        $shortNameYomi = $input['shortNameYomi'];
        $type = $input['type'];
        $legalName = $input['legalName'];
        $phone = $input['phone'];
        $fax = $input['fax'];
        $email = $input['email'];
        $url = $input['url'];
        $president = $input['president'];
        $establishDate = $input['establishDate'];
        $capital = $input['capital'];
        $employee = $input['employee'];
        $status = $input['status'];
        $client_uid = $input['client_uid'];    
    
        $this->db->beginTransaction();
        try {
            //update company
            $stmt = $this->db->prepare("DELETE FROM tb_company_temp WHERE companyId=:companyId");
            $stmt->bindParam("companyId", $companyId);
            $stmt->execute();
    
            $sql = "INSERT INTO tb_company_temp (companyId, name, shortName, shortNameYomi, type, legalName, phone, fax, email, url, president, establishDate, capital, employee, status, client_uid)  
                        VALUES (:companyId, :name, :shortName, :shortNameYomi, :type, :legalName, :phone, :fax, :email, :url, :president, :establishDate, :capital, :employee, :status, :client_uid)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("companyId", $companyId);
            $stmt->bindParam("name", $name);
            $stmt->bindParam("shortName", $shortName);
            $stmt->bindParam("shortNameYomi", $shortNameYomi);
            $stmt->bindParam("type", $type);
            $stmt->bindParam("legalName", $legalName);
            $stmt->bindParam("phone", $phone);
            $stmt->bindParam("fax", $fax);
            $stmt->bindParam("email", $email);
            $stmt->bindParam("url", $url);
            $stmt->bindParam("president", $president);
            $stmt->bindParam("establishDate", $establishDate);
            $stmt->bindParam("capital", $capital);
            $stmt->bindParam("employee", $employee);
            $stmt->bindParam("status", $status);
            $stmt->bindParam("client_uid", $client_uid);
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

    // delete a company with companyId
    public function deleteCompanyWithCompanyId($request, $response, $args) {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare("DELETE FROM tb_company_temp WHERE companyId=:companyId");
            $stmt->bindParam("companyId", $args['id']);
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