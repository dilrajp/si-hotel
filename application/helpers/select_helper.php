<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

  if (!function_exists('select')) {
    function select($section) {

      switch ($section) {
        case "category":
          $result = get_instance()->db->order_by("category_name", "asc")->get("category")->result();
          break;
        case "company":
          $result = get_instance()->db->order_by("company_name", "asc")->get("company")->result();
          break;
        case "dashboard":
          $result = array();

          if ($_POST["type"] != "all") get_instance()->db->where("category_id", $_POST["type"]);

          $query = "SELECT `reservation_id`, `guest_firstname`,  `marker_status`, `marker_modified` FROM `marker` JOIN `reservation` USING(`reservation_id`) JOIN `guest` USING(`reservation_id`)";
          foreach (get_instance()->db->select("`room_id`,`room_floor`, CONCAT(room_floor, IF(SUBSTR(room_number,1,3) = 'SUI', SUBSTR(room_number, 5, 2),  SUBSTR(room_number, 9, 2) )) as nama_kamar, `room_number`")->order_by("nama_kamar", "asc")->get("room")->result() as $each) {
            $date = new DateTime(date_format(date_create_from_format("d M Y", $_POST["date"]), "Y-m-d"));

            $condition = " WHERE `room_id`='{$each->room_id}' AND `marker_status` <> 'VC'";
            if (session("operator_role") == "Student") $condition .= "AND `operator_username`=" . get_instance()->db->escape(session("operator_username"));

            $temp = array(
             "room_number" => $each->room_number,
             "room_floor" => $each->room_floor,
             "nama_kamar" => $each->nama_kamar,             
             "room_id" => $each->room_id,             
             "day_1"       => get_instance()->db->query($query . $condition . " AND `marker_date`='{$date->modify('+0 day')->format('Y-m-d')}' ORDER BY `marker_modified` DESC")->result(),
             "day_2"       => get_instance()->db->query($query . $condition . " AND `marker_date`='{$date->modify('+1 day')->format('Y-m-d')}' ORDER BY `marker_modified` DESC")->result(),
             "day_3"       => get_instance()->db->query($query . $condition . " AND `marker_date`='{$date->modify('+1 day')->format('Y-m-d')}' ORDER BY `marker_modified` DESC")->result(),
             "day_4"       => get_instance()->db->query($query . $condition . " AND `marker_date`='{$date->modify('+1 day')->format('Y-m-d')}' ORDER BY `marker_modified` DESC")->result(),
             "day_5"       => get_instance()->db->query($query . $condition . " AND `marker_date`='{$date->modify('+1 day')->format('Y-m-d')}' ORDER BY `marker_modified` DESC")->result(),
             "day_6"       => get_instance()->db->query($query . $condition . " AND `marker_date`='{$date->modify('+1 day')->format('Y-m-d')}' ORDER BY `marker_modified` DESC")->result(),
             "day_7"       => get_instance()->db->query($query . $condition . " AND `marker_date`='{$date->modify('+1 day')->format('Y-m-d')}' ORDER BY `marker_modified` DESC")->result(),
            );

            for ($i = 1; $i <= 7; $i++) {
              if ($temp["day_{$i}"]) {

                $data = array();
                for ($j = 0; $j < sizeof($temp["day_{$i}"]); $j++) {
//                  if ($temp["day_{$i}"][ $j ]->marker_status != 'VC') {
                  $temp["reservation_id"] = $temp["day_{$i}"][ $j ]->reservation_id;
                  array_push($data, $_POST["planType"] == "guest" ? $temp["day_{$i}"][ $j ]->guest_firstname : $temp["day_{$i}"][ $j ]->marker_status);
//                  }
                }
                $temp["day_{$i}"] = $data;

              } else {
                $temp["day_$i"] = array("VC");

              }
            }

            array_push($result, $temp);
          }

          break;
        case "group":
          $result = get_instance()->db->select("company_id, company_code, company_name, company_contact, company_address, company_pic, company_piccontact, company_discount")->order_by("company_name")->get("company")->result();
          break;
        case "guest":
          $query = "
            SELECT  *,
                    DATE_FORMAT(`reservation_date`, '%d %M %Y') AS `reservation_date`,
                    CONCAT(`guest_lastname`, '/',  `guest_firstname`, ', ', `guest_title`) AS `guest_name`,
                    CONCAT(`guest_city`, ', ', `guest_region`, ', ', `guest_country`) AS `guest_from`,
                    IFNULL(`company_name`, 'FIT') AS `group_name`
            FROM `guest`
            LEFT JOIN `company` USING(`company_id`)
            JOIN `reservation` USING(`reservation_id`)
            GROUP BY `guest_contact`, `guest_email`
            ORDER BY `guest_name` ASC
          ";
          $result = get_instance()->db->query($query)->result();
          break;
        case "house-keeping":
          $result = get_instance()->db->select("`marker_id`, `room_number`, `marker_status`, DATE_FORMAT(`reservation_dateout`, '%d %M %Y') AS `reservation_dateout`, CONCAT(`guest_title`, `guest_firstname`, ' ', `guest_lastname`) AS `guest_name`")->join("marker", "room_id")->join("reservation", "reservation_id")->join("guest", "reservation_id")->order_by("room_number", "asc")->get_where("room", array("marker_status" => "VD"))->result();
          break;
        case "monitoring":
          $result = array();
          foreach (get_instance()->db->order_by("category_name", "asc")->get("category")->result() as $each) {
            $temp = $each;
            $temp->room = array();

            foreach (get_instance()->db->order_by("room_number", "asc")->get_where("room", array("category_id" => $each->category_id))->result() as $room) {
              $temp_room = $room;

              get_instance()->db->where("marker_date", "NOW()", false);
              $temp_room->marker_status = get_instance()->db->get_where("marker", array("room_id" => $room->room_id))->row();
              $temp_room->marker_status = $temp_room->marker_status ? $temp_room->marker_status->marker_status : "VC";

              array_push($temp->room, $temp_room);
            }

            array_push($result, $temp);
          }
          break;
        case "operator":
          $result = get_instance()->db->select("*, DATE_FORMAT(`operator_lastactive`, '%d %M %Y (%H:%i)') AS `operator_lastactive`")->where("`operator_username` <>", "'admin'", false)->order_by("operator_username", "asc")->get("operator")->result();
          break;
        case "reservation":

          $condition = "";
          if ($_POST["type"] != "all") $condition = "WHERE `reservation_status`=" . get_instance()->db->escape(ucwords(isset($_POST["type"]) ? $_POST["type"] : "Waiting"));
          if (session("operator_role") == "Student") $condition .= " AND `operator_username`=" . get_instance()->db->escape(session("operator_username"));

          $query = "SELECT  `reservation_id`,
                            `reservation_status`,
                            DATE_FORMAT(`reservation_datein`, '%d %M %Y') AS `reservation_datein`,
                            DATE_FORMAT(`reservation_dateout`, '%d %M %Y') AS `reservation_dateout`,
                            CONCAT(`guest_lastname`, '/',  `guest_firstname`, ', ', `guest_title`) AS `guest_name`,
                            IFNULL(`deposit`, 0) AS `deposit`,
                            IFNULL(`billing`, 0) AS `billing`,
                            `operator_username`
                    FROM `reservation`
                    JOIN  `guest` USING(`reservation_id`)
                    JOIN  `marker` USING(`reservation_id`)
                    LEFT JOIN (SELECT `reservation_id`, SUM(`deposit_amount`) AS `deposit` FROM `deposit` GROUP BY `reservation_id`) AS `deposit` USING(`reservation_id`)
                    LEFT JOIN (SELECT `reservation_id`, SUM(`registration_amount`) AS `billing` FROM `registration` GROUP BY `reservation_id`) AS `registration` USING(`reservation_id`)
                    {$condition}
                    GROUP BY `reservation_id`
                    ORDER BY `reservation_id` DESC";

          $result = get_instance()->db->query($query)->result();

          $listdeposit = array();
          $listbillling = array();
          foreach ($result as $value) {
            if($value->reservation_status == 'Waiting'){
              $listdeposit[] = $value->deposit;
            }
          }
          break;
        case "room";
          $query = "SELECT  `category_id`, `category_name`, IFNULL(`room_count`, 0) AS `room_count`, `price_fitweekday`, `price_groupweekday`, `price_fitweekend`, `price_groupweekend`, `category_extrabed`
                    FROM `price`
					               RIGHT JOIN `category` USING(`category_id`)
                    JOIN (SELECT `category_id`, MAX(`price_date`) AS `price_date` FROM `price` WHERE `price_date` <= NOW() GROUP BY `category_id`) `_price` USING(`category_id`, `price_date`)
                    LEFT JOIN (SELECT `category_id`, COUNT(*) AS `room_count` FROM `room` GROUP BY `category_id`) AS `_room` USING(`category_id`)
                    GROUP BY `category_id`
                    ORDER BY `category_name` ASC";
          $result = get_instance()->db->query($query)->result();
          break;
        case "travel-agent":
          $result = get_instance()->db->order_by("travelagent_name")->get("travel_agent")->result();
          break;

//      Reservation Manage
        case "period-categories":
          $result = get_instance()->db->join("room", "category_id")->group_by("category_id")->order_by("category_name", "asc")->get("category")->result();
          break;
        case "period-roominfo":

          $date_in = date_format(date_create_from_format("d M Y", $_POST["datein"]), "Y-m-d");
          $date_out = date_format(date_create_from_format("d M Y", $_POST["dateout"]), "Y-m-d");

          $categories = array();
          foreach (get_instance()->db->select("`category_id`, `category_name`")->where_in("category_id", $_POST["categories"])->order_by("category_name", "asc")->get("category")->result() as $each) {
            array_push($categories, $each->category_id);
          }

          $result = array();
          foreach ($categories as $each) {
            $begin = new DateTime($date_in);
            $end = new DateTime($date_out);

            for ($i = $begin; $begin <= $end; $i->modify('+1 day')) {
              $periode = in_array(date_format($i, "D"), array('Fri', 'Sat')) ? "weekend" : "weekday";

              $date = date_format($i, "d M Y") . " (" . date_format($i, "D") . ")";

              $query = "SELECT `category_name`, '{$date}' AS `date`, '{$periode}' AS 'periode', `price_fit{$periode}` AS `price_fit`, `price_group{$periode}` AS `price_group`, `price_extrabed`, IFNULL(`room_count`, 0) AS `room_count`
                        FROM `price`
                        JOIN (SELECT `category_id`, MAX(`price_date`) AS `price_date` FROM `price` WHERE `price_datestart` <= NOW() GROUP BY `category_id`) AS `_price` USING(`category_id`, `price_date`)
                        JOIN `category` USING(`category_id`)
                        LEFT JOIN (SELECT `category_id`, COUNT(*) AS `room_count` FROM `room` WHERE `room_id` NOT IN (SELECT `room_id` FROM `marker` WHERE `marker_date` >= '{$date_in}' AND `marker_date` <= '{$date_out}' AND (`marker_status` = 'EA' OR `marker_status`='OD')) GROUP BY `category_id`) AS `_room` USING(`category_id`)
                        WHERE `category_id`='{$each}'";

              array_push($result, get_instance()->db->query($query)->row());
            }
          }

          break;

        case "reservation-roomlist":
          $date_in = get_instance()->db->escape(date_format(date_create_from_format("d M Y", $_POST["datein"]), "Y-m-d"));
          $date_out = get_instance()->db->escape(date_format(date_create_from_format("d M Y", $_POST["dateout"]), "Y-m-d"));

          $categories = array();
          foreach (get_instance()->db->select("`category_id`, `category_name`")->where_in("category_id", $_POST["categories"])->order_by("category_name", "asc")->get("category")->result() as $each) {
            array_push($categories, $each->category_id);
          }

          $result = array();
          foreach ($categories as $each) {
            $query = "SELECT `category_name`, `room_id`, `room_number`, CONCAT(room_floor, IF(SUBSTR(`room_number`,1,3) = 'SUI', SUBSTR(`room_number`, 5, 2),  SUBSTR(`room_number`, 9, 2))) as `nama_kamar`
                      FROM `room`
                      JOIN `category` USING(`category_id`)
                      WHERE `room_id` NOT IN (SELECT `room_id` FROM `marker` WHERE (`marker_date` >= {$date_in} AND `marker_date` <= {$date_out}) AND (`marker_status`='OD' OR `marker_status`='EA') GROUP BY `room_id`)
                      AND `category_id`='{$each}'
                      GROUP BY `room_number`
                      ORDER BY `room_number` ASC";

            array_push($result, get_instance()->db->query($query)->result());
          }

          break;

        case "payment-roomlist":
          $result = array();
          $room = array();

          if (isset($_POST["room_number"])) {
            foreach (get_instance()->db->select("`room_id`, `room_number`")->where_in("room_number", $_POST["room_number"])->order_by("room_number", "asc")->get("room")->result() as $each) {
              array_push($room, $each);
            }

            $date_in = date_format(date_create_from_format("d M Y", $_POST["datein"]), "Y-m-d");
            $date_out = date_format(date_create_from_format("d M Y", $_POST["dateout"]), "Y-m-d");
            $guest_type = $_POST["guest_type"];

            foreach ($room as $each) {
              $begin = new DateTime($date_in);
              $end = new DateTime($date_out);

              for ($i = $begin; $begin <= $end; $i->modify('+1 day')) {
                $periode = in_array(date_format($i, "D"), array('Fri', 'Sat')) ? "weekend" : "weekday";
                $date = date_format($i, "d M Y") . " (" . date_format($i, "D") . ")";

                $query = "SELECT `category_name`, '{$each->room_number}' AS `room_number`, '{$date}' AS `date`, '{$periode}' AS 'periode', `price_{$guest_type}{$periode}` AS `room_rate`
                        FROM `price`
                        JOIN (SELECT `category_id`, MAX(`price_date`) AS `price_date` FROM `price` WHERE `price_datestart` <= NOW() GROUP BY `category_id`) AS `_price` USING(`category_id`, `price_date`)
                        JOIN `category` USING(`category_id`)
                        JOIN `room`     USING(`category_id`)
                        WHERE `room_id`='{$each->room_id}'";

                array_push($result, get_instance()->db->query($query)->row());
              }
            }
          }

          break;
      }

      return $result;
    }
  }
