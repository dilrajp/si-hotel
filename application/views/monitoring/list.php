
<!-----><div class="row">
          <div class="col-sm-12">
            <h4 class="page-title">Monitoring Room</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3" ng-repeat="each in data">
            <div class="card">
              <div class="card-header card-primary text-white">
                <h4 class="card-title" ng-bind="each.category_name"/>
              </div>
              <div class="card-block">
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr>
                      <th>Room #</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="room in each.room">
                      <td><strong ng-bind="room.room_number"></strong></td>
                      <td align="center">
                        <label class="label label-{{labelClass(room.marker_status)}}" ng-bind="room.marker_status"></label>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
