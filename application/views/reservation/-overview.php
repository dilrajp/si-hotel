<h3 class="m-t-70">Overview</h3>
<section ng-controller="overviewController">
  <table class="table table-bordered">
    <tr>
      <td>Reservation</td>
      <td>
        <table width="100%">
          <tr>
            <td width="160">Reservation By</td>
            <td><strong ng-bind="reservation.by" class="text-capitalize"></strong></td>
          </tr>
          <tr>
            <td>Booker</td>
            <td><strong ng-bind="guest.reserver_name" class="text-capitalize"/></td>
          </tr>
          <tr>
            <td>Contact Person</td>
            <td><strong ng-bind="guest.reserver_contact | phone"/></td>
          </tr>
          <tr>
            <td>Date In</td>
            <td><strong ng-bind="period.date_in"/></td>
          </tr>
          <tr>
            <td>Date Out</td>
            <td><strong ng-bind="period.date_out"/></td>
          </tr>
          <tr>
            <td>Length of Stay</td>
            <td><strong ng-bind="period.duration + ' day(s)'"></strong></td>
          </tr>
          <tr>
            <td>Room</td>
            <td>
              <table class="table table-condensed table-striped">
                <thead>
                  <tr>
                    <th>Room</th>
                    <th>Date</th>
                    <th>Period</th>
                    <th>Roomrate</th>
                  </tr>
                </thead>
                <tbody>
                  <tr ng-repeat="each in payment.room_list" ng-init="$last && payment.getTotal()">
                    <td><span ng-bind="each.room_number"></span></td>
                    <td><span ng-bind="each.date"></span></td>
                    <td>
                      <label ng-if="isLastDay(each.date)" class="label label-warning">Checkout</label>
                      <span ng-if="!isLastDay(each.date)" ng-bind="each.periode"></span>
                    </td>
                    <td align="right">
                      <label ng-if="isLastDay(each.date)" class="label label-warning">Checkout</label>
                      <span ng-if="!isLastDay(each.date)" ng-bind="each.room_rate | rupiah"></span>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="3"></td>
                    <td align="right"><span ng-bind="payment.total | rupiah"></span></td>
                  </tr>
                </tfoot>
              </table>
            </td>
          </tr>
          <tr>
            <td>Special Request</td>
            <td><strong ng-bind="reservation.note" class="text-capitalize"/></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>Guest</td>
      <td>
        <table width="100%">
          <tr>
            <td width="160">Group</td>
            <td>
              <strong ng-bind="guest.type === 'Group' ? guest.company.company_name : 'FIT'"/>
            </td>
          </tr>
          <tr>
            <td>Guest Name</td>
            <td>
              <strong ng-bind="guest.title" class="text-capitalize"></strong>
              <strong ng-bind="guest.firstname" class="text-capitalize"></strong>
              <strong ng-bind="guest.lastname" class="text-capitalize"></strong>
            </td>
          </tr>
          <tr>
            <td>Contact</td>
            <td><strong ng-bind="guest.contact | phone"/></td>
          </tr>
          <tr>
            <td>Email</td>
            <td><strong ng-bind="guest.email" class="text-lowercase"/></td>
          </tr>
          <tr>
            <td>Identification Card</td>
            <td><strong ng-bind="guest.identification_card" class="text-uppercase"/></td>
          </tr>
          <tr>
            <td>Address</td>
            <td><strong ng-bind="guest.address" class="text-capitalize"/></td>
          </tr>
          <tr>
            <td>City</td>
            <td><strong ng-bind="guest.city" class="text-capitalize"/></td>
          </tr>
          <tr>
            <td>Region</td>
            <td><strong ng-bind="guest.region" class="text-capitalize"/></td>
          </tr>
          <tr>
            <td>Country</td>
            <td><strong ng-bind="guest.country" class="text-capitalize"/></td>
          </tr>
          <tr>
            <td>Post Code</td>
            <td><strong ng-bind="guest.postcode"/></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>Payment</td>
      <td>
        <table width="100%">
          <!--Payment Type-->
          <tr>
            <td width="160">Payment Type</td>
            <td><strong ng-bind="payment.type"/></td>
          </tr>
          <tr ng-show="payment.type === 'Personal' && payment.by === 'Credit'">
            <td>Credit Info</td>
            <td><strong ng-bind="payment.name" class="text-capitalize"></strong> (<strong ng-bind="payment.number"></strong>)</td>
          </tr>
          <tr ng-show="payment.type === 'Company'">
            <td>Company Info</td>
            <td><strong ng-bind="payment.company_name" class="text-capitalize"></strong> (<strong ng-bind="payment.company_contact"></strong>)</td>
          </tr>
          <tr>
            <td>Deposit</td>
            <td><strong ng-bind="payment.deposit | rupiah"/></td>
          </tr>

          <!--Payment-->
          <tr>
            <td>Discount</td>
            <td><strong ng-bind="payment.discount + '%'"/></td>
          </tr>
          <tr ng-show="payment.discount > 0">
            <td>Supervisor</td>
            <td><strong ng-bind="payment.supervisor" class="text-capitalize"/></td>
          </tr>
          <tr ng-show="payment.discount > 0">
            <td>Discount Note</td>
            <td><strong ng-bind="payment.note" class="text-capitalize"/></td>
          </tr>

          <!--Discount-->
          <tr ng-show="guest.type === 'Group'">
            <td>Group Discount</td>
            <td><strong ng-bind="guest.type === 'Group'? (guest.company.company_discount + '%') : '-'"/></td>
          </tr>

          <!--Travel Agent-->
          <tr>
            <td>Travel Agent</td>
            <td><strong ng-bind="payment.with_travelagent === 'Yes' ? payment.travel_agent.travelagent_name : 'No'"/></td>
          </tr>
          <tr ng-show="payment.with_travelagent === 'Yes'">
            <td>Coupon</td>
            <td><strong ng-bind="payment.coupon" class="text-uppercase"/></td>
          </tr>
          <tr>
            <td></td>
            <td>
              <input type="submit" class="btn btn-primary"/>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</section>
