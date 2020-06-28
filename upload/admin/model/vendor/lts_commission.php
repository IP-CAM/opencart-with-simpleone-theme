<?php
class ModelVendorLtsCommission extends Model {
	public function addCommission($data) {

		$sql = "INSERT INTO ". DB_PREFIX ."lts_vendor_commission SET category_id= '" . (int)$data['category_id'] . "', commission_type = '". $this->db->escape($data['commission_type']) ."', commission='". (int)$data['commission'] ."'";

		$this->db->query($sql);
	}

	public function getCommission($commission_id) {
		$query = $this->db->query("SELECT * FROM ". DB_PREFIX ."lts_vendor_commission WHERE commission_id='". (int)$commission_id ."'");

		return $query->row;
	}

	public function getTotalCategoryById($category_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "lts_vendor_commission WHERE category_id = '" . (int)$category_id . "'");

		return $query->row['total'];
	} 

	public function getCommissions($data=array()) {

		$sql = "SELECT * FROM " . DB_PREFIX . "lts_vendor_commission lvc LEFT JOIN " . DB_PREFIX . "category_description cd ON (lvc.category_id = cd.category_id)";

		if (!empty($data['filter_name'])) {
			$sql .= " AND cd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sql .= " GROUP BY lvc.commission_id";

		$sort_data = array(
			'cd.name'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY cd.name";
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

	public function editCommission($commission_id, $data) {
		$this->db->query("UPDATE ". DB_PREFIX ."lts_vendor_commission SET category_id= '" . (int)$data['category_id'] . "', commission_type = '". $this->db->escape($data['commission_type']) ."', commission='". (int)$data['commission'] ."'  WHERE commission_id='". (int)$commission_id ."'");
	}


	public function deleteCommission($commission_id) {
		$this->db->query("DELETE FROM ". DB_PREFIX ."lts_vendor_commission WHERE commission_id='". (int)$commission_id ."'");
	}

	public function getCategory($category_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "category_description cd1 ON (cp.path_id = cd1.category_id AND cp.category_id != cp.path_id) WHERE cp.category_id = c.category_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.category_id) AS path FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd2 ON (c.category_id = cd2.category_id) WHERE c.category_id = '" . (int)$category_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		return $query->row;
	}


	public function getCategories($data = array()) {

		$sql = "SELECT cp.category_id AS category_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, c1.parent_id, c1.sort_order FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "category c1 ON (cp.category_id = c1.category_id) LEFT JOIN " . DB_PREFIX . "category c2 ON (cp.path_id = c2.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd1 ON (cp.path_id = cd1.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd2 ON (cp.category_id = cd2.category_id) WHERE cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND cd2.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sql .= " GROUP BY cp.category_id";

		$sort_data = array(
			'name',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY sort_order";
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

	public function getTotalCommissions($data = array()) {
		$sql = "SELECT COUNT(DISTINCT lvc.commission_id) AS total FROM " . DB_PREFIX . "lts_vendor_commission lvc LEFT JOIN " . DB_PREFIX . "category_description cd ON (lvc.category_id = cd.category_id)";
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
}