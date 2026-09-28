#!/usr/bin/env python3
"""
Lead Magnet PDF Generator — Advocate Akash Chikate & Associates
Creates 8 branded PDF guides for the advocateakashchikate.com website.
Usage: python create_pdfs.py
Output: ./output/ directory (8 PDF files)
"""

import os
from reportlab.lib import colors
from reportlab.lib.pagesizes import A4
from reportlab.lib.styles import ParagraphStyle
from reportlab.lib.units import cm
from reportlab.platypus import (
    SimpleDocTemplate, Paragraph, Spacer, Table, TableStyle,
    PageBreak, HRFlowable, KeepTogether
)
from reportlab.lib.enums import TA_CENTER, TA_LEFT, TA_JUSTIFY, TA_RIGHT

# ─── Brand ────────────────────────────────────────────────────────────────────
NAVY      = colors.HexColor('#0A1628')
GOLD      = colors.HexColor('#C9A96E')
WHITE     = colors.white
L_GRAY    = colors.HexColor('#F5F5F5')
D_GRAY    = colors.HexColor('#2A2A2A')
M_GRAY    = colors.HexColor('#666666')
ACCENT_BG = colors.HexColor('#EEF2F8')
RED_WARN  = colors.HexColor('#8B0000')

# ─── Firm Details ─────────────────────────────────────────────────────────────
FIRM      = "Advocate Akash Chikate & Associates"
WEBSITE   = "advocateakashchikate.com"
WHATSAPP  = "+91 8698400302"
PHONE     = "+91 8411982241"
EMAIL     = "contact@advocateakashchikate.com"
ADDRESS   = "Office No. 202-203, Ekbote Complex, Revenue Colony, Shivajinagar, Pune"
DISCLAIMER = (
    "This guide is for general informational purposes only and does not constitute "
    "legal advice. Outcomes in legal matters vary based on facts and circumstances. "
    "Consult a qualified advocate for advice specific to your matter. "
    "Advocate Akash Chikate — Bar Council of India Licensed Advocate."
)

# ─── Page layout ─────────────────────────────────────────────────────────────
W, H        = A4
L_MAR       = 2.2 * cm
R_MAR       = 2.2 * cm
T_MAR       = 2.8 * cm   # extra for header bar
B_MAR       = 2.5 * cm   # extra for footer bar

OUTPUT_DIR  = os.path.join(os.path.dirname(__file__), "output")
os.makedirs(OUTPUT_DIR, exist_ok=True)

# ─── Styles ───────────────────────────────────────────────────────────────────
def S():
    return {
        'H1': ParagraphStyle('H1',
            fontName='Times-Bold', fontSize=22, textColor=NAVY,
            spaceBefore=18, spaceAfter=10, leading=28),
        'H2': ParagraphStyle('H2',
            fontName='Times-Bold', fontSize=15, textColor=NAVY,
            spaceBefore=14, spaceAfter=8, leading=20),
        'H3': ParagraphStyle('H3',
            fontName='Helvetica-Bold', fontSize=11, textColor=NAVY,
            spaceBefore=10, spaceAfter=5, leading=16),
        'Body': ParagraphStyle('Body',
            fontName='Helvetica', fontSize=10.5, textColor=D_GRAY,
            spaceBefore=3, spaceAfter=6, leading=16, alignment=TA_JUSTIFY),
        'Bullet': ParagraphStyle('Bullet',
            fontName='Helvetica', fontSize=10.5, textColor=D_GRAY,
            spaceBefore=2, spaceAfter=3, leading=15, leftIndent=12),
        'StepNum': ParagraphStyle('StepNum',
            fontName='Helvetica-Bold', fontSize=11.5, textColor=NAVY,
            spaceBefore=10, spaceAfter=3, leading=16),
        'StepBody': ParagraphStyle('StepBody',
            fontName='Helvetica', fontSize=10.5, textColor=D_GRAY,
            spaceBefore=2, spaceAfter=7, leading=15,
            leftIndent=18, alignment=TA_JUSTIFY),
        'Important': ParagraphStyle('Important',
            fontName='Helvetica-Bold', fontSize=10.5, textColor=RED_WARN,
            spaceBefore=4, spaceAfter=4, leading=15),
        'Small': ParagraphStyle('Small',
            fontName='Helvetica', fontSize=8, textColor=M_GRAY,
            alignment=TA_CENTER, leading=11),
        'CTATitle': ParagraphStyle('CTATitle',
            fontName='Times-Bold', fontSize=20, textColor=WHITE,
            alignment=TA_CENTER, spaceAfter=6, leading=26),
        'CTABody': ParagraphStyle('CTABody',
            fontName='Helvetica', fontSize=11.5, textColor=WHITE,
            alignment=TA_CENTER, spaceAfter=5, leading=17),
        'CTAContact': ParagraphStyle('CTAContact',
            fontName='Helvetica-Bold', fontSize=13, textColor=GOLD,
            alignment=TA_CENTER, spaceAfter=4, leading=19),
        'TableHead': ParagraphStyle('TableHead',
            fontName='Helvetica-Bold', fontSize=9.5, textColor=WHITE,
            alignment=TA_CENTER, leading=13),
        'TableCell': ParagraphStyle('TableCell',
            fontName='Helvetica', fontSize=9.5, textColor=D_GRAY,
            alignment=TA_CENTER, leading=13),
    }

# ─── Canvas callbacks ─────────────────────────────────────────────────────────
def page_header_footer(canvas, doc):
    canvas.saveState()
    # Header navy bar
    canvas.setFillColor(NAVY)
    canvas.rect(0, H - 1.6*cm, W, 1.6*cm, fill=1, stroke=0)
    # Header text
    canvas.setFillColor(WHITE)
    canvas.setFont('Helvetica-Bold', 9.5)
    canvas.drawString(L_MAR, H - 1.05*cm, FIRM)
    canvas.setFillColor(GOLD)
    canvas.setFont('Helvetica', 9)
    canvas.drawRightString(W - R_MAR, H - 1.05*cm, WEBSITE)
    # Gold rule under header
    canvas.setStrokeColor(GOLD)
    canvas.setLineWidth(1.5)
    canvas.line(L_MAR, H - 1.65*cm, W - R_MAR, H - 1.65*cm)
    # Footer rule
    fy = 1.7 * cm
    canvas.setLineWidth(0.75)
    canvas.line(L_MAR, fy, W - R_MAR, fy)
    # Footer disclaimer
    canvas.setFillColor(M_GRAY)
    canvas.setFont('Helvetica', 7)
    short = DISCLAIMER[:110] + "..."
    canvas.drawString(L_MAR, fy - 0.45*cm, short)
    # Page number
    canvas.setFillColor(NAVY)
    canvas.setFont('Helvetica-Bold', 9)
    canvas.drawRightString(W - R_MAR, fy - 0.45*cm, f"Page {doc.page}")
    canvas.restoreState()

def cover_callback(title, subtitle, guide_num):
    def fn(canvas, doc):
        if doc.page == 1:
            _draw_cover(canvas, title, subtitle, guide_num)
        else:
            page_header_footer(canvas, doc)
    return fn

