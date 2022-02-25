<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ store</title>
    <link rel="stylesheet" href="./css/mau.css">
</head>

<body>
    <div class="container">
        <?php include './layout/header.php'?>
        <div class="body">
            <div class="categories">
                <div class="title">                    
                    <h2 >Dịch vụ chăm sóc khách hàng</h2>

                </div>
                <div class="tag">
                    <h3>Chủ để câu hỏi</h3>
                </div>
                <ul>
                    <?php 
                    $categories = simplexml_load_file('data/categories.xml');
                    foreach( $categories->item as $item) { $name = $item->name;?>
                    <li class="item">
                        <a class="a-item" href="category.php?item=<?php echo $name?>"><?php echo $name ?></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="newQ">
                <h3 class="tag">5 câu hỏi mới nhất</h3>
                <ul>
                    <?php
                    $dem = 0;    
                    $questions = simplexml_load_file('data/questions.xml');
                    $count = count($questions->question);
                    foreach($questions->question as $item) {
                        if($dem >= $count-5){
                ?>

                    <li class="question">
                        <img src="./img/bg4.jpg"
                            class="img_question">
                        <p title="Nội dung: <?php echo $item->decription ?>"><span
                                class="tagQuestion"><?php echo $item->category ?></span><a
                                href="detail.php?idq=<?php echo $item->idQuestion ?>"><span
                                    class="question_title"><?php echo $item->title ?></span></a><span
                                class="note">Replies: <?php echo $item->ttReplies ?></span></p>
                        <p class="other_q"><span class="time_q"><?php echo $item->time ?></span> || <span
                                class="author"><?php echo $item->author ?></span> <span class="note">Views:
                                <?php echo $item->views ?></span></p>
                    </li>
                    <?php 
                    } 
                    $dem = $dem +1;
            } ?>
                </ul>
            </div>
        </div>
        <div class="footer"></div>
    </div>
</body>

</html>