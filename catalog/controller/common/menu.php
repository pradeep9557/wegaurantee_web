<?php
class ControllerCommonMenu extends Controller {
	public function index() {
		$this->load->language('common/menu');

		// Menu
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();

				$children = $this->model_catalog_category->getCategories($category['category_id']);

				foreach ($children as $child) {
					
					// Level 3
					
					// Level 2
				$children_data_level3 = array();

				$children_3 = $this->model_catalog_category->getCategories($child['category_id']);

				foreach ($children_3 as $child_3) {
					$filter_data = array(
						'filter_category_id'  => $child_3['category_id'],
						'filter_sub_category' => true
					);

					$children_data_level3[] = array(
						'name'  => $child_3['name'],// . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
						'href'  => $this->url->link('product/category', 'path=' . $child['category_id'] . '_' . $child_3['category_id']),
						 
					);
				}
				
					
					$filter_data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);

					$children_data[] = array(
						'name'  => $child['name'], //. ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
						'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id']),
						
						'children_3' => $children_data_level3
					);
				}

				// Level 1
				$data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
				
				/*print"<pre>";
				print_r($data['categories']);
				print"</pre>";*/
			}
		}

		return $this->load->view('common/menu', $data);
	}
}
