<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends MY_Controller
{

    var $_container;
    var $_modules;

    function __construct()
    {
        parent::__construct();
//you can add to autoload and delete this
// Set container variable

        $this->_container = $this->config->item('gpm_sys_web_template_dir_admin') . "layout";
        $this->_modules = $this->config->item('modules_locations');

        log_message('debug', 'CI My Admin : Admin_Controller class loaded');

    }
}