<?php
class ControllerExtensionTotalCodOrderFeeTotal extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/total/cod_order_fee_total');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('total_cod_order_fee_total', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=total', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_total'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token']. '&type=total', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/total/cod_order_fee_total', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/total/cod_order_fee_total', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=total', true);

		if (isset($this->request->post['total_cod_order_fee_total_status'])) {
			$data['total_cod_order_fee_total_status'] = $this->request->post['total_cod_order_fee_total_status'];
		} else {
			$data['total_cod_order_fee_total_status'] = $this->config->get('total_cod_order_fee_total_status');
		}

		if (isset($this->request->post['total_cod_order_fee_total_sort_order'])) {
			$data['total_cod_order_fee_total_sort_order'] = $this->request->post['total_cod_order_fee_total_sort_order'];
		} else {
			$data['total_cod_order_fee_total_sort_order'] = $this->config->get('total_cod_order_fee_total_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/total/cod_order_fee_total', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/total/cod_order_fee_total')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
	
	public function install() {
		/* oc23 permissions */
        if (version_compare(VERSION, '2.3', '>=')) {
            $this->load->model('user/user_group');
            $this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'extension/total/cod_order_fee_total');
            $this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'extension/total/cod_order_fee_total');
        }
	}
	
	public function uninstall() {
        /* oc23 permissions */
        if (version_compare(VERSION, '2.3', '>=')) {
            $this->load->model('user/user_group');
            $this->model_user_user_group->removePermission($this->user->getGroupId(), 'access', 'extension/total/cod_order_fee_total');
            $this->model_user_user_group->removePermission($this->user->getGroupId(), 'modify', 'extension/total/cod_order_fee_total');
        }
    }
}