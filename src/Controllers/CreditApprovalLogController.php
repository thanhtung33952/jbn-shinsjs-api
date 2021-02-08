<?php
namespace Controllers;

class CreditApprovalLogController
{
    private $db;

    // constructor receives container instance
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function getAllCreditApprovalLog($request, $response, $args) {
        try{
            $sql = "SELECT company_id, date, description, name 
                    FROM tb_credit_approval_log 
                    ORDER BY id ";
            
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

    //Get CreditApprovalLog by Id
    public function getCreditApprovalLogByCompanyId($request, $response, $args) {
        $company_id = $args['id'];
        
        //get CreditApprovalLog
        $sql = "SELECT company_id, date, description, name 
                FROM tb_credit_approval_log 
                WHERE company_id=:company_id 
                ORDER BY date DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("company_id", $company_id);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    // Add a new CreditApprovalLog
    public function addNewCreditApprovalLog($request, $response) {
        $input = $request->getParsedBody();
        $company_id = $input['company_id'];
        $description = $input['description'];
        $name = $input['name'];
    
        $this->db->beginTransaction();
        try {
            //insert address
            $sql = "INSERT INTO tb_credit_approval_log (company_id, description, name) 
                        VALUES (:company_id, :description, :name)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("company_id", $company_id);
            $stmt->bindParam("description", $description);
            $stmt->bindParam("name", $name);
    
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

    // Update CreditApprovalLog with Id
    // public function updateCreditApprovalLogWithId($request, $response, $args) {
    //     $input = $request->getParsedBody();
    //     $id = $args['id'];
    //     $bankName = $input['bankName'];
    //     $bankCode = $input['bankCode'];
    //     $branchName = $input['branchName'];
    //     $branchCode = $input['branchCode'];
    //     $accountClassification = $input['accountClassification'];
    //     $accountNumber = $input['accountNumber'];
    //     $accountHolder = $input['accountHolder'];

    //     $this->db->beginTransaction();
    //     try {
    //         //update address
    //         $stmt = $this->db->prepare("DELETE FROM tb_credit_approval_log WHERE id=:id");
    //         $stmt->bindParam("id", $id);
    //         $stmt->execute();
    
    //         $sql = "INSERT INTO tb_credit_approval_log (id, bankName, bankCode, branchName, branchCode, accountClassification, accountNumber, accountHolder) 
    //                     VALUES (:id, :bankName, :bankCode, :branchName, :branchCode, :accountClassification, :accountNumber, :accountHolder)";
    //         $stmt = $this->db->prepare($sql);
    //         $stmt->bindParam("id", $id);
    //         $stmt->bindParam("bankName", $bankName);
    //         $stmt->bindParam("bankCode", $bankCode);
    //         $stmt->bindParam("branchName", $branchName);
    //         $stmt->bindParam("branchCode", $branchCode);
    //         $stmt->bindParam("accountClassification", $accountClassification);
    //         $stmt->bindParam("accountNumber", $accountNumber);
    //         $stmt->bindParam("accountHolder", $accountHolder);
    //         $stmt->execute();
    //         $input['id'] = $this->db->lastInsertId();
            
    //         $this->db->commit();
    //         return $response->withJson($input);
    //     }               
    //     // any errors from the above database queries will be catched
    //     catch (PDOException $e){
    //         // roll back transaction
    //         $this->db->rollback();
    //         //return $response->write($e);
    //         return $response->withStatus(500);
    //         // log any errors to file
    //         ExceptionErrorHandler($e);
    //         exit;
    //     }
    // }

    // delete a CreditApprovalLog with Id
    public function deleteCreditApprovalLogWithCompanyId($request, $response, $args) {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare("DELETE FROM tb_credit_approval_log WHERE company_id=:company_id");
            $stmt->bindParam("company_id", $args['id']);
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