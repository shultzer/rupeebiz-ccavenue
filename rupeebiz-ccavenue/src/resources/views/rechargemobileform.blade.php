@extends('blades.base')

@section('page title', 'Index')
@section('breadcrumbs')
@endsection

@section('horizontal tab')

@endsection
@section('css')
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('css/travel.css')}}">
    <link rel="stylesheet" href="{{ asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{ asset('css/tool-tip.css')}}">
    <link rel="stylesheet" href="{{ asset('css/main.css')}}">
@endsection
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container-fluid summary-page" style="padding-top: 100px">
    <div class="container">
        <div class="col-md-10 col-md-offset-1 summary1-page">
            <div class="col-md-12 summary-img text-center">
                <img src="images/logo.png" alt="" class="img-responsive"/>
            </div>
            <form method="post" name="customerData" action="/mobilerecharge">
                {{csrf_field()}}
                    <div class="col-sm-6 order">
                        <h2>ORDER SUMMARY</h2>
                        <div class="container"></div>
                        <div style="padding-top: 10px">
                            <div class="col-sm-6">
                                <h4>{{$type}}</h4>
                                <p>Recharge Type</p>

                                <h4>{{$operatorname}}</h4>
                                <p>Operator</p>
                            </div>
                            <div class="col-sm-6">
                                <h4>{{$prepaidamount}}</h4>
                                <p>Recharge Amount</p>

                                <h4>{{$tel}}</h4>
                                <p>Mobile Number</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 order">
                        <h2>CASHBACK</h2>
                        <div class="col-sm-9">
                            <div class="input-row">
                                <img src="{{asset('images/icon/email.png')}}">

                                <input placeholder="Enter your coupon code" type="email"/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <a href="#" class="login-button">Apply</a>
                        </div>

                        <div class="col-sm-6 cashback">
                            <h4><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;{{Auth::user()->wallet}}</h4>
                            <p>Your Wallet Balance</p>
                        </div>
                        <div class="col-sm-6 cashback">
                            <h4><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;--</h4>
                            <p>Total Bill Amount</p>
                        </div>

                        <div class="privacy-sec">
                            <input id="5" value="true" type="checkbox" name="fromwallet" name="fromwallet"><label for="5">Use wallet balance</label>
                        </div>

                        <div class="clearfix"></div>
                        <div class="button">
                            <input class="btn btn-primary" type="submit" value="Pay now"/>
                        </div>
                        <input type="hidden" value="tid" name="tid" id="tid" readonly/>
                        <input type="hidden" name="merchant_id" value="112068"/>
                        <input type="hidden" name="amount" value="{{$prepaidamount}}"/>
                        <input type="hidden" name="tel" value="{{$tel}}"/>
                        <input type="hidden" name="oprator" value="{{$prepaidprovider}}"/>
                        <input type="hidden" name="currency" hidden value="INR"/>
                        <input type="hidden" name="redirect_url" value="http://zapwallet.in/ccavResponseHandler"/>
                        <input type="hidden" name="cancel_url" value="http://zapwallet.in/ccavResponseHandler"/>
                        <input type="hidden" name="language" value="EN"/>

                    </div>
                    <div class="clearfix"></div>
            </form>
        </div>

    </div>
    <div class="clearfix"></div>
</div>
{{-- <form method="post" name="customerData" action="/mobilerecharge">
     <table class="table">
         <thead>
         <tr style="background-color: #0089cf">
             <td style="color: #fff" scope="col">Type</td>
             <td style="color: #fff" scope="col">Operator</td>
             <td style="color: #fff" scope="col">Use Wallet Balance?</td>
             <td style="color: #fff" scope="col">Amount</td>
         </tr>
         </thead>
         <tbody>
         <tr>
             <th scope="row">{{ $type }}</th>
             <th>{{$operatorname}}</th>
             <th><input value="true" type="checkbox" name="fromwallet" id="prepaidwallet"/></th>
             <th>{{$prepaidamount}}</th>

         </tr>
         </tbody>
     </table>
     <div class="row">

     </div>
     <input type="hidden" value="tid" name="tid" id="tid" readonly/>
     <input type="hidden" name="merchant_id" value="112068"/>
     <input type="hidden" name="amount" value="{{$prepaidamount}}"/>
     <input type="hidden" name="tel" value="{{$tel}}"/>
     <input type="hidden" name="oprator" value="{{$prepaidprovider}}"/>
     <input type="hidden" name="currency" hidden value="INR"/>
     <input type="hidden" name="redirect_url" value="http://zapwallet.in/ccavResponseHandler"/>
     <input type="hidden" name="cancel_url" value="http://zapwallet.in/ccavResponseHandler"/>
     <input type="hidden" name="language" value="EN"/>
     <input type="submit" class="submit" id="prepaidclick" value="Pay now">
 </form>--}}

