<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Search</title>
    <link rel="stylesheet" href="./css/mau.css">
</head>

<body>
    <div class="container">

        <?php include './layout/header.php' ?>
        <a class="icon_Home" href="index.php"> <img src="./img/home.jpg"></a>
        <div class="body">

            <div class="newQ" style="margin-top: 25px;">
                <h3 class="tag">Kết quả tìm kiếm cho từ khóa: <?php echo $_GET['search_key']; ?></h3>
                <ul>
                    <?php
                    $questions = simplexml_load_file('data/questions.xml');                    
                    foreach($questions->question as $item) {
                        if ($item==null) break; 
                        if(strpos($item->title, $_GET['search_key'])|| $item->category== $_GET['search_key']||$item->author == $_GET['search_key'])
                        {                        
                    ?>
                    <li class="question">
                        <img src="https://developer.ridgerun.com/wiki/images/d/df/Blue_question_mark_icon.svg.png"
                            class="img_question">
                        <p title="Nội dung: <?php echo $item->decription ?>"><span
                                class="tagQuestion"><?php echo $item->category ?></span>

                            <span class="question_title"><a href="detail.php"><?php echo $item->title ?></a></span>

                            <span class="note">Replies: <?php echo $item->ttReplies ?></span>
                        </p>
                        <p class="other_q"><span class="time_q"><?php echo $item->time ?></span> || <span
                                class="author"><?php echo $item->author ?></span> <span class="note">Views:
                                <?php echo $item->views ?></span></p>
                    </li>
                    <?php 
                        } 
                    } ?>
                </ul>
            </div>
        </div>
        <div class="footer"></div>
    </div>
</body>

</html>