<?php
class ModelVendorLtsCategory extends Model {

	public function addAssignedCategory($data) {
		if($data['vendor_category']) {
			$i_category_id = implode(',', $data['vendor_category']);
		}

		foreach($data['vendor_category'] as $category_id) {
			$this->db->query("INSERT INTO ". DB_PREFIX ."lts_vendor_category SET vendor_id='". (int)$data['vendor_id'] ."', category_id='". $category_id ."', assigned='". (int)1 ."'");
		}

		if(!empty($i_category_id)) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "lts_vendor_assigned_category SET vendor_id = '" . (int)$data['vendor_id'] . "', category_id = '" . $i_category_id . "'");
		}
	}

	public function editAssignedCategory($vendor_id, $data) {
		$category = $this->getVendorAssignedCategories($vendor_id);

		$categories = explode(',',$category['category_id']);

		foreach($categories as $category_id) {
			$this->deleteVendorCategory($category['vendor_id'], $category_id);
		}

		foreach($data['vendor_category'] as $category_id) {
			$this->db->query("INSERT INTO ". DB_PREFIX ."lts_vendor_category SET vendor_id='". (int)$data['vendor_id'] ."', category_id='". (int)$category_id ."', assigned='". (int)1 ."'");
		}

		if($data['vendor_category']) {
			$category_id = implode(',', $data['vendor_category']);
		}

		if(!empty($category_id)) {
			$this->db->query("UPDATE ". DB_PREFIX ."lts_vendor_assigned_category SET category_id='". $category_id ."' WHERE vendor_id='". (int)$vendor_id ."'");
		}

	}

	public function  deleteAssignedCategory($vendor_id) {
		$category = $this->getVendorAssignedCategories($vendor_id);

		$categories = explode(',',$category['category_id']);

		foreach($categories as $category_id) {
			$this->deleteVendorCategory($category['vendor_id'], $category_id);
		}

		$this->db->query("DELETE FROM ". DB_PREFIX ."lts_vendor_assigned_category WHERE vendor_id = '". (int)$category['vendor_id'] ."'");
	}

	public function getVendorCategory($category_id) {
		$query = $this->db->query("SELECT category_id FROM ". DB_PREFIX ."lts_vendor_category WHERE category_id='". (int)$category_id ."' AND assigned='". (int)0 ."' ");
		return $query->row;
	}	

	public function getTotalVendorAssignById($vendor_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "lts_vendor_assigned_category WHERE vendor_id = '" . (int)$vendor_id . "'");

		return $query->row;
	}

	public function deleteVendorCategory($vendor_id, $category_id) {
		if(!empty($vendor_id) && !empty($category_id)) {
			$this->db->query("DELETE FROM ". DB_PREFIX ."lts_vendor_category WHERE vendor_id = '". (int)$vendor_id ."' AND category_id ='". (int)$category_id ."' AND assigned='". (int)1 ."'");
		}
	}

	public function getAssignedCategory($vendor_id) {
		$query = $this->db->query("SELECT * FROM ". DB_PREFIX ."lts_vendor_assigned_category WHERE vendor_id ='". (int)$vendor_id ."'");

		return  $query->row;
	}

	public function getTotalVendorAssignedCategory($vendor_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "lts_vendor_assigned_category WHERE vendor_id = '" . (int)$vendor_id . "'");

		return $query->row['total'];
	}

	public function getVendorAssignedCategories($vendor_id) {
		$query = $this->db->query("SELECT vendor_id, category_id FROM ". DB_PREFIX ."lts_vendor_assigned_category WHERE vendor_id='". (int)$vendor_id ."'");

		return $query->row;
	}

	public function getAssignedCategories() {
		$query = $this->db->query("SELECT vendor_id, category_id FROM ". DB_PREFIX ."lts_vendor_assigned_category");

		return $query->rows;
	}

	public function getVendorCategories() {
		//$query = $this->db->query("SELECT * FROM ". DB_PREFIX ."lts_vendor_category lvc  LEFT JOIN ". DB_PREFIX ."category_description cd ON(lvc.category_id = cd.category_id) LEFT JOIN ". DB_PREFIX ."category c ON(lvc.category_id = c.category_id) WHERE cd.language_id='". (int)$this->config->get('config_language_id') ."'");


		// $query = $this->db->query("SELECT * FROM ". DB_PREFIX ."lts_vendor_category lvc  LEFT JOIN ". DB_PREFIX ."category_description cd ON(lvc.category_id = cd.category_id) LEFT JOIN ". DB_PREFIX ."category c ON(lvc.category_id = c.category_id) WHERE cd.language_id='". (int)$this->config->get('config_language_id') ."'");

			$sql = $this->db->query("SELECT * FROM ". DB_PREFIX ."lts_vendor_category lvc  LEFT JOIN ". DB_PREFIX ."category_description cd ON(lvc.category_id = cd.category_id) LEFT JOIN ". DB_PREFIX ."category c ON(lvc.category_id = c.category_id) WHERE cd.language_id='". (int)$this->config->get('config_language_id') ."' AND lvc.assigned='". (int)0 ."'");

		return $sql->rows;

	}


	// public function getVendorCategories() {
		// 	//$query = $this->db->query("SELECT * FROM ". DB_PREFIX ."lts_vendor_category lvc  LEFT JOIN ". DB_PREFIX ."category_description cd ON(lvc.category_id = cd.category_id) LEFT JOIN ". DB_PREFIX ."category c ON(lvc.category_id = c.category_id) WHERE cd.language_id='". (int)$this->config->get('config_language_id') ."'");


		// 	$query = $this->db->query("SELECT * FROM ". DB_PREFIX ."lts_vendor_category lvc  LEFT JOIN ". DB_PREFIX ."category_description cd ON(lvc.category_id = cd.category_id) LEFT JOIN ". DB_PREFIX ."category c ON(lvc.category_id = c.category_id) WHERE cd.language_id='". (int)$this->config->get('config_language_id') ."'");

		// 	return $query->rows;

		// }

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

	//public function getVendorCategories

	public function approveStatus($category_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET status = '" . 1 . "' WHERE category_id = '" . (int)$category_id . "'");
	}

	public function disapproveStatus($category_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET status = '" . 0 . "' WHERE category_id = '" . (int)$category_id . "'");
	}
}