<!-- tab7 -->
<div>

    <i class="icon fa fa-flask inner-icon" aria-hidden="true"></i>
    <div id="tab2" class="tab-grid">
        <div class="login-form">
            <form action="/mobilerechargemiddle" method="post" class="signup" >
                <input type="hidden" name="type" value="Gas"/>

                <ol>
                    <li>
                        <div class="agileits-select">
                            <select name="oprator" class="selectpicker show-tick" data-live-search="true">
                                <option data-tokens="Gas Operator">Gas Operator</option>
                                @foreach(App\models\Gasoperator::all() as $operator)
                                    <option name="{{ $operator->slug }}">{{$operator->name}}</option>
                                @endforeach                                {{--<option data-tokens="Operator2">Operator2</option>
                                <option data-tokens="Operator3">Operator3</option>
                                <option data-tokens="Operator4">Operator4</option>
                                <option data-tokens="Operator5">Operator5</option>
                                <option data-tokens="Operator6">Operator6</option>
                                <option data-tokens="Operator7">Operator7</option>--}}
                            </select>
                        </div>
                    </li>
                    <li>
                        <input type="text" class="customer" name="tel" placeholder="Customer Account Number" required>
                    </li>

                    <li>
                        @if(Auth::user())
                        <input type="submit" id="prepaidbutton" class="submit" value="Proceed" />
                        @elseif(!Auth::user())
                        <input type="submit"  id = "singin-btn-gas" class="submit" value="Proceed" />
                        @endif
                    </li>
                </ol>
            </form>

        </div>
    </div>
</div>
<!-- /tab7 -->