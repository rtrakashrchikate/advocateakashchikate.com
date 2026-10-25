<?php
/**
 * "What this means for you" sections appended to case notes (audit Phase 3).
 * Keyed by case_result slug. Sections are cited under the law that applied
 * to the order, with the BNS / BNSS / BSA equivalent for cases registered
 * on or after 1 July 2024.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

return [

'anticipatory-bail-sc-st-act-bhc-2025-sayyed' => [
    'Section 18 of the Atrocities Act bars anticipatory bail, but after <em>Prathvi Raj Chauhan v. Union of India</em> (2020) the bar does not apply where the FIR does not make out a prima facie case against the applicant.',
    'Read the FIR closely: if you are not named, or the caste-based abuse is attributed to "all accused" without saying who said what, that is the point to build the application on.',
    'The complainant\'s own record and the background dispute (here, a civic work-site quarrel) are relevant to whether the allegation is genuine.',
    'Since 1 July 2024 the application is filed under Section 482 BNSS (old Section 438 CrPC). If the Special Court refuses, an appeal lies to the High Court under Section 14A of the Atrocities Act.',
],

'attempt-murder-arms-act-bail-bhc-2025' => [
    'If the Sessions Court rejects bail, a fresh application lies to the High Court; a rejection below is not the end of the road.',
    'Compare the medical certificate with the weapon alleged in the FIR. An injury that does not match the weapon is a strong bail ground in Section 307 IPC cases (Section 109 BNS for FIRs after 1 July 2024).',
    'Long custody without charges being framed weighs heavily, especially for a young accused with no record.',
    'Parity: list every co-accused already on bail and show that their alleged roles were equal to or greater than yours.',
],

'child-trafficking-bail-section-370-bhc-2025' => [
    'Even in serious offences like trafficking (Section 370 IPC, now Section 143 BNS), bail can be granted where the main accused and co-accused are already on bail.',
    'Nearly three years in custody without charges being framed is a ground in its own right: the right to a speedy trial under Article 21 weighs even in serious offences.',
    'Whether the facts actually fit the offence charged is a legitimate bail argument, not just a trial issue.',
    'Keep a dated record of every bail order passed for co-accused; the court will want copies.',
],

'interim-protection-eow-financial-fraud-bhc-2025' => [
    'In EOW cases arising from business or investment disputes, the High Court can grant interim protection (no coercive action) while the anticipatory bail or quashing petition is heard.',
    'Show why the dispute is civil: the agreements, the payment trail and any civil suits filed by either side.',
    'Unexplained delay in lodging the FIR is a recognised factor in assessing whether the complaint is genuine.',
    'A deposit with the court can demonstrate good faith, but it is a strategic choice to be weighed before offering it, not a requirement.',
],

'mcoca-proclamation-stayed-bhc-2025' => [
    'A proclamation declaring you absconding (Section 82 CrPC, now Section 84 BNSS) can be challenged in the High Court when the procedure was not followed.',
    'If you have filed an anticipatory bail application and the police know about it, you are using the legal process, which undercuts the claim that you are absconding.',
    'Keep proof of every application filed and every date attended; it is your answer to an "absconding" label.',
    'In MCOCA matters the Special Court hears anticipatory bail first; the High Court can direct that it be heard on priority.',
],

'murder-bail-granted-after-4-years-bhc-2025' => [
    'Bail in a murder case is possible where the facts point to a sudden quarrel without premeditation, which brings Exception 4 to Section 300 IPC (now Exception 4 to Section 101 BNS) into play.',
    'Trial delay matters: here only 1 of 26 prosecution witnesses had been examined in over four years.',
    'If bail was rejected earlier, a change in circumstances such as further years in custody or a stalled trial supports a fresh application.',
    'Get certified copies of the roznama (daily proceedings) to show the court exactly how slowly the trial has moved.',
],

'murder-conviction-altered-304-sentence-reduced-bhc-db-2025' => [
    'A murder conviction can be reduced on appeal to culpable homicide not amounting to murder (Section 304 Part I IPC, now Section 105 BNS) where the incident was a sudden fight.',
    'Injuries on the accused that the prosecution does not explain, and the absence of motive or prior enmity, are central appeal points.',
    'Where the reduced sentence is less than the time already spent in custody, the court can order release.',
    'Appeals against conviction lie to the High Court; long-pending appeals can be pressed for early hearing.',
],

'murder-conviction-bail-rejected-bhc-db-2025' => [
    'Parity with co-accused is not automatic. Where eyewitnesses attribute a specific weapon and role to you, bail granted to others will not carry over.',
    'Before applying for bail pending appeal (Section 389 CrPC, now Section 430 BNSS), assess honestly how the evidence describes your individual role.',
    'If bail is refused, pressing for an early final hearing of the appeal is often the better course.',
    'Any later change, such as a long period of custody or a delay in the appeal being heard, can support a fresh application.',
],

'murder-conviction-bail-women-co-accused-bhc-db-2025' => [
    'In convictions with the aid of Section 149 IPC (unlawful assembly, now Section 190 BNS), each accused\'s actual role is examined separately.',
    'Where an independent eyewitness does not mention you and no weapon is attributed to you, bail pending appeal is a realistic option.',
    'Family members of the main accused are sometimes named because of the relationship; the court looks for evidence of individual participation.',
    'A clean record on bail during the trial strongly supports bail after conviction.',
],

'murder-sentence-suspended-bail-bhc-db-2025-jamdade' => [
    'Even after a life sentence, the High Court can suspend the sentence pending appeal (Section 389 CrPC, now Section 430 BNSS) where the conviction rests on weak evidence.',
    'Check the panchnamas: the same panch witness in both the spot and recovery panchnamas, or a "recovery" from a spot already searched, are recognised weaknesses.',
    'Hostile eyewitnesses leave the prosecution relying on circumstantial evidence, which must form a complete chain.',
    'Section 106 of the Evidence Act (now Section 109 BSA) does not relieve the prosecution of proving its case first.',
],

'pocso-conviction-bail-pending-appeal-bhc-2025' => [
    'Bail pending appeal is possible after a POCSO conviction where the victim\'s own deposition does not support the prosecution\'s version.',
    'Read the deposition, not just the FIR: what the victim said in court is what the appeal court weighs.',
    'A sentence that is disproportionate to the proved facts is itself a ground for suspending it pending appeal.',
    'Kidnapping under Section 363 IPC corresponds to Section 137(2) BNS for cases registered after 1 July 2024.',
],

];
