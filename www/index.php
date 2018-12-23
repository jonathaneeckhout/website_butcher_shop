<?php require('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Butcher shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title></title>
</head>
<body>
    <header>
        <div class="topNav" id="myTopnav">
            <div class="topNavLeft">
                <a id="logo" href="index.php">
                    <img src="images/butcher_shop_logo.png" alt="logo">
                </a>
            </div>
            <div class="topNavRight ">
                <a href="index.php">Home</a>
                <a href="html/services.php">Services</a>
                <a href="html/products.php">Products</a>
                <a href="admin/index.php">Login</a>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </div>
    </header>
    <div class="headerLine"></div>

    <div class="wrapper">
        <div class="indexWrapper">
            <div class="indexMainNews">
                <div id="newsBlog">
                    <?php
                    try {
                        $stmt = $db->query('SELECT postID, postTitle, postDesc, postCont, postDate, postImage FROM butcher_shop_posts ORDER BY postID DESC');
                        while($row = $stmt->fetch()){
                            echo '<div class=news>';
                            echo '<h2>'.$row['postTitle'].'</h2>';
                            echo '<p class="newsDate">Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
                            echo '<img src="images/'.$row['postImage'].'" alt="">';
                            echo '<p class="newsText">'.$row['postCont'].'</p>';
                            echo '</div>';
                        }
                    } catch(PDOException $e) {
                        echo $e->getMessage();
                    }
                    ?>
                </div>
            </div>
            <div class="indexSideBar">
                <div class="newsTopics">
                    <h2>News</h2>
                    <ul>
                        <?php
                        try {
                            $stmt = $db->query('SELECT postID, postTitle FROM butcher_shop_posts ORDER BY postID DESC');
                            while($row = $stmt->fetch()){
                                echo '<li>'.$row['postTitle'].'</li>';
                            }
                        } catch(PDOException $e) {
                            echo $e->getMessage();
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p> Butcher shop<br>
            eeckhout.jonathan.info@gmail.com<br>
            © 2018 Jonathan Eeckhout
        </p>
    </footer>

    <script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topNav") {
            x.className += " responsive";
        } else {
            x.className = "topNav";
        }
    }
</script>

</body>
</html>
