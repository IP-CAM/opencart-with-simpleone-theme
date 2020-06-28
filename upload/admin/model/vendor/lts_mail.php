<?php
class ModelVendorLtsMail extends Model {
	public function addMail($data) {
		$this->db->query("INSERT INTO ". DB_PREFIX ."lts_vendor_mail SET too_id= '". (int)$data['too_id'] ."', subject='". $this->db->escape($data['subject']) ."', message='". $this->db->escape($data['message']) ."', status='". (int)$data['status'] ."'");

	}

	public function editMail($mail_id, $data) {
		$this->db->query("UPDATE ". DB_PREFIX ."lts_vendor_mail SET too_id= '". (int)$data['too_id'] ."', subject='". $this->db->escape($data['subject']) ."', message='". $this->db->escape($data['message']) ."', status='". (int)$data['status'] ."' WHERE mail_id='". (int)$mail_id ."'");

	}

	public function getMail($mail_id) {
		$query = $this->db->query("SELECT * FROM ". DB_PREFIX ."lts_vendor_mail WHERE mail_id='". (int)$mail_id ."'");

		return $query->row;
	} 

	public function approvalVendor() {
		$query = $this->db->query("SELECT email, CONCAT(firstname, ' ', lastname ) AS name FROM ". DB_PREFIX ."lts_vendor WHERE status='". (int)1 ."'");

		return $query->rows;
	}

	public function nonapprovalVendor() {
		$query = $this->db->query("SELECT email,  CONCAT(firstname, ' ', lastname ) AS name FROM ". DB_PREFIX ."lts_vendor WHERE status='". (int)1 ."'");

		return $query->rows;
	}

	public function allVendor() {
		$query = $this->db->query("SELECT email,  CONCAT(firstname, ' ', lastname ) AS name FROM ". DB_PREFIX ."lts_vendor");

		return $query->rows;
	}

	public function getMails() {
		$query = $this->db->query("SELECT * FROM ". DB_PREFIX ."lts_vendor_mail ORDER BY mail_id DESC");

		return $query->rows;
	}

	public function getToo() {
		$query = $this->db->query("SELECT * FROM ". DB_PREFIX ."lts_vendor_too");

		return $query->rows;
	}


	public function getTooName($too_id) {
		$query = $this->db->query("SELECT name FROM ". DB_PREFIX ."lts_vendor_too WHERE too_id='". (int)$too_id ."' ");

		return $query->row;
	}
}
