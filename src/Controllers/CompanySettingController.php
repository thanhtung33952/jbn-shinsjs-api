<?php
namespace Controllers;

class CompanySettingController
{
    private $db;

    // constructor receives container instance
    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllCompanySetting($request, $response, $args) {
        try{
            $sql = "SELECT companyId, creditLimit, creditStatus, authConfirmScreen, authReceiptDoc, invoiceMailingAddress, personNameInCharge
                         , payer, billingMethod, outputUnit, closingClassificationDate, estimatedRecoveryDate, businessClassificationDate, bankId as bankAccount 
                         ,designated_survey_company_1, designated_survey_company_2, designated_survey_company_3, designated_survey_company_4, designated_survey_company_5 
                    FROM tb_company_setting 
                    ORDER BY companyId ";
            
            $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
            $offset= isset($_GET['offset']) ? $_GET['offset'] : 0;
            if($limit>0){
                $sql .= "LIMIT $limit OFFSET $offset ";
            }
    
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();

            foreach ($results as $key => $result) {
                //get address
                $addressId = $result["invoiceMailingAddress"];
                $sql = "SELECT addressId,  postalCode, province, city, streetAddress, buildingName, latitude, longitute 
                        FROM tb_address 
                        WHERE addressId=:addressId";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("addressId", $addressId);
                $stmt->execute();
                $results[$key]["invoiceMailingAddress"] = $stmt->fetchObject();

                //get bank account
                $bankId = $result["bankAccount"];
                $sql = "SELECT id, bankName, bankCode, branchName, branchCode, accountClassification, accountNumber, accountHolder 
                        FROM tb_bank_account 
                        WHERE id=:bankId";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("bankId", $bankId);
                $stmt->execute();
                $results[$key]["bankAccount"] = $stmt->fetchObject();

                //get credit approval log
                $companyId = $result["companyId"];
                $sql = "SELECT id, date, description, name 
                        FROM tb_credit_approval_log 
                        WHERE company_id=:companyId 
                        ORDER BY date DESC";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("companyId", $companyId);
                $stmt->execute();
                $results[$key]["creditApprovalLog"] = $stmt->fetchAll();
            }

            return $response->withJson($results);
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

    //Get CompanySetting by CompanyId
    public function getCompanySettingByCompanyId($request, $response, $args) {
        $companyId = $args['id'];
        
        //get CompanySetting
        $sql = "SELECT tb_company_setting.companyId, creditLimit, creditStatus, authConfirmScreen, authReceiptDoc, invoiceMailingAddress, personNameInCharge
                     , payer, billingMethod, outputUnit, closingClassificationDate, estimatedRecoveryDate, businessClassificationDate, bankId 
                     , designated_survey_company_1, designated_survey_company_name_1
                     , designated_survey_company_2, designated_survey_company_name_2
                     , designated_survey_company_3, designated_survey_company_name_3
                     , designated_survey_company_4, designated_survey_company_name_4
                     , designated_survey_company_5, designated_survey_company_name_5 
                FROM tb_company_setting 
                LEFT JOIN (SELECT companyId, companyDisplayName AS designated_survey_company_name_1 FROM tb_company) AS tb_company1 
                    ON tb_company1.companyId = tb_company_setting.designated_survey_company_1 
                LEFT JOIN (SELECT companyId, companyDisplayName AS designated_survey_company_name_2 FROM tb_company) AS tb_company2 
                    ON tb_company2.companyId = tb_company_setting.designated_survey_company_2 
                LEFT JOIN (SELECT companyId, companyDisplayName AS designated_survey_company_name_3 FROM tb_company) AS tb_company3 
                    ON tb_company3.companyId = tb_company_setting.designated_survey_company_3 
                LEFT JOIN (SELECT companyId, companyDisplayName AS designated_survey_company_name_4 FROM tb_company) AS tb_company4 
                    ON tb_company4.companyId = tb_company_setting.designated_survey_company_4 
                LEFT JOIN (SELECT companyId, companyDisplayName AS designated_survey_company_name_5 FROM tb_company) AS tb_company5 
                    ON tb_company5.companyId = tb_company_setting.designated_survey_company_5 
                WHERE tb_company_setting.companyId=:companyId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("companyId", $companyId);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        //get address
        $addressId = $result->invoiceMailingAddress;
        $sql = "SELECT addressId,  postalCode, province, city, streetAddress, buildingName, latitude, longitute 
                FROM tb_address 
                WHERE addressId=:addressId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("addressId", $addressId);
        $stmt->execute();
        $result->invoiceMailingAddress = $stmt->fetchObject();


        //get bank account
        $bankId = $result->bankId;
        $sql = "SELECT id, bankName, bankCode, branchName, branchCode, accountClassification, accountNumber, accountHolder 
                FROM tb_bank_account 
                WHERE id=:bankId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("bankId", $bankId);
        $stmt->execute();
        $result->bankAccount = $stmt->fetchObject();

        //get credit approval log
        $sql = "SELECT id, date, description, name 
                FROM tb_credit_approval_log 
                WHERE company_id=:companyId 
                ORDER BY date DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("companyId", $companyId);
        $stmt->execute();
        $result->creditApprovalLog = $stmt->fetchAll();

        return $response->withJson($result);
    }

    //get Company Surveys By Company Id
    public function getCompanySurveysByCompanyId($request, $response, $args) {
        $companyId = $args['id'];
        
        //get company
        $sql = "SELECT survey_company_id, companyDisplayName  
                FROM (  SELECT designated_survey_company_1 AS survey_company_id 
                        FROM tb_company_setting 
                        WHERE companyId = :companyId
                        UNION 
                        SELECT designated_survey_company_2 AS survey_company_id 
                        FROM tb_company_setting 
                        WHERE companyId = :companyId
                        UNION 
                        SELECT designated_survey_company_3 AS survey_company_id 
                        FROM tb_company_setting 
                        WHERE companyId = :companyId
                        UNION 
                        SELECT designated_survey_company_4 AS survey_company_id 
                        FROM tb_company_setting 
                        WHERE companyId = :companyId
                        UNION 
                        SELECT designated_survey_company_5 AS survey_company_id 
                        FROM tb_company_setting 
                        WHERE companyId = :companyId 
                    ) AS tb_company_setting

                LEFT JOIN (SELECT companyId, companyDisplayName  
                            FROM tb_company) AS tb_company 
                    ON tb_company.companyId=tb_company_setting.survey_company_id 
                WHERE survey_company_id IS NOT NULL 
                ORDER BY companyDisplayName";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("companyId", $companyId);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        return $response->withJson($result);
    }

    // Add a new CompanySetting
    public function addNewCompanySetting($request, $response) {
        $input = $request->getParsedBody();
        $companyId = $input['companyId'];
        
        $creditLimit = $input['creditLimit'];
        $creditStatus = $input['creditStatus'];
        $authConfirmScreen = $input['authConfirmScreen'];
        $authReceiptDoc = $input['authReceiptDoc'];

        //info invoiceMailingAddress
        $postalCode = $input['invoiceMailingAddress']['postalCode'];
        $province = $input['invoiceMailingAddress']['province'];
        $city = $input['invoiceMailingAddress']['city'];
        $streetAddress = $input['invoiceMailingAddress']['streetAddress'];
        $buildingName = $input['invoiceMailingAddress']['buildingName'];
        $latitude = isset($input['invoiceMailingAddress']['latitude'])? $input['invoiceMailingAddress']['latitude'] : NULL;
        $longitute = isset($input['invoiceMailingAddress']['longitute'])? $input['invoiceMailingAddress']['longitute'] : NULL;

        $personNameInCharge = $input['personNameInCharge'];
        $payer = $input['payer'];
        $billingMethod = $input['billingMethod'];
        $outputUnit = $input['outputUnit'];
        $closingClassificationDate = $input['closingClassificationDate'];
        $estimatedRecoveryDate = $input['estimatedRecoveryDate'];
        $businessClassificationDate = $input['businessClassificationDate'];
        
        //info bank account
        $bankName = $input['bankAccount']['bankName'];
        $bankCode = $input['bankAccount']['bankCode'];
        $branchName = $input['bankAccount']['branchName'];
        $branchCode = $input['bankAccount']['branchCode'];
        $accountClassification = $input['bankAccount']['accountClassification'];
        $accountNumber = $input['bankAccount']['accountNumber'];
        $accountHolder = $input['bankAccount']['accountHolder'];

        //
        $designated_survey_company_1 = isset($input['designated_survey_company_1'])? $input['designated_survey_company_1']:NULL;
        $designated_survey_company_2 = isset($input['designated_survey_company_2'])? $input['designated_survey_company_2']:NULL;
        $designated_survey_company_3 = isset($input['designated_survey_company_3'])? $input['designated_survey_company_3']:NULL;
        $designated_survey_company_4 = isset($input['designated_survey_company_4'])? $input['designated_survey_company_4']:NULL;
        $designated_survey_company_5 = isset($input['designated_survey_company_5'])? $input['designated_survey_company_5']:NULL;

        $this->db->beginTransaction();
        try {
            if($designated_survey_company_1!= NULL ||$designated_survey_company_2!= NULL ||$designated_survey_company_3!= NULL ||$designated_survey_company_4!= NULL ||$designated_survey_company_5!= NULL){
                //insert 5 company
                //check exist company
                $sql = "SELECT id FROM tb_company_setting WHERE companyId=:companyId";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("companyId", $companyId);
                $stmt->execute();
                if($stmt->rowCount()>0){
                    $id = $stmt->fetchColumn(); 
                    //update
                    $sql = "UPDATE tb_company_setting SET designated_survey_company_1=:designated_survey_company_1,designated_survey_company_2=:designated_survey_company_2,designated_survey_company_3=:designated_survey_company_3,designated_survey_company_4=:designated_survey_company_4,designated_survey_company_5=:designated_survey_company_5 
                            WHERE companyId=:companyId";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam("companyId", $companyId);
                    $stmt->bindParam("designated_survey_company_1", $designated_survey_company_1);
                    $stmt->bindParam("designated_survey_company_2", $designated_survey_company_2);
                    $stmt->bindParam("designated_survey_company_3", $designated_survey_company_3);
                    $stmt->bindParam("designated_survey_company_4", $designated_survey_company_4);
                    $stmt->bindParam("designated_survey_company_5", $designated_survey_company_5);
            
                    $stmt->execute();
                    $input['id'] = $id;
                    $this->db->commit();
                    return $response->withJson($input);
                }
                //insert
                $sql = "INSERT INTO tb_company_setting (companyId, designated_survey_company_1, designated_survey_company_2, designated_survey_company_3, designated_survey_company_4, designated_survey_company_5) 
                                VALUES (:companyId, :designated_survey_company_1, :designated_survey_company_2, :designated_survey_company_3, :designated_survey_company_4, :designated_survey_company_5)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("companyId", $companyId);
                $stmt->bindParam("designated_survey_company_1", $designated_survey_company_1);
                $stmt->bindParam("designated_survey_company_2", $designated_survey_company_2);
                $stmt->bindParam("designated_survey_company_3", $designated_survey_company_3);
                $stmt->bindParam("designated_survey_company_4", $designated_survey_company_4);
                $stmt->bindParam("designated_survey_company_5", $designated_survey_company_5);
        
                $stmt->execute();
                $input['id'] = $this->db->lastInsertId();
    
                $this->db->commit();
                return $response->withJson($input);
            }
            


            //check exist company
            $sql = "SELECT count(*) FROM tb_company_setting WHERE companyId=:companyId";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("companyId", $companyId);
            $stmt->execute();
            $number_of_rows = $stmt->fetchColumn(); 
            if($number_of_rows>0){
                $input['id'] = -1;
                return $response->withJson($input);
            }

            //check invoiceMailingAddress
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
                $invoiceMailingAddress = $result["addressId"];
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
                $invoiceMailingAddress = $this->db->lastInsertId();
            }
            $input['invoiceMailingAddress']['addressId']=$invoiceMailingAddress;

            //check bank_account
            $sql = "SELECT id 
                    FROM tb_bank_account 
                    WHERE bankName=:bankName AND bankCode=:bankCode AND branchName=:branchName AND branchCode=:branchCode 
                          AND accountClassification=:accountClassification AND accountNumber=:accountNumber AND accountHolder=:accountHolder";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("bankName", $bankName);
            $stmt->bindParam("bankCode", $bankCode);
            $stmt->bindParam("branchName", $branchName);
            $stmt->bindParam("branchCode", $branchCode);
            $stmt->bindParam("accountClassification", $accountClassification);
            $stmt->bindParam("accountNumber", $accountNumber);
            $stmt->bindParam("accountHolder", $accountHolder);
            $stmt->execute();
            $result = $stmt->fetch();
            if($stmt->rowCount()>0){
                $bankId = $result["id"];
            }
            else{
                $sql = "INSERT INTO tb_bank_account (bankName, bankCode, branchName, branchCode, accountClassification, accountNumber, accountHolder) 
                            VALUES (:bankName, :bankCode, :branchName, :branchCode, :accountClassification, :accountNumber, :accountHolder)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("bankName", $bankName);
            $stmt->bindParam("bankCode", $bankCode);
            $stmt->bindParam("branchName", $branchName);
            $stmt->bindParam("branchCode", $branchCode);
            $stmt->bindParam("accountClassification", $accountClassification);
            $stmt->bindParam("accountNumber", $accountNumber);
            $stmt->bindParam("accountHolder", $accountHolder);
        
                $stmt->execute();
                $bankId = $this->db->lastInsertId();
            }
            $input['bankAccount']['id']=$bankId;

            //insert tb_company_setting
            $sql = "INSERT INTO tb_company_setting (companyId, creditLimit, creditStatus, authConfirmScreen, authReceiptDoc, invoiceMailingAddress, personNameInCharge
                                                  , payer, billingMethod, outputUnit, closingClassificationDate, estimatedRecoveryDate, businessClassificationDate, bankId) 
                        VALUES (:companyId, :creditLimit, :creditStatus, :authConfirmScreen, :authReceiptDoc, :invoiceMailingAddress, :personNameInCharge
                              , :payer, :billingMethod, :outputUnit, :closingClassificationDate, :estimatedRecoveryDate, :businessClassificationDate, :bankId)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam("companyId", $companyId);
            $stmt->bindParam("creditLimit", $creditLimit);
            $stmt->bindParam("creditStatus", $creditStatus);
            $stmt->bindParam("authConfirmScreen", $authConfirmScreen);
            $stmt->bindParam("authReceiptDoc", $authReceiptDoc);
            $stmt->bindParam("invoiceMailingAddress", $invoiceMailingAddress);
            $stmt->bindParam("personNameInCharge", $personNameInCharge);
            $stmt->bindParam("payer", $payer);
            $stmt->bindParam("billingMethod", $billingMethod);
            $stmt->bindParam("outputUnit", $outputUnit);
            $stmt->bindParam("closingClassificationDate", $closingClassificationDate);
            $stmt->bindParam("estimatedRecoveryDate", $estimatedRecoveryDate);
            $stmt->bindParam("businessClassificationDate", $businessClassificationDate);
            $stmt->bindParam("bankId", $bankId);
    
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

    // Update CompanySetting with CompanyId
    public function updateCompanySettingWithCompanyId($request, $response, $args) {
        $input = $request->getParsedBody();
        $companyId = $args['id'];
        $input['companyId'] = $companyId;
        $creditLimit = $input['creditLimit'];
        $creditStatus = $input['creditStatus'];
        $authConfirmScreen = $input['authConfirmScreen'];
        $authReceiptDoc = $input['authReceiptDoc'];

        //info invoiceMailingAddress
        $postalCode = $input['invoiceMailingAddress']['postalCode'];
        $province = $input['invoiceMailingAddress']['province'];
        $city = $input['invoiceMailingAddress']['city'];
        $streetAddress = $input['invoiceMailingAddress']['streetAddress'];
        $buildingName = $input['invoiceMailingAddress']['buildingName'];
        $latitude = isset($input['invoiceMailingAddress']['latitude'])? $input['invoiceMailingAddress']['latitude'] : NULL;
        $longitute = isset($input['invoiceMailingAddress']['longitute'])? $input['invoiceMailingAddress']['longitute'] : NULL;

        $personNameInCharge = $input['personNameInCharge'];
        $payer = $input['payer'];
        $billingMethod = $input['billingMethod'];
        $outputUnit = $input['outputUnit'];
        $closingClassificationDate = $input['closingClassificationDate'];
        $estimatedRecoveryDate = $input['estimatedRecoveryDate'];
        $businessClassificationDate = $input['businessClassificationDate'];
        
        //info bank account
        $bankName = $input['bankAccount']['bankName'];
        $bankCode = $input['bankAccount']['bankCode'];
        $branchName = $input['bankAccount']['branchName'];
        $branchCode = $input['bankAccount']['branchCode'];
        $accountClassification = $input['bankAccount']['accountClassification'];
        $accountNumber = $input['bankAccount']['accountNumber'];
        $accountHolder = $input['bankAccount']['accountHolder'];

        //
        $designated_survey_company_1 = isset($input['designated_survey_company_1'])? $input['designated_survey_company_1']:NULL;
        $designated_survey_company_2 = isset($input['designated_survey_company_2'])? $input['designated_survey_company_2']:NULL;
        $designated_survey_company_3 = isset($input['designated_survey_company_3'])? $input['designated_survey_company_3']:NULL;
        $designated_survey_company_4 = isset($input['designated_survey_company_4'])? $input['designated_survey_company_4']:NULL;
        $designated_survey_company_5 = isset($input['designated_survey_company_5'])? $input['designated_survey_company_5']:NULL;

        $this->db->beginTransaction();
        try {
            if($designated_survey_company_1!= NULL ||$designated_survey_company_2!= NULL ||$designated_survey_company_3!= NULL ||$designated_survey_company_4!= NULL ||$designated_survey_company_5!= NULL){
                //update 5 company
                $sql = "UPDATE tb_company_setting SET designated_survey_company_1=:designated_survey_company_1,designated_survey_company_2=:designated_survey_company_2,designated_survey_company_3=:designated_survey_company_3,designated_survey_company_4=:designated_survey_company_4,designated_survey_company_5=:designated_survey_company_5 
                        WHERE companyId=:companyId";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("companyId", $companyId);
                $stmt->bindParam("designated_survey_company_1", $designated_survey_company_1);
                $stmt->bindParam("designated_survey_company_2", $designated_survey_company_2);
                $stmt->bindParam("designated_survey_company_3", $designated_survey_company_3);
                $stmt->bindParam("designated_survey_company_4", $designated_survey_company_4);
                $stmt->bindParam("designated_survey_company_5", $designated_survey_company_5);
        
                $stmt->execute();
                $this->db->commit();
                return $response->withJson($input);
            }

            //check invoiceMailingAddress
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
                $invoiceMailingAddress = $result["addressId"];
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
                $invoiceMailingAddress = $this->db->lastInsertId();
            }
            $input['invoiceMailingAddress']['addressId']=$invoiceMailingAddress;

            //check bank_account
            $sql = "SELECT id 
                    FROM tb_bank_account 
                    WHERE bankName=:bankName AND bankCode=:bankCode AND branchName=:branchName AND branchCode=:branchCode 
                          AND accountClassification=:accountClassification AND accountNumber=:accountNumber AND accountHolder=:accountHolder";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("bankName", $bankName);
            $stmt->bindParam("bankCode", $bankCode);
            $stmt->bindParam("branchName", $branchName);
            $stmt->bindParam("branchCode", $branchCode);
            $stmt->bindParam("accountClassification", $accountClassification);
            $stmt->bindParam("accountNumber", $accountNumber);
            $stmt->bindParam("accountHolder", $accountHolder);
            $stmt->execute();
            $result = $stmt->fetch();
            if($stmt->rowCount()>0){
                $bankId = $result["id"];
            }
            else{
                $sql = "INSERT INTO tb_bank_account (bankName, bankCode, branchName, branchCode, accountClassification, accountNumber, accountHolder) 
                            VALUES (:bankName, :bankCode, :branchName, :branchCode, :accountClassification, :accountNumber, :accountHolder)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("bankName", $bankName);
            $stmt->bindParam("bankCode", $bankCode);
            $stmt->bindParam("branchName", $branchName);
            $stmt->bindParam("branchCode", $branchCode);
            $stmt->bindParam("accountClassification", $accountClassification);
            $stmt->bindParam("accountNumber", $accountNumber);
            $stmt->bindParam("accountHolder", $accountHolder);
        
                $stmt->execute();
                $bankId = $this->db->lastInsertId();
            }
            $input['bankAccount']['id']=$bankId;

            //update address
            $sql = "UPDATE tb_company_setting SET creditLimit=:creditLimit, creditStatus=:creditStatus, authConfirmScreen=:authConfirmScreen, authReceiptDoc=:authReceiptDoc, invoiceMailingAddress=:invoiceMailingAddress, personNameInCharge=:personNameInCharge
                        , payer=:payer, billingMethod=:billingMethod, outputUnit=:outputUnit, closingClassificationDate=:closingClassificationDate, estimatedRecoveryDate=:estimatedRecoveryDate, businessClassificationDate=:businessClassificationDate, bankId=:bankId  
                    WHERE companyId=:companyId";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam("companyId", $companyId);
            $stmt->bindParam("creditLimit", $creditLimit);
            $stmt->bindParam("creditStatus", $creditStatus);
            $stmt->bindParam("authConfirmScreen", $authConfirmScreen);
            $stmt->bindParam("authReceiptDoc", $authReceiptDoc);
            $stmt->bindParam("invoiceMailingAddress", $invoiceMailingAddress);
            $stmt->bindParam("personNameInCharge", $personNameInCharge);
            $stmt->bindParam("payer", $payer);
            $stmt->bindParam("billingMethod", $billingMethod);
            $stmt->bindParam("outputUnit", $outputUnit);
            $stmt->bindParam("closingClassificationDate", $closingClassificationDate);
            $stmt->bindParam("estimatedRecoveryDate", $estimatedRecoveryDate);
            $stmt->bindParam("businessClassificationDate", $businessClassificationDate);
            $stmt->bindParam("bankId", $bankId);
            $stmt->execute();
            //$input['id'] = $this->db->lastInsertId();
            
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

    // delete a CompanySetting with CompanyId
    public function deleteCompanySettingWithCompanyId($request, $response, $args) {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare("DELETE FROM tb_company_setting WHERE companyId=:companyId");
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