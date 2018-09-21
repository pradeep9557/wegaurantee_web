<?php
class ControllerExtensionPaymentCodOrderFee extends Controller {
	public function index() {
		$data['button_confirm'] = $this->language->get('button_confirm');

		$data['text_loading'] = $this->language->get('text_loading');

		$data['continue'] = $this->url->link('checkout/success');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/extension/payment/cod_order_fee')) {
			return $this->load->view($this->config->get('config_template') . '/template/extension/payment/cod_order_fee', $data);
		} else {
			return $this->load->view('default/template/extension/payment/cod_order_fee', $data);
		}		
	}

	public function confirm() {
		if ($this->session->data['payment_method']['code'] == 'cod_order_fee') {
			$this->load->model('checkout/order');

			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('payment_cod_order_fee_order_status'));
		}
	}
}
