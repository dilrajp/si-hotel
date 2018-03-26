<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

  if (!function_exists('detail')) {
    function detail($section, $identifier) {

      switch ($section) {
        case "checkin":
          $category_id = get_instance()->db->get_where("reservation", array("reservation_id" => $identifier))->row()->category_id;

          $result = array();
          foreach (get_instance()->db->order_by("room_number", "asc")->get_where("room", array("category_id" => $category_id))->result() as $each) {
            $disabled = get_instance()->db->query("SELECT * FROM `marker` WHERE `room_id` = '{$each->room_id}' AND `reservation_id` <> '{$identifier}'")->row() ? true : false;
            $checked = get_instance()->db->query("SELECT * FROM `marker` WHERE `room_id` = '{$each->room_id}' AND `reservation_id` = '{$identifier}'")->row() ? true : false;

            $temp = array();
            $temp["room_id"] = $each->room_id;
            $temp["room_number"] = $each->room_number;
            $temp["disabled"] = $disabled;
            $temp["checked"] = $checked;

            array_push($result, $temp);
          }
          break;
        case "group":
          $result = get_instance()->db->get_where("company", array("company_id" => $identifier))->row();
          break;
        case "max-room-selection":
          $result = get_instance()->db->group_by("room_id")->get_where("marker", array("reservation_id" => $identifier))->num_rows();
          break;
        case "operator":
          $result = get_instance()->db->get_where("operator", array("operator_username" => $identifier))->row();
          break;
        case "room":
          $detail = " SELECT *, DATE_FORMAT(`price_date`, '%d %M %Y') AS `price_date` FROM `price`
                      JOIN (SELECT `category_id`, MAX(`price_date`) AS `price_date` FROM `price` GROUP BY `category_id`) AS `_price` USING(`category_id`, `price_date`)
                      JOIN `category` USING(`category_id`)
                      WHERE `category_id`=" . get_instance()->db->escape($identifier);

          $result = array(
           "detail" => get_instance()->db->query($detail)->row_array(),
           "data"   => get_instance()->db->query("SELECT *, DATE_FORMAT(`room_date`, '%d %M %Y') AS `room_date` FROM `room` WHERE `category_id`=" . get_instance()->db->escape($identifier) . " ORDER BY `room_number` ASC")->result_array(),
          );
          break;
        case "room-number":
          // $result = get_instance()->db->get_where("room", array("room_id" => $identifier))->row();

          $query = "SELECT `room_id`, `room_number`, `room_floor`, `room_wing`, `room_bedtype`, `room_adult`, `room_children`, `room_description`, `room_date`, `room_pict`, `category_id`, CONCAT(room_floor, IF(SUBSTR(`room_number`,1,3) = 'SUI', SUBSTR(`room_number`, 5, 2),  SUBSTR(`room_number`, 9, 2))) as `nama_kamar`
                      FROM `room` WHERE `room_id` = '".$identifier."'";

          $result = get_instance()->db->query($query)->row();
          break;
        case "total-room-status":
          $category_id = get_instance()->db->escape($_POST["category_id"]);
          $date = get_instance()->db->escape(date_format(date_create_from_format("d M Y", $_POST["date"]), "Y-m-d"));

          if ($identifier == 'VC') {
            $count_1 = get_instance()->db->query("SELECT COUNT(*) AS `count` FROM `room` WHERE `category_id`={$category_id} AND `room_id` NOT IN (SELECT `room_id` FROM `marker`)")->row()->count;
            $count_2 = get_instance()->db->query("SELECT COUNT(*) AS `count` FROM `room` WHERE `category_id`={$category_id} AND `room_id` IN (SELECT `room_id` FROM `marker` WHERE `marker_status`='VC' AND `marker_date`={$date})")->row()->count;
          } else {
            $identifier = get_instance()->db->escape($identifier);
            $count_1 = get_instance()->db->query("SELECT COUNT(*) AS `count` FROM `room` WHERE `category_id`={$category_id} AND `room_id` IN (SELECT `room_id` FROM `marker` WHERE `marker_status`={$identifier} AND `marker_date`={$date})")->row()->count;
            $count_2 = 0;
          }

          $result = array("count" => ($count_1 + $count_2));
          break;
        case "travel-agent":
          $result = get_instance()->db->get_where("travel_agent", array("travelagent_id" => $identifier))->row();
          break;
        //
        case "registration":
          $result = get_instance()->db->select("
            *, IFNULL(`company_discount`, 0) AS `company_discount`, IFNULL(`deposit`, 0) AS `deposit`, (IFNULL(`billing`, 0) + SUM(`marker_roomrate`)) AS `billing`,
            
            DATE_FORMAT(`reservation_datein`, '%d %M %Y') AS `reservation_datein`,
            DATE_FORMAT(`reservation_dateout`, '%d %M %Y') AS `reservation_dateout`,
            DATE_FORMAT(`reservation_date`, '%d %M %Y (%H:%i)') AS `reservation_date`,
            DAYNAME(`reservation_datein`) AS `day_name`,
            CONCAT(`guest_title`, '', `guest_firstname`, ' ', `guest_lastname`) AS `guest_name`,
            IFNULL(`company_name`, 'FIT') AS `group_name`,
            `payment_type`, `payment_name`, payment_number`
          ")->
          join("guest", "reservation_id")->
          join("company", "company_id", "left")->
          join("payment", "reservation_id")->
          join("travel_agent", "travelagent_id", "left")->
          join("marker", "reservation_id")->
          join("(SELECT `reservation_id`, SUM(`deposit_amount`) AS `deposit` FROM `deposit` GROUP BY `reservation_id`) AS `deposit`", "reservation_id", "left")->
          join("(SELECT `reservation_id`, SUM(`registration_amount`) AS `billing` FROM `registration` GROUP BY `reservation_id`) AS `billing`", "reservation_id", "left")->
          get_where("reservation", array("reservation_id" => $identifier))->row();

          $reservation_id = get_instance()->db->escape($result->reservation_id);

          $result->detail = get_instance()->db->query("
            SELECT *, DATE_FORMAT(`marker_date`, '%d %M %Y') AS `formatted_marker_date` FROM `price`
            JOIN (SELECT `category_id`, MAX(`price_date`) AS `price_date` FROM `price` WHERE `price_datestart` <= NOW() GROUP BY `category_id` ORDER BY `price_date` DESC) AS `_price` USING(`category_id`, `price_date`)
            JOIN `category` USING(`category_id`)
            JOIN `room` USING(`category_id`)
            JOIN `marker` USING(`room_id`)
            JOIN `reservation` USING(`reservation_id`)
            WHERE `reservation_id`={$reservation_id}
            ORDER BY `room_number`, `marker_date` ASC
          ")->result();

          $result->deposit_list = get_instance()->db->query("
            (SELECT `deposit_date`      AS `date`, DATE_FORMAT(`deposit_date`, '%d %M %Y (%H:%i)') AS `formatted_date`, `deposit_name` AS `note`, `deposit_amount` AS `amount` FROM `deposit`
            WHERE `reservation_id`={$reservation_id})
            UNION ALL
            (SELECT `registration_date` AS `date`, DATE_FORMAT(`registration_date`, '%d %M %Y (%H:%i)') AS `formatted_date`, `registration_note`  AS `note`, `registration_amount` AS `amount` FROM `registration`
            WHERE `reservation_id`={$reservation_id})
            ORDER BY `date` ASC
          ")->result();

          $jumlah = array();
          $total = 0;
          $deposit = 0;
          $billing = 0;

          foreach ($result->deposit_list as $value) {
            if ($value->note == 'Added Deposit' || substr($value->note,0,11) == 'Correction-' || $value->note == 'Cash' || $value->note == 'CC' )  {
              $total = $total + $value->amount;
              $deposit = $deposit + $value->amount;
            } else {
              $total = $total - $value->amount;
              $billing = $billing + $value->amount;
            }
            $jumlah[] = $total;
          }

          $result->balance = $jumlah;
          $result->totaldeposit = $deposit;
          $result->totalbilling = $billing;
          $result->totalbalance = $deposit - $billing;
          break;
        case "reservation":
          $result = get_instance()->db->select("
            *, IFNULL(`company_discount`, 0) AS `company_discount`, IFNULL(`deposit`, 0) AS `deposit`, (IFNULL(`billing`, 0) + SUM(`marker_roomrate`)) AS `billing`,
            
            DATE_FORMAT(`reservation_datein`, '%d %M %Y') AS `reservation_datein`,
            DATE_FORMAT(`reservation_dateout`, '%d %M %Y') AS `reservation_dateout`,
            DATE_FORMAT(`reservation_date`, '%d %M %Y (%H:%i)') AS `reservation_date`,
            DAYNAME(`reservation_datein`) AS `day_name`,
            CONCAT(`guest_title`, '', `guest_firstname`, ' ', `guest_lastname`) AS `guest_name`,
            IFNULL(`company_name`, 'FIT') AS `group_name`,
            `payment_type`, `payment_name`, payment_number`
          ")->
          join("guest", "reservation_id")->
          join("company", "company_id", "left")->
          join("payment", "reservation_id")->
          join("travel_agent", "travelagent_id", "left")->
          join("marker", "reservation_id")->
          join("(SELECT `reservation_id`, SUM(`deposit_amount`) AS `deposit` FROM `deposit` GROUP BY `reservation_id`) AS `deposit`", "reservation_id", "left")->
          join("(SELECT `reservation_id`, SUM(`registration_amount`) AS `billing` FROM `registration` GROUP BY `reservation_id`) AS `billing`", "reservation_id", "left")->
          get_where("reservation", array("reservation_id" => $identifier))->row();

          $reservation_id = get_instance()->db->escape($result->reservation_id);

          $result->detail = get_instance()->db->query("
          SELECT *, DATE_FORMAT(`marker_date`, '%d %M %Y') AS `formatted_marker_date` FROM `price`
          JOIN (SELECT `category_id`, MAX(`price_date`) AS `price_date` FROM `price` WHERE `price_datestart` <= NOW() GROUP BY `category_id` ORDER BY `price_date` DESC) AS `_price` USING(`category_id`, `price_date`)
          JOIN `category` USING(`category_id`)
          JOIN `room` USING(`category_id`)
          JOIN `marker` USING(`room_id`)
          JOIN `reservation` USING(`reservation_id`)
          WHERE `reservation_id`={$reservation_id}
          ORDER BY `room_number`, `marker_date` ASC
          ")->result();

          $result->deposit_list = get_instance()->db->query("
            (SELECT `deposit_date`      AS `date`, DATE_FORMAT(`deposit_date`, '%d %M %Y (%H:%i)') AS `formatted_date`, `deposit_name` AS `note`, `deposit_amount` AS `amount` FROM `deposit`
            WHERE `reservation_id`={$reservation_id})
            UNION ALL
            (SELECT `registration_date` AS `date`, DATE_FORMAT(`registration_date`, '%d %M %Y (%H:%i)') AS `formatted_date`, `registration_note`  AS `note`, `registration_amount` AS `amount` FROM `registration`
            WHERE `reservation_id`={$reservation_id})
            ORDER BY `date` ASC
          ")->result();

          $jumlah = array();
          $total = 0;
          $deposit = 0;
          $billing = 0;

          foreach ($result->deposit_list as $value) {
            if ($value->note == 'Added Deposit' || substr($value->note,0,11) == 'Correction-' || $value->note == 'Cash' || $value->note == 'CC' )  {
              $total = $total + $value->amount;
              $deposit = $deposit + $value->amount;
            } else {
              $total = $total - $value->amount;
              $billing = $billing + $value->amount;
            }
            $jumlah[] = $total;
          }

          $result->balance = $jumlah;
          $result->totaldeposit = $deposit;
          $result->totalbilling = $billing;
          $result->totalbalance = $deposit - $billing;
          break;
        case "reservation-for-deposit":
          $result = get_instance()->db->query(
           "SELECT COUNT(*) AS `count`, IFNULL(SUM(`deposit_amount`), 0) AS `amount`
            FROM `deposit`
            WHERE `reservation_id` = " . get_instance()->db->escape($identifier)
          )->row();

          break;
        case "reservation-for-registration":
          $result = get_instance()->db->query(
           "SELECT COUNT(*) AS `count`, IFNULL(SUM(`registration_amount`), 0) AS `amount`
            FROM `registration`
            WHERE `reservation_id` = " . get_instance()->db->escape($identifier)
          )->row();

          break;
        case "room-charge":
         $result = get_instance()->db->query(
           "SELECT DISTINCT marker.room_id, room.*, CONCAT(room_floor, iF(SUBSTR(room.room_number,1,3) = 'SUI', SUBSTR(room.room_number, 5, 2),  SUBSTR(room.room_number, 9, 2) )) as nama_kamar FROM `marker`
            join room on (marker.room_id = room.room_id)
            WHERE `reservation_id` = " . get_instance()->db->escape($identifier)
          )->result();
      }

      return $result;
    }
  }
