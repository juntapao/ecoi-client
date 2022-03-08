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
        {{-- <tr>
            <td width="100%" align="center" style="font-size:10px;">
                <strong>
                <i>Confirmation of Insurance - KP PROTECT</i>
                </strong> 
            </td>
        </tr> --}}
        <tr>
            <td width="50.5%">
                Branch: <strong>{{$transaction->userbranch}}</strong>
            </td>
            <td width="24.75%" align="right">
                
            </td>
            <td width="24.75%" align="center">
                Date Issued: {{ $transaction->date_issued ? Carbon\Carbon::parse($transaction->date_issued)->format('m/d/Y') : null }}
            </td>

        </tr>
        <tr>
            {{--    1st table --}}
            <td width = "50%" style="border: 1px solid black;">
               <strong><i>COI No. D</i></strong> {{$transaction->coi_number}}
                
            </td>
            <td width = ".5%">
            {{--    2nd table --}}
            </td>
            <td width = "24.75%"  style="border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">
                Group <i>Policy</i> Holder <br> <strong>Holder of ML Family Protect</strong>
            </td>
            <td width = "24.75%"  style="border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">
                {{-- Issue Date: {{ $transaction->date_issued ? Carbon\Carbon::parse($transaction->date_issued)->format('m/d/Y') : null }} <br> Policy No.: {{$transaction->policy_number}} --}}
                Master Policy Number<br />{{$transaction->policy_number}}
            </td>
            
        </tr>
        <tr>
            {{--    1st table --}}
            <td width = "50%" style="border-left: 1px solid black;border-right: 1px solid black;">
                <i>Name of Insured</i>
                
            </td>
            <td width = ".5%">
            {{--    2nd table --}}
            </td>
            <td width = "49.5%"  style="border-left: 1px solid black;border-right: 1px solid black;">
                <i>Principal Sum</i>
            </td>
            
        </tr>
        <tr>
            {{--    1st table --}}
            <td width = "50%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                {{$transaction->insured_name}}
                
            </td>
            <td width = ".5%">
            {{--    2nd table --}}
            </td>
            <td width = "49.5%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                {{-- <i>P 30,000.00</i> --}}
                {{$holder['accident_principal']}}
            </td>
            
        </tr>
        <tr>
            {{--    1st table --}}
            <td width = "50%" style="border-left: 1px solid black;border-right: 1px solid black;">
                <i>Date of Birth</i>
                
            </td>
            <td width = ".5%">
            {{--    2nd table --}}
            </td>
            <td width = "24.75%"  style="border-left: 1px solid black;">
                <i>Unprovoked Murder & Assault </i>
            </td>
            <td width = "24.75%"  style="border-right: 1px solid black;">
                {{-- <i>P 30,000.00 </i> --}}
                {{$holder['unprovoke_principal']}}
            </td>
        </tr>
        <tr>
            {{--    1st table --}}
            <td width = "50%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                {{ $transaction->dateofbirth ? Carbon\Carbon::parse($transaction->dateofbirth)->format('m/d/Y') : null }}
                
            </td>
            <td width = ".5%">
            {{--    2nd table --}}
            </td>
            <td width = "24.75%" align="right" style="border-left: 1px solid black;border-bottom: 1px solid black;">
                <i>Motorcycling</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </td>
            <td width = "24.75%"  style="border-right: 1px solid black;border-bottom: 1px solid black;">
                {{-- <i>P 30,000.00</i> --}}
                {{$holder['motor_principal']}}
            </td>
            
        </tr>
        <tr>
            {{--    1st table --}}
            <td width = "50%"  style="border-left: 1px solid black;border-right: 1px solid black;">
                <i>Beneficiary / Relationship</i>
                
            </td>
            <td width = ".5%">
            {{--    2nd table --}}
            </td>
            <td width = "49.5%" style="border-left: 1px solid black;border-right: 1px solid black;">
                <i>Accident Burial Assistance</i>
            </td>
            
        </tr>
        <tr>
            {{--    1st table --}}
            <td width = "50%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                {{$transaction->beneficiary}} / {{$transaction->relationship}}
                
            </td>
            <td width = ".5%">
            {{--    2nd table --}}
            </td>
            <td width = "49.5%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                {{-- <i>P 10,000.00</i> --}}
                {{$holder['burial_principal']}}
            </td>
            
        </tr>
        <tr>
            {{--    1st table --}}
            <td width = "50%" align="justify" style="border-left: 1px solid black;border-right: 1px solid black;font-size:7px;">
                This certifies that the person named above is insured under and subject<br>&nbsp;&nbsp;to all terms and conditions, warranties and clauses of the above-stated<br>&nbsp;&nbsp;policy.
                
            </td>
            <td width = ".5%">
            {{--    2nd table --}}
            </td>
            <td width = "49.5%" align="justify" style="border-left: 1px solid black;border-right: 1px solid black;font-size:7px;">
                Terms of Insurance: The insurance will take effect from date of application and expiring one (1) year therafter. This COI also serves as evidence of receipt of premium payment.
            </td>
            
        </tr>
        <tr>
            {{--    1st table --}}
            <td width = "50%" align="justify" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;font-size:7px;">
                
            </td>
            <td width = ".5%">
            {{--    2nd table --}}
            </td>
            <td width = "49.5%" align="right" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;font-size:10px;">
                <strong><i>Php {{ number_format(($transaction->price * intval($transaction->units)), 2)}}</i></strong>
                {{-- <strong><i>Php 30.00</i></strong> --}}
            </td>
            
        </tr>
        <tr>
            <td width="100%" style="font-size:0px;">

            </td>
        </tr>
        <tr>
            <td width = "33.5%" align="justify" style="border: 1px solid black;font-size:7px;">
                NOTICE: The Insurance Commission is the government office in charge with the duty of safeguarding the interests of policyholders will render assistance of any complaints regarding insurance matters.
            </td>
            <td width = "33%" align="center" style="border: 1px solid black;">
                <br><br><br>
                Signature of Insured / Beneficiary<br>(not valid without signature)
            </td>
            <td width = "33.5%" align="center" style="border: 1px solid black;">
                <br><br>
                <strong>DANIEL C. GO</strong><br>President & CEO<br>MAA General Assurance Phils., Inc.
            </td>
        </tr>
        <tr>
            <td width = "100%" align="center" >
                COVERAGE A - Accidental Death Benefit<br>
                <font size="7">
                    When injury results in loss of a Named insured within insured hundrer eighty (180) days after the date of the accident the Company will pay the principal Sum.
                </font><br>
                COVERAGE B - PERMANENT LOSS OF USE OR DISABLEMENT AND DISMEMBERMENT BENEFIT<br>
                <font size="7">
                    When injury results in any of the following losses within one hundred eighty (180) days after the date of the accident, the Company will pay for the loss of:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </font>
            </td>
        </tr>
        <tr>
            <td width="10%"></td>
            <td width = "37%" style="font-size:7px;">
                    Both Hands or Both Feet or Sight of Both Eyes.....................<br>
                    One hand and One Foot.........................................................<br>
                    Either Hand or Foot and Sight of One Eye.............................<br>
                    Either Hand or Foot................................................................<br>
                    Sight of One Eye....................................................................<br>
                    Both Thumb and index Finger of Either Hand........................

            </td>
            <td width = "20%" align="right" style="font-size:7px">
                100% of the Principal Sum<br>
                100% of the Principal Sum<br>
                100% of the Principal Sum<br>
                One Half of the Principal Sum<br>
                One Half of the Principal Sum<br>
                One Tent The Principal Sum
            </td>
        </tr>
        <tr>
            <td width="100%" style="font-size:7px;">
                The occurrence of any specipic loss for which the corresponding indemnity provided above is payableto the Named Insured at no less than 100% of the Principal Sum<br>&nbsp;&nbsp;Insured, shall at once terminate all insurance under the policy with respect to said Named Insured, but suchtermination shall be without prejudice to any claim originating<br>&nbsp;&nbsp;out of the accident causing such loss.
                
            </td>
        </tr>
        <tr>
            <td width="100%" align="center">
                EXCLUSIONS
            </td>
        </tr>
        <tr>
            <td width="100%"  style="font-size:7px;">
                The Policy does not cover:<br>
                a.)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Any loss or expense caused by or resulting from: <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                1)&nbsp;&nbsp;&nbsp;&nbsp;Intentionally self-inflicted injury, suicide or any attempt thereat while sane or insane.<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                2)&nbsp;&nbsp;&nbsp;&nbsp;War, invasion, act of foreign enemy hostilities or warlike operations (whether war be declared or not), mutiny, riot, civil commotions, conspiracy, military or<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;usurped power, martial law or state of siege, seizure, quarantine: or customs regulation, or nationalization by or under the order of any government or public<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;or local authoryty, or any weapon or intrument employing atomic fission or radioactive force, whether in time of peace or war.<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                3)&nbsp;&nbsp;&nbsp;&nbsp;Provoked assault.<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                4)&nbsp;&nbsp;&nbsp;&nbsp;Congenital defects and conditions arising there from<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                5)&nbsp;&nbsp;&nbsp;&nbsp;Accidents giving rise to a claim as a result of or consequent upon whilst the inured is engaged in any related military, police and civillians with peace and<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;order duties such as but not limited to police or military pursuits, raids, encounters, assault, undercover assignments, any form of combat tests and trainings,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Investigation, assignment, disasterrelief and rescue operations, classified or undercover missions/operations, intelligence firing range of any type, and any<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;other similar nature of work and activities<br>
                b.)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name Insured's attempted commission or willful participation in any crime punishable under the Revised Pesal Code of the Philippines except crime of rockets<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;imprudence as defined in Article 365 or under similar laws of any country in which the crime was attempted, or resistance to lawful arrest.<br>
                c.)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Motorcycle-related injuries or fatality if the insured person was established to have a expired or invalid driver's licence an expired vehicle registration: been under<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;the influence of prohibited drugs or alcohol: been violating traffic laws and regulations at the time of the accident<br>
                d.)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Police Man, NBI and other civilian authority whose duly is to maintain peace and araer while serving in the Armed Forces of any country or intemational authority,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;or vessel: while operating, learning to operate or serving as a crew member af an aircraft or vessel Fireman, while on duty<br>
                e.)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;It is hereby provided that the minors ages seven (7) to seventeen (17) years old, certificates are signed by an authorized guardian in behalf of the minor.
            </td>
        </tr>
        <tr>
            <td width="100%" align="center">
                IMPORTANT
            </td>
        </tr>
        <tr>
            <td width="100%"  style="font-size:7px;">
                This policy can only cover up to a maximum of five (5) certificates or a maximum of P150,000 for any person regardless whether the person has more than five (5)<br>&nbsp;&nbsp;certificates in his name. 
                For burial assistance, this policy can only cover up to a maximum P10,000 for any one person regardless whether the person has more than one<br>&nbsp;&nbsp;(1) certificates in his name.
                For murder & unprovoked assault, this policy can only cover up to a maximum of P60 000 for any one person regardless whether the person<br>&nbsp;&nbsp;has more then two (2)certificate in his name.
                For Motorcycling coverage, this policy can cover up to a maximum of P30.000 for any one person regardless whether the<br>&nbsp;&nbsp;person has more than one (1) certificate in his name.
                This certificate is not valid unless signed by insured person in the presence of authorized ML representative. For<br>&nbsp;&nbsp;ages between 7 to 17 years old and 66-70 years old, the benefit limit is limited to 50% only.
            </td>
        </tr>
        <tr>
            <td width="100%" align="center">
                NOTICE OF CLAIM
            </td>
        </tr>
        <tr>
            <td width="100%"  style="font-size:7px;">
                Written notice of claim must be given to the Company within thirty (30) days after the date o he accident that resulted in injury to the Named Insured. In of accidental<br>&nbsp;&nbsp;death mediate notice must be given to the Company.
            </td>
        </tr>
        <tr>
            <td width="100%" align="center">
                LIST OF REQUIREMENTS FOR CLAIMS:<br>
                ALL DOCUMENTS MUST BE IN ORIGINAL COPIES
            </td>
        </tr>
        <tr>
            <td width="100%" style="font-size:7px;">
                <font size="10px">
                    <strong>For death claim</strong>
                </font>
                
                
            </td>
        </tr>
        <tr>
            <td width="3%">

            </td>
            <td width="23%" align="left" style="font-size:7px;" >
                1. Death <br>
                2. Marriage Contract (if Married)<br>
                3. Medico Legal Report <br>
                4. Post Morterm Report

            </td>
            <td width="27.33%" style="font-size:7px;" align="left">
                5.Police Report <br>
                6. Medical Certificate <br>
                7. Birth Certificate (Insured & Beneficiary)
            </td>
            <td width="46.67%" style="font-size:7px;" align="left">
                8. Certificate of Insurance <br>
                9. Accident Claim Form<br>
                10. For Muslims, IMAM Certification<br>
                11. Pictures of the dead bodies or dismembered parts of the insured's body.
            </td>
        </tr>
        <tr>
            <td width="100%" style="font-size:7px;">
                {{-- Note: Maximum of Three (3) COls claimable per person. One (1) COl per person, for death due to motorcycling. --}}
            </td>
        </tr>

    </table>
</div>