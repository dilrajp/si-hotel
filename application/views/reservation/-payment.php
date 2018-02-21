<h3 class="m-t-70">Payment</h3>
<section ng-controller="paymentController">
  <table class="table table-bordered">
    <tr>
      <td align="right" colspan="2"><strong>Payment Review</strong></td>
    </tr>
    <tr>
      <td>
        <table class="table table-condensed table-striped">
          <thead>
            <tr>
              <th>Category</th>
              <th>Room</th>
              <th>Date</th>
              <th>Period</th>
              <th>Roomrate</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="each in payment.room_list">
              <td><span ng-bind="each.category_name"></span></td>
              <td><span ng-bind="each.room_number"></span></td>
              <td><span ng-bind="each.date"></span></td>
              <td>
                <label ng-if="isLastDay(each.date)" class="label label-warning">Checkout</label>
                <span ng-if="!isLastDay(each.date)" ng-bind="each.periode"></span>
              </td>
              <td align="right">
                <label ng-if="isLastDay(each.date)" class="label label-warning">Checkout</label>
                <span ng-if="!isLastDay(each.date)" ng-bind="each.room_rate | rupiah"></span>
                <input type="hidden" name="room_rate[]" value="{{getRoomRateDetail(each.date, each.room_rate, 0)}}"/>
              </td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="4"></td>
              <td align="right"><span ng-bind="payment.total | rupiah"></span></td>
            </tr>
          </tfoot>
        </table>
        <small class="pull-right" ng-show="guest.type === 'Group'">* Group discount <strong ng-bind="guest.company.company_discount + '% (' + guest.company.company_name + ')'"></strong></small>
      </td>
    </tr>
  </table>

  <hr/>

  <table class="table table-bordered">
    <tr>
      <td align="right" colspan="2"><strong>Payment Option</strong></td>
    </tr>

    <!--Payment Type-->
    <tr>
      <td width="160">Payment Type</td>
      <td>
        <label class="c-input c-radio">
          <input name="payment_type" type="radio" value="Personal" checked ng-model="payment.type">
          <span class="c-indicator"></span>
          Personal
        </label>
        <label class="c-input c-radio">
          <input name="payment_type" type="radio" value="Company" ng-model="payment.type">
          <span class="c-indicator"></span>
          Company
        </label>
      </td>
    </tr>
    <tr ng-show="payment.type === 'Personal'">
      <td></td>
      <td>
        <label class="c-input c-radio">
          <input name="payment_by" type="radio" value="Cash" checked ng-model="payment.by">
          <span class="c-indicator"></span>
          Cash
        </label>
        <label class="c-input c-radio">
          <input name="payment_by" type="radio" value="Credit" ng-model="payment.by">
          <span class="c-indicator"></span>
          Credit
        </label>
      </td>
    </tr>
    <tr ng-show="payment.by === 'Credit' && payment.type === 'Personal'">
      <td></td>
      <td>
        <table>
          <tr>
            <td><input type="text" name="payment_name" class="form-control text-capitalize" placeholder="Credit Name" ng-model="payment.name" ng-required="payment.by === 'Credit' && payment.type === 'Personal'"/></td>
            <td><input type="text" name="payment_number" class="form-control" placeholder="Credit Number" ng-model="payment.number" ng-required="payment.by === 'Credit' && payment.type === 'Personal'"/></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr ng-show="payment.type === 'Company'">
      <td></td>
      <td>
        <table>
          <tr>
            <td><input type="text" name="payment_companyname" class="form-control text-capitalize" placeholder="Company Name" ng-model="payment.company_name" ng-required="payment.type === 'Company'"/></td>
            <td><input type="number" name="payment_companycontact" class="form-control" placeholder="Company Contact" ng-model="payment.company_contact" ng-required="payment.type === 'Company'"/></td>
          </tr>
        </table>
      </td>
    </tr>

    <!--Deposit-->
    <tr>
      <td>Deposit</td>
      <td>
        <input type="number" name="deposit_amount" class="form-control" placeholder="Deposit" ng-model="payment.deposit" oninput="validatePrice(this)"/>
        <small>(Optional)</small>
      </td>
    </tr>

    <!--Discount-->
    <tr>
      <td>Discount</td>
      <td>
        <input type="number" name="payment_discount" class="form-control" min="0" max="50" placeholder="Discount" ng-model="payment.discount" ng-change="payment.getTotal()" oninput="validateDiscount(this)"/>
        <small>* For discount other than group discount</small>
      </td>
    </tr>

    <!--Supervisor-->
    <tr ng-show="payment.discount > 0">
      <td>Supervisor</td>
      <td><input type="text" name="payment_supervisor" class="form-control text-capitalize" placeholder="Supervisor" ng-model="payment.supervisor"/></td>
    </tr>

    <!--Note-->
    <tr ng-show="payment.discount > 0">
      <td>Note</td>
      <td><textarea name="payment_note" class="form-control" ng-model="payment.note"></textarea></td>
    </tr>

    <!--Travel Agent-->
    <tr>
      <td>Travel Agent</td>
      <td>
        <label class="c-input c-radio">
          <input name="payment_travelagent" type="radio" value="No" ng-model="payment.with_travelagent" ng-checked="true">
          <span class="c-indicator"></span>
          No
        </label>
        <label class="c-input c-radio">
          <input name="payment_travelagent" type="radio" value="Yes" ng-model="payment.with_travelagent">
          <span class="c-indicator"></span>
          Yes
        </label>
      </td>
    </tr>
    <tr ng-show="payment.with_travelagent === 'Yes'">
      <td></td>
      <td>
        <select name="travelagent_id" class="form-control" ng-model="travelagent_id" ng-init="travelagent_id=payment.travel_agents[0].travelagent_id" ng-change="payment.getTravelAgent()">
          <option ng-repeat="each in payment.travel_agents" value="{{each.travelagent_id}}">{{each.travelagent_name}}</option>
        </select>
        <br/>
        <input type="text" name="payment_coupon" class="form-control text-uppercase" placeholder="Voucher" ng-model="payment.coupon"/>
      </td>
    </tr>
  </table>
</section>
