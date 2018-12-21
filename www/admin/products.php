<?php
//include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

//show message from add / edit page
if(isset($_GET['delproduct'])){

    $stmt = $db->prepare('DELETE FROM butcher_shop_products WHERE productID = :productID') ;
    $stmt->execute(array(':productID' => $_GET['delproduct']));

    header('Location: products.php?action=deleted');
    exit;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin - products</title>
    <link rel="stylesheet" href="../style/normalize.css">
    <link rel="stylesheet" href="../style/main.css">
    <script language="JavaScript" type="text/javascript">
    function delproduct(id, title)
    {
        if (confirm("Are you sure you want to delete '" + title + "'"))
        {
            window.location.href = 'products.php?delproduct=' + id;
        }
    }
    </script>
</head>
<body>
    <div id="wrapper">
        <?php include('menu.php');?>
        <?php
        //show message from add / edit page
        if(isset($_GET['action'])){
            echo '<h3>Product '.$_GET['action'].'.</h3>';
        }
        ?>
        <table>
            <tr>
                <th>Title</th>
                <th>Action</th>
            </tr>
            <?php
            try {
                $stmt = $db->query('SELECT productID, productTitle FROM butcher_shop_products ORDER BY productID');
                while($row = $stmt->fetch()){

                    echo '<tr>';
                    echo '<td>'.$row['productTitle'].'</td>';
                    ?>
                    <td>
                        <a href="edit-product.php?id=<?php echo $row['productID'];?>">Edit</a>
                        <a href="javascript:delproduct('<?php echo $row['productID'];?>','<?php echo $row['productTitle'];?>')">Delete</a>
                    </td>
                    <?php
                    echo '</tr>';
                }
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
            ?>
        </table>
        <p><a href='add-product.php'>Add Product</a></p>
    </div>

</body>
</html>
