<?php
/*
  $Id: advanced_search.php,v 1.49 2003/02/13 04:23:22 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADVANCED_SEARCH);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ADVANCED_SEARCH));
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
<script language="javascript"><!--
function check_form() {
  var error_message = "<?php echo JS_ERROR; ?>";
  var error_found = false;
  var error_field;
  var keywords = document.advanced_search.keywords.value;
  var dfrom = document.advanced_search.dfrom.value;
  var dto = document.advanced_search.dto.value;
  var pfrom = document.advanced_search.pfrom.value;
  var pto = document.advanced_search.pto.value;
  var pfrom_float;
  var pto_float;

  if ( ((keywords == '') || (keywords.length < 1)) && ((dfrom == '') || (dfrom == '<?php echo DOB_FORMAT_STRING; ?>') || (dfrom.length < 1)) && ((dto == '') || (dto == '<?php echo DOB_FORMAT_STRING; ?>') || (dto.length < 1)) && ((pfrom == '') || (pfrom.length < 1)) && ((pto == '') || (pto.length < 1)) ) {
    error_message = error_message + "<?php echo JS_AT_LEAST_ONE_INPUT; ?>";
    error_field = document.advanced_search.keywords;
    error_found = true;
  }

  if ((dfrom.length > 0) && (dfrom != '<?php echo DOB_FORMAT_STRING; ?>')) {
    if (!IsValidDate(dfrom, '<?php echo DOB_FORMAT_STRING; ?>')) {
      error_message = error_message + "<?php echo JS_INVALID_FROM_DATE; ?>";
      error_field = document.advanced_search.dfrom;
      error_found = true;
    }
  }

  if ((dto.length > 0) && (dto != '<?php echo DOB_FORMAT_STRING; ?>')) {
    if (!IsValidDate(dto, '<?php echo DOB_FORMAT_STRING; ?>')) {
      error_message = error_message + "<?php echo JS_INVALID_TO_DATE; ?>";
      error_field = document.advanced_search.dto;
      error_found = true;
    }
  }

  if ((dfrom.length > 0) && (dfrom != '<?php echo DOB_FORMAT_STRING; ?>') && (IsValidDate(dfrom, '<?php echo DOB_FORMAT_STRING; ?>')) && (dto.length > 0) && (dto != '<?php echo DOB_FORMAT_STRING; ?>') && (IsValidDate(dto, '<?php echo DOB_FORMAT_STRING; ?>'))) {
    if (!CheckDateRange(document.advanced_search.dfrom, document.advanced_search.dto)) {
      error_message = error_message + "<?php echo JS_TO_DATE_LESS_THAN_FROM_DATE; ?>";
      error_field = document.advanced_search.dto;
      error_found = true;
    }
  }

  if (pfrom.length > 0) {
    pfrom_float = parseFloat(pfrom);
    if (isNaN(pfrom_float)) {
      error_message = error_message + "<?php echo JS_PRICE_FROM_MUST_BE_NUM; ?>";
      error_field = document.advanced_search.pfrom;
      error_found = true;
    }
  } else {
    pfrom_float = 0;
  }

  if (pto.length > 0) {
    pto_float = parseFloat(pto);
    if (isNaN(pto_float)) {
      error_message = error_message + "<?php echo JS_PRICE_TO_MUST_BE_NUM; ?>";
      error_field = document.advanced_search.pto;
      error_found = true;
    }
  } else {
    pto_float = 0;
  }

  if ( (pfrom.length > 0) && (pto.length > 0) ) {
    if ( (!isNaN(pfrom_float)) && (!isNaN(pto_float)) && (pto_float < pfrom_float) ) {
      error_message = error_message + "<?php echo JS_PRICE_TO_LESS_THAN_PRICE_FROM; ?>";
      error_field = document.advanced_search.pto;
      error_found = true;
    }
  }

  if (error_found == true) {
    alert(error_message);
    error_field.focus();
    return false;
  } else {
    RemoveFormatString(document.advanced_search.dfrom, "<?php echo DOB_FORMAT_STRING; ?>");
    RemoveFormatString(document.advanced_search.dto, "<?php echo DOB_FORMAT_STRING; ?>");
    return true;
  }
}

function popupWindow(url) {
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=450,height=280,screenX=150,screenY=150,top=150,left=150')
}
//--></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><?php echo tep_draw_form('advanced_search', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get', 'onSubmit="return check_form(this);"') . tep_hide_session_id(); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_browse.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td>
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => HEADING_SEARCH_CRITERIA);

  new infoBoxHeading($info_box_contents, true, true);

  $info_box_contents = array();
  $info_box_contents[] = array('text' => tep_draw_input_field('keywords', '', 'style="width: 100%"'));
  $info_box_contents[] = array('align' => 'right', 'text' => tep_draw_checkbox_field('search_in_description', '1') . ' ' . TEXT_SEARCH_IN_DESCRIPTION);

  new infoBox($info_box_contents);
?>
            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo '<a href="javascript:popupWindow(\'' . tep_href_link(FILENAME_POPUP_SEARCH_HELP) . '\')">' . TEXT_SEARCH_HELP_LINK . '</a>'; ?></td>
            <td class="smallText" align="right"><?php echo tep_image_submit('button_search.gif', IMAGE_BUTTON_SEARCH); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td>
<?php
  $options_box = '<table border="0" width="100%" cellspacing="0" cellpadding="2">' . "\n" .
                 '  <tr>' . "\n" .
                 '    <td class="fieldKey">' . ENTRY_CATEGORIES . '</td>' . "\n" .
                 '    <td class="fieldValue">' . tep_draw_pull_down_menu('categories_id', tep_get_categories(array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES)))) . '<br></td>' . "\n" .
                 '  </tr>' . "\n" .
                 '  <tr>' . "\n" .
                 '    <td class="fieldKey">&nbsp;</td>' . "\n" .
                 '    <td class="smallText">' . tep_draw_checkbox_field('inc_subcat', '1', true) . ' ' . ENTRY_INCLUDE_SUBCATEGORIES . '</td>' . "\n" .
                 '  </tr>' . "\n" .
                 '  <tr>' . "\n" .
                 '    <td colspan="2">' . tep_draw_separator('pixel_trans.gif', '100%', '10') . '</td>' . "\n" .
                 '  </tr>' . "\n" .
                 '  <tr>' . "\n" .
                 '    <td class="fieldKey">' . ENTRY_MANUFACTURERS . '</td>' . "\n" .
                 '    <td class="fieldValue">' . tep_draw_pull_down_menu('manufacturers_id', tep_get_manufacturers(array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS)))) . '</td>' . "\n" .
                 '  </tr>' . "\n" .
                 '  <tr>' . "\n" .
                 '    <td colspan="2">' . tep_draw_separator('pixel_trans.gif', '100%', '10') . '</td>' . "\n" .
                 '  </tr>' . "\n" .
                 '  <tr>' . "\n" .
                 '    <td class="fieldKey">' . ENTRY_PRICE_FROM . '</td>' . "\n" .
                 '    <td class="fieldValue">' . tep_draw_input_field('pfrom') . '</td>' . "\n" .
                 '  </tr>' . "\n" .
                 '  <tr>' . "\n" .
                 '    <td class="fieldKey">' . ENTRY_PRICE_TO . '</td>' . "\n" .
                 '    <td class="fieldValue">' . tep_draw_input_field('pto') . '</td>' . "\n" .
                 '  </tr>' . "\n" .
                 '  <tr>' . "\n" .
                 '    <td colspan="2">' . tep_draw_separator('pixel_trans.gif', '100%', '10') . '</td>' . "\n" .
                 '  </tr>' . "\n" .
                 '  <tr>' . "\n" .
                 '    <td class="fieldKey">' . ENTRY_DATE_FROM . '</td>' . "\n" .
                 '    <td class="fieldValue">' . tep_draw_input_field('dfrom', DOB_FORMAT_STRING, 'onFocus="RemoveFormatString(this, \'' . DOB_FORMAT_STRING . '\')"') . '</td>' . "\n" .
                 '  </tr>' . "\n" .
                 '  <tr>' . "\n" .
                 '    <td class="fieldKey">' . ENTRY_DATE_TO . '</td>' . "\n" .
                 '    <td class="fieldValue">' . tep_draw_input_field('dto', DOB_FORMAT_STRING, 'onFocus="RemoveFormatString(this, \'' . DOB_FORMAT_STRING . '\')"') . '</td>' . "\n" .
                 '  </tr>' . "\n" .
                 '</table>';

  $info_box_contents = array();
  $info_box_contents[] = array('text' => $options_box);

  new infoBox($info_box_contents);
?>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main">
<?php
  if (isset($HTTP_GET_VARS['errorno'])) {
    if (($HTTP_GET_VARS['errorno'] & 1) == 1) {
      echo str_replace('\n', '<br>', JS_AT_LEAST_ONE_INPUT);
    }
    if (($HTTP_GET_VARS['errorno'] & 10) == 10) {
      echo str_replace('\n', '<br>', JS_INVALID_FROM_DATE);
    }
    if (($HTTP_GET_VARS['errorno'] & 100) == 100) {
      echo str_replace('\n', '<br>', JS_INVALID_TO_DATE);
    }
    if (($HTTP_GET_VARS['errorno'] & 1000) == 1000) {
      echo str_replace('\n', '<br>', JS_TO_DATE_LESS_THAN_FROM_DATE);
    }
    if (($HTTP_GET_VARS['errorno'] & 10000) == 10000) {
      echo str_replace('\n', '<br>', JS_PRICE_FROM_MUST_BE_NUM);
    }
    if (($HTTP_GET_VARS['errorno'] & 100000) == 100000) {
      echo str_replace('\n', '<br>', JS_PRICE_TO_MUST_BE_NUM);
    }
    if (($HTTP_GET_VARS['errorno'] & 1000000) == 1000000) {
      echo str_replace('\n', '<br>', JS_PRICE_TO_LESS_THAN_PRICE_FROM);
    }
    if (($HTTP_GET_VARS['errorno'] & 10000000) == 10000000) {
      echo str_replace('\n', '<br>', JS_INVALID_KEYWORDS);
    }
  }
?>
        </td>
      </tr>
    </table></form></td>
<!-- body_text_eof //-->
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- right_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
    </table></td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
