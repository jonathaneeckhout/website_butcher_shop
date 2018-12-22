<?php //include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin - Add Productt</title>
    <link rel="stylesheet" href="../style/normalize.css">
    <link rel="stylesheet" href="../style/main.css">
    <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
    <script>
    tinymce.init({
        selector: "textarea",
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"
    });
    </script>
</head>
<body>
    <div id="wrapper">
        <?php include('menu.php');?>
        <p><a href="./">Blog Admin Index</a></p>
        <h2>Add Product</h2>
        <?php
        //if form has been submitted process it
        if(isset($_POST['submit'])){
            $_POST = array_map( 'stripslashes', $_POST );
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
                    //insert into database
                    $stmt = $db->prepare('INSERT INTO butcher_shop_products (productTitle,productType,productMeatType,productImage,productDesc,productCont,productPrice,productPriceUnit) VALUES (:productTitle, :productType, :productMeatType, :productImage, :productDesc, :productCont, :productPrice, :productPriceUnit)') ;
                    $stmt->execute(array(
                        ':productTitle' => $productTitle,
                        ':productType' => $productType,
                        ':productMeatType' => $productMeatType,
                        ':productImage' => $productImage,
                        ':productDesc' => $productDesc,
                        ':productCont' => $productCont,
                        ':productPrice' => $productPrice,
                        ':productPriceUnit' => $productPriceUnit,
                    ));
                    //redirect to index page
                    header('Location: products.php?action=added');
                    exit;

                } catch(PDOException $e) {
                    echo $e->getMessage();
                }
            }
        }
        //check for any errors
        if(isset($error)){
            foreach($error as $error){
                echo '<p class="error">'.$error.'</p>';
            }
        }
        ?>
        <form action='' method='post'>
            <p>
                <label>Title</label><br />
                <input type='text' name='productTitle' value='<?php if(isset($error)){ echo $_POST['productTitle'];}?>'>
            </p>
            <p>
                <label>Type</label><br />
                <select name= 'productType'>
                    <option value='steak' selected="selected">Steak</option>
                    <option value='sausage'>Sausage</option>
                    <option value='bacon'>Bacon</option>
                    <option value='mincedMeat'>Minced Meat</option>
                    <option value='whole'>Whole</option>
                    <option value='fillet'>Fillet</option>
                </select>
            </p>
            <p>
                <label>Type of meat</label><br />
                <select name= 'productMeatType'>
                    <option value='beef' selected="selected">Beef</option>
                    <option value='pork'>Pork</option>
                    <option value='chicken'>Chicken</option>
                    <option value='lam'>Lam</option>
                    <option value='mixed'>Mixed</option>
                </select>
            </p>
            <p>
                <label>Image</label><br />
                Select Image<input type='text' name='productImage' value='<?php if(isset($error)){ echo $_POST['productImage'];}?>'>
            </p>
            <p><label>Description</label><br />
                <textarea name='productDesc' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['productDesc'];}?></textarea>
            </p>
            <p><label>Content</label><br />
                <textarea name='productCont' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['productCont'];}?></textarea>
            </p>
            <p>
                <label>Price</label><br />
                <input type='text' name='productPrice' value='<?php if(isset($error)){ echo $_POST['productPrice'];}?>'>
            </p>
            <p>
                <label>Price Unit</label><br />
                <select name= 'productPriceUnit'>
                    <option value='euro' selected="selected">euro</option>
                    <option value='euro/kg'>euro/kg</option>
                    <option value='euro/piece'>euro/piece</option>
                </select>
            </p>
            <p><input type='submit' name='submit' value='Submit'></p>
        </form>
    </div>
</body>
</html>
