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
                    <strong>MAAGAP INSURANCE INC.</strong>
                </td>
            </tr>
            <tr>
                <td width = "100%" align="right" style="font-size:9px">
                    <strong> COI #: C </strong>{{$transaction->coi_number}}
                </td>
            </tr>
            <tr>
                <td width = "100%" align="center" style="font-size:13px">
                    <strong>Confirmation of Insurance</strong>
                </td>
            </tr>
            <tr>
                {{--    1st table --}}
                <td width = "49.5%" style="border: 1px solid black;">
                    <br><br>
                    <strong style="font-size:10px;"> ML BRANCH : </strong>{{$transaction->userbranch}}
                    
                </td>
                <td width = "1%">
                {{--    2nd table --}}
                </td>
                <td width = "24.75%" align="center" style="border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">
                    Group Policy Holder <br> <strong>ML PINOY PROTECT - PLUS</strong>
                </td>
                <td width = "24.75%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">
                    Issue Date: {{ $transaction->date_issued ? Carbon\Carbon::parse($transaction->date_issued)->format('m/d/Y') : null }} <br> 
                    Policy No.: {{$transaction->policy_number}}
                </td>
                
            </tr>
            <tr>
                {{--    1st table --}}
                <td width = "49.5%" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    <strong> BOS ENTRY NO : </strong>{{$transaction->bos_entry_number}}
                </td>
                <td width = "1%">
                {{--    2nd table --}}
                </td>
                <td width = "24.75%" align="center" style="border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">
                    Benefits:
                </td>
                <td width = "24.75%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">
                    Sum Insured
                </td>
                
            </tr>
            <tr>
                {{--    1st table --}}
                <td width = "49.5%" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    Name of Insured : {{$transaction->insured_name}}
                </td>
                <td width = "1%">
                
                </td>
                {{--    2nd table --}}
                <td width = "24.75%" style="border-left: 1px solid black;border-bottom: 1px solid black;">
                        Accidental Death/Disablement
                </td>
                <td width = "12.375%" style="border-bottom: 1px solid black;">
                    Php
                </td>
                <td width = "12.375%" style="border-bottom: 1px solid black;border-right: 1px solid black;">
                    {{-- 30,000.00 --}}
                    {{$holder['accident_principal']}}
                </td>
            </tr>
            <tr>
                {{--    1st table --}}
                <td  rowspan="2" width = "49.5%" style="border-left: 1px solid black;border-right: 1px solid black;">
                    {{-- Address: {{$transaction->address}} --}}
                </td>
                <td  width = "1%">
                {{--    2nd table --}}
                </td>
                <td  width = "24.75%" style="border-left: 1px solid black;border-bottom: 1px solid black;">
                    Unprovoked Murder or Assault
                    
                </td>
                <td width = "12.375%" style="border-bottom: 1px solid black;">
                    
                </td>
                <td width = "12.375%"  style="border-right: 1px solid black;border-bottom: 1px solid black;">
                    {{-- 30,000.00 --}}
                    {{$holder['unprovoke_principal']}}
                </td>
            </tr>
            <tr>
                {{--    1st table --}}
                
                <td width = "1%">
                {{--    2nd table --}}
                </td>
                <td width = "24.75%" style="border-left: 1px solid black;border-bottom: 1px solid black;">
                    Motorcycling
                </td>
                <td width = "12.375%" style="border-bottom: 1px solid black;">
                    
                </td>
                <td width = "12.375%" style="border-right: 1px solid black;border-bottom: 1px solid black;">
                    {{-- 30,000.00 --}}
                    {{$holder['motor_principal']}}
                </td>
            </tr>
            <tr>
                {{--    1st table --}}
                <td width = "49.5%" style="border: 1px solid black;">
                    Date of Birth: {{ $transaction->dateofbirth ? Carbon\Carbon::parse($transaction->dateofbirth)->format('m/d/Y') : null }}
                </td>
                <td width = "1%">
                {{--    2nd table --}}
                </td>
                <td width = "24.75%" style="border-left: 1px solid black;border-bottom: 1px solid black;">
                    Accidental Burial
                </td>
                <td width = "12.375%" style="border-bottom: 1px solid black;">
                    
                </td>
                <td width = "12.375%" style="border-right: 1px solid black;border-bottom: 1px solid black;">
                    {{-- 10,000.00 --}}
                    {{$holder['burial_principal']}}
                </td>
            </tr>
            <tr>
                {{--    1st table --}}
                <td width = "49.5%" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    Beneficiary/Relationship: {{$transaction->beneficiary}} / {{$transaction->relationship}}
                </td>
                <td width = "1%">
                {{--    2nd table --}}
                </td>
                <td width = "24.75%" style="border-left: 1px solid black;border-bottom: 1px solid black;">
                    Cash Assistance Benefit
                </td>
                <td width = "12.375%" style="border-bottom: 1px solid black;">
                    
                </td>
                <td width = "12.375%" style="border-right: 1px solid black;border-bottom: 1px solid black;">
                    {{-- 10,000.00 --}}
                    {{$holder['cash_principal']}}
                </td>
            </tr>
            <tr>
                {{--    1st table --}}
                <td rowspan="2" align="justify" width = "49.5%" style="border: 1px solid black;font-size:7px;">
                    Terms of Insurance: The insurance will take effect from date of application amd expiring one (1) year thereafter. This COI also serves as evidence of receipt of premium payments.
                </td>
                <td width = "1%">
                {{--    2nd table --}}
                </td>
                <td width = "24.75%" style="border-left: 1px solid black;">
                    Educational Assistance
                </td>
                <td width = "12.375%" >
                    Accidental
                </td>
                <td width = "12.375%" style="border-right: 1px solid black;">
                    {{-- 5,000.00 --}}
                    {{$holder['accidental']}}
                </td>
            </tr>
            <tr>
                {{--    1st table --}}
                
                <td width = "1%">
                {{--    2nd table --}}
                </td>
                <td width = "24.75%" style="border-left: 1px solid black;border-bottom: 1px solid black;">
                    
                </td>
                <td width = "12.375%" style="border-bottom: 1px solid black;">
                    Sickness
                </td>
                <td width = "12.375%" style="border-right: 1px solid black;border-bottom: 1px solid black;">
                    {{-- 2,500.00 --}}
                    {{$holder['sickness']}}
                </td>    
            </tr>
            <tr>
                <td width = "49.5%" align="justify" style="border: 1px solid black;font-size:7px;">
                    This certifies that the person named in this certificate is covered, subject to the terms, conditions, including warranties and clauses attached to the Master Policy issued by MAAGAP INSURANCE INC. This serves as evidence and receipt of your premium payment. Keep this in a safe palce.
                </td>
                <td width = "1%">
                
                </td>
                <td width = "49.5%" align="justify" style="border: 1px solid black;font-size:7px;">
                    Reminder: Regadless of the number of COI acquired, the following maximum limits will apply:<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;<i>1.) Unprovoked Murder or Assault up to Php 60,000.00;</i><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;<i>2.) Motorcycling up to Php 60,00.00;</i><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;<i>3.) Accidental Burial up to Php 10,000.00;</i><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;<i>4.) Cash Assistance Benefit up to Php 10,000.00;</i><br>
                    &nbsp;&nbsp;<i>5.) Educational Assistance Accident up to Php 25,000.00;Sickness up to Php 12,500.00</i><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;<i>6.) Number of COI per Person up to five (5).</i><br />
                    <div style="text-align: right; width: 100%; font-size: 10px;"><strong><i>Php {{ number_format(($transaction->price * intval($transaction->units)), 2)}}</i></strong></div>
                </td>
            </tr>
            <tr>
                <td width = "33.5%" align="justify" style="border: 1px solid black;">
                    NOTICE: The Insurance Commission is the government office in charge with the duty of safeguarding the interests of policyholders will render assistance of any complaints regarding insurance matters.
                </td>
                <td width = "33%" align="center" style="border: 1px solid black;">
                    <br><br><br><br>
                    Signature of Insured / Beneficiary<br>(not valid without signature)
                </td>
                <td width = "33.5%" align="center" style="border: 1px solid black;">
                    <br><br><br><br>
                    <strong>DANIEL C. GO</strong><br>MAAGAP INSURANCE INC.
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
                    <strong>Educational Assistance- </strong>pays up to 5,000.00 in case of death of the covered person due to accident and 2,500.00 due to sickness.  The qualified dependent who at that time of the Insured's death is a full time student and enrolled in any institution of learning or education.<br>
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
                    &nbsp;&nbsp;&nbsp;&nbsp;1.) Accident Claim form<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;2.) Death Certificate<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;3.) Accident Report & Autopsy Report <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;4.) Medical Certificate<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;5.) Proof of Relationship to the insured- Marriage Contract and /or Birth Certificate<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;6.) Newspaper clippings or picture of the insured's body or injured parts of the body<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;7.) Certificationby the specialist or EENT for loss of sight or eye injuries & diagram showing the location of the Injured body member/degree of disablement.
                </td>
            </tr>
            
    </table>

    
    
</div>