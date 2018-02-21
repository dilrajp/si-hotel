<!-----><div ng-controller="listController">
          <div class="row">
            <div class="col-md-12">
              <hr/>

              <div class="card">

                <div class="card-box">
                  <table class="table table-bordered table-striped datatable">
                    <thead>
                      <tr>
                        <th width="128">Reservation Code</th>
                        <th>Date In</th>
                        <th>Date Out</th>
                        <th>Guest</th>
                        <th>Deposit</th>
                        <th>Billing</th>
                        <th>Status</th>
                        <th>Operator</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr ng-repeat="each in data">
                        <td align="center"><a href="{{baseurl+'page/detail/registration/'+each.reservation_id}}"><strong ng-bind="each.reservation_id"></strong></a></td>
                        <td align="center"><span ng-bind="each.reservation_datein"></span></td>
                        <td align="center"><span ng-bind="each.reservation_dateout"></span></td>
                        <td align="center"><span class="text-nowrap" ng-bind="each.guest_name"></span></td>
                        <td align="right"><span class="text-nowrap" ng-bind="each.deposit | rupiah"></span></td>
                        <td align="right"><span class="text-nowrap" ng-bind="each.billing | rupiah"></span></td>
                        <td align="center"><label class="label label-{{labelClass(each.reservation_status)}}" ng-bind="each.reservation_status"></label></td>
                        <td align="center"><span ng-bind="each.operator_username"></span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>
