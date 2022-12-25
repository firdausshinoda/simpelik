<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Template {

    protected $_CI;

    function __construct() {
        $this->_CI = &get_instance();
    }

    function login_admin($template, $data = null) {
        $data['navbar_web'] = $this->_CI->load->view('style/navbar_login_admin_web', $data, true);
        $data['navbar_mobile'] = $this->_CI->load->view('style/navbar_login_admin_mobile', $data, true);
        $data['content'] = $this->_CI->load->view($template, $data, true);
        $this->_CI->load->view('style/template', $data);
    }

    function admin($template, $data = null) {
        $data['navbar_web'] = $this->_CI->load->view('style/navbar_admin_web', $data, true);
        $data['navbar_mobile'] = $this->_CI->load->view('style/navbar_admin_mobile', $data, true);
        $data['content'] = $this->_CI->load->view($template, $data, true);
        $this->_CI->load->view('style/template', $data);
    }

    function login_superadmin($template, $data = null) {
        $data['navbar_web'] = $this->_CI->load->view('style/navbar_login_superadmin_web', $data, true);
        $data['navbar_mobile'] = $this->_CI->load->view('style/navbar_admin_mobile', $data, true);
        $data['content'] = $this->_CI->load->view($template, $data, true);
        $this->_CI->load->view('style/template', $data);
    }

    function superadmin($template, $data = null) {
        $data['navbar_web'] = $this->_CI->load->view('style/navbar_superadmin_web', $data, true);
        $data['navbar_mobile'] = $this->_CI->load->view('style/navbar_admin_mobile', $data, true);
        $data['content'] = $this->_CI->load->view($template, $data, true);
        $this->_CI->load->view('style/template', $data);
    }

}
