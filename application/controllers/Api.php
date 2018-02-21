<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Api extends CI_Controller {
    //tes github
    public function __construct() {
      parent::__construct();

      date_default_timezone_set("Asia/Jakarta");
    }

    public function detail($section, $identifier) {
      echo json_encode(detail($section, $identifier));
    }

    public function get($section) {
      echo json_encode(select($section));
    }

    public function insert($section) {
      if (active() && insert($section)) response("success", "Operation succeeded");
    }

    public function insert_currency() {
      if (!$this->db->get_where("currency", array("currency_date" => $_POST["currency_date"]))->row() && insert("currency")) response("success", "Operation succeeded");
    }

    public function update($section, $identifier = "") {
//      update($section, $identifier);
      if (active() && update($section, $identifier)) {
        response("success", "Operation succeeded");
        if ($section == "cancel-reservation") redirect("page/reservation");
        if ($section == "house-keeping") redirect("page/house-keeping");
      }
    }

//
    public function login() {
      $data = parse_data();
      $result = $this->db->get_where("operator", $data)->row_array();
      if ($result) {
        $_SESSION["session"] = $result;
        $this->db->update("operator", array("operator_lastactive" => timestamp(true)), array("operator_username" => $data["operator_username"]));

        response("success", "Login succedded");

        return;
      }

      response("error", "Wrong username or password");
    }

    public function register() {

      if (!active() && insert("operator")) {
        response("success", "Registration completed");

        return;
      }

      response("error", "Error occured, please try again later");
    }

//
    public function clear_reservation() {
      $this->db->where("`reservation_id` <>", "''", false)->delete("reservation");
      redirect(base_url());
    }
  }
