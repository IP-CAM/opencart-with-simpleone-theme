<?php
class ModelVendorLtsExport extends model {
	public function getAllProducts($product_type) {
		if($product_type == 1) {
			$sql =  $this->db->query("SELECT product_id FROM ". DB_PREFIX ."lts_vendor_product WHERE vendor_id ='". (int)$this->customer->getId() ."'");
		}

		if($product_type == 2) {
			$sql =  $this->db->query("SELECT product_id FROM ". DB_PREFIX ."lts_vendor_product WHERE vendor_id ='". (int)$this->customer->getId() ."' AND status='". (int)0 ."' ");
		}

		if($product_type == 3) {
			$sql =  $this->db->query("SELECT product_id FROM ". DB_PREFIX ."lts_vendor_product WHERE vendor_id ='". (int)$this->customer->getId() ."' AND status='". (int)1 ."' ");
		}

		if($sql->rows) {

			foreach($sql->rows as $product) {
			
				$query1 = $this->db->query("SELECT * FROM ". DB_PREFIX ."product WHERE product_id='". (int)$product['product_id'] ."'");

				$products[] = $query1->row;

				$query2 = $this->db->query("SELECT * FROM ". DB_PREFIX ."product_description WHERE product_id='". (int)$product['product_id'] ."' ");

				$product_description[] = $query2->row;

				$query3 = $this->db->query("SELECT * FROM ". DB_PREFIX ."product_attribute WHERE product_id='". (int)$product['product_id'] ."'");

				$product_attribute[] = $query3->row;

				$query4 = $this->db->query("SELECT * FROM ". DB_PREFIX ."product_discount WHERE product_id='". (int)$product['product_id'] ."' ");

				$product_discount[] = $query4->row;

				$query5 = $this->db->query("SELECT * FROM ". DB_PREFIX ."product_image WHERE product_id='". (int)$product['product_id'] ."' ");

				$product_image[] = $query5->rows;

				$query6 = $this->db->query("SELECT * FROM ". DB_PREFIX ."product_to_download WHERE product_id='". (int)$product['product_id'] ."' ");

				$product_download[] = $query6->rows;

				$query7 = $this->db->query("SELECT * FROM ". DB_PREFIX ."product_special WHERE product_id='". (int)$product['product_id'] ."'");

				$product_special[] = $query7->rows;

				$query8 = $this->db->query("SELECT * FROM ". DB_PREFIX ."product_filter WHERE product_id='". (int)$product['product_id'] ."'");

				$product_filter[] = $query8->rows;
			}	

			return array(
				'products' 				=> $products,
				'product_description'	=> $product_description,
				'product_attribute'		=> $product_attribute,
				'product_discount'		=> $product_discount,
				'product_image'			=> $product_image,
				'product_download'		=> $product_download,
				'product_special'		=> $product_special,
				'product_filter'		=> $product_filter
			);
		} else {
			return array();
		}
	}

	
	public function getOrderExport($order_status_id) {

		$sql = $this->db->query("SELECT order_id, order_product_id, product_id FROM ". DB_PREFIX ."lts_vendor_order_product WHERE vendor_id='". (int)$this->customer->getId() ."' AND order_status_id='". (int)$order_status_id ."'");

		if($sql->rows) {

			foreach($sql->rows as $order) {
				$query1 = $this->db->query("SELECT * FROM ". DB_PREFIX ."order WHERE  order_id='". (int)$order['order_id'] ."' AND order_status_id='". (int)$order_status_id ."'");

				$orders[] = $query1->rows;

				$query2 = $this->db->query("SELECT * FROM ". DB_PREFIX ."order_product WHERE order_id='". (int)$order['order_id'] ."' AND product_id='". (int)$order['product_id'] ."'");

				$order_products[] = $query2->rows;


				$query3 = $this->db->query("SELECT *FROM ". DB_PREFIX ."order_history WHERE order_id='". (int)$order['order_id'] ."' AND order_status_id='". (int)$order_status_id ."'");

				$order_history[] = $query3->rows;

			}

			return array(
				'orders'		 => $orders,
				'order_products' => $order_products,
				'order_history'	 => $order_history

			);
		} else {
			return array();
		}
	}

	public function getOrderStatuses() {
		
	}

}
