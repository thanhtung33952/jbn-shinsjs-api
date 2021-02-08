<?php
namespace Controllers;

class AddressController
{
    private $db;

    // constructor receives container instance
    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllAddress($request, $response, $args) {
        try{
            $sql = "SELECT addressId, postalCode, province, city, streetAddress, buildingName, latitude, longitute 
                    FROM tb_address 
                    ORDER BY postalCode ";
            
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

    //Get Address by AddressId
    public function getAddressByAddressId($request, $response, $args) {
        $addressId = $args['id'];
        
        //get address
        $sql = "SELECT addressId, postalCode, province, city, streetAddress, buildingName, latitude, longitute FROM tb_address WHERE addressId=:addressId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("addressId", $addressId);
        $stmt->execute();
        $result = $stmt->fetchObject();
        
        return $response->withJson($result);
    }

    // Add a new Address
    public function addNewAddress($request, $response) {
        $input = $request->getParsedBody();
        $postalCode = $input['postalCode'];
        $province = $input['province'];
        $city = $input['city'];
        $streetAddress = $input['streetAddress'];
        $buildingName = $input['buildingName'];
        $latitude = $input['latitude'];
        $longitute = $input['longitute'];
    
        $this->db->beginTransaction();
        try {
            //insert address
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

    // Update Address with AddressId
    public function updateAddressWithAddressId($request, $response, $args) {
        $input = $request->getParsedBody();
        $addressId = $args['id'];
        $postalCode = $input['postalCode'];
        $province = $input['province'];
        $city = $input['city'];
        $streetAddress = $input['streetAddress'];
        $buildingName = $input['buildingName'];
        $latitude = $input['latitude'];
        $longitute = $input['longitute'];
        
        $this->db->beginTransaction();
        try {
            //update address
            $stmt = $this->db->prepare("DELETE FROM tb_address WHERE addressId=:addressId");
            $stmt->bindParam("addressId", $addressId);
            $stmt->execute();
    
            $sql = "INSERT INTO tb_address (addressId, postalCode, province, city, streetAddress, buildingName, latitude, longitute) 
                        VALUES (:addressId, :postalCode, :province, :city, :streetAddress, :buildingName, :latitude, :longitute)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("addressId", $addressId);
            $stmt->bindParam("postalCode", $postalCode);
            $stmt->bindParam("province", $province);
            $stmt->bindParam("city", $city);
            $stmt->bindParam("streetAddress", $streetAddress);
            $stmt->bindParam("buildingName", $buildingName);
            $stmt->bindParam("latitude", $latitude);
            $stmt->bindParam("longitute", $longitute);
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

    // delete a Address with AddressId
    public function deleteAddressWithAddressId($request, $response, $args) {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare("DELETE FROM tb_address WHERE addressId=:addressId");
            $stmt->bindParam("addressId", $args['id']);
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

    // Search province with key
    public function seachProvinceWithKey($request, $response, $args) {
        $keySearch= isset($args['key'])? $args['key'] : "";
        try{
            $sql = "SELECT addressId AS id, province AS name 
                    FROM tb_address 
                    WHERE UPPER(province) LIKE :province 
                    ORDER BY name ";
            
            $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
            $offset= isset($_GET['offset']) ? $_GET['offset'] : 0;
            if($limit>0){
                $sql .= "LIMIT $limit OFFSET $offset ";
            }
    
            $stmt = $this->db->prepare($sql);
            $query = "%".$keySearch."%";
            $stmt->bindParam("province", $query);
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

    // Search city with key
    public function seachCityWithKey($request, $response, $args) {
        $keySearch= isset($args['key'])? $args['key'] : "";
        try{
            $sql = "SELECT addressId AS id, city AS name 
                    FROM tb_address 
                    WHERE UPPER(city) LIKE :city 
                    ORDER BY name ";
            
            $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
            $offset= isset($_GET['offset']) ? $_GET['offset'] : 0;
            if($limit>0){
                $sql .= "LIMIT $limit OFFSET $offset ";
            }
    
            $stmt = $this->db->prepare($sql);
            $query = "%".$keySearch."%";
            $stmt->bindParam("city", $query);
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

    // Search streetAddress with key
    public function seachStreetWithKey($request, $response, $args) {
        $keySearch= isset($args['key'])? $args['key'] : "";
        try{
            $sql = "SELECT addressId AS id, streetAddress AS name 
                    FROM tb_address 
                    WHERE UPPER(streetAddress) LIKE :streetAddress 
                    ORDER BY name ";
            
            $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
            $offset= isset($_GET['offset']) ? $_GET['offset'] : 0;
            if($limit>0){
                $sql .= "LIMIT $limit OFFSET $offset ";
            }
    
            $stmt = $this->db->prepare($sql);
            $query = "%".$keySearch."%";
            $stmt->bindParam("streetAddress", $query);
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

    // Search building with key
    public function seachBuildingWithKey($request, $response, $args) {
        $keySearch= isset($args['key'])? $args['key'] : "";
        try{
            $sql = "SELECT addressId AS id, buildingName AS name 
                    FROM tb_address 
                    WHERE UPPER(buildingName) LIKE :buildingName 
                    ORDER BY name ";
            
            $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
            $offset= isset($_GET['offset']) ? $_GET['offset'] : 0;
            if($limit>0){
                $sql .= "LIMIT $limit OFFSET $offset ";
            }
    
            $stmt = $this->db->prepare($sql);
            $query = "%".$keySearch."%";
            $stmt->bindParam("buildingName", $query);
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