@include('includes.tcpdf_includes')
<style>
    table,td,th{
        font-family: Arial, Helvetica, sans-serif;
    }
    .tb1 {
        font-size: 0.9em;
        border:2px solid black;
    }
    table.tb4 td{
        text-align: center;
    }
    table.tb5, td{
        text-align: left;
    }
    .font-10 {
        font-size: 1em;
    }
    .font-9 {
        font-size: 0.9em;
    }
    .font-8 {
        font-size: 0.8em;
    }
    .font-7 {
        font-size: 0.7em;
    }
    .font-10 th {
        border:1px solid black;
    }
    .border {
        border: 1px solid black;
    }
    .bord td,th{
        border:1px solid black;
        text-align: center;
    }
    .border-bottom {
        border-bottom: 1px solid black;
    }
    .indent-10 {
        text-indent: 10px;
    }
    .indent-20 {
        text-indent: 20px;
    }
    .justify {
        text-align: justify;
    }

</style>
<div class="container">
    <table class="tb1 font-9" >
        <tr class="font10">
            <td width="25%"></td>
            <td align="center" width="30%"></td>
            <td  width="45%" align="right" style="font-size:10px">
                <br><br>
                {{-- <strong>MAA GENERAL ASSURANCE PHILS., INC.</strong> --}}
                <b>Certificate of Cover Number: <u>{{ $transaction->terminal_coi_number }}</u></b>
            </td>
        </tr>
        <tr><td></td></tr>
        <tr class="font-9">
            <td width = "100%" align="center">
                <b><u>ML TELEMEDICINE</u></b>
            </td>
        </tr>
        <tr><td></td></tr>
        <tr><td>
            <table cellspacing="1" class="font-8">
                <tr>
                    <td width = "24%" align="left">Name of Member</td>
                    <td width = "26%" class="border-bottom" nowrap>{{ $transaction->insured_name }}</td>
                    <td width = "24%" align="left">&nbsp;&nbsp;Policy Holder's Name</td>
                    <td width = "26%" class="border-bottom"><b>ML Telemedicine Program</b></td>
                </tr>
                <tr>
                    <td align="left">Contact No. / Telephone No.</td>
                    <td class="border-bottom" nowrap>{{ $transaction->contact_number }}</td>
                    <td align="left">&nbsp;&nbsp;Group Policy No.</td>
                    <td class="border-bottom"><b>{{ $transaction->policy_number }}</b></td>
                </tr>
                <tr>
                    <td align="left">E-Mail Address</td>
                    <td class="border-bottom" nowrap>{{ $transaction->email }}</td>
                    <td width = "18%" align="left">&nbsp;&nbsp;Period of Cover</td>
                    <td width = "6%" align="right">From</td>
                    <td width = "26%" class="border-bottom"><b>{{ $transaction->date_issued->format('m/d/Y') }}</b></td>
                </tr>
                <tr>
                    <td align="left">Beneficiary's Name</td>
                    <td class="border-bottom" nowrap>{{ $transaction->beneficiary }}</td>
                    <td width = "18%" align="left"></td>
                    <td width = "6%" align="right">To</td>
                    <td width = "26%" class="border-bottom"><b>{{ $transaction->date_issued->addYear()->format('m/d/Y') }}</b></td>
                </tr>
                <tr>
                    <td align="left">Relationship to the Member</td>
                    <td class="border-bottom" nowrap>{{ $transaction->relationship }}</td>
                    <td width = "24%" align="right"><b>Premium</b></td>
                    <td width = "26%"><b>PHP {{ number_format($transaction->price, 2) }} (incl. of taxes)</b></td>
                </tr>
            </table>
        </td></tr>
        <tr><td width="2%"></td><td width="98%"></td></tr>
        {{-- <tr><td></td><td><span class="font-9"><b>A. MEDIPHONE SERVICES</b></span></td></tr>
        <tr><td width="4%"></td><td width="96%"><span class="font-8"><b>24/7 Hotline Number: +632-8-459-4726</b></span></td></tr>
        <tr><td></td><td><span class="font-8">Email address: <u>ficosiam@iberoasistencia.ph</u></span></td></tr>
        <tr><td></td><td><span class="font-8">A 24-hours medical assistance service which allows the member with just a telephone call, to speak to a doctor and obtain medical advice.</span></td></tr>
        <tr>
            <td width="2%"></td>
            <td width="33%" class="justify"><span class="font-8"><b>Mediphone</b> is a medical service provided over the phone, which offers to the Member:<br />
                    &bull; Medical orientation all day long without waiting time in the hospital queue<br />
                    &bull; Real-time medical and technical support for all health-related questions<br />
                    &bull; General information and advice<br />
                    &bull; Medical assessment / advice</span>
            </td>
            <td width="33%" class="justify"><span class="font-8"><b>Mediphone</b> provides medical advice that includes but is not limited to the following:<br />
                    &bull; Situations that may NOT represent an emergency, where the patient will be in contact with a doctor who will evaluate his/her health condition and will give the appropriate medical advice<br />
                    &bull; Assessment of the need of consult to physicians<br />
                    &bull; Follow-up and control of patients</span>
            </td>
            <td width="32%" class="justify"><span class="font-8">Online documents to be issued by the doctors as necessary:<br />
                    1. Electronic Referral Letters to various doctors' specialist when needed<br />
                    2. Electronic Prescription<br />
                    3. Electronic Laboratory and Diagnostic Requests<br />
                    4. Electronic Medical Certificates</span></td></tr>
        <tr><td width="8%"></td><td width="92%"><b><i class="font-8">Note:</i></b></td></tr>
        <tr><td width="10%"></td><td width="90%"><span class="font-8">&bull; Doctors are on call from 6am to 11 pm but the call center is available 24/7 for any queries</span></td></tr>
        <tr><td width="10%"></td><td width="90%"><span class="font-8">&bull; Services are <b><u>non-transferrable</u></b></span></td></tr> --}}
        {{-- <tr><td width="2%"></td><td width="98%"></td></tr> --}}
        <tr><td width="2%"></td><td width="98%"><span class="font-9"><b>PERSONAL ACCIDENT</b></span></td></tr>
        <tr><td></td></tr>
        <tr><td width="2%"></td><td width="98%">
            <table class="font-9">
                <tr>
                    <td width="15%"></td>
                    <td class="border" width="45%" align="center"><b>Benefits</b></td>
                    <td class="border" width="25%" align="center"><b>Limit</b></td>
                    <td width="15%"></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="border">Accidental Death/ Permanent Disablement</td>
                    <td class="border" align="center">Php 25,000.00</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="border">Unprovoked Murder & Assault</td>
                    <td class="border" align="center">Php 25,000.00</td>
                    <td></td>
                </tr>
            </table>
        </td></tr>
        <tr><td></td></tr>
        <tr>
            <td width="2%"></td>
            <td width="98%" colspan="3" style="text-align: justify;"><span class="font-9">This certifies that the named member in this certificate is covered under the <b>Master Policy issued by MAA General Assurance Philippines, Inc.</b>  subject to the terms and conditions, warranties and clauses, including exceptions of the policy and all claims will be adjusted in accordance therewith.  This serves as evidence and receipt of your premium payment.</span></td>
            <td width="2%"></td>
        </tr>
        <tr><td></td></tr>
        <tr>
            <td width="2%"></td>
            <td width="38%"><b><span class="font-9">Acknowledge by:</span></b></td>
            <td width="15%"></td>
            <td width="38%"></td>
            <td width="2%"></td>
        </tr>
        <tr><td></td></tr>
        <tr>
            <td></td>
            <td style="border-bottom:1px solid black;"></td>
            <td></td>
            <td style="border-bottom:1px solid black;"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td align="left"><span class="font-9">Printed name of member over signature</span></td>
            <td></td>
            <td align="left"><span class="font-9"><b>DANIEL C. GO</b></span></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2" align="left"><span class="font-9">Relationship to the member: <u>{{ $transaction->relationship }}</u></span></td>
            <td align="left"><span class="font-9"><i>President & CEO</i></span></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2" align="left"><span class="font-9">Date of Issuance: {{ $transaction->date_issued ? Carbon\Carbon::parse($transaction->date_issued)->format('M d, Y') : null }} </span></td>
            <td align="left"><span class="font-9">MAA General Assurance Phils., Inc.</span></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td align="left"><span class="font-9"></span></td>
            <td></td>
        </tr>
        <tr>
            <td width="2%"></td>
            <td width="98%"><u><b><span class="font-8">COVERAGE A - ACCIDENTAL DEATH BENEFIT</span></b></u></td>
        </tr>
        <tr>
            <td></td>
            <td><span class="font-8">When injury results in loss of a Named insured within one hundred eighty (180) days after the date of the accident the Company will pay the principal Sum.</span></td>
        </tr>
        <tr><td></td></tr>
        <tr>
            <td></td>
            <td><u><b><span class="font-8">COVERAGE B - PERMANENT LOSS OF USE OR DISABLEMENT AND DISMEMBERMENT BENEFIT</span></b></u></td>
        </tr>
        <tr>
            <td></td>
            <td><span class="font-8">When injury results in any of the following losses within one hundred eighty (180) days after the date of the accident, the Company will pay for the loss of:</span></td>
        </tr>
        <tr><td></td></tr>
        {{-- <tr>
            <td width="15%"></td>
            <td width="44%"></td>
            <td width="1%"></td>
            <td width="25%"></td>
            <td width="15%"></td>
        </tr> --}}
        <tr>
            <td width="15%"></td>
            <td width="44%"><span class="font-8">Both Hands or Both Feet or Sight of Both Eyes ...................</span></td>
            <td width="1%"></td>
            <td width="25%" align="right"><span class="font-8">100% of the Principal Sum</span></td>
            <td width="15%"></td>
        </tr>
        <tr>
            <td></td>
            <td><span class="font-8">One hands and One Foot ....................................................</span></td>
            <td></td>
            <td align="right"><span class="font-8">100% of the Principal Sum</span></td>
        </tr>
        <tr>
            <td></td>
            <td><span class="font-8">Either Hand or Foot and Sight of One Eye ..........................</span></td>
            <td></td>
            <td align="right"><span class="font-8">100% of the Principal Sum</span></td>
        </tr>
        <tr>
            <td></td>
            <td><span class="font-8">Either Hand or Foot .............................................................</span></td>
            <td></td>
            <td align="right"><span class="font-8">50% of the Principal Sum</span></td>
        </tr>
        <tr>
            <td></td>
            <td><span class="font-8">Both Thumb and index Finger of Either Hand .....................</span></td>
            <td></td>
            <td align="right"><span class="font-8">10% of the Principal Sum</span></td>
        </tr>
        {{-- <tr>
            <td width="5%"></td>
            <td width="90%" style="text-align: justify;"><span class="font-9">The occurrence of any specific loss for which the corresponding indemnity provided above is payable to the Named Insured at no less than 100% of the Principal Sum Insured, shall at once terminate all insurance under the policy with respect to said Named Insured, but such termination shall be without prejudice to any claim originating out of the accident causing such loss.</span></td>
            <td width="5%"></td>
        </tr> --}}
        {{-- <tr>
            <td width="100%"></td>
        </tr> --}}
        <tr><td></td></tr>
        <tr>
            <td width="2%"></td>
            <td width="98%"><u><b><span class="font-8">NOTICE OF CLAIM</span></b></u></td>
        </tr>
        <tr>
            <td></td>
            <td><span class="font-8">Written notice of claim must be given to the Company within thirty (30) days after the date of the accident that resulted in injury to the Named Insured. In the event of accidental death immediate notice must be given to the Company.</span></td>
        </tr>
        <tr><td></td></tr>
        <tr><td colspan="3" align="center"><b><span class="font-8">LIST OF CLAIMS REQUIREMENT<br />ALL DOCUMENTS MUST BE IN ORIGINAL COPIES</span></b></td></tr>
        <tr>
            <td widt="2%"></td>
            <td width="33%"></td>
            <td width="33%"></td>
            <td width="33%"></td>
        </tr>
        <tr>
            <td></td>
            <td class="font-8">&bull; MAA Accident Claim Form<br />&bull; Valid Government Issued ID<br />&bull; Police Report<br />&bull; Medical Certificate</td>
            <td class="font-8">&bull; PSA Birth Certificate*<br />&bull; PSA Death Certificate**<br />&bull; PSA Marriage Certificate**<br />&bull; IMAM Certification***</td>
            <td class="font-8">&bull; Post Mortem Report<br />&bull; Medico Legal Report<br />&bull; Picture of Dead Body or Dismembered part of the Insured's body</td>
        </tr>
        <tr><td></td></tr>
        <tr>
            <td></td>
            <td colspan="3"><span class="font-8">Notes: * applies for both Insured & Beneficiaries | ** only if applicable | *** applies for Muslims only</span></td>
        </tr>
        <tr><td></td></tr>
        {{-- <tr>
            <td width="100%"></td>
        </tr> --}}
        {{-- <tr>
            <td width="100%" align="center">LIST OF REQUIREMENTS FOR CLAIMS:</td>
        </tr> --}}
        {{-- <tr>
            <td width="100%" align="center">ALL DOCUMENTS MUST BE IN ORIGINAL COPIES</td>
        </tr> --}}
        {{-- <tr>
            <td width="100%"></td>
        </tr> --}}
        {{-- <tr>
            <td width="5%"></td>
            <td width="50%" style="font-size: 7px;">1.	Accident Claim Form</td>
            <td width="50%" style="font-size: 7px;">6.	Police Report</td>
        </tr> --}}
        {{-- <tr>
            <td width="5%"></td>
            <td width="50%" style="font-size: 7px;">2.	Death Certificate, if applicable</td>
            <td width="50%" style="font-size: 7px;">7.	Medical Certificate</td>
        </tr> --}}
        {{-- <tr>
            <td width="5%"></td>
            <td width="50%" style="font-size: 7px;">3.	Marriage Contract, if applicable</td>
            <td width="50%" style="font-size: 7px;">8.	Birth Certificate (Insured and Beneficiary)</td>
        </tr> --}}
        {{-- <tr>
            <td width="5%"></td>
            <td width="50%" style="font-size: 7px;">4.	Medico Legal Report</td>
            <td width="50%" style="font-size: 7px;">9.	IMAM Certification, for Muslims</td>
        </tr> --}}
        {{-- <tr>
            <td width="5%"></td>
            <td width="50%" style="font-size: 7px;">5.	Post Mortem Report</td>
            <td width="45%" style="font-size: 7px;">10.	Pictures of Dead Bodies or Dismembered parts of the Insured’s Body</td>
        </tr> --}}
        {{-- <tr><td width="100%"></td></tr> --}}
        <tr>
            <td width="43%"><i><b><span class="font-7">The Copy of the Group Policy is available for inspection, reading, or copying at the principal office of the Policy Holder.</span></b></i></td>
            <td width="57%" align="right"><span class="font-7"><br />Underwritten by <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MAA General Assurance Phils., Inc</strong><br />10/F Pearlbank Centre, 146 Valero Street, Salcedo Village, Makati City, Philippines 1227</span></td>
        </tr>
    </table>
</div>