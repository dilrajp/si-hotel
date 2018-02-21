<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Page extends CI_Controller {

    public function __construct() {
      parent::__construct();

      date_default_timezone_set("Asia/Jakarta");
    }

    public function index() {
      if (active()) {
        redirect("page/dashboard");
      } else {
        if ($this->db->get("operator")->row()) {
          redirect("page/login");
        } else {
          redirect("page/register");
        }
      }
    }

    public function view($type, $section) {
      if (active()) {
        display("container", array(
         "content" => "{$section}/{$type}",
         "section" => $type == "list" ? $section : "",
         "script"  => array(
          "ext/js/{$section}.js",
          "ext/js/image-cropper.js",
         ),
        ));

        return;
      }

      redirect(base_url("page/login"));
    }
//
//    Login
//
    public function login() {
      if (!active() && $this->db->get("operator")->row()) {
        display("pre-home/login", array("script" => array("ext/js/login.js")));

        return;
      }

      redirect("page");
    }

    public function logout() {
      session_destroy();
      redirect("page");
    }

    public function register() {
      if (!active() && !$this->db->get("operator")->row()) {
        display("pre-home/register", array("script" => array()));

        return;
      }

      redirect("page");
    }

    public function student_registration() {
      if (!active() && $this->db->get("operator")->row()) {
        display("pre-home/student-registration", array("script" => array()));

        return;
      }

//      redirect("page");
    }
  }
