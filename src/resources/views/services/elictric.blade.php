<!-- tab4 -->
<div>
    <i class="icon fa fa-lightbulb-o inner-icon" aria-hidden="true"></i>
    <div id="tab2" class="tab-grid">
        <div class="login-form">
            <form action="/mobilerechargemiddle" method="post" class="signup" >
                <input type="hidden" name="type" value="Electricity"/>

                <ol>
                    <li>
                        <div class="agileits-select">
                            <select class="selectpicker show-tick" name="oprator" data-live-search="true">
                                <option data-tokens="Select Operator">Select Operator</option>
                                @foreach(App\models\Electricityoperator::all() as $operator)
                                    <option value="{{ $operator->opcode }}">{{$operator->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                    <li>
                        <input type="text" name="tel" class="customer"  placeholder="Customer Account Number" required="">
                    </li>

                    <li>
                        @if(Auth::user())
                        <input type="submit" id="prepaidbutton" class="submit" value="Proceed" />
                        @elseif(!Auth::user())
                        <input type="submit"  id = "singin-btn-electricity" class="submit" value="Proceed" />
                        @endif
                    </li>
                </ol>
            </form>

        </div>
    </div>
</div>
<!-- /tab4 -->