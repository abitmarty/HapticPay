<?php
if( !defined( 'ADMIN_PAGE' ) )
  exit( '' );

$oPage = PagesAdmin::getInstance( );

if( isset( $_POST['sOption'] ) ){
  if( isset( $_POST['skin'] ) && $config['skin'] != $_POST['skin'] && $_POST['skin'] != 'default' ){
    copyDirToDir( DIR_TEMPLATES.'default/', DIR_TEMPLATES.$_POST['skin'].'/' );
  }
  saveVariables( $_POST, DB_CONFIG );
  saveVariables( $_POST, DB_CONFIG_LANG );
  header( 'Location: '.$_SERVER['PHP_SELF'].'?p='.$p.'&sOption=save' );
  exit;
}

$aSelectMenu['bTools'] = true;
require_once DIR_TEMPLATES.'admin/_header.php'; // include headers
require_once DIR_TEMPLATES.'admin/_menu.php'; // include menu

if( isset( $sOption ) ){
  if( $sOption == 'login-pass' )
    echo '<div id="msg">'.$lang['Change_login_and_pass_to_use_script'].'</div>';
  else
    echo '<div id="msg">'.$lang['Operation_completed'].'</div><script type="text/javascript">var bDone = true;</script>';
}
?>
<h1><?php echo $lang['Settings']; ?></h1>
<form action="?p=<?php echo $p; ?>" method="post" id="mainForm" name="form" onsubmit="return checkForm( this );">
  <fieldset id="type2">
    <table cellspacing="1" class="mainTable" id="config">
      <thead>
        <tr class="save">
          <th colspan="3">
            <input type="submit" value="<?php echo $lang['save']; ?> &raquo;" name="sOption" />
          </th>
        </tr>
      </thead>
      <tfoot>
        <tr class="save">
          <th colspan="3">
            <input type="submit" value="<?php echo $lang['save']; ?> &raquo;" name="sOption" />
          </th>
        </tr>
      </tfoot>
      <tbody>
        <!-- title start -->
        <tr class="l0">
          <th>
            <?php echo $lang['Page_title']; ?>
          </th>
          <td>
            <input type="text" name="title" value="<?php echo $config['title']; ?>" size="70" maxlength="60" class="input" accesskey="1" />
          </td>
          <td rowspan="15" class="tabs">
            <div id="tabs">
              <ul id="tabsNames">
                <!-- tabs start -->

                <?php if( $config['display_advanced_options'] === true ){ ?>
                <li class="tabPages"><a href="#more" onclick="displayTab( 'tabPages' )"><?php echo $lang['Pages']; ?></a></li><?php } ?>
                <li class="tabItems"><a href="#more" onclick="displayTab( 'tabItems' )"><?php echo $lang['Items']; ?></a></li>
                <li class="tabAdvanced"><a href="#more" onclick="displayTab( 'tabAdvanced' )"><?php echo $lang['Advanced']; ?></a></li>
                <!-- tabs end -->
              </ul>
              <div id="tabsForms">
                <!-- tabs list start -->


                <table class="tab" id="tabPages">
                  <tr>
                    <td><?php echo $lang['Start_page']; ?></td>
                    <td>
                      <select name="start_page">
                        <?php echo $oPage->throwPagesSelectAdmin( $config['start_page'] ); ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><?php echo $lang['Basket_page']; ?></td>
                    <td>
                      <select name="basket_page">
                        <option value=""><?php echo $lang['none']; ?></option>
                        <?php echo $oPage->throwPagesSelectAdmin( $config['basket_page'] ); ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><?php echo $lang['Order_page']; ?></td>
                    <td>
                      <select name="order_page">
                        <option value=""><?php echo $lang['none']; ?></option>
                        <?php echo $oPage->throwPagesSelectAdmin( $config['order_page'] ); ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><?php echo $lang['Order_print']; ?></td>
                    <td>
                      <select name="order_print">
                        <option value=""><?php echo $lang['none']; ?></option>
                        <?php echo $oPage->throwPagesSelectAdmin( $config['order_print'] ); ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><?php echo $lang['Rules_page']; ?></td>
                    <td>
                      <select name="rules_page">
                        <option value=""><?php echo $lang['none']; ?></option>
                        <?php echo $oPage->throwPagesSelectAdmin( $config['rules_page'] ); ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><?php echo $lang['Page_search']; ?></td>
                    <td>
                      <select name="page_search">
                        <option value=""><?php echo $lang['none']; ?></option>
                        <?php echo $oPage->throwPagesSelectAdmin( $config['page_search'] ); ?>
                      </select>
                    </td>
                  </tr>
                  <!-- tab pages -->
                </table>

                <table class="tab" id="tabItems">
                  <tr>
                    <td><?php echo $lang['Admin_items_on_page']; ?></td>
                    <td>
                      <input type="text" name="admin_list" value="<?php echo $config['admin_list']; ?>" size="3" maxlength="3" alt="int;0" class="input" />
                    </td>
                  </tr>
                  <?php if( $config['display_advanced_options'] === true ){ ?>
                    <tr>
                      <td><?php echo $lang['Products_on_page']; ?></td>
                      <td>
                        <input type="text" name="products_list" value="<?php echo $config['products_list']; ?>" size="3" maxlength="3" alt="int;0" class="input" />
                      </td>
                    </tr>
                  <?php } ?>
                  <!-- tab lists -->
                </table>

                <table class="tab" id="tabAdvanced">
                  <tr>
                    <td><?php echo $lang['Change_files_names']; ?></td>
                    <td>
                      <select name="change_files_names">
                        <?php echo throwTrueFalseOrNullSelect( $config['change_files_names'] ); ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><?php echo $lang['Delete_unused_files']; ?></td>
                    <td>
                      <select name="delete_unused_files">
                        <?php echo throwTrueFalseOrNullSelect( $config['delete_unused_files'] ); ?>
                      </select>
                    </td>
                  </tr>
                         <tr>
                    <td><?php echo $lang['Send_customer_order_details']; ?></td>
                    <td>
                      <select name="send_customer_order_details">
                        <?php echo throwTrueFalseOrNullSelect( $config['send_customer_order_details'] ); ?>
                      </select>
                    </td>
                  </tr>
                  <?php if( $config['display_advanced_options'] === true ){ ?>
                    <tr>
                      <td><?php echo $lang['Display_subcategory_products']; ?></td>
                      <td>
                        <select name="display_subcategory_products">
                          <?php echo throwTrueFalseOrNullSelect( $config['display_subcategory_products'] ); ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td><?php echo $lang['Display_remember_basket']; ?></td>
                      <td>
                        <select name="remember_basket">
                          <?php echo throwTrueFalseOrNullSelect( $config['remember_basket'] ); ?>
                        </select>
                      </td>
                    </tr>
                  <?php } ?>
                  <!-- tab advanced -->
                </table>
                
                <!-- tabs list end -->
              </div>
            </div>

            <script type="text/javascript">
            AddOnload( getTabsArray );
            AddOnload( checkSelectedTab );
            </script>          
          </td>
        </tr>
        <!-- title end -->
        <!-- description start -->
        <tr class="l1">
          <th>
            <?php echo $lang['Description']; ?>
          </th>
          <td>
            <input type="text" name="description" value="<?php echo $config['description']; ?>" size="70" maxlength="200" class="input" />
          </td>
        </tr>
        <!-- description end -->
        <!-- logo start -->
        <tr class="l0">
          <th>
            <?php echo $lang['Logo']; ?>
          </th>
          <td>
            <input type="text" name="logo" value="<?php echo $config['logo']; ?>" size="70" maxlength="200" class="input" />
          </td>
        </tr>
        <!-- logo end -->
        <!-- slogan start -->
        <tr class="l1">
          <th>
            <?php echo $lang['Slogan']; ?>
          </th>
          <td>
            <input type="text" name="slogan" value="<?php echo $config['slogan']; ?>" size="70" maxlength="200" class="input" />
          </td>
        </tr>
        <!-- slogan end -->
        <!-- foot info start -->
        <tr class="l0">
          <th>
            <?php echo $lang['Foot_info']; ?>
          </th>
          <td>
            <input type="text" name="foot_info" value="<?php echo $config['foot_info']; ?>" size="70" maxlength="200" class="input" />
          </td>
        </tr>
        <!-- foot info end -->
        <!-- login start -->
        <tr class="l1" id="login">
          <th>
            <?php echo $lang['Login']; ?>
          </th>
          <td>
            <input type="text" name="login" value="<?php echo $config['login']; ?>" size="40" class="input" alt="simple" id="oLogin" style="display:none" /> <a href="#" onclick="gEBI('oLogin').style.display='inline';this.style.display='none';return false;"><?php echo $lang['edit']; ?></a>
          </td>
        </tr>
        <!-- login end -->
        <!-- pass start -->
        <tr class="l0" id="pass">
          <th>
            <?php echo $lang['Password']; ?>
          </th>
          <td>
            <input type="text" name="pass" value="<?php echo $config['pass']; ?>" size="40" class="input" alt="simple" id="oPass" style="display:none" /> <a href="#" onclick="gEBI('oPass').style.display='inline';this.style.display='none';return false;"><?php echo $lang['edit']; ?></a>
          </td>
        </tr>
        <!-- pass end -->
        <!-- orders_email start -->
        <tr class="l1" id="orders_email">
          <th>
            <?php echo $lang['Mail_informing']; ?>
          </th>
          <td>
            <input type="text" name="orders_email" value="<?php echo $config['orders_email']; ?>" size="40" class="input" />
          </td>
        </tr>
        <!-- orders_email end -->
        <tr class="end">
          <td colspan="2">&nbsp;</td>
        </tr>
      </tbody>
    </table>
  </fieldset>
</form>
<?php
require_once DIR_TEMPLATES.'admin/_footer.php'; // include footer
?>