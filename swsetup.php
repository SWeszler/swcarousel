<?php

if (!defined('_PS_VERSION_'))
    exit;

class SWSetup extends Module {

    public function __construct() {
        $this->name = 'swsetup';
        $this->tab = 'administration';
        $this->version = '1.6.1';
        $this->author = 'Sebastian Weszler';
        $this->need_instance = 0;

        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('SW Setup');
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => '1.6.99.99');
    }

    public function install() {
        if (!parent::install() || !$this->registerHook('hookHeader'))
            return false;

        return true;
    }

    public function uninstall() {
        if (!parent::uninstall())
            return false;

        return true;
    }

    public function hookHeader($params) {

    }

    public function getContent() {
        ob_start();
        include(__DIR__ . '/bo-html.php');
        return ob_get_clean();
    }

}
