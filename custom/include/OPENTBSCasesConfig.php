<?php 
$configurator = new Configurator();
$mattlaw_settings = array(
		'cf_image_path_head_title' => 'custom/images/mattlaw_title.png',
		'cf_image_path_head_right_logo' => 'custom/images/mattlaw_logo.jpg',
		'cf_head_right_text' => 'Hutchinson House - 1906, IT',
		'cf_firm_phone' => '813-222-2222',
		'cf_firm_url' => 'MattLaw.com',
		'cf_firm_email' => 'mpowell@mattlaw.com',
		'cf_attorneys_list' => $configurator->config['DHA_templates_attorneys_list'],
	);
$advocates_united_settings = array(
		'cf_image_path_head_title' => 'custom/images/advocates_united_title.png',
		'cf_image_path_head_right_logo' => 'custom/images/advocates_united_logo.png',
		'cf_head_right_text' => 'The National Law Firm',
		'cf_firm_phone' => '813-899-8888',
		'cf_firm_url' => 'AdvocatesUnited.com',
		'cf_firm_email' => 'mpowell@advocatesunited.com',
		'cf_attorneys_list' => $configurator->config['DHA_templates_attorneys_list'],
	);
$openTBSConfigCases = array (
	'Advocates_United' => $advocates_united_settings,
	'Lets_Ask_the_Lawyer' => $mattlaw_settings,
	'Medical_Malpractice' => $mattlaw_settings,
	'Billboard' => $mattlaw_settings,
	'Book_Written_by_Matt' => $mattlaw_settings,
	'Facebook' => $mattlaw_settings,
	'Former_Client' => $mattlaw_settings,
	'Google_Search' => $mattlaw_settings,
	'LinkedIn' => $mattlaw_settings,
	'Motocycle_Event' => $mattlaw_settings,
	'Referral_from_Attorney' => $mattlaw_settings,
	'Referral_from_NonAttorney' => $mattlaw_settings,
	'TV_Commercial' => $mattlaw_settings,
	'Vietnamese_Magazine' => $mattlaw_settings,
	'Walk_In' => $mattlaw_settings,
	'YouTube' => $mattlaw_settings,
 );