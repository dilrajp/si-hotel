<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

  if (!function_exists('update')) {
    function update($section, $identifier) {

      switch ($section) {
        case "cancel-reservation":
          $condition = array("reservation_id" => $identifier);
          $_POST = array("reservation_status" => "Cancelled");

          foreach (get_instance()->db->order_by("marker_date", "asc")->get_where("marker", array("reservation_id" => $identifier))->result() as $each) {
            get_instance()->db->update("marker", array("marker_status" => "VC"), array("marker_id" => $each->marker_id));
          }
          break;
        case "category":
          $current_code = get_instance()->db->get_where("category", array("category_code" => $_POST["category_code"]))->row_array();
          $current_name = get_instance()->db->get_where("category", array("category_name" => $_POST["category_name"]))->row_array();

          $code_error = $current_code && $current_code["category_id"] != $_POST["category_id"];
          $name_error = $current_name && $current_name["category_id"] != $_POST["category_id"];

          if ($code_error || $name_error) {
            response("warning", "Category " . ($code_error ? "ID" : "Name") . " already used");

            return false;
          }

          $condition = array(
           "category_id" => $_POST["category_id"],
          );

          $category = array(
           "category_code"     => trim(strtoupper($_POST["category_code"])),
           "category_name"     => trim(ucwords(strtolower($_POST["category_name"]))),
           "category_extrabed" => trim($_POST["category_extrabed"]),
           "category_note"     => trim(ucwords(strtolower($_POST["category_note"]))),
           "category_date"     => timestamp(true),
          );

          $price = array(
           "price_fitweekday"   => trim($_POST["price_fitweekday"]),
           "price_fitweekend"   => trim($_POST["price_fitweekend"]),
           "price_groupweekday" => trim($_POST["price_groupweekday"]),
           "price_groupweekend" => trim($_POST["price_groupweekend"]),
           "price_breakfast"    => trim($_POST["price_breakfast"]),
           "price_datestart"    => date_format(date_create_from_format("d M Y", $_POST["price_date"]), "Y-m-d"),
           "price_date"         => timestamp(true),
           "category_id"        => trim($_POST["category_id"]),
          );

          $category_query = get_instance()->db->update("category", $category, $condition);
          $price_query = true;

          if (!get_instance()->db->get_where("price", $price)->row()) {
            $price["price_id"] = uuid();

            $price_query = get_instance()->db->insert("price", $price);
          }

          return $category_query && $price_query;

          break;
        case "checkin":

//          $temp = array();
//          $i = 0;
//          foreach (get_instance()->db->group_by("room_id")->get_where("marker", array("reservation_id" => $_POST["reservation_id"]))->result() as $each) {
//            $temp[ $each->room_id ] = $_POST["room"][ $i ];
//            $i++;
//          }
//
//          $marker = get_instance()->db->order_by("marker_date", "asc")->get_where("marker", array("reservation_id" => $_POST["reservation_id"]))->result();
//          $i = 0;
//          foreach ($marker as $each) {
//            $status = "Occupied";
//            if ($i == sizeof($marker) - 1) $status = "EDP";
//            get_instance()->db->update("marker", array("room_id" => $temp[ $each->room_id ], "marker_status" => $status), array("marker_id" => $each->marker_id));
//            $i++;
//          }

          $condition = array("reservation_id" => $_POST["reservation_id"]);
          $_POST = array("reservation_status" => "Ongoing");

          break;
        case "checkout":
          get_instance()->db->update("reservation", array("reservation_status" => "Finished"), $_POST);

          $marker = get_instance()->db->order_by("marker_date", "asc")->get_where("marker", $_POST)->result();
          $size = sizeof($marker);
          $i = 0;

          foreach ($marker as $each) {
            $status = $i == $size - 1 ? "VD" : "VC";
            get_instance()->db->update("marker", array("marker_status" => $status), array("marker_id" => $each->marker_id));
            $i++;
          }

          return true;
          break;
        case "group":
          $current_code = get_instance()->db->get_where("company", array("company_code" => $_POST["company_code"]))->row_array();
          $current_name = get_instance()->db->get_where("company", array("company_name" => $_POST["company_name"]))->row_array();

          $code_error = $current_code && $current_code["company_id"] != $_POST["company_id"];
          $name_error = $current_name && $current_name["company_id"] != $_POST["company_id"];

          if ($code_error || $name_error) {
            response("error", "Group " . ($code_error ? "Code" : "Name") . " already used");

            return false;
          }

          $condition = array("company_id" => $_POST["company_id"]);
          unset($_POST["company_id"]);

          break;
        case "house-keeping":
          $condition = array(
           "marker_id" => $identifier,
          );

          $_POST = array(
           "marker_status" => "VC",
          );
          break;
        case "operator":
          $condition = array("operator_username" => $_POST["operator_username"]);
          $data = array(
           "operator_name" => trim(ucwords(strtolower($_POST["operator_name"]))),
//           "operator_role" => trim(ucwords(strtolower($_POST["operator_role"]))),
          );

          if (!empty(trim($_POST["operator_password"]))) $data["operator_password"] = md5($_POST["operator_password"]);
          break;
        case "room" :

          $current = get_instance()->db->get_where("room", $_POST)->row_array();
          $equals = $identifier == $current["room_id"];

          if ($current && !$equals) {
            response("warning", "Room Number already used");

            return false;
          }

          $condition = array("room_id" => $identifier);
           if (!empty($_FILES['room_picture']['name']))
          { // setting konfigurasi upload
                    $config['upload_path'] = './uploads/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    // load library upload
                    get_instance()->load->library('upload', $config);
                    get_instance()->upload->do_upload('room_picture');
          
                    $_POST["room_pict"] = get_instance()->upload->data('file_name');
                    //echo json_encode(   $_POST["room_pict"]);
          }else{
             $_POST["room_pict"] =  $_POST["room_pict"];
            // echo json_encode(   $_POST["room_pict"]);
          }
          break;
        case "travel-agent":
          $name_exist = get_instance()->db->get_where("travel_agent", array("travelagent_name" => $_POST["travelagent_name"]))->row_array();
          $name_error = $name_exist && $name_exist["travelagent_id"] != $_POST["travelagent_id"];

          if ($name_error) {
            response("error", "Travel Agent Name already used");

            return false;
          }

          $condition = array("travelagent_id" => $_POST["travelagent_id"]);
          unset($_POST["travelagent_id"]);

          break;
      }

      $section = str_replace("-", "_", $section);

      if (!in_array($section, array("cancel_reservation", "checkin", "checkout"))) $_POST[ str_replace("_", "", $section) . "_date" ] = timestamp(true);

      if ($section == "cancel_reservation") $section = "reservation";
      if ($section == "checkin") $section = "reservation";
      if ($section == "checkout") $section = "marker";
      if ($section == "group") $section = "company";
      if ($section == "house_keeping") $section = "marker";

      return get_instance()->db->update($section, parse_data(), $condition);
    }
  }
