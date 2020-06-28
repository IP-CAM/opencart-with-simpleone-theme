<?php
class ModelVendorLtsCommissionReport extends Model {
	public function getCommissionReport($data = array()) {


		$query = $this->db->query("SELECT * FROM ". DB_PREFIX ."lts_vendor_commission_report");

		// $sql = "SELECT * FROM " . DB_PREFIX . "lts_vendor_commission_report lvcr LEFT JOIN " . DB_PREFIX . "lts_vendor lv ON CONCAT(firstname, ' ', lastname) = lvcr.vendor_id ";


		// print_r($sql);

		// die;


		// $sql .= " GROUP BY lvcr.id";


		// $sort_data = array(
		// 	'v.vname'
		// );

		// if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
		// 	$sql .= " ORDER BY " . $data['sort'];
		// } else {
		// 	$sql .= " ORDER BY cd.name";
		// }

		// if (isset($data['order']) && ($data['order'] == 'DESC')) {
		// 	$sql .= " DESC";
		// } else {
		// 	$sql .= " ASC";
		// }

		// if (isset($data['start']) || isset($data['limit'])) {
		// 	if ($data['start'] < 0) {
		// 		$data['start'] = 0;
		// 	}

		// 	if ($data['limit'] < 1) {
		// 		$data['limit'] = 20;
		// 	}

		// 	$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		// }

		// $query = $this->db->query($sql);
		
		return $query->rows;

		// return $query->rows;
	}


	public function getTotalCommissionsReports($data = array()) {
		// $sql = "SELECT COUNT(DISTINCT lvc.commission_id) AS total FROM " . DB_PREFIX . "lts_vendor_commission lvc LEFT JOIN " . DB_PREFIX . "category_description cd ON (lvc.category_id = cd.category_id)";
		
		// if (!empty($data['filter_name'])) {
		// 	$sql .= " AND name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		// }

		// $query = $this->db->query($sql);

		// return $query->row['total'];
	}

	// public function getVendorName($vendor_id) {
	// 	$query = $this->db->query("SELECT CONCAT(firstname, '  ', lastname) AS name FROM ". DB_PREFIX ."lts_vendor");

	// 	return $query->row;
	// }
}  