<!---->
<div class="row">
  <div class="col-sm-12">
    <h4 class="page-title">Dashboard</h4>
  </div>
</div>
<div class="row" ng-controller="dashboardController">

  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <span class="card-title">Room Type</span>
        &nbsp; : &nbsp;

        <select style="border:1px dashed gray; border-radius:4px; padding:4px;" ng-model="category_id" ng-change="dashboardType();">
          <option ng-repeat="each in categories" value="{{each.category_id}}" ng-bind="each.category_name"></option>
        </select>

        &nbsp; &nbsp;

        <span class="card-title">Plan Type</span>
        &nbsp;:
        <label class="c-input c-radio">
          <input type="radio" value="guest" ng-model="planType" ng-checked="true" ng-change="dashboardType();">
          <span class="c-indicator"></span>
          Guest
        </label>

        <label class="c-input c-radio">
          <input type="radio" value="status" ng-model="planType" ng-change="dashboardType();">
          <span class="c-indicator"></span>
          Status
        </label>

        <div class="pull-right">
          From date: <input id="date-filter" type="text" ng-model="dateFilter" ng-change="toggleDate();" style="border:1px dashed silver; border-radius:8px; padding-left:8px;"/>
        </div>
      </div>

      <div class="card-block">
        <table class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th align="center">Room #</th>
              <th align="center" ng-repeat="each in header"><span ng-bind="each"></span></th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="each in data">
              <td><a href="" ng-click="detailRoom(each.room_id);" onclick="return false;" ><strong ng-bind="each.nama_kamar"></strong></a></td>
              <td align="center">
                <div ng-repeat="data in each.day_1" ng-if="(planType === 'status' || (planType === 'guest' && data !== 'VC'))"><a href="{{baseurl+'page/detail/reservation/'+each.reservation_id}}"><label class="label label-{{planType === 'guest' ? 'success': labelClass(data)}}" ng-bind="data" style="cursor:pointer;"></label></a></div>
              </td>
              <td align="center">
                <div ng-repeat="data in each.day_2" ng-if="(planType === 'status' || (planType === 'guest' && data !== 'VC'))"><a href="{{baseurl+'page/detail/reservation/'+each.reservation_id}}"><label class="label label-{{planType === 'guest' ? 'success': labelClass(data)}}" ng-bind="data" style="cursor:pointer;"></label></a></div>
              </td>
              <td align="center">
                <div ng-repeat="data in each.day_3" ng-if="(planType === 'status' || (planType === 'guest' && data !== 'VC'))"><a href="{{baseurl+'page/detail/reservation/'+each.reservation_id}}"><label class="label label-{{planType === 'guest' ? 'success': labelClass(data)}}" ng-bind="data" style="cursor:pointer;"></label></a></div>
              </td>
              <td align="center">
                <div ng-repeat="data in each.day_4" ng-if="(planType === 'status' || (planType === 'guest' && data !== 'VC'))"><a href="{{baseurl+'page/detail/reservation/'+each.reservation_id}}"><label class="label label-{{planType === 'guest' ? 'success': labelClass(data)}}" ng-bind="data" style="cursor:pointer;"></label></a></div>
              </td>
              <td align="center">
                <div ng-repeat="data in each.day_5" ng-if="(planType === 'status' || (planType === 'guest' && data !== 'VC'))"><a href="{{baseurl+'page/detail/reservation/'+each.reservation_id}}"><label class="label label-{{planType === 'guest' ? 'success': labelClass(data)}}" ng-bind="data" style="cursor:pointer;"></label></a></div>
              </td>
              <td align="center">
                <div ng-repeat="data in each.day_6" ng-if="(planType === 'status' || (planType === 'guest' && data !== 'VC'))"><a href="{{baseurl+'page/detail/reservation/'+each.reservation_id}}"><label class="label label-{{planType === 'guest' ? 'success': labelClass(data)}}" ng-bind="data" style="cursor:pointer;"></label></a></div>
              </td>
              <td align="center">
                <div ng-repeat="data in each.day_7" ng-if="(planType === 'status' || (planType === 'guest' && data !== 'VC'))"><a href="{{baseurl+'page/detail/reservation/'+each.reservation_id}}"><label class="label label-{{planType === 'guest' ? 'success': labelClass(data)}}" ng-bind="data" style="cursor:pointer;"></label></a></div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!--  <div class="col-md-3">-->
  <!--    <div class="card">-->
  <!--      <div class="card-header">-->
  <!--        <span class="card-title">Info for <strong ng-bind="category.category_name"></strong> at <strong ng-bind="dateFilter"></strong></span>-->
  <!--      </div>-->
  <!---->
  <!--      <div class="card-block">-->
  <!--        <table class="table table-bordered table-hover table-striped">-->
  <!--          <tbody>-->
  <!--            <tr>-->
  <!--              <td>Total VC</td>-->
  <!--              <td>: <strong ng-bind="total_vc"></strong></td>-->
  <!--            </tr>-->
  <!--            <tr>-->
  <!--              <td>Total EA</td>-->
  <!--              <td>: <strong ng-bind="total_ea"></strong></td>-->
  <!--            </tr>-->
  <!--            <tr>-->
  <!--              <td>Total OD</td>-->
  <!--              <td>: <strong ng-bind="total_od"></strong></td>-->
  <!--            </tr>-->
  <!--            <tr>-->
  <!--              <td>Total ED</td>-->
  <!--              <td>: <strong ng-bind="total_ed"></strong></td>-->
  <!--            </tr>-->
  <!---->
  <!--            <tr>-->
  <!--              <td colspan="2"><hr/></td>-->
  <!--            </tr>-->
  <!---->
  <!--            <tr>-->
  <!--              <td>VC</td>-->
  <!--              <td>: Vacant Clean</td>-->
  <!--            </tr>-->
  <!--            <tr>-->
  <!--              <td>EA</td>-->
  <!--              <td>: Estimated Arrival</td>-->
  <!--            </tr>-->
  <!--            <tr>-->
  <!--              <td>ED</td>-->
  <!--              <td>: Estimated Departure</td>-->
  <!--            </tr>-->
  <!--            <tr>-->
  <!--              <td>OD</td>-->
  <!--              <td>: Occupied Dirty</td>-->
  <!--            </tr>-->
  <!--            <tr>-->
  <!--              <td>VD</td>-->
  <!--              <td>: Vacant Dirty</td>-->
  <!--            </tr>-->
  <!--          </tbody>-->
  <!--        </table>-->
  <!--      </div>-->
  <!---->
  <!---->
  <!--    </div>-->
  <!--  </div>-->
<?php $this->load->view("dashboard/modal");?>
</div>