def _draw_cover(canvas, title, subtitle, guide_num):
    # Full navy background
    canvas.setFillColor(NAVY)
    canvas.rect(0, 0, W, H, fill=1, stroke=0)
    # Gold top bar
    canvas.setFillColor(GOLD)
    canvas.rect(0, H - 0.9*cm, W, 0.9*cm, fill=1, stroke=0)
    # Gold bottom bar
    canvas.rect(0, 0, W, 0.9*cm, fill=1, stroke=0)
    # Gold left accent
    canvas.rect(0, 0, 0.6*cm, H, fill=1, stroke=0)
    # Gold right accent
    canvas.rect(W - 0.6*cm, 0, 0.6*cm, H, fill=1, stroke=0)

    # Guide badge
    canvas.setFillColor(GOLD)
    canvas.setFont('Helvetica-Bold', 10)
    canvas.drawCentredString(W/2, H * 0.76, f"FREE LEGAL GUIDE  #{guide_num}")

    # Rule above title
    canvas.setStrokeColor(GOLD)
    canvas.setLineWidth(1.5)
    canvas.line(2.5*cm, H * 0.73, W - 2.5*cm, H * 0.73)

    # Title
    canvas.setFillColor(WHITE)
    canvas.setFont('Times-Bold', 25)
    lines = title.split('\n')
    y = H * 0.67
    for line in lines:
        canvas.drawCentredString(W/2, y, line)
        y -= 1.9*cm

    # Rule below title
    canvas.setStrokeColor(GOLD)
    canvas.line(2.5*cm, y + 1.1*cm, W - 2.5*cm, y + 1.1*cm)

    # Subtitle
    canvas.setFillColor(GOLD)
    canvas.setFont('Times-Roman', 13)
    sub_lines = subtitle.split('\n')
    y2 = y + 0.5*cm
    for line in sub_lines:
        canvas.drawCentredString(W/2, y2, line)
        y2 -= 0.75*cm

    # Divider
    canvas.setStrokeColor(colors.HexColor('#FFFFFF40'))
    canvas.setLineWidth(0.5)
    canvas.line(3*cm, H * 0.28, W - 3*cm, H * 0.28)

    # Firm block
    canvas.setFillColor(WHITE)
    canvas.setFont('Helvetica-Bold', 11.5)
    canvas.drawCentredString(W/2, H * 0.245, FIRM)
    canvas.setFillColor(colors.HexColor('#AAAAAA'))
    canvas.setFont('Helvetica', 9.5)
    canvas.drawCentredString(W/2, H * 0.21, "Bombay High Court  |  District Courts, Pune")
    canvas.drawCentredString(W/2, H * 0.185, "LLM — Science & Technology Laws (First Class Distinction)  |  Diploma in Cyber Laws")
    canvas.setFillColor(GOLD)
    canvas.setFont('Helvetica-Bold', 10.5)
    canvas.drawCentredString(W/2, H * 0.14, f"WhatsApp: {WHATSAPP}")
    canvas.drawCentredString(W/2, H * 0.115, f"www.{WEBSITE}")

# ─── Reusable blocks ──────────────────────────────────────────────────────────
def callout(text, bg=None, border_color=None):
    s = S()
    bg = bg or ACCENT_BG
    border_color = border_color or NAVY
    data = [[Paragraph(text, s['Body'])]]
    t = Table(data, colWidths=[W - L_MAR - R_MAR - 0.4*cm])
    t.setStyle(TableStyle([
        ('BACKGROUND',    (0,0), (-1,-1), bg),
        ('LEFTPADDING',   (0,0), (-1,-1), 14),
        ('RIGHTPADDING',  (0,0), (-1,-1), 14),
        ('TOPPADDING',    (0,0), (-1,-1), 11),
        ('BOTTOMPADDING', (0,0), (-1,-1), 11),
        ('BOX',           (0,0), (-1,-1), 1.5, GOLD),
        ('LINEBEFORE',    (0,0), (0,-1),  5,   border_color),
    ]))
    return t

def warning(text):
    s = S()
    data = [[Paragraph(f"<b>WARNING:</b> {text}", s['Important'])]]
    t = Table(data, colWidths=[W - L_MAR - R_MAR - 0.4*cm])
    t.setStyle(TableStyle([
        ('BACKGROUND',    (0,0), (-1,-1), colors.HexColor('#FFF0F0')),
        ('LEFTPADDING',   (0,0), (-1,-1), 14),
        ('RIGHTPADDING',  (0,0), (-1,-1), 14),
        ('TOPPADDING',    (0,0), (-1,-1), 10),
        ('BOTTOMPADDING', (0,0), (-1,-1), 10),
        ('BOX',           (0,0), (-1,-1), 1.5, RED_WARN),
        ('LINEBEFORE',    (0,0), (0,-1),  5,   RED_WARN),
    ]))
    return t

def section_divider(label):
    s = S()
    items = [
        HRFlowable(width="100%", thickness=0.75, color=GOLD, spaceAfter=4, spaceBefore=12),
        Paragraph(label.upper(), ParagraphStyle('SDiv',
            fontName='Helvetica-Bold', fontSize=8.5, textColor=GOLD,
            spaceBefore=0, spaceAfter=8, leading=12)),
    ]
    return items

def cta_page():
    s = S()
    items = [PageBreak()]
    rows = [
        [Paragraph("Need Legal Help? Contact Us Now", s['CTATitle'])],
        [Spacer(1, 0.2*cm)],
        [Paragraph("Your defence begins the moment you contact us.", s['CTABody'])],
        [Paragraph("Emergency consultations available 7 days a week.", s['CTABody'])],
        [Spacer(1, 0.4*cm)],
        [Paragraph(f"\u2709  WhatsApp (Preferred): {WHATSAPP}", s['CTAContact'])],
        [Paragraph(f"\u260e  Call: {PHONE}", s['CTAContact'])],
        [Paragraph(f"\u2709  Email: {EMAIL}", s['CTAContact'])],
        [Spacer(1, 0.3*cm)],
        [Paragraph(f"www.{WEBSITE}", s['CTAContact'])],
        [Spacer(1, 0.2*cm)],
        [Paragraph(ADDRESS, s['CTABody'])],
        [Spacer(1, 0.5*cm)],
        [Paragraph(
            "Bombay High Court  \u2022  Sessions Court Pune  \u2022  District Courts Maharashtra",
            s['CTABody'])],
    ]
    cta = Table(rows, colWidths=[W - L_MAR - R_MAR])
    cta.setStyle(TableStyle([
        ('BACKGROUND',    (0,0), (-1,-1), NAVY),
        ('LEFTPADDING',   (0,0), (-1,-1), 24),
        ('RIGHTPADDING',  (0,0), (-1,-1), 24),
        ('TOPPADDING',    (0,0), (0,0),   28),
        ('TOPPADDING',    (0,1), (-1,-1), 3),
        ('BOTTOMPADDING', (0,0), (-1,-2), 3),
        ('BOTTOMPADDING', (-1,-1), (-1,-1), 28),
    ]))
    items.append(cta)
    items.append(Spacer(1, 0.8*cm))
    items.append(Paragraph(
        "99+ legal matters handled  \u2022  27+ Bombay High Court orders  \u2022  Murder convictions set aside",
        ParagraphStyle('Stats', fontName='Helvetica', fontSize=10, textColor=NAVY,
                       alignment=TA_CENTER, leading=14)
    ))
    items.append(Spacer(1, 0.3*cm))
    items.append(Paragraph(DISCLAIMER, s['Small']))
    return items

def make_table(headers, rows, col_widths):
    """Build a styled data table."""
    s = S()
    data = [[Paragraph(h, s['TableHead']) for h in headers]]
    for row in rows:
        data.append([Paragraph(str(c), s['TableCell']) for c in row])
    t = Table(data, colWidths=col_widths)
    t.setStyle(TableStyle([
        ('BACKGROUND',    (0,0), (-1,0),  NAVY),
        ('TEXTCOLOR',     (0,0), (-1,0),  WHITE),
        ('FONTNAME',      (0,0), (-1,0),  'Helvetica-Bold'),
        ('ROWBACKGROUNDS',(0,1), (-1,-1), [WHITE, L_GRAY]),
        ('ALIGN',         (0,0), (-1,-1), 'CENTER'),
        ('VALIGN',        (0,0), (-1,-1), 'MIDDLE'),
        ('GRID',          (0,0), (-1,-1), 0.5, colors.HexColor('#CCCCCC')),
        ('TOPPADDING',    (0,0), (-1,-1), 7),
        ('BOTTOMPADDING', (0,0), (-1,-1), 7),
        ('LEFTPADDING',   (0,0), (-1,-1), 7),
        ('RIGHTPADDING',  (0,0), (-1,-1), 7),
        ('FONTSIZE',      (0,0), (-1,-1), 9.5),
    ]))
    return t

def build_doc(filename, title, subtitle, guide_num, story_fn):
    path = os.path.join(OUTPUT_DIR, filename)
    doc = SimpleDocTemplate(
        path, pagesize=A4,
        leftMargin=L_MAR, rightMargin=R_MAR,
        topMargin=T_MAR, bottomMargin=B_MAR,
    )
    cb = cover_callback(title, subtitle, guide_num)
    story = [PageBreak()]   # page 1 = cover (drawn by canvas); page 2 = content
    story.extend(story_fn())
    story.extend(cta_page())
    doc.build(story, onFirstPage=cb, onLaterPages=cb)
    print(f"  Created: {filename}")

