<?php
/**
 * Plugin Name: AKC Gap Pages
 * Description: Creates the keyword-gap pages from advocateakashchikate.com-audit/KEYWORD-GAPS.md as DRAFT posts for review. Batch 1: Tadipar (externment) notice in Pune, English + Marathi.
 * Version: 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'admin_notices', function() {
    if ( ! current_user_can( 'manage_options' ) ) return;
    if ( ! empty( $_GET['akc_gap_done'] ) ) {
        echo '<div class="notice notice-success is-dismissible"><p><strong>AKC Gap Pages:</strong> Drafts created. Review them under Posts → Drafts, then publish.</p></div>';
        return;
    }
    $missing = array_filter( akc_gap_get_posts(), function( $p ) {
        return ! get_page_by_path( $p['slug'], OBJECT, 'post' );
    } );
    if ( ! $missing ) return;
    $url = wp_nonce_url( admin_url( 'admin.php?akc_gap_import=1' ), 'akc_gap_import' );
    echo '<div class="notice notice-warning"><p><strong>AKC Gap Pages:</strong> ' . count( $missing ) . ' new page(s) not yet created. <a href="' . esc_url( $url ) . '" class="button button-primary">Create drafts</a></p></div>';
});

add_action( 'admin_init', function() {
    if ( empty( $_GET['akc_gap_import'] ) ) return;
    check_admin_referer( 'akc_gap_import' );
    if ( ! current_user_can( 'manage_options' ) ) return;
    akc_gap_import();
    wp_redirect( admin_url( 'edit.php?post_status=draft&post_type=post&akc_gap_done=1' ) );
    exit;
});

function akc_gap_import() {
    foreach ( akc_gap_get_posts() as $p ) {
        // Never overwrite: an existing slug means the page was created (and maybe edited) already
        if ( get_page_by_path( $p['slug'], OBJECT, 'post' ) ) continue;

        $cat_ids = [];
        foreach ( $p['categories'] as $slug ) {
            $term = get_term_by( 'slug', $slug, 'category' );
            if ( $term ) $cat_ids[] = $term->term_id;
        }

        $pid = wp_insert_post( [
            'post_title'    => $p['title'],
            'post_name'     => $p['slug'],
            'post_content'  => $p['content'],
            'post_excerpt'  => $p['excerpt'],
            'post_status'   => 'draft',
            'post_type'     => 'post',
            'post_category' => $cat_ids,
        ] );
        if ( ! $pid || is_wp_error( $pid ) ) continue;

        update_post_meta( $pid, 'rank_math_title',         $p['seo_title'] );
        update_post_meta( $pid, 'rank_math_description',   $p['seo_desc'] );
        update_post_meta( $pid, 'rank_math_focus_keyword', $p['focus_kw'] );
        update_post_meta( $pid, 'rank_math_robots',        [ 'index', 'follow' ] );
        update_post_meta( $pid, 'akc_language',            $p['lang'] );
        update_post_meta( $pid, 'akc_en_slug',             $p['en_slug'] );
    }
}

function akc_gap_get_posts() {
    return [

/* ============================================================ TADIPAR (EN) ============================================================ */
[
'lang'       => 'en',
'en_slug'    => 'tadipar-externment-notice-pune',
'title'      => 'Tadipar (Externment) Notice in Pune: What to Do Before the Hearing',
'slug'       => 'tadipar-externment-notice-pune',
'excerpt'    => 'Received a tadipar show-cause notice from Pune or Pimpri-Chinchwad police? How externment under Section 56 of the Maharashtra Police Act works, what to file at the hearing, and how to appeal or challenge an order.',
'categories' => ['criminal-law','legal-rights','high-court'],
'focus_kw'   => 'tadipar notice pune',
'seo_title'  => 'Tadipar Notice in Pune: Section 56 Externment Explained',
'seo_desc'   => 'Got a tadipar (externment) notice in Pune? How Section 56 Maharashtra Police Act works, replying at the hearing, the 30-day appeal and High Court challenge.',
'content'    => '<!-- wp:paragraph -->
<p>A <strong>tadipar notice</strong> is a show-cause notice under the <strong>Maharashtra Police Act, 1951</strong> asking why you should not be ordered to leave Pune (and often neighbouring districts) for up to two years. It is not a conviction, and the order has not been passed yet. The hearing that follows the notice is the best chance to stop it, so the written reply and documents you file there matter more than anything that comes later.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>What externment (tadipar) means</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Externment is a preventive measure. The police do not have to prove an offence; they have to show the authority that your presence in an area is a danger to people or property. Because it takes away your freedom to live and move in your own city, the Supreme Court has repeatedly called it an <em>extraordinary</em> measure that must be used sparingly and only on real, recent material (for example, <em>Deepak s/o Laxman Dongre v. State of Maharashtra</em>, decided 28 January 2022).</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p>The provisions people meet most often are:</p>
<!-- /wp:paragraph -->
<!-- wp:list -->
<ul>
<li><strong>Section 55</strong>: dispersal of gangs or bodies of persons.</li>
<li><strong>Section 56</strong>: removal of a person whose movements or acts are causing alarm, danger or harm, or who is believed to be engaged in offences involving force or violence or offences against the body or property, where witnesses are unwilling to come forward out of fear.</li>
<li><strong>Section 57</strong>: removal of a person convicted of certain offences.</li>
<li><strong>Section 58</strong>: an order cannot run for more than two years.</li>
<li><strong>Section 59</strong>: the hearing before the order.</li>
<li><strong>Section 60</strong>: appeal to the State Government.</li>
</ul>
<!-- /wp:list -->
<!-- wp:paragraph -->
<p>In Pune City and Pimpri-Chinchwad, which are police commissionerates, notices are usually issued by the zonal Deputy Commissioner of Police. In Pune rural areas, the proposal usually goes to the Sub-Divisional Magistrate.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>What happens after you receive the notice</h2>
<!-- /wp:heading -->
<!-- wp:list {"ordered":true} -->
<ol>
<li><strong>Notice:</strong> it should tell you the general nature of the allegations against you. Usually it lists the cases registered against you and refers to statements of witnesses (often unnamed).</li>
<li><strong>Hearing date:</strong> you have the right to appear, give a written explanation, be represented by an advocate and produce witnesses in your defence (Section 59).</li>
<li><strong>Order:</strong> the authority either drops the proceedings or passes an externment order naming the area and the period.</li>
<li><strong>Appeal:</strong> an appeal against the order lies to the State Government within <strong>30 days</strong> of the order (Section 60).</li>
<li><strong>High Court:</strong> a writ petition under Article 226 can be filed before the Bombay High Court. The grounds are limited, but procedural lapses and the absence of genuine material are recognised grounds.</li>
</ol>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>What to put in your reply at the hearing</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Most orders that are later set aside fail on points that could have been raised at this stage:</p>
<!-- /wp:paragraph -->
<!-- wp:list -->
<ul>
<li><strong>Old cases:</strong> cases that are years old, ended in acquittal or discharge, or were compromised, do not show a present danger.</li>
<li><strong>Nature of the cases:</strong> family or property disputes, and cases under sections outside those Section 56 refers to, should not be counted.</li>
<li><strong>Witness statements:</strong> if the "in-camera" statements are vague, recorded on the same day, or do not describe specific incidents, say so.</li>
<li><strong>The area:</strong> the area of the order must be connected to the alleged activity. Being externed from several districts for acts alleged in one police station area can be challenged as excessive.</li>
<li><strong>Period:</strong> the authority must explain why the period it picks is needed. Two years is the maximum, not the default.</li>
<li><strong>Your circumstances:</strong> job, business, education, dependent family, medical needs, and any bail or court-attendance conditions you must comply with.</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>Documents to collect now</h2>
<!-- /wp:heading -->
<!-- wp:list -->
<ul>
<li>The notice and envelope, with the date you received it.</li>
<li>Certified copies or status of every case listed: FIR, chargesheet, bail order, judgment of acquittal or discharge.</li>
<li>Proof of residence, employment or business (rent agreement, salary slips, GST or shop registration).</li>
<li>Documents about family dependants, education or medical treatment in Pune.</li>
<li>Character letters from people who can attend the hearing if needed.</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>If an order has already been passed</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Comply with it while you challenge it. Entering the prohibited area without permission is a separate offence under the Act and will be used against you in the appeal. Count the 30-day appeal period from the date of the order, and ask for the full record (the proposal, the statements relied on and the hearing notes) so the appeal or writ petition can address them point by point. For more on High Court remedies, see our <a href="/bombay-high-court-lawyer-pune/">Bombay High Court practice page</a>.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Frequently asked questions</h2>
<!-- /wp:heading -->
<!-- wp:heading {"level":3} -->
<h3>Can police extern me without any conviction?</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Yes. Section 56 does not need a conviction, which is why the material relied on and the hearing are so important. Section 57 separately deals with people who have been convicted.</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":3} -->
<h3>How long can a tadipar order last?</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Up to two years (Section 58). The authority should justify the period it chooses.</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":3} -->
<h3>Can I visit Pune during externment for a court date?</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Only with permission. Apply to the authority that passed the order for permission to attend court or for a family emergency, and keep a copy of the permission with you.</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":3} -->
<h3>What is the time limit for an appeal?</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Thirty days from the date of the order, to the State Government (Section 60). A writ petition to the Bombay High Court is a separate remedy.</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":3} -->
<h3>Is a pending bail or anticipatory bail relevant?</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Yes. If a court has granted bail with conditions such as attending the police station in Pune, an externment order can conflict with it. Point this out at the hearing. See also <a href="/how-to-get-anticipatory-bail-pune/">anticipatory bail in Pune</a>.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><em>This page is general information about the law in Maharashtra, not legal advice on your case. Read our <a href="/disclaimer/">disclaimer</a>. To discuss a notice you have received, use the <a href="/contact/">contact page</a>.</em></p>
<!-- /wp:paragraph -->',
],

