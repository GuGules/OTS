<?php

class Message {

    /* HTTP*/
    public static function getHttpsStatus() {
        if ($_SERVER['SERVER_PORT'] ==80){
            return false;
        }
        else if ($_SERVER['SERVER_PORT'] == 443){
            return true;
        }
    }

    /* Encryption / Decryption */
    public static function cryptMessage($token,$message){
        $cMessage = openssl_encrypt($message,"AES-128-ECB",hash("sha512",$token));
        return $cMessage;
    }

    public static function decryptMessage($token,$cMessage){
        $message = openssl_decrypt($cMessage,"AES-128-ECB",hash("sha512",$token));
        return $message;
    }

    /* Token Generation / Validation */

    public static function genToken($length=20){
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        $length = 56;
        for($i=0; $i<$length; $i++){
            $string .= $chars[rand(0, strlen($chars)-1)];
        }
        return $string;
    }

    public static function testToken($token){
        $bdd = MonPDO::getPDO();
        $stmt = $bdd->prepare('SELECT id FROM message WHERE id = :token');
        try {
            $stmt->execute([':token' => $token]);
            if ($stmt->fetch()==false){
                return true;
            } else {
                return false;
            }
        }
        catch (PDOException $e) {
            echo 'Erreur : '.$e->getMessage();
        }

        return $stmt->fetch();
        
    }

    /* Message Storage */

    public static function saveMessage($token,$msg){
        $bdd = MonPDO::getPDO();
        $stmt = $bdd->prepare('INSERT INTO message (id,message) VALUES (:id,:msg)');
        try {
            $stmt->execute([':id' => $token, ':msg' => Message::cryptMessage($token,$msg)]);
        }
        catch (PDOException $e) {
            echo 'Erreur : '.$e->getMessage();
        }
    }

    public static function deleteMessage($token){
        $stmt = MonPDO::getPDO()->prepare('Delete from message where id = :token');
        try {
            $stmt->execute([':token' => $token]);
        } catch (PDOException $e) {
            echo 'Erreur : '.$e->getMessage();
        }
    }


    public static function readMessage($token){
        $bdd = MonPDO::getPDO();
        try {
            $res = $bdd->query('SELECT message FROM message WHERE id = "'.$token.'"');
            $msg = $res->fetch()['message'];
            $msg_bis = Message::decryptMessage($token,$msg);
            Message::deleteMessage($token);
            return $msg_bis;
        }
        catch (PDOException $e) {
            echo 'Erreur : '.$e->getMessage();
        }
    }

    /* URL generation */

    public static function generateUrl($token){
        if (Message::getHttpsStatus()){
            return 'https://'.DOMAIN.'/?readMessage&&token='.$token;
        } else {
            return 'http://'.DOMAIN.'/?readMessage&&token='.$token;
        }
    }

    /* Language */

    public static function getLanguages(){
        $stmt = MonPDO::getPDO();
        $stmt = $stmt->query('SELECT * FROM lang');
        return $stmt->fetchAll();
    }
}


?>