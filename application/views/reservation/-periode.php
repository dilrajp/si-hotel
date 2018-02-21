<h3>Period</h3>
<section ng-controller="periodController">

  <table class="table table-bordered">
    <tr>
      <td width="160">Date In</td>
      <td>
        <div class="col-md-12">
          <input type="text" id="date-from" name="reservation_datein" class="form-control" required ng-model="period.date_in" ng-change="listRoom()" ng-readonly="true">
        </div>
      </td>
    </tr>
    <tr>
      <td>Date Out</td>
      <td>
        <div class="col-md-12">
          <input type="text" id="date-to" name="reservation_dateout" class="form-control" required ng-model="period.date_out" ng-change="listRoom()" ng-readonly="true">
        </div>
      </td>
    </tr>
    <tr>
      <td>Room Category</td>
      <td>
        <div class="col-md-3 pull-left" ng-repeat="each in period.categories">
          <label class="c-input c-checkbox">
            <input type="checkbox" value="{{each.category_id}}" ng-click="listRoom($event, each.category_id)">
            <span class="c-indicator"></span>
            {{each.category_name}}
          </label>
        </div>
      </td>
    </tr>
    <!-- Info -->
    <tr>
      <td>Length of Stay</td>
      <td><span ng-bind="period.duration+' day(s)'"></span></td>
    </tr>
    <tr>
      <td>Room Info</td>
      <td>
        <table class="table table-condensed table-striped">
          <thead>
            <tr>
              <th rowspan="2" style="text-align: center; vertical-align: middle;">Category</th>
              <th rowspan="2" style="text-align: center; vertical-align: middle;">Date</th>
              <th rowspan="2" style="text-align: center; vertical-align: middle;"># of room available</th>
              <th colspan="2" style="text-align: center">Roomrate</th>
            </tr>
            <tr>
              <th style="text-align: center">FIT</th>
              <th style="text-align: center">Group</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="each in period.room_info" ng-init="$last && baseTotalPrice()">
              <td><span ng-bind="each.category_name"></span></td>
              <td><span ng-bind="each.date" ng-init="period.last_date = each.date"></span></td>
              <td align="right">
                <label class="label label-warning" ng-if="$last">Checkout</label>
                <span ng-bind="each.room_count" ng-if="!$last"></span>
              </td>
              <td align="right">
                <label class="label label-warning" ng-if="$last">Checkout</label>
                <span ng-bind="each.price_fit | rupiah" ng-if="!$last"></span>
              </td>
              <td align="right">
                <label class="label label-warning" ng-if="$last">Checkout</label>
                <span ng-bind="each.price_group | rupiah" ng-if="!$last"></span>
              </td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3"></td>
              <td align="right"><span ng-bind="period.fitTotal | rupiah"></span></td>
              <td align="right"><span ng-bind="period.groupTotal | rupiah"></span></td>
            </tr>
          </tfoot>
        </table>
      </td>
    </tr>
  </table>

</section>
