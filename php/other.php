<?php


function hash_salt($password): string
{
    $salt = '1vdy12ud12ytdu1f2dy3fduf23uydf233tfduy23duy32duy23ud';
    $createPassword = md5($salt . strval($password));
    return $createPassword;
}//функция хесширования с солью

function countSymbol(string $data, int $count): bool
{
    if (strlen($data) < $count) return false;
    else return true;
}

function validate($db,$data)
{
        $countError = 0;
    if ($db->read($data['login'], 1) == null && $db->read($data['email'], 2) == null) {
        $errorRegLogin = "";
    }
    else{
        $countError++;
        $errorRegLogin = "пользователь с таким логином и почтой уже созданы";
    }
    if (countSymbol($data['login'], 6))
        $errorLogin = "";
    else {
        $countError++;
        $errorLogin = "Количество символов менее 6";
    }

    if (countSymbol($data['pass'], 6) && ctype_alnum($data['pass']))
        $errorPassword = "";
    else {
        $countError++;
        $errorPassword = "должно быть более 5 символов и содержать буквы с цифрами";
    }

    if (filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        $errorEmail = "";
    else {
        $countError++;
        $errorEmail = "Некоректно введен email";
    }

    if (countSymbol($data['name'], 2) && ctype_alpha($data['name']))
        $errorName = "";
    else {
        $countError++;
        $errorName = "должно быть более 1 символа и содержать только буквы";
    }
    $data = array("login" => $errorLogin,"regLogin"=>$errorRegLogin, "password" => $errorPassword, "email" => $errorEmail, "name" => $errorName);
    echo json_encode($data);
    if ($countError > 0) {
        return false;
    } else return true;

}

function clear($data){
    $data['login']=trim($data['login']);
    $data['pass']=trim($data['pass']);
    $data['email']=trim($data['email']);
    $data['name']=trim($data['name']);
return $data;

}

?>