<?php


class Model_Users
{
    /**
     * Get the user detail of logged in user
     *
     * @param string $name
     * @return false|string
     */
    public static function getLoggedInUserField($name)
    {
        if(!$name) {
            return false;
        }
        //load user auth details
        $user = Zend_Auth::getInstance()->getIdentity();

        //if field is defined in auth identity
        if($user && isset($user->$name)) {
            return $user->$name;
        }
        return false;        
    }


    /**
     *
     * Check if the user is an administrator
     *
     * @return bool
     */
    public static function isAdmin()
    {
        $name = 'isadmin'; // table column to check

        //load user auth details
        $user = Zend_Auth::getInstance()->getStorage();
        

        //if field is defined in auth identity
        if($user && isset($user->$name)) {
            return $user->$name;
        }
        return false;
    }

    /**
     * Check if user is logged in
     * @return bool
     */
    public static function isLoggedIn()
    {
        return Zend_Auth::getInstance()->hasIdentity();
    }
}

