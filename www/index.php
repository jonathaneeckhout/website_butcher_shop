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
        <div class="topNav">
            <div class="topNavLeft">
                <a href="#home">
                    <h1>Butcher shop</h1>
                    <p>Best meat in town</p>
                </a>
            </div>
            <div class="topNavRight">
                <a href="#services">Services</a>
                <a href="#products">Products</a>
                <a href="#specials">Specials</a>
                <a href="#cart">Cart</a>
                <a href="#login">Login</a>
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
                <div class="searchContainer">
                    <form action="/action_page.php">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="newsTopics">
                    <h2>News</h2>
                    <p>Buy 1kg of steak and get 200g for free!</p>
                </div>

                <div class="newsTopics">
                    <h2>Posts</h2>
                    <p>The meat is realy jucy, I am comming back for sure!</p>
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

    <!-- <script type = "text/javascript" src = "js/get_posts_index.js" ></script> -->
</body>
</html>