# ══════════════════════════════════════════════════════════════════════════════
# GUIDE 1 — EMERGENCY BAIL: FIRST 24 HOURS
# ══════════════════════════════════════════════════════════════════════════════
def guide_1():
    s = S()
    e = []

    e.append(Paragraph("Emergency Bail: What to Do in the First 24 Hours", s['H1']))
    e.append(Paragraph(
        "When a family member is arrested, the first 24 hours are the most critical window. "
        "Decisions made in this period — who to call, what to say, whether and how to apply for bail — "
        "can significantly shape the outcome of the case. This guide walks you through each step "
        "under the Bharatiya Nagarik Suraksha Sanhita (BNSS) 2023.", s['Body']))
    e.append(Spacer(1, 0.2*cm))
    e.append(callout(
        "Every arrested person has guaranteed constitutional and statutory rights. These rights apply "
        "regardless of the nature of the alleged offence. Knowing them — and acting on them quickly — is essential."
    ))

    e += section_divider("Step-by-Step: The First 24 Hours")

    steps = [
        ("Step 1 — Confirm the Arrest and Location",
         "Contact the police station in whose jurisdiction the arrest occurred. Under Section 47 BNSS, "
         "the arresting officer must prepare an arrest memo and inform the accused's nominated person. "
         "If this has not happened, note it — your lawyer can use this as a violation of procedure."),
        ("Step 2 — Do NOT Offer Money to Police Officers",
         "Never attempt an informal payment or bribe. This is an offence under Section 7 of the "
         "Prevention of Corruption Act and can create additional criminal liability for you and the accused."),
        ("Step 3 — Contact a Criminal Lawyer Immediately",
         "Under Article 22 of the Constitution and Section 302 BNSS, the arrested person has the right "
         "to be defended by an advocate of their choice. Contact a lawyer before the accused is produced "
         "before a magistrate — ideally within the first 2-3 hours."),
        ("Step 4 — Track the 24-Hour Production Deadline",
         "Under Section 57 BNSS, police cannot detain a person for more than 24 hours without producing "
         "them before a magistrate. Note the exact time of arrest. If the deadline is missed, your lawyer "
         "can move immediately for release on this ground alone."),
        ("Step 5 — Obtain a Copy of the FIR",
         "You are entitled to a free copy of the FIR under Section 173 BNSS. Request this from the "
         "station house officer (SHO). The FIR is critical for preparing a bail application and "
         "understanding the exact charges."),
        ("Step 6 — Arrange a Surety / Guarantor",
         "For bailable offences, bail is a matter of right and requires a personal bond and a surety. "
         "Identify a reliable person (employed, with ID proof) who can stand as surety. "
         "For non-bailable offences, the court has discretion and the lawyer will advise accordingly."),
    ]

    for title_s, body in steps:
        e.append(Paragraph(title_s, s['StepNum']))
        e.append(Paragraph(body, s['StepBody']))

    e += section_divider("Your Legal Rights on Arrest — BNSS 2023")

    rights = [
        ("Right to Know the Grounds of Arrest — Section 47 BNSS",
         "Police must inform you of the reason for arrest at the time of arrest. An arrest memo must be "
         "prepared and signed by a witness. If you are not told the grounds, ask — and note if refused."),
        ("Right to Inform a Relative or Friend — Section 47(2) BNSS",
         "You have the right to have a nominated person informed of your arrest and place of detention. "
         "This person should be your lawyer, family member, or a trusted contact."),
        ("Right to Legal Representation — Article 22(1) Constitution",
         "You cannot be denied the right to consult an advocate. If you cannot afford one, "
         "a Legal Aid lawyer will be appointed under Section 304 BNSS (formerly Section 303 CrPC)."),
        ("Right Against Torture — Section 49 BNSS + DK Basu Guidelines (Codified)",
         "No unnecessary restraint, force, or ill-treatment during arrest or custody. Any physical "
         "harm in custody is punishable. The arresting officer must bear an accurate, visible name tag."),
        ("Right to Medical Examination — Section 51 BNSS",
         "You may request a medical examination by a registered medical practitioner immediately after "
         "arrest. This is critical if there is any existing injury, illness, or health concern."),
        ("Right to Silence",
         "You are not obligated to answer police questions beyond confirming your identity. "
         "Under Article 20(3) of the Constitution, no one can be compelled to be a witness against "
         "themselves. Do not make any statement without your lawyer present."),
    ]

    for right, desc in rights:
        e.append(Paragraph(f"\u25cf  {right}", s['H3']))
        e.append(Paragraph(desc, s['Body']))

    e += section_divider("Types of Bail Under BNSS 2023")

    e.append(make_table(
        ['Type of Bail', 'When to Apply', 'Court'],
        [
            ['Regular Bail\n(Section 480 BNSS)', 'After arrest — bailable or\nnon-bailable offences', 'Magistrate Court\nor Sessions Court'],
            ['Anticipatory Bail\n(Section 482 BNSS)', 'Before arrest — when arrest\nis apprehended', 'Sessions Court\nor Bombay High Court'],
            ['Default Bail\n(Section 479 BNSS)', 'If chargesheet not filed within\nstatutory deadline', 'Magistrate Court'],
            ['Interim Bail', 'Emergency short-term bail\npending full hearing', 'Any competent court'],
        ],
        [5.5*cm, 5.5*cm, 5.5*cm]
    ))

    e.append(Spacer(1, 0.5*cm))
    e += section_divider("What NOT to Do")

    dont_list = [
        "Do NOT sign any document — confession, statement, or bond — without consulting a lawyer",
        "Do NOT speak to journalists or share details on social media about the arrest",
        "Do NOT attempt to destroy, hide, or tamper with any evidence — this creates additional charges",
        "Do NOT trust 'fixers' or touts who claim to have influence with police or courts",
        "Do NOT ignore the 24-hour production deadline — this is a hard legal limit",
        "Do NOT attend the police station without a lawyer if you can possibly avoid it",
        "Do NOT make audio/video calls near police or in lock-up without legal advice",
    ]
    for item in dont_list:
        e.append(Paragraph(f"\u2717  {item}", s['Bullet']))

    e.append(Spacer(1, 0.4*cm))
    e += section_divider("First 24 Hours Checklist")
    checklist = [
        "Confirm police station name and the sections under which the FIR is registered",
        "Note exact time and date of arrest",
        "Contact a criminal lawyer within the first 2-3 hours",
        "Obtain a copy of the FIR",
        "Do not make any statement to police without a lawyer",
        "Request medical examination if there are any health concerns",
        "Identify a surety/guarantor — employed adult with Aadhaar/PAN",
        "Attend bail hearing on time with all required documents",
    ]
    for item in checklist:
        e.append(Paragraph(f"\u2610  {item}", s['Bullet']))

    e.append(Spacer(1, 0.4*cm))
    e.append(callout(
        "In bailable offences, bail is a right — not a favour. Even in non-bailable offences, "
        "courts have wide discretion. An experienced criminal advocate filing a well-prepared "
        "bail application at the right court makes a material difference."
    ))
    return e

