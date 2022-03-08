@include('includes.tcpdf_includes')
<div class="container">
    <table class="tb1" cellpadding="2" style="font-size:8px;">
            <tr>
                <td width="25%">
                    
                    {{-- <img src="{{URL::asset('images/ml_logo.png')}}" height="100"> --}}
                </td>
                <td align="center" width="30%">
                </td>
                <td  width="45%" align="right" style="font-size:10px">
                    <br><br>
                    <strong>MAA GENERAL ASSURANCE PHILS., INC.</strong>
                </td>
            </tr>
            <tr>
                <td width = "100%" align="right" style="font-size:9px">
                    <strong> COI #: A </strong>{{$transaction->coi_number}}
                </td>
            </tr>
            <tr>
                <td width = "100%" align="center" style="font-size:13px">
                    <strong>Confirmation of Insurance</strong>
                </td>
            </tr>
            <tr>
                {{--    1st table --}}
                <td width = "33%" style="border: 1px solid black;">
                    <strong style="font-size:10px;"> ML BRANCH : </strong>{{$transaction->userbranch}} <br>
                    <strong> BOS ENTRY NO : </strong>{{$transaction->bos_entry_number}}
                </td>
                <td width = ".5%">
                {{--    2nd table --}}
                </td>
                <td width = "33.5%" align="center" style="border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">
                    Group Policy Holder <br> <strong>ML FAMILY PROTECT - PLUS</strong>
                </td>
                <td width = "33%" style="border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">
                    Issue Date: {{ $transaction->date_issued ? Carbon\Carbon::parse($transaction->date_issued)->format('m/d/Y') : null }} <br> Policy No.: {{$transaction->policy_number}}
                </td>
                
            </tr>
            <tr>
                {{--    1st table --}}
                <td width = "20.5%" style="border-left: 1px solid black">
                    Principal Insured : 
                </td>
                <td width = "12.5%" style="border-right: 1px solid black">
                    Birthdates : 
                </td>
                <td width = ".5%">
                
                </td>
                {{--    2nd table --}}
                <td width = "33.5%" style="border-left: 1px solid black;">
                        SCHEDULE OFBENEFITS
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;font-size:5px;">
                    <strong>PRINCIPAL</strong>
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;font-size:5px;">
                    <strong>SPOUSE/<br>PARENTS</strong>
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;font-size:5px;">
                    <strong>CHILDREN/<br>SIBLINGS</strong>
                </td>
            </tr>
            <tr>
                {{--    1st table --}}
                <td width = "20.5%" style="border-left: 1px solid black">
                    <u>Principal Insured{{$transaction->insured_name}}</u> 
                </td>
                <td width = "12.5%" style="border-right: 1px solid black">
                    <u>Principal Insured Bday{{ $transaction->dateofbirth ? Carbon\Carbon::parse($transaction->dateofbirth)->format('m/d/Y') : null }} </u>
                </td>
                <td width = ".5%">
                {{--    2nd table --}}
                </td>
                <td width = "33.5%" style="border-left: 1px solid black;border-bottom: 1px solid black;">
                        
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;font-size:6px;">
                    (18-70 yrs. old)
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;font-size:6px;">
                    (18-70 yrs. old)
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;font-size:6px;">
                    (1-21 yrs. old)
                </td>
            </tr>
            <tr>
                {{--    1st table --}}
                <td width = "20.5%" style="border-left: 1px solid black">
                   
                </td>
                <td width = "12.5%" style="border-right: 1px solid black">
                   
                </td>
                <td width = ".5%">
                {{--    2nd table --}}
                </td>
                <td width = "33.5%" style="border-left: 1px solid black;border-bottom: 1px solid black;">
                    Accidental Death/ Disablement
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    
                    {{$holder['accident_principal']}}
                    
                                    
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    {{-- 15,000.00 --}}
                  {{$holder['accident_spouse_parents']}}
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    {{-- 10,000.00 --}}
                    {{$holder['accident_child_siblings']}}
                </td>
            </tr>
            <tr>
                {{--    1st table --}}
                <td width = "20.5%" style="border-left: 1px solid black">
                    
                    @if ($transaction->civil_status == 'Single')
                        Parents -parents
                    @elseif ($transaction->civil_status == 'Married')
                        Spouse -spouse
                    @else 

                    @endif
                </td>
                <td width = "12.5%" style="border-right: 1px solid black">
                   
                </td>
                <td width = ".5%">
                {{--    2nd table --}}
                </td>
                <td width = "33.5%" style="border-left: 1px solid black;border-bottom: 1px solid black;">
                    Unprovoke Murder or Assault
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    {{-- 30,000.00 --}}
                    {{$holder['unprovoke_principal']}}
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    {{-- 15,000.00 --}}
                    {{$holder['unprovoke_spouse_parents']}}
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    {{-- 5,000.00 --}}
                    {{$holder['unprovoke_child_siblings']}}
                </td>
            </tr>
            <tr>
                {{--    1st table --}}
                <td width = "20.5%" style="border-left: 1px solid black">
                &nbsp;1. <u>{{$transaction->guardian}}</u> 
                </td>
                <td width = "12.5%" style="border-right: 1px solid black">
                    <u>p-bday{{ $transaction->guardian_dateofbirth ? Carbon\Carbon::parse($transaction->guardian_dateofbirth)->format('m/d/Y') : null }} </u>
                </td>
                <td width = ".5%">
                {{--    2nd table --}}
                </td>
                <td width = "33.5%" style="border-left: 1px solid black;border-bottom: 1px solid black;">
                    Motorcycling
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    {{-- 30,000.00 --}}
                    {{$holder['motor_principal']}}
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    {{-- 15,000.00 --}}
                    {{$holder['motor_spouse_parents']}}
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    {{-- 5,000.00 --}}
                  {{$holder['motor_child_siblings']}}
                </td>
            </tr>
            <tr>
                {{--    1st table --}}
                <td width = "20.5%" style="border-left: 1px solid black">
                    &nbsp;2.aa <u>{{$transaction->guardian2}}</u> 
                </td>
                <td width = "12.5%" style="border-right: 1px solid black">
                    <u>{{ $transaction->guardian_dateofbirth2 ? Carbon\Carbon::parse($transaction->guardian_dateofbirth2)->format('m/d/Y') : null }} </u>
                </td>
                <td width = ".5%">
                {{--    2nd table --}}
                </td>
                <td width = "33.5%" style="border-left: 1px solid black;border-bottom: 1px solid black;">
                    Accidental Burial
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    {{-- 10,000.00 --}}
                    {{$holder['burial_principal']}}
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    {{-- 5,000.00 --}}
                    {{$holder['burial_spouse_parents']}}
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    {{-- 2,500.00 --}}
                    {{$holder['burial_child_siblings']}}
                </td>
            </tr>
            <tr>
                {{--    1st table --}}
                <td width = "20.5%" style="border-left: 1px solid black">
                   
                </td>
                <td width = "12.5%" style="border-right: 1px solid black">
                    
                </td>
                <td width = ".5%">
                {{--    2nd table --}}
                </td>
                <td width = "33.5%" style="border-left: 1px solid black;border-bottom: 1px solid black;">
                    Cash Assistance Benefit    
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    {{-- 10,000.00 --}}
                    {{$holder['cash_principal']}}
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    {{-- 5,000.00 --}}
                    {{$holder['cash_spouse_parents']}}
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    {{-- 2,500.00 --}}
                    {{$holder['cash_child_siblings']}}
                </td>
            </tr>
            <tr>
                {{--    1st tab1le --}}
                <td width = "20.5%" style="border-left: 1px solid black">
                      
                    @if ($transaction->civil_status == 'Single')
                        Siblings
                    @elseif ($transaction->civil_status == 'Married')
                        Children
                    @else 

                    @endif
                </td>
                <td width = "12.5%" style="border-right: 1px solid black">
                    
                </td>
                <td width = ".5%">
                {{--    2nd table --}}
                </td>
                <td width = "33.5%" style="border-left: 1px solid black;border-bottom: 1px solid black;">
                    Fire Assistance
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    {{-- 5,000.00 --}}
                    {{$holder['fire_principal']}}
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    ---
                </td>
                <td width = "11%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    ---
                </td>
            </tr>
            <tr>
                {{--    1st table --}}
                <td width = "20.5%" style="border-left: 1px solid black">
                    &nbsp;1. <u>{{$transaction->child_siblings}}</u>
                </td>
                <td width = "12.5%" style="border-right: 1px solid black">
                    <u>{{ $transaction->child_siblings_dateofbirth ? Carbon\Carbon::parse($transaction->child_siblings_dateofbirth)->format('m/d/Y') : null }}</u>
                </td>
                <td width = ".5%">
                {{--    2nd table --}}
                </td>
                <td width = "66.5%" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    Reminder: Regardless of the number of COI's acquired, the following maximum limits will apply:
                </td>     
            </tr>
            <tr>
                {{--    1st table --}}
                <td width = "20.5%" style="border-left: 1px solid black">
                    &nbsp;2. <u>{{$transaction->child_siblings2}}</u>
                </td>
                <td width = "12.5%" style="border-right: 1px solid black">
                    <u>{{ $transaction->child_siblings_dateofbirth2 ? Carbon\Carbon::parse($transaction->child_siblings_dateofbirth2)->format('m/d/Y') : null }}</u>
                </td>
                <td width = ".5%">
                {{--    2nd table --}}
                </td>
                <td width = "35.5%" style="font-size:7px;border-left: 1px solid black;">
                    <i>1.) Unprovoked Murder of Assault up to Php 60,000.00;</i>
                </td>
                <td width = "31%" style="font-size:7px;border-right: 1px solid black;">
                    <i>5.) Fire Assistance up to Php 5,000.00;</i>
                </td>                 

            </tr>
            <tr>
                {{--    1st table --}}
                <td width = "20.5%" style="border-left: 1px solid black">
                    &nbsp;3. <u>{{$transaction->child_siblings3}}</u>
                </td>
                <td width = "12.5%" style="border-right: 1px solid black">
                    <u>{{ $transaction->child_siblings_dateofbirth3 ? Carbon\Carbon::parse($transaction->child_siblings_dateofbirth3)->format('m/d/Y') : null }}</u>
                </td>
                <td width = ".5%">
                {{--    2nd table --}}
                </td>
                <td width = "35.5%" style="font-size:7px;border-left: 1px solid black;">
                    <i>2.) Motorcycling up to Php 60,000.00;</i>
                </td>
                <td width = "31%" style="font-size:7px;border-right: 1px solid black;">
                    <i>6.) Number of COI per Person up to five (5).</i>
                </td>
            </tr>
            <tr>
                {{--    1st table --}}
                <td width = "20.5%" style="border-left: 1px solid black;border-bottom: 1px solid black;">
                    &nbsp;4. <u>{{$transaction->child_siblings4}}</u> 
                </td>
                <td width = "12.5%" style="border-right: 1px solid black;border-bottom: 1px solid black;">
                    <u>{{ $transaction->child_siblings_dateofbirth4 ? Carbon\Carbon::parse($transaction->child_siblings_dateofbirth4)->format('m/d/Y') : null }}</u>
                </td>
                <td width = ".5%">
                {{--    2nd table --}}
                </td>
                <td width = "30.5%" style="font-size:7px;border-left: 1px solid black;border-bottom: 1px solid black;">
                    <i>3.) Accidental Burial up to Php 10,000.00;</i>
                </td>
                <td width = "36%" style="border-right: 1px solid black;font-size:7px;border-bottom: 1px solid black;">
                    <i>4.) Cash Assistance Benefit up to Php 10,000.00;</i><br />
                    <div style="text-align: right; width: 100%; font-size: 10px;"><strong><i>Php {{ number_format(($transaction->price * intval($transaction->units)), 2)}}</i></strong></div>
                </td>
            </tr>
                <tr>
                    <td width = "100%" style="font-size:0px;">
                    </td>
                </tr>
            <tr>
                <td width = "33%" align="justify" style="border: 1px solid black;font-size:7px;">
                    Terms of Insurance: The insurance will take effect from date of application amd expiring one (1) year thereafter. This COI also serves as evidence of receipt of premium payments.
                </td>
                <td width = ".5%">
                
                </td>
                <td width = "66.5%" align="justify" style="border: 1px solid black;font-size:7px;">
                    This certifies that the person named in this certificate is covered, subject to the terms, conditions, including warranties and clauses attached to the Master Policy issued by MAA General Assurance Phils., Inc. This serves as evidence and receipt of your premium payment. Keep this in a safe palce.
                </td>
            </tr>
            <tr>
                <td width = "100%" style="font-size:0px;">
                </td>
            </tr>
            <tr>
                <td width = "33%" align="justify" style="border: 1px solid black;">
                    NOTICE: The Insurance Commission is the government office in charge with the duty of safeguarding the interests of policyholders will render assistance of any complaints regarding insurance matters.
                </td>
                <td width = ".5%" >
                
                </td>
                <td width = "33%" align="center" style="border: 1px solid black;">
                    <br><br><br><br>
                    Signature of Insured / Beneficiary<br>(not valid without signature)
                </td>
                <td width = "33.5%" align="center" style="border: 1px solid black;">
                    <br><br><br>
                    <strong>DANIEL C. GO</strong><br><font size="7"> President & CEO</font><br>MAA General Assurance Phils., Inc.
                </td>
            </tr>
            <tr>
                <td width = "100%" align="center" style="font-size:9px">
                    <strong>BENEFITS:</strong>
                </td>
            </tr>
            <tr>
                <td width = "100%" style="font-size:7px">
                    <strong>Accidental Death-</strong> pays in lump sum the benefit limit indicated in the schedule of benefits in the event of death resulting from an accident.<br>
                    <strong>Permanent Loss of Use or Disablement or Dismemberment-</strong> pays in lump sum the benefit limit indicated below according to the percetage schedule up to 100% of<br>&nbsp;&nbsp;the Accidental Death Benefit.<br>
                    100% Loss of both hands or both feet or sight of both eyes<br>
                    100% One hand or one foot <br>
                    100% Either hand or foot & sight of one eye <br>
                    50% Either hand and foot <br>
                    50% Sight of one eye <br>
                    10% Both thumb & index finger of eight hand <br>
                    <strong>Unprovoked Murder & Assault- </strong>in lump sum the benefit limit indicated in the schedule of benefits in the event of death resulting from unprovoked murder or assault. <br>
                    <strong>Motorcycling- </strong>would mean riding or operating any two-wheeled motorized vehicle except which such vehicle is being used for any race, speed test or exhibition or when<br>&nbsp;&nbsp;the insured is under the influence of liquor; narcotics or prohibited drug; and driving without valid driver's licensed.<br>
                    <strong>Accidental Burial Benefit- </strong>pays additional lump sum in the event of death resulting from an accident. <br>
                    <strong>Cash Assistance Benefit- </strong>pays in lump sum the benefit limit indicated in the schedule of benefit in the event of death resulting from sickness. This benefit is not payable<br>&nbsp;&nbsp;if the result is caused by or resulting from pre-existing conditions: pregnancy related causes: AIDS related cases; & suicidal cases.<br>
                    <strong>Fire Assistance- </strong>provides a lump sum benefit to the Main insured in hte event of damage or loss of property owned, rented or lease by the main insured resulting from<br>&nbsp;&nbsp;fire<br>
                    <strong>Exclusions: The policy will not cover any loss or expense caused by or resulting from:</strong><br>
                    * Internationally self-inflicted injury, suicide, or any attempt thereat while sane or insane.<br>
                    * War, invasion, act of foreign enemy, hostilities, or warlike operations (whether war be declared or not), mutiny, riot, civilcommotions, conspiracy, rebellion, revolution,<br>&nbsp;&nbsp;insurrection or military or usurped power or<br>
                    * Provoked assault<br>
                    * Congenital defects and conditions<br>
                    * Engaged in any military duties or naval operations, police & civilians with peace and order duties or combatant duties or trainings.<br>
                    * Illegal acts of the Insured person or the excutors, administrators, legal heirs, or personal representatives.<br>
                    * Motorcycle related injuries or loss of life with expired or invalid driver's license; expired vehicle registration; no protective helmet conforming to standard safety<br>&nbsp;&nbsp;specifications fot motorcycle rider; under the influence of probihited drugs or alcohol; violating traffic laws and regulations.<br>
                    * Pre-existing conditions; pregnancy related causes; AIDs & suicidal cases.<br>
                    <i>These are only some of the exclusions. Complete listings are in the issued policy.</i>

                </td>
                
            </tr>
            <tr>
                <td width = "100%" align="center" style="font-size:8px">
                    <i><strong>Important Reminder:</strong></i>
                </td>
            </tr>
            <tr>
                <td width="100%" style="font-size:7px">
                    The applicable benefits for the ages 71 to 75 years old if up to 50% of the benefits. Cash Assistance Benefit will not apply.<br>
                    <strong>Notice of Claim: </strong>should be reported within thirty (30) days from the date of the accident. <strong>Original Copies</strong> of the following documents must be submitted for fast<br>&nbsp;&nbsp;evaluation of the claim:<br>
                    Death Cases/Dismemberment Cases:<br>
                    &nbsp;&nbsp;1.) Accident Claim form<br>
                    &nbsp;&nbsp;2.) Death Certificate<br>
                    &nbsp;&nbsp;3.) Accident Report & Autopsy Report<br>
                    &nbsp;&nbsp;4.) Medical Certificate<br>
                    &nbsp;&nbsp;5.) Proof of Relationship to the insured- Marriage Contract and /or Birth Certificate<br>
                    &nbsp;&nbsp;6.) Newspaper clippings or picture of the insured's body or injured parts of the body<br>
                    &nbsp;&nbsp;7.) Certificationby the specialist or EENT for loss of sight or eye injuries & diagram showing the location of the Injured body member/degree of disablement.
                </td>
            </tr>
            
    </table>
</div>