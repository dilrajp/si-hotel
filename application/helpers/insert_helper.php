<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

  if (!function_exists('insert')) {
    function insert($section) {

      switch ($section) {
        case "category":
          $code_error = get_instance()->db->get_where("category", array("category_code" => $_POST["category_code"]))->row();
          $name_error = get_instance()->db->get_where("category", array("category_name" => $_POST["category_name"]))->row();

          if ($code_error || $name_error) {
            response("error", "Room " . ($code_error ? "Code" : "Name") . " already used");

            return false;
          }

          $category = array(
           "category_id"       => uuid(),
           "category_code"     => trim(strtoupper($_POST["category_code"])),
           "category_name"     => trim(ucwords(strtolower($_POST["category_name"]))),
           "category_extrabed" => trim($_POST["category_extrabed"]),
           "category_note"     => trim(ucwords(strtolower($_POST["category_note"]))),
           "category_date"     => timestamp(true),
          );

          $price = array(
           "price_id"           => uuid(),
           "price_fitweekday"   => trim($_POST["price_fitweekday"]),
           "price_fitweekend"   => trim($_POST["price_fitweekend"]),
           "price_groupweekday" => trim($_POST["price_groupweekday"]),
           "price_groupweekend" => trim($_POST["price_groupweekend"]),
           "price_extrabed"     => trim($_POST["price_extrabed"]),
           "price_datestart"    => date_format(date_create_from_format("d M Y", $_POST["price_date"]), "Y-m-d"),
           "price_date"         => timestamp(true),
           "category_id"        => $category["category_id"],
          );

          return get_instance()->db->insert("category", $category) && get_instance()->db->insert("price", $price);

          break;
        case "currency":
          $_POST["currency_id"] = uuid();
          print_r(parse_data());
          break;
        case "deposit":
          $_POST = array(
           "deposit_id"     => uuid(),
           "deposit_amount" => $_POST["deposit_amount"],
           "deposit_date"   => timestamp(true),
           "reservation_id" => $_POST["reservation_id"],
          );

          if ($_POST["deposit_amount"] == 0) return false;
          break;
        case "group":
          $code_error = get_instance()->db->get_where("company", array("company_code" => $_POST["company_code"]))->row();
          $name_error = get_instance()->db->get_where("company", array("company_name" => $_POST["company_name"]))->row();

          if ($code_error || $name_error) {
            response("error", "Group " . ($code_error ? "Code" : "Name") . " already used");

            return false;
          }

          $_POST["company_id"] = uuid();
          break;
        case "operator":

          if (get_instance()->db->get_where("operator", array("operator_username" => $_POST["operator_username"]))->row()) {
            response("error", "Username already registered");

            return false;
          }

          $_POST["operator_role"] = !get_instance()->db->get("operator")->row() ? "Admin" : $_POST["operator_role"];

          unset($_POST["image_param"]);
          break;
        case "registration":
          $_POST = array(
           "registration_id"     => uuid(),
           "registration_note"   => $_POST["registration_note"],
           "registration_amount" => $_POST["registration_amount"],
           "registration_date"   => date('Y-m-d H:i:s', strtotime($_POST["registration_date"])),
           "reservation_id"      => $_POST["reservation_id"],
          );

          if ($_POST["registration_amount"] == 0) return false;

          break;
        case "reservation":
          $reservation_id = $_POST["reservation_id"];

          if (get_instance()->db->get_where("reservation", array("reservation_id" => $reservation_id))->row()) {
            response("warning", "Reservation already added");

            return false;
          }

          $reservation = array(
           "reservation_date"            => timestamp(true),
           "reservation_datein"          => date_format(date_create_from_format("d M Y", $_POST["reservation_datein"]), "Y-m-d"),
           "reservation_dateout"         => date_format(date_create_from_format("d M Y", $_POST["reservation_dateout"]), "Y-m-d"),
           "reservation_reservername"    => trim(ucwords(strtolower($_POST["reservation_reservername"]))),
           "reservation_reservercontact" => $_POST["reservation_reservercontact"],
           "reservation_by"              => $_POST["reservation_by"],
           "reservation_note"            => trim(ucwords($_POST["reservation_note"])),
           "operator_username"           => session("operator_username"),
          );

          $reservation["reservation_id"] = $reservation_id;

          $guest = array(
           "guest_type"      => $_POST["guest_type"],
           "guest_title"     => $_POST["guest_title"],
           "guest_firstname" => trim(ucwords(strtolower($_POST["guest_firstname"]))),
           "guest_lastname"  => trim(ucwords(strtolower($_POST["guest_lastname"]))),
           "guest_contact"   => $_POST["guest_contact"],
           "guest_email"     => trim(strtolower($_POST["guest_email"])),
           "guest_address"   => trim(ucwords(strtolower($_POST["guest_address"]))),
           "guest_city"      => trim(ucwords(strtolower($_POST["guest_city"]))),
           "guest_region"    => trim(ucwords(strtolower($_POST["guest_region"]))),
           "guest_country"   => trim(ucwords(strtolower($_POST["guest_country"]))),
           "guest_postcode"  => $_POST["guest_postcode"],
           "company_id"      => $_POST["company_id"],
           "reservation_id"  => $reservation_id,
          );
          if ($guest["guest_type"] == "FIT") unset($guest["company_id"]);

          $payment = array(
           "payment_type"           => $_POST["payment_type"],
           "payment_by"             => $_POST["payment_by"],
           "payment_discount"       => $_POST["payment_discount"],
           "payment_name"           => trim(ucwords(strtolower($_POST["payment_name"]))),
           "payment_number"         => $_POST["payment_number"],
           "payment_companyname"    => trim(ucwords(strtolower($_POST["payment_companyname"]))),
           "payment_companycontact" => trim(ucwords(strtolower($_POST["payment_companycontact"]))),
           "payment_coupon"         => trim(strtoupper($_POST["payment_coupon"])),
           "payment_supervisor"     => $_POST["payment_supervisor"],
           "payment_note"           => trim(ucwords(strtolower($_POST["payment_note"]))),
           "travelagent_id"         => $_POST["travelagent_id"],
           "reservation_id"         => $reservation_id,
          );
          if ($_POST["payment_travelagent"] == "No") unset($payment["travelagent_id"]);

          $deposit = array(
           "deposit_amount" => $_POST["deposit_amount"],
           "deposit_date"   => timestamp(true),
           "reservation_id" => $reservation_id,
          );

          $guest["guest_id"] = uuid();
          $payment["payment_id"] = uuid();
          $deposit["deposit_id"] = uuid();

          get_instance()->db->insert("reservation", $reservation);
          get_instance()->db->insert("guest", $guest);
          get_instance()->db->insert("payment", $payment);
          if ($deposit["deposit_amount"] > 0) get_instance()->db->insert("deposit", $deposit);

          $roomrate_index = 0;
          foreach ($_POST["room_id"] as $room_id) {
            $begin = new DateTime($reservation["reservation_datein"]);
            $end = new DateTime($reservation["reservation_dateout"]);

            $interval = $begin->diff($end)->d;
            $index = 0;
            for ($i = $begin; $begin <= $end; $i->modify('+1 day')) {

              $room_status = "EA";
              $room_rate = $_POST["room_rate"][ $roomrate_index ];
              if ($index == $interval) {
                $room_status = "ED";
                $rtoom_rate = 0;
              }

              $marker = array(
               "marker_id"       => uuid(),
               "marker_date"     => $i->format("Y-m-d"),
               "marker_status"   => $room_status,
               "marker_modified" => timestamp(true),
               "marker_period"   => in_array($i->format("D"), array("Fri", "Sat")) ? "Weekend" : "Weekday",
               "marker_roomrate" => $room_rate,
               "room_id"         => $room_id,
               "reservation_id"  => $reservation_id,
              );

              get_instance()->db->insert("marker", $marker);

              $index++;
              $roomrate_index++;
            }
          }

          return true;
          break;
        case "room" :
          if (get_instance()->db->get_where("room", $_POST)->row()) {
            response("warning", "Room Number already used");

            return false;
          }

          $_POST["room_id"] = uuid();

          // setting konfigurasi upload
          $config['upload_path'] = './uploads/';
          $config['allowed_types'] = 'gif|jpg|png';
          // load library upload
          get_instance()->load->library('upload', $config);
          get_instance()->upload->do_upload('room_picture');

          $_POST["room_pict"] = get_instance()->upload->data('file_name');
          //echo json_encode(   $_POST["room_pict"]);

          break;
        case "travel-agent":
          $name_error = get_instance()->db->get_where("travel_agent", array("travelagent_name" => $_POST["travelagent_name"]))->row();

          if ($name_error) {
            response("error", "Travel Agent Name already used");

            return false;
          }

          $_POST["travelagent_id"] = uuid();
          break;
      }

      if($section != 'registration'){
        $_POST[ str_replace("_", "", $section) . "_date" ] = timestamp(true);  
      }

      $section = str_replace("-", "_", $section);
      if ($section == "group") $section = "company";
      
      return get_instance()->db->insert($section, parse_data());
    }
  }
