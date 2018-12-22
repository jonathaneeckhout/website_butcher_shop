<?php //include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin - Edit User</title>
    <link rel="stylesheet" href="../style/normalize.css">
    <link rel="stylesheet" href="../style/main.css">
</head>
<body>

    <div id="wrapper">
        <?php include('menu.php');?>
        <p><a href="products.php">Product Admin Index</a></p>
        <h2>Edit product</h2>
        <?php
        //if form has been submitted process it
        if(isset($_POST['submit'])){
            //collect form data
            extract($_POST);
            //very basic validation
            if($productTitle ==''){
                $error[] = 'Please enter the title.';
            }
            if($productDesc ==''){
                $error[] = 'Please enter the description.';
            }
            if($productCont ==''){
                $error[] = 'Please enter the content.';
            }
            if($productPrice ==''){
                $error[] = 'Please enter the price.';
            }
            if(!isset($error)){
                try {
                    //update into database
                    $stmt = $db->prepare('UPDATE butcher_shop_products SET productTitle = :productTitle, productType = :productType, productMeatType = :productMeatType, productImage = :productImage, productDesc = :productDesc, productCont = :productCont, productPrice = :productPrice, productPriceUnit = :productPriceUnit WHERE productID = :productID') ;
                    $stmt->execute(array(
                        ':productTitle' => $productTitle,
                        ':productType' => $productType,
                        ':productMeatType' => $productMeatType,
                        ':productImage' => $productImage,
                        ':productDesc' => $productDesc,
                        ':productCont' => $productCont,
                        ':productPrice' => $productPrice,
                        ':productPriceUnit' => $productPriceUnit,
                        ':productID' => $productID
                    ));
                    //redirect to product page
                    header('Location: products.php?action=updated');
                    exit;
                } catch(PDOException $e) {
                    echo $e->getMessage();
                }
            }
        }
        ?>
        <?php
        //check for any errors
        if(isset($error)){
            foreach($error as $error){
                echo $error.'<br />';
            }
        }
        try {
            $stmt = $db->prepare('SELECT productID, productTitle, productType, productMeatType, productImage, productDesc, productCont, productPrice, productPriceUnit FROM butcher_shop_products WHERE productID = :productID') ;
            $stmt->execute(array(':productID' => $_GET['id']));
            $row = $stmt->fetch();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        ?>

        <form action='' method='post'>
            <input type='hidden' name='productID' value='<?php echo $row['productID'];?>'>
            <p>
                <label>Title</label><br />
                <input type='text' name='productTitle' value='<?php echo $row['productTitle'];?>'>
            </p>
            <p>
                <label>Type</label><br />
                <select name= 'productType'>
                    <option value='steak' <?php if($row['productType'] =='steak'){echo 'selected="selected"';}?>>Steak</option>
                    <option value='sausage' <?php if($row['productType'] =='sausage'){echo 'selected="selected"';}?>>Sausage</option>
                    <option value='bacon' <?php if($row['productType'] =='bacon'){echo 'selected="selected"';}?>>Bacon</option>
                    <option value='mincedMeat' <?php if($row['productType'] =='mincedMeat'){echo 'selected="selected"';}?>>Minced Meat</option>
                    <option value='whole' <?php if($row['productType'] =='whole'){echo 'selected="selected"';}?>>Whole</option>
                    <option value='fillet' <?php if($row['productType'] =='fillet'){echo 'selected="selected"';}?>>Fillet</option>
                </select>
            </p>
            <p>
                <label>Type of meat</label><br />
                <select name= 'productMeatType'>
                    <option value='beef' <?php if($row['productMeatType'] =='beef'){echo 'selected="selected"';}?>>Beef</option>
                    <option value='pork' <?php if($row['productMeatType'] =='pork'){echo 'selected="selected"';}?>>Pork</option>
                    <option value='chicken' <?php if($row['productMeatType'] =='chicken'){echo 'selected="selected"';}?>>Chicken</option>
                    <option value='lam' <?php if($row['productMeatType'] =='lam'){echo 'selected="selected"';}?>>Lam</option>
                    <option value='mixed' <?php if($row['productMeatType'] =='mixed'){echo 'selected="selected"';}?>>Mixed</option>
                </select>
            </p>
            <p>
                <label>Image</label><br />
                Select Image<input type='text' name='productImage' value='<?php echo $row['productImage'];?>'>
            </p>
            <p><label>Description</label><br />
                <textarea name='productDesc' cols='60' rows='10'><?php echo $row['productDesc'];?></textarea>
            </p>
            <p><label>Content</label><br />
                <textarea name='productCont' cols='60' rows='10'><?php echo $row['productCont'];?></textarea>
            </p>
            <p>
                <label>Price</label><br />
                <input type='text' name='productPrice' value='<?php echo $row['productPrice'];?>'>
            </p>
            <p>
                <label>Price Unit</label><br />
                <select name= 'productPriceUnit'>
                    <option value='euro' <?php if($row['productPriceUnit'] =='euro'){echo 'selected="selected"';}?>>euro</option>
                    <option value='euro/kg' <?php if($row['productPriceUnit'] =='euro/kg'){echo 'selected="selected"';}?>>euro/kg</option>
                    <option value='euro/piece' <?php if($row['productPriceUnit'] =='euro/piece'){echo 'selected="selected"';}?>>euro/piece</option>
                </select>
            </p>
            <p><input type='submit' name='submit' value='Update Product'></p>
        </form>

    </div>

</body>
</html>
