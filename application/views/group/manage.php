
<!-----><div ng-controller="groupController">
          <div class="row">
            <div class="col-sm-12">
              <h4 class="page-title">Manage Group</h4>
            </div>
          </div>

          <form class="reloadform" action="{{formurl}}" method="post" enctype="multipart/form-data">

            <input type="hidden" name="company_id" value="{{detail.company_id}}"/>

            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <div class="card-box">
                  <div class="panel-body">
                    <div class="clearfix">
                      <div class="alert alert-info">
                        <strong>Group Data</strong>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Group Code</label>
                      <div class="col-md-8">
                        <input type="text" name="company_code" value="{{detail.company_code}}" placeholder="Group Code (example: MS for MicroSoft)" class="form-control" required/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Group Name</label>
                      <div class="col-md-8">
                        <input type="text" name="company_name" value="{{detail.company_name}}" placeholder="Group Name" class="form-control" required/>
                      </div>
                    </div>

                    <br/>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Group Contact</label>
                      <div class="col-md-8">
                        <input type="number" name="company_contact" value="{{detail.company_contact}}" placeholder="Group Contact" class="form-control"/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Group Email</label>
                      <div class="col-md-8">
                        <input type="email" name="company_email" value="{{detail.company_email}}" placeholder="Group Email" class="form-control"/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Group Website</label>
                      <div class="col-md-8">
                        <input type="text" name="company_website" value="{{detail.company_website}}" placeholder="Group Website" class="form-control"/>
                      </div>
                    </div>

                    <br/>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Address</label>
                      <div class="col-md-8">
                        <textarea class="form-control" name="company_address" placeholder="Group Address" rows="4">{{detail.company_address}}</textarea>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">City</label>
                      <div class="col-md-8">
                        <input type="text" name="company_city" value="{{detail.company_city}}" placeholder="City" class="form-control"/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">State</label>
                      <div class="col-md-8">
                        <input type="text" name="company_state" value="{{detail.company_state}}" placeholder="State" class="form-control"/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Country</label>
                      <div class="col-md-8">
                        <input type="text" name="company_country" value="{{detail.company_country}}" placeholder="Country" class="form-control"/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Post Code</label>
                      <div class="col-md-8">
                        <input type="text" name="company_postcode" value="{{detail.company_postcode}}" placeholder="Post Code" class="form-control"/>
                      </div>
                    </div>

                    <br/>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">PIC</label>
                      <div class="col-md-8">
                        <input type="text" name="company_pic" value="{{detail.company_pic}}" placeholder="PIC" class="form-control" required/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">PIC Contact</label>
                      <div class="col-md-8">
                        <input type="text" name="company_piccontact" value="{{detail.company_piccontact}}" placeholder="PIC Contact" class="form-control" required/>
                      </div>
                    </div>

                    <br/>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Discount (in percent)</label>
                      <div class="col-md-8">
                        <input type="text" name="company_discount" value="{{detail.company_discount ? detail.company_discount : 0}}" placeholder="Discount" class="form-control" required/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Note</label>
                      <div class="col-md-8">
                        <textarea class="form-control" name="company_note" placeholder="Group note" rows="4">{{detail.company_note}}</textarea>
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
