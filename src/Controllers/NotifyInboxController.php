<?php
namespace Controllers;

class NotifyInboxController
{
    private $db;

    // constructor receives container instance
    public function __construct($db) {
        $this->db = $db;
    }

    //Get total NotifyInbox
    public function totalNotifyInbox($request, $response, $args) {
        $input = $request->getParsedBody();
        $userId = $input['userId'];
        
        //get company
        $sql = "SELECT companyID 
        FROM tb_users 
        WHERE id=:userId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("userId", $userId);
        $stmt->execute();
        $result = $stmt->fetchObject();

        $companyID = $result->companyID;

        //get Notify Inbox
        $sql = "SELECT count(id_inbox) as total 
                FROM tb_inbox 
                WHERE group_target = :companyID OR userId_target=:userId 
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("userId", $userId);
        $stmt->bindParam("companyID", $companyID);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    //Get details Notify Inbox
    public function detailNotifyInbox($request, $response, $args) {
        $input = $request->getParsedBody();
        $userId = $input['userId'];
        
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
        $sql = "SELECT id_inbox, flag, id, date 
                FROM tb_inbox 
                WHERE group_target = :companyID OR userId_target=:userId 
                ORDER BY date DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("userId", $userId);
        $stmt->bindParam("companyID", $companyID);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        return $response->withJson($result);
    }
}