@extends('layouts.master')

@section('content')
        <div class="content-w">
          <div class="content-i">
            <div class="content-box">
              <div class="element-wrapper compact pt-4">
                <div class="element-actions">
                  <a class="btn btn-primary btn-sm" href="#"><i class="os-icon os-icon-ui-22"></i><span>Add Account</span></a><a class="btn btn-success btn-sm" href="#"><i class="os-icon os-icon-grid-10"></i><span>Make Payment</span></a>
                </div>
                <h6 class="element-header">
                  Project Overview
                </h6>
                <div class="element-box-tp">
                  <div class="row">
                    <div class="col-lg-12 col-xxl-12">
                      <!--START - KPIs-->
                      <div class="element-balances">
                        <div class="balance hidden-mobile">
                          <div class="balance-title">
                            KPI 1
                          </div>
                          <div class="balance-value">
                            <span>0</span>
                          </div>
                        </div>
                        <div class="balance">
                          <div class="balance-title">
                            KPI 2
                          </div>
                          <div class="balance-value">
                            0
                          </div>
                        </div>
                        <div class="balance">
                          <div class="balance-title">
                            KPI 3
                          </div>
                          <div class="balance-value danger">
                            0
                          </div>
                        </div>
                        <div class="balance">
                          <div class="balance-title">
                            KPI 4
                          </div>
                          <div class="balance-value danger">
                            0
                          </div>
                        </div>
                        <div class="balance">
                          <div class="balance-title">
                            KPI 5
                          </div>
                          <div class="balance-value danger">
                            0
                          </div>
                        </div>
                        <div class="balance">
                          <div class="balance-title">
                            KPI 6
                          </div>
                          <div class="balance-value danger">
                            0
                          </div>
                        </div>

                      </div>
                      <!--END - BALANCES-->
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-7 col-xxl-6">
                  <!--START - CHART-->
                  <div class="element-wrapper">
                    <div class="element-box">
                      <div class="element-actions">
                        <div class="form-group">
                          <select class="form-control form-control-sm">
                            <option selected="true">
                              Last 30 days
                            </option>
                            <option>
                              This Week
                            </option>
                            <option>
                              This Month
                            </option>
                            <option>
                              Today
                            </option>
                          </select>
                        </div>
                      </div>
                      <h5 class="element-box-header">
                        Random Chart
                      </h5>
                      <div class="el-chart-w">
                        <canvas data-chart-data="13,28,19,24,43,49,40,35,42,46" height="90" id="liteLineChartV2" width="300"></canvas>
                      </div>
                    </div>
                  </div>
                  <!--END - CHART-->
                </div>
                <div class="col-lg-5 col-xxl-6">
                  <!--START - Money Withdraw Form-->
                  <div class="element-wrapper">
                    <div class="element-box">
                      <form>
                        <h5 class="element-box-header">
                          Random Form to Withdraw Money
                        </h5>
                        <div class="row">
                          <div class="col-sm-5">
                            <div class="form-group">
                              <label class="lighter" for="">Select Amount</label>
                              <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <input class="form-control" placeholder="Enter Amount..." type="text" value="0">
                                <div class="input-group-append">
                                  <div class="input-group-text">
                                    USD
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-7">
                            <div class="form-group">
                              <label class="lighter" for="">Transfer to</label><select class="form-control">
                                <option value="">
                                  Citibank *6382
                                </option>
                                <option value="">
                                  Chase *8372
                                </option>
                                <option value="">
                                  Bank of America *7363
                                </option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-buttons-w text-right compact">
                          <a class="btn btn-grey" href="#"><i class="os-icon os-icon-ui-22"></i><span>Add Account</span></a><a class="btn btn-primary" href="#"><span>Transfer</span><i class="os-icon os-icon-grid-18"></i></a>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!--END - Money Withdraw Form-->
                </div>
              </div>
              <!--START - Transactions Table-->
              <div class="element-wrapper">
                <h6 class="element-header">
                  Recent Data Entries
                </h6>
                <div class="element-box-tp">
                  <div class="table-responsive">
                    <table class="table table-padded">
                      <thead>
                        <tr>
                          <th>
                            Status
                          </th>
                          <th>
                            Date
                          </th>
                          <th>
                            Description
                          </th>
                          <th class="text-center">
                            Category
                          </th>
                          <th class="text-right">
                            Amount
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="nowrap">
                            <span class="status-pill smaller green"></span><span>Complete</span>
                          </td>
                          <td>
                            <span>Today</span><span class="smaller lighter">1:52am</span>
                          </td>
                          <td class="cell-with-media">
                            <img alt="" src="img/company1.png" style="height: 25px;"><span>Banana Shakes LLC</span>
                          </td>
                          <td class="text-center">
                            <a class="badge badge-success" href="">Shopping</a>
                          </td>
                          <td class="text-right bolder nowrap">
                            <span class="text-success">+ 1,250 USD</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="nowrap">
                            <span class="status-pill smaller red"></span><span>Declined</span>
                          </td>
                          <td>
                            <span>Jan 19th</span><span class="smaller lighter">3:22pm</span>
                          </td>
                          <td class="cell-with-media">
                            <img alt="" src="img/company2.png" style="height: 25px;"><span>Stripe Payment Processing</span>
                          </td>
                          <td class="text-center">
                            <a class="badge badge-danger" href="">Cafe</a>
                          </td>
                          <td class="text-right bolder nowrap">
                            <span class="text-success">+ 952.23 USD</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="nowrap">
                            <span class="status-pill smaller yellow"></span><span>Pending</span>
                          </td>
                          <td>
                            <span>Yesterday</span><span class="smaller lighter">7:45am</span>
                          </td>
                          <td class="cell-with-media">
                            <img alt="" src="img/company3.png" style="height: 25px;"><span>MailChimp Services</span>
                          </td>
                          <td class="text-center">
                            <a class="badge badge-warning" href="">Restaurants</a>
                          </td>
                          <td class="text-right bolder nowrap">
                            <span class="text-danger">- 320 USD</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="nowrap">
                            <span class="status-pill smaller yellow"></span><span>Pending</span>
                          </td>
                          <td>
                            <span>Jan 23rd</span><span class="smaller lighter">2:12pm</span>
                          </td>
                          <td class="cell-with-media">
                            <img alt="" src="img/company1.png" style="height: 25px;"><span>Starbucks Cafe</span>
                          </td>
                          <td class="text-center">
                            <a class="badge badge-primary" href="">Shopping</a>
                          </td>
                          <td class="text-right bolder nowrap">
                            <span class="text-success">+ 17.99 USD</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="nowrap">
                            <span class="status-pill smaller green"></span><span>Complete</span>
                          </td>
                          <td>
                            <span>Jan 12th</span><span class="smaller lighter">9:51am</span>
                          </td>
                          <td class="cell-with-media">
                            <img alt="" src="img/company4.png" style="height: 25px;"><span>Ebay Marketplace</span>
                          </td>
                          <td class="text-center">
                            <a class="badge badge-danger" href="">Groceries</a>
                          </td>
                          <td class="text-right bolder nowrap">
                            <span class="text-danger">- 244 USD</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="nowrap">
                            <span class="status-pill smaller yellow"></span><span>Pending</span>
                          </td>
                          <td>
                            <span>Jan 9th</span><span class="smaller lighter">12:45pm</span>
                          </td>
                          <td class="cell-with-media">
                            <img alt="" src="img/company2.png" style="height: 25px;"><span>Envato Templates Inc</span>
                          </td>
                          <td class="text-center">
                            <a class="badge badge-primary" href="">Business</a>
                          </td>
                          <td class="text-right bolder nowrap">
                            <span class="text-success">+ 340 USD</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!--END - Transactions Table-->
            </div>
          </div>
        </div>
      </div>
      <div class="display-type"></div>
    </div>

@endsection
