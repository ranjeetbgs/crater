<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>invoice</title>
      <style>
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
         .table2 ,#t2 {
         border: 1px solid  #0330f8;
         border-collapse: collapse;
         }
         td, th{
            padding: 2px;
         }
         .righttext{
            text-align: right;
         }
      </style>
   </head>
   <body>
      <div>
         <table style="font-family: 'Rubik', sans-serif; font-size: 80%; width:100%; ">
            <tr>
               <td> 
               @if($logo)
                    <img class="header-logo" style="height: 50px;" src="{{ $logo }}" alt="Company Logo">
                    @else
                    <h1 class="header-logo"> {{$invoice->customer->company->name}} </h1>
                    @endif
            </td>
               <td class="td2"  style="font-size: 90%;">
                  <b style="font-size: 22px;">company <br>
                  </b>
                  <p style="font-size: 100%;"> {!! $company_address !!} <br></p>
               </td>
               <td class="td3"  style="font-size: 90%;">
                  <p>
                     <b>Phone:</b>9897654567 <br>
                     <b>Email:</b>skdjf@test.on
                  </p>
               </td>
            </tr>
         </table>
      </div>
     
      <table class="table2" style="width:100%; font-family: 'Rubik', sans-serif; font-size: 80%;">
         <tr >
            <th id="t2" style="text-align: left; width:35%;  ">GSTIN :  19AAICC2277J1ZB </th>
            <th id="t2" class="tax">
               TAX INVOICE
            </th>
            <th id="t2" style="font-size:90%">ORIGINAL FOR RECIPIENT</th>
         </tr>
         <tr style="font-size: 90%;">
            <td id="t2" ><b>Details of Buyer | Billed to :</b> </td>
            <td id="t2"><b>Details of Consignee | Shipped to :</b> </td>
            <td id="t2" rowspan="2" >
               <table>
                  <tr>
                     <td>Invoice No.</td>
                     <td><b>121212</b> </td>
                  </tr>
                  <tr>
                     <td>Invoice Date</td>
                     <td>{{$invoice->formattedInvoiceDate}}</td>
                     
                  </tr>
                  <tr>
                     <td>Due Date</td>
                     <td>{{$invoice->formattedDueDate}}</td>
                  </tr>
                  <tr>
                     <td>Challan No.</td>
                     <td>102</td>
                  </tr>
                  <tr>
                     <td>Delivary Date</td>
                     <td>07-Jan-2022</td>
                  </tr>
                  <tr>
                     <td>P.O. No.</td>
                     <td>123</td>
                  </tr>
                  <tr>  
                     <td>P.O. Date </td>
                     <td>07-Jan-2022</td>
                  </tr>
                  <tr>
                     <td>E-Way No.</td>
                     <td>123</td>
                  </tr>
                  <tr>
                     <td>Trans. Mode</td>
                     <td>Hand Delivery</td>
                  </tr>
                  <tr>
                     <td>Vehicle Number  </td>
                     <td>7894</td>
                  </tr>
                  <tr>
                     <td>L.R. No. </td>
                     <td>5645</td>
                  </tr>
               </table>   <br>
                 
            </td>
         </tr>
         <tr  style="font-size: 90%;">
            <td id="t2">
              <table>
                 <tr>
                    <td><b>Name</b></td>
                    <td>dfsdf</td>
                 </tr>
                 <tr>
                  <td><b>Address</b></td>
                  <td>sdf sdf sdf sdfsdf sdf sdf sdf sdf</td>
                 </tr>
                 <tr>
                  <td><b>Phone -2323233423</b></td>
                 </tr>
                 <tr>
                    <td><b>GSTIN</b></td>
                    <td>19AAQCS4834H2ZS</td>
                 </tr>
                 <tr>
                    <td><b>PAN</b></td>
                    <td>sdf23232sdf</td>
                 </tr>
                 <tr>
                    <td><b>Place of
                     Supply</b></td>
                     <td> West Bengal ( 19 )</td>
                 </tr>
              </table>   
              
            </td>
            <td id="t2">
               <table >
                  <tr>
                     <td><b>Name</b></td>
                     <td>sdfd sdf</td>
                  </tr>
                  <tr>
                     <td><b>Address</b></td>
                     <td>sdf sdf sdf</td>
                  </tr>
                  <tr>
                     <td><b>Phone -2323233233</b></td>
                  </tr>
                  <tr>
                     <td><b>GSTIN -</b></td>
                  </tr>
                  <tr>
                     <td><b>State</b></td>
                     <td>West Bengal ( 19 )</td>
                  </tr>
               </table>
                 
                
            </td>
         </tr>
         <tr>
            <td colspan="3" style="height: 14px;"></td>
         </tr>
      </table>
         <table class="table2" style="width:100%; font-family: 'Rubik', sans-serif; font-size: 90%;">
            
            <tr style="background-color: rgb(219, 219, 255)">
               <th id="t2" rowspan="2" style="width: 7px">Sr.
                  No
               </th>
               <th id="t2" rowspan="2" style="width: 180px">Name of Product / Service</th>
               <th id="t2" rowspan="2">HSN / SAC</th>
               <th id="t2" rowspan="2">Qty</th>
               <th id="t2" rowspan="2">Rate</th>
               <th id="t2" rowspan="2">Taxable Value</th>
               <th id="t2" colspan="2">CGST</th>
               <th id="t2" colspan="2">SGST</th>
               <th id="t2" rowspan="2">Total</th>
            </tr>
            <tr style="background-color: rgb(219, 219, 255)">
               <td id="t2" >%</td>
               <td id="t2" >amount</td>
               <td id="t2">%</td>
               <td id="t2">amount</td>
            </tr>
             
            
            
            <tr style="vertical-align: top; min-height: 40px; " >
               <td id="t2"  >1</td>
               <td id="t2">dfdsfgdfgdfgdfg </td>
               <td id="t2" class="righttext">dfsdfsdf</td>
               <td id="t2" class="righttext">1tg</td>
               <td id="t2" class="righttext" > 234234</td>
               <td id="t2" class="righttext" style="background-color: rgb(219, 219, 255)">23%</td>
               <td id="t2" class="righttext">455</td>
               <td id="t2" class="righttext">33</td>
               <td id="t2" class="righttext">44</td>
               <td id="t2" class="righttext">33</td>
               <td id="t2" class="righttext"> 765675</td>
            </tr>
           
            <tr style="background-color: rgb(219, 219, 255)">
               <td id="t2" colspan="3" style="text-align: right; height:14px;"><b>Total</b> </td>
               <td id="t2">1.00</td>
               <td id="t2"></td>
               <td id="t2" style="text-align: right;"><b>877657</b></td>
               <td id="t2"></td>
               <td id="t2"  style="text-align: right;"><b>45.00</b></td>
               <td id="t2"></td>
               <td id="t2"  style="text-align: right;"><b>45.00</b></td>
               <td id="t2" style="text-align: right;"><b>33423</b></td>
            </tr>
            <tr>
               <td colspan="11" style="height: 14px;"></td>
            </tr>
            <tr>
               <td  id="t2"style="text-align: center;" colspan="6"><b>Total in words
                  </b>
               </td>
               <td id="t2" style="height: 14px; background-color: rgb(219, 219, 255)" colspan="5"><b style="text-align: left; ">Taxable Amount </b><b style="float: right;">500.00</b></td>
            </tr>
            <tr>
               <td id="t2" style="text-align: center;" colspan="6" rowspan="2">FIVE HUNDRED AND NINETY RUPEES ONLY</td>
               <td id="t2" style="height: 14px;" colspan="5"><b style="text-align: left;">Add : CGST</b><b style="float: right;">dfg</b></td>
            </tr>
            <tr>
               <td id="t2" style="height: 14px;" colspan="5"><b style="text-align: left;">Add : SGST </b><b style="float: right;"> 234</b></td>
            </tr>
            <tr>
               <td id="t2" style="text-align: center;" colspan="6" ><b>Bank Details</b></td>
               <td id="t2" style="height: 14px; background-color: rgb(219, 219, 255)" colspan="5"><b style="text-align: left;">Total Tax </b><b style="float: right;"> 234234</b></td>
            </tr>
            <tr>
               <td id="t2" rowspan="3" colspan="6">Bank Name HDFC Bank <br>
                  Branch Name Contentlane Private Limited <br>
                  Bank Account Number 50200043290063 <br>
                  Bank Branch IFSC HDFC0000693
               </td>
               <td id="t2" colspan="5" style="background-color: rgb(219, 219, 255)"> <b style="text-align: left; ">Total Amount After Tax </b><b style="float: right;"> 590.00</b></td>
            </tr>
            <tr>
               <td id="t2" colspan="5"><b style="float: right;">(E & O.E.)</b>
               </td>
            </tr>
            <tr>
               <td id="t2" colspan="4"><b>GST Payable on Reverse Charge</b> </td>
               <td id="t2"  style="background-color: rgb(219, 219, 255);"><b> N.A.</b></td>
            </tr>
            <tr>
               <td id="t2" colspan="6" style="height: 20px; text-align: center;" ><b>Terms and Condition</b></td>
               <td id="t2" colspan="5" >
                  Certified that the particulars given above are true and correct. <br>
                  <h3>For Contentlane Private Limited</h3>
               </td>
            </tr>
            <tr>
               <td id="t2" colspan="6" rowspan="2" >Subject to our home Jurisdiction. <br>
                Our Responsibility Ceases as soon as goods leaves our Premises. <br>
                Goods once sold will not taken back. <br>
                Delivery Ex-Premises.
               </td>
               <td id="t2" colspan="5"></td>
            </tr>
            <tr>
               <td id="t2" style="text-align: center;" colspan="5"><b >Authorised Signatory</b></td>
            </tr>
         </table>
      
   </body>
</html>