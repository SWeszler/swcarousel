<?php
if (!defined('_PS_VERSION_'))
    exit;

include_once(dirname(__FILE__) . '/SwImgModel.php');

class SWCarousel extends Module {

    public $image_item;

    public function __construct() {
        $this->name = 'swcarousel';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Sebastian Weszler';
        $this->need_instance = 0;

        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('SW Carousel');
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => '1.6.99.99');
    }

    public function install() {
        if (!parent::install() || !$this->registerHook('hookHeader') || !$this->registerHook('hookDisplayFooter') || !$this->installDB())
            return false;

        Configuration::updateValue('_SW_CAROUSEL_AUTO_', true);
        Configuration::updateValue('_SW_CAROUSEL_MARGIN_', true);
        return true;
    }

    public function installDB() {
        $sql = 'CREATE TABLE `' . _DB_PREFIX_ . 'swcarouselimage` (
            `id_image` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `position` TINYINT UNSIGNED NOT NULL DEFAULT 1,
            `title` TEXT,
            `url` TEXT,
            `src` TEXT,
            `html` TEXT,
            `date_add` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `date_update` DATETIME NOT NULL,
            PRIMARY KEY (`id_image`)
        ) DEFAULT CHARSET=utf8;';

        return Db::getInstance()->execute($sql);
    }

    public function uninstallDB() {
        return Db::getInstance()->execute('DROP TABLE `' . _DB_PREFIX_ . 'swcarouselimage`;');
    }

    public function uninstall() {
        if (!parent::uninstall() ||
                !$this->uninstallDB()
        )
            return false;

        Configuration::deleteByName('_SW_CAROUSEL_AUTO_');
        Configuration::deleteByName('_SW_CAROUSEL_MARGIN_');
        return true;
    }

    public function hookDisplayFooter($params) {
        $this->smarty->assign(array(
            'autoplay' => Configuration::get('_SW_CAROUSEL_AUTO_')?'true':'false',
            'images' => SwImgModel::getAll()
        ));
        return $this->display(__FILE__, 'swcarousel.tpl');
    }

    public function hookHeader($params) {
        $this->context->controller->addCss($this->_path . 'css/owl.carousel.min.css');
        $this->context->controller->addCss($this->_path . 'css/swcarousel.css');
        $this->context->controller->addJS($this->_path . 'js/owl.carousel.min.js');
    }

    public function ajaxNewImage() {
        if(!isset($_POST['object'])) return false;

        $image = new SwImgModel();
        $image->title = $_POST['object']['title'];
        $image->url = $_POST['object']['url'];
        $image->date_update = date('Y-m-d H:i:s');
        return array('status' => $image->add(), 'object' => $image);
    }

    public function ajaxUpdateImage() {
        if(!isset($_POST['object'])) return false;

        $image = new SwImgModel((int)$_POST['object']['id_image']);
        $image->title = $_POST['object']['title'];
        $image->url = $_POST['object']['url'];
        $image->src = $_POST['object']['src'];
        $image->date_update = date('Y-m-d H:i:s');
        return array('action' => 'update', 'status' => $image->save());
    }

    public function ajaxDeleteImage() {
        if(!isset($_POST['id_image'])) return false;

        $image = new SwImgModel((int)$_POST['id_image']);

        $return = $image->delete();
        if($return)
            unlink(_PS_ROOT_DIR_ .'/'. $image->src);
        
        return $return;
    }

    public function ajaxProcess() {
        
        if(!isset($_POST['action']) && !isset($_POST['ajax']))
            return false;

        $return = array();
        switch ($_POST['action']) {
            case 'add-new':
                $result = $this->ajaxNewImage();
                $return['status'] = $result['status'];
                $return['object'] = $result['object'];
                $return['new_list'] = SwImgModel::getAll();
                echo json_encode($return);
                die();
            break;
            case 'update':
                $return['status'] = $this->ajaxUpdateImage();
                $return['new_list'] = SwImgModel::getAll();
                echo json_encode($return);
                die();
            break;
            case 'get-all':
                $return['status'] = 'ok';
                $return['new_list'] = SwImgModel::getAll();
                echo json_encode($return);
                die();
            break;
            case 'upload':
                $return['status'] = $this->handleUpload();
                $return['new_list'] = SwImgModel::getAll();
                echo json_encode($return);
                die();
            break;
            case 'delete':
                $return['status'] = $this->ajaxDeleteImage();
                $return['new_list'] = SwImgModel::getAll();
                echo json_encode($return);
                die();
            break;
        }
    }

    public function handleUpload() {
        if(isset($_FILES['file']) && isset($_POST['id_image'])) {
            $fileExt = end(explode('.',$_FILES['file']['name']));
            $dirPath = '/uploads/'. $_POST['id_image'] .'.'.$fileExt;
            move_uploaded_file($_FILES['file']['tmp_name'], __DIR__ . $dirPath);
            $image = new SwImgModel((int)$_POST['id_image']);
            $image->src = 'modules/swcarousel' . $dirPath;
            $image->save();
        }
    }

    public function getContent() {
        $this->ajaxProcess();
        ob_start();
        ?>

        <div class="panel">
            <script>
                var ps_module = '<?php echo $this->l('SW Carousel'); ?>';
                var ps_autoplay = '<?php echo $this->l('Autoplay'); ?>';
                var autoplay = '<?php echo Configuration::get('_SW_CAROUSEL_AUTO_'); ?>';
                var ps_img_list = <?php echo json_encode(SwImgModel::getAll());?>;
                var RURI = location.href;
                var base_uri = '<?php echo __PS_BASE_URI__ ?>';
            </script>

            <div  id="app"></div>
            <script type="text/javascript" src="<?php echo __PS_BASE_URI__ . '/modules/swcarousel/swcarousel/js/admin.js'; ?>"></script>
        </div>
        <?php
        return ob_get_clean();
    }

}
