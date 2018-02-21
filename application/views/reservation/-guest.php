<h3 class="m-t-70">Guest Data</h3>
<section ng-controller="guestController">

  <table class="table table-bordered">
    <!--Guest Type-->
    <tr>
      <td width="160">Guest Type</td>
      <td>
        <div class="col-md-12">
          <label class="c-input c-radio">
            <input name="guest_type" type="radio" value="FIT" ng-model="guest.type" ng-checked="guest.type === 'FIT'" ng-change="paymentReview()">
            <span class="c-indicator"></span>
            FIT
          </label>
          <label class="c-input c-radio">
            <input name="guest_type" type="radio" value="Group" ng-model="guest.type" ng-change="paymentReview()">
            <span class="c-indicator"></span>
            Group
          </label>
        </div>
      </td>
    </tr>
    <tr ng-show="guest.type === 'Group'">
      <td>Group Name</td>
      <td>
        <div class="col-md-12">
          <select name="company_id" class="form-control" ng-model="guest.company_id" ng-init="guest.company_id=guest.companies[0].company_id" ng-change="getCompany()">
            <option ng-repeat="each in guest.companies" value="{{each.company_id}}">{{each.company_name}}</option>
          </select>
        </div>
      </td>
    </tr>

    <!--Title-->
    <tr>
      <td>Title</td>
      <td>
        <div class="col-md-12">
          <label class="c-input c-radio">
            <input name="guest_title" type="radio" value="Mr." ng-model="guest.title" ng-checked="true">
            <span class="c-indicator"></span>
            Mr.
          </label>
          <label class="c-input c-radio">
            <input name="guest_title" type="radio" value="Mrs." ng-model="guest.title">
            <span class="c-indicator"></span>
            Mrs.
          </label>
        </div>
      </td>
    </tr>

    <!--Name-->
    <tr>
      <td>First Name</td>
      <td>
        <div class="col-md-12">
          <input type="text" name="guest_firstname" class="form-control text-capitalize" placeholder="First Name" required ng-model="guest.firstname"/>
        </div>
      </td>
    </tr>
    <tr>
      <td>Last Name</td>
      <td>
        <div class="col-md-12">
          <input type="text" name="guest_lastname" class="form-control text-capitalize" placeholder="Last Name" ng-model="guest.lastname"/>
          <small>(Optional)</small>
        </div>
      </td>
    </tr>

    <!--Identification Card-->
    <tr>
      <td>Identification Card</td>
      <td>
        <div class="col-md-12">
          <input type="text" name="guest_identificationcard" class="form-control text-uppercase" placeholder="Identification Card" ng-model="guest.identification_card"/>
          <small>(Optional)</small>
        </div>

      </td>
    </tr>

    <!--Contact-->
    <tr>
      <td>Contact</td>
      <td>
        <div class="col-md-12">
          <input type="text" name="guest_contact" class="form-control" placeholder="Contact" required ng-model="guest.contact"/>
        </div>
      </td>
    </tr>

    <!--Email-->
    <tr>
      <td>Email</td>
      <td>
        <div class="col-md-12">
          <input type="email" name="guest_email" class="form-control text-lowercase" placeholder="Email" ng-model="guest.email"/>
          <small>(Optional)</small>
        </div>
      </td>
    </tr>

    <!--Address-->
    <tr>
      <td>Address</td>
      <td>
        <div class="col-md-12">
          <textarea name="guest_address" class="form-control text-capitalize" placeholder="Address" ng-model="guest.address"></textarea>
          <small>(Optional)</small>
          <br/>
          <table>
            <tr>
              <td>
                <input type="text" name="guest_city" class="form-control text-capitalize" placeholder="City" ng-model="guest.city"/>
                <small>(Optional)</small>
              </td>
              <td>
                <input type="text" name="guest_region" class="form-control text-capitalize" placeholder="Region" ng-model="guest.region"/>
                <small>(Optional)</small>
              </td>
              <td>
                <input type="text" name="guest_country" class="form-control text-capitalize" placeholder="Country" ng-model="guest.country"/>
                <small>(Optional)</small>
              </td>
              <td>
                <input type="text" name="guest_postcode" class="form-control text-capitalize" placeholder="Post Code" ng-model="guest.postcode"/>
                <small>(Optional)</small>
              </td>
            </tr>
          </table>
        </div>
      </td>
    </tr>

    <!--Reserver-->
    <tr>
      <td>Booker</td>
      <td>

        <div class="col-md-12">
          <label class="c-input c-checkbox">
            <input type="checkbox" value="Same as Guest" ng-click="sameAsGuest($event)">
            <span class="c-indicator"></span>
            Same as Guest
          </label>

          <input type="text" name="reservation_reservername" class="form-control text-capitalize" placeholder="Reserver Name" required ng-model="guest.reserver_name" ng-readonly="guest.lock_reserver"/>
        </div>
      </td>
    </tr>
    <tr>
      <td>Contact Person</td>
      <td>
        <div class="col-md-12">
          <input type="text" name="reservation_reservercontact" class="form-control" placeholder="Reserver Contact" required ng-model="guest.reserver_contact" ng-readonly="guest.lock_reserver"/>
        </div>
      </td>
    </tr>
  </table>
</section>
