<?php
/*
 * @package     Opencart.extension
 * @copyright   Copyright (C) 2009 - 2018 Open Source Technologies, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @support
 * http://www.ost.agency/contactus.html
 * sales@opensourcetechnologies.com
 * */
class ModelExtensionTotalDiscountOn1stPurchase extends Model
{
    public function getTotal($total)
    {
        $this->load->model('account/customer');

        $publish_date = $this->config->get('module_discount_on_1st_purchase_module_publish_date');
        $end_date = $this->config->get('module_discount_on_1st_purchase_module_end_date');
        $minimum_total = $this->config->get('module_discount_on_1st_purchase_minimum_total');
        $sub_total = $this->cart->getSubTotal();
        if (!$end_date) {
            $end_date = date('Y-m-d');
        }
        if (strtotime(date('Y-m-d')) >= strtotime($publish_date) and strtotime(date('Y-m-d')) <= strtotime($end_date) and $this->customer->isLogged() and $minimum_total <= $sub_total) {
            $q = 'select count(*) as total from '.DB_PREFIX."order where customer_id='".$this->customer->getId()."' and order_status_id>0";
            $query = $this->db->query($q);
            if (!$query->row['total']) {
                $discount_percentage = str_replace('%', '', $this->config->get('module_discount_on_1st_purchase_discount'));
                $this->load->language('extension/total/discount_on_1st_purchase');

                if ($discount_percentage) {
                    $discount_total = 0;

                    foreach ($this->cart->getProducts() as $product) {
                        $discount = 0;

                        $discount = (int) $product['total'] / 100 * $discount_percentage;

                        if ($product['tax_class_id']) {
                            $tax_rates = $this->tax->getRates($product['total'] - ($product['total'] - $discount), $product['tax_class_id']);

                            foreach ($tax_rates as $tax_rate) {
                                if ($tax_rate['type'] == 'P') {
                                    $total['taxes'][$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
                                }
                            }
                        }
                        $discount_total += $discount;
                    }
                }

                if ($discount_total > 0) {
                    $total['total'] -= $discount_total;
                    $total['totals'][] = array(
                        'code' => 'discount_on_1st_purchase',
                        'title' => sprintf($this->language->get('text_discount_on_1st_purchase'), $discount_percentage),
                        'value' => -$discount_total,
                        'sort_order' => $this->config->get('module_discount_on_1st_purchase_sort_order'),
                    );
                }
            }
        }
    }
}
