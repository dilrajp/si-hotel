
<!-><header id="topnav">
      <div class="topbar-main">
        <div class="container">

          <div class="topbar-left">
            <a href="<?php echo base_url() ?>" class="logo">
              <i class="zmdi zmdi-group-work icon-c-logo"></i>
              <span>Hotel Admin</span>
            </a>
          </div>

          <div class="menu-extras">

            <ul class="nav navbar-nav pull-right">
              <li class="nav-item">
                <a class="navbar-toggle">
                  <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                  </div>
                </a>
              </li>
              <li class="nav-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                  <img src="<?php echo base_url("ext/img/admin.jpg") ?>" alt="user" class="img-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-arrow profile-dropdown " aria-labelledby="Preview">
                  <div class="dropdown-item noti-title">
                    <h5 class="text-overflow">
                      <small>Welcome ! <?php echo session("operator_name"); ?></small>
                    </h5>
                  </div>
                  <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="zmdi zmdi-account-circle"></i> <span>Profile</span>
                  </a>
                  <a href="<?php echo base_url('page/logout') ?>" class="dropdown-item notify-item">
                    <i class="zmdi zmdi-power"></i> <span>Logout</span>
                  </a>
                </div>
              </li>
            </ul>

          </div>
          <div class="clearfix"></div>

        </div>
      </div>

      <div class="navbar-custom">
        <div class="container">
          <div id="navigation">
            <ul class="navigation-menu">
              <li><a href="<?php echo base_url("page/dashboard") ?>"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span> </a></li>
<?php if (in_array(session("operator_role"), array("Admin", "Operator", "Student"))): ?>
              <li class="has-submenu">
                <a href="#"><i class="zmdi zmdi-collection-text"></i><span> Reservation </span> </a>
                <ul class="submenu">
                  <li><a href="<?php echo base_url('page/reservation/waiting') ?>">Reservation</a></li>
                  <li><a href="<?php echo base_url('page/registration') ?>">Registration</a></li>
                  <li><a href="<?php echo base_url('page/guest') ?>">Guest List</a></li>
<?php if(session("operator_role") != 'Student'): ?>
  <li><a href="<?php echo base_url('api/clear_reservation') ?>" onclick="return confirm('Are you sure want to delete all reservation?');"><label class="label label-danger" style="cursor: pointer;">Kosongkan Reservasi</label></a></li>
<?php endif;?>
                </ul>
              </li>
<?php endif; ?>
<?php if (in_array(session("operator_role"), array("Admin", "Operator"))): ?>
              <li class="has-submenu">
                <a href="#"><i class="fa fa-gears"></i><span> Manage </span> </a>
                <ul class="submenu">
                  <li><a href="<?php echo base_url('page/room') ?>">Room</a></li>
                  <li><a href="<?php echo base_url('page/group') ?>">Group</a></li>
                  <li><a href="<?php echo base_url('page/travel-agent') ?>">Travel Agent</a></li>
                  <li><a href="<?php echo base_url('page/operator') ?>">Operator</a></li>
                </ul>
              </li>
<?php endif; ?>
<?php if (in_array(session("operator_role"), array("Admin", "House Keeping", "Operator"))): ?>
              <li><a href="<?php echo base_url("page/house-keeping") ?>"><i class="fa fa-paint-brush"></i> <span> Housekeeping </span> </a></li>
<?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </header>
