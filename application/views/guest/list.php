
<!-----><div class="row">
          <div class="col-sm-12">
            <div class="pull-right m-t-15">
              <a href="{{baseurl}}page/manage/group" class="btn btn-primary">New Group</a>
            </div>
            <h4 class="page-title">Group</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-box">
                <table class="table table-bordered table-striped datatable">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Reservation</th>
                      <th>Guest Name</th>
                      <th>Contact</th>
                      <th>Email</th>
                      <th>Address</th>
                      <th>From</th>
                      <th>Group</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="each in data">
                      <td><span ng-bind="each.reservation_date"></span></td>
                      <td><a href="<?php echo base_url("page/detail/reservation/") ?>{{each.reservation_idreservation}}" ng-bind="each.reservation_id"></a></td>
                      <td><span ng-bind="each.guest_name"></span></td>
                      <td><span ng-bind="each.guest_contact | phone"></span></td>
                      <td><span ng-bind="each.guest_email"></span></td>
                      <td><span ng-bind="each.guest_address"></span></td>
                      <td><span ng-bind="each.guest_from"></span></td>
                      <td><span ng-bind="each.group_name"></span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
