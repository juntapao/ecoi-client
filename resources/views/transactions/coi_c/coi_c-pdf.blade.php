@include('includes.tcpdf_includes')
<style>
    table,td,th{
        font-size:8px;
        font-family: Arial, Helvetica, sans-serif;
    }
    .tb1{
        border:2px solid black;
    }
    table.tb4 td{
        text-align: center;
        font-size: 8px;
    }
    table.tb5, td{
        text-align: left;
    }
    .font10{
        font-size: 10px;
    }
    .font10 th{
        border:1px solid black;
    }
    .bord td,th{
        border:1px solid black;
        text-align: center;
    }
    
</style>
<div class="container">
    <table class="tb1" style="font-size:8px;">
        <tr class="font10">
            <td width="25%"></td>
            <td align="center" width="30%"></td>
            <td  width="45%" align="right" style="font-size:10px">
                <br><br>
                {{-- <strong>MAAGAP Insurance, Inc.</strong> --}}
            </td>
        </tr>
        <tr><td></td></tr>
        <tr class="font10">
            <td width = "100%" align="center" style="font-size:13px">
                <strong>CONFIRMATION OF INSURANCE</strong>
            </td>
        </tr>
        <tr><td></td></tr>
        <tr class="font10">
            <td width = "5%"></td>
            <td width = "30%" align="left">Confirmation of Insurance Number</td>
            <td width = "10%">:</td>
            <td width = "50%">C<strong>{{$transaction->coi_number}}</strong></td>
        </tr>
        <tr class="font10">
            <td width = "5%"></td>
            <td width = "30%" align="left">Principal Insured</td>
            <td width = "10%">:</td>
            <td width = "50%">{{$transaction->insured_name}}</td>
        </tr>
        <tr class="font10">
            <td width = "5%"></td>
            <td width = "30%" align="left">Group Policy Holder</td>
            <td width = "10%">:</td>
            <td width = "50%"><strong>ML CUSTOMER PROTECT 20</strong></td>
        </tr>
        <tr class="font10">
            <td width = "5%"></td>
            <td width = "30%" align="left">Group Policy Number</td>
            <td width = "10%">:</td>
            <td width = "50%">{{$transaction->policy_number}}</td>
        </tr>
        <tr class="font10">
            <td width = "5%"></td>
            <td width = "30%" align="left">Number of Units</td>
            <td width = "10%">:</td>
            <td width = "50%"><strong>( {{ $transaction->units }} )</strong></td>
        </tr>
        <tr><td></td></tr>
        <tr class="font10 bord">
            <th width = "5%" style="border:none;"></th>
            <th width = "50%"></th>
            <th width = "17%" style="font-size:10px;">Principal</th>
        </tr>
        <tr class="font10 bord">
            <td width = "5%" style="border:none;"></td>
            <td width = "50%" align="left">Accidental Death</td>
            <td width = "17%">PHP {{$holder['accident_principal']}}</td>
        </tr>
        <tr class="font10 bord">
            <td width = "5%" style="border:none;"></td>
            <td width = "50%" align="left">Dismemberment / Permanent Disability - due to accident</td>
            <td width = "17%">PHP {{$holder['dismemberment']}}</td>
        </tr>
        <tr class="font10 bord" >
            <td width = "5%" style="border:none;"></td>
            <td width = "50%" align="left">Unprovoked Murder & Assault</td>
            <td width = "17%">PHP {{$holder['unprovoked_principal']}}</td>
        </tr>
        <tr class="font10 bord">
            <td width = "5%" style="border:none;"></td>
            <td width = "50%" align="left">Motorcycling cover - due to accidental death</td>
            <td width = "17%">PHP {{$holder['motor_principal']}}</td>
        </tr>
        <tr class="font10 bord">
            <td width = "5%" style="border:none;"></td>
            <td width = "50%" align="left">Burial Benefit due to accident</td>
            <td width = "17%">PHP {{$holder['burial_principal']}}</td>
        </tr>
        <tr class="font10 bord">
            <td width = "5%" style="border:none;"></td>
            <td width = "50%" align="left">Medical Reimbursement - due to accident</td>
            <td width = "17%">PHP {{$holder['medical_reimbursement']}}</td>
        </tr>
        {{--  <tr class="font10 bord">
            <td width = "5%" style="border:none;"></td>
            <td width = "40%" align="left">Educational Assistance as a result of:</td>
            <td width = "17%"></td>
        </tr> --}}
        {{-- <tr class="font10 bord">
            <td width = "5%" style="border:none;"></td>
            <td width = "40%" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Accidental Death</td>
            <td width = "17%">PHP {{$holder['accidental']}}</td>
        </tr>
        <tr class="font10 bord">
            <td width = "5%" style="border:none;"></td>
            <td width = "40%" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Death due to Sickness</td>
            <td width = "17%">PHP {{$holder['sickness']}}</td>
        </tr> --}}
        <tr><td></td></tr>
        <tr class="font10"> 
            <td width = "5%"></td>
            <td width = "30%">Period of Insurance</td>
            <td width = "10%">:</td>
            <td width = "55%">{{ $transaction->date_issued->format('F d, Y') }} to {{ $transaction->date_issued->addMonth()->format('F d, Y') }}</td>
        </tr>    
        <tr class="font10">
            <td width = "5%"></td>
            <td width = "30%">Total Premium</td>
            <td width = "10%">:</td>
            <td width = "55%">PHP {{ number_format(($transaction->price * intval($transaction->units)), 2)}}</td>
        </tr>
        <tr><td></td></tr>
        <tr class="font8">
            <td width = "5%"></td>
            <td width = "90%" style="text-align: justify;">This certifies that the person named in this certificate is covered under the Master Policy issued by MAAGAP Insurance, Inc.  subject to the terms and conditions, warranties and clauses, including exceptions of the policy and all claims will be adjusted in accordance therewith.  This serves as evidence and receipt of your premium payment.</td>
            <td width = "5%"></td>
        </tr>
        <tr><td></td></tr>
        <tr>
            <td width="10%"></td>
            <td width="30%" style="border-bottom:1px solid black;"></td>
            <td width="5%"></td>
            <td width="40%"></td>
            <td width="10%"></td>
        </tr>
        <tr class="font8">
            <td width="5%"></td>
            <td width="40%" align="center">Signature of Insured</td>
            <td width="5%"></td>
            <td width="40%" align="center" style="text-decoration: overline;"><strong>@if($transaction->date_issued->lt(Carbon\Carbon::parse('6/1/2023'))) DANIEL C. GO @else MARTIN L. DELA ROSA @endif</strong></td>
            <td width="10%"></td>
        </tr>
        <tr class="font8">
            <td width="5%"></td>
            <td width="40%" align="center">Date of Issuance: {{ $transaction->date_issued ? Carbon\Carbon::parse($transaction->date_issued)->format('M d, Y') : null }} </td>
            <td width="5%"></td>
            <td width="40%" align="center">President & CEO</td>
            <td width="10%"></td>
        </tr>
        <tr>
            <td width="5%"></td>
            <td width="40%"></td>
            <td width="5%"></td>
            <td width="40%" align="center">MAAGAP Insurance, Inc.</td>
            <td width="10%"></td>
        </tr>
        <tr><td></td></tr>
        <tr>
            <td width="5%"></td>
            <td><u>COVERAGE A – ACCIDENTAL DEATH BENEFIT</u></td>
        </tr>
        <tr>
            <td width="5%"></td>
            <td width="90%"><p style="font-size:8px;">When injury results in loss of a Named insured within one hundred eighty (180) days after the date of the accident the Company will pay the principal Sum.</p></td>
            <td width="5%"></td>
        </tr>
        <tr><td></td></tr>
        <tr>
            <td width="5%"></td>
            <td width="90%"><u>COVERAGE B - PERMANENT LOSS OF USE OR DISABLEMENT AND DISMEMBERMENT BENEFIT</u></td>
            <td width="5%"></td>
        </tr>
        <tr>
            <td width="5%"></td>
            <td width="90%" align="justify"><p style="font-size:8px;">If within 180 days from the date of the accident, such injuries shall result in loss of life or any of the following loss, the Company will pay based on the schedule of indemnity. This schedule of indemnity is available upon request.<br />With respect to Coverage A & B, the aggregate benefits payable in respect of any one accident resulting in losses within 180 days from the date of accident shall not exceed the Principal Sum. However, any partial benefit already paid for any losses shall not be carried over in the subsequent policy years.</p>
                <p style="font-size:8px;">In any policy year, the aggregate benefits payable under Coverage B in respect of one or more accidents resulting in losses within 180 days from the date of accident shall not exceed the Principal Sum. For subsequent accident resulting in losses which would make the aggregate benefits exceed the Principal Sum, the amount payable under Coverage B shall be the Principal Sum less the amounts paid for previous losses. However, the payment of the Principal Sum for such losses under Coverage B shall not terminate Coverage A. The aggregate benefits payable under Coverage A & B in respect of an independent and unrelated accident if death arises within 180 days from such accident shall always be the Principal Sum.</p>
            </td>
            <td width="5%"></td>
        </tr>
        <tr>
            <td width="100%"></td>
        </tr>
        <tr>
            <td width="5%"></td>
            <td width="95%"><u>NOTICE OF CLAIM</u></td>
        </tr>
        <tr>
            <td width="5%"></td>
            <td width="90%">Written notice of claim must be given to the Company within thirty (30) days after the date of the accident that resulted in injury to the Named Insured. In of accidental death immediate notice must be given to the Company.</td>
            <td width="5%"></td>
        </tr>
        <tr>
            <td width="100%"></td>
        </tr>
        <tr>
            <td width="100%" align="center">LIST OF REQUIREMENTS FOR CLAIMS:</td>
        </tr>
        <tr>
            <td width="100%" align="center">ALL DOCUMENTS MUST BE IN ORIGINAL COPIES</td>
        </tr>
        <tr>
            <td width="100%"></td>
        </tr>
        <tr>
            <td width="5%"></td>
            <td width="50%" style="font-size: 7px;">1.	Accident Claim Form</td>
            <td width="50%" style="font-size: 7px;">6.	Police Report</td>
        </tr>
        <tr>
            <td width="5%"></td>
            <td width="50%" style="font-size: 7px;">2.	Death Certificate, if applicable</td>
            <td width="50%" style="font-size: 7px;">7.	Medical Certificate</td>
        </tr>
        <tr>
            <td width="5%"></td>
            <td width="50%" style="font-size: 7px;">3.	Marriage Contract, if applicable</td>
            <td width="50%" style="font-size: 7px;">8.	Birth Certificate (Insured and Beneficiary)</td>
        </tr>
        <tr>
            <td width="5%"></td>
            <td width="50%" style="font-size: 7px;">4.	Medico Legal Report</td>
            <td width="50%" style="font-size: 7px;">9.	IMAM Certification, for Muslims</td>
        </tr>
        <tr>
            <td width="5%"></td>
            <td width="50%" style="font-size: 7px;">5.	Post Mortem Report</td>
            <td width="45%" style="font-size: 7px;">10.	Pictures of Dead Bodies or Dismembered parts of the Insured’s Body</td>
        </tr>
        <tr><td width="100%"></td></tr>
        <tr>
            <td width="5%"></td>
            <td width="100%" style="font-size: 7px;"><i><strong>The Copy of the Group Policy is available for inspection, reading, or copying at the principal office of the Policy Holder.</strong></i></td>
        </tr>
        <tr><td width="100%"></td></tr>
        <tr><td width="100%"></td></tr>
        <tr>
            <td width="100%" align="center">Underwritten by <strong>MAAGAP Insurance, Inc.</strong></td>
        </tr>
        <tr>
            <td width="100%" align="center">10/F Pearlbank Centre, 146 Valero Street, Salcedo Village, Makati City, Philippines 1227</td>
        </tr>
        <tr><td width="100%"></td></tr>
        <tr><td width="40%" align="left">@if($transaction->reprint)<b>REPRINT:</b> {{ Carbon\Carbon::now()->format('m/d/Y h:i A') }} @endif</td></tr>
    </table>
