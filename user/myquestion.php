<?php
    session_start();
    
    if(isset($_SESSION['userName']))   
    {
      $author = $_SESSION['userName'];  
    }
    else
    {
        $author = null;  
    }
   
    $date  = date("Y-m-d");
	if(isset($_POST['submit_Q'])) 

        if($author == null)
        {
            echo imap_alerts("Đăng nhập đi bạn");
        }
        else
        {
    {
        $questions = simplexml_load_file('../data/questions.xml');
        $question = $questions->addChild('question');
        $question->addChild('time', $date);
        $question->addChild('title', $_POST['title']);
        $question->addChild('author', $author);
        $question->addChild('idQuestion', hash('ripemd160', date("h:i:sa") . $_POST['title']));
        $question->addChild('category', $_POST['Select_Type']);
        $question->addChild('ttReplies', 0);
        $question->addChild('views', 0);
        $question->addChild('decription', $_POST['Descrip']);
        file_put_contents('../data/questions.xml', $questions->asXML());
        echo "<script>alert('Câu hỏi của bạn đã được gửi đến bộ phận. Bạn sẽ nhận được câu trả lời trong thời gian sớm nhất có thể. Thân mến gửi đến ban!!!'); location = 'http://localhost/xml'; </script>";
}
	}
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/mau.css">
	<title> Phần câu hỏi</title>
</head>
<body>
	

    <div class="container_Q">
	<form  action="" method="POST">

            <br/>
            <h2 class="title_Q"> Chào <a href=""><?php echo $author ?></a> đến phần đặt câu hỏi</h2>  
            <br/>                  
            <div class="input-box">
                 <label for="Type">Nhập tiêu đề của bạn</label><br/>
                <input type="text" class="form-input" placeholder="Tiêu đề của bạn" name="title" style="width: 400px; height:30px">
            </div>
            <div class="input-box">
                <div class="col-6">
                    <label for="Type">Chọn loại câu hỏi của bạn</label>
                    <br/>
                    <select id="S_Type" name="Select_Type">
                        <option value="Phone">Điện thoại</option>
                        <option value="Tai Nghe">Tai Nghe</option>   
                        <option value="Bảo hành">Bảo hành</option>                            
                        <option value="Đồ bếp">Đồ bếp</option>   
                        <option value="Dịch vụ">Dịch vụ</option> 
                        <option value="Tivi">Tivi</option>   
                        <option value="Máy lạnh">Máy lạnh</option>     
                    </select>
                </div>
            </div>
            <div class="input-box">
                <label for="gioithieu">Miêu tả câu hỏi của bạn</label>
                <br>
                <textarea id="gioithieu" name="Descrip" style="width: 940px; height:400px"></textarea>
            </div>   
            <br>                

			<div class="button-box">
                <input  class="input_button" type="submit" name ="submit_Q" value="Gửi câu hỏi của bạn" />
            </div>

                
            <div class="emty" >
                <br>
                <br>
            </div>
    </form>
</div>

<div   class="footer">
        <p> Liên hệ theo số điện thoai: 1293058126589 </p>
        <p> Hoặc liên hệ theo Gmail: <a href="">gocthugian.com</a></p>
        <p> Donate theo số tài khoản MB Bank: q930r1729-12 hoặc ví momo: 23895  97253</p>
</div>
<div class="emty" >
                <br>
                <br>
            </div>
</body>
</html>