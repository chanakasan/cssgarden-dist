<?php

/**
 * Description of Categories
 *
 * @author CS
 */
class Model_Categories
{
    protected static $_cat_entities = array(        
        1 => 'Doctor',
        2 => 'Pharmacy',
        3 => 'Salon',
        4 => 'Supermarket'
    );

    public static function getEntityName($cat_id)
    {
        return self::getCategoryName($cat_id);
    }

    public static function getCategoryName($cat_id)
    {
        /* Note: Category Name = Entitity Name */
        $i = (int) $cat_id;
        $length = count(self::$_cat_entities);

        if($i > 0 && $i < $length)
        {
            return self::$_cat_entities[$i];            
        }
        else
            return false;
    }

    public static function getEntityAttrib($cat_id)
    {
        /* Note: Category Name = Entitity Name */
        $i = (int) $cat_id;
        $length = count(self::$_cat_entities);
        
        if($i > 0 && $i < $length)
        {
            $entity = self::$_cat_entities[$i];
            $str_attrib = \strtolower($entity).'s';
            return $str_attrib;
        }
        else
            return false;
    }

    public static function getEntityList()
    {
        return self::$_cat_entities;
    }

}

