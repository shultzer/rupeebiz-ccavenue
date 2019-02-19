<!-- tab5 -->
<div>

    <i class="icon fa fa-phone inner-icon" aria-hidden="true"></i>
    <div id="tab2" class="tab-grid">
        <div class="login-form">
            <form action="/mobilerechargemiddle" method="post" class="signup">
                <input type="hidden" name="type" value="Landline"/>

                <ol>
                    <li>
                        <div class="agileits-select">
                            <select class="selectpicker show-tick" name="oprator" data-live-search="true">
                                <option data-tokens="Select Operator">Select Operator</option>
                                @foreach(App\models\Landlineoperator::all() as $operator)
                                    <option name="{{ $operator->slug }}">{{$operator->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                    <li>
                        <input type="text" class="tel" name="tel"  placeholder="Telephone Number(with STD code)" required="">
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
                        <input type="submit" id="prepaidbutton" class="submit" value="Pay Bill" />
                        @elseif(!Auth::user())
                        <input type="submit"  id = "singin-btn-landline" class="submit" value="Pay Bill" />
                        @endif
                    </li>
                </ol>
            </form>

        </div>
    </div>

</div>
<!-- /tab5 -->