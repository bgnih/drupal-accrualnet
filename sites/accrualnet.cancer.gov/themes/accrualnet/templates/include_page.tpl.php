<?php
/**
 * @file
 * Zen theme's implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo , as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $secondary_menu_heading: The title of the menu used by the secondary links.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['navigation']: Items for the navigation region, below the main menu (if any).
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['footer']: Items for the footer region.
 * - $page['bottom']: Items to appear at the bottom of the page below the footer.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see zen_preprocess_page()
 * @see template_process()
 * 
 * 
 */
module_load_include('inc', 'nci_custom_user', 'includes\profilecolors');

$profileColor = 'Black';
if($logged_in) {
    //global $user;
    global $nci_user_profile_colors;
    
    //load the current user profile
    $currentUser = user_load($user->uid);
    //check to see if the user has a profile color selected;
    $profile_color_value = field_get_items('user', $currentUser, 'profile_color');
    if($profile_color_value)
    { 
       $profileColor =  $nci_user_profile_colors[$profile_color_value[0]['value']];
    }
    
    $avatar = field_get_items('user', $currentUser, 'avatar_image');
    if ($avatar) {
        $simulatedAvatarArray = array();
        foreach ($nci_user_profile_colors as $avatarColor) {
            $simulatedAvatarArray[] = 'male/'.$avatarColor;
            $simulatedAvatarArray[] = 'female/'.$avatarColor;
        }
        $avatarTMP = intval($avatar[0]['value']);
        $avatarTMP = $simulatedAvatarArray[$avatarTMP];
        $avatarSRC = '/' . path_to_theme() . '/accrualnet-internals/images/avatars/' . $avatarTMP . '.png';
    }
    else {
        $avatarSRC = '/' . path_to_theme() . '/accrualnet-internals/images/avatars/male/Black.png';

    }

}

/*******************************************************************************
 * Area Color
 ******************************************************************************/
$areaColor = null;
$setArea = null;
$urlStr = check_plain($_GET['q']);

if (strpos($urlStr, 'node') > -1) {
    $urlStr = drupal_lookup_path('alias', $urlStr);
}
$areaColors = array(
    'literature' => 'Blue',
    'content' => 'Blue',
    'communities' => 'Orange',
    'education' => 'Red',
    'protocol_accrual_lifecycle' => 'Purple',
    'protocol_accrual_lifecycle'
);
foreach ($areaColors as $area => $color) {
    if (strlen($area) <= strlen($urlStr)) {
        if (! substr_compare($urlStr, $area, 0, strlen($area), TRUE)) {
            $areaColor = $color;
            $setArea = $area;
        }
    }
}


/*******************************************************************************
 *****                            Title Additions                          *****
 ******************************************************************************/
//$titleAdditions = null;
//global $pager_total_items;
//switch ($setArea) {
//    case 'literature':
//        $titleAdditions = ($pager_total_items) ? ' <span id="title-results-number">('.$pager_total_items[0].')</span>' : '';
//        $titleAdditions .= '<span id="title-results-pager">'.$pager.'</span>';
//        break;
//}
/*
if ($pager_total_items != null) {
    $titleAdditions = ' <span id="title-results-number">('.$pager_total_items[0].')</span>';
}*/
?>
<a name="top" style="width:0px;height:0px;"></a>
<div id="page"<?php if ($areaColor) print ' class="'.$areaColor.'"'; ?>>
    <div id="ncibanner" class="clearfix">
        <ul>
        <li class="nciLogo"><a title="The National Cancer Institute" href="http://www.cancer.gov">The National Cancer Institute</a></li>
        </ul>
  </div>
<div id="header" class="header">
    <header id="page-header" role="banner">


        <div class="header-content">
    <?php if ($site_name || $site_slogan): ?>
      <hgroup id="name-and-slogan">
        
          <h1 id="site-name">
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span class="site-name-accrual">Accrual</span><span class="site-name-net">Net<span class="tm">TM</span></span></a>
          </h1>
      

          <h2 id="site-slogan"><span class="site-slogan">STRATEGIES, TOOLS AND RESOURCES TO SUPPORT ACCRUAL TO CLINICAL TRIALS</span></h2>
    
      </hgroup><!-- /#name-and-slogan -->
    <?php endif; ?>

      <div class="header-right header-<?php print $profileColor; ?>">
          
        <?php if ($secondary_menu): ?>
        <nav id="secondary-menu" role="navigation">
            <?php print theme('links__system_secondary_menu', array(
            'links' => $secondary_menu,
            'attributes' => array(
                'class' => array('links', 'inline', 'clearfix'),
            ),
            'heading' => array(
                'text' => $secondary_menu_heading,
                'level' => 'h2',
                'class' => array('element-invisible'),
            ),
            )); ?>
        </nav>
          <?php else: ?>
          <nav id="secondary-menu" role="navigation">
              <h2 class="element-invisible">User menu</h2>
              <ul class="links inline clearfix">
              <li class="menu-1 first"><a href="/user/register">Register</a></li>
              <li class="menu-2 last"><a href="/user">Sign In</a></li>
              </ul>
          </nav>
        <?php endif; ?>
          <?php if($logged_in): ?>
            <div class="user-blerb">
                <div class="user-welcome-text">Hi <?php print t($user->name);?>!</div>    
                <div class="user-welcome-image">
                <?php if($currentUser->picture && !$avatar):?>
                    <?php print theme('image_style',
                            array(
                                'path' => $currentUser->picture->uri,
                                'style_name' => 'scale_25',     
                                'alt' => $user->name ."'s Image",
                            )
                        ); ?>
                <?php else: ?>
                    <img alt="<?php print check_plain($user->name);?>'s Image" src="<?php print $avatarSRC;?>" width="20" title="<?php print check_plain($currentUser->name);?>'s Image" alt="<?php print check_plain($currentUser->name);?>'s Image" />
                <?php endif;?>
                </div>
            
            </div>
          <?php endif;?>
           <div id="site-wide-search-box">
          <?php $block = module_invoke('search', 'block_view', 'form');

            print render($block);?>
           </div>
     </div> <!-- end header right -->
   </div> <!-- end header-content -->
      <div id="navigation">

      <?php if ($main_menu): ?>
        <nav id="main-menu" role="navigation">
          <?php
          
          drupal_add_js(path_to_theme() . '/js/navigation.js', 'file');
          
          // This code snippet is hard to modify. We recommend turning off the
          // "Main menu" on your sub-theme's settings form, deleting this PHP
          // code block, and, instead, using the "Menu block" module.
          // @see http://drupal.org/project/menu_block
          print theme('links__system_an_main_menu', array(
            'links' => $main_menu,
            'attributes' => array(
              'class' => array('links', 'inline', 'clearfix'),
            ),
            'heading' => array(
              'text' => t('Main menu'),
              'level' => 'h2',
              'class' => array('element-invisible'),
            ),
          )); ?>
        </nav>
      <?php endif; ?>

      <?php print render($page['navigation']); ?>

    </div><!-- /#navigation -->
  </header>
