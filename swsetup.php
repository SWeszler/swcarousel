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

    public function ajaxProcess() {
        if(!($action = isset($_POST['action'])))
            return false;

        switch ($action) {
            case 'save-shop':
                Configuration::updateValue('PS_SHOP_NAME', $_POST['name']);
                $return = array(
                    'name' => $_POST['name']
                );
                echo json_encode($return);
            die();
            
            case 'save-other':

            die();
        }
    }

    public function getContent() {
        $this->ajaxProcess();
        $ps_shop_name = 
        ob_start();
        ?>

        <div class="panel">
            <script>
                var ps_module = '<?php echo $this->l('SW Setup'); ?>';
                var ps_shop_name = '<?php echo Configuration::get('PS_SHOP_NAME'); ?>';
                var RURI = location.href;
            </script>
            <div  id="app"></div>
            <script type="text/javascript" src="<?php echo __PS_BASE_URI__ . '/modules/swsetup/swsetup/js/admin.js';?>"></script>
        </div>
        <?php
        return ob_get_clean();
    }

}
