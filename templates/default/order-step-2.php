<?php

if( !defined( 'CUSTOMER_PAGE' ) )
  exit;

$config['this_is_order_page'] = true;

if( isset( $aData['sName'] ) && !empty( $config['order_page'] ) && $config['order_page'] == $iContent ){
  $oOrder->generateBasket( );
  $iOrderProducts = isset( $_SESSION['iOrderQuantity'.LANGUAGE] ) ? $_SESSION['iOrderQuantity'.LANGUAGE] : 0;
}

require_once DIR_SKIN.'_header.php'; // include design of header
?>
<div id="page">
<?php
if( isset( $aData['sName'] ) ){ // displaying pages and subpages content
  echo '<h1>'.$aData['sName'].'</h1>'; // displaying page name

  if( isset( $aData['sDescriptionFull'] ) )
    echo '<div class="content" id="pageDescription">'.$aData['sDescriptionFull'].'</div>'; // full description

  if( isset( $aData['sPages'] ) )
    echo '<div class="pages">'.$lang['Pages'].': <ul>'.$aData['sPages'].'</ul></div>'; // full description pagination

  // display order form
  $sOrderProducts = $oOrder->listProducts( true );
  $sShippingPaymentSelect = $oOrder->throwShippingPaymentsSelect( );
  if( !empty( $sOrderProducts ) && !empty( $config['order_page'] ) && $config['order_page'] == $iContent && !empty( $config['order_print'] ) && isset( $oPage->aPages[$config['order_print']] ) ){
    ?>
    <script type="text/javascript" src="<?php echo $config['dir_core']; ?>check-form.js"></script>
    <div id="order">
      <form action="<?php echo $oPage->aPages[$config['order_print']]['sLinkName']; ?>" method="post" onsubmit="return checkForm( this )" id="orderForm" class="form">
        <fieldset id="personalDataBlock" class="betaalform1 pure-u-1 boxed">
          <legend id="legendtitle"><?php echo $lang['Your_personal_data']; ?></legend>
          <div id="personalData" class="pure-u-1 boxed">
            <div id="setBasic" class="pure-u-1 pure-md-1-2 boxed">
              <div id="firstName">
                <label for="oFirstName"><?php echo $lang['First_name']; ?><span>(<?php echo $lang['required']; ?>)</span></label>
                <input type="text" name="sFirstName" value="Voornaam" maxlength="30" class="input" onblur="saveUserData( this.name, this.value )" id="oFirstName" alt="simple" readonly/>
              </div>
              <div id="lastName">
                <label for="oLastName"><?php echo $lang['Last_name']; ?><span>(<?php echo $lang['required']; ?>)</span></label>
                <input type="text" name="sLastName" value="Achternaam" maxlength="40" class="input" onblur="saveUserData( this.name, this.value )" id="oLastName" alt="simple" readonly/>
              </div>
              <div id="company">
                <label for="oCompany"><?php echo $lang['Company']; ?></label>
                <input type="text" name="sCompanyName" value="AHaPa" maxlength="100" class="input" onblur="saveUserData( this.name, this.value )" id="oCompany" readonly/>
              </div>
              <div id="street">
                <label for="oStreet"><?php echo $lang['Street']; ?><span>(<?php echo $lang['required']; ?>)</span></label>
                <input type="text" name="sStreet" value="Straat" maxlength="40" class="input" onblur="saveUserData( this.name, this.value )" id="oStreet" alt="simple" readonly/>
              </div>
              <div id="zipCode">
                <label for="oZipCode"><?php echo $lang['Zip_code']; ?><span>(<?php echo $lang['required']; ?>)</span></label>
                <input type="text" name="sZipCode" value="1234AB" maxlength="20" class="input" onblur="saveUserData( this.name, this.value )" id="oZipCode" alt="simple" readonly/>
              </div>
              <div id="city">
                <label for="oCity"><?php echo $lang['City']; ?><span>(<?php echo $lang['required']; ?>)</span></label>
                <input type="text" name="sCity" value="Stad" maxlength="40" class="input" onblur="saveUserData( this.name, this.value )" id="oCity" alt="simple" readonly/>
              </div>
            </div>
            <div id="setExtend" class="pure-u-1 pure-md-1-2">
              <div id="phone">
                <label for="oPhone"><?php echo $lang['Telephone']; ?><span>(<?php echo $lang['required']; ?>)</span></label>
                <input type="text" name="sPhone" value="06-123456" maxlength="40" class="input" onblur="saveUserData( this.name, this.value )" id="oPhone" alt="simple" readonly/>
              </div>
              <div id="email">
                <label for="oEmail"><?php echo $lang['Email']; ?><span>(<?php echo $lang['required']; ?>)</span></label>
                <input type="text" name="sEmail" value="AHaPa@info.nl" maxlength="40" class="input" onblur="saveUserData( this.name, this.value )" id="oEmail" alt="email" readonly/>
              </div>
              <div id="comment">
                <label for="oComment"><?php echo $lang['Comment']; ?></label>
                <textarea name="sComment" cols="50" rows="9" maxlength="<?php echo $config['max_textarea_chars']; ?>" id="oComment"></textarea>
              </div>
            </div>
          </div>
        </fieldset>
        <?php if( isset( $sShippingPaymentSelect ) ){ ?>
          <fieldset id="shippingAndPayments" class="pure-u-1 boxed">
            <legend><label for="oShippingPayment"><?php echo $lang['Shipping_and_payment']; ?></label></legend>
            <div class="pure-u-1 boxed">
              <select class="pure-u-1 boxed" name="sShippingPayment" title="simple;<?php echo $lang['Select_shipping_and_payment']; ?>" onchange="countShippingPrice( this )" id="oShippingPayment">
                <option value=""><?php echo $lang['Select']; ?></option>
                <?php echo $sShippingPaymentSelect; ?>
              </select>
            </div>
          </fieldset>
        <?php } ?>
        <fieldset id="orderedProducts">
          <legend><?php echo $lang['Products']; ?></legend>
          <script type="text/javascript">
          var fOrderSummary = "<?php echo $oOrder->fProductsSummary; ?>";
          AddOnload( checkSavedUserData );
          </script>
          <div>
            <table cellspacing="0">
              <thead>
                <tr>
                  <td class="name">
                    <?php echo $lang['Name']; ?>
                  </td>
                  <td class="price">
                    <em><?php echo $lang['Price']; ?></em><span>[<?php echo $config['currency_symbol']; ?>]</span>
                  </td>
                  <td class="quantity">
                    <?php echo $lang['Quantity']; ?>
                  </td>
                  <td class="summary">
                    <em><?php echo $lang['Summary']; ?></em><span>[<?php echo $config['currency_symbol']; ?>]</span>
                  </td>
                </tr>
              </thead>
              <tfoot>
                <?php if( isset( $sShippingPaymentSelect ) ){ ?>
                  <tr class="summaryProducts">
                    <th colspan="3">
                      <?php echo $lang['Summary']; ?>
                    </th>
                    <td>
                      <?php echo displayPrice( $_SESSION['fOrderSummary'.LANGUAGE] ); ?>
                    </td>
                  </tr>
                  <tr class="summaryShippingPayment">
                    <th colspan="3">
                      <?php echo $lang['Shipping_and_payment']; ?>
                    </th>
                    <td id="shippingPaymentCost">
                      0.00
                    </td>
                  </tr>
                <?php } ?>
                <tr class="summaryOrder">
                  <th colspan="3">
                    <?php echo $lang['Summary_cost']; ?>
                  </th>
                  <td id="orderSummary">
                    <?php echo displayPrice( $_SESSION['fOrderSummary'.LANGUAGE] ); ?>
                  </td>
                </tr>
                <tr id="rulesAccept">
                  <th colspan="4"><?php
                    if( !empty( $config['rules_page'] ) && isset( $oPage->aPages[$config['rules_page']] ) ){ ?>
                    <input type="hidden" name="iRules" value="1" />
                    <em><input type="checkbox" name="iRulesAccept" id="iRulesAccept" value="1" alt="box;<?php echo $lang['Require_rules_accept']; ?>" /></em>
                    <span><label for="iRulesAccept"><?php echo $lang['Rules_accept']; ?></label> (<a href="<?php echo $oPage->aPages[$config['rules_page']]['sLinkName']; ?>" onclick="window.open( this.href );return false;"><?php echo $lang['rules_read']; ?> &raquo;</a>).</span>
                  <?php } ?>
                  </th>
                </tr>
                <tr id="nextStep">
                  <td colspan="4" class="nextStep">
                    <input type="submit" value="<?php echo $lang['Send_order']; ?> &raquo;" name="sOrderSend" class="submit" />
                  </td>
                </tr>
              </tfoot>
              <tbody>
                <?php echo $sOrderProducts; // displaying products in basket ?>
              </tbody>
            </table>
          </div>
        </fieldset>
      </form>
    </div>
    <?php
  }
  else{
    echo '<div class="message" id="error"><h2>'.$lang['Basket_empty'].'</h2></div>';
  }
}
else{
  echo '<div class="message" id="error"><h2>'.$lang['Data_not_found'].'</h2></div>'; // displaying 404 error
}
?>
</div>
<?php
require_once DIR_SKIN.'_footer.php'; // include design of footer
?>
