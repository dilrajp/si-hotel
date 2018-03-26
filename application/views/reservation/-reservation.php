<h3 class="m-t-70">Reservation</h3>
<section ng-controller="reservationController">
  <table class="table table-bordered">
    <tr>
      <td width="160">Reservation By</td>
      <td>
        <div class="col-md-12">
          <label class="c-input c-radio">
            <input name="reservation_by" type="radio" value="Walk In" ng-model="reservation.by" ng-checked="true">
            <span class="c-indicator"></span>
            Walk In
          </label>
          <label class="c-input c-radio">
            <input name="reservation_by" type="radio" value="Phone" ng-model="reservation.by">
            <span class="c-indicator"></span>
            Phone
          </label>
        </div>
      </td>
    </tr>
    <tr>
      <td>Room Number</td>
      <td>

        <div class="form-group row">
          <div class="col-md-3" ng-repeat="each in reservation.room_list">
            <div ng-repeat="room in each">
              <label class="c-input c-checkbox" ng-init="reservation.room_available = 'true'">
                <input name="room_id[]" type="checkbox" value="{{room.room_id}}" ng-click="addRoom($event, room.room_number)">
                <span class="c-indicator"></span>
                {{room.nama_kamar}}
              </label>
            </div>
          </div>

          <div ng-if="!reservation.room_available" class="col-md-12">
            <label class="label label-danger">No Room Available</label>
          </div>
        </div>

      </td>
    </tr>
    <tr>
      <td>Special Request</td>
      <td>
        <div class="form-group row">
          <div class="col-md-12">
            <textarea name="reservation_note" class="form-control text-capitalize" placeholder="Special Request" ng-model="reservation.note"></textarea>
            <small>(Optional)</small>
          </div>
        </div>
      </td>
    </tr>
  </table>

</section>
