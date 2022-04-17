<table width="100%" class="items-table" cellspacing="0" border="0">
    <tr class="item-table-heading-row">
        <th width="2%" class=" text-right item-table-heading">#</th>
        <th width="25%" class=" text-left item-table-heading">@lang('pdf_items_label')</th>
        @foreach($customFields as $field)
            <th class="text-right item-table-heading">{{ $field->label }}</th>
        @endforeach
        <th class="pr-20 text-right item-table-heading">@lang('pdf_hsn_sac_label')</th>
        <th class="pr-20 text-right item-table-heading">@lang('pdf_quantity_label')</th>
        <th class="pr-20 text-right item-table-heading">@lang('pdf_price_label')</th>
        @if($invoice->discount_per_item === 'YES')
        <th class="pl-10 text-right item-table-heading">@lang('pdf_discount_label')</th>
        @endif
        @if($invoice->tax_per_item === 'YES')
        <th class="pl-10 text-right item-table-heading">@lang('pdf_tax_label')</th>
        @endif
        <th class="text-right item-table-heading">@lang('pdf_amount_label')</th>
    </tr>
    @php
        $index = 1
    @endphp
    @foreach ($invoice->items as $item)
        <tr class="item-row">
            <td
                class=" text-right item-cell"
                style="vertical-align: top;"
            >
                {{$index}}
            </td>
            <td
                class=" text-left item-cell"
                style="vertical-align: top;"
            >
                <span>{{ $item->name }}</span><br>
                <span class="item-description">{!! nl2br(htmlspecialchars($item->description)) !!}</span>
            </td>
            @foreach($customFields as $field)
                <td class="text-right item-cell" style="vertical-align: top;">
                    {{ $item->getCustomFieldValueBySlug($field->slug) }}
                </td>
            @endforeach

            <td
                class="pr-20 text-right item-cell"
                style="vertical-align: top;"
            >
                {{$item->hsn_sac}} 
            </td>
            
            <td
                class="pr-20 text-right item-cell"
                style="vertical-align: top;"
            >
                {{$item->quantity}} @if($item->unit_name) {{$item->unit_name}} @endif
            </td>
            
            <td
                class="pr-20 text-right item-cell"
                style="vertical-align: top; min-width:100px;"
            >
                {!! format_money_pdf($item->price, $invoice->customer->currency) !!}
            </td>

            @if($invoice->discount_per_item === 'YES')
                <td
                    class="pl-10 text-right item-cell"
                    style="vertical-align: top;"
                >
                    @if($item->discount_type === 'fixed')
                            {!! format_money_pdf($item->discount_val, $invoice->customer->currency) !!}
                        @endif
                        @if($item->discount_type === 'percentage')
                            {{$item->discount}}%
                        @endif
                </td>
            @endif

            @if($invoice->tax_per_item === 'YES')
                <td
                    class="pl-10 text-right item-cell"
                    style="vertical-align: top; min-width:100px;"
                >
                @foreach($item->taxes as $tax)
                {{$tax->name}} @ {{$tax->percent}}% <br/>
                 {!! format_money_pdf($tax->amount, $invoice->customer->currency) !!} <br/>
                @endforeach
                   
                </td>
            @endif

            <td
                class="text-right item-cell"
                style="vertical-align: top; min-width:100px;"
            >
                {!! format_money_pdf($item->total, $invoice->customer->currency) !!}
            </td>
        </tr>
        @php
            $index += 1
        @endphp
    @endforeach
</table>

<hr class="item-cell-table-hr">

<div class="total-display-container">
    <table width="100%" cellspacing="0px" border="0" class="total-display-table @if(count($invoice->items) > 12) page-break @endif">
        <tr>
            <td class="border-0 total-table-attribute-label">@lang('pdf_subtotal')</td>
            <td class="py-2 border-0 item-cell total-table-attribute-value">
                {!! format_money_pdf($invoice->sub_total, $invoice->customer->currency) !!}
            </td>
        </tr>

        @if($invoice->discount > 0)
            @if ($invoice->discount_per_item === 'NO')
                <tr>
                    <td class="border-0 total-table-attribute-label">
                        @if($invoice->discount_type === 'fixed')
                            @lang('pdf_discount_label')
                        @endif
                        @if($invoice->discount_type === 'percentage')
                            @lang('pdf_discount_label') ({{$invoice->discount}}%)
                        @endif
                    </td>
                    <td class="py-2 border-0 item-cell total-table-attribute-value" >
                        @if($invoice->discount_type === 'fixed')
                            {!! format_money_pdf($invoice->discount_val, $invoice->customer->currency) !!}
                        @endif
                        @if($invoice->discount_type === 'percentage')
                            {!! format_money_pdf($invoice->discount_val, $invoice->customer->currency) !!}
                        @endif
                    </td>
                </tr>
            @endif
        @endif

        @if ($invoice->tax_per_item === 'YES')
            @foreach ($taxes as $tax_name => $tax_amount)
                <tr>
                    <td class="border-0 total-table-attribute-label">
                    {{$tax_name}} 
                    </td>
                    <td class="py-2 border-0 item-cell total-table-attribute-value">
                        {!! format_money_pdf($tax_amount, $invoice->customer->currency) !!}
                    </td>
                </tr>
            @endforeach
        @else
            @foreach ($invoice->taxes as $tax_name => $tax_amount)
                <tr>
                    <td class="py-2 border-0 total-table-attribute-label">
                        {{$tax_name}}
                    </td>
                    <td class="py-2 border-0 item-cell total-table-attribute-value">
                        {!! format_money_pdf($tax_amount, $invoice->customer->currency) !!}
                    </td>
                </tr>
            @endforeach
        @endif

       
        <tr>
            <td class="py-2 border-0 total-table-attribute-label">
                @lang('pdf_total')
            </td>
            <td
                class="py-2 border-0 item-cell total-table-attribute-value"
                
            >
                {!! format_money_pdf($invoice->total, $invoice->customer->currency)!!}
            </td>
        </tr>
        <tr>
            <td class="py-2 border-0 total-table-attribute-label">
                @lang('pdf_roundoff')
            </td>
            <td
                class="py-2 border-0 item-cell total-table-attribute-value"
                
            >
                 {!!format_money_pdf( round($invoice->total/100.00)*100 - $invoice->total) !!}
            </td>
        </tr>
        <tr>
            <td class="py-2 border-0 total-table-attribute-label">
                @lang('pdf_total_payable')
            </td>
            <td
                class="py-2 border-0 item-cell total-table-attribute-value"
                
            >
            
                {!! format_money_pdf(round($invoice->total/100)*100, $invoice->customer->currency)!!}
            </td>
        </tr>

        <tr>
            <td colspan="2"><div class="invoice-details-container attribute-label" style="margin-right:50px;margin-top:10px;">

                <p>For {{$invoice->company->name}}</p>
                    <br><br>

                <p>Authorised Signatory</p>

                </div> 
            </td>
        </tr>
    </table>

    
    
</div>

<div class="notes" style="text-transform: capitalize;">
        <p><b>Amount In Words</b></p>
        <p>{{amountInWords( round($invoice->total/100.00) )}}</p>
</div>


