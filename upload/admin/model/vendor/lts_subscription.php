<?php
Class ModelVendorLtsSubscription extends Model {
	public function addSubscription($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "lts_vendor_subscription SET no_of_product = '" . (int)$data['no_of_product'] . "', join_fee = '" . (float)$data['join_fee'] . "', subscription_fee = '" . (float)$data['subscription_fee'] . "', validity = '" . (float)$data['validity'] . "', status = '" . (int)$data['status'] . "', default_plan = '". (int)$data['default_plan'] ."', date_added = NOW(), date_modified = NOW()");

		$subscription_id = $this->db->getLastId();

		if($data['default_plan']==1){
			$this->db->query("UPDATE " . DB_PREFIX . "lts_vendor_subscription SET default_plan = '0' WHERE subscription_id != '".(int)$subscription_id."'");
		}

		foreach ($data['subscription_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "lts_vendor_subscription_description SET subscription_id = '" . (int)$subscription_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}

		$this->cache->delete('subscription');

		return $subscription_id;

	}

	public function getSubscriptionDescriptions($subscription_id) { 

		$subscription_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "lts_vendor_subscription_description WHERE subscription_id = '" . (int)$subscription_id . "'");

		foreach ($query->rows as $result) {
			$subscription_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description']
			);
		}

		return $subscription_description_data;
	}

	public function editSubscription($subscription_id, $data) {

		$this->db->query("UPDATE " . DB_PREFIX . "lts_vendor_subscription SET no_of_product = '" . (int)$data['no_of_product'] . "', join_fee = '" . (float)$data['join_fee'] . "', subscription_fee = '" . (float)$data['subscription_fee'] . "', validity = '" . (float)$data['validity'] . "', status = '" . (int)$data['status'] . "', default_plan = '". (int)$data['default_plan'] ."', date_modified = NOW() WHERE subscription_id = '" . (int)$subscription_id . "'");

		if($data['default_plan']==1){
			$this->db->query("UPDATE " . DB_PREFIX . "lts_vendor_subscription SET default_plan = '0' WHERE subscription_id != '".(int)$subscription_id."'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "lts_vendor_subscription_description WHERE subscription_id = '" . (int)$subscription_id . "'");

		foreach ($data['subscription_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "lts_vendor_subscription_description SET subscription_id = '" . (int)$subscription_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}

		$this->cache->delete('subscription');

	}

	public function deleteSubscription($subscription_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "lts_vendor_subscription WHERE subscription_id = '" . (int)$subscription_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "lts_vendor_subscription_description WHERE subscription_id = '" . (int)$subscription_id . "'");

		$this->cache->delete('subscription');
	}

	public function getSubscription($subscription_id) {

		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "lts_vendor_subscription s LEFT JOIN " . DB_PREFIX . "lts_vendor_subscription_description sd ON (s.subscription_id = sd.subscription_id) WHERE s.subscription_id = '" . (int)$subscription_id . "' AND sd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getSubscriptions($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "lts_vendor_subscription s LEFT JOIN " . DB_PREFIX . "lts_vendor_subscription_description sd ON (s.subscription_id = sd.subscription_id) WHERE sd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND sd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= " AND s.status = '" . (int)$data['filter_status'] . "'";
		}

		$sql .= " GROUP BY s.subscription_id";

		$sort_data = array(
			'sd.name',
			's.status',
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY sd.name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalSubscriptions($data = array()) {
		$sql = "SELECT COUNT(DISTINCT s.subscription_id) AS total FROM " . DB_PREFIX . "lts_vendor_subscription s LEFT JOIN " . DB_PREFIX . "lts_vendor_subscription_description sd ON (s.subscription_id = sd.subscription_id)";

		$sql .= " WHERE sd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND sd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= " AND s.status = '" . (int)$data['filter_status'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}


}