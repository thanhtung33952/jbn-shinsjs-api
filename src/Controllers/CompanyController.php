<?php
namespace Controllers;

class CompanyController
{
    private $db;

    // constructor receives container instance
    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllCompany($request, $response, $args) {
        try{
            $sql = "SELECT companyId, companyDisplayName, companyFormalName, phonetic, phoneNumber, faxNumber, representativeEmail
                         , website, contentOfTrans, tb_company.addressID, postalCode, province, city, streetAddress, buildingName, latitude, longitute, createDate, createUserTemp, createUser 
                         , fcFranchiseStore, companyForm, representativeName, capital, establishmentDate, employeesNo, contactName, contactInformation 
                    FROM tb_company 
                    LEFT JOIN (SELECT addressId, postalCode, province, city, streetAddress, buildingName, latitude, longitute 
                            FROM tb_address) AS tb_address 
                        ON tb_company.addressId=tb_company.addressId 
                    ORDER BY companyId ";
            
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
        $sql = "SELECT companyId, companyDisplayName, companyFormalName, phonetic, phoneNumber, faxNumber, representativeEmail
                     , website, contentOfTrans, tb_company.addressID, postalCode, province, city, streetAddress, buildingName, latitude, longitute, createDate, createUserTemp, createUser 
                     , fcFranchiseStore, companyForm, representativeName, capital, establishmentDate, employeesNo, contactName, contactInformation 
                FROM tb_company 
                LEFT JOIN (SELECT addressId, postalCode, province, city, streetAddress, buildingName, latitude, longitute 
                            FROM tb_address) AS tb_address 
                    ON tb_company.addressId=tb_company.addressId 
                WHERE companyId=:companyId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("companyId", $companyId);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    // Add a new company
    public function addNewCompany($request, $response) {
        $input = $request->getParsedBody();
        $companyDisplayName = $input['companyDisplayName'];
        $companyFormalName = $input['companyFormalName'];
        $phonetic = $input['phonetic'];
        $phoneNumber = $input['phoneNumber'];
        $faxNumber = $input['faxNumber'];
        $representativeEmail = $input['representativeEmail'];
        $website = $input['website'];
        $contentOfTrans = $input['contentOfTrans'];
        //$addressID = $input['addressID'];
        $createUserTemp = $input['createUserTemp'];
        $createUser = $input['createUser'];
        
        $fcFranchiseStore = isset($input['fcFranchiseStore'])? $input['fcFranchiseStore'] : NULL;
        $companyForm = isset($input['companyForm'])? $input['companyForm'] : NULL;
        $representativeName = isset($input['representativeName'])? $input['representativeName'] : NULL;
        $capital = isset($input['capital'])? $input['capital'] : NULL;
        $establishmentDate = isset($input['establishmentDate'])? $input['establishmentDate'] : NULL;
        $employeesNo = isset($input['employeesNo'])? $input['employeesNo'] : NULL;
        $contactName = isset($input['contactName'])? $input['contactName'] : NULL;
        $contactInformation = isset($input['contactInformation'])? $input['contactInformation'] : NULL;

        // info address
        $postalCode = $input['postalCode'];
        $province = $input['province'];
        $city = $input['city'];
        $streetAddress = $input['streetAddress'];
        $buildingName = $input['buildingName'];
        $latitude = isset($input['latitude'])? $input['latitude'] : NULL;
        $longitute = isset($input['longitute'])? $input['longitute'] : NULL;
        
    
        $this->db->beginTransaction();
        try {
            //insert address
            //check exist address
            $sql = "SELECT addressId 
                    FROM tb_address 
                    WHERE postalCode=:postalCode AND province=:province AND city=:city AND streetAddress=:streetAddress AND buildingName=:buildingName";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("postalCode", $postalCode);
            $stmt->bindParam("province", $province);
            $stmt->bindParam("city", $city);
            $stmt->bindParam("streetAddress", $streetAddress);
            $stmt->bindParam("buildingName", $buildingName);
            $stmt->execute();
            $result = $stmt->fetch();
            if($stmt->rowCount()>0){
                $addressID = $result["addressId"];
            }
            else{
                $sql = "INSERT INTO tb_address (postalCode, province, city, streetAddress, buildingName, latitude, longitute) 
                            VALUES (:postalCode, :province, :city, :streetAddress, :buildingName, :latitude, :longitute)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("postalCode", $postalCode);
                $stmt->bindParam("province", $province);
                $stmt->bindParam("city", $city);
                $stmt->bindParam("streetAddress", $streetAddress);
                $stmt->bindParam("buildingName", $buildingName);
                $stmt->bindParam("latitude", $latitude);
                $stmt->bindParam("longitute", $longitute);
        
                $stmt->execute();
                $addressID = $this->db->lastInsertId();
            }

            //insert company
            $sql = "INSERT INTO tb_company (companyDisplayName, companyFormalName, phonetic, phoneNumber, faxNumber, representativeEmail
                              , website, contentOfTrans, addressID, createUserTemp, createUser
                              , fcFranchiseStore, companyForm, representativeName, capital, establishmentDate, employeesNo, contactName, contactInformation) 
                        VALUES (:companyDisplayName, :companyFormalName, :phonetic, :phoneNumber, :faxNumber, :representativeEmail
                              , :website, :contentOfTrans, :addressID, :createUserTemp, :createUser
                              , :fcFranchiseStore, :companyForm, :representativeName, :capital, :establishmentDate, :employeesNo, :contactName, :contactInformation)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("companyDisplayName", $companyDisplayName);
            $stmt->bindParam("companyFormalName", $companyFormalName);
            $stmt->bindParam("phonetic", $phonetic);
            $stmt->bindParam("phoneNumber", $phoneNumber);
            $stmt->bindParam("faxNumber", $faxNumber);
            $stmt->bindParam("representativeEmail", $representativeEmail);
            $stmt->bindParam("website", $website);
            $stmt->bindParam("contentOfTrans", $contentOfTrans);
            $stmt->bindParam("addressID", $addressID);
            $stmt->bindParam("createUserTemp", $createUserTemp);
            $stmt->bindParam("createUser", $createUser);
            $stmt->bindParam("fcFranchiseStore", $fcFranchiseStore);
            $stmt->bindParam("companyForm", $companyForm);
            $stmt->bindParam("representativeName", $representativeName);
            $stmt->bindParam("capital", $capital);
            $stmt->bindParam("establishmentDate", $establishmentDate);
            $stmt->bindParam("employeesNo", $employeesNo);
            $stmt->bindParam("contactName", $contactName);
            $stmt->bindParam("contactInformation", $contactInformation);
    
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
        $companyDisplayName = $input['companyDisplayName'];
        $companyFormalName = $input['companyFormalName'];
        $phonetic = $input['phonetic'];
        $phoneNumber = $input['phoneNumber'];
        $faxNumber = $input['faxNumber'];
        $representativeEmail = $input['representativeEmail'];
        $website = $input['website'];
        $contentOfTrans = $input['contentOfTrans'];
        //$addressID = $input['addressID'];
        $createUserTemp = $input['createUserTemp'];
        $createUser = $input['createUser'];

        $fcFranchiseStore = isset($input['fcFranchiseStore'])? $input['fcFranchiseStore'] : NULL;
        $companyForm = isset($input['companyForm'])? $input['companyForm'] : NULL;
        $representativeName = isset($input['representativeName'])? $input['representativeName'] : NULL;
        $capital = isset($input['capital'])? $input['capital'] : NULL;
        $establishmentDate = isset($input['establishmentDate'])? $input['establishmentDate'] : NULL;
        $employeesNo = isset($input['employeesNo'])? $input['employeesNo'] : NULL;
        $contactName = isset($input['contactName'])? $input['contactName'] : NULL;
        $contactInformation = isset($input['contactInformation'])? $input['contactInformation'] : NULL;

        // info address
        $postalCode = $input['postalCode'];
        $province = $input['province'];
        $city = $input['city'];
        $streetAddress = $input['streetAddress'];
        $buildingName = $input['buildingName'];
        $latitude = isset($input['latitude'])? $input['latitude'] : NULL;
        $longitute = isset($input['longitute'])? $input['longitute'] : NULL;
    
        $this->db->beginTransaction();
        try {
            //insert address
            //check exist address
            $sql = "SELECT addressId 
                    FROM tb_address 
                    WHERE postalCode=:postalCode AND province=:province AND city=:city AND streetAddress=:streetAddress AND buildingName=:buildingName";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("postalCode", $postalCode);
            $stmt->bindParam("province", $province);
            $stmt->bindParam("city", $city);
            $stmt->bindParam("streetAddress", $streetAddress);
            $stmt->bindParam("buildingName", $buildingName);
            $stmt->execute();
            $result = $stmt->fetch();
            if($stmt->rowCount()>0){
                $addressID = $result["addressId"];
            }
            else{
                $sql = "INSERT INTO tb_address (postalCode, province, city, streetAddress, buildingName, latitude, longitute) 
                            VALUES (:postalCode, :province, :city, :streetAddress, :buildingName, :latitude, :longitute)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("postalCode", $postalCode);
                $stmt->bindParam("province", $province);
                $stmt->bindParam("city", $city);
                $stmt->bindParam("streetAddress", $streetAddress);
                $stmt->bindParam("buildingName", $buildingName);
                $stmt->bindParam("latitude", $latitude);
                $stmt->bindParam("longitute", $longitute);
        
                $stmt->execute();
                $addressID = $this->db->lastInsertId();
            }

            //update company
            $stmt = $this->db->prepare("DELETE FROM tb_company WHERE companyId=:companyId");
            $stmt->bindParam("companyId", $companyId);
            $stmt->execute();
    
            $sql = "INSERT INTO tb_company (companyId, companyDisplayName, companyFormalName, phonetic, phoneNumber, faxNumber, representativeEmail
                              , website, contentOfTrans, addressID, createUserTemp, createUser
                              , fcFranchiseStore, companyForm, representativeName, capital, establishmentDate, employeesNo, contactName, contactInformation) 
                        VALUES (:companyId, :companyDisplayName, :companyFormalName, :phonetic, :phoneNumber, :faxNumber, :representativeEmail
                              , :website, :contentOfTrans, :addressID, :createUserTemp, :createUser
                              , :fcFranchiseStore, :companyForm, :representativeName, :capital, :establishmentDate, :employeesNo, :contactName, :contactInformation)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("companyId", $companyId);
            $stmt->bindParam("companyDisplayName", $companyDisplayName);
            $stmt->bindParam("companyFormalName", $companyFormalName);
            $stmt->bindParam("phonetic", $phonetic);
            $stmt->bindParam("phoneNumber", $phoneNumber);
            $stmt->bindParam("faxNumber", $faxNumber);
            $stmt->bindParam("representativeEmail", $representativeEmail);
            $stmt->bindParam("website", $website);
            $stmt->bindParam("contentOfTrans", $contentOfTrans);
            $stmt->bindParam("addressID", $addressID);
            $stmt->bindParam("createUserTemp", $createUserTemp);
            $stmt->bindParam("createUser", $createUser);
            $stmt->bindParam("fcFranchiseStore", $fcFranchiseStore);
            $stmt->bindParam("companyForm", $companyForm);
            $stmt->bindParam("representativeName", $representativeName);
            $stmt->bindParam("capital", $capital);
            $stmt->bindParam("establishmentDate", $establishmentDate);
            $stmt->bindParam("employeesNo", $employeesNo);
            $stmt->bindParam("contactName", $contactName);
            $stmt->bindParam("contactInformation", $contactInformation);
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
            $stmt = $this->db->prepare("DELETE FROM tb_company WHERE companyId=:companyId");
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

    // Search company with companyDisplayName, companyFormalName
    public function seachCompanyWithName($request, $response, $args) {
        $keySearch= isset($args['name'])? $args['name'] : "";
        try{
            $sql = "SELECT companyId AS id, companyDisplayName AS name, representativeEmail, contactName, contactInformation 
                    FROM tb_company 
                    WHERE UPPER(companyDisplayName) LIKE :companyDisplayName 
                    UNION  
                    SELECT companyId AS id, companyFormalName AS name, representativeEmail, contactName, contactInformation 
                    FROM tb_company 
                    WHERE UPPER(companyFormalName) LIKE :companyFormalName

                    ORDER BY name ";
            
            $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
            $offset= isset($_GET['offset']) ? $_GET['offset'] : 0;
            if($limit>0){
                $sql .= "LIMIT $limit OFFSET $offset ";
            }
    
            $stmt = $this->db->prepare($sql);
            $query = "%".$keySearch."%";
            $stmt->bindParam("companyDisplayName", $query);
            $stmt->bindParam("companyFormalName", $query);
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
}