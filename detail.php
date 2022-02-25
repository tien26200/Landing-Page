<?php
    global $idQuestion;
    global $user_img;
    global $admin_img;
    $item = 'Biến tạm';

    $user_img = "https://developer.ridgerun.com/wiki/images/d/df/Blue_question_mark_icon.svg.png";
    $admin_img = "https://voz.vn/data/avatars/m/0/1.jpg?1583515192";

    if(isset($_GET['idq']))
        $idQuestion = $_GET['idq'];
    else 
        header('location:index.php');

    $questions = simplexml_load_file("./data/questions.xml");
    foreach($questions->question as $question)
    {
        if($question->idQuestion == $idQuestion) {
            $item = $question;
            break;
        }
    }
    if($item == 123)
        header('location:index.php');
    file_put_contents('data/product.xml', $questions->asXML());
    $questions = null;

    function update_view($idQuestion){
        $xml = new DOMDocument('1.0', 'utf-8');
        $xml->formatOutput = true;
        $xml->preserveWhiteSpace = false;
        $xml->load('./data/questions.xml');
        $count = $xml->getElementsByTagName('question')->length;
        for ($i=0; $i < $count; $i++) { 
            $item1 = $xml->getElementsByTagName('question')->item($i);
            $id = (string)$item1->getElementsByTagName('idQuestion')->item(0)->nodeValue;
            if($idQuestion == $id){
                $item1->getElementsByTagName('views')->item(0)->nodeValue += 1;
            }
        } 
        htmlentities($xml->save('./data/questions.xml'));
    }

    function update_replies(){

    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <style>
    #listQues {
        margin: 10px 20px;
    }

    .title_ques {}

    .img_thumb {
        margin: 5px;
        width: 70px;
        display: block;
    }

    .question {
        display: flex;
        margin: 0 10px;
    }

    .title_ques {
        width: 100px;
        margin: 5px;
    }

    .content_ques {
        flex: 1;
        width: 500px;
    }

    .sTag {
        width: 480px;
        background-color: rgb(169, 171, 172);
        border-bottom: 1px solid black;
        padding: 5px;
    }

    .cauhoi {
        min-height: 90px;
        height: auto;
    }

    .replies {
        display: flex;
        margin: 20px 10px;
    }

    .sent_cmt {
        display: flex;
    }

    #cmt {
        display: block;
        min-width: 100%;
        height: 100px;
        padding: 10px;
    }

    .btn_sm {
        display: block;
        margin: 0 auto;
        padding: 5px;
    }

    .tagQuestion {
        display: flex;
        justify-content: center;
    }

    .body {
        margin-top: 25px
    }
    .cmt_area{
        border-top: 1px solid black;
        margin: 30px 0;
    }
    </style>
</head>

<body>
    <div class="container">
        <?php include './layout/header.php'?>
        <div class="body">
            <div class="tag">
                <h3>Câu hỏi: <?php echo $item->title ?></h3>
            </div>
            <div class="Question_area">
                <div class="question">
                    <div class="title_ques">
                        <img class="img_thumb"
                            src="<?php echo $user_img ?>">
                        <div class="other">
                            <span class="tagQuestion"><?php echo $item->category ?></span><br>
                            <span class="time_q"><?php echo $item->time ?></span>
                        </div>
                    </div>
                    <div class="content_ques">
                        <p class="sTag"> <span class="author" style="font-weight: bold"><?php echo $item->author ?></span> <span class="note">Views:
                                <?php echo $item->views ?></span></p>
                        <p class="sTag cauhoi"><?php echo $item->decription ?></p>
                    </div>
                </div>
                <div class="replies_area">
                    <!------------ load cmt ----------->
                <?php
                    $subQuestions = simplexml_load_file("./data/subQuestion.xml");
                    foreach($subQuestions->subquestion as $subquestion)
                    {
                        if($subquestion->idQuestion == $idQuestion) {
                            $role = $subquestion->role;
                            
                            $author = $subquestion->author;
                            $time = $subquestion->time;
                            $content = $subquestion->content;
                            if($role == 'AD') {
                                $roleIs = 'QTV';
                                $img_user = $admin_img;
                            } 
                            else{
                                $roleIs = "User";
                                $img_user = $user_img;
                            }
                    echo '<div class="replies"> ';
                        
                        $phanA = "<div class='content_ques'>
                            <p class='sTag'>
                                <span class='time_q'>$time</span>    
                                ||
                                <span  class='author'>$author</span>    
                            </p>
                            <p class='sTag cauhoi'>$content</p>
                        </div>";

                        $phanB = "<div class='title_ques'>
                            <img class='img_thumb' src='$img_user'>
                            <div class='other'>
                                <span class='tagQuestion roles'>$roleIs</span><br>
                            </div>
                        </div>";
                        
                        if($role == 'AD') {
                            echo $phanA . $phanB;
                        } 
                        else{
                            echo $phanB . $phanA;
                        }

                    echo "</div>";


                }} ?>

                </div>

                <div class="cmt_area">

                    <div class="replies">
                        <div class="title_ques">
                            <img class="img_thumb" src="<?php if(isset($_SESSION['isAdmin'])) echo $admin_img; else echo $user_img ?>">
                            <div class="other">
                                <span class="tagQuestion roles"><?php if(isset($_SESSION['isAdmin'])) echo "QTV"; else echo 'User'?></span><br>
                            </div>
                        </div>
                        <div class="content_ques">
                            <form action="" method="post" style="display: <?php echo 'block' ?>" onsubmit="return checkLogin()">
                                <textarea id="cmt" placeholder="Gửi phản hồi" name="comment" cols="20" rows="5"></textarea>
                                <input type="hidden" name="chuky" value="<?php if(isset($_SESSION['userName'])) echo  $_SESSION['userName']?>" />
                                <input class="btn_sm" type="submit" value="Gửi phản hồi">
                            </form>
                        </div>
                        
                    </div>

                    <script>
                        function checkLogin() {
                            if (<?php if(isset($_SESSION['userName'])) echo "true"; else echo "false"; ?>)
                                return true;
                            else {
                                alert("bạn cần đăng nhập để gửi câu hỏi");
                                return false;
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</body>
<?php 
    if(isset($_POST['comment']))
    {
        $role = (isset($_SESSION['isAdmin']))? 'AD' : 'KH';
        $subQuestions = simplexml_load_file('./data/subQuestion.xml');
        $subQuestion = $subQuestions->addChild('subquestion');
        $subQuestion->addChild('role', $role);
        $subQuestion->addChild('idSubQ', sha1($idQuestion . date("h:i:sa")));
        $subQuestion->addChild('idQuestion', $idQuestion);
        $subQuestion->addChild('author', $_SESSION['userName']);
        $subQuestion->addChild('time', date("Y-m-d"));
        $subQuestion->addChild('content', $_POST['comment']);
        file_put_contents('./data/subQuestion.xml', $subQuestions->asXML());
        $subQuestions = null;
        echo '<script>location.reload();</script>';
        update_replies();
    }
    else
        update_view($idQuestion);
?>
</html>