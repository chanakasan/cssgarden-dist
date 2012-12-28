<?php


class Model_Users
{
    /**
     * Get the logged in user
     *
     * @param string $column
     * @return false|string
     */
    public static function getLoggedInUser()
    {
        //load user auth details
        $user = Zend_Auth::getInstance()->getIdentity();

        if($user)
            return $user;
        else
            return false;
    }

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
        // load user auth details
        $user = Zend_Auth::getInstance()->getIdentity();        

        // if field is defined in auth identity
        if($user) {
            return $user->$column;
        }
        else
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

        return self::getLoggedInUserField($column);
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

