<?php
class ModelExtensionTotalCodOrderFeeTotal extends Model {
	public function getTotal($total) {
		$this->load->language('extension/total/cod_order_fee_total');
		
		if ((isset($this->session->data['shipping_address']) && isset($this->session->data['payment_method']))
				&& ($this->session->data['payment_method']['code'] == 'cod_order_fee') 
				&& ($this->config->get('payment_cod_order_fee_min_total') > 0 )
				&& ($total > $this->config->get('payment_cod_order_fee_min_total'))
			) {
			
			$total_cod_order_fee = $this->config->get('payment_cod_order_fee_fee');
			
			$total['totals'][] = array(
				'code'       => 'cod_order_fee_total',
				'title'      => $this->language->get('text_cod_order_fee'),
				'value'      => $total_cod_order_fee,
				'sort_order' => $this->config->get('total_cod_order_fee_total_sort_order')
			);

			$total['total'] += $total_cod_order_fee;
		}
	}
}