<?php
class ModelVendorLtsAccount extends model {
	public function venddorInfo($data) {
		$this->db->query("UPDATE " . DB_PREFIX . "lts_vendor SET about='". $this->db->escape($data['about']) ."', store='". $this->db->escape($data['store']) ."', address1='". $this->db->escape($data['address1']) ."', address2='". $this->db->escape($data['address2']) ."', city='". $this->db->escape($data['city']) ."', postcode='". $this->db->escape($data['postcode']) ."', country_id='". (int)$data['country_id'] ."', zone_id='". (int)$data['zone_id'] ."', image='". $this->db->escape($data['image']) ."' WHERE vendor_id = '" . (int)$this->customer->isVendor() . "'");

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "lts_vendor_payment`  WHERE  vendor_id = '" . (int)$this->customer->isVendor() . "'");
		if($query->row) {
			$this->db->query("UPDATE " . DB_PREFIX . "lts_vendor_payment SET paypal='". $this->db->escape($data['paypal']) ."', account_holder='". $this->db->escape($data['account_holder']) ."', bankname='". $this->db->escape($data['bankname']) ."', accountno='". (int)$data['accountno'] ."', ifsc='". $this->db->escape($data['ifsc']) ."' WHERE vendor_id='". (int)$this->customer->isVendor() ."'");
		} else {
			$this->db->query("INSERT INTO ". DB_PREFIX ."lts_vendor_payment SET vendor_id='". (int)$this->customer->isVendor() ."', paypal='". $this->db->escape($data['paypal']) ."', account_holder='". $this->db->escape($data['account_holder']) ."', bankname='". $this->db->escape($data['bankname']) ."', accountno='". (int)$data['accountno'] ."', ifsc='". $this->db->escape($data['ifsc']) ."'");
		}
	}

	public function getVendor($vendor_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "lts_vendor` WHERE vendor_id='". (int)$vendor_id ."'");

		return $query->row;
	}

	public function getPayment($vendor_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "lts_vendor_payment`  WHERE  vendor_id = '" . (int)$vendor_id . "'");

		return $query->row;	
	}
	

}