<?php
class ControllerExtensionPaymentCodOrderFee extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/payment/cod_order_fee');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('payment_cod_order_fee', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_none'] = $this->language->get('text_none');

		$data['entry_order_status'] = $this->language->get('entry_order_status');
		$data['entry_min_total'] = $this->language->get('entry_min_total');
		$data['entry_fee'] = $this->language->get('entry_fee');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['help_min_total'] = $this->language->get('help_min_total');
		
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
			'text' => $this->language->get('text_payment'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/payment/cod_order_fee', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/payment/cod_order_fee', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true);

		if (isset($this->request->post['payment_cod_order_fee_min_total'])) {
			$data['payment_cod_order_fee_min_total'] = $this->request->post['payment_cod_order_fee_min_total'];
		} else {
			$data['payment_cod_order_fee_min_total'] = $this->config->get('payment_cod_order_fee_min_total');
		}
		
		if (isset($this->request->post['payment_cod_order_fee_fee'])) {
			$data['payment_cod_order_fee_fee'] = $this->request->post['payment_cod_order_fee_fee'];
		} else {
			$data['payment_cod_order_fee_fee'] = $this->config->get('payment_cod_order_fee_fee');
		}

		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['payment_cod_order_fee_order_status'])) {
			$data['payment_cod_order_fee_order_status'] = $this->request->post['payment_cod_order_fee_order_status'];
		} else {
			$data['payment_cod_order_fee_order_status'] = $this->config->get('payment_cod_order_fee_order_status');
		}

		if (isset($this->request->post['payment_cod_order_fee_status'])) {
			$data['payment_cod_order_fee_status'] = $this->request->post['payment_cod_order_fee_status'];
		} else {
			$data['payment_cod_order_fee_status'] = $this->config->get('payment_cod_order_fee_status');
		}

		if (isset($this->request->post['payment_cod_order_fee_sort_order'])) {
			$data['payment_cod_order_fee_sort_order'] = $this->request->post['payment_cod_order_fee_sort_order'];
		} else {
			$data['payment_cod_order_fee_sort_order'] = $this->config->get('payment_cod_order_fee_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/payment/cod_order_fee', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/cod_order_fee')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['payment_cod_order_fee_min_total']) {
			$this->error['warning'] = $this->language->get('error_cod_order_fee_min_total');
		}
		
		if (!$this->request->post['payment_cod_order_fee_fee']) {
			$this->error['warning'] = $this->language->get('error_cod_order_fee_fee');
		}
		
		return !$this->error;
	}
	
	public function install() {

		$this->load->model('user/user_group');
		$this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'extension/payment/cod_order_fee');
		$this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'extension/payment/cod_order_fee');

		$this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'extension/module/sainent_extensions');
		$this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'extension/module/sainent_extensions');

		$this->load->model('setting/setting');
		$this->model_setting_setting->editSetting('module_seo_url_sainent', array('module_sainent_extensions_status' => '1'));
		
	}
	
	public function uninstall() {
        /* oc23 permissions */
        if (version_compare(VERSION, '2.3', '>=')) {
            $this->load->model('user/user_group');
            $this->model_user_user_group->removePermission($this->user->getGroupId(), 'access', 'extension/payment/cod_order_fee');
            $this->model_user_user_group->removePermission($this->user->getGroupId(), 'modify', 'extension/payment/cod_order_fee');
        }
    }
}