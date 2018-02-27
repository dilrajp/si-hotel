<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

  if (!function_exists('active')) {
    function active() {
      return isset($_SESSION["session"]);
    }
  }

  if (!function_exists('crop')) {
    function crop($url, $boundary) {
      $instance =& get_instance();

      $param = explode(",", $boundary);

      $instance->load->library('image_lib', array(
       "image_library"  => 'gd2',
       "source_image"   => $url,
       "maintain_ratio" => false,
       "x_axis"         => (int)$param[0],
       "y_axis"         => (int)$param[1],
       "width"          => ((int)$param[2]) - ((int)$param[0]),
       "height"         => ((int)$param[3]) - ((int)$param[1]),
      ));

      $instance->image_lib->crop();
      $instance->image_lib->clear();

      $instance->image_lib->initialize(array(
       "image_library"  => 'gd2',
       "source_image"   => $url,
       "maintain_ratio" => true,
       "width"          => 320,
      ));

      $instance->image_lib->resize();
    }
  }

  if (!function_exists('data')) {
    function data($page) {
      $data = array(
       "title"   => "Daftar " . title($page),
       "page"    => $page,
       "section" => title($page),
//
       "sidebar" => sidebar($page),
       "script"  => array(),
      );

      return $data;
    }
  }

  if (!function_exists("display")) {
    function display($page, $data = array()) {
      get_instance()->load->view($page, $data);
    }
  }

  if (!function_exists('get_hash')) {
    function get_hash($section) {
      $instance =& get_instance();

      $table = str_replace("-", "_", $section);
      $prefix = str_replace("-", "", $section);

      do {
        $hash = uuid();
      } while ($instance->db->get_where($table, array("{$prefix}_hash" => $hash))->row());

      return $hash;
    }
  }

  if (!function_exists('list_field')) {
    function list_field($section, $only = "") {
      $instance =& get_instance();

      $table = str_replace("-", "_", $section);

      $only = empty($only) ? "" : explode(", ", $only);

      $field = array();
      $field["header"] = array();
      $field["field"] = "";

      $separator = "";
      foreach ($instance->db->list_fields($table) as $each) {
        if (!$only || ($only && in_array($each, $only))) {

          $header = explode("_", $each);
          $header[0] = ucwords($header[0]);
          $header[1] = ucwords($header[1]);

          array_push($field["header"], "{$header[0]} {$header[1]}");
          $field["field"] .= $separator . $each;

          $separator = ", ";

        }
      }

      return $field;
    }
  }

  if (!function_exists("parse_data")) {
    function parse_data() {
      $data = array();

      foreach ($_POST as $key => $value) {

        $suffix = explode("_", $key)[1];

        if (strchr($key, "password")) {
          $parsed_value = md5($value);
        } else if (in_array($suffix, array("id", "username", "email", "photo", "picture", "website"))) {
          $parsed_value = trim(strtolower($value));
        } else if (strchr($key, "number")) {
          $parsed_value = trim(strtoupper($value));
        } else if (strchr($key, "code")) {
          $parsed_value = strtoupper($value);
        } else {
          $parsed_value = trim(ucwords($value));
        };

        $data[ $key ] = $parsed_value;
      }

      return $data;
    }
  }

  if (!function_exists('phone_format')) {
    function phone_format($source) {
      return substr($source, 0, 4) . "-" . substr($source, 4, 4) . "-" . substr($source, 8);
    }
  }

  if (!function_exists('random')) {
    function random($length = 4) {
      $characters = '0123456789ABCDEF';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[ rand(0, $charactersLength - 1) ];
      }

      return $randomString;
    }
  }

  if (!function_exists('response')) {
    function response($status, $message) {
      echo json_encode(array(
       "status"  => $status,
       "message" => $message,
      ));
    }
  }

  if (!function_exists('session')) {
    function session($part = "") {
      if (empty($part)) {
        return $_SESSION["session"];
      } else {
        $temp = (array)$_SESSION["session"];

        return $temp[ $part ];
      }
    }
  }

  if (!function_exists('timestamp')) {
    function timestamp($with_time = false) {
      return date("Y-m-d" . ($with_time ? " H:i:s" : ""));
    }
  }

  if (!function_exists('upload')) {
    function upload($file, $prefix, $crop_param = "") {
      $target_dir = "uploads/";

      if (!is_dir($target_dir)) {
        mkdir($target_dir);
      }

      $imageExtension = pathinfo(basename($file["name"], PATHINFO_EXTENSION));

      $uploaded_filename = uniqid($prefix, true) . "." . $imageExtension["extension"];
      $target_file = $target_dir . $uploaded_filename;

      move_uploaded_file($file["tmp_name"], $target_file);
      crop($target_file, $_POST["image_param"]);
      unset($_POST["image_param"]);

      return $target_file;
    }
  }

    if (!function_exists('uploadd')) {
    function uploadd($file) {
      $CI = get_instance();

      $config['upload_path'] = 'uploads/';
      $config['allowed_types'] = 'gif|jpg|png|jpeg';

      $CI->load->library('upload', $config);
      if (!get_instance()->upload->do_upload($file)){
        // If the upload fails
         return "xxx";
     }else{
        // Pass the full path and post data to the set_newstudent model
         return get_instance()->upload->data('full_path');
    }
     
    }
  }


  if (!function_exists('uuid')) {
    function uuid() {
      $characters = '12345678abcdef';
      $charactersLength = strlen($characters);

      $uuid = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";
      for ($i = 0; $i < strlen($uuid); $i++) {
        if ($uuid[ $i ] == "-") {
          continue;
        }

        $uuid[ $i ] = $characters[ rand(0, $charactersLength - 1) ];
      }

      return $uuid;
    }
  }
