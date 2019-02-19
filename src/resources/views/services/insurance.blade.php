<!-- tab8 -->
<div>
    <i class="icon fa fa-tint inner-icon" aria-hidden="true"></i>
    <div id="tab2" class="tab-grid">
        <div class="login-form">
            <form action="/mobilerechargemiddle" method="post" class="signup">
                <input type="hidden" name="type" value="Insurance"/>

                <ol>
                    <li>
                        <div class="agileits-select">
                            <select class="selectpicker show-tick" name="oprator" data-live-search="true">
                                <option data-tokens="Water Provider">Service provider</option>
                                @foreach(App\models\Insuranceoperator::all() as $operator)
                                    <option name="{{ $operator->slug }}">{{$operator->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                    <li>
                        <input type="text" class="customer" name="tel" value="Policy No." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Policy No.';}"
                               required="">
                    </li>
                    <li>
                    <li>
                        <input type="date" class="customer" value="Date of Birth" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Date of Birth';}"
                               required="">
                    </li>
<li>
                        <input type="text" name="amount" class="customer" value="Bill Amount" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Bill Amount';}"
                               required="">
                    </li>

                    <li>
                        <input type="submit" class="submit" value="Proceed"/>
                    </li>
                </ol>
            </form>

        </div>
    </div>
</div>
<!-- /tab8 -->