<?php
/*
  $Id: modules.php,v 1.15 2002/04/03 23:25:41 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- modules //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_MODULES,
                     'link'  => tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('selected_box')) . 'selected_box=modules'));

  if ($selected_box == 'modules') {
    $contents[] = array('text'  => '<a href="' . tep_href_link(FILENAME_MODULES, 'set=payment', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_PAYMENT . '</a><br>' .
                                   '<a href="' . tep_href_link(FILENAME_MODULES, 'set=shipping', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_SHIPPING . '</a><br>' .
                                   '<a href="' . tep_href_link(FILENAME_MODULES, 'set=ordertotal', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_ORDER_TOTAL . '</a>');
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- modules_eof //-->
