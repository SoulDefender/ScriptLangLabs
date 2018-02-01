<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 09.11.2015
 * Time: 21:11
 */

namespace Core;


abstract class Singleton
{

    private static $_aInstances = array();

    /**
     * @param string $className
     * @return mixed
     */
    public static function getInstance($className = '') {
        if(isset($className) && ! empty($className)) {
            $sClassName = $className;
        } else {
            $sClassName = get_called_class(); // �������� ������ ��������� �������� �� ���������
        }
        if( class_exists($sClassName) ){
            if( !isset( self::$_aInstances[ $sClassName ] ) )
                // ���� ��������� ������ ��� �� ��� ������, ������� ���
                self::$_aInstances[ $sClassName ] = new $sClassName();
            // ���������� ���� ���������
            return self::$_aInstances[ $sClassName ];
        }
        return 0;
    }

    /**
     * @param string $className
     * @return mixed
     */
    public static function gi($className = '') {
        return self::getInstance($className);
    }

    final private function __clone(){}

    private function __construct(){}
}
