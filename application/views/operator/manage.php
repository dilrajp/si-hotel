
<!-----><div ng-controller="operatorController">
          <div class="row">
            <div class="col-sm-12">
              <h4 class="page-title">Manage Operator</h4>
            </div>
          </div>

          <form class="reloadform" action="{{formurl}}" method="post" enctype="multipart/form-data">

            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <div class="card-box">
                  <div class="panel-body">
                    <div class="clearfix">
                      <div class="alert alert-info">
                        <strong>Operator Data</strong>
                      </div>
                    </div>

<!--                    <div class="form-group ">-->
<!--                      <div class="col-xs-12 text-xs-center">-->
<!--                        <img id="image-preview" src="--><?php //echo base_url('ext/img/profile-placeholder.png') ?><!--" width="100%"/>-->
<!--                        <input id="image-picker" class="form-control" name="operator_photo" type="file" required="" placeholder="Photo">-->
<!--                        <input id="image-param" name="image_param" type="hidden">-->
<!--                      </div>-->
<!--                    </div>-->

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Operator Username</label>
                      <div class="col-md-8">
                        <input type="text" name="operator_username" value="{{detail.operator_username}}" placeholder="Operator Username" class="form-control" required ng-readonly="isUpdating"/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Operator Password</label>
                      <div class="col-md-8">
                        <input type="password" name="operator_password" value="" placeholder="Operator Password" class="form-control"/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Operator Name</label>
                      <div class="col-md-8">
                        <input type="text" name="operator_name" value="{{detail.operator_name}}" placeholder="Operator Name" class="form-control" required/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Role</label>
                      <div class="col-md-8">
                        <select class="form-control" name="operator_role" id="operator_role">
                            <option value="Student">Student</option>
                            <option value="Admin">Admin</option>
                            <option value="House Keeping">House Keeping</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group" style="display:none;">
                      <div class="col-xs-12">
                        <input class="form-control" name="operator_contact" type="text" placeholder="Contact" value="">
                      </div>
                    </div>

                    <br/>

                    <div class="form-group row">
                      <div class="col-md-8 col-md-offset-4">
                        <input type="submit" value="Save" class="btn btn-primary"/>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
