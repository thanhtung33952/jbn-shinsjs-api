<?php
namespace Controllers;

class BankAccountController
{
    private $db;

    // constructor receives container instance
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function getAllBankAccount($request, $response, $args) {
        try{
            $sql = "SELECT id, bankName, bankCode, branchName, branchCode, accountClassification, accountNumber, accountHolder  
                    FROM tb_bank_account 
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

    //Get BankAccount by Id
    public function getBankAccountById($request, $response, $args) {
        $id = $args['id'];
        
        //get BankAccount
        $sql = "SELECT id, bankName, bankCode, branchName, branchCode, accountClassification, accountNumber, accountHolder 
                FROM tb_bank_account 
                WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    // Add a new BankAccount
    public function addNewBankAccount($request, $response) {
        $input = $request->getParsedBody();
        $bankName = $input['bankName'];
        $bankCode = $input['bankCode'];
        $branchName = $input['branchName'];
        $branchCode = $input['branchCode'];
        $accountClassification = $input['accountClassification'];
        $accountNumber = $input['accountNumber'];
        $accountHolder = $input['accountHolder'];
    
        $this->db->beginTransaction();
        try {
            //insert address
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

    // Update BankAccount with Id
    public function updateBankAccountWithId($request, $response, $args) {
        $input = $request->getParsedBody();
        $id = $args['id'];
        $bankName = $input['bankName'];
        $bankCode = $input['bankCode'];
        $branchName = $input['branchName'];
        $branchCode = $input['branchCode'];
        $accountClassification = $input['accountClassification'];
        $accountNumber = $input['accountNumber'];
        $accountHolder = $input['accountHolder'];

        $this->db->beginTransaction();
        try {
            //update address
            $stmt = $this->db->prepare("DELETE FROM tb_bank_account WHERE id=:id");
            $stmt->bindParam("id", $id);
            $stmt->execute();
    
            $sql = "INSERT INTO tb_bank_account (id, bankName, bankCode, branchName, branchCode, accountClassification, accountNumber, accountHolder) 
                        VALUES (:id, :bankName, :bankCode, :branchName, :branchCode, :accountClassification, :accountNumber, :accountHolder)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("id", $id);
            $stmt->bindParam("bankName", $bankName);
            $stmt->bindParam("bankCode", $bankCode);
            $stmt->bindParam("branchName", $branchName);
            $stmt->bindParam("branchCode", $branchCode);
            $stmt->bindParam("accountClassification", $accountClassification);
            $stmt->bindParam("accountNumber", $accountNumber);
            $stmt->bindParam("accountHolder", $accountHolder);
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

    // delete a BankAccount with Id
    public function deleteBankAccountWithId($request, $response, $args) {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare("DELETE FROM tb_bank_account WHERE id=:id");
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