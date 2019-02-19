<!-- tab6 -->
<div>
    <div id="tab2" class="tab-grid">
        @if(Auth::user())
            <div class="login-form">
                <form action="/walletrecharge" name="customerData" method="post" class="signup">
                    <ol>
                        <li>
                            <div class="mobile-right ">
                                <h4>Add Money</h4>
                                <div class="mobile-rchge">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="billing_name" value="{{$user->name}}"/>
                                    <input type="hidden" name="billing_address" value="{{ $user->address }}"/>
                                    <input type="hidden" name="billing_city" value="{{$user->city}}"/>
                                    <input type="hidden" name="billing_state" value="MP"/>
                                    <input type="hidden" name="billing_zip" value="425001"/>
                                    <input type="hidden" name="billing_country" value="{{$user->country}}"/>
                                    <input type="hidden" name="billing_tel" value="{{$user->mobile}}"/>
                                    <input type="hidden" name="billing_email" value="{{$user->email}}"/>
                                    <input type="hidden" name="merchant_id" value="112068"/>
                                    <input type="hidden" name="order_id" value="ZAP-{{ time() }}"/>
                                    <input type="hidden" name="currency" value="INR"/>
                                    <input type="hidden" name="redirect_url" value="http://zapwallet.in/ccavResponseHandler"/>
                                    <input type="hidden" name="cancel_url" value="http://zapwallet.in/ccavResponseHandler"/>
                                    <input type="hidden" name="language" value="EN"/>
                                    <input type="text" placeholder="Enter amount"  name="amount" value="{{ old('amount') }}" required/>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </li>
                        <li style="display:table;margin-left:65px;">
                            <input type="submit" class="submit" value="Add Money"/>
                        </li>
                    </ol>
                </form>
            </div>
        @elseif(!Auth::user())
            <div class="login-form">
                <form method="post" id="signup" class="signup">
                    <ol>
                        <li>
                            <div class="mobile-right">
                                <h4>Add Money</h4>
                                <div class="mobile-rchge">
                                    <input type="text" placeholder="Enter amount" id="rechargeamount" name="amount" value="{{ old('amount') }}" required/>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </li>
                        <li style="display:table;margin-left:65px;">
                            <input id="singin-btn-wallet" type="submit" class="submit" value="Add Money"/>
                        </li>
                    </ol>
                </form>
            </div>
        @endif
    </div>
</div>
<!-- /tab6 -->