{{--<div class="wrapper" style="padding-top: 100px">
    <div class="header header-filter">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="brand">
                        <h1>TelliFone.</h1>
                        <h3>Recharge on the go!</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main main-raised">
        <div class="section section-basic">
            <div class="container">
                <div class="col-lg-6">
                    <div class="card card-nav-tabs">
                        <div class="header header-info text-center">
                            <h4>Order Summary</h4>
                        </div>
                        <div class="content">
                            <div class="tab-content text-center">
                                <div class="tab-pane active" id="mobile">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <h4>
                                            <span>Recharge Type</span></h4>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <h4>&#x20b9;{{$prepaidamount}}
                                            <span>Recharge Amount</span></h4>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <h4>
                                            {{ $prepaidprovider }}<span>Operator</span></h4>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <h4>
                                            <span>Number</span></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-nav-tabs">
                        <div class="header header-info text-center">
                            <h4>Cashback</h4>
                        </div>
                        <div class="content">
                            <div class="tab-content text-center">
                                <div class="tab-pane active" id="mobile">
                                    <form method="POST"
                                          action="" name="paymentForm">

                                        <input type="hidden" id="action" name="action" value="pay_now"/>
                                        <div class="col-lg-8">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label" style="text-transform: capitalize;">Enter your coupon code</label>
                                                <input type="text" name="coupon_code" id="coupon_code" class="form-control">
                                                <span class="material-input"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">

                                            <button type="button" class="btn btn-primary btn_Apply" style="width: 100%; margin-top: 20px;">APPLY</button>
                                        </div>
                                        <div class="col-md-12 text-left">
                                            <p id="coupon_response"></p>
                                            <input type="hidden" id="couponresponse" name="couponresponse" value=""/>

                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <h4>&#x20b9;
                                                <span>Your Wallet Balance</span></h4>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <h4 id="totalbillamt">&#x20b9;

                                                <span>Total Bill Amount</span></h4>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">

                                            <div class="checkbox" style="margin-left: -60px;">
                                                <label>
                                                    <input type="checkbox" id="wallet_option" name="wallet_option" value="1">
                                                    Use Wallet Balance?
                                                </label>
                                            </div>

                                        </div>
                                        <div class="col-sm-12">
                                            <button id="paynow" name="paynow" type="submit" class="btn btn-success btn-lg" style="width: 100%; margin-top: 20px;">Pay Now</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>--}}

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            //Vertical Tab
            $('#parentVerticalTab').easyResponsiveTabs({
                type: 'vertical', //Types: default, vertical, accordion
                width: 'auto', //auto or any width like 600px
                fit: true, // 100% fit in a container
                closed: 'accordion', // Start closed if in accordion view
                tabidentify: 'hor_1', // The tab groups identifier
                activate: function (event) { // Callback function if tab is switched
                    var $tab = $(this);
                    var $info = $('#nested-tabInfo2');
                    var $name = $('span', $info);
                    $name.text($tab.text());
                    $info.show();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#tab2").hide();
            $("#tab3").hide();
            $("#tab4").hide();
            $(".tabs-menu a").click(function (event) {
                event.preventDefault();
                var tab = $(this).attr("href");
                $(".tab-grid").not(tab).css("display", "none");
                $(tab).fadeIn("slow");
            });
        });
    </script>
    <script src="js/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#datepicker,#datepicker1").datepicker();
        });
    </script>
@endsection
