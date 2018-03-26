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

    function isWeekend($date) {
    $weekDay = date('w', strtotime($date));
    return ($weekDay == 0 || $weekDay == 6);
    }
    public function hargakamar(){
      $grup = $this->input->post('grup');
      //$id_room = $this->input->post('rum_id');
      //$id_cat = $this->input->post('cat_id');
      //$tanggal = isWeekend($this->input->post('tgl'));
      $weekDay = date('w', strtotime(substr($this->input->post('registration_date'), 0, 10)));


      $result = $this->input->post('data_kamar');
      $result_explode = explode('|', $result);
      // echo "Model: ". $result_explode[0]."<br />";
      //echo "Colour: ". $result_explode[1]."<br />"
      $id_cat = $result_explode[1];
      $id_room = $result_explode[0];

      if($grup == 'FIT'){
        if($weekDay == 0 || $weekDay == 6 ){
        $data['harga'] = $this->db->query("SELECT price_fitweekend as Harga
                                  FROM price
                                  JOIN room on (room.category_id = price.category_id)
                                  WHERE room.category_id = '$id_cat' and room.room_id = '$id_room'  
                                  ORDER BY `price`.`price_date` DESC
                                  LIMIT 1")->row();
       }else{
       $data['harga'] = $this->db->query("SELECT price_fitweekday as Harga
                                  FROM price
                                  JOIN room on (room.category_id = price.category_id)
                                  WHERE room.category_id = '$id_cat' and room.room_id = '$id_room'  
                                  ORDER BY `price`.`price_date` DESC
                                  LIMIT 1")->row();
       }
      }else if($grup == 'Group') {

        if($weekDay == 0 || $weekDay == 6){
      $data['harga'] =  $this->db->query("SELECT price_groupweekend as Harga
                                  FROM price
                                  JOIN room on (room.category_id = price.category_id)
                                  WHERE room.category_id = '$id_cat' and room.room_id = '$id_room'  
                                  ORDER BY `price`.`price_date` DESC
                                  LIMIT 1")->row();
       }else{
       $data['harga'] =  $this->db->query("SELECT price_groupweekday as Harga
                                  FROM price
                                  JOIN room on (room.category_id = price.category_id)
                                  WHERE room.category_id = '$id_cat' and room.room_id = '$id_room'  
                                  ORDER BY `price`.`price_date` DESC
                                  LIMIT 1")->row();
       }
      }
      $data['aa'] = "aa";
      $data['view'] = "Rp.".number_format((int)$data['harga']->Harga,2,".",",");
      echo json_encode($data);
    }

    public function charge_kamar(){
      
      $data = array(
           "registration_id"     => uuid(),
           "registration_note"   => "Room*",
           "registration_amount" => $this->input->post('room_charge'),
           "registration_date"   => date('Y-m-d H:i:s', strtotime($this->input->post('tgl'))),
           "reservation_id"      => $this->input->post('reservation_id'),
          );
      $this->db->insert('registration',$data);
      
      
    }

   public function checkout_bayar(){
      $data = array(
           "deposit_id"     => uuid(),
           "deposit_amount" => abs($this->input->post('deposit_amount')),
           "deposit_date"   => date('Y-m-d H:i:s', strtotime($_POST["tanggal"])),
           "reservation_id" => $this->input->post('reservation_id'),
           "deposit_name"   => $this->input->post('deposit_name')
           );
      $this->db->insert('deposit',$data);

      $selisih = abs($this->input->post('deposit_amount')) - abs($this->input->post('deposit_amount2'));
      if($selisih > 0){
         $data2 = array(
           "registration_id"     => uuid(),
           "registration_note"   => 'Change',
           "registration_amount" => $selisih,
           "registration_date"   => date('Y-m-d H:i:s', strtotime($_POST["tanggal"])),
           "reservation_id"      => $_POST["reservation_id"],
          );
      $this->db->insert('registration',$data2);
      }
       $this->db->where('reservation_id',$_POST['reservation_id']);
       $this->db->update("reservation", array("reservation_status" => "Finished"));

        $marker = $this->db->order_by("marker_date", "asc")->get_where("marker",  array("reservation_id" => $this->input->post('reservation_id')))->result();
        $size = sizeof($marker);
        $i = 0;

        foreach ($marker as $each) {
          $status = $i == $size - 1 ? "VD" : "VC";
          $this->db->update("marker", array("marker_status" => $status), array("marker_id" => $each->marker_id));
          $i++;
        }

      redirect('page/detail/registration/'.$this->input->post('reservation_id'));
   }

   function checkout_dibayar(){

      $data2 = array(
           "registration_id"     => uuid(),
           "registration_note"   => 'Change',
           "registration_amount" => abs($this->input->post('registration_amount')),
           "registration_date"   => date('Y-m-d H:i:s', strtotime($_POST["tanggal"])),
           "reservation_id"      => $_POST["reservation_id"],
          );
      $this->db->insert('registration',$data2);

      $this->db->where('reservation_id',$_POST['reservation_id']);
      $this->db->update("reservation", array("reservation_status" => "Finished"));

        $marker = $this->db->order_by("marker_date", "asc")->get_where("marker",  array("reservation_id" => $this->input->post('reservation_id')))->result();
        $size = sizeof($marker);
        $i = 0;

        foreach ($marker as $each) {
          $status = $i == $size - 1 ? "VD" : "VC";
          $this->db->update("marker", array("marker_status" => $status), array("marker_id" => $each->marker_id));
          $i++;
        }


      redirect('page/detail/registration/'.$this->input->post('reservation_id'));

   }
  }