# ══════════════════════════════════════════════════════════════════════════════
# GUIDE 2 — ANTICIPATORY BAIL GUIDE
# ══════════════════════════════════════════════════════════════════════════════
def guide_2():
    s = S()
    e = []

    e.append(Paragraph("Anticipatory Bail: How to Protect Yourself Before Arrest", s['H1']))
    e.append(Paragraph(
        "If you have reason to believe you may be arrested — due to a dispute, a complaint filed against "
        "you, or information from reliable sources — anticipatory bail under Section 482 BNSS 2023 "
        "(formerly Section 438 CrPC) is a powerful legal remedy that can prevent arrest entirely "
        "or immediately secure your release if arrested.", s['Body']))
    e.append(Spacer(1, 0.2*cm))
    e.append(callout(
        "Anticipatory bail does not require an FIR to have been filed. You can apply if you have a "
        "reasonable apprehension of arrest — even from a private complaint or a police notice."
    ))

    e += section_divider("What Is Anticipatory Bail?")

    e.append(Paragraph(
        "Anticipatory bail is a pre-arrest bail. If granted, it directs that in the event of arrest, "
        "the applicant shall be released on bail immediately — without having to approach a magistrate "
        "after arrest. The Supreme Court has held it to be a fundamental safeguard against misuse of "
        "the arrest power (Gurbaksh Singh Sibbia v. State of Punjab, 1980).", s['Body']))
    e.append(Spacer(1, 0.2*cm))
    e.append(Paragraph("Key Differences: Anticipatory Bail vs Regular Bail", s['H2']))
    e.append(make_table(
        ['Feature', 'Anticipatory Bail', 'Regular Bail'],
        [
            ['When applied', 'Before arrest', 'After arrest'],
            ['Court', 'Sessions Court or\nBombay High Court', 'Magistrate, Sessions\nor High Court'],
            ['Applicable law', 'Section 482 BNSS', 'Section 480 BNSS'],
            ['Requires FIR?', 'No — apprehension\nsufficient', 'Usually yes'],
            ['Effect', 'Prevents arrest or\nsecures immediate release', 'Secures release from\ncustody'],
        ],
        [4*cm, 6.5*cm, 6*cm]
    ))

    e += section_divider("When Should You Apply for Anticipatory Bail?")

    grounds = [
        "A family member or business associate has filed a complaint against you",
        "You have received a police notice under Section 35 or 179 BNSS for questioning",
        "You are involved in a matrimonial dispute and fear a Section 85 BNS (498A equivalent) complaint",
        "You are a target in an NDPS, fraud, or cybercrime investigation",
        "A civil dispute (property, money recovery) has escalated to a criminal complaint",
        "You have been named in an FIR filed in another state or city",
        "You have received credible information that police intend to arrest you",
    ]
    for g in grounds:
        e.append(Paragraph(f"\u2022  {g}", s['Bullet']))

    e += section_divider("Grounds Courts Consider When Granting Anticipatory Bail")

    e.append(Paragraph("Under Section 482 BNSS, courts examine:", s['Body']))
    factors = [
        ("Nature and gravity of the accusation",
         "Courts look at whether the offence is serious (e.g., murder, rape) and whether the allegations "
         "appear credible or are clearly motivated by personal vengeance or business rivalry."),
        ("Antecedents of the applicant",
         "Prior criminal record, if any, and the applicant's general background and standing in society. "
         "A clean record significantly assists anticipatory bail applications."),
        ("Possibility of the applicant fleeing justice",
         "Whether the applicant has stable ties to the community — family, employment, property — that "
         "indicate they are unlikely to abscond. Surrendering a passport helps."),
        ("Whether accusation is motivated",
         "Courts will consider if the complaint appears to be lodged with ulterior motives — "
         "such as in property disputes, matrimonial cases, or business rivalries."),
        ("Likely custodial interrogation requirements",
         "If police can genuinely argue they need the accused in custody for interrogation, "
         "courts may limit or deny anticipatory bail. Your lawyer must pre-empt this argument."),
    ]
    for factor, desc in factors:
        e.append(Paragraph(f"\u25cf  {factor}", s['H3']))
        e.append(Paragraph(desc, s['Body']))

    e += section_divider("Conditions Typically Attached to Anticipatory Bail")

    conditions = [
        "Make yourself available for interrogation when required by police",
        "Do not leave the country without prior court permission (surrender passport)",
        "Do not tamper with evidence or approach complainant/witnesses",
        "Report to the police station on specified dates",
        "Cooperate with the investigation and comply with court orders",
    ]
    for c in conditions:
        e.append(Paragraph(f"\u25cb  {c}", s['Bullet']))

    e += section_divider("The Anticipatory Bail Process — Step by Step")

    steps = [
        ("Consult a Criminal Lawyer Immediately",
         "The anticipatory bail application must be drafted carefully. It must state the apprehension of "
         "arrest, the nature of the complaint or FIR, your background, and grounds why bail should be granted. "
         "A poorly drafted application weakens your position significantly."),
        ("Filing at Sessions Court (First Option)",
         "Under Section 482 BNSS, the application is first filed at the Sessions Court. The court will "
         "typically issue an interim anticipatory bail order on the first date while the matter is heard. "
         "Expect 2-4 hearing dates before a final order."),
        ("Bombay High Court (If Sessions Court Refuses)",
         "If the Sessions Court rejects the application, the matter can be taken to the Bombay High Court. "
         "High Court applications are heard relatively quickly for interim protection. "
         "Adv. Akash Chikate regularly appears at Bombay High Court for such matters."),
        ("Interim Protection to Final Order",
         "On the first date, the court usually grants interim protection. This is itself binding on police — "
         "they cannot arrest you while the interim order is in force. The final order follows after "
         "the public prosecutor files a reply and both sides are heard."),
    ]
    for step_t, step_b in steps:
        e.append(Paragraph(step_t, s['StepNum']))
        e.append(Paragraph(step_b, s['StepBody']))

    e.append(Spacer(1, 0.3*cm))
    e.append(warning(
        "Do not wait until an FIR is registered or a police notice arrives. The earlier you apply, "
        "the stronger your position. Delay can result in arrest before the application is heard."
    ))
    e.append(Spacer(1, 0.4*cm))
    e.append(callout(
        "An interim anticipatory bail order from the Sessions Court or High Court is immediately "
        "binding on all police officers. If police attempt arrest in violation of the order, "
        "it constitutes contempt of court."
    ))
    return e

# ══════════════════════════════════════════════════════════════════════════════
# GUIDE 3 — KNOW YOUR RIGHTS WHEN ARRESTED
# ══════════════════════════════════════════════════════════════════════════════
def guide_3():
    s = S()
    e = []

    e.append(Paragraph("Know Your Rights When Arrested in India", s['H1']))
    e.append(Paragraph(
        "The Bharatiya Nagarik Suraksha Sanhita (BNSS) 2023 replaced the Code of Criminal Procedure "
        "(CrPC) 1973, bringing significant updates to how arrests are conducted and rights are protected. "
        "Whether you are being arrested or assisting a family member, this guide explains every right "
        "guaranteed under the BNSS and the Constitution of India.", s['Body']))
    e.append(Spacer(1, 0.2*cm))
    e.append(callout(
        "These rights are guaranteed by law — they cannot be waived by a police officer. "
        "Every violation you record strengthens your legal position."
    ))

    e += section_divider("Constitutional Rights — Articles 20, 21, 22")

    const_rights = [
        ("Article 20 — Protection Against Self-Incrimination",
         "No person accused of an offence can be compelled to be a witness against themselves. "
         "This means you have the right to remain silent and refuse to answer police questions. "
         "Only a magistrate-recorded confession is admissible as evidence — not a police-recorded one."),
        ("Article 21 — Right to Life and Personal Liberty",
         "No person shall be deprived of their life or personal liberty except according to procedure "
         "established by law. Illegal or arbitrary arrest violates this right. "
         "Any denial of bail without legal grounds violates Article 21."),
        ("Article 22 — Protection Against Arbitrary Arrest",
         "Three key protections: (1) right to be informed of grounds of arrest; (2) right to consult "
         "and be defended by a lawyer of choice; (3) production before a magistrate within 24 hours. "
         "Violation of any of these entitles the accused to immediate legal relief."),
    ]
    for right, desc in const_rights:
        e.append(Paragraph(f"\u25cf  {right}", s['H3']))
        e.append(Paragraph(desc, s['Body']))

    e += section_divider("Statutory Rights Under BNSS 2023")

    bnss_rights = [
        ("Section 47 — Right to Know Grounds of Arrest",
         "The arresting officer must prepare an arrest memo and inform the accused of the grounds "
         "of arrest at the time of arrest. The memo must be attested by a witness. "
         "The officer must bear a clearly visible, accurate name badge."),
        ("Section 47(2) — Right to Inform a Relative or Friend",
         "The arrested person can nominate one person — family, friend, or lawyer — to be informed of "
         "the arrest and the place of detention. This notification must happen without delay."),
        ("Section 49 — Right Against Use of Unnecessary Force",
         "Police may not use more force than is reasonably necessary to effect the arrest. "
         "Torture, unnecessary restraint, or any physical harm in custody is punishable under the BNS."),
        ("Section 51 — Right to Medical Examination",
         "The accused may request a medical examination by a registered medical officer at the time of "
         "arrest. If there is an existing injury, this is critical — get it recorded immediately."),
        ("Section 57 — Right to Production Within 24 Hours",
         "Police cannot detain you for more than 24 hours without producing you before a magistrate. "
         "The 24 hours excludes travel time. If this limit is exceeded, it is an illegal detention."),
        ("Section 302 BNSS — Right to Legal Aid",
         "Every accused person has the right to be represented by an advocate. If you cannot afford one, "
         "the State must provide a Legal Aid Advocate. You cannot be questioned or subjected to "
         "interrogation without your lawyer being present if you request one."),
    ]
    for right, desc in bnss_rights:
        e.append(Paragraph(f"\u25cf  {right}", s['H3']))
        e.append(Paragraph(desc, s['Body']))

    e += section_divider("The DK Basu Guidelines (Now Codified in BNSS)")

    e.append(Paragraph(
        "The Supreme Court's landmark DK Basu v. State of West Bengal (1997) guidelines have been "
        "largely codified in the BNSS. They require:", s['Body']))
    basu = [
        "Police must wear accurate name tags with designation during arrest and interrogation",
        "An arrest memo must be prepared and signed by a witness",
        "The family/friend nominated by the accused must be promptly informed",
        "The arrestee must be made aware of their right to be medically examined",
        "A copy of all documents — including the arrest memo — must be given to the arrested person",
        "The place of detention must be clearly communicated to the nominated person",
    ]
    for item in basu:
        e.append(Paragraph(f"\u2022  {item}", s['Bullet']))

    e += section_divider("Rights in Police Custody vs Judicial Remand")

    e.append(make_table(
        ['Issue', 'Police Custody (Remand)', 'Judicial Custody (JC)'],
        [
            ['Duration', 'Max 15 days total\n(Section 187 BNSS)', 'Up to 60/90 days before\ndefault bail kicks in'],
            ['Interrogation', 'Police may interrogate', 'Police need court permission\nto interrogate'],
            ['Conditions', 'Lock-up / police station', 'Jail / sub-jail'],
            ['Bail application', 'Can apply to magistrate', 'Can apply at any time'],
            ['Lawyer access', 'Right to lawyer present\nduring questioning', 'Regular access allowed'],
        ],
        [5*cm, 5.5*cm, 5.5*cm]
    ))

    e.append(Spacer(1, 0.4*cm))
    e += section_divider("If Your Rights Are Violated")

    remedies = [
        ("Habeas Corpus Petition — Article 226 / 32",
         "If detained illegally, a writ of habeas corpus can be filed before the Bombay High Court or "
         "Supreme Court demanding immediate release. This is one of the fastest legal remedies available."),
        ("Complaint to Police Superintendent / DCP",
         "If there is physical harm, file a written complaint with the District Superintendent of Police "
         "or Deputy Commissioner of Police. Keep a copy and note the time of submission."),
        ("Complaint to State Human Rights Commission",
         "The Maharashtra Human Rights Commission can investigate custodial violations. "
         "This is in addition to criminal remedies against the officer involved."),
        ("Private Complaint / FIR Against Officer",
         "A police officer who causes injury in custody is liable under Section 331 BNS (custodial torture). "
         "Your lawyer can file an FIR or a private complaint before the magistrate against the officer."),
    ]
    for remedy, desc in remedies:
        e.append(Paragraph(f"\u25cf  {remedy}", s['H3']))
        e.append(Paragraph(desc, s['Body']))
    return e

