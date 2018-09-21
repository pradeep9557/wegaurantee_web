<?php
/*
 * @package     Opencart.extension
 * @copyright   Copyright (C) 2009 - 2018 Open Source Technologies, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @support
 * http://www.ost.agency/contactus.html
 * sales@opensourcetechnologies.com
 * */
class ControllerExtensionModuleDiscountOn1stPurchase extends Controller
{
    private $error = array();

    public function index()
    {
        $this->load->language('extension/module/discount_on_1st_purchase');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('module_discount_on_1st_purchase', $this->request->post);
            $q = 'select count(*) as total from '.DB_PREFIX."extension WHERE type='total' and code='discount_on_1st_purchase'";
            $query = $this->db->query($q);
            if (!$query->row['total']) {
                $q = 'insert into '.DB_PREFIX."extension values('','total','discount_on_1st_purchase')";
                $this->db->query($q);
                
            }
            $this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '0', `code` = 'module_discount_on_1st_purchase', `key` = 'total_discount_on_1st_purchase_sort_order', `value` = '".$this->request->post['total_discount_on_1st_purchase_sort_order']."'");
            $this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '0', `code` = 'module_discount_on_1st_purchase', `key` = 'total_discount_on_1st_purchase_status', `value` = '".$this->request->post['module_discount_on_1st_purchase_status']."'");
            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');

        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $data['entry_module_publish_date'] = $this->language->get('entry_module_publish_date');
        $data['entry_module_end_date'] = $this->language->get('entry_module_end_date');
        $data['entry_discount'] = $this->language->get('entry_discount');
        $data['entry_minimum_total'] = $this->language->get('entry_minimum_total');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['discount_on_1st_purchase_discount'])) {
            $data['error_discount_on_1st_purchase_discount'] = $this->error['discount_on_1st_purchase_discount'];
        } else {
            $data['error_discount_on_1st_purchase_discount'] = '';
        }

        if (isset($this->error['discount_on_1st_purchase_module_publish_date'])) {
            $data['error_discount_on_1st_purchase_module_publish_date'] = $this->error['discount_on_1st_purchase_module_publish_date'];
        } else {
            $data['error_discount_on_1st_purchase_module_publish_date'] = '';
        }

        if (isset($this->error['discount_on_1st_purchase_minimum_total'])) {
            $data['error_discount_on_1st_purchase_minimum_total'] = $this->error['discount_on_1st_purchase_minimum_total'];
        } else {
            $data['error_discount_on_1st_purchase_minimum_total'] = '';
        }

        $data['breadcrumbs'] = array();
        
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token='.$this->session->data['user_token'], true),
        );

        $data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/discount_on_1st_purchase', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/discount_on_1st_purchase', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

        if (isset($this->request->post['module_discount_on_1st_purchase_status'])) {
            $data['module_discount_on_1st_purchase_status'] = $this->request->post['module_discount_on_1st_purchase_status'];
        } else {
            $data['module_discount_on_1st_purchase_status'] = $this->config->get('module_discount_on_1st_purchase_status');
        }

        if (isset($this->request->post['module_discount_on_1st_purchase_module_publish_date'])) {
            $data['module_discount_on_1st_purchase_module_publish_date'] = $this->request->post['module_discount_on_1st_purchase_module_publish_date'];
        } else {
            $data['module_discount_on_1st_purchase_module_publish_date'] = $this->config->get('module_discount_on_1st_purchase_module_publish_date');
        }

        if (isset($this->request->post['module_discount_on_1st_purchase_module_end_date'])) {
            $data['module_discount_on_1st_purchase_module_end_date'] = $this->request->post['module_discount_on_1st_purchase_module_end_date'];
        } else {
            $data['module_discount_on_1st_purchase_module_end_date'] = $this->config->get('module_discount_on_1st_purchase_module_end_date');
        }

        if (isset($this->request->post['module_discount_on_1st_purchase_discount'])) {
            $data['module_discount_on_1st_purchase_discount'] = $this->request->post['module_discount_on_1st_purchase_discount'];
        } else {
            $data['module_discount_on_1st_purchase_discount'] = $this->config->get('module_discount_on_1st_purchase_discount');
        }

        if (isset($this->request->post['module_discount_on_1st_purchase_minimum_total'])) {
            $data['module_discount_on_1st_purchase_minimum_total'] = $this->request->post['module_discount_on_1st_purchase_minimum_total'];
        } else {
            $data['module_discount_on_1st_purchase_minimum_total'] = $this->config->get('module_discount_on_1st_purchase_minimum_total');
        }

        if (isset($this->request->post['total_discount_on_1st_purchase_sort_order'])) {
            $data['total_discount_on_1st_purchase_sort_order'] = $this->request->post['total_discount_on_1st_purchase_sort_order'];
        } else {
            $data['total_discount_on_1st_purchase_sort_order'] = $this->config->get('total_discount_on_1st_purchase_sort_order');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/discount_on_1st_purchase', $data));
    }

    protected function validate()
    {
        if (!$this->user->hasPermission('modify', 'extension/module/discount_on_1st_purchase')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        if (!$this->request->post['module_discount_on_1st_purchase_discount']) {
            $this->error['discount_on_1st_purchase_discount'] = $this->language->get('error_discount_on_1st_purchase_discount');
        }
        if (!$this->request->post['module_discount_on_1st_purchase_module_publish_date']) {
            $this->error['discount_on_1st_purchase_module_publish_date'] = $this->language->get('error_discount_on_1st_purchase_module_publish_date');
        }
        if (!$this->request->post['module_discount_on_1st_purchase_minimum_total']) {
            $this->error['discount_on_1st_purchase_minimum_total'] = $this->language->get('error_discount_on_1st_purchase_minimum_total');
        }

        return !$this->error;
    }
}
