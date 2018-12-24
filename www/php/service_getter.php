<?php

require('../includes/config.php');

class service {
    public $serviceID;
    public $serviceTitle;
    public $serviceType;
    public $serviceImage;
    public $serviceDesc;
    public $serviceCont;
    public $servicePrice;
    public $servicePriceUnit;
}

$myResult = array();

if ($_GET["method"] == '') {
    try {
        $stmt = $db->query('SELECT serviceID, serviceTitle, serviceType, serviceImage, serviceDesc, serviceCont, servicePrice, servicePriceUnit FROM butcher_shop_services ORDER BY serviceID');
        while($row = $stmt->fetch()){
            $myObj = new service();
            $myObj->serviceID = $row['serviceID'];
            $myObj->serviceTitle = $row['serviceTitle'];
            $myObj->serviceType = $row['serviceType'];
            $myObj->serviceImage = $row['serviceImage'];
            $myObj->serviceDesc = $row['serviceDesc'];
            $myObj->serviceCont = $row['serviceCont'];
            $myObj->servicePrice = $row['servicePrice'];
            $myObj->servicePriceUnit = $row['servicePriceUnit'];
            array_push($myResult, $myObj);
        }
    } catch(PDOException $e) {
        //echo $e->getMessage();
        echo "Error";
    }
} elseif ($_GET["method"] == 'search') {
    try {
        $query = $_GET['query'];
        $query = htmlspecialchars($query);

        $sql = "SELECT serviceID, serviceTitle, serviceType, serviceImage, serviceDesc, serviceCont, servicePrice, servicePriceUnit FROM butcher_shop_services WHERE (serviceTitle LIKE ?) OR (serviceCont LIKE ?) ORDER BY serviceID";
        $stmt = $db->prepare($sql);
        if($stmt === false) {
            trigger_error('Wrong SQL: ' . $db . ' Error: ' . $db->errno . ' ' . $db->error, E_USER_ERROR);
        }

        $stmt->bindValue(1, "%$query%", PDO::PARAM_STR);
        $stmt->bindValue(2, "%$query%", PDO::PARAM_STR);

        $stmt->execute();

        while($row = $stmt->fetch()){
            $myObj = new service();
            $myObj->serviceID = $row['serviceID'];
            $myObj->serviceTitle = $row['serviceTitle'];
            $myObj->serviceType = $row['serviceType'];
            $myObj->serviceImage = $row['serviceImage'];
            $myObj->serviceDesc = $row['serviceDesc'];
            $myObj->serviceCont = $row['serviceCont'];
            $myObj->servicePrice = $row['servicePrice'];
            $myObj->servicePriceUnit = $row['servicePriceUnit'];
            array_push($myResult, $myObj);
        }
    } catch(PDOException $e) {
        //echo $e->getMessage();
        echo "Error";
    }

} elseif ($_GET["method"] == 'filter') {
    try {
        $query = $_GET['query'];
        if ($query != '') {
            $query = htmlspecialchars($query);
            $filterFields = str_getcsv($query);
             $where = "WHERE (serviceType = ?)";
            $max = sizeof($filterFields);
            for($i = 1; $i < $max;$i++)
            {
                $where .= " OR (serviceType = ?) ";
            }
        }
        $sql = "SELECT serviceID, serviceTitle, serviceType, serviceImage, serviceDesc, serviceCont, servicePrice, servicePriceUnit FROM butcher_shop_services ".$where." ORDER BY serviceID";
        $stmt = $db->prepare($sql);
        if($stmt === false) {
            trigger_error('Wrong SQL: ' . $db . ' Error: ' . $db->errno . ' ' . $db->error, E_USER_ERROR);
        }
        for($i = 0; $i < $max;$i++)
        {
            $stmt->bindValue($i+1, "$filterFields[$i]", PDO::PARAM_STR);
        }

        $stmt->execute();

        while($row = $stmt->fetch()){
            $myObj = new service();
            $myObj->serviceID = $row['serviceID'];
            $myObj->serviceTitle = $row['serviceTitle'];
            $myObj->serviceType = $row['serviceType'];
            $myObj->serviceImage = $row['serviceImage'];
            $myObj->serviceDesc = $row['serviceDesc'];
            $myObj->serviceCont = $row['serviceCont'];
            $myObj->servicePrice = $row['servicePrice'];
            $myObj->servicePriceUnit = $row['servicePriceUnit'];
            array_push($myResult, $myObj);
        }
    } catch(PDOException $e) {
        //echo $e->getMessage();
        echo "Error";
    }
}

$myJSON = json_encode($myResult);

echo $myJSON;
?>
