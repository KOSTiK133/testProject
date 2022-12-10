<?php
require 'dataUser.php';

class db{

    function decode():array
    {
        $get = file_get_contents("../json/db.json");
        $dataJson = json_decode($get,true);
        $dataObject =[];
        for($i=0;$i<count($dataJson);$i++){
            $data = new dataUser($dataJson[$i]['login'],$dataJson[$i]['name'],$dataJson[$i]['password'],$dataJson[$i]['email']);
            array_push($dataObject,$data);
        }
        return $dataObject;
    }
    function encode($data){
        $dataJson=[];
        for($i=0;$i<count($data);$i++){
            array_push($dataJson,$data[$i]->serialize());
        }
        file_put_contents("../json/db.json",json_encode($dataJson,JSON_UNESCAPED_UNICODE));
    }

    function create(dataUser $data){
        $dataJson = $this->decode();
        array_push($dataJson,$data);
        $this->encode($dataJson);
    }
    function read($login,$flag=1){
        $dataObject = $this->decode();
        if($flag==1) {
            for ($i = 0; $i < count($dataObject); $i++) {
                $a = $dataObject[$i]->GetLogin();
                if ($a == $login) {
                    return $dataObject[$i];
                } else continue;
            }
            return null;

        }
        elseif ($flag==2){
            for ($i = 0; $i < count($dataObject); $i++) {
                $a = $dataObject[$i]->GetEmail();
                if ($a == $login) {
                    return $dataObject[$i];
                } else continue;
            }
            return null;
        }
        else {
            return null;
        }
    }
    function update(dataUser $data){
        $dataObject = $this->decode();
        for($i=0;$i<count($dataObject);$i++){
            if($dataObject[$i]->GetLogin==$data->GetLogin()){
                $dataObject[$i]=$data;
                break;
            }
        }
        $this->encode($dataObject);
    }
    function delete($login){
        $dataObject = $this->decode();
        for($i=0;$i<count($dataObject);$i++) {
            if ($dataObject[$i]->GetLogin == $login) {
                unset($dataObject[$i]);
                break;
            } else continue;
        }
        $this->encode($dataObject);
    }

}

?>