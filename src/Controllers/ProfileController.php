<?php
namespace Controllers;

class ProfileController
{
    private $db;

    // constructor receives container instance
    public function __construct($db) {
        $this->db = $db;
    }

    //Get Profile by Id
    public function getProfileById($request, $response, $args) {
        $user_id = $args['id'];
        
        //get Survey
        $sql = "SELECT tb_profile.id, user_id, firstName, first_name1, lastName, last_name1, email, mobile_phone, 
                        company_name, hire_date, department, position, job_title, employee_number, sjs_id, 
                        postalCode, province, city, streetAddress, buildingName 
                FROM tb_profile 
                INNER JOIN (SELECT id, firstName, lastName, email FROM tb_users) AS tb_users 
                    ON tb_profile.user_id = tb_users.id 
                LEFT JOIN tb_address 
                    ON tb_profile.addressId = tb_address.addressId 
                LEFT JOIN tb_position 
                    ON tb_profile.id = tb_position.profile_id 
                WHERE user_id=:user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    // Add a new Profile
    public function addNewProfile($request, $response) {
        $input = $request->getParsedBody();
        
        $user_id = $input['user_id'];
        $firstName = $input['firstName'];
        $first_name1 = $input['first_name1'];
        $lastName = $input['lastName'];
        $last_name1 = $input['last_name1'];
        $email = $input['email'];
        $mobile_phone = $input['mobile_phone'];

        $company_name = $input['company_name'];
        $hire_date = $input['hire_date'];
        $department = $input['department'];
        $position = $input['position'];
        $job_title = $input['job_title'];
        $employee_number = $input['employee_number'];
        $sjs_id = $input['sjs_id'];

        $postalCode = $input['postalCode'];
        $province = $input['province'];
        $city = $input['city'];
        $streetAddress = $input['streetAddress'];
        $buildingName = $input['buildingName'];
        
        $this->db->beginTransaction();
        try {
            // update tb_users
            $sql = "UPDATE tb_users SET firstName=:firstName, lastName=:lastName, email=:email 
                    WHERE id=:user_id";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam('user_id', $user_id);
            $stmt->bindParam('firstName', $firstName);
            $stmt->bindParam('lastName', $lastName);
            $stmt->bindParam('email', $email);
            $stmt->execute();

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
                $sql = "INSERT INTO tb_address (postalCode, province, city, streetAddress, buildingName) 
                            VALUES (:postalCode, :province, :city, :streetAddress, :buildingName)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("postalCode", $postalCode);
                $stmt->bindParam("province", $province);
                $stmt->bindParam("city", $city);
                $stmt->bindParam("streetAddress", $streetAddress);
                $stmt->bindParam("buildingName", $buildingName);
        
                $stmt->execute();
                $addressID = $this->db->lastInsertId();
            }

            //insert
            $sql = "INSERT INTO tb_profile (user_id ,first_name1, last_name1, mobile_phone, 
                                addressID) 
                        VALUES (:user_id, :first_name1, :last_name1, :mobile_phone, 
                                :addressID)";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam('user_id', $user_id);
            $stmt->bindParam('first_name1', $first_name1);
            $stmt->bindParam('last_name1', $last_name1);
            $stmt->bindParam('mobile_phone', $mobile_phone);

            $stmt->bindParam('addressID', $addressID); 
    
            $stmt->execute();
            $input['id'] = $this->db->lastInsertId();

            //insert
            $sql = "INSERT INTO tb_position (profile_id , 
                                company_name, hire_date, department, position, job_title, employee_number, sjs_id) 
                        VALUES (:profile_id, 
                                :company_name, :hire_date, :department, :position, :job_title, :employee_number, :sjs_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('profile_id', $input['id']);
            $stmt->bindParam('company_name', $company_name);
            $stmt->bindParam('hire_date', $hire_date);
            $stmt->bindParam('department', $department);
            $stmt->bindParam('position', $position);
            $stmt->bindParam('job_title', $job_title);
            $stmt->bindParam('employee_number', $employee_number);
            $stmt->bindParam('sjs_id', $sjs_id);
    
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

    // Update Profile with Id
    public function updateProfileWithId($request, $response, $args) {
        $input = $request->getParsedBody();
        $user_id = $args['id'];
        
        $firstName = $input['firstName'];
        $first_name1 = $input['first_name1'];
        $lastName = $input['lastName'];
        $last_name1 = $input['last_name1'];
        $email = $input['email'];
        $mobile_phone = $input['mobile_phone'];

        $postalCode = $input['postalCode'];
        $province = $input['province'];
        $city = $input['city'];
        $streetAddress = $input['streetAddress'];
        $buildingName = $input['buildingName'];

        $this->db->beginTransaction();
        try {
            // update tb_users
            $sql = "UPDATE tb_users SET firstName=:firstName, lastName=:lastName, email=:email 
                    WHERE id=:user_id";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam('user_id', $user_id);
            $stmt->bindParam('firstName', $firstName);
            $stmt->bindParam('lastName', $lastName);
            $stmt->bindParam('email', $email);
            $stmt->execute();

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
                $sql = "INSERT INTO tb_address (postalCode, province, city, streetAddress, buildingName) 
                            VALUES (:postalCode, :province, :city, :streetAddress, :buildingName)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("postalCode", $postalCode);
                $stmt->bindParam("province", $province);
                $stmt->bindParam("city", $city);
                $stmt->bindParam("streetAddress", $streetAddress);
                $stmt->bindParam("buildingName", $buildingName);
        
                $stmt->execute();
                $addressID = $this->db->lastInsertId();
            }

            // update tb_profile
            $sql = "UPDATE tb_profile SET first_name1=:first_name1, last_name1=:last_name1, mobile_phone=:mobile_phone, addressID=:addressID 
                    WHERE user_id=:user_id";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam('user_id', $user_id);
            $stmt->bindParam('first_name1', $first_name1);
            $stmt->bindParam('last_name1', $last_name1);
            $stmt->bindParam('mobile_phone', $mobile_phone);
            $stmt->bindParam('addressID', $addressID);
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