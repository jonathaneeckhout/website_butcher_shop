<?php

require('../includes/config.php');

class Product {
    public $productID;
    public $productTitle;
    public $productType;
    public $productMeatType;
    public $productImage;
    public $productDesc;
    public $productCont;
    public $productPrice;
    public $productPriceUnit;
}

$myResult = array();

if ($_GET["method"] == '') {
    try {
        $stmt = $db->query('SELECT productID, productTitle, productType, productMeatType, productImage, productDesc, productCont, productPrice, productPriceUnit FROM butcher_shop_products ORDER BY productID');
        while($row = $stmt->fetch()){
            $myObj = new Product();
            $myObj->productID = $row['productID'];
            $myObj->productTitle = $row['productTitle'];
            $myObj->productType = $row['productType'];
            $myObj->productMeatType = $row['productMeatType'];
            $myObj->productImage = $row['productImage'];
            $myObj->productDesc = $row['productDesc'];
            $myObj->productCont = $row['productCont'];
            $myObj->productPrice = $row['productPrice'];
            $myObj->productPriceUnit = $row['productPriceUnit'];
            array_push($myResult, $myObj);
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
} elseif ($_GET["method"] == 'search') {
    try {
        $query = $_GET['query'];
        $query = htmlspecialchars($query);

        $sql = "SELECT productID, productTitle, productType, productMeatType, productImage, productDesc, productCont, productPrice, productPriceUnit FROM butcher_shop_products WHERE (productTitle LIKE ?) OR (productCont LIKE ?) ORDER BY productID";
        $stmt = $db->prepare($sql);
        if($stmt === false) {
            trigger_error('Wrong SQL: ' . $db . ' Error: ' . $db->errno . ' ' . $db->error, E_USER_ERROR);
        }

        $stmt->bindValue(1, "%$query%", PDO::PARAM_STR);
        $stmt->bindValue(2, "%$query%", PDO::PARAM_STR);

        $stmt->execute();

        while($row = $stmt->fetch()){
            $myObj = new Product();
            $myObj->productID = $row['productID'];
            $myObj->productTitle = $row['productTitle'];
            $myObj->productType = $row['productType'];
            $myObj->productMeatType = $row['productMeatType'];
            $myObj->productImage = $row['productImage'];
            $myObj->productDesc = $row['productDesc'];
            $myObj->productCont = $row['productCont'];
            $myObj->productPrice = $row['productPrice'];
            $myObj->productPriceUnit = $row['productPriceUnit'];
            array_push($myResult, $myObj);
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

} elseif ($_GET["method"] == 'filter') {
    try {
        $query = $_GET['query'];
        if ($query != '') {
            $query = htmlspecialchars($query);
            $filterFields = str_getcsv($query);
             $where = "WHERE (productMeatType = ?)";
            $max = sizeof($filterFields);
            for($i = 1; $i < $max;$i++)
            {
                $where .= " OR (productMeatType = ?) ";
            }
        }
        $sql = "SELECT productID, productTitle, productType, productMeatType, productImage, productDesc, productCont, productPrice, productPriceUnit FROM butcher_shop_products ".$where." ORDER BY productID";
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
            $myObj = new Product();
            $myObj->productID = $row['productID'];
            $myObj->productTitle = $row['productTitle'];
            $myObj->productType = $row['productType'];
            $myObj->productMeatType = $row['productMeatType'];
            $myObj->productImage = $row['productImage'];
            $myObj->productDesc = $row['productDesc'];
            $myObj->productCont = $row['productCont'];
            $myObj->productPrice = $row['productPrice'];
            $myObj->productPriceUnit = $row['productPriceUnit'];
            array_push($myResult, $myObj);
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}

$myJSON = json_encode($myResult);

echo $myJSON;
?>
