<?php
class Token
{
    /**
    * @desc Get random number
    *
    * @return string Return random number string    
    */
    private function getTokenValue()
    {
        return md5(uniqid(rand(), true).time());
    }
    
    /* *
    * @desc Get the key
    *
    * @param $tokenName string | Pair with the key value into a key-value pair in the session (identifier, guarantee uniqueness)
    *
    * @return array Returns the secret key value stored in the session
    */
    public function getToken($tokenName)
    {
        $token['name']=$tokenName;  //first $tokenName into array
        session_start();
        if(@$_SESSION[$tokenName])  //determines whether the user is stored the session
        { //Yes , then directly return the already stored secret key
            $token['value']=$_SESSION[$tokenName];
            return $token;
        }
        else  //NO, generating a secret key and stored
        {
            $token['value']=$this->getTokenValue();
            $_SESSION[$tokenName]=$token['value'];
            return $token;
        }
    }
}