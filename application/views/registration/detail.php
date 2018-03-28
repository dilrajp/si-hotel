<div class="row">
  <div class="col-sm-12">
    <h4 class="page-title">Invoice</h4>
  </div>
</div>
<script type="text/javascript">
   function getval(sel){
    if (sel.value == "CC") {
      $('#firstname').val(Math.abs($('#balancez').val()));
      $('#firstname').attr('readonly', true);
      $('#textmanual').hide();
    } else if(sel.value == "Cash"){
      $('#firstname').val(' ');
      $('#firstname').attr('readonly', false);
      $('#textmanual').hide();
    } else if(sel.value == "Company Account"){
      $('#firstname').val(Math.abs($('#balancez').val()));
      $('#firstname').attr('readonly', true);
      $('#textmanual').show();
    }
  }

  function cetak() {
    var totalheignt = $('#kontenbilling').height() + $('#logo').height() + $('#biodata').height();
    var sisa = totalheignt % 842;
    $('#kontenpayment').removeClass('hidden-print');
    $('#kontenpayment').css('margin-top', sisa + 150);
    $('#kontenbilling').addClass('hidden-print');
    $('#logo').addClass('hidden-print');
    $('#biodata').addClass('hidden-print');
    console.log(sisa);
    window.print();
    location.reload();
  }
</script>
<style type="text/css">
  .editOption{
    width: 90%;
    height: 26px;
    position: relative;
    top: -29px;
    background: #E0F5FF;;
    border: 0;
    padding-left: 5px;
  }
</style>

