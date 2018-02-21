
<!-----><div class="row">
          <div class="col-sm-12">
            <h4 class="page-title">Housekeeping</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-box">
                <table class="table table-bordered table-striped datatable">
                  <thead>
                    <tr>
                      <th>Room Number</th>
                      <th>Checkout Date</th>
                      <th>Guest Name</th>
                      <th>Status</th>
                      <th width="160"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="each in data">
                      <td><span ng-bind="each.room_number"></span></td>
                      <td><span ng-bind="each.reservation_dateout"></span></td>
                      <td><span ng-bind="each.guest_name"></span></td>
                      <td align="center">
                        <label class="label label-{{labelClass(each.marker_status)}}" ng-bind="each.marker_status"></label>
                      </td>
                      <td align="center">
<!--                        <a href="{{baseurl + 'api/update/out-of-order/' + each.marker_id}}" class="btn btn-sm btn-primary" onclick="return confirm('Done cleaning?');">Finished</a>-->
                        <a href="{{baseurl + 'api/update/house-keeping/' + each.marker_id}}" class="btn btn-sm btn-primary" onclick="return confirm('Done cleaning?');">Finished</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
