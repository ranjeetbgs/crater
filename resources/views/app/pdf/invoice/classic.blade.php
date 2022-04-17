<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>invoice</title>
      <style>
         body {
            font-family: "DejaVu Sans";
            
            font-size: 12px;
        }
        td,th{padding:2px 5px;}

        .attribute-label {
            font-size: 12px;
            line-height: 15px;
            text-align: left;
            color: #333;
        }

        .attribute-value {
            font-size: 12px;
            line-height: 15px;
            text-align: right;
        }
        .item-table-heading-row{background-color: rgb(219, 219, 255);}
        .item-cell-table-hr{display: none;}

         .td2{
         width: 250px;
         margin-left: 10%;
         padding-left: 0%; 
         }
         .td3{
         text-align: right;
         width: 220px;
         font-size: 100%;
         margin: 5%;
         }
         .tax{
         text-align: center;
         color: blue;
         font-weight: bold;
         font-size: 20px; 
         }
         .table2 ,#t2, .items-table, .items-table th, .items-table td {
         border: 1px solid  #0330f8;
         border-collapse: collapse;
         }
         
         .righttext{
            text-align: right;
         }


          /* -- Total Display Table -- */

        .total-display-table, .total-display-table td {
             /* border-top: none; */
             border: 1px solid  #0330f8;
         border-collapse: collapse;
            page-break-inside: avoid;
            page-break-before: auto;
            page-break-after: auto;
            margin-top: 20px;
            float: right;
            width: auto;
        }

        .total-table-attribute-label {
            font-size: 12px;
            
            text-align: left;
            padding-left: 10px;
        }

        .total-table-attribute-value {
            font-weight: bold;
            text-align: right;
            font-size: 12px;
            padding-right: 10px;
        }

        .total-border-left {
         border: 1px solid  #0330f8;
         border-collapse: collapse;
            border-right: 0px !important;
            padding-top: 0px;
            padding: 8px !important;
        }

        .total-border-right {
         border: 1px solid  #0330f8;
         border-collapse: collapse;
            border-left: 0px !important;
            padding-top: 0px;
            padding: 8px !important;
        }

        /* -- Notes -- */
        .notes {
         
            font-size: 12px;
            color: #595959;
            margin-top: 15px;
            width: 442px;
            text-align: left;
            page-break-inside: avoid;
        }

        .notes-label {
            font-size: 15px;
            line-height: 22px;
            letter-spacing: 0.05em;
            width: 108px;
            white-space: nowrap;
            height: 19.87px;
            padding-bottom: 10px;
        }

        /* -- Helpers -- */

        

        .text-center {
            text-align: center
        }

        table .text-left {
            text-align: left;
        }

        table .text-right {
            text-align: right;
        }

        .border-0 {
            border: none;
        }

        .py-2 {
            padding-top: 2px;
            padding-bottom: 2px;
        }

        .py-8 {
            padding-top: 8px;
            padding-bottom: 8px;
        }

        .py-3 {
            padding: 3px 0;
        }

        .pr-20 {
            padding-right: 20px;
        }

        .pr-10 {
            padding-right: 10px;
        }

        .pl-20 {
            padding-left: 20px;
        }

        .pl-10 {
            padding-left: 10px;
        }

        .pl-0 {
            padding-left: 0;
        }

      </style>
   </head>
   <body>
     
         <table style="width:100%; margin-bottom:10px;">
            <tr valign="top">
               <td > 
               @if($logo)
                    <img class="header-logo" style="height: 50px;" src="{{ $logo }}" alt="Company Logo">
                    @else
                    <h1 class="header-logo"> {{$invoice->customer->company->name}} </h1>
                    @endif
            </td>
             
               <td style="text-align:right;">
               {!! $company_address !!} 
                  
               </td>
            </tr>
         </table>


         
      
     
      <table class="table2" style="border-bottom:none;">
         <tr >
            <th id="t2" style="text-align: left; width:35%;  ">
            @if(@$invoice->company->gst)
                GSTIN: {{$invoice->company->gst}}
                @endif
             </th>
            <th  class="tax">
            {{@$invoice->meta->invoice_type}}
            </th>
            <th id="t2">Original / Duplicate / Triplicate</th>
         </tr>
         <tr>
            <td id="t2" ><b>Details of Buyer</b> </td>
            <td id="t2"><b>Details of Consignee</b> </td>
            <td id="t2" rowspan="2" valign="top">
            @include('app.pdf.invoice.partials.invoice-details')
            </td>
         </tr>
         <tr>
            <td id="t2">
            <div class="billing-address-container billing-address">
                    @if($billing_address)
                        <b>@lang('pdf_bill_to')</b> <br>
                        {!! $billing_address !!}
                        @if(@$invoice->customer->gst)
                        GSTIN: {{$invoice->customer->gst}}
                        @endif
                        @if(@$invoice->customer->pan)
                        <br>
                        PAN: {{$invoice->customer->pan}}<br>
                        @endif
                        Place of supply: {{$invoice->customer->billingAddress->state}} ({{getStateCode($invoice->customer->billingAddress->state)}})
                    
                    @endif
                </div>
              
            </td>
            <td id="t2" valign="top">
            <div @if($billing_address !== '</br>') class="shipping-address-container shipping-address" @else class="shipping-address-container--left shipping-address" @endif>
                    @if($shipping_address)
                        <b>@lang('pdf_ship_to')</b> <br>
                        {!! $shipping_address !!}
                        Place of supply: {{$invoice->customer->billingAddress->state}} ({{getStateCode($invoice->customer->billingAddress->state)}})
                    
                    @endif
                </div>
            </td>
         </tr>
         <tr>
            <td colspan="3" style="height: 14px;"></td>
         </tr>
      </table>



      @include('app.pdf.invoice.partials.table')
      

      <div class="notes">
            @if($notes)
                <p><b>
                    @lang('pdf_notes')
    </b></p>

                {!! $notes !!}
            @endif
        </div>
      
   </body>
</html>