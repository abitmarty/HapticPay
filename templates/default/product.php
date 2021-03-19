<?php
if( !defined( 'CUSTOMER_PAGE' ) )
  exit;

require_once DIR_SKIN.'_header.php'; // include design of header
?>

<div id="product" class="pure-u-1">
<?php
if( isset( $aData['sName'] ) ){ // displaying product content ?>
  <script type="text/javascript">
    var sTitle = "<?php echo $aData['sName']; ?>";
    var fPrice = Math.abs( "<?php echo $aData['mPrice']; ?>" );
  </script><?php

  if( isset( $aData['sPages'] ) )
    echo '<div class="breadcrumb">'.$aData['sPages'].'</div>'; // displaying pages tree (breadcrumb)

  echo '<div class="display-mobile">';
  echo '<h1>'.$aData['sName'].'</h1>'; // displaying product name

  echo '<div id="product-page-stars" class="pure-u-1><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>';
  echo '</div>';

  echo '<div class="pure-u-md-1-2">';
  if( isset( $config['image_preview_size'] ) && is_numeric( $config['image_preview_size'] ) )
    echo $oFile->listPreviewImages( $aData['iProduct'], 1 ); // displaying images with type: left
  else
    echo $oFile->listImagesByTypes( $aData['iProduct'], 1 ); // displaying images with type: left
  echo '</div>';

  echo '<div class="pure-u-md-1-2">';
  echo '<div class="display-desktop pure-u-1">';
  echo '<h1>'.$aData['sName'].'</h1>'; // displaying product name

  echo '<div id="product-page-stars" class="pure-u-1><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>';
  echo '</div>';
  if( isset( $aData['sDescriptionShort'] ) )
    echo '<div class="content" id="productDescriptionShort">'.$aData['sDescriptionShort'].'</div>'; // short description

  if( isset( $aData['mPrice'] ) || isset( $aData['sAvailable'] ) ){ // displaying box with price, basket and availability - START
    echo '<div id="box" class="pure-u-1">';
      if( isset( $aData['mPrice'] ) && is_numeric( $aData['mPrice'] ) ){?>
        <div id="price"><em><?php echo $lang['Price']; ?>:</em><strong id="priceValue"><?php echo $aData['sPrice']; ?></strong><div id="product-page-tomorrow"><i class="fas fa-check-circle"></i><p>Morgen in huis</p></div><span><?php echo $config['currency_symbol']; ?></span></div><?php
      }
      elseif( !empty( $aData['mPrice'] ) ){?>
        <div id="noPrice"><?php echo $aData['sPrice']; ?></div><?php
      }
      if( isset( $aData['sAvailable'] ) ){?>
        <div id="available"><?php echo $aData['sAvailable']; ?></div><?php
      }
      if( isset( $aData['mPrice'] ) && is_numeric( $aData['mPrice'] ) && !empty( $config['basket_page'] ) && isset( $oPage->aPages[$config['basket_page']] ) ){?>
        <form action="<?php echo $oPage->aPages[$config['basket_page']]['sLinkName']; ?>" method="post" id="addBasket" class="form">
          <fieldset>
            <legend><?php echo $lang['Basket_add']; ?></legend>
            <input type="hidden" name="iProductAdd" value="<?php echo $aData['iProduct']; ?>" />
            <input id="category-price-<?php echo $aData['iProduct']; ?>" type="hidden" name="iProductPrice" value="<?php echo $aData['mPrice']; ?>" />
            <input id="<?php echo $aData['iProduct']; ?>" class="pure-u-1-4 quantity" type="number" min="1" max="100" name="iQuantity" value="1" />
            <button class="pure-u-3-4 submit" type="submit" value="<?php echo $lang['Basket_add']; ?>">Voeg toe</button>
          </fieldset>
        </form><?php
      }
    echo '</div>';
  } // displaying box with price, basket and availability - END

  echo $oFile->listImagesByTypes( $aData['iProduct'], 2 ); // displaying images with type: right

  echo '<ul id="usp-product" class="pure-u-1">';
    echo '<li>Voor <strong>23:59</strong> besteld. <strong>Morgen</strong> in huis</li>';
    echo '<li><a target="blank" href="https://nl.trustpilot.com/review/hapily.de">Klanten geven Hapi ticc een <strong>9.5</strong></a></li>';
    echo '<li><strong>Altijd tevreden</strong> garantie</li>';
    echo '<li>Verpakt onder <strong>beschermde atmosfeer</strong></li>';
  echo '</ul>';
  echo '</div>';

  //echo '<div id="product-attributes" class="pure-u-1">';
  //  echo '<div class="pure-u-1 attribute"><p class="specification pure-u-1-2">Hoogte:</p><i class="fas fa-expand-alt pure-u-1-12"></i><p class="detail pure-u-5-12">+/- 100cm</p></div>';
  //  echo '<div class="pure-u-1 attribute"><p class="specification pure-u-1-2">Pot:</p><i class="fas fa-coffee pure-u-1-12"></i><p class="detail pure-u-5-12">23cm</p></div>';
  //  echo '<div class="pure-u-1 attribute"><p class="specification pure-u-1-2">Klimaat:</p><i class="fas fa-tint pure-u-1-12"></i><p class="detail pure-u-5-12">Vochtig</p></div>';
  //  echo '<div class="pure-u-1 attribute"><p class="specification pure-u-1-2">Voeding:</p><i class="fas fa-clock pure-u-1-12"></i><p class="detail pure-u-5-12">Dagelijks</p></div>';
  //echo '</div>';

  if( isset( $aData['sDescriptionFull'] ) )
    echo '<div class="content" id="productDescription">'.$aData['sDescriptionFull'].'</div>'; // full description

  echo $oFile->listFiles( $aData['iProduct'] ); // display files included to the product

}
else{
  echo '<div class="message" id="error"><h2>'.$lang['Data_not_found'].'</h2></div>'; // displaying 404 error
}
?>
</div>
<?php
require_once DIR_SKIN.'_footer.php'; // include design of footer
?>
