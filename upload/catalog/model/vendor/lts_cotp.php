<?php

class ModelVendorLtsCotp extends model {

  public function getCustomerByEmailTelephone($email_telephone) {
    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email_telephone)) . "' OR telephone = '" . (int) $email_telephone . "'");

    return $query->row;
  }

}
