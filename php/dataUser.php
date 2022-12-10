<?php
require_once 'user.php';

class dataUser extends user
{

    function __construct($login,$name,$password,$email){
        $this->SetLogin($login);
        $this->SetName($name);
        $this->SetPassword($password);
        $this->SetEmail($email);
    }



    function serialize(){
        $dataForSerialize = array('login'=>$this->GetLogin(),'password'=>$this->GetPassword(),'email'=>$this->GetEmail(),'name'=>$this->GetName());
        return $dataForSerialize;
    }
}