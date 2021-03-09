<?php
if( !defined( 'CUSTOMER_PAGE' ) )
  exit;

$config['this_is_basket_page'] = true;

if( isset( $aData['sName'] ) && !empty( $config['basket_page'] ) && $config['basket_page'] == $iContent ){ // basket actions
  // basket
  if( isset( $_POST['aProducts'] ) ){
    if( !isset( $aUrls ) )
      $aUrls = throwSiteUrls( );
    // save basket
    $oOrder->saveBasket( $_POST['aProducts'] );
    if( isset( $_POST['sRemember'] ) ){
      setCookie( 'sCustomer'.LANGUAGE, md5( $_SESSION['iCustomer'.LANGUAGE] ), time( ) + 259200 );
      $sMessage = '<div class="message" id="ok"><h2>'.$lang['Operation_completed'].'</h2></div>';
    }
    if( isset( $_POST['sContinueShopping'] ) ){
      $oOrder->generateBasket( );
      $iOrderProducts = isset( $_SESSION['iOrderQuantity'.LANGUAGE] ) ? $_SESSION['iOrderQuantity'.LANGUAGE] : 0;
      header( 'Location: '.( isset( $_SESSION['sLastProductsPageUrl'] ) ? $_SESSION['sLastProductsPageUrl'] : $aUrls['sHomeUrl'] ) );
      exit;
    }

    if( isset( $_POST['sCheckout'] ) && !empty( $config['order_page'] ) && isset( $oPage->aPages[$config['order_page']] ) ){
      header( 'Location: '.dirname( $aUrls['sUrl'] ).'/'.$oPage->aPages[$config['order_page']]['sLinkName'] );
      exit;
    }
  }

  if( isset( $iProductDelete ) && is_numeric( $iProductDelete ) ){
    // delete product from basket
    $oOrder->deleteFromBasket( $iProductDelete );
  }

  if( isset( $_POST['iProductAdd'] ) && isset( $_POST['iQuantity'] ) ){
    $iProductAdd = $_POST['iProductAdd'];
    $iQuantity = $_POST['iQuantity'];
  }
  if( isset( $iProductAdd ) && is_numeric( $iProductAdd ) && isset( $iQuantity ) && is_numeric( $iQuantity ) ){
    if( !isset( $oProduct ) )
      $oProduct = Products::getInstance( );

    if( isset( $oProduct->aProducts[$iProductAdd] ) && is_numeric( $oProduct->aProducts[$iProductAdd]['mPrice'] ) ){
      if( !isset( $aUrls ) )
        $aUrls = throwSiteUrls( );
      // add product to basket
      $oOrder->saveBasket( Array( $iProductAdd => $iQuantity ), true );
      header( 'Location: '.dirname( $aUrls['sUrl'] ).'/'.$aData['sLinkName'] );
      exit;
    }
  }

  $oOrder->generateBasket( );
  $iOrderProducts = isset( $_SESSION['iOrderQuantity'.LANGUAGE] ) ? $_SESSION['iOrderQuantity'.LANGUAGE] : 0;
}

