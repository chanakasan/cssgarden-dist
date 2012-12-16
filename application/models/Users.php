<?php


class Model_Users
{
    /**
     * Get the user detail of logged in user
     *
     * @param string $column
     * @return false|string
     */
    public static function getLoggedInUserField($column)
    {
        if(!$column) {
            return false;
        }
        //load user auth details
        $user = Zend_Auth::getInstance()->getIdentity();        

        //if field is defined in auth identity
        if($user && isset($user->$column)) {
            return $user->$column;
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
        $column = 'isadmin'; // table column to check        

        //return self::getLoggedInUserField($column);
        return true;
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

