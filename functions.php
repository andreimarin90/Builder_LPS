<?php

use Recurly\Service\SubscriptionService;

add_action( 'wp_enqueue_scripts', 'builder_lp_child_scripts' );
function builder_lp_child_scripts(){
	if(is_page_template('emailer.php')
	   || strpos(get_page_template(), 'page-checkout.php')
	) {
		//Smooth Scroll
		wp_enqueue_script('child-modernizr', get_stylesheet_directory_uri() . '/js/libs/modernizr.min.js', ['jquery'], null, true);
		wp_enqueue_script('child-bbt-jquery', get_stylesheet_directory_uri() . '/js/libs/jquery-1.12.3.min.js', ['jquery'], null, true);

		wp_enqueue_script('child-bootstrap', get_stylesheet_directory_uri() . '/js/libs/bootstrap.min.js', ['jquery'], null, true);

		wp_enqueue_script('child-bbt-placeholder', get_stylesheet_directory_uri() . '/js/jquery.powerful-placeholder.min.js', ['jquery'], null, true);
		wp_enqueue_script('child-bbt-owl', get_stylesheet_directory_uri() . '/js/owl.carousel.js', ['jquery'], null, true);
		wp_enqueue_script('child-bbt-mousewheel', get_stylesheet_directory_uri() . '/js/jquery.mousewheel.min.js', ['jquery'], null, true);
		wp_enqueue_script('child-bbt-touchSwipe', get_stylesheet_directory_uri() . '/js/jquery.touchSwipe.min.js', ['jquery'], null, true);

		wp_enqueue_script('child-material-js', 'https://code.getmdl.io/1.1.3/material.min.js', ['jquery'], null, true);

		wp_enqueue_script('child-bbt-navigation1', get_stylesheet_directory_uri() . '/js/bbt.navigation1.js', ['jquery'], null, true);
		wp_enqueue_script('child-bbt-js', get_stylesheet_directory_uri() . '/js/bbt.js', ['jquery'], null, true);

		wp_enqueue_style( 'child-material-icons', 'https://code.getmdl.io/1.1.3/material.blue-indigo.min.css' );
		wp_enqueue_style( 'child-helpers-css', get_stylesheet_directory_uri() . '/css/helpers.css' );
		wp_enqueue_style( 'child-bbt-css', get_stylesheet_directory_uri() . '/css/bbt.css' );

		//Recurly
		wp_enqueue_script('child-bbt-recurly-js', 'https://js.recurly.com/v4/recurly.js', ['jquery'], null, true);
		wp_enqueue_script('child-bbt-recurly-api', get_stylesheet_directory_uri() . '/js/recurly-api.js', ['jquery', 'child-bbt-js'], null, true);
		wp_enqueue_style( 'child-material-icons', 'https://js.recurly.com/v4/recurly.css' );

		wp_localize_script('child-bbt-js', 'bbt_script_vars', [
				'templateList' => get_email_template_list(),
				'isUserLoggedIn' => is_user_logged_in(),
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'hasActiveSubscription' => hasActiveSubscription(),
				'currentSubscription' => getCurrentSubscription(),
			]
		);
	}
}

add_action( 'wp_print_scripts', 'bbt_deregister_unneeded_scripts', 15 );
function bbt_deregister_unneeded_scripts() {
    if(is_page_template('emailer.php') || is_page_template('free-dd.php')){
        wp_dequeue_script( 'contact-form-7' );
        wp_dequeue_script( 'jquery-blockui' );
		wp_dequeue_script( 'wc-js-cookie' );
		wp_dequeue_script( 'woocommerce' );
		wp_dequeue_script( 'wc-add-to-cart' );
		wp_dequeue_script( 'wc-cart-fragments' );
    }
}

add_action( 'wp_print_styles', 'bbt_deregister_styles', 100 );
function bbt_deregister_styles() {
	if(is_page_template('emailer.php') || is_page_template('free-dd.php')){
		wp_dequeue_style( 'woocommerce-layout' );
		wp_dequeue_style( 'woocommerce-smallscreen' );
		wp_dequeue_style( 'woocommerce-general' );
		wp_dequeue_style( 'wordfenceAJAXcss' ) ;
		wp_dequeue_style( 'yoast-seo-adminbar' );
		wp_dequeue_style( 'bbt_builder-bootstrap-css-css' );
	}
}

function bbtb_theme_setup() {
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'bbtb_theme_setup' );

function set_private_categories($post_id) {
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	
	//die();
}
//add_action( 'save_post', 'set_private_categories' );

// if(is_page_template('emailer.php')) {
// }

add_filter( 'wpseo_canonical', '__return_false' );

//remove add to cart message
add_filter( 'wc_add_to_cart_message_html', '__return_null' );