</div>
{{-- <div class="container">
    <table class="tb1" style="font-size:10px;">
        <tr>
            <td>NOTES:</td>
        </tr>
        <tr>
            <td>
                1.	Additional Insured – Shows only if product type is Family Protect Plus<br>
                2.	Values for Group Policy Holder/ Policy No. –
            </td>
        </tr>    
        <tr>
            <td width="5%"></td>
            <td>
                a.	ML Pawner’s Protect Program – MM-03-20-CB-000564<br>
                b.	ML Family Protect Program – MM-03-20-CB-000967<br>
                c.	ML KP Protect Program– MM-03-21-CB-000076<br>
                d.	ML Pinoy Protect Plus – MM-03-20-CB-000563<br>
                e.	ML Family Protect Plus – MM-03-20-CB-000565<br>
            </td>
        </tr>    
        <tr>
            <td width="100%">
                3.	Table of Schedule of Benefits
            </td>
        </tr> 
        <tr>
            <td width="5%"></td>
            <td width="90%">
                <table width="100%" border="1" style="font-size: 10px;">
                    <tr>
                        <th>Limits</th>
                        <th>KP Protect</th>
                        <th>Pawner's Protect</th>
                        <th>Family Protect</th>
                        <th>Pinoy Protect +</th>
                        <th>Family Protect +</th>
                    </tr>
                    <tr>
                        <td>Accidental Death and Permanent Disablement</td>
                        <td>P20,000 – P100,000</td>
                        <td>P30,000 – P150,000</td>
                        <td>P30,000 – P150,000</td>
                        <td>P30,000 – P150,000</td>
                        <td>P30,000 – P150,000</td>
                    </tr>
                    <tr>
                        <td>Unprovoked Murder & Assault</td>
                        <td>P20,000 – P40,000</td>
                        <td>P30,000 – P60,000</td>
                        <td>P30,000 – P60,000</td>
                        <td>P30,000 – P60,000</td>
                        <td>P30,000 – P60,000</td>
                    </tr>
                    <tr>
                        <td>Motorcycling Benefit</td>
                        <td>P20,000</td>
                        <td>P30,000</td>
                        <td>P30,000</td>
                        <td>P30,000-60,000</td>
                        <td>P30,000-60,000</td>
                    </tr>
                    <tr>
                        <td>Accidental Burial Benefit</td>
                        <td>n/a</td>
                        <td>n/a</td>
                        <td>P10,000</td>
                        <td>P10,000</td>
                        <td>P10,000</td>
                    </tr>
                    <tr>
                        <td>Cash Assistance</td>
                        <td>n/a</td>
                        <td>n/a</td>
                        <td>n/a</td>
                        <td>P10,000</td>
                        <td>P10,000</td>
                    </tr>
                    <tr>
                        <td>Educational Assistance</td>
                        <td>n/a</td>
                        <td>n/a</td>
                        <td>n/a</td>
                        <td>If Accidental Death, P25,000/ if Death due to Sickness, P12,500</td>
                        <td>n/a</td>
                    </tr>
                    <tr>
                        <td>Fire Assistance</td>
                        <td>n/a</td>
                        <td>n/a</td>
                        <td>n/a</td>
                        <td>n/a</td>
                        <td>P5,000</td>
                    </tr>
                </table>
            </td>
            <td width="5%"></td>
        </tr>
        <tr><td></td></tr>
        <tr>
            <td width="5%"></td>
            <td width="95%">Note: </td>
        </tr> 
        <tr>
            <td width="5%"></td>
            <td width="95%">1.	Only Family Protect+ covers Insureds Dependents</td>
        </tr> 
        <tr><td></td></tr>
        <tr>
            <td width="5%"></td>
            <td width="90%">
                <table width="100%" border="1" style="font-size: 10px;">
                    <tr>
                        <td>Spouse</td>
                        <td>50% of the limit of the Main Insured</td>
                    </tr>
                    <tr>
                        <td>Each Surviving Dependent Parent</td>
                        <td>50% of the limit of the Main Insured</td>
                    </tr>
                    <tr>
                        <td>Each for Both Surviving Parents</td>
                        <td>50% of the limit of the Main Insured</td>
                    </tr>
                    <tr>
                        <td>Each Children/ Sibling</td>
                        <td>50% of the limit of the Main Insured</td>
                    </tr>
                </table>
            </td>
            <td width="5%"></td>
        </tr> 
        <tr><td></td></tr>
        <tr>
            <td width="5%"></td>
            <td width="90%" style="text-align: justify;">2.	Pawner’s Protect - Ages 66 to 70 years old are covered up to 50% of the benefit limits stated in the master policy</td>
            <td width="5%"></td>
        </tr> 
        <tr>
            <td width="5%"></td>
            <td width="90%" style="text-align: justify;">3.	Family Protect - Ages 7 to 17 years old and 71 to 75 years old are covered up to 50% of the benefit limits stated in the master policy</td>
            <td width="5%"></td>
        </tr> 
        <tr>
            <td width="5%"></td>
            <td width="90%" style="text-align: justify;">4.	Pinoy Protect Plus - Ages 71 to 75 years old are covered up to 50% of the benefit limits stated in the master policy and <strong>no Cash Assistance Benefit</strong></td>
            <td width="5%"></td>
        </tr> 
        <tr>
            <td width="5%"></td>
            <td width="90%" style="text-align: justify;">5.	Family Protect Plus - - Ages 71 to 75 years old are covered up to 50% of the benefit limits stated in the master policy and <strong>no Cash Assistance Benefit.</strong></td>
            <td width="5%"></td>
        </tr> 
        <tr><td></td></tr>
        <tr>
            <td width="100%">
                4.	Period of Insurance
            </td>
        </tr> 
        <tr><td></td></tr>
        <tr>
            <td width="5%"></td>
            <td width="90%">
                <table width="100%" border="1" style="font-size: 10px;">
                    <tr>
                        <td>Pawner's Protect</td>
                        <td>4 Months</td>
                    </tr>
                    <tr>
                        <td>Family Protect</td>
                        <td>1 Year</td>
                    </tr>
                    <tr>
                        <td>KP Protect</td>
                        <td>30 Days</td>
                    </tr>
                    <tr>
                        <td>Pinoy Protect +</td>
                        <td>1 Year</td>
                    </tr>
                    <tr>
                        <td>Family Protect +</td>
                        <td>1 Year</td>
                    </tr>
                </table>
            </td>
            <td width="5%"></td>
        </tr> 
        <tr><td></td></tr>
        <tr>
            <td width="100%">
                5.	Total Premium – automatically calculates depending on no. of units; maximum of 5 units
            </td>
        </tr> 
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
    </table>
</div> --}}