require_once DIR_SKIN.'_header.php'; // include design of header
?>
<div id="page">
<?php
if( isset( $aData['sName'] ) ){ // displaying pages and subpages content
  echo '<h1>'.$aData['sName'].'</h1>'; // displaying page name

  if( isset( $aData['sDescriptionShort'] ) )
    echo '<div class="content">'.changeTxt( $aData['sDescriptionShort'], 'nlNds' ).'</div>'; // short description

  // display products in basket
  $sBasketList = $oOrder->listProducts( );
  if( !empty( $sBasketList ) ){
    if( isset( $sMessage ) )
      echo $sMessage;
    ?>
    <script type="text/javascript" src="<?php echo $config['dir_core']; ?>check-form.js"></script>
    <div class="pure-u-1" id="basket">
      <form method="post" action="" onsubmit="return checkForm( this )">
        <div class="pure-u-1 boxed" id="orderedProducts">
          <legend><?php echo $aData['sName']; ?></legend>
          <table class="flexcol" cellspacing="0">
            <thead class="flexrow">
              <tr class="pure-u-1">
                <td class="pure-u-8-24 boxed name">
                  <?php echo $lang['Name']; ?>
                </td><!--
                --><td class="pure-u-4-24 boxed price">
                  <em><?php echo $lang['Price']; ?></em><span>[<?php echo $config['currency_symbol']; ?>]</span>
                </td><!--
                --><td class="pure-u-4-24 boxed quantity">
                  <?php echo $lang['Quantity']; ?>
                </td><!--
                --><td class="pure-u-4-24 boxed summary">
                  <em><?php echo $lang['Summary']; ?></em><span>[<?php echo $config['currency_symbol']; ?>]</span>
                </td><!--
                --><td class="pure-u-4-24 boxed options">&nbsp;</td>
              </tr>
            </thead >

            <tbody class="flexcol ctbody pure-u-1">
              <?php echo $sBasketList; // displaying products in basket ?>
            </tbody>

            <tfoot class="pure-u-1 flexrow boxed mob_checkout">

              <tr id="recount" class="pure-u-1 pure-md-2-4 flexed boxed">
                <td class="pure-u-1-3 boxed">
                  <input type="submit" value="<?php echo ucfirst( $lang['save'] ); ?>" class="submit" />
                </td>
                <td id="continue" class="pure-u-2-3 boxed">
                  <input type="submit" name="sContinueShopping" value="<?php echo $lang['Continue_shopping']; ?>" class="submit" />
                </td>
              </tr>
            </tfoot>
            <tfoot class="pure-u-1 flexrow boxed mob_checkout">
              <tr class="pure-u-1-2 pure-md-1-4 boxed flexed summaryProducts">
                <th colspan="3" class="pure-u-1-2 boxed">
                  <?php echo $lang['Summary']; ?>
                </th>
                <td id="summary" class="pure-u-1-2 boxed">
                  <?php echo displayPrice( $_SESSION['fOrderSummary'.LANGUAGE] ); ?>
                </td>
                <td>&nbsp;</td>
              </tr>
              <tr class="pure-u-1-2 pure-md-1-4 boxed buttons">
                <td colspan="4" class="nextStep">
                  <input type="submit" name="sCheckout" value="<?php echo $lang['Checkout']; ?> &raquo;" class="submit" />
                </td>
              </tr>
            </tfoot>

            <!-- FOR DESKTOP -->
            <tfoot class="pure-u-1 flexrow boxed desk_checkout">

              <tr id="recount" class="pure-u-1-2 pure-md-2-4 flexed boxed">
                <td class="pure-u-1-3 boxed">
                  <input type="submit" value="<?php echo ucfirst( $lang['save'] ); ?>" class="submit" />
                </td>
                <td id="continue" class="pure-u-2-3 boxed">
                  <input type="submit" name="sContinueShopping" value="<?php echo $lang['Continue_shopping']; ?>" class="submit" />
                </td>
              </tr>
              <tr class="pure-u-1-2 pure-md-1-2 boxed flexed summaryProducts">
                <th colspan="3" class="pure-u-1-2 boxed">
                  <?php echo $lang['Summary']; ?>
                </th>
                <td id="summary" class="pure-u-1-2 boxed">
                  <?php echo displayPrice( $_SESSION['fOrderSummary'.LANGUAGE] ); ?>
                </td>
                <td>&nbsp;</td>
              </tr>
              <tr class="pure-u-1-2 pure-md-1-4 boxed buttons">
                <td colspan="4" class="nextStep">
                  <input type="submit" name="sCheckout" value="<?php echo $lang['Checkout']; ?> &raquo;" class="submit" />
                </td>
              </tr>
            </tfoot>

          </table>
          <?php if( isset( $config['remember_basket'] ) && $config['remember_basket'] === true ) { ?><div id="save"><input type="submit" name="sRemember" value="<?php echo $lang['Remember_basket']; ?>" class="submit" /></div><?php } ?>
        </div>
      </form>
      <?php
      if( isset( $aData['sDescriptionFull'] ) )
        echo '<div class="content" id="pageDescription">'.$aData['sDescriptionFull'].'</div>'; // full description

      if( isset( $aData['sPages'] ) )
        echo '<div class="pages">'.$lang['Pages'].': <ul>'.$aData['sPages'].'</ul></div>'; // full description pagination
      ?>
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
