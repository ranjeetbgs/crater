<table>
                    
                    <tr>
                        <td class="attribute-label">@lang('pdf_invoice_number')</td>
                        <td class="attribute-value"> &nbsp;{{$invoice->invoice_number}}</td>
                    </tr>
                    <tr>
                        <td class="attribute-label">@lang('pdf_invoice_date')</td>
                        <td class="attribute-value"> &nbsp;{{$invoice->formattedInvoiceDate}}</td>
                    </tr>
                    <tr>
                        <td class="attribute-label">@lang('pdf_invoice_due_date')</td>
                        <td class="attribute-value"> &nbsp;{{$invoice->formattedDueDate}}</td>
                    </tr>
                    @if(@$invoice->meta->challan_number)
                    <tr>
                        <td class="attribute-label">Challan No</td>
                        <td class="attribute-value"> &nbsp;{{@$invoice->meta->challan_number}}</td>
                    </tr>
                    @endif

                    @if(@$invoice->meta->delivery_date)
                    <tr>
                        <td class="attribute-label">Delivery Date</td> 
                        <td class="attribute-value"> &nbsp;{{formatDate( $invoice->company->id, @$invoice->meta->delivery_date)}}</td>
                    </tr>
                    @endif
                    @if(@$invoice->meta->po_number)
                    <tr>
                        <td class="attribute-label">P.O No</td>
                        <td class="attribute-value"> &nbsp;{{@$invoice->meta->po_number}}</td>
                    </tr>
                    @endif

                    
                    @if(hasTransportOption($invoice->company->id))

                    @if(@$invoice->meta->e_way_number)

                    <tr>
                        <td class="attribute-label">E way No</td>
                        <td class="attribute-value"> &nbsp;{{@$invoice->meta->e_way_number}}</td>
                    </tr>

                    @endif
                    @if(@$invoice->meta->transport_name)

                    <tr>
                        <td class="attribute-label">Transport Name</td>
                        <td class="attribute-value"> &nbsp;{{@$invoice->meta->transport_name}}</td>
                    </tr>

                    @endif
                    @if(@$invoice->meta->vehicle_number)

                    <tr>
                        <td class="attribute-label">Vehicle Number</td>
                        <td class="attribute-value"> &nbsp;{{@$invoice->meta->vehicle_number}}</td>
                    </tr>
                    @endif
                    @if(@$invoice->meta->gr_number)

                    <tr>
                        <td class="attribute-label">GR/LR No</td>
                        <td class="attribute-value"> &nbsp;{{@$invoice->meta->gr_number}}</td>
                    </tr>
                    @endif
                    @endif
                    
</table>