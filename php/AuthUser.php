<?php
session_start();
require_once 'user.php';

class AuthUser extends user
{
    function authSession(){
        $_SESSION['user'] = $this->GetName();
    }


    function destroy(){
        session_destroy();
    }

    function __construct(dataUser $user){
        $this->SetLogin($user->GetLogin());
        $this->SetName($user->GetName());
        $this->SetEmail($user->GetEmail());

    }




}