/* ============================================================ TADIPAR (MR) ============================================================ */
[
'lang'       => 'mr',
'en_slug'    => 'tadipar-externment-notice-pune',
'title'      => 'पुण्यात तडीपार नोटीस आली? सुनावणीपूर्वी काय करावे',
'slug'       => 'mr-tadipar-externment-notice-pune',
'excerpt'    => 'पुणे किंवा पिंपरी-चिंचवड पोलिसांकडून तडीपारीची कारणे दाखवा नोटीस आली आहे? महाराष्ट्र पोलीस अधिनियमाचे कलम ५६, सुनावणीत काय मांडावे, अपील आणि उच्च न्यायालयातील आव्हान.',
'categories' => ['criminal-law','legal-rights','marathi'],
'focus_kw'   => 'तडीपार नोटीस',
'seo_title'  => 'तडीपार नोटीस पुणे: कलम ५६ तडीपारी, सुनावणी आणि अपील',
'seo_desc'   => 'पुण्यात तडीपार नोटीस आली? महाराष्ट्र पोलीस अधिनियम कलम ५६ नुसार तडीपारी, सुनावणीत द्यायचे उत्तर, ३० दिवसांत अपील आणि उच्च न्यायालयातील आव्हान.',
'content'    => '<!-- wp:paragraph -->
<p><strong>तडीपार नोटीस</strong> म्हणजे <strong>महाराष्ट्र पोलीस अधिनियम, १९५१</strong> अंतर्गत दिलेली कारणे दाखवा नोटीस: तुम्हाला दोन वर्षांपर्यंत पुणे (आणि अनेकदा शेजारचे जिल्हे) सोडण्याचा आदेश का देऊ नये, याचे उत्तर मागितले जाते. ही शिक्षा नाही आणि आदेश अजून झालेला नाही. नोटीसनंतरची सुनावणी ही तडीपारी थांबवण्याची सर्वात चांगली संधी असते, त्यामुळे तिथे दिलेले लेखी उत्तर आणि कागदपत्रे सर्वात महत्त्वाची ठरतात.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>तडीपारी म्हणजे काय?</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>तडीपारी ही प्रतिबंधात्मक कारवाई आहे. पोलिसांना गुन्हा सिद्ध करावा लागत नाही; तुमचे त्या भागात राहणे लोकांना किंवा मालमत्तेला धोकादायक आहे, हे त्यांना अधिकाऱ्यांसमोर दाखवावे लागते. यामुळे स्वतःच्या शहरात राहण्याचे आणि फिरण्याचे स्वातंत्र्य जाते, म्हणून सर्वोच्च न्यायालयाने ही <em>असाधारण</em> कारवाई असून ती क्वचित आणि खऱ्या, अलीकडच्या पुराव्यावरच करावी, असे वारंवार म्हटले आहे (उदा. <em>दीपक लक्ष्मण डोंगरे विरुद्ध महाराष्ट्र राज्य</em>, २८ जानेवारी २०२२).</p>
<!-- /wp:paragraph -->
<!-- wp:list -->
<ul>
<li><strong>कलम ५५</strong>: टोळी किंवा जमाव पांगवणे.</li>
<li><strong>कलम ५६</strong>: ज्या व्यक्तीच्या हालचालींमुळे भीती, धोका किंवा हानी होत आहे, किंवा जी बळाचा वापर असलेल्या किंवा शरीर व मालमत्तेविरुद्धच्या गुन्ह्यांत गुंतलेली आहे आणि भीतीमुळे साक्षीदार पुढे येत नाहीत, अशा व्यक्तीला हद्दपार करणे.</li>
<li><strong>कलम ५७</strong>: काही गुन्ह्यांत दोषी ठरलेल्या व्यक्तीला हद्दपार करणे.</li>
<li><strong>कलम ५८</strong>: आदेश दोन वर्षांपेक्षा जास्त काळ राहू शकत नाही.</li>
<li><strong>कलम ५९</strong>: आदेशापूर्वीची सुनावणी.</li>
<li><strong>कलम ६०</strong>: राज्य शासनाकडे अपील.</li>
</ul>
<!-- /wp:list -->
<!-- wp:paragraph -->
<p>पुणे शहर आणि पिंपरी-चिंचवड हे पोलीस आयुक्तालय क्षेत्र असल्याने नोटीस सहसा परिमंडळ पोलीस उपायुक्त देतात. पुणे ग्रामीण भागात प्रस्ताव सहसा उपविभागीय दंडाधिकाऱ्यांकडे जातो.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>नोटीस मिळाल्यानंतर पुढे काय होते</h2>
<!-- /wp:heading -->
<!-- wp:list {"ordered":true} -->
<ol>
<li><strong>नोटीस:</strong> तुमच्यावरील आरोपांचे सर्वसाधारण स्वरूप त्यात सांगितलेले असावे. सहसा तुमच्यावरील गुन्ह्यांची यादी आणि (अनेकदा नाव न दिलेल्या) साक्षीदारांच्या जबाबांचा उल्लेख असतो.</li>
<li><strong>सुनावणी:</strong> हजर राहण्याचा, लेखी खुलासा देण्याचा, वकिलामार्फत बाजू मांडण्याचा आणि स्वतःचे साक्षीदार आणण्याचा तुम्हाला हक्क आहे (कलम ५९).</li>
<li><strong>आदेश:</strong> अधिकारी कारवाई रद्द करतात किंवा क्षेत्र आणि कालावधी नमूद करून तडीपारीचा आदेश देतात.</li>
<li><strong>अपील:</strong> आदेशाविरुद्ध आदेशाच्या तारखेपासून <strong>३० दिवसांत</strong> राज्य शासनाकडे अपील करता येते (कलम ६०).</li>
<li><strong>उच्च न्यायालय:</strong> संविधानाच्या अनुच्छेद २२६ अंतर्गत मुंबई उच्च न्यायालयात रिट याचिका करता येते. कारणे मर्यादित असली तरी प्रक्रियेतील त्रुटी आणि खऱ्या पुराव्याचा अभाव ही मान्य कारणे आहेत.</li>
</ol>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>सुनावणीत उत्तरात काय मांडावे</h2>
<!-- /wp:heading -->
<!-- wp:list -->
<ul>
<li><strong>जुने गुन्हे:</strong> अनेक वर्षे जुने, निर्दोष मुक्तता किंवा दोषमुक्ती झालेले, किंवा तडजोड झालेले गुन्हे सध्याचा धोका दाखवत नाहीत.</li>
<li><strong>गुन्ह्यांचे स्वरूप:</strong> कौटुंबिक किंवा मालमत्तेचे वाद, आणि कलम ५६ मध्ये उल्लेख नसलेल्या कलमांखालील गुन्हे मोजू नयेत.</li>
<li><strong>साक्षीदारांचे जबाब:</strong> "इन-कॅमेरा" जबाब मोघम असतील, एकाच दिवशी नोंदवले असतील किंवा विशिष्ट घटना सांगत नसतील, तर ते स्पष्टपणे मांडा.</li>
<li><strong>क्षेत्र:</strong> आदेशाचे क्षेत्र कथित कृत्यांशी संबंधित असावे. एका पोलीस ठाण्याच्या हद्दीतील आरोपांसाठी अनेक जिल्ह्यांतून तडीपारी अवाजवी म्हणून आव्हान देता येते.</li>
<li><strong>कालावधी:</strong> निवडलेला कालावधी का आवश्यक आहे हे अधिकाऱ्यांनी सांगायला हवे. दोन वर्षे ही कमाल मर्यादा आहे, नेहमीचा कालावधी नव्हे.</li>
<li><strong>तुमची परिस्थिती:</strong> नोकरी, व्यवसाय, शिक्षण, अवलंबून असलेले कुटुंब, वैद्यकीय उपचार आणि जामिनाच्या अटी किंवा न्यायालयात हजेरी.</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>आत्ताच गोळा करावयाची कागदपत्रे</h2>
<!-- /wp:heading -->
<!-- wp:list -->
<ul>
<li>नोटीस आणि लिफाफा, ती मिळाल्याच्या तारखेसह.</li>
<li>यादीतील प्रत्येक गुन्ह्याची प्रत किंवा सद्यस्थिती: एफआयआर, दोषारोपपत्र, जामीन आदेश, निर्दोष मुक्तता किंवा दोषमुक्तीचा निकाल.</li>
<li>राहण्याचा, नोकरीचा किंवा व्यवसायाचा पुरावा (भाडेकरार, पगार पावत्या, जीएसटी किंवा दुकान नोंदणी).</li>
<li>अवलंबून कुटुंब, शिक्षण किंवा पुण्यातील वैद्यकीय उपचारांची कागदपत्रे.</li>
<li>गरज पडल्यास सुनावणीला येऊ शकतील अशा व्यक्तींची चारित्र्य पत्रे.</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>आदेश आधीच झाला असेल तर</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>आव्हान देत असतानाही आदेशाचे पालन करा. परवानगीशिवाय प्रतिबंधित क्षेत्रात येणे हा अधिनियमाखाली वेगळा गुन्हा आहे आणि तो अपीलमध्ये तुमच्याविरुद्ध वापरला जाईल. अपीलचे ३० दिवस आदेशाच्या तारखेपासून मोजा, आणि संपूर्ण रेकॉर्ड (प्रस्ताव, आधार घेतलेले जबाब, सुनावणीच्या नोंदी) मागून घ्या, म्हणजे अपील किंवा रिट याचिकेत प्रत्येक मुद्द्याला उत्तर देता येईल.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>नेहमी विचारले जाणारे प्रश्न</h2>
<!-- /wp:heading -->
<!-- wp:heading {"level":3} -->
<h3>शिक्षा झाली नसतानाही पोलीस तडीपार करू शकतात का?</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>होय. कलम ५६ साठी शिक्षा आवश्यक नाही, म्हणूनच आधार घेतलेले पुरावे आणि सुनावणी महत्त्वाची आहे. दोषी ठरलेल्या व्यक्तींसाठी कलम ५७ स्वतंत्र आहे.</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":3} -->
<h3>तडीपारीचा आदेश किती काळ राहू शकतो?</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>जास्तीत जास्त दोन वर्षे (कलम ५८). निवडलेल्या कालावधीचे समर्थन अधिकाऱ्यांनी करायला हवे.</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":3} -->
<h3>तडीपारीदरम्यान न्यायालयीन तारखेसाठी पुण्यात येता येते का?</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>फक्त परवानगीने. न्यायालयीन हजेरी किंवा कौटुंबिक आणीबाणीसाठी आदेश देणाऱ्या अधिकाऱ्यांकडे परवानगी मागा आणि परवानगीची प्रत सोबत ठेवा.</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":3} -->
<h3>अपीलची मुदत किती आहे?</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>आदेशाच्या तारखेपासून ३० दिवस, राज्य शासनाकडे (कलम ६०). मुंबई उच्च न्यायालयातील रिट याचिका हा वेगळा उपाय आहे.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><em>हा लेख महाराष्ट्रातील कायद्याबद्दल सर्वसाधारण माहिती आहे, तुमच्या प्रकरणासाठी कायदेशीर सल्ला नाही. आमचा <a href="/disclaimer/">अस्वीकरण</a> वाचा. मिळालेल्या नोटीसबद्दल चर्चा करण्यासाठी <a href="/contact/">संपर्क पृष्ठ</a> वापरा. इंग्रजीत वाचा: <a href="/tadipar-externment-notice-pune/">Tadipar notice in Pune</a>.</em></p>
<!-- /wp:paragraph -->',
],

    ];
}
