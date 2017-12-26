<?php

if (!defined('_PS_VERSION_'))
    exit;

class SwImgModel extends ObjectModel {

    public $id;
    public $position;
    public $title;
    public $url;
    public $src;
    public $html;
    public $date_add;
    public $date_update;

    public static $definition = array(
        'table' => 'swcarouselimage',
        'primary' => 'id_image',
        'fields' => array(
            'position' => array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'title' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'url' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'src' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'html' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'date_update' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
        )
    );

    public function __construct($id = null) {
        parent::__construct($id);
    }

    public static function getAll() {
        $sql = 'SELECT * FROM ' . _DB_PREFIX_ . 'swcarouselimage';
        $result = DB::getInstance()->executeS($sql);
        return $result;
    }

}
