@include('includes.tcpdf_includes')
<style>
    table,td,th{
        font-size:8px;
        font-family: Arial, Helvetica, sans-serif;
    }
    table.tb4 td{
        text-align: center;
        font-size: 8px;
    }
    .tb1{
        border:2px solid black;
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
    <table class="tb1">
        <tr class="font10">
            <td width="25%"></td>
            <td align="center" width="30%"></td>
            <td  width="45%" align="right" style="font-size:10px">
                <br><br>
                <strong>MAA GENERAL ASSURANCE PHILS., INC.</strong>
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
            <td width = "50%">A<strong>{{ $transaction->terminal_coi_number }}</strong></td>
        </tr>
        <tr class="font10">
            <td width = "5%"></td>
            <td width = "30%" align="left">Principal Insured</td>
            <td width = "10%">:</td>
            <td width = "50%">{{ $transaction->insured_name }}</td>
        </tr>

        @php
            $counter = 1;
        @endphp

        @if($transaction->guardian)
            <tr class="font10">
                <td width = "5%"></td>
                <td width = "30%" align="left">Additional Insured</td>
                <td width = "10%">:</td>
                {{-- <td width = "55%">{{ $counter++ }}. {{ $transaction->guardian }} @if($transaction->guardian) , @if($transaction->civil_status == 'Single') PARENT @else SPOUSE @endif @endif</td> --}}
                <td width = "55%">{{ $counter++ }}. {{ $transaction->guardian }}{{ $transaction->dependents->where('field', '1_1')->first() ? ', ('.$transaction->dependents->where('field', '1_1')->first()->relationship.')' : '' }}</td>
            </tr>
        @endif  

        @if($transaction->guardian2)
            <tr class="font10">
                <td width = "5%"></td>
                <td width = "30%"></td>
                <td width = "10%"></td>
                {{-- <td width = "55%">{{ $counter++ }}. {{ $transaction->guardian2 }} , @if($transaction->civil_status == 'Single') PARENT @else SPOUSE @endif</td> --}}
                <td width = "55%">{{ $counter++ }}. {{ $transaction->guardian2 }}{{ $transaction->dependents->where('field', '1_2')->first() ? ', ('.$transaction->dependents->where('field', '1_2')->first()->relationship.')' : '' }}</td>
            </tr>
        @endif

        @if($transaction->child_siblings)
            <tr class="font10">
                <td width = "5%"></td>
                <td width = "30%"></td>
                <td width = "10%"></td>
                {{-- <td width = "55%">{{ $counter++ }}. {{ $transaction->child_siblings }} , @if($transaction->civil_status == 'Single') SIBLING @else CHILDREN @endif</td> --}}
                <td width = "55%">{{ $counter++ }}. {{ $transaction->child_siblings }}{{ $transaction->dependents->where('field', '2_1')->first() ? ', ('.$transaction->dependents->where('field', '2_1')->first()->relationship.')' : '' }}</td>
            </tr>
        @endif

        @if($transaction->child_siblings2)
            <tr class="font10">
                <td width = "5%"></td>
                <td width = "30%"></td>
                <td width = "10%"></td>
                {{-- <td width = "55%">{{ $counter++ }}. {{ $transaction->child_siblings2 }} , @if($transaction->civil_status == 'Single') SIBLING @else CHILDREN @endif</td> --}}
                <td width = "55%">{{ $counter++ }}. {{ $transaction->child_siblings2 }}{{ $transaction->dependents->where('field', '2_2')->first() ? ', ('.$transaction->dependents->where('field', '2_2')->first()->relationship.')' : '' }}</td>
            </tr>
        @endif

        @if($transaction->child_siblings3)
            <tr class="font10">
                <td width = "5%"></td>
                <td width = "30%"></td>
                <td width = "10%"></td>
                {{-- <td width = "55%">{{ $counter++ }}. {{ $transaction->child_siblings3 }} , @if($transaction->civil_status == 'Single') SIBLING @else CHILDREN @endif</td> --}}
                <td width = "55%">{{ $counter++ }}. {{ $transaction->child_siblings3 }}{{ $transaction->dependents->where('field', '2_3')->first() ? ', ('.$transaction->dependents->where('field', '2_3')->first()->relationship.')' : '' }}</td>
            </tr>
        @endif

        @if($transaction->child_siblings4)
            <tr class="font10">
                <td width = "5%"></td>
                <td width = "30%"></td>
                <td width = "10%"></td>
                {{-- <td width = "55%">{{ $counter++ }}. {{ $transaction->child_siblings4 }} , @if($transaction->civil_status == 'Single') SIBLING @else CHILDREN @endif</td> --}}
                <td width = "55%">{{ $counter++ }}. {{ $transaction->child_siblings4 }}{{ $transaction->dependents->where('field', '2_4')->first() ? ', ('.$transaction->dependents->where('field', '2_4')->first()->relationship.')' : '' }}</td>
            </tr>
        @endif

        {{-- FOR THE SIGNATURE TO NOT BE OUT OF PLACE --}}
        @for($i = 0; $i < (7 - $counter); $i++)  
            <tr><td></td></tr>
        @endfor

        <tr class="font10">
            <td width = "5%"></td>
            <td width = "30%" align="left">Group Policy Holder</td>
            <td width = "10%">:</td>
            <td width = "50%"><strong>ML FAMILY PROTECT - PLUS</strong></td>
        </tr>
        <tr class="font10">
            <td width = "5%"></td>
            <td width = "30%" align="left">Group Policy Number</td>
            <td width = "10%">:</td>
            <td width = "50%">{{ $transaction->policy_number }}</td>
        </tr>
        <tr class="font10">
            <td width = "5%"></td>
            <td width = "30%" align="left">Schedule of Benefits</td>
            <td width = "10%">:</td>
            <td width = "50%">Maximum of <strong>five (5)</strong> Confirmation of Insurance per person</td>
        </tr>
        {{-- <tr><td></td></tr> --}}
        <tr class="font10 bord">
            <th width = "5%" style="border:none;"></th>
            <th width = "40%"></th>
            <th width = "17%" style="font-size:10px;">Principal</th>
            <th width = "17%" style="font-size:10px;">Spouse/Parent</th>
            <th width = "16%" style="font-size:10px;">Children/Sibling</th>
            <th width = "5%" style="border:none;"></th>
        </tr>
        <tr class="font10 bord">
            <td width = "5%" style="border:none;"></td>
            <td width = "40%" align="left">Accidental Death/ Permanent Disablement</td>
            <td width = "17%">PHP {{ number_format($holder['accident_principal'], 2) }}</td>
            <td width = "17%">PHP {{ number_format($holder['accident_spouse_parents'], 2) }}</td>
            <td width = "16%">PHP {{ number_format($holder['accident_child_siblings'], 2) }}</td>
            <td width = "5%" style="border:none;"></td>
        </tr>
        <tr class="font10 bord" >
            <td width = "5%" style="border:none;"></td>
            <td width = "40%" align="left">Unprovoked Murder & Assault</td>
            <td width = "17%">PHP {{ number_format($holder['unprovoked_principal'], 2) }}</td>
            <td width = "17%">PHP {{ number_format($holder['unprovoked_spouse_parents'], 2) }}</td>
            <td width = "16%">PHP {{ number_format($holder['unprovoked_child_siblings'], 2) }}</td>
            <td width = "5%" style="border:none;"></td>
        </tr>
        <tr class="font10 bord">
            <td width = "5%" style="border:none;"></td>
            <td width = "40%" align="left">Motorcycling</td>
            <td width = "17%">PHP {{ number_format($holder['motor_principal'], 2) }}</td>
            <td width = "17%">PHP {{ number_format($holder['motor_spouse_parents'], 2) }}</td>
            <td width = "16%">PHP {{ number_format($holder['motor_child_siblings'], 2) }}</td>
            <td width = "5%" style="border:none;"></td>
        </tr>
        <tr class="font10 bord">
            <td width = "5%" style="border:none;"></td>
            <td width = "40%" align="left">Accidental Burial Benefit</td>
            <td width = "17%">PHP {{ number_format($holder['burial_principal'], 2) }}</td>
            <td width = "17%">PHP {{ number_format($holder['burial_spouse_parents'], 2) }}</td>
            <td width = "16%">PHP {{ number_format($holder['burial_child_siblings'], 2) }}</td>
            <td width = "5%" style="border:none;"></td>
        </tr>
        <tr class="font10 bord">
            <td width = "5%" style="border:none;"></td>
            <td width = "40%" align="left">Cash Assistance Benefit</td>
            <td width = "17%">PHP {{ number_format($holder['cash_principal'], 2) }}</td>
            <td width = "17%">PHP {{ number_format($holder['cash_spouse_parents'], 2) }}</td>
            <td width = "16%">PHP {{ number_format($holder['cash_child_siblings'], 2) }}</td>
            <td width = "5%" style="border:none;"></td>
        </tr>
        <tr class="font10 bord">
            <td width = "5%" style="border:none;"></td>
            <td width = "40%" align="left">Fire Assistance</td>
            <td width = "17%">PHP {{ number_format($holder['fire_principal'], 2) }}</td>
            {{-- <td width = "17%">PHP {{ number_format($holder['fire_spouse_parents'], 2) }}</td>
            <td width = "16%">PHP {{ number_format($holder['fire_child_siblings'], 2) }}</td> --}}
            <td width = "17%">N/A</td>
            <td width = "16%">N/A</td>
            <td width = "5%" style="border:none;"></td>
        </tr>
        <tr><td></td></tr>
        <tr class="font10"> 
            <td width = "5%"></td>
            <td width = "30%">Period of Insurance</td>
            <td width = "10%">:</td>
            <td width = "55%">{{ $transaction->date_issued->format('F d, Y') }} to {{ $transaction->date_issued->addYear()->format('F d, Y') }}</td>
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
            <td width = "90%" style="text-align: justify;">This certifies that the person named in this certificate is covered under the Master Policy issued by MAA General Assurance Company, Inc.  subject to the terms and conditions, warranties and clauses, including exceptions of the policy and all claims will be adjusted in accordance therewith.  This serves as evidence and receipt of your premium payment.</td>
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
            <td width="40%" align="center" style="text-decoration: overline;"><strong>MARTIN L. DELA ROSA</strong></td>
            <td width="10%"></td>
        </tr>
        <tr class="font8">
            <td width="5%"></td>
            <td width="40%" align="center">Date of Issuance: {{ $transaction->date_issued ? Carbon\Carbon::parse($transaction->date_issued)->format('M d, Y') : null }} </td>
            <td width="5%"></td>
            <td width="40%" align="center">Deputy CEO / Executive Vice President</td>
            <td width="10%"></td>
        </tr>
        <tr>
            <td width="5%"></td>
            <td width="40%"></td>
            <td width="5%"></td>
            <td width="40%" align="center">MAA General Assurance Phils., Inc</td>
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
        {{-- <tr>
            <td width="5%"></td>
            <td width="90%"><p style="font-size:8px;">When injury results in any of the following losses within one hundred eighty (180) days after the date of the accident, the Company will pay for the loss of:</p></td>
            <td width="5%"></td>
        </tr>
        <tr><td></td></tr>
        <tr class="spacing">
            <td width="10%"></td>
            <td width="45%">Both Hands or Both Feet or Sight of Both Eyes .............................</td>
            <td width="5%"></td>
            <td>100% of the Principal Sum</td>
        </tr>
        <tr>
            <td width="10%"></td>
            <td width="45%">One hands and One Foot ...............................................................</td>
            <td width="5%"></td>
            <td>100% of the Principal Sum</td>
        </tr>
        <tr>
            <td width="10%"></td>
            <td>Either Hand or Foot and Sight of One Eye .....................................</td>
            <td width="5%"></td>
            <td>100% of the Principal Sum</td>
        </tr>
        <tr>
            <td width="10%"></td>
            <td>Either Hand or Foot ........................................................................</td>
            <td width="5%"></td>
            <td>50% of the Principal Sum</td>
        </tr>
        <tr>
            <td width="10%"></td>
            <td>Both Thumb and index Finger of Either Hand ................................</td>
            <td width="5%"></td>
            <td>10% of the Principal Sum</td>
        </tr>
        <tr>
            <td width="100%"></td>
        </tr>
        <tr>
            <td width="5%"></td>
            <td width="90%" style="text-align: justify;">The occurrence of any specific loss for which the corresponding indemnity provided above is payable to the Named Insured at no less than 100% of the Principal Sum Insured, shall at once terminate all insurance under the policy with respect to said Named Insured, but such termination shall be without prejudice to any claim originating out of the accident causing such loss.</td>
            <td width="5%"></td>
        </tr> --}}
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
            <td width="100%" align="center">Underwritten by <strong>MAA General Assurance Phils., Inc</strong></td>
        </tr>
        <tr>
            <td width="100%" align="center">10/F Pearlbank Centre, 146 Valero Street, Salcedo Village, Makati City, Philippines 1227</td>
        </tr>
        <tr><td width="100%"></td></tr>
        <tr><td width="100%"></td></tr>
    </table>
</div>