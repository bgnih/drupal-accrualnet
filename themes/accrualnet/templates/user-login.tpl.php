<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<p>
	<?php print render($intro_text); ?>
</p>
<div class="accrualnet-user-login-form-wrapper">
 <div id="warning-banner">
  <p>This warning banner provides privacy and security notices consistent with applicable federal laws, directives, and other federal guidance for accessing this Government system, which includes (1) this computer network, (2) all computers connected to this network, and (3) all devices and storage media attached to this network or to a computer on this network.</p>
 
  <p>This system is provided for Government-authorized use only.</p>
 
  <p>Unauthorized or improper use of this system is prohibited and may result in disciplinary action and/or civil and criminal penalties.<br>
Personal use of social media and networking sites on this system is limited as to not interfere with official work duties and is subject to monitoring.</p>
 
  <p>By using this system, you understand and consent to the following:</p>
 
  <p>The Government may monitor, record, and audit your system usage, including usage of personal devices and email systems for official duties or to conduct HHS business. Therefore, you have no reasonable expectation of privacy regarding any communication or data transiting or stored on this system. At any time, and for any lawful Government purpose, the government may monitor, intercept, and search and seize any communication or data transiting or stored on this system.</p>
 
  <p>Any communication or data transiting or stored on this system may be disclosed or used for any lawful Government purpose.</p>
 </div>
	<?php print drupal_render_children($form) ?>
</div>
