<?php
class ModelVendorLtsVendor extends Model {
	public function addVendor($customer_id, $data) {
		if($this->config->get('module_lts_vendor_approval')) {
			$status = 1;
		} else {
			$status = 0;
		}

		$this->db->query("INSERT INTO " . DB_PREFIX . "lts_vendor SET vendor_id = '". (int)$customer_id ."', status='". (int)$status ."'");

		$this->db->query("INSERT INTO " . DB_PREFIX . "lts_vendor_store SET vendor_id = '". (int)$customer_id ."', store_name='". $this->db->escape($data['store_name']) ."'");

		return $customer_id;
	}

	public function isVendor($customer_id) { 

		if ($this->config->get('module_lts_vendor_status')) {
			$query = $this->db->query("SELECT vendor_id, status FROM " . DB_PREFIX . "lts_vendor WHERE vendor_id ='". (int)$customer_id . "'");

			return $query->row;
		}
	}

	public function getVendorByTelephone($telephone) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE LOWER(telephone) = '" . $this->db->escape(utf8_strtolower($telephone)) . "'");

		return $query->row['total'];
	}

	public function getVendorByEmail($email) { 
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row;
	}

	
	public function getTotalVendorByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "lts_vendor WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row['total'];
	}
	
	public function getVendor($vendor_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "lts_vendor` v LEFT JOIN `". DB_PREFIX ."customer` c ON (c.customer_id = v.vendor_id)  WHERE  v.vendor_id = '" . (int)$vendor_id . "'");

		return $query->row;
	}

	public function getVendorName($vendor_id) {
		$query = $this->db->query("SELECT CONCAT(firstname, ' ', lastname) AS name FROM `" . DB_PREFIX . "customer` c RIGHT JOIN `". DB_PREFIX ."lts_vendor` lv ON(c.customer_id = lv.vendor_id)  WHERE  lv.vendor_id = '" . (int)$vendor_id . "'");

		return $query->row;
	}


	public function getStoreInformation($vendor_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "lts_vendor_store`  WHERE  vendor_id = '" . (int)$vendor_id . "'");

		return $query->row;
	}

	public function editStoreInformation($data) {
		 $this->db->query("UPDATE " . DB_PREFIX . "lts_vendor_store SET description =  '". $this->db->escape($data['description']) ."' , meta_title = '". $this->db->escape($data['meta_title']) ."', meta_description = '". $this->db->escape($data['meta_description']) ."',  meta_keyword = '". $this->db->escape($data['meta_keyword']) ."', owner_name = '" . $this->db->escape($data['owner_name']) . "', store_name= '" . $this->db->escape($data["store_name"]) . "' , address = '" . $this->db->escape($data['address']) . "' , email= '" . $this->db->escape($data['email']) . "' , telephone= '" . $this->db->escape($data['telephone']) . "' ,  fax= '" . $this->db->escape($data['fax']) . "' ,  country_id= '" . (int)$data['country_id'] . "' ,   zone_id= '" . $this->db->escape($data['zone_id']) . "' ,  city= '" . $this->db->escape($data['city']) . "', logo= '" . $this->db->escape($data['logo']) . "',  banner= '" . $this->db->escape($data['banner']) . "',  facebook= '" . $this->db->escape($data['facebook']) . "', instagram= '" . $this->db->escape($data['instagram']) . "', youtube= '" . $this->db->escape($data['youtube']) . "', twitter= '" . $this->db->escape($data['twitter']) . "', pinterest= '" . $this->db->escape($data['pinterest']) . "' WHERE vendor_id = '". (int)$this->customer->getId() ."'");
	}

	public function addChat($data) {

		$this->db->query("INSERT INTO " . DB_PREFIX . "lts_vendor_chat SET message = '" . $this->db->escape($data['message']) . "', vendor_id = '" . (int)$data['vendor_id'] . "'");
	}

	public function getMessage($vendor_id) {
		$query = $this->db->query("SELECT * FROM `". DB_PREFIX ."lts_vendor_chat` WHERE vendor_id = '". (int)$this->customer->getId() ."'");

		return $query->rows;
	}
}