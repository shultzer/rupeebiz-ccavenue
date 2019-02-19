<!-- tab8 -->
<div>
    <i class="icon fa fa-tint inner-icon" aria-hidden="true"></i>
    <div id="tab2" class="tab-grid">
        <div class="login-form">
            <form action="/mobilerechargemiddle" method="post" class="signup">
                {{ csrf_field() }}

                <input type="hidden" name="type" value="DTH Connection"/>

                <ol>
                    <li>
                        <div class="agileits-select">
                            <select class="selectpicker show-tick" name="oprator" data-live-search="true">
                                <option data-tokens="Water Provider">Service provider</option>
                                @foreach(App\models\Dthconnectionoperator::all() as $operator)
                                    <option value="{{ $operator->opcode }}">{{$operator->name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="agileits-select">
                            <select class="selectpicker show-tick" data-live-search="true">
                                <option data-tokens="Water Provider">SET TOP BOX</option>
                                <option data-tokens="Provider1">Provider1</option>

                            </select>
                        </div>
                    </li>
                     <li>
                        <div class="agileits-select">
                            <select class="selectpicker show-tick" data-live-search="true">
                                <option data-tokens="Water Provider">PACKAGE</option>
                                <option data-tokens="Provider1">Provider1</option>

                            </select>
                        </div>
                    </li>
                    <li>
                        <input type="text" class="customer" value="Full Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Full Name';}"
                               required="">
                    </li>
                    <li>
                    <li>
                        <input type="text" name="tel" class="customer" value="Mobile No." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Mobile No.';}"
                               required="">
                    </li>
                    <li>
                        <input type="text" class="customer" value="PIN CODE" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'PIN CODE';}"
                               required="">
                    </li>
                    <li>
                        <input type="text" class="customer" value="Installation Address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Installation Address';}"
                               required="">
                    </li>
                    <li>
                        <input type="text" class="customer" name="amount" value="PRICE" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'PRICE';}"
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