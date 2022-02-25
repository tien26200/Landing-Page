<?php 
    if( isset($_POST['role']) && checkUser($_POST['name'])) {
        $users = simplexml_load_file('../data/users.xml');
        $user = $users->addChild('user');
        $user->addAttribute('role', $_POST['role']);
        $user->addChild('name', $_POST['name']);
        $user->addChild('pass', hash("ripemd160" ,$_POST['pass']));
        $user->addChild('phone', $_POST['phone']);
        $user->addChild('email', $_POST['email']);
        $user->addChild('birthday', $_POST['birthday']);
        file_put_contents('../data/users.xml', $users->asXML());
        
        echo "Done";
        session_start();
        $_SESSION["userName"] = $_POST["name"];
        echo "<br>Xin chào " . $_SESSION['userName'];
        echo "<script>setTimeout(()=>{location = 'http://localhost/xml'}, 2000)</script>";
    }
    else{
        echo "Tên đăng nhập đã tồn tại";
        echo "<script>setTimeout(()=>{location = 'http://localhost/xml/user/register.php'}, 2000)</script>";
    }

    function checkUser($name){
        $users = simplexml_load_file('../data/users.xml');
        foreach($users->user as $user){
            if($user->name == $name)
                return false;
        }
        return true;
    }
?>