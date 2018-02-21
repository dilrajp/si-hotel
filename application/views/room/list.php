
<!-----><div class="row">
          <div class="col-sm-12">
            <div class="pull-right m-t-15">
              <a href="{{baseurl}}page/manage/room" class="btn btn-primary">New Room</a>
            </div>
            <h4 class="page-title">Room</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-box">
                <table class="table table-bordered table-striped datatable">
                  <thead>
                    <tr>
                      <th rowspan="2" style="text-align:center; vertical-align: middle;">Room Type</th>
                      <th rowspan="2" style="text-align:center; vertical-align: middle;"># of Room(s)</th>
                      <th colspan="2" style="text-align:center; vertical-align: middle;">Roomrate (Weekday)</th>
                      <th colspan="2" style="text-align:center; vertical-align: middle;">Roomrate (Weekend)</th>
                    </tr>
                    <tr>
                      <td style="text-align:center; vertical-align: middle;">FIT</td>
                      <td style="text-align:center; vertical-align: middle;">Group</td>
                      <td style="text-align:center; vertical-align: middle;">FIT</td>
                      <td style="text-align:center; vertical-align: middle;">Group</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="each in data">
                      <!-- Room Name -->
                      <td>
                        <a href="{{baseurl}}page/detail/room/{{each.category_id}}"><strong ng-bind="each.category_name"></strong></a>
                      </td>

                      <!-- Roomcount -->
                      <td align="right">
                        <span ng-bind="each.room_count"></span>
                      </td>

                      <!-- Weekday -->
                      <td align="right"><label class="label label-success"><span ng-bind="each.price_fitweekday | rupiah"></span></label></td>
                      <td align="right"><label class="label label-info"><span ng-bind="each.price_groupweekday | rupiah"></span></label></td>

                      <!-- Weekend -->
                      <td align="right"><label class="label label-success"><span ng-bind="each.price_fitweekend | rupiah"></span></label></td>
                      <td align="right"><label class="label label-info"><span ng-bind="each.price_groupweekend | rupiah"></span></label></td>

                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
