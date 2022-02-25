<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/mau.css">
</head>
<body>
    <div class="container">
        <?php include './layout/header.php'?>
        <a class="icon_Home" href="index.php"> <img src="./img/home.jpg"></a>
        <div class="body" style="margin-top: 25px">
            <div class="tag">
                <h3>Chủ đề câu hỏi: <?php echo $_GET['item'] ?></h3>
            </div>
            <div class="listQues">
            <ul>
            <?php
                if(isset($_GET['item']))
                {
                    $questions = simplexml_load_file("./data/questions.xml");
                    foreach($questions->question as $item)
                    {
                        if($item->category == $_GET['item'])
                        {
                        ?>
                        <li class="question">
                            <img src="https://developer.ridgerun.com/wiki/images/d/df/Blue_question_mark_icon.svg.png" class="img_question">
                            <p title="Nội dung: <?php echo $item->decription ?>"><span class="tagQuestion"><?php echo $item->category ?></span><a href="detail.php?idq=<?php echo $item->idQuestion ?>"><span class="question_title"><?php echo $item->title ?></span></a><span class="note">Replies: <?php echo $item->ttReplies ?></span></p>
                            <p class="other_q"><span class="time_q"><?php echo $item->time ?></span> || <span class="author"><?php echo $item->author ?></span> <span class="note">Views: <?php echo $item->views ?></span></p>
                        </li>
                        <?php
                        }
                    }
                }
            ?>
            </ul>
            </div>
        </div>
    </div>
</body>
</html>