from PIL import Image, ImageDraw, ImageFont, ImageFilter
import sys
IMG="img/"; OUT="products/"
W=H=1200; PH=730
NAVY=(14,27,46); GOLD=(201,162,39); WHITE=(255,255,255); GREY=(196,204,216)
serif="/usr/share/fonts/truetype/crosextra/Caladea-Bold.ttf"
sansB="/usr/share/fonts/opentype/inter/Inter-SemiBold.otf"
sansM="/usr/share/fonts/opentype/inter/Inter-Medium.otf"
F=lambda p,s: ImageFont.truetype(p,s)
hc=Image.open(IMG+"akash-chikate-bombay-high-court.jpg").convert("RGB")
pt=Image.open(IMG+"akash-chikate-hero-desktop-847w.webp").convert("RGB")
def crop(img,box): return img.crop(box).resize((W,PH),Image.LANCZOS)
def fit_full(img,box):
    # whole region scaled to panel height, centred, sides filled with a blurred, darkened copy
    reg=img.crop(box); h=PH; w=int(reg.width*h/reg.height)
    bg=reg.resize((W,int(reg.height*W/reg.width))).crop((0,0,W,PH)).filter(ImageFilter.GaussianBlur(28))
    bg=Image.blend(bg,Image.new("RGB",(W,PH),NAVY),0.45)
    bg.paste(reg.resize((w,h),Image.LANCZOS),((W-w)//2,0)); return bg
PHOTOS={
 "hc_person": crop(hc,(0,1080,1919,1080+int(1919*PH/W))),
 "hc_close": crop(hc,(560,1060,1560,1060+int(1000*PH/W))),
 "hc_building": crop(hc,(0,0,1919,int(1919*PH/W))),
 "portrait": fit_full(pt,(0,0,847,820)),
}
CARDS=[
 ("01-anticipatory-bail","hc_person","BAIL","Anticipatory Bail","Section 482 BNSS (old 438 CrPC)\nPune Sessions Court & Bombay High Court"),
 ("02-arrest-custody-remand","portrait","ARREST","Arrest, Custody\n& Remand","First 24 hours, remand hearings, bail\nAvailable day and night"),
 ("03-regular-bail","hc_close","BAIL","Regular Bail\nAfter Arrest","Section 483 BNSS (old 439 CrPC)\nMagistrate, Sessions Court, High Court"),
 ("04-fir-quashing","hc_building","HIGH COURT","FIR Quashing","Section 528 BNSS (old 482 CrPC) & Article 226\nBombay High Court"),
 ("05-police-notice","portrait","POLICE MATTERS","Police Notice\nAdvice","Section 35 BNSS (old 41A CrPC)\nBefore you go to the station"),
 ("06-criminal-trial-defence","portrait","TRIAL","Criminal Trial\nDefence","Charge, cross-examination, final arguments\nSessions & Magistrate Courts, Pune"),
]
for slug,ph,label,title,sub in CARDS:
    c=Image.new("RGB",(W,H),NAVY); c.paste(PHOTOS[ph],(0,0))
    # soft fade from photo into the navy panel
    fade=Image.new("L",(W,160)); d=ImageDraw.Draw(fade)
    for y in range(160): d.line([(0,y),(W,y)],fill=int(255*(y/159)**1.6))
    c.paste(Image.new("RGB",(W,160),NAVY),(0,PH-160),fade)
    d=ImageDraw.Draw(c)
    x=72; y=PH-20
    d.rectangle([x,y,x+64,y+5],fill=GOLD)
    d.text((x+84,y-14),label,font=F(sansB,28),fill=GOLD)
    tf=F(serif,86 if "\n" not in title else 76)
    d.multiline_text((x,y+34),title,font=tf,fill=WHITE,spacing=4)
    tb=d.multiline_textbbox((x,y+34),title,font=tf,spacing=4)
    d.multiline_text((x,tb[3]+22),sub,font=F(sansM,32),fill=GREY,spacing=10)
    # footer
    d.line([(x,H-92),(W-x,H-92)],fill=(44,62,88),width=2)
    d.text((x,H-72),"Adv. Akash R. Chikate",font=F(sansB,30),fill=WHITE)
    ft="Shivajinagar, Pune"; fw=d.textlength(ft,font=F(sansM,30))
    d.text((W-x-fw,H-72),ft,font=F(sansM,30),fill=GOLD)
    # guard: text must stay above the footer rule
    sb=d.multiline_textbbox((x,tb[3]+22),sub,font=F(sansM,32),spacing=10)
    assert sb[3]<H-100, (slug, sb)
    c.save(OUT+f"akc-product-{slug}.jpg",quality=90)
    print(slug, "ok", sb[3])
