
<!----><div ng-controller="baseController">
          <div class="card-box">
            <div class="row">
              <div class="col-md-8 col-md-offset-2">

                <h4 class="header-title m-t-0">Reservation Management</h4>
                <p class="text-muted font-13 m-b-30">We will guide you through the whole process</p>

                <form class="reloadform" action="{{formurl}}" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="reservation_id" value="<?php echo date('ymd-His-').random() ?>"/>
                  <?php $this->load->view("reservation/-periode"); ?>
                  <?php $this->load->view("reservation/-reservation"); ?>
                  <?php $this->load->view("reservation/-guest"); ?>
                  <?php $this->load->view("reservation/-payment"); ?>
                  <?php $this->load->view("reservation/-overview"); ?>
                </form>

              </div>
            </div>
          </div>
        </div>
