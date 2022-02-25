<?php
    session_start();
    if(isset($_POST['req']) && $_POST['req'] == 'login')
    {
        $users = $categories = simplexml_load_file('./data/users.xml');
        $input_userName = $_POST['username'];
        $input_password = $_POST['password'];
        $temp = false;
        foreach($users->user as $user){
            if($user->name == $input_userName && $user->pass == hash("ripemd160", $input_password))
            {
                $temp = true;
                break;
            }
        }
        if($temp)
        {
            $_SESSION['userName'] = $input_userName;
            // echo "<script>setTimeout(()=>{location = 'http://localhost/xml/'}, 10)</script>";
        }
        else
        {
            echo "Mật khẩu hoặc password không đúng";
            // echo "<script>setTimeout(()=>{location = 'http://localhost/xml/user/login.html'}, 2000)</script>";
        }
    }
    if(isset($_POST['req']) && $_POST['req'] == 'logup')
    {
        if( isset($_POST['role']) && checkUser($_POST['name'])) {
            $users = simplexml_load_file('./data/users.xml');
            $user = $users->addChild('user');
            $user->addAttribute('role', $_POST['role']);
            $user->addChild('name', $_POST['name']);
            $user->addChild('pass', hash("ripemd160" ,$_POST['pass']));
            $user->addChild('phone', $_POST['phone']);
            $user->addChild('email', $_POST['email']);
            $user->addChild('birthday', $_POST['birthday']);
            file_put_contents('./data/users.xml', $users->asXML());
            
            $_SESSION["userName"] = $_POST["name"];
            echo "<br>Xin chào " . $_SESSION['userName'];
        }
        else{
            echo "Tên đăng nhập đã tồn tại";
        }
    }
    function checkUser($name){
        $users = simplexml_load_file('./data/users.xml');
        foreach($users->user as $user){
            if($user->name == $name)
                return false;
        }
        return true;
    }
    if(isset($_GET['logout']) && $_GET['logout'] == 'true'){
        session_destroy();
    }
?>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<style>
    #login{
        position: absolute;
        width: 300px;
        height: 110px;
        margin: 50px 150px;
        top: -200px;
        box-shadow: 0 0 50px black;
        background-color: #9e9e9e;
        transition: 0.5s;
    }
    .iput{
        width: 200px;
        margin: 2px 50px;
    }
    #close{
        float: right;
        cursor: pointer;
    }
    #close1{
        float: right;
        cursor: pointer;
    }
    #loginF_btn{
        cursor: pointer;
    }
    #logup{
        position: absolute;
        width: 300px;
        height: 210px;
        margin: 50px 150px;
        top: -400px;
        box-shadow: 0 0 50px black;
        background-color: #9e9e9e;
        transition: 0.5s;
    }
</style>
<div class="header">
    <div id="login">
        <h3 align="center">Đăng nhập<span id='close'>X</span></h3>
        <br>
        <form action="" method="post">
            <input class="iput" name="username" type="text" placeholder="Nhập tên đăng nhập">
            <input class="iput" name="password" type="password" placeholder="Nhập mật khẩu">
            <input type="hidden" name='req' value='login'/>
            <input style="width: 100px; margin: 0 100px" type="submit" value="Đăng nhập">
        </form>
    </div>

    <div id="logup">
        <h3 align="center">Đăng ký<span id='close1'>X</span></h3>
        <br>
        <form action="" method="post">
            <input class='iput' type="text" placeholder="Nhập tên của bạn" name="name" required>
            <input class='iput' type="password" placeholder="Nhập mật khẩu" name="pass" required>
            <input class='iput' type="number" placeholder="Số điện thoại của bạn" name="phone" required>
            <input class='iput' type="email" placeholder="Email của bạn" name="email" required>
            <input class='iput' type="date" required name="birthday"><br><br>
            <input type="hidden" name="role" value="KH">
            <input type="hidden" name='req' value='logup'/>
            <input style="width: 100px; margin: 0 100px" type="submit" value="Đăng ký" >
        </form>
    </div>
    
    <div class="logo">
        <a href="index.php">
            <img src="https://img1.pnghut.com/5/2/25/ZWdn5KpN3D/question-mark-logo-imperative-mood-bank.jpg" alt="" class="logo_img">
        </a>
    </div>
    <div class="search">
        <form action="search.php" method="get">
            <input type="text" name="search_key" placeholder="Tìm kiếm câu hỏi">
            <input type="submit" value="Tìm kiếm">
        </form>
    </div>
    <div class="logon">
        <span>xin chào,  
        <?php 
            if(isset($_SESSION['userName']))
                echo '<a href="http://localhost/xml/index.php?logout=true" title="Nhấn để đăng xuất">' . $_SESSION['userName'] . '</a> || <a href="/xml/user/myquestion.php">Đặt câu hỏi</a>'; 
            else
                echo '<span id="register1">register</span> or <span id="loginF_btn">login</span>';
        ?>
        </span>           
    </div>
    
</div>
<script>
    var btn_c = document.getElementById("close");
    btn_c.addEventListener('click', ()=>{document.getElementById("login").style.top = "-200px"})
    
    var login_btn = document.getElementById('loginF_btn');
    login_btn.addEventListener('click', ()=>{document.getElementById("login").style.top = "50px"; document.getElementById("logup").style.top = "-400px"})

    var btn_c1 = document.getElementById("close1");
    btn_c1.addEventListener('click', ()=>{document.getElementById("logup").style.top = "-400px"})
    
    var login_btn1 = document.getElementById('register1');
    login_btn1.addEventListener('click', ()=>{document.getElementById("logup").style.top = "50px"; document.getElementById("login").style.top = "-200px"})
</script>