# ══════════════════════════════════════════════════════════════════════════════
# GUIDE 4 — NDPS DEFENCE GUIDE
# ══════════════════════════════════════════════════════════════════════════════
def guide_4():
    s = S()
    e = []

    e.append(Paragraph("NDPS Act: Your Legal Options if Charged with Drug Offences", s['H1']))
    e.append(Paragraph(
        "Charges under the Narcotic Drugs and Psychotropic Substances Act, 1985 (NDPS Act) are among "
        "the most serious in Indian criminal law. Bail is severely restricted, sentences can be life "
        "imprisonment or death, and even possession of small quantities carries mandatory minimum sentences. "
        "Understanding the law is essential if you or a family member faces NDPS charges.", s['Body']))
    e.append(Spacer(1, 0.2*cm))
    e.append(warning(
        "NDPS offences are non-bailable by default. Bail is governed by Section 37 NDPS which creates "
        "a double presumption making bail extraordinarily difficult. Early legal intervention is critical."
    ))

    e += section_divider("Understanding Quantities: Small, Intermediate, Commercial")

    e.append(Paragraph(
        "The quantity of the seized substance is the single most important factor in an NDPS case. "
        "It determines whether Section 37 (bail restriction) applies and what the minimum sentence is.", s['Body']))
    e.append(make_table(
        ['Substance', 'Small Quantity\n(S.27 — lesser sentence)', 'Commercial Quantity\n(S.31 — 10yr-Life/Death)'],
        [
            ['Ganja (Cannabis/Marijuana)', '1 kg', '20 kg'],
            ['Charas / Hashish', '100 g', '1 kg'],
            ['Heroin', '5 g', '250 g'],
            ['Cocaine', '2 g', '100 g'],
            ['Methamphetamine', '5 g', '250 g'],
            ['Opium', '25 g', '2.5 kg'],
        ],
        [5*cm, 5.5*cm, 6*cm]
    ))
    e.append(Paragraph(
        "Quantities between small and commercial are 'intermediate' — punishable with up to 10 years. "
        "Quantities at or above commercial threshold trigger Section 37 bail restrictions.", s['Body']))

    e += section_divider("Section 37 NDPS — The Bail Restriction")

    e.append(Paragraph(
        "Section 37 NDPS is unique in Indian law. It applies to commercial quantity cases and requires "
        "the court to be satisfied of two things before granting bail:", s['Body']))
    e.append(Paragraph(
        "1. There are reasonable grounds to believe the accused is NOT guilty of the offence.", s['Bullet']))
    e.append(Paragraph(
        "2. The accused is NOT likely to commit any offence while on bail.", s['Bullet']))
    e.append(Spacer(1, 0.2*cm))
    e.append(callout(
        "This is a reversal of the normal presumption of innocence. In Section 37 cases, the burden "
        "effectively shifts to the accused to show they are unlikely to be guilty. "
        "This makes a well-argued bail application at the High Court critically important."
    ))

    e += section_divider("Legal Defences in NDPS Cases")

    defences = [
        ("Challenge the Seizure Procedure",
         "Section 42 NDPS requires prior information to be reduced to writing and sent to a superior "
         "officer before conducting a search without a warrant. Non-compliance with this procedure is "
         "a strong defence — courts have acquitted accused persons on this ground alone."),
        ("Independent Witness Requirement",
         "Section 100 BNSS (formerly Section 100 CrPC) requires two independent and respectable witnesses "
         "during search and seizure. If the panchnama was prepared only with police witnesses (mahazarnamas "
         "without independent panchas), this can be challenged."),
        ("Chain of Custody of Samples",
         "The seized substance must be weighed, sampled, and sent to a Forensic Science Laboratory (FSL) "
         "in accordance with the NDPS Standing Orders. Gaps in the chain of custody — especially between "
         "seizure and FSL receipt — are a powerful defence argument."),
        ("FSL Report Challenges",
         "The FSL report identifying the substance is the primary evidence. Your lawyer can examine "
         "whether the correct test was used, whether the sample was properly sealed, and whether the "
         "analyst is a competent witness. Cross-examination of the FSL analyst is often decisive."),
        ("Planting / False Implication",
         "In cases where a private citizen is arrested, it is common for defence to raise the argument "
         "of false implication — particularly where there is no prior criminal history and the quantity "
         "found is near the boundary between small and intermediate."),
        ("Minimum Quantity Arguments (Small Quantity Bail)",
         "If the quantity is below the small quantity threshold, Section 37 does not apply and "
         "the normal bail standard applies. Getting an accurate FSL-confirmed weight is therefore "
         "extremely important — a difference of a few grams can change the legal category entirely."),
    ]
    for d_title, d_body in defences:
        e.append(Paragraph(f"\u25cf  {d_title}", s['H3']))
        e.append(Paragraph(d_body, s['Body']))

    e += section_divider("Bail in NDPS Cases — What to Expect")

    e.append(Paragraph("The route to bail depends on the quantity involved:", s['Body']))
    bail_routes = [
        "Small quantity (e.g., ganja below 1 kg): Normal bail — apply at Magistrate/Sessions Court",
        "Intermediate quantity: Sessions Court application, difficult but possible with good grounds",
        "Commercial quantity: Section 37 applies — Sessions Court first, then Bombay High Court",
        "Default bail (Section 479 BNSS): If chargesheet not filed within 60 days (non-bailable) or 90 days, "
        "accused has a right to bail regardless of the offence — this is a powerful remedy",
    ]
    for item in bail_routes:
        e.append(Paragraph(f"\u2022  {item}", s['Bullet']))

    e.append(Spacer(1, 0.3*cm))
    e.append(callout(
        "Default bail under Section 479 BNSS is an indefeasible right. If police fail to file the "
        "chargesheet within the statutory deadline (60 or 90 days depending on the offence), "
        "bail must be granted even in commercial quantity NDPS cases."
    ))
    return e

