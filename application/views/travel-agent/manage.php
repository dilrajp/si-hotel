
<!-----><div ng-controller="travelagentController">
          <div class="row">
            <div class="col-sm-12">
              <h4 class="page-title">Manage Travel Agent</h4>
            </div>
          </div>

          <form class="reloadform" action="{{formurl}}" method="post" enctype="multipart/form-data">

            <input type="hidden" name="travelagent_id" value="{{detail.travelagent_id}}"/>

            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <div class="card-box">
                  <div class="panel-body">
                    <div class="clearfix">
                      <div class="alert alert-info">
                        <strong>Travel Agent Data</strong>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Travel Agent Name</label>
                      <div class="col-md-8">
                        <input type="text" name="travelagent_name" value="{{detail.travelagent_name}}" placeholder="Travel Agent Name" class="form-control" required/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Travel Agent Contact</label>
                      <div class="col-md-8">
                        <input type="number" name="travelagent_contact" value="{{detail.travelagent_contact}}" placeholder="Travel Agent Contact" class="form-control" required/>
                      </div>
                    </div>


                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Travel Agent Website</label>
                      <div class="col-md-8">
                        <input type="text" name="travelagent_website" value="{{detail.travelagent_website}}" placeholder="Travel Agent Website" class="form-control"/>
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
