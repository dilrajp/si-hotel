
<!----><div ng-controller="listController">
          <div class="row">
            <div class="col-sm-12">
              <div class="pull-right m-t-15">
                <a ng-href="{{baseurl + 'page/manage/reservation'}}" class="btn btn-primary">New Reservation</a>
              </div>
              <h4 class="page-title">Reservation</h4>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="card">

                <div class="card-header">
                  <span class="card-title">Reservation Type</span>
                  &nbsp;:
                  <label class="c-input c-radio">
                    <input name="reservation_type" type="radio" value="Waiting" ng-checked="isChecked('waiting')" ng-click="reservationType('waiting')">
                    <span class="c-indicator"></span>
                    Expected
                  </label>

                  <label class="c-input c-radio">
                    <input name="reservation_type" type="radio" value="Ongoing" ng-checked="isChecked('ongoing')" ng-click="reservationType('ongoing')">
                    <span class="c-indicator"></span>
                    In the house
                  </label>

                  <label class="c-input c-radio">
                    <input name="reservation_type" type="radio" value="Finished" ng-checked="isChecked('finished')" ng-click="reservationType('finished')">
                    <span class="c-indicator"></span>
                    Check out
                  </label>

                  <label class="c-input c-radio">
                    <input name="reservation_type" type="radio" value="Cancelled" ng-checked="isChecked('cancelled')" ng-click="reservationType('cancelled')">
                    <span class="c-indicator"></span>
                    Cancelled
                  </label>

                  <label class="c-input c-radio">
                    <input name="reservation_type" type="radio" value="All" ng-checked="isChecked('all')" ng-click="reservationType('all')">
                    <span class="c-indicator"></span>
                    All
                  </label>

                </div>

                <div class="card-box">
                  <table class="table table-bordered table-striped datatable">
                    <thead>
                      <tr>
                        <th width="128">Reservation Code</th>
                        <th>Date In</th>
                        <th>Date Out</th>
                        <th>Guest</th>
                        <th>Balance</th>
                        <th>Status</th>
                        <th>Operator</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr ng-repeat="each in data">
                        <td align="center"><a href="{{baseurl+'page/detail/'+(each.reservation_status === 'Waiting'?'reservation':'registration')+'/'+ each.reservation_id }}"><strong ng-bind="each.reservation_id"></strong></a></td>
                        <td align="center"><span ng-bind="each.reservation_datein"></span></td>
                        <td align="center"><span ng-bind="each.reservation_dateout"></span></td>
                        <td align="center"><span class="text-nowrap" ng-bind="each.guest_name"></span></td>
                        <td align="{{hasBalance(each.deposit, each.billing) ? 'right' : 'center'}}">
                          <label ng-if="(each.deposit - each.billing) > 0" class="label label-primary" ng-bind="(each.deposit - each.billing) | rupiah"></label>
                          <span ng-if="(each.deposit - each.billing) < 0" class="text-nowrap" ng-bind="(each.deposit - each.billing) | rupiah"></span>
                          <label ng-if="!((each.deposit - each.billing) >  0 || (each.deposit - each.billing) < 0)" class="label label-primary" ng-bind="0"></label>

                        </td>
                        <td align="center">
                          <label class="label label-{{labelClass(each.reservation_status)}}" ng-if="(each.reservation_status === 'Waiting')">Expected</label>
                          <label class="label label-{{labelClass(each.reservation_status)}}" ng-if="(each.reservation_status === 'Ongoing')">In the House</label>
                          <label class="label label-{{labelClass(each.reservation_status)}}" ng-if="(each.reservation_status === 'Finished')">Check out</label>
                          <label class="label label-{{labelClass(each.reservation_status)}}" ng-if="(each.reservation_status === 'Cancelled')">Cancelled</label>
                        </td>
                        <td align="center"><span ng-bind="each.operator_username"></span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>
