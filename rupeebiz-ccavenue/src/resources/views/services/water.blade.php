<!-- tab8 -->
<div>
    <i class="icon fa fa-tint inner-icon" aria-hidden="true"></i>
    <div id="tab2" class="tab-grid">
        <div class="login-form">
            <form action="pay.html" method="post" class="signup">
                <input type="hidden" name="type" value="Water Bill"/>
                <ol>
                    <li>
                        <div class="agileits-select">
                            <select class="selectpicker show-tick" data-live-search="true" required>
                                <option value="" hidden>Water Provider</option>
                                @foreach(\App\models\Waterbilloperator::all() as $provider)
                                    <option data-tokens="{{$provider->opcode}}" value="{{$provider->opcode}}">{{$provider->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                    <li>
                        <input type="text" class="customer" placeholder="Consumer Number" required>
                    </li>

                    <li>

                        @if(Auth::user())
                            <input type="submit" id="prepaidbutton" class="submit" value="Proceed"/>
                        @elseif(!Auth::user())
                            <input type="submit" id="singin-btn-water" class="submit" value="Proceed"/>
                        @endif
                    </li>
                </ol>
            </form>

        </div>
    </div>
</div>
<!-- /tab8 -->