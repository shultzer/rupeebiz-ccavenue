<!-- tab2 -->
<div>

    <div class="login-form">
        <i class="icon fa fa-television inner-icon" aria-hidden="true"></i>
        <form action="/mobilerechargemiddle" method="post" class="signup">
            {{ csrf_field() }}
            <ol>
                <li>
                    <div class="agileits-select" id="dth">
                        <select name="oprator" class="selectpicker show-tick" required>
                            <option value="" hidden>Service provider</option>
                            @foreach(App\models\Operator::all() as $operator)
                            <option value="{{ $operator->opcode }}">{{$operator->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </li>
                <li>
                    <input type="text" name="tel" class="customer" id="dthid"  Placeholder="Enter Customer ID" required/>
                </li>
                <li>
                    <div class="mobile-right ">
                        <div class="mobile-rchge">
                            <input type="text" placeholder="Enter amount" name="amount" required="required" />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </li>
                <input type="hidden" name="type" value="DTH"/>
                <li>
                    @if(Auth::user())
                    <input type="submit" id="prepaidbutton" class="submit" value="Recharge Now" />
                    @elseif(!Auth::user())
                    <input type="submit"  id = "singin-btn-dth" class="submit" value="Recharge Now" />
                    @endif
                </li>
            </ol>
        </form>

    </div>
</div>
<!-- /tab2 -->