function get_email_template_list(): array
{
	$templateList = [];
	$args = [
		'post_type'      => 'template',
		'posts_per_page' => -1
	];

	$templates = get_posts($args);
	foreach($templates as $template) {
		$templateList[$template->ID] = $template->post_title;
	}

	return $templateList;
}

function getCountries() : array
{
	return [
		"AF" => "Afghanistan",
		"AX" => "Åland Islands",
		"AL" => "Albania",
		"DZ" => "Algeria",
		"AS" => "American Samoa",
		"AD" => "Andorra",
		"AO" => "Angola",
		"AI" => "Anguilla",
		"AQ" => "Antarctica",
		"AG" => "Antigua and Barbuda",
		"AR" => "Argentina",
		"AM" => "Armenia",
		"AW" => "Aruba",
		"AU" => "Australia",
		"AT" => "Austria",
		"AZ" => "Azerbaijan",
		"BS" => "Bahamas",
		"BH" => "Bahrain",
		"BD" => "Bangladesh",
		"BB" => "Barbados",
		"BY" => "Belarus",
		"BE" => "Belgium",
		"BZ" => "Belize",
		"BJ" => "Benin",
		"BM" => "Bermuda",
		"BT" => "Bhutan",
		"BO" => "Bolivia",
		"BA" => "Bosnia and Herzegovina",
		"BW" => "Botswana",
		"BV" => "Bouvet Island",
		"BR" => "Brazil",
		"IO" => "British Indian Ocean Territory",
		"BN" => "Brunei Darussalam",
		"BG" => "Bulgaria",
		"BF" => "Burkina Faso",
		"BI" => "Burundi",
		"KH" => "Cambodia",
		"CM" => "Cameroon",
		"CA" => "Canada",
		"CV" => "Cape Verde",
		"KY" => "Cayman Islands",
		"CF" => "Central African Republic",
		"TD" => "Chad",
		"CL" => "Chile",
		"CN" => "China",
		"CX" => "Christmas Island",
		"CC" => "Cocos (Keeling) Islands",
		"CO" => "Colombia",
		"KM" => "Comoros",
		"CG" => "Congo",
		"CD" => "Congo, The Democratic Republic of The",
		"CK" => "Cook Islands",
		"CR" => "Costa Rica",
		"CI" => "Cote D'ivoire",
		"HR" => "Croatia",
		"CU" => "Cuba",
		"CY" => "Cyprus",
		"CZ" => "Czech Republic",
		"DK" => "Denmark",
		"DJ" => "Djibouti",
		"DM" => "Dominica",
		"DO" => "Dominican Republic",
		"EC" => "Ecuador",
		"EG" => "Egypt",
		"SV" => "El Salvador",
		"GQ" => "Equatorial Guinea",
		"ER" => "Eritrea",
		"EE" => "Estonia",
		"ET" => "Ethiopia",
		"FK" => "Falkland Islands (Malvinas)",
		"FO" => "Faroe Islands",
		"FJ" => "Fiji",
		"FI" => "Finland",
		"FR" => "France",
		"GF" => "French Guiana",
		"PF" => "French Polynesia",
		"TF" => "French Southern Territories",
		"GA" => "Gabon",
		"GM" => "Gambia",
		"GE" => "Georgia",
		"DE" => "Germany",
		"GH" => "Ghana",
		"GI" => "Gibraltar",
		"GR" => "Greece",
		"GL" => "Greenland",
		"GD" => "Grenada",
		"GP" => "Guadeloupe",
		"GU" => "Guam",
		"GT" => "Guatemala",
		"GG" => "Guernsey",
		"GN" => "Guinea",
		"GW" => "Guinea-bissau",
		"GY" => "Guyana",
		"HT" => "Haiti",
		"HM" => "Heard Island and Mcdonald Islands",
		"VA" => "Holy See (Vatican City State)",
		"HN" => "Honduras",
		"HK" => "Hong Kong",
		"HU" => "Hungary",
		"IS" => "Iceland",
		"IN" => "India",
		"ID" => "Indonesia",
		"IR" => "Iran, Islamic Republic of",
		"IQ" => "Iraq",
		"IE" => "Ireland",
		"IM" => "Isle of Man",
		"IL" => "Israel",
		"IT" => "Italy",
		"JM" => "Jamaica",
		"JP" => "Japan",
		"JE" => "Jersey",
		"JO" => "Jordan",
		"KZ" => "Kazakhstan",
		"KE" => "Kenya",
		"KI" => "Kiribati",
		"KP" => "Korea, Democratic People's Republic of",
		"KR" => "Korea, Republic of",
		"KW" => "Kuwait",
		"KG" => "Kyrgyzstan",
		"LA" => "Lao People's Democratic Republic",
		"LV" => "Latvia",
		"LB" => "Lebanon",
		"LS" => "Lesotho",
		"LR" => "Liberia",
		"LY" => "Libyan Arab Jamahiriya",
		"LI" => "Liechtenstein",
		"LT" => "Lithuania",
		"LU" => "Luxembourg",
		"MO" => "Macao",
		"MK" => "Macedonia, The Former Yugoslav Republic of",
		"MG" => "Madagascar",
		"MW" => "Malawi",
		"MY" => "Malaysia",
		"MV" => "Maldives",
		"ML" => "Mali",
		"MT" => "Malta",
		"MH" => "Marshall Islands",
		"MQ" => "Martinique",
		"MR" => "Mauritania",
		"MU" => "Mauritius",
		"YT" => "Mayotte",
		"MX" => "Mexico",
		"FM" => "Micronesia, Federated States of",
		"MD" => "Moldova, Republic of",
		"MC" => "Monaco",
		"MN" => "Mongolia",
		"ME" => "Montenegro",
		"MS" => "Montserrat",
		"MA" => "Morocco",
		"MZ" => "Mozambique",
		"MM" => "Myanmar",
		"NA" => "Namibia",
		"NR" => "Nauru",
		"NP" => "Nepal",
		"NL" => "Netherlands",
		"AN" => "Netherlands Antilles",
		"NC" => "New Caledonia",
		"NZ" => "New Zealand",
		"NI" => "Nicaragua",
		"NE" => "Niger",
		"NG" => "Nigeria",
		"NU" => "Niue",
		"NF" => "Norfolk Island",
		"MP" => "Northern Mariana Islands",
		"NO" => "Norway",
		"OM" => "Oman",
		"PK" => "Pakistan",
		"PW" => "Palau",
		"PS" => "Palestinian Territory, Occupied",
		"PA" => "Panama",
		"PG" => "Papua New Guinea",
		"PY" => "Paraguay",
		"PE" => "Peru",
		"PH" => "Philippines",
		"PN" => "Pitcairn",
		"PL" => "Poland",
		"PT" => "Portugal",
		"PR" => "Puerto Rico",
		"QA" => "Qatar",
		"RE" => "Reunion",
		"RO" => "Romania",
		"RU" => "Russian Federation",
		"RW" => "Rwanda",
		"SH" => "Saint Helena",
		"KN" => "Saint Kitts and Nevis",
		"LC" => "Saint Lucia",
		"PM" => "Saint Pierre and Miquelon",
		"VC" => "Saint Vincent and The Grenadines",
		"WS" => "Samoa",
		"SM" => "San Marino",
		"ST" => "Sao Tome and Principe",
		"SA" => "Saudi Arabia",
		"SN" => "Senegal",
		"RS" => "Serbia",
		"SC" => "Seychelles",
		"SL" => "Sierra Leone",
		"SG" => "Singapore",
		"SK" => "Slovakia",
		"SI" => "Slovenia",
		"SB" => "Solomon Islands",
		"SO" => "Somalia",
		"ZA" => "South Africa",
		"GS" => "South Georgia and The South Sandwich Islands",
		"ES" => "Spain",
		"LK" => "Sri Lanka",
		"SD" => "Sudan",
		"SR" => "Suriname",
		"SJ" => "Svalbard and Jan Mayen",
		"SZ" => "Swaziland",
		"SE" => "Sweden",
		"CH" => "Switzerland",
		"SY" => "Syrian Arab Republic",
		"TW" => "Taiwan, Province of China",
		"TJ" => "Tajikistan",
		"TZ" => "Tanzania, United Republic of",
		"TH" => "Thailand",
		"TL" => "Timor-leste",
		"TG" => "Togo",
		"TK" => "Tokelau",
		"TO" => "Tonga",
		"TT" => "Trinidad and Tobago",
		"TN" => "Tunisia",
		"TR" => "Turkey",
		"TM" => "Turkmenistan",
		"TC" => "Turks and Caicos Islands",
		"TV" => "Tuvalu",
		"UG" => "Uganda",
		"UA" => "Ukraine",
		"AE" => "United Arab Emirates",
		"GB" => "United Kingdom",
		"US" => "United States",
		"UM" => "United States Minor Outlying Islands",
		"UY" => "Uruguay",
		"UZ" => "Uzbekistan",
		"VU" => "Vanuatu",
		"VE" => "Venezuela",
		"VN" => "Viet Nam",
		"VG" => "Virgin Islands, British",
		"VI" => "Virgin Islands, U.S.",
		"WF" => "Wallis and Futuna",
		"EH" => "Western Sahara",
		"YE" => "Yemen",
		"ZM" => "Zambia",
		"ZW" => "Zimbabwe"
	];
}

function hasActiveSubscription(): bool
{
	return SubscriptionService::currentUserHasActiveSubscription();
}

function getCurrentSubscription(): ?string
{
	$subscription = SubscriptionService::getCurrentUserSubscription();

	return $subscription !== null ? $subscription->getPlanCode() : null;
}
