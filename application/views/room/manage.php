
<!-----><div ng-controller="categoryController">
          <div class="row">
            <div class="col-sm-12">
              <h4 class="page-title">Manage Room</h4>
            </div>
          </div>

          <form class="reloadform" action="{{formurl}}" method="post" enctype="multipart/form-data">

            <input type="hidden" name="category_id" value="{{detail.category_id}}"/>

            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <div class="card-box">
                  <div class="panel-body">
                    <div class="clearfix">
                      <div class="alert alert-info">
                        <strong>Room Data</strong>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Room Code</label>
                      <div class="col-md-8">
                        <input type="text" name="category_code" value="{{detail.category_code}}" placeholder="Room Code (example: DLX for DELUXE)" class="form-control" required/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Room Name</label>
                      <div class="col-md-8">
                        <input type="text" name="category_name" value="{{detail.category_name}}" placeholder="Room Name" class="form-control" required/>
                      </div>
                    </div>

                    <br/>

                    <div class="form-group row" ng-hide="true">
                      <label class="col-md-4 form-control-label">Occupancy</label>
                      <div class="col-md-8">
                        <input type="number" name="category_occupancy" value="{{detail.category_occupancy ? detail.category_occupancy : 0}}" placeholder="Occupancy" class="form-control" required/>
                      </div>
                    </div>

                    <div class="form-group row" ng-hide="true">
                      <label class="col-md-4 form-control-label">Max Occupancy</label>
                      <div class="col-md-8">
                        <input type="number" name="category_maxoccupancy" value="{{detail.category_maxoccupancy ? detail.category_maxoccupancy : 0}}" placeholder="Max Occupancy" class="form-control" required/>
                      </div>
                    </div>

                    <br/>

                    <div class="form-group row" ng-hide="true">
                      <label class="col-md-4 form-control-label">Extra Bed Available</label>
                      <div class="col-md-8">
                        <label class="c-input c-radio">
<!--                          <input name="category_extrabed" type="radio" value="Yes" ng-checked="!isUpdating || detail.category_extrabed == 'Yes'">-->
                          <input name="category_extrabed" type="radio" value="Yes" ng-checked="true">
                          <span class="c-indicator"></span>
                          Yes
                        </label>
                        <label class="c-input c-radio">
                          <input name="category_extrabed" type="radio" value="No"">
                          <span class="c-indicator"></span>
                          No
                        </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Description</label>
                      <div class="col-md-8">
                        <textarea class="form-control" name="category_note" placeholder="Description" rows="4" ng-bind="detail.category_note"></textarea>
                      </div>
                    </div>

                    <br/>

                    <!--Price-->
                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Weekday Roomrate (FIT)</label>
                      <div class="col-md-8">
                        <input type="number" name="price_fitweekday" value="{{detail.price_fitweekday}}" placeholder="Weekday Roomrate (FIT)" min="0" class="form-control text-md-right" required/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Weekend Roomrate (FIT)</label>
                      <div class="col-md-8">
                        <input type="number" name="price_fitweekend" value="{{detail.price_fitweekend}}" placeholder="Weekend Roomrate (FIT)" min="0" class="form-control text-md-right" required/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Weekday Roomrate (Group)</label>
                      <div class="col-md-8">
                        <input type="number" name="price_groupweekday" value="{{detail.price_groupweekday}}" placeholder="Weekday Roomrate (Group)" min="0" class="form-control text-md-right" required/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Weekend Roomrate (Group)</label>
                      <div class="col-md-8">
                        <input type="number" name="price_groupweekend" value="{{detail.price_groupweekend}}" placeholder="Weekend Roomrate (Group)" min="0" class="form-control text-md-right" required/>
                      </div>
                    </div>

                    <br/>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Additional Extrabed Charge</label>
                      <div class="col-md-8">
                        <input type="number" name="price_extrabed" value="{{detail.price_extrabed ? detail.price_extrabed: 0}}" placeholder="Extra Bed" min="0" class="form-control text-md-right" required/>
                      </div>
                    </div>

                    <br/>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Effective Date</label>
                      <div class="col-md-8">
                        <input type="text" id="datepicker" name="price_date" value="{{detail.price_date}}" placeholder="Effective Date" class="form-control datepicker" required/>
                      </div>
                    </div>

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
