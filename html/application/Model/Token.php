<?php

namespace Louve\Model;

/**
 * Generate Token model
 */
class Token extends Session
{
    protected $token;
    
    /**
     *  generateTokea
     *  @return string
     */
    public function generateToken()
    {
        $this->token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $this->token;
        return $this->token;
    }


    /**
    *   getToken
    *
    *   @return string
    */
    public function getToken()
    {
        if (isset($_SESSION['token'])) {
            $this->token = $_SESSION['token'];
            return $this->token;
        } else {
           return '';
        }
    }
    
    /**
     *  checkToken
     *
     *  @param $token (token from form)
     *  @return bool
     */
    public function checkToken($token)
    {
        //check token
        return hash_equals($this->getToken(), $token) ? true : false;
    }
}