# ══════════════════════════════════════════════════════════════════════════════
# GUIDE 5 — CYBERCRIME DEFENCE GUIDE
# ══════════════════════════════════════════════════════════════════════════════
def guide_5():
    s = S()
    e = []

    e.append(Paragraph("Cybercrime Defence: Your Legal Options Under the IT Act and BNS", s['H1']))
    e.append(Paragraph(
        "Cybercrime cases are growing rapidly in India, and they are frequently mishandled — both by "
        "investigating agencies and by individuals who do not understand their rights. Whether you face "
        "allegations of hacking, online fraud, harassment, defamation, or identity theft, "
        "this guide explains the law and your legal options.", s['Body']))
    e.append(Spacer(1, 0.2*cm))
    e.append(callout(
        "Adv. Akash Chikate holds an LLM in Science & Technology Laws (First Class Distinction) and "
        "a Diploma in Cyber Laws — specialisations directly relevant to cybercrime defence matters."
    ))

    e += section_divider("Common Cybercrime Charges and the Applicable Law")

    e.append(make_table(
        ['Allegation', 'IT Act Section', 'BNS Section'],
        [
            ['Hacking / Unauthorised access', 'S.66 IT Act', 'S.316 BNS'],
            ['Online fraud / cheating', 'S.66D IT Act', 'S.318 BNS'],
            ['Identity theft', 'S.66C IT Act', 'S.319 BNS'],
            ['Cyber stalking / harassment', 'S.67 IT Act', 'S.351(3) BNS'],
            ['Obscene material publication', 'S.67 / 67A IT Act', 'S.294 BNS'],
            ['Child sexual abuse material (CSAM)', 'S.67B IT Act', 'POCSO + BNS'],
            ['Defamation (online/WhatsApp)', '\u2014', 'S.356 BNS'],
            ['Investment/trading app fraud', 'S.66D IT Act', 'S.318/316 BNS'],
        ],
        [5.5*cm, 5*cm, 5*cm]
    ))

    e += section_divider("Unique Challenges in Cybercrime Defence")

    challenges = [
        ("Digital Evidence Is Easily Manipulated and Fabricated",
         "Unlike physical evidence, digital evidence — screenshots, chat logs, call records — can be "
         "fabricated, edited, or taken out of context. Your lawyer must challenge the authenticity and "
         "chain of custody of all digital evidence presented by the prosecution."),
        ("IP Address Evidence Is Unreliable Alone",
         "An IP address traces to a router or network, not to an individual device or person. "
         "Without forensic evidence linking a specific device to the IP, an IP address alone is "
         "insufficient to prove an offence. Many innocent people are accused solely based on IP logs."),
        ("Electronic Records Must Meet Section 63 BSA Standards",
         "Under the Bharatiya Sakshya Adhiniyam (BSA) 2023, electronic records are admissible only if "
         "accompanied by a certificate from a responsible official. Improperly certified digital "
         "evidence is inadmissible — this is a major defence tool in cybercrime cases."),
        ("Jurisdictional Complexity",
         "Cybercrimes can be registered across multiple police stations — wherever the complainant "
         "is located. This creates a risk of multiple FIRs for the same incident. "
         "Your lawyer can file for quashing of duplicate FIRs or transfer petitions."),
    ]
    for c_title, c_body in challenges:
        e.append(Paragraph(f"\u25cf  {c_title}", s['H3']))
        e.append(Paragraph(c_body, s['Body']))

    e += section_divider("Steps to Take If Accused of a Cybercrime")

    steps = [
        ("Do Not Delete Anything",
         "Do not delete any message, chat, email, or file from your devices. Deletion can be seen as "
         "tampering with evidence and creates a negative inference in court. Preserve everything."),
        ("Secure Your Devices Legally",
         "If you believe police may seize your devices, consult a lawyer about the procedure for "
         "lawful seizure under Section 94 BNSS and what to expect. Do not resist seizure — "
         "it is lawful if conducted with a proper warrant or valid grounds."),
        ("Obtain an Image of the Evidence",
         "Before police seize devices, if possible, request that a forensic image (mirror copy) "
         "be made and that you receive a certified copy. This ensures you can verify what was on "
         "the device and challenge any alterations."),
        ("Contact a Lawyer with Cyber Law Expertise",
         "Cybercrime investigations involve specialised procedures. Engage a lawyer with "
         "knowledge of the IT Act, BSA digital evidence standards, and forensic investigation "
         "procedures. General criminal lawyers may not have the relevant expertise."),
        ("Apply for Anticipatory Bail If Needed",
         "If an FIR has been registered but you have not yet been arrested, consider applying for "
         "anticipatory bail immediately. Cybercrime investigations often move quickly once an FIR is filed."),
    ]
    for step_t, step_b in steps:
        e.append(Paragraph(step_t, s['StepNum']))
        e.append(Paragraph(step_b, s['StepBody']))

    e += section_divider("Key Defence Strategies")

    strategies = [
        "Challenge the authenticity and admissibility of all digital evidence under BSA 2023",
        "Request forensic examination of original devices — not police-prepared summaries",
        "Challenge the Section 63 BSA certificate: Was it issued by a responsible official?",
        "Scrutinise the chain of custody from seizure to FSL to court",
        "File for quashing of FIR if the allegation lacks prima facie substance (HC Writ Petition)",
        "In defamation / harassment cases — examine if the accused had the means and motive",
        "IP address alone is not proof — request the technical investigation report in full",
        "Challenge any statement recorded under Section 161 BNSS if given without legal advice",
    ]
    for s_item in strategies:
        e.append(Paragraph(f"\u25a0  {s_item}", s['Bullet']))

    e.append(Spacer(1, 0.3*cm))
    e.append(callout(
        "Cybercrime cases often hinge entirely on technical evidence. A lawyer who understands "
        "both the law and the technology can identify flaws in the investigation that are invisible "
        "to a non-specialist. Adv. Akash Chikate's LLM in Science & Technology Laws is directly relevant here."
    ))
    return e

# ══════════════════════════════════════════════════════════════════════════════
# GUIDE 6 — FALSE 498A / SECTION 85 BNS DEFENCE
# ══════════════════════════════════════════════════════════════════════════════
def guide_6():
    s = S()
    e = []

    e.append(Paragraph("Defending Against False Section 85 BNS / 498A Complaints", s['H1']))
    e.append(Paragraph(
        "Section 85 of the Bharatiya Nyaya Sanhita (BNS) 2023 replaced Section 498A IPC — the offence "
        "of cruelty by a husband or his relatives towards a wife. When used legitimately, it protects "
        "genuine victims of domestic abuse. However, it is also frequently misused as a tool in "
        "matrimonial disputes. This guide explains the law and your defence options.", s['Body']))
    e.append(Spacer(1, 0.2*cm))
    e.append(warning(
        "Section 85 BNS is a cognisable, non-bailable, and non-compoundable offence. Arrest can happen "
        "without a warrant. Even a false complaint can lead to arrest of the accused and their family. "
        "Take any notice or complaint extremely seriously and act immediately."
    ))

    e += section_divider("What is Section 85 BNS (formerly 498A IPC)?")

    e.append(Paragraph(
        "Section 85 BNS punishes cruelty by a husband or his relatives towards a wife. "
        "'Cruelty' includes physical or mental cruelty, and any conduct that is likely to drive "
        "a woman to suicide or cause grave injury to her health. It also includes harassment "
        "for dowry. The punishment is imprisonment up to 3 years plus fine.", s['Body']))

    e += section_divider("Grounds on Which False 498A Cases Are Filed")

    grounds = [
        "As leverage in divorce or maintenance proceedings",
        "To gain custody of children by discrediting the husband and his family",
        "Over property disputes between the husband's family and the wife",
        "Retaliation after a divorce petition is filed by the husband",
        "Pressure to extract a settlement amount or maintenance",
        "Involving husband's parents, siblings, and relatives who had no role in marital discord",
    ]
    for g in grounds:
        e.append(Paragraph(f"\u2022  {g}", s['Bullet']))

    e += section_divider("Supreme Court Guidelines on Section 498A Arrests")

    e.append(Paragraph(
        "In Arnesh Kumar v. State of Bihar (2014), the Supreme Court directed that arrests in "
        "Section 498A / Section 85 BNS cases should not be made automatically. Police must satisfy "
        "themselves of the necessity of arrest using the criteria in Section 35 BNSS. "
        "Magistrates must apply judicial mind before remanding accused to custody. "
        "Any violation of this direction can be challenged in High Court.", s['Body']))

    e += section_divider("Defence Strategies in Section 85 BNS Cases")

    strategies = [
        ("Anticipatory Bail — File Before Arrest",
         "The most important immediate step is to file for anticipatory bail at the Sessions Court or "
         "Bombay High Court. Arnesh Kumar guidelines significantly assist bail applications in "
         "Section 85 BNS cases, particularly when the complaint appears to be motivated."),
        ("FIR Quashing — Bombay High Court Writ Petition",
         "Under Section 528 BNSS (formerly Section 482 CrPC), the Bombay High Court can quash an "
         "FIR where: the allegations do not make out an offence; they are clearly false or motivated; "
         "or where a settlement has been reached. This is often the most effective long-term strategy."),
        ("Challenge the Scope of Complaint Against Relatives",
         "Courts have consistently held that sweeping allegations against all relatives of the husband, "
         "without specific allegations against each person, are not sustainable. Your lawyer can "
         "apply for discharge of those relatives against whom no specific conduct is alleged."),
        ("Section 86 BNS — Compounding with Permission",
         "Unlike the old 498A which was non-compoundable, Section 85/86 BNS allows compounding with "
         "the permission of the High Court. If a settlement is reached between parties, this route "
         "can lead to quashing of the case entirely."),
        ("Evidence Gathering",
         "Preserve all WhatsApp chats, emails, call logs, and any communications between you and the "
         "complainant. Evidence of financial demands, settlement negotiations, or contradictions in "
         "the complainant's own statements can significantly undermine the prosecution's case."),
        ("Mediation",
         "In matrimonial disputes, mediation before a Family Court or a court-appointed mediator "
         "can resolve the underlying dispute and lead to withdrawal or quashing of the complaint. "
         "Many Section 85 BNS cases are ultimately resolved through negotiated settlement."),
    ]
    for strat_t, strat_b in strategies:
        e.append(Paragraph(f"\u25cf  {strat_t}", s['H3']))
        e.append(Paragraph(strat_b, s['Body']))

    e += section_divider("Immediate Steps if a Complaint is Filed or Expected")

    checklist = [
        "Contact a criminal lawyer immediately — do not wait for police to arrive",
        "File for anticipatory bail before arrest is made",
        "Preserve all evidence: chats, emails, call records, financial records, photos",
        "Do not contact the complainant directly — it can be used as evidence of harassment",
        "Make a list of all witnesses who can speak to the nature of the matrimonial relationship",
        "Gather documents showing financial contributions to the matrimonial home",
        "Review all social media activity — the complainant may use posts as evidence",
    ]
    for item in checklist:
        e.append(Paragraph(f"\u2610  {item}", s['Bullet']))

    e.append(Spacer(1, 0.3*cm))
    e.append(callout(
        "A Section 85 BNS FIR does not automatically mean conviction — or even arrest, if you act "
        "quickly. Courts have developed significant safeguards against misuse of these provisions. "
        "With experienced legal representation, the prospects of a favourable outcome are substantially "
        "higher than most accused persons realise at the time of the complaint."
    ))
    return e