</div>
    
    <div id="main-wrapper">    
  <div id="main">

      <div id="page-options">
          <?php print $breadcrumb; ?>
          <?php if (!$is_front && $title != "Page not found"):?>
          <div class="add-this"><div class="custom-images">
                  <a class="addthis_button_email"><img width="20" alt="Email This Page Icon" src="/sites/accrualnet.cancer.gov/themes/accrualnet/accrualnet-internals/images/icons/AccrualNet_EmailIcon.png"/>Email this Page</a>
                  <a class="addthis_button_print"><img width="20" alt="Print This Page Icon" src="/sites/accrualnet.cancer.gov/themes/accrualnet/accrualnet-internals/images/icons/AccrualNet_PrintIcon.png"/>Print this Page</a>
              </div></div>
          
          <?php endif;?>
      </div>
      <?php print $messages; 
      print render($tabs); 
      //print render($page['help']); 
      //if ($action_links): 
        //<ul class="action-links"><?php print render($action_links); ?</ul>
      //endif; ?>
    <div id="content" class="column" role="main">
      <?php print render($page['highlighted']); ?>
      <a id="main-content"></a>
      <?php print render($title_prefix); ?>
      <?php 
		if ($title && (!isset($node) || (isset($node) && $node->type != 'conversation'))): ?>
        <h1 class="title" id="page-title"><?php print $title ?>
		</h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
	  <?php $is_maint = variable_get('maintenance_mode',''); ?>
	  <?php if(!empty($is_maint) && !empty($content)) print '<div class="content-wrapper">' . $content . '</div>'; ?>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
    </div><!-- /#content -->

    

    <?php
      // Render the sidebars to see if there's anything in them.
      $sidebar_first  = render($page['sidebar_first']);
      $sidebar_second = render($page['sidebar_second']);
    ?>

    <?php if ($sidebar_first || $sidebar_second): ?>
      <aside class="sidebars">
        <?php print $sidebar_first; ?>
        <?php print $sidebar_second; ?>
      </aside><!-- /.sidebars -->
    <?php endif; ?>

  </div><!-- /#main -->
    </div><!-- /#main-wrapper -->
  <?php print render($page['footer']); ?>
<br/>
  <div class="footer-push"></div>
</div><!-- /#page -->
 <div id="footer" class="clearfix"><div class="section">

          <div id="nci-footer">
            <div class="footer-links">
              <ul>
                <li><a href="/">AccrualNet<sup>TM</sup> Home</a></li>
                <li><a href="/about/contact-us">Contact Us</a></li>
                <li><a href="http://www.cancer.gov/global/web/policies" target="_blank">Policies</a></li>
                <li><a href="http://www.cancer.gov/global/web/policies/page3" target="_blank">Accessibility</a></li>
                <li><a href="http://www.cancer.gov/global/viewing-files" target="_blank">Viewing Files</a></li>
                <li><a href="http://www.cancer.gov/global/web/policies/page6" target="_blank">FOIA</a></li>
                <li class="last"><a href="/about">About Us</a></li>
              </ul>
          </div>
            <div class="footer-links">
              <ul>
                <li><a href="http://www.hhs.gov/" target="_blank">U.S. Department of Health and Human Services</a></li>
                <li><a href="http://www.nih.gov/" target="_blank">National Institutes of Health</a></li>
                <li><a href="http://www.cancer.gov/" target="_blank">National Cancer Institute</a></li>
                <li class="last"><a href="http://www.usa.gov" target="_blank">USA.gov</a></li>
              </ul>
          </div>
            <div class="footer-text">NIH…Turning Discovery Into Health <sup>®</sup></div>
          </div>
          

      </div></div> <!-- /.section, /#footer -->
