<!DOCTYPE html>
<html>
  <head>
    <?php display("slices/style")?>
  </head>
  <body>
    <div class="account-pages"></div>
    <div class="clearfix"></div>

    <div class="wrapper-page">
      <div class="account-bg">
        <div class="card-box m-b-0">

          <div class="text-xs-center m-t-20">
            <a href="index.html" class="logo">
              <i class="zmdi zmdi-group-work icon-c-logo"></i>
              <span>Hotel Admin</span>
            </a>
          </div>

          <div class="m-t-30 m-b-20">
            <div class="col-xs-12 text-xs-center">
              <h6 class="text-muted text-uppercase m-b-0 m-t-0">Sign In</h6>
            </div>
            <form class="reloadform form-horizontal m-t-20" action="<?php echo base_url('api/login') ?>" method="post">

              <div class="form-group ">
                <div class="col-xs-12">
                  <input class="form-control" name="operator_username" type="text" required="" placeholder="Username">
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-12">
                  <input class="form-control" name="operator_password" type="password" required="" placeholder="Password">
                </div>
              </div>

              <div class="form-group text-center m-t-30">
                <div class="col-xs-12">
                  <button class="btn btn-success btn-block waves-effect waves-light" type="submit">Log In</button>
                </div>
              </div>

              <div class="form-group text-center m-t-30">
                <div class="col-xs-12">
                  <a href="<?php echo base_url('page/student-registration') ?>">Student Registration</a>
                </div>
              </div>

            </form>
          </div>

        </div>
      </div>
    </div>

    <?php display("slices/script") ?>
  </body>
</html>
