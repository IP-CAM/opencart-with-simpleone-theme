<?php
class ModelVendorLtsVendor extends Model {
	public function getVendors($data = array()) {

		//$sql = "SELECT CONCAT(firstname, ' ', lastname) AS name, vendor_id, email, status, telephone FROM ". DB_PREFIX ."lts_vendor WHERE status='". (int)1 ."' ";


		$sql = "SELECT *, CONCAT(c.firstname, ' ', c.lastname) AS name FROM " . DB_PREFIX . "customer c RIGHT JOIN " . DB_PREFIX . "lts_vendor lv ON (c.customer_id = lv.vendor_id)";

		$sql .= " WHERE lv.status = '1'";

		
		if (!empty($data['filter_name'])) {
			$sql .= " AND c.firstname LIKE '" . $this->db->escape($data['filter_name']) . "%'";
			$sql .= " OR c.lastname LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_email'])) {
			$sql .= " AND c.email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
		}

		if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= " AND lv.status = '" . (int)$data['filter_status'] . "'";
		}

		$sql .= " GROUP BY vendor_id";

		$sort_data = array(
			'name',
			'c.email',
			'c.telephone',     
			'lv.status',
			'sort_order'
		); 

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
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

	public function getStoreName($vendor_id) {
		$sql = "SELECT store_name FROM " . DB_PREFIX . "lts_vendor_store WHERE vendor_id = '". (int)$vendor_id ."'";
		
		$query = $this->db->query($sql);

		return $query->row;
	}

	public function vendorRequest() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM ". DB_PREFIX ."lts_vendor WHERE status = '" . (int)0 . "'");

		return $query->row['total'];
	}

	public function vendorRequestLists() {

		$sql = "SELECT * FROM " . DB_PREFIX . "customer c RIGHT JOIN " . DB_PREFIX . "lts_vendor lv ON (c.customer_id = lv.vendor_id)";

		$sql .= " WHERE lv.status = '0'";


		
		$query = $this->db->query($sql);

		return $query->rows;
	}
 
	public function vendorApproveStatus($vendor_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "lts_vendor SET status = '" . 1 . "' WHERE vendor_id = '" . (int)$vendor_id . "'");
	}

	public function getVendorName($vendor_id) {
		$query = $this->db->query("SELECT CONCAT(c.firstname, ' ', c.lastname) AS name FROM " . DB_PREFIX . "customer c RIGHT JOIN  ". DB_PREFIX ."lts_vendor lv ON(c.customer_id = lv.vendor_id) WHERE lv.vendor_id = '" . (int)$vendor_id . "'");

		return $query->row;
	}

	public function getTotalVendors($data = array()) {
		$sql = "SELECT COUNT(vendor_id) AS total FROM " . DB_PREFIX . "lts_vendor";

	
		if (!empty($data['filter_name'])) {
			$sql .= " AND name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_email'])) {
			$sql .= " AND email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
		}

		if (isset($data['filter_telephone']) && !is_null($data['filter_telephone'])) {
			$sql .= " AND telephone LIKE '" . $this->db->escape($data['filter_telephone']) . "%'";
		}

		if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= " AND status = '" . (int)$data['filter_status'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getStoreInformation($vendor_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "lts_vendor_store`  WHERE  vendor_id = '" . (int)$vendor_id . "'");

		return $query->row;
	}



  public function getProducts($vendor_id, $data = array()) {

    $sql = "SELECT * FROM " . DB_PREFIX . "lts_vendor_product lvp LEFT JOIN " . DB_PREFIX . "product_description pd ON (lvp.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product p ON(p.product_id = lvp.product_id)  WHERE  pd.language_id = '" . (int) $this->config->get('config_language_id') . "' AND lvp.vendor_id = '" . (int)$vendor_id . "'";

    $sort_data = array(
        'pd.name',
        'p.model',
        'p.price',
        'p.quantity',
        'p.status',
        'p.sort_order'
    );

    if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
      $sql .= " ORDER BY " . $data['sort'];
    } else {
      $sql .= " ORDER BY pd.name";
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

      $sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
    }

    $query = $this->db->query($sql);

    return $query->rows;
  }

  public function getTotalProducts($vendor_id) {
    $sql = "SELECT COUNT(DISTINCT lvp.product_id) AS total FROM " . DB_PREFIX . "lts_vendor_product lvp LEFT JOIN " . DB_PREFIX . "product p ON (lvp.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (lvp.product_id = pd.product_id) ";


    $sql .= " WHERE pd.language_id = '" . (int) $this->config->get('config_language_id') . "' AND lvp.vendor_id='" . (int) $vendor_id . "'";

    $query = $this->db->query($sql);

    return $query->row['total'];
  }

	public function getOrders($vendor_id, $data = array()) {
		
		$sql = "SELECT o.order_id, CONCAT(o.firstname, ' ', o.lastname) AS customer, (SELECT os.name FROM ". DB_PREFIX ."order_status os WHERE os.order_status_id = o.order_status_id AND os.language_id = '" . $this->config->get('config_language_id') . "') AS order_status, o.shipping_code, o.total, o.currency_code, o.currency_value, o.date_added, o.date_modified FROM `" . DB_PREFIX . "order` o RIGHT JOIN `" . DB_PREFIX . "lts_vendor_order_product` lvop ON (o.order_id = lvop.order_id) WHERE lvop.vendor_id='". (int) $vendor_id ."'";

		$query = $this->db->query($sql);

		return $query->rows;
	}

  	public function getTotalOrders($data = array()) {
		
		$sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "lts_vendor_order_product`";

		if (!empty($data['filter_order_status'])) {
			$implode = array();

			$order_statuses = explode(',', $data['filter_order_status']);

			foreach ($order_statuses as $order_status_id) {
				$implode[] = "order_status_id = '" . (int)$order_status_id . "'";
			}

			if ($implode) {
				$sql .= " WHERE (" . implode(" OR ", $implode) . ")";
			}
		} elseif (isset($data['filter_order_status_id']) && $data['filter_order_status_id'] !== '') {
			$sql .= " WHERE order_status_id = '" . (int)$data['filter_order_status_id'] . "'";
		} else {
			$sql .= " WHERE order_status_id > '0'";
		}

		if (!empty($data['filter_order_id'])) {
			$sql .= " AND order_id = '" . (int)$data['filter_order_id'] . "'";
		}

		if (!empty($data['filter_customer'])) {
			$sql .= " AND CONCAT(firstname, ' ', lastname) LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if (!empty($data['filter_date_modified'])) {
			$sql .= " AND DATE(date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
		}

		if (!empty($data['filter_total'])) {
			$sql .= " AND total = '" . (float)$data['filter_total'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function deleteVendor($vendor_id) {
				
	}



}