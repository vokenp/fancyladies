<div class="row mt-2">
    <div class="form-group mr-3">
        <div class="radio-inline">
            <label class="radio radio-square">
                <input type="radio" checked="checked" name="CustSentTo" class="CustSentTo" value="All" />
                <span></span>
                All Customers
            </label>
            <label class="radio radio-square">
                <input type="radio" name="CustSentTo" class="CustSentTo" value="Specific" />
                <span></span>
                Specific Customers
            </label>
        </div>
    </div>
    </div>
    <div class="row" id="CustSpecific" style="display:none;">
        <div class="form-group ">
            <div class="col-md-12"><label>Choose a Specific Customer Below:</label></div>
            <div class="col-md-12">
            <select name="ShopCustomers[]" id="ShopCustomers" class="chzn-select" multiple="multiple" style="width: 40em">          
                @foreach($ShopCustomers as $list)
                <option value="{{ $list->id }}" >{{ $list->customer_name.'('.$list->customer_phoneno.')' }}</option>
                @endforeach
                </select>
            </div>
        </div>
      
    </div>