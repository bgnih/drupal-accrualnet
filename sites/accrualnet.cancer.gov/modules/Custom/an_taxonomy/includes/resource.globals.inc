<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//The resources menu will be built based upon the vocabulary of these
//5 sections. If system names below  will change, these must be changed to map to
//the correct machine names.
$GLOBALS['an_resource_menu_vocab'] = array(
    'patient_related',
    'provider_related',
    'systems_and_regulatory',
    'study',
    'ethical',
);

$GLOBALS['an_vocabularies'] = array(
	array(
		'name' => 'Patient-Related Issues',
		'machine_stem' => 'patient_related',
		'terms' => array(
			'Knowledge/Attitudes/Beliefs',
			'Language or Cultural Barriers',
			'Logistics/Transportation',
			'Underserved',
			'Low Literacy',
			'Non-English Speaking',
			'Cost/Insurance',
			'Urban',
			'Rural',
			'Remuneration'
	)),
	array(
		'name' => 'Provider-Related Issues',
		'machine_stem' => 'provider_related',
		'terms' => array(
			'Level of Clinical Trials Knowledge or Awareness',
			'Incentives',
			'Staff Experience Level',
			'Physician Champions',
			'Provider-Patient Relationship',
			'Attitudes'
	)),
	array(
		'name' => 'Systems and Regulatory Issues',
		'machine_stem' => 'systems_and_regulatory',
		'terms' => array(
			'Insurance Coverage',
			'Institutional Issues',
			'Regulatory Issues',
			'Inadequate Staffing',
                        'International',
	)),
	array(
		'name' => 'Study Issues',
		'machine_stem' => 'study',
		'terms' => array(
			'Eligibility',
			'Placebo',
			'Randomization',
			'Study Burden'
	)),
	array(
		'name' => 'Ethical Issues',
		'machine_stem' => 'ethical',
		'terms' => array(
			'Consent',
			'Financial Incentives',
			'Provider Influence',
			'Conflict of Interest'
	)),
	array(
		'name' => 'Demographics',
		'machine_stem' => 'demographics',
		'terms' => array(
			'Women',
			'Men',
			'Children',
			'Adolescent/Young Adult',
			'Older Adults',
			'Minority Groups',
			'American Indian or Alaskan Native',
			'Asian',
			'Black or African-American',
			'Hispanic or Latino',
			'Native Hawaiian',
			'Other Pacific Islander',
			'White or Caucasian',
			'Other'
	)),
	array(
		'name' => 'Recruitment Methods',
		'machine_stem' => 'recruitment',
		'terms' => array(
			'Verbal Communications',
			'Radio',
			'TV',
			'Web',
			'Social Media',
			'Print Media',
			'Brochure or Flyer',
			'Letter',
			'EMR'
	)),
    /*
     * Resource Type: no longer a tag -> was moved to content types
	array(
		'name' => 'Resource Type',
		'machine_stem' => 'resource_type',
		'terms' => array(
			'Sample Materials and Forms',
			'Presentations',
			'Patient Education Materials',
			'Staff Education Materials',
			'Journal Articles',
			'Journal Review Articles',
			'Meetings Abstract', //TIR#1972
			'Reports'
	)),
     * 
     */
	array(
		'name' => 'Trial/Treatment Type',
		'machine_stem' => 'trial_treatment',
		'terms' => array(
			'Non-Cancer',
			'Cancer',
                    'Prevention',
                    'Screening',
                    'Treatment',
                    'Pallative',
                    'Survivorship',
                    'Behavioral',
                    
	)),
	array(
		'name' => 'Trial Phase',
		'machine_stem' => 'trial_phase',
		'terms' => array(
			'Phase 0,1,2',
			'Phase 3-4'
	))
);
?>