<script language="JavaScript"  src="<?php echo base_url('assets/js/jquery-1.11.1.min.js')?>"></script>
<div class="row" ng-controller="detailController">
  <div class="col-xs-12">
    <div class="card-box">
      <div class="panel-body">

        <!--Header-->
        <div class="clearfix" id="logo">
          <div class="pull-left">
            <h2 class="logo" style="color: #2b3d51 !important;">Hotel Admin</h2>
          </div>
          <div class="pull-right">
            <h5>Invoice # <br>
              <small ng-bind="detail.reservation_id"></small>
            </h5>
          </div>
        </div>
        <hr>

        <!--Base Info-->
        <div class="row" id="biodata">
          <div class="col-md-6 col-sm-6 col-xs-6m-t-30">
            <table>
              <tr>
                <td width="128"><strong>Guest Name</strong></td>
                <td align="center" width="24">:</td>
                <td><span ng-bind="detail.guest_name"></span></td>
              </tr>
              <tr>
                <td><strong>Contact</strong></td>
                <td align="center">:</td>
                <td><span ng-bind="detail.guest_contact | phone"></span></td>
              </tr>
              <tr ng-if="detail.guest_email">
                <td><strong>Email</strong></td>
                <td align="center">:</td>
                <td><span ng-bind="detail.guest_email"></span></td>
              </tr>
              <!--Address-->
              <tr ng-if="detail.guest_address || detail.guest_city || detail.guest_city || detail.guest_region || detail.guest_country || guest_postcode">
                <td valign="top"><strong>Address</strong></td>
                <td align="center" valign="top">:</td>
                <td>
                  <span ng-bind="detail.guest_address"></span><br/>
                  <span ng-bind="detail.guest_city"></span>,
                  <span ng-bind="detail.guest_region"></span>,
                  <span ng-bind="detail.guest_country"></span>,
                  <span ng-bind="detail.guest_postcode"></span>
                </td>
              </tr>
              <tr>
                <td><strong>Group</strong></td>
                <td align="center">:</td>
                <td><span ng-bind="detail.group_name"></span></td>
              </tr>
              <tr ng-if="detail.guest_identificationcard">
                <td><strong>ID Card</strong></td>
                <td align="center">:</td>
                <td>
                  <span ng-bind="detail.guest_identificationcard"></span>
                </td>
              </tr>
              <tr>
                <td valign="top"><strong>Payment By</strong></td>
                <td align="center" valign="top">:</td>
                <td valign="top">
                  <span ng-bind="detail.payment_type"></span> <span ng-if="detail.payment_type === 'Personal'" ng-bind="' (' + detail.payment_by + ')'"></span>
                </td>
              </tr>

              <!--Personal Payment-->
              <tr ng-if="detail.payment_name">
                <td valign="top"><strong>Credit Name</strong></td>
                <td align="center" valign="top">:</td>
                <td valign="top"><span ng-bind="detail.payment_name"></span></td>
              </tr>
              <tr ng-if="detail.payment_number">
                <td valign="top"><strong>Credit Number</strong></td>
                <td align="center" valign="top">:</td>
                <td valign="top"><span ng-bind="detail.payment_number"></span></td>
              </tr>

              <!--Company Payment-->
              <tr ng-if="detail.payment_companyname">
                <td valign="top"><strong>Company Name</strong></td>
                <td align="center" valign="top">:</td>
                <td valign="top"><span ng-bind="detail.payment_companyname"></span></td>
              </tr>
              <tr ng-if="detail.payment_companynumber">
                <td valign="top"><strong>Company CP</strong></td>
                <td align="center" valign="top">:</td>
                <td valign="top"><span ng-bind="detail.payment_companynumber"></span></td>
              </tr>

              <!--Travel Agent-->
              <tr ng-if="detail.travelagent_name">
                <td valign="top"><strong>Travel Agent</strong></td>
                <td align="center" valign="top">:</td>
                <td valign="top"><span ng-bind="detail.travelagent_name"></span></td>
              </tr>
              <tr ng-if="detail.payment_coupon">
                <td valign="top"><strong>Voucher</strong></td>
                <td align="center" valign="top">:</td>
                <td valign="top"><span ng-bind="detail.payment_coupon"></span></td>
              </tr>
            </table>
          </div>

          <div class="col-md-3 col-sm-6 col-xs-6 col-md-offset-3">
            <table>
              <tr>
                <td width="128"><strong>Booker</strong></td>
                <td align="center" width="24">:</td>
                <td><span ng-bind="detail.reservation_reservername"></span></td>
              </tr>
              <tr>
                <td><strong>Contact Person</strong></td>
                <td align="center" width="24">:</td>
                <td><span ng-bind="detail.reservation_reservercontact | phone"></span></td>
              </tr>
              <tr>
                <td valign="top"><strong>Order Date</strong></td>
                <td align="center" valign="top" width="24">:</td>
                <td valign="top"><span ng-bind="detail.reservation_date"></span></td>
              </tr>
              <tr>
                <td><strong>Date In</strong></td>
                <td align="center" width="24">:</td>
                <td><span id="datein" ng-bind="detail.reservation_datein"></span></td>
              </tr>
              <tr>
                <td><strong>Date Out</strong></td>
                <td align="center" width="24">:</td>
                <td><span ng-bind="detail.reservation_dateout"></span></td>
              </tr>
            </table>
          </div>
        </div>

        <!--Table-->
        <div class="row" id="kontenbilling">

          <div class="col-xs-12">
            <div class="table-responsive">
              <table class="table m-t-30" ng-init="total = 0">
                <thead class="bg-faded">
                  <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th width="15%">Description</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Balance</th>
                  </tr>
                </thead>
                <tbody>
                  <tr ng-repeat="each in deposit">
                    <td><span ng-bind="$index+1">{{each}}</span></td>
                    <td><span ng-bind="each.formatted_date.slice(0, each.formatted_date.length - 7)"></span></td>
                    <td><span ng-bind="each.formatted_date.substr(each.formatted_date.length - 6, 5)"></span></td>
                    <td width="15%"><label class="label label-{{each.note === 'Added Deposit' || each.note.substr(0,11) === 'Correction-'  || each.note === 'Cash' || each.note === 'CC' ||  each.note.substr(0,18) === 'Company Account - '? 'success':'warning'}}" ng-bind="each.note.substr(0,11) === 'Correction-' ? each.note.substr(11) : each.note"></label></td>
                    <td><span ng-if="each.note !== 'Added Deposit' && each.note.substr(0,11) !== 'Correction-' && each.note !== 'Cash' && each.note !== 'CC' && each.note.substr(0,18) !== 'Company Account - '" ng-bind="each.amount | rupiah"></td>
                    <td><span ng-if="each.note === 'Added Deposit' || each.note.substr(0,11) === 'Correction-' || each.note === 'Cash' || each.note === 'CC' || each.note.substr(0,18) === 'Company Account - '" ng-bind="each.amount | rupiah"></span></td>
                    <td align="left"><span ng-if="balance[$index] != 0" ng-bind="balance[$index] >= 0 ? '('+(balance[$index] | rupiah)+')' : (balance[$index]*(-1) | rupiah)"></span><span ng-if="balance[$index] == 0">0</span></td>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

      <!--     <div class="col-xs-6">
            <div class="table-responsive">
              <table class="table m-t-30">
                <thead class="bg-faded">
                  <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Room</th>
                    <th>Unit Cost</th>
                  </tr>
                </thead>
                <tbody>
                  <tr ng-repeat="each in detail.detail">
                    <td><span ng-bind="$index+1"></span></td>
                    <td><span ng-bind="each.formatted_marker_date"></span></td>
                    <td><span ng-bind="each.category_name + ' (' + each.room_number + ')'"></span></td>
                    <td align="right">
                      <label ng-if="each.formatted_marker_date === detail.reservation_dateout" class="label label-warning">Checkout</label>
                      <span ng-if="each.formatted_marker_date !== detail.reservation_dateout" ng-bind="each.marker_roomrate | rupiah"></span>
                    </td>
                  </tr>
                </tbody>
                <tfoot style="background:silver;">
                  <td colspan="3"></td>
                  <td align="right"><strong ng-bind="getSubtotal() | rupiah"></td>
                </tfoot>
              </table>
            </div>
          </div> -->

        </div>

        <!--Lower Left-->
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-6 hidden-print" id="kontenpayment">
            <table>
              <tr>
                <td><strong>Method</strong></td>
                <td align="center" width="24">:</td>
                <td><span ng-bind="detail.reservation_by"></span></td>
              </tr>
              <tr>
                <td><strong>Deposit</strong></td>
                <td align="center">:</td>
                <td align="right"><label class="label label-success" ng-if="detail.totaldeposit != 0" ng-bind="detail.totaldeposit | rupiah"></label><label class="label label-success" ng-if="detail.totaldeposit == 0">0</label></td>
              </tr>
              <tr>
                <td><strong>Billing</strong></td>
                <td align="center">:</td>
                <td align="right"><label class="label label-warning" ng-if="detail.totalbilling != 0" ng-bind="detail.totalbilling | rupiah"></label><label class="label label-warning" ng-if="detail.totalbilling == 0">0</label></td>
              </tr>
              <tr>
                <td><strong>Balance</strong></td>
                <td align="center">:</td>
                <td align="right"><label class="label label-primary" ng-if="detail.totalbalance != 0" ng-bind="detail.totalbalance | rupiah"></label><label class="label label-primary" ng-if="detail.totalbalance == 0">0</label></td>
              </tr>
            </table>
            <hr/>
            <table>
              <tr>
                <td><strong>Special Request</strong></td>
                <td align="center">:</td>
                <td><span ng-bind="detail.reservation_note === ''? '-' : detail.reservation_note"></span></td>
              </tr>
              <tr>
                <td valign="top"><strong>Payment Note</strong></td>
                <td align="center" valign="top">:</td>
                <td>
                  <span ng-bind="detail.payment_note === ''? '-' : detail.payment_note"></span>
                  <br/>
                  <span ng-bind="'Company discount: ' + detail.company_discount + '%'" ng-if="detail.group_name !== 'FIT'"></span><br/>
                </td>
              </tr>
            </table>
          </div>

          <!--Lower Right-->
          <!-- <div class="col-md-3 col-sm-6 col-xs-6 col-md-offset-3">
            <table width="100%">
              <tr>
                <td align="right"><strong>Discount</strong></td>
                <td align="center" width="16">:</td>
                <td align="right"><span ng-bind="(parseInt(detail.company_discount) + parseInt(detail.payment_discount)) + '%'"></td>
              </tr>
              <tr>
                <td align="right"><strong>Tax & Service</strong></td>
                <td align="center" width="16">:</td>
                <td align="right">21%</td>
              </tr>
            </table>
            <hr>
            <h3 class="text-xs-right"><span ng-bind="getTotal() | rupiah"></span></h3>
          </div> -->
        </div>

        <hr>
        <div class="hidden-print">
          <table width="100%">
            <tr>
              <td align="left" width="30%"></td>
              <td align="center" width="40%">
                <!--Print-->
                <a ng-if="detail.reservation_status !== 'Finished'" href="javascript:window.print()" class="btn btn-dark waves-effect waves-light"><i class="fa fa-print"></i></a>
                <button ng-if="detail.reservation_status === 'Finished'" onclick="cetak()" class="btn btn-dark waves-effect waves-light"><i class="fa fa-print"></i></button>
                <!--Add Deposit-->
                <a ng-if="detail.reservation_status === 'Ongoing'" href="" class="btn btn-success" ng-click="addDeposit(detail.reservation_id);" onclick="return false;"><i class="fa fa-plus"></i> Credit</a>
                <!--Add Transaction-->
                <a ng-if="detail.reservation_status === 'Ongoing'" href="" class="btn btn-warning" ng-click="addTransaction(detail.reservation_id);" onclick="return false;"><i class="fa fa-plus"></i> Transaction</a>
                <!-- add correction -->
                <a ng-if="detail.reservation_status === 'Ongoing'" href="" class="btn btn-danger" ng-click="addCorrection(detail.reservation_id);" onclick="return false;"><i class="fa fa-edit"></i> Correction</a>
                 <a ng-if="detail.reservation_status === 'Ongoing'" href="" class="btn btn-success" ng-click="chargeRoom(detail.reservation_id);" onclick="return false;"><i class="fa fa-money"></i> Room </a>
              </td>
              <td align="right" width="30%">
                <a ng-if="detail.reservation_status === 'Ongoing'" href="#" class="btn btn-primary waves-effect waves-light" ng-click="checkOut()">Check Out</a>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div id="moda" class="modal fade" role="dialog" style="display: none;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header text-lg-center" style="background: rgb(100, 176, 242); color:white;">
          Check-out for Reservation<br/> <strong>'{{detail.reservation_id}}'</strong><br/>
        </div>
        <div class="modal-body">
          <form class="reloadform" action="{{checkout_url}}" method="post">
            <div class="form-group row">
              <input type="hidden" name="reservation_id" value="{{detail.reservation_id}}"/>

              <div class="col-md-12">
                <strong>Start check-out for this reservation?</strong>
              </div>
            </div>

            <hr/>

            <div class="form-group">
              <input type="submit" class="btn btn-sm btn-primary" value="Yes"/>
              <input type="button" class="btn btn-sm btn-warning" value="No" data-dismiss="modal"/>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

    <div id="modal" class="modal fade" role="dialog" style="display: none;">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header text-lg-center" style="background: rgb(100, 176, 242); color:white;">
          Check-out for Reservation<br/> <strong>'{{detail.reservation_id}}'</strong><br/>
        </div>
        <div class="modal-body">
        <!-- <div class="case"> -->

              <div ng-if="detail.totalbalance < 0">
                <!-- Bill: <strong>'{{detail.totalbalance}}'</strong> -->
                <form action="<?php echo base_url('Api/checkout_bayar'); ?>" method="post">
                  <input type="hidden" name="reservation_id" value="{{detail.reservation_id}}"/>
                  <table class="table">
                    <tr>
                      <td style="vertical-align: middle;">Bill </td>
                      <td align="right">
                         <input type="text" name="deposit_amount2" class="form-control" id="balancez" value="{{detail.totalbalance}}" readonly="" />
                      </td>
                    </tr>
                    <tr>
                      <td style="vertical-align: middle;">Payment </td>
                      <td>
                        <select  name="deposit_name" class="form-control" onchange="getval(this);" required>
                          <option value="Cash" >Cash</option>     
                          <option value="CC">CC </option>
                          <option value="Company Account">Company Account</option>     
                        </select>
                      </td>
                    </tr>
                    <tr id="textmanual">
                      <td style="vertical-align: middle;">Company Name</td>
                      <td align="right">
                         <input type="text" name="company_account" class="form-control"  id="company_account" />
                      </td>
                    </tr>
                    <tr>
                      <td style="vertical-align: middle;">Amount </td>
                      <td align="right">
                         <input type="number" name="deposit_amount" class="form-control"  id="firstname" required/>
                      </td>
                    </tr>
                    <tr>
                      <td style="vertical-align: middle;">Tanggal</td>
                      <td>
                        <input type="text" name="tanggal" class="form-control input-append date form_datetime checkout_date" ng-init="initializeDatepicker()" data-date-format="dd MM yyyy hh:ii:00" required readonly>
                      </td>
                    </tr>
                  </table>
                  <div class="form-group">
                    <input type="submit" class="btn btn-sm btn-primary" value="Add "/>
                    <input type="button" class="btn btn-sm btn-warning" value="Cancel" data-dismiss="modal"/>
                  </div>
                </form>
              </div>


              <div ng-if="detail.totalbalance >= 1 ">
                <form action="<?php echo base_url('Api/checkout_dibayar'); ?>" method="post">
                  <input type="hidden" name="reservation_id" value="{{detail.reservation_id}}"/>
                  <table class="table">
                    <tr>
                      <td style="vertical-align: middle;">Change </td>
                      <td align="right">
                         <input type="text" name="registration_amount" class="form-control"  value="{{detail.totalbalance}}" readonly="" />
                      </td>
                    </tr>
                     <tr>
                      <td style="vertical-align: middle;">Tanggal</td>
                      <td>
                        <input type="text" name="tanggal" class="form-control input-append date form_datetime checkout_date" ng-init="initializeDatepicker()" data-date-format="dd MM yyyy hh:ii:00" required readonly>
                      </td>
                    </tr>
                  </table>
                  <div class="form-group">
                    <input type="submit" class="btn btn-sm btn-primary" value="Add "/>
                    <input type="button" class="btn btn-sm btn-warning" value="Cancel" data-dismiss="modal"/>
                  </div>
                </form>
              </div>

              <div ng-if ="!(detail.totalbalance >= 1 || detail.totalbalance < 0)">
                <form class="reloadform" action="{{checkout_url}}" method="post">
                  <div class="form-group row">
                    <input type="hidden" name="reservation_id" value="{{detail.reservation_id}}"/>

                    <div class="col-md-12">
                      <strong>Start check-out for this reservation?</strong>
                    </div>
                     <div class="col-md-12">
                   
                  </div>
                  </div>

                  <hr/>

                  <div class="form-group">
                    <input type="submit" class="btn btn-sm btn-primary" value="Yes"/>
                    <input type="button" class="btn btn-sm btn-warning" value="No" data-dismiss="modal"/>
                  </div>
                </form>
             </div>
                
          <!-- </div> -->
        </div>
      </div>
    </div>
  </div>

  <div id="modal-deposit" class="modal fade" role="dialog" style="display: none;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header text-lg-center" style="background: rgb(100, 176, 242); color:white;">
          Add Deposit for Reservation<br/> <strong>'{{detail.reservation_id}}'</strong><br/>
        </div>
        <div class="modal-body">
          <form class="reloadform" action="{{deposit_url}}" method="post">

            <input type="hidden" name="reservation_id" value="{{detail.reservation_id}}"/>

            <input type="hidden" name="deposit_name" value="Added Deposit" />

            <table class="table">
              <tr>
                <td style="vertical-align: middle;">Current</td>
                <td align="right"><strong ng-bind="deposit_amount | rupiah"></strong></td>
              </tr>
              <tr>
                <td style="vertical-align: middle;">Amount</td>
                <td><input type="number" name="deposit_amount" class="form-control" placeholder="Deposit Amount" value="0" required/></td>
              </tr>
              <tr>
                <td style="vertical-align: middle;">Tanggal</td>
                <td>
                  <input type="text" name="tanggal" class="form-control input-append date form_datetime deposit_date" data-date-format="dd MM yyyy hh:ii:00" required readonly>
                </td>
              </tr>

            </table>

            <hr/>

            <div class="form-group">
              <input type="submit" class="btn btn-sm btn-primary" value="Add Deposit"/>
              <input type="button" class="btn btn-sm btn-warning" value="Cancel" data-dismiss="modal"/>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>


   <div id="modal-correction" class="modal fade" role="dialog" style="display: none;">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header text-lg-center" style="background: rgb(100, 176, 242); color:white;">
          Add Correction for Reservation<br/> <strong>'{{detail.reservation_id}}'</strong><br/>
        </div>
        <div class="modal-body">
          <form class="reloadform" action="{{deposit_url}}" method="post">

            <input type="hidden" name="reservation_id" value="{{detail.reservation_id}}"/>

            <table class="table">
              <tr>
                <td style="vertical-align: middle;">Name</td>
                <td align="right"><textarea name="deposit_name" class="form-control text-capitalize" placeholder="Desciption of the Correction. . . . " required></textarea></td>
              </tr>
              <tr>
                <td style="vertical-align: middle;">Amount</td>
                <td><input type="number" name="deposit_amount" class="form-control" placeholder="Deposit Amount" value="0" required/></td>
              </tr>
              <tr>
                <td style="vertical-align: middle;">Tanggal</td>
                <td>
                  <input type="text" name="tanggal" class="form-control input-append date form_datetime deposit_date" data-date-format="dd MM yyyy hh:ii:00" required readonly>
                </td>
              </tr>
            </table>

            <hr/>

            <div class="form-group">
              <input type="submit" class="btn btn-sm btn-primary" value="Add "/>
              <input type="button" class="btn btn-sm btn-warning" value="Cancel" data-dismiss="modal"/>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <div id="modal-transaction" class="modal fade" role="dialog" style="display: none;">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header text-lg-center" style="background: rgb(100, 176, 242); color:white;">
          Add transaction for Reservation<br/> <strong>'{{detail.reservation_id}}'</strong><br/>
        </div>
        <div class="modal-body">
          <form class="reloadform" action="{{transaction_url}}" method="post">

            <input type="hidden" name="reservation_id" value="{{detail.reservation_id}}"/>

            <table class="table">
              <tr>
                <td style="vertical-align: middle;">Current</td>
                <td align="right"><strong ng-bind="billing_amount | rupiah"></strong></td>
              </tr>
              <tr>
                <td style="vertical-align: middle;">Description</td>
                <td>
                   <div id="billdesc" style="height: 35px;">
                      <select id="test" name="registration_note" class="form-control" required>
                        <option class="non" value="Room Service" >Room Service</option>     
                        <option class="non" value="Coffee Shop">Coffee Shop</option>     
                        <option class="non" value="Drugstore">Drugstore</option>     
                        <option class="non" value="Business Center">Business Center</option> 
                        <option class="non" value="Lost and Damage">Lost and Damage</option> 
                        <option class="non" value="Movie">Movie</option> 
                        <option class="non" value="Mini Bar">Mini Bar</option> 
                        <option class="editable" value="Restaurant">Restaurant</option> 
                      </select>
                      <input class="editOption" style="display:none; margin-left: 5px;" placeholder="Text"></input>
                  </div>
                </td>
              </tr>
              <tr>
                <td style="vertical-align: middle;">Amount</td>
                <td><input type="number" name="registration_amount" class="form-control" placeholder="Transaction Amount" value="0" required oninput="validatePrice(this);"/></td>
              </tr>
              <tr>
                <td style="vertical-align: middle;">Tanggal</td>
                <td>
                  <input type="text" id="datetimepicker" name="registration_date" class="form-control input-append date form_datetime" data-date-format="dd MM yyyy hh:ii:00" required readonly>
                </td>
              </tr>

            </table>

            <hr/>

            <div class="form-group">
              <input type="submit" class="btn btn-sm btn-primary" value="Add Transaction"/>
              <input type="button" class="btn btn-sm btn-warning" value="Cancel" data-dismiss="modal"/>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>


    <div id="modal-room" class="modal fade" role="dialog" style="display: none;">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header text-lg-center" style="background: rgb(100, 176, 242); color:white;">
            Room Charge<br/> <strong>'{{detail.reservation_id}}'</strong><br/>
          </div>
          <div class="modal-body">
            <form class="reloadform" action="{{transaction_url}}" method="post" id="charge-kamar">

              <input type="hidden" name="reservation_id" value="{{detail.reservation_id}}"/>
              <input type="hidden" name="registration_note" value="Room*"/>

              <table class="table">
                <tr>
                  <td style="vertical-align: middle;">Room</td>
                  <td >
                    <select  name="data_kamar" class="form-control" required>
                      <option ng-repeat="each in jml_kamar" value="{{each.room_id}}|{{each.category_id}}"> <span>{{each.nama_kamar}}</option>   
                    </select>
                  </td>
                </tr>
                <tr ng-repeat="each in detail.detail|limitTo : 1">
                  <input type="hidden" name="grup" value="{{detail.guest_type}}">
                </tr>
                <tr>
                  <td style="vertical-align: middle;">Tanggal</td>
                <td>
                  <input type="text" id="tanggal" name="registration_date" class="form-control input-append date form_datetime" data-date-format="yyyy-mm-dd 23:59:59" name="tanggal" required readonly>
                </td>
                </tr>
                <tr>
                  <td style="vertical-align: middle;">Amount</td>
                  <td><input type="text" id="view_harga" class="form-control"  readonly required/>
                      <input type="hidden" id="room_charge" name="registration_amount" class="form-control"  readonly required/>
                  </td>
                </tr>
              </table>

              <hr/>

              <div class="form-group">
                <input type="submit" class="btn btn-sm btn-primary" value="Add "/>
                <input type="button" class="btn btn-sm btn-warning" value="Cancel" data-dismiss="modal"/>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

</div>


<script type="text/javascript">
  $(document).ready(function(){

    $('#textmanual').hide();

    
    $('#datetimepicker').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 0,
        forceParse: 0
    });

    $('.deposit_date').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 0,
        forceParse: 0
    });

    $('.checkout_date').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 0,
        forceParse: 0
    });

     $('#tanggal').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });

    $('#tanggal').datetimepicker().on('change', function(ev){
       $.ajax({  
          url   : "<?php echo base_url('Api/hargakamar')?>",  
          data: $("#charge-kamar").serialize(),
          type: "POST",  
          dataType: "json",
          success: function(data){
              $( "#view_harga" ).attr('value',data.view );
              $( "#room_charge" ).attr('value',data.harga.Harga );
          }  
        });

    });

  });

   
  
  var initialText = $('.editable').val();
  $('.editOption').val(initialText);

  $('#test').change(function(){
    var selected = $('option:selected', this).attr('class');
    var optionText = $('.editable').text();

    if(selected == "editable"){
      $('.editOption').show();
      
      $('.editOption').keyup(function(){
          var editText = $('.editOption').val();
          $('.editable').val(editText);
          $('.editable').html(editText);
      });

    }else{
      $('.editOption').hide();
    }
  });

</script>