<!-- tab3 -->
<div>
    <i class="icon fa fa-credit-card inner-icon" aria-hidden="true"></i>
    <div id="tab2" class="tab-grid">
        <div class="login-form">
            <form action="/mobilerechargemiddle" method="post" class="signup">
                {{ csrf_field() }}

                <input type="hidden" name="type" value="Datacard"/>
                <ol>
                    <li>
                        <h4>Enter your Datacard number</h4>
                        <input type="tel" class="tel" name="tel" pattern="\d{10}" placeholder="Enter Datacard Number"
                            required />
                        <p class="validation01">
                            <span class="invalid">Please enter a valid 10 digit Datacard number</span>
                            <span class="valid">That's what we wanted!</span>
                        </p>
                    </li>
                    <li>
                        <div class="agileits-select">
                            <select class="selectpicker show-tick" name="oprator" data-live-search="true">
                                <option data-tokens="Select Operator">Select Operator</option>
                                @foreach(App\models\Datacardoperator::all() as $operator)
                                    <option value="{{ $operator->opcode }}">{{$operator->name}}</option>
                                @endforeach                                
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="mobile-right ">
                            <h4>How Much To Pay?</h4>
                            <div class="mobile-rchge">
                                <input type="text" placeholder="Enter amount" name="amount" required="required" />
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </li>
                    <li>
                        @if(Auth::user())
                        <input type="submit" id="prepaidbutton" class="submit" value="Recharge Now" />
                        @elseif(!Auth::user())
                        <input type="submit"  id = "singin-btn-datacard" class="submit" value="Recharge Now" />
                        @endif
                    </li>
                </ol>
            </form>

        </div>

    </div>
</div>
<!-- /tab3 -->