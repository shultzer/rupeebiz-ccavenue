<!-- tab1 -->
<div>
    <div class="tabs-box">
        <img src="images/mobile.png" class="w3ls-mobile" alt="" data-pin-nopin="true">
        <ul class="tabs-menu">
            <li><a href="#tab1"><label class="radio"><input type="radio" name="radio" checked=""><i></i>Prepaid</label></a>
            </li>
            <li><a href="#tab2"><label class="radio"><input type="radio" name="radio"><i></i>Postpaid</label></a></li>
        </ul>
        <div class="clearfix"></div>
        <div class="tab-grids">
            <div id="tab1" class="tab-grid">
                <div class="login-form">
                    <form method="post" action="/mobilerechargemiddle" class="signup" id="signup">
                        <input type="hidden" name="type" value="Prepaid"/>

                        <ol>
                            <li>
                                <h4>Enter your mobile number</h4>
                                {{ csrf_field() }}
                                <input type="tel" id="prepaidtel" class="tel" name="tel" pattern="\d{10}" placeholder="Enter Mobile Number"
                                       required/>
                                <p class="validation01">
                                    <span class="invalid">Please enter a valid mobile number</span>
                                    <span class="valid">That's what we wanted!</span>
                                </p>
                            </li>
                            <li>
                                <div class="agileits-select" id="prepaid">
                                    <select class="selectpicker" id="prepaidselect" name="oprator" data-live-search="true"
                                            required>
                                        <option value="" hidden>Select operator</option>
                                        @foreach(\App\models\Prepaidoperator::all() as $operator)
                                            <option value="{{ $operator->opcode }}">{{$operator->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="agileits-select" id="circle">
                                    <select class="selectpicker show-tick" data-live-search="true" id="prepaidcircle" required>
                                        <option value="" hidden>Select Circle</option>
                                        \
                                        <option data-tokens="Chennai">Chennai</option>
                                        <option data-tokens="Delhi NCR">Delhi NCR</option>
                                        <option data-tokens="Kolkata">Kolkata</option>
                                        <option data-tokens="Mumbai">Mumbai</option>
                                        <option data-tokens="Maharashtra & Goa">Maharashtra & Goa</option>
                                        <option data-tokens="Assam">Assam</option>
                                        <option data-tokens="Bihar & Jharkhand">Bihar & Jharkhand</option>
                                        <option data-tokens="Gujarat">Gujarat</option>
                                        <option data-tokens="Haryana">Haryana</option>
                                        <option data-tokens="Himachal Pradesh">Himachal Pradesh</option>
                                        <option data-tokens="Jummu & Kashmir">Jummu & Kashmir</option>
                                        <option data-tokens="Karnataka">Karnataka</option>
                                        <option data-tokens="Kerala">Kerala</option>
                                        <option data-tokens="Andhra Pradesh">Andhra Pradesh</option>
                                        <option data-tokens="MP & Chattisgarh">MP & Chattisgarh</option>
                                        <option data-tokens="North East">North East</option>
                                        <option data-tokens="Orissa">Orissa</option>
                                        <option data-tokens="Punjab">Punjab</option>
                                        <option data-tokens="Rajasthan">Rajasthan</option>
                                        <option data-tokens="Tamilnadu">Tamil Nadu</option>
                                        <option data-tokens="UP East">UP East</option>
                                        <option data-tokens="UP West & Utterkhand">UP West & Utterkhand</option>
                                        <option data-tokens="West Bengal">West Bengal</option>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="mobile-right ">
                                    <h4>How Much To Recharge?</h4>
                                    <div class="mobile-rchge">
                                        <input type="text" id="prepaidamount" placeholder="Enter amount" name="amount" required/>
                                    </div>
                                    <div class="mobile-rchge">
                                        <a href="plans.html">VIEW ALL PLANS</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </li>
                            <li>
                                @if(Auth::user())
                                    <input type="submit" id="prepaidbutton" class="submit" value="Recharge Now"/>
                                @elseif(!Auth::user())
                                    <input type="submit" id="singin-btn-mobile2" class="submit" value="Recharge Now"/>
                                @endif
                            </li>
                        </ol>
                    </form>

                </div>

            </div>

            <div id="tab2" class="tab-grid">
                <div class="login-form">
                    <form action="/mobilerechargemiddle" method="post">
                        <input type="hidden" name="type" value="Postpaid"/>
                        {{csrf_field()}}

                        <ol>
                            <li>
                                <h4>Enter your mobile number</h4>
                                <input type="tel" id="postpaidtel" class="tel" name="tel" pattern="\d{10}" placeholder="Enter Mobile Number"
                                       required/>
                                <p class="validation01">
                                    <span class="invalid">Please enter a valid mobile number</span>
                                    <span class="valid">That's what we wanted!</span>
                                </p>
                            </li>
                            <li>
                                <div class="agileits-select" id="postpaid">
                                    <select class="selectpicker show-tick" id="postpaidselect" name="oprator" data-live-search="true">
                                        <option value="" hidden>Select operator</option>
                                    @foreach(App\models\Postpaidoperator::all() as $operator)
                                            <option value="{{ $operator->opcode }}">{{$operator->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="agileits-select">
                                    <select class="selectpicker show-tick" data-live-search="true" id="postpaidcircle" required="required">
                                        <option data-tokens="Select Circle">Select Circle</option>
                                        <option data-tokens="Chennai">Chennai</option>
                                        <option data-tokens="Delhi NCR">Delhi NCR</option>
                                        <option data-tokens="Kolkata">Kolkata</option>
                                        <option data-tokens="Mumbai">Mumbai</option>
                                        <option data-tokens="Maharashtra & Goa">Maharashtra & Goa</option>
                                        <option data-tokens="Assam">Assam</option>
                                        <option data-tokens="Bihar & Jharkhand">Bihar & Jharkhand</option>
                                        <option data-tokens="Gujarat">Gujarat</option>
                                        <option data-tokens="Haryana">Haryana</option>
                                        <option data-tokens="Himachal Pradesh">Himachal Pradesh</option>
                                        <option data-tokens="Jummu & Kashmir">Jummu & Kashmir</option>
                                        <option data-tokens="Karnataka">Karnataka</option>
                                        <option data-tokens="Kerala">Kerala</option>
                                        <option data-tokens="Andhra Pradesh">Andhra Pradesh</option>
                                        <option data-tokens="MP & Chattisgarh">MP & Chattisgarh</option>
                                        <option data-tokens="North East">North East</option>
                                        <option data-tokens="Orissa">Orissa</option>
                                        <option data-tokens="Punjab">Punjab</option>
                                        <option data-tokens="Rajasthan">Rajasthan</option>
                                        <option data-tokens="Tamilnadu">Tamilnadu</option>
                                        <option data-tokens="UP East">UP East</option>
                                        <option data-tokens="UP West & Utterkhand">UP West & Utterkhand</option>
                                        <option data-tokens="West Bengal">West Bengal</option>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="mobile-right ">
                                    <h4>How Much To Pay?</h4>
                                    <div class="mobile-rchge">
                                        <input type="text" placeholder="Enter amount" id="postpaidamount" name="amount" required="required"/>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </li>
                            <li>
                                @if(Auth::user())
                                    <input type="submit" id="prepaidbutton" class="submit" value="Pay bill"/>
                                @elseif(!Auth::user())
                                    <input type="submit" id="singin-btn-mobile" class="submit" value="Pay bill"/>
                                @endif
                            </li>
                        </ol>
                    </form>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

</div>
<!-- /tab1 -->