# ══════════════════════════════════════════════════════════════════════════════
# GUIDE 7 — POCSO DEFENCE GUIDE
# ══════════════════════════════════════════════════════════════════════════════
def guide_7():
    s = S()
    e = []

    e.append(Paragraph("Understanding POCSO: A Guide for the Accused and Their Families", s['H1']))
    e.append(Paragraph(
        "The Protection of Children from Sexual Offences Act, 2012 (POCSO) is among the most stringent "
        "criminal statutes in India. It contains a reversed burden of proof — once penetrative sexual "
        "assault is alleged, the accused must prove their innocence. Sentences range from 7 years to "
        "life imprisonment, and bail is extremely difficult to obtain. "
        "This guide explains what POCSO means for the accused and their families.", s['Body']))
    e.append(Spacer(1, 0.2*cm))
    e.append(warning(
        "POCSO charges are the most serious sexual offence allegations under Indian law. "
        "Do not attempt to handle this without an experienced criminal lawyer. "
        "Contact legal counsel within hours — not days — of arrest or complaint."
    ))

    e += section_divider("The Key Features of POCSO")

    features = [
        ("Reverse Burden of Proof (Section 29 POCSO)",
         "Once the prosecution establishes that a sexual assault occurred and that the accused had "
         "contact with the child, the law presumes the accused is guilty. The accused must then prove "
         "their innocence. This is the opposite of the normal presumption of innocence."),
        ("Child — Anyone Below 18 Years",
         "POCSO covers all persons below 18 years of age, regardless of consent. "
         "Even consensual sexual activity between adolescents (where one is below 18) falls under POCSO. "
         "The concept of 'consent' has no legal relevance under POCSO."),
        ("Special Courts for Trial",
         "POCSO cases are tried in designated Special Courts. Trials are typically conducted in camera "
         "(closed-door). The child's identity and statements are confidential. "
         "The child is examined only once to minimise trauma."),
        ("Mandatory Reporting (Section 19 POCSO)",
         "Any person aware of a POCSO offence is legally obligated to report it to the police. "
         "Failure to report is itself an offence under Section 21 POCSO."),
    ]
    for f_title, f_body in features:
        e.append(Paragraph(f"\u25cf  {f_title}", s['H3']))
        e.append(Paragraph(f_body, s['Body']))

    e += section_divider("Bail in POCSO Cases")

    e.append(Paragraph(
        "Bail in POCSO cases is extremely difficult. Under Section 31 POCSO, which applies Section 439 "
        "CrPC (now Section 483 BNSS) strictly, courts are very reluctant to grant bail. However, bail "
        "is not impossible. Courts have granted bail in POCSO cases where:", s['Body']))
    bail_factors = [
        "The accused has no prior criminal record and is a first-time offender",
        "The allegation appears to be motivated (e.g., by a family dispute or custody battle)",
        "The accused is a minor themselves, or very young (below 21)",
        "The medical evidence is inconsistent with the allegation",
        "Delay in filing the complaint raises questions about authenticity",
        "The accused is the sole breadwinner and family would face extreme hardship",
        "Long period of incarceration has already occurred without trial progress",
    ]
    for item in bail_factors:
        e.append(Paragraph(f"\u2022  {item}", s['Bullet']))

    e += section_divider("Common Defence Arguments in POCSO Cases")

    defences = [
        ("False Allegation Due to Family Dispute",
         "A significant number of POCSO cases arise from family disputes — particularly where a minor "
         "child has been coached by one parent to allege offences against a relative of the other parent. "
         "The defence must demonstrate the motive and the lack of medical corroboration."),
        ("Medical Evidence Does Not Support the Allegation",
         "A medical examination of the child is conducted early in every POCSO case. "
         "Where the medical report does not support the alleged offence, this is a powerful "
         "defence argument. Your lawyer will engage with the medical evidence in detail."),
        ("Inconsistencies in the Child's Statement",
         "Children are examined before a Magistrate under Section 164 BNSS and before the Special Court. "
         "Inconsistencies between the initial statement, the 164 BNSS statement, and trial testimony "
         "are important and can be raised in cross-examination."),
        ("Age of the Accused",
         "If the accused is a juvenile (below 18 years), the case is handled by the Juvenile Justice "
         "Board under the Juvenile Justice (Care and Protection of Children) Act, 2015. "
         "The procedure is rehabilitative, not purely punitive."),
        ("Alibi Defence",
         "If the accused can prove they were elsewhere at the time of the alleged offence, this is a "
         "complete defence. Documentary evidence — CCTV, mobile tower location, ticket records — "
         "can be extremely valuable in establishing an alibi."),
    ]
    for d_title, d_body in defences:
        e.append(Paragraph(f"\u25cf  {d_title}", s['H3']))
        e.append(Paragraph(d_body, s['Body']))

    e += section_divider("Immediate Steps for Families of the Accused")

    steps = [
        "Contact an experienced criminal lawyer with POCSO trial experience within hours",
        "Do NOT contact the complainant, child, or complainant's family — it will be seen as intimidation",
        "Preserve all evidence that the accused was elsewhere at the relevant time",
        "Collect character witnesses — neighbours, employers, community leaders",
        "Review all previous communications between the accused and the complainant's family",
        "Document the history of any family dispute that may explain a false allegation",
        "Prepare for a long legal process — POCSO trials are typically 1-3 years in duration",
    ]
    for item in steps:
        e.append(Paragraph(f"\u2610  {item}", s['Bullet']))

    e.append(Spacer(1, 0.3*cm))
    e.append(callout(
        "POCSO cases require a specialist criminal lawyer with experience in sexual offence trials, "
        "forensic evidence evaluation, and Bombay High Court bail jurisdiction. "
        "The reversed burden of proof means that the defence must be active, organised, and well-prepared "
        "from day one — not reactive. Every day without legal representation is a disadvantage."
    ))
    return e

