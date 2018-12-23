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

try {
    $stmt = $db->query('SELECT productID, productTitle, productType, productMeatType, productImage, productDesc, productCont, productPrice, productPriceUnit FROM butcher_shop_products ORDER BY productID');
    $myResult = array();
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

$myJSON = json_encode($myResult);

echo $myJSON;
?>
