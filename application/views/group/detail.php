
<!-----><div ng-controller="detailController">
          <div class="row">
            <div class="col-sm-12">
              <div class="pull-right m-t-15">
                <a href="{{baseurl}}page/group/manage/{{detail.company_id}}" class="btn btn-primary">Manage</a>
              </div>
              <h4 class="page-title">Detail Group</h4>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <div class="card-box">
                <div class="panel-body">
                  <div class="clearfix">
                    <div class="alert alert-info">
                      <strong ng-bind="'Detail for ' + detail.company_code + ' (' + detail.company_name + ')'"></strong>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 form-control-label">Group Code</label>
                    <div class="col-md-8"><span ng-bind="detail.company_code"/></div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 form-control-label">Group Name</label>
                    <div class="col-md-8"><span ng-bind="detail.company_name"/></div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 form-control-label">Group Contact</label>
                    <div class="col-md-8"><span ng-bind="detail.company_contact | phone"/></div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 form-control-label">Group Email</label>
                    <div class="col-md-8"><span ng-bind="detail.company_email ? detail.company_email: '-'"/></div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 form-control-label">Group Website</label>
                    <div class="col-md-8"><span ng-bind="detail.company_website ? detail.company_website : '-'"/></div>
                  </div>

                  <br/>

                  <div class="form-group row">
                    <label class="col-md-4 form-control-label">Address</label>
                    <div class="col-md-8"><span ng-bind="detail.company_address ? detail.company_address : '-'"/></div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 form-control-label">City</label>
                    <div class="col-md-8"><span ng-bind="detail.company_city ? detail.company_city : '-'"/></div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 form-control-label">State</label>
                    <div class="col-md-8"><span ng-bind="detail.company_state ? detail.company_state : '-'"/></div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 form-control-label">Country</label>
                    <div class="col-md-8"><span ng-bind="detail.company_country ? detail.company_country : '-'"/></div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 form-control-label">Post Code</label>
                    <div class="col-md-8"><span ng-bind="detail.company_postcode ? detail.company_postcode : '-'"/></div>
                  </div>

                  <br/>

                  <div class="form-group row">
                    <label class="col-md-4 form-control-label">PIC</label>
                    <div class="col-md-8"><span ng-bind="detail.company_pic"/></div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 form-control-label">PIC Contact</label>
                    <div class="col-md-8"><span ng-bind="detail.company_piccontact | phone"/></div>
                  </div>

                  <br/>

                  <div class="form-group row">
                    <label class="col-md-4 form-control-label">Discount (in percent)</label>
                    <div class="col-md-8"><span ng-bind="detail.company_discount + '%'"/></div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 form-control-label">Note</label>
                    <div class="col-md-8"><span ng-bind="detail.company_note ? detail.company_note : '-'"/></div>
                  </div>

                </div>
              </div>
            </div>
          </div>
