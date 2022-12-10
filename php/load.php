<?php
require_once 'other.php';
require_once 'db.php';
require_once 'AuthUser.php';
if (@$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) {
    $db = new db();
    $postData = json_decode($_POST['dataform'], true);

    if ($postData['button'] == 'load') {
        if (isset($_COOKIE['name']) || isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            setcookie('name',$user);
            echo json_encode(array('nameUser' =>$user ));
        }
    }

    if($postData['button']=='auth'){
        $user = $db->read($postData['login'],1);
        if($user!=null && $user->GetPassword()==hash_salt($postData['pass'])) {
            $auth = new AuthUser($user);
            $auth->authSession();
            $user = $_SESSION['user'];
            echo json_encode(array("nameUser" => $user));

        }
        else{
            echo json_encode(array("erorAuth" => "Пользователь с такими данными не найден"));
        }

    }
    if($postData['button']=='exit'){
       session_destroy();
        $temp = $_COOKIE['prev_addr'];
        setcookie("name","",time()-10000);
        echo json_encode(array("status" => 'exit'));

    }
    if ($postData['button'] == 'reg') {
        $postData= clear($postData);
        if(validate($db,$postData)) {
            $user = new dataUser($postData['login'], $postData['name'], hash_salt($postData['pass']), $postData['email']);
            $db->create($user);
            $auth = new AuthUser($user);
            $auth->authSession();
            header("location:index.html");
        }
    }
}

else{
    http_response_code(-1);
}