# ══════════════════════════════════════════════════════════════════════════════
# GUIDE 8 — HOW TO CHOOSE A CRIMINAL LAWYER
# ══════════════════════════════════════════════════════════════════════════════
def guide_8():
    s = S()
    e = []

    e.append(Paragraph("How to Choose the Right Criminal Lawyer in Pune", s['H1']))
    e.append(Paragraph(
        "Choosing the wrong criminal lawyer can cost you your freedom, your reputation, and years of your life. "
        "Criminal defence is a specialist field — not all lawyers who call themselves criminal lawyers "
        "have the skills, court experience, and legal knowledge to handle serious criminal matters. "
        "This guide gives you 10 questions to ask before engaging any criminal lawyer in Pune.", s['Body']))
    e.append(Spacer(1, 0.2*cm))
    e.append(callout(
        "The best time to find a criminal lawyer is before you need one urgently. "
        "Decisions made under panic and time pressure are rarely the best decisions. "
        "Read this guide, know what to look for, and save the right numbers."
    ))

    e += section_divider("10 Questions to Ask Before Hiring a Criminal Lawyer")

    questions = [
        ("1. Do you appear at Bombay High Court regularly?",
         "Many criminal matters — anticipatory bail, bail applications in serious cases, FIR quashing, "
         "revision petitions — must be filed at the Bombay High Court. A lawyer who only practises in "
         "district courts may not have the necessary High Court experience. Ask specifically how many "
         "Bombay High Court matters they have handled in the past year."),
        ("2. Have you handled cases involving the specific offence I am charged with?",
         "Criminal law is divided into sub-specialisms: NDPS, cybercrime, matrimonial offences, "
         "economic offences, murder/serious crime, POCSO. Each requires different procedural knowledge "
         "and strategy. Ask for specific examples — not generic statements about 'criminal experience'."),
        ("3. Can you show me verifiable case outcomes?",
         "Any lawyer can claim success. Ask them to show you orders from Indian Kanoon or share case "
         "numbers you can verify. Adv. Akash Chikate, for example, has 27+ Bombay High Court orders "
         "publicly available on indiankanoon.org/search/?formInput=Akash+Chikate."),
        ("4. Who will actually handle my case — you, or a junior?",
         "In large law firms, client matters are often handled by juniors while the senior lawyer's name "
         "is on the letterhead. Ask whether the lawyer you are meeting will personally argue your matter "
         "or whether it will be delegated. For serious charges, personal handling is essential."),
        ("5. What is your honest assessment of my case?",
         "A good criminal lawyer will give you an honest, realistic assessment — not false reassurance. "
         "Be wary of lawyers who immediately promise guaranteed outcomes, tell you 'don't worry at all', "
         "or quote dramatically high fees before even hearing the facts. Professional ethics prohibit "
         "guaranteed outcomes under Bar Council rules."),
        ("6. What is your fee structure and what does it cover?",
         "Criminal lawyer fees vary widely. Some charge per hearing, others charge a fixed retainer, "
         "others charge separately for bail and trial. Understand what you are paying for. Ask: "
         "Does the fee cover Bombay High Court appearances? FSL report review? Section 164 statement hearings? "
         "Get a clear understanding in writing."),
        ("7. How do you communicate case updates?",
         "You should expect regular updates on hearing dates, orders passed, and next steps. "
         "Ask how the lawyer communicates — WhatsApp, phone call, email? "
         "A lawyer who is impossible to reach after the retainer is paid is a red flag."),
        ("8. Do you have experience with the relevant investigating agency or court?",
         "In Pune, matters may be investigated by local police, the Economic Offences Wing (EOW), "
         "the Cyber Crime Cell, or the NDPS Squad. Experience dealing with the specific agency "
         "matters — as does familiarity with the judges in the relevant court."),
        ("9. What is your approach to bail — do you start with Sessions Court or directly at High Court?",
         "The choice of court for bail determines strategy and timeline. An experienced lawyer will "
         "explain why they are recommending a particular court — not just file wherever is convenient. "
         "In urgent matters, interim bail from the High Court may be faster than waiting for a Sessions "
         "Court date."),
        ("10. Are you on the right side of the BCI compliance line?",
         "Bar Council of India rules prohibit advocates from advertising, making performance guarantees, "
         "or describing themselves with superlatives. A lawyer who promises guaranteed bail, "
         "calls themselves 'best in Pune', or claims a specific win percentage is violating "
         "professional ethics — and is likely telling you what you want to hear, not the truth."),
    ]

    for q_title, q_body in questions:
        e.append(Paragraph(q_title, s['H3']))
        e.append(Paragraph(q_body, s['Body']))
        e.append(Spacer(1, 0.15*cm))

    e += section_divider("Red Flags to Watch Out For")

    red_flags = [
        "Guarantees a specific outcome ('I will definitely get you bail today')",
        "Quotes a very high fee before hearing a single fact about your case",
        "Claims to 'know' judges or police officers personally",
        "Refuses to give you case hearing dates or copies of court orders",
        "Is vague about which court they practise in",
        "Delegates everything to a junior without disclosure",
        "Does not have a verifiable professional presence or Bar Council registration",
        "Pressures you to decide immediately without thinking",
    ]
    for item in red_flags:
        e.append(Paragraph(f"\u2717  {item}", s['Bullet']))

    e += section_divider("What Good Criminal Legal Representation Looks Like")

    good = [
        "Clear explanation of charges, legal options, and realistic expectations",
        "Personal appearance at all critical hearings — bail, charge framing, examination of witnesses",
        "Proactive communication — updates without you having to chase",
        "Thorough preparation — reading the FIR, chargesheet, FSL reports, and evidence in full",
        "Experience at the relevant court level (Magistrate, Sessions, Bombay High Court)",
        "Knowledge of the specific law involved — BNS, BNSS, NDPS, POCSO, IT Act as applicable",
        "Professional conduct — no promises, clear fees, honest advice",
    ]
    for item in good:
        e.append(Paragraph(f"\u2714  {item}", s['Bullet']))

    e.append(Spacer(1, 0.4*cm))
    e.append(callout(
        "Advocate Akash Chikate & Associates practises exclusively in criminal and family law "
        "at the Bombay High Court and District Courts in Pune. With 27+ publicly available "
        "Bombay High Court orders, an LLM in Science & Technology Laws, and a Diploma in Cyber Laws, "
        "the firm brings specialist expertise to serious criminal matters. "
        f"WhatsApp {WHATSAPP} for a consultation."
    ))
    return e

# ══════════════════════════════════════════════════════════════════════════════
# MAIN
# ══════════════════════════════════════════════════════════════════════════════
if __name__ == '__main__':
    print("Creating 8 lead magnet PDFs...")

    build_doc(
        '01-emergency-bail-guide.pdf',
        'Emergency Bail Guide\nFirst 24 Hours After Arrest',
        'What to do — and what NOT to do —\nwhen someone you know is arrested in India',
        '1', guide_1
    )
    build_doc(
        '02-anticipatory-bail-guide.pdf',
        'Anticipatory Bail Guide\nProtect Yourself Before Arrest',
        'How to get anticipatory bail before an FIR is even filed\nagainst you — Section 482 BNSS 2023',
        '2', guide_2
    )
    build_doc(
        '03-know-your-rights.pdf',
        'Know Your Rights\nWhen Arrested in India',
        'Every right guaranteed under the Constitution\nand Bharatiya Nagarik Suraksha Sanhita 2023',
        '3', guide_3
    )
    build_doc(
        '04-ndps-defence-guide.pdf',
        'NDPS Act Defence Guide\nDrug Offence Charges in India',
        'Quantities, bail restrictions, seizure procedure,\nand your legal options under the NDPS Act',
        '4', guide_4
    )
    build_doc(
        '05-cybercrime-defence-guide.pdf',
        'Cybercrime Defence Guide\nIT Act and BNS 2023',
        'What to do if accused of hacking, fraud,\nharassment, or identity theft online',
        '5', guide_5
    )
    build_doc(
        '06-false-498a-defence-guide.pdf',
        'Defending Against False\nSection 85 BNS Complaints',
        'Protecting yourself and your family from misuse\nof matrimonial cruelty provisions',
        '6', guide_6
    )
    build_doc(
        '07-pocso-defence-guide.pdf',
        'Understanding POCSO\nA Guide for the Accused',
        'The reversed burden, bail difficulties, special courts,\nand defence options under POCSO 2012',
        '7', guide_7
    )
    build_doc(
        '08-choose-a-criminal-lawyer.pdf',
        'How to Choose the Right\nCriminal Lawyer in Pune',
        '10 questions to ask, red flags to avoid,\nand what good legal representation looks like',
        '8', guide_8
    )

    print(f"\nDone. All PDFs saved to: {OUTPUT_DIR}")
