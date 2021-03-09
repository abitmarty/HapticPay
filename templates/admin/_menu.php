<?php
if( !defined( 'ADMIN_PAGE' ) )
  exit;
?>

<body>
  <div id="container" >
    <div id="header" >
      <div id="menuTop">
        <form action="" method="get" id="searchPanel">
          <fieldset>
            <input type="hidden" name="p" value="search" />

            <select name="iTypeSearch"><?php echo throwSelectFromArray( Array( 1 => $lang['Pages'], 2 => $lang['Products'], 3 => $lang['Orders'] ), $iTypeSearch ); ?></select>
            <input type="submit" value="<?php echo $lang['search']; ?> &raquo;" />
          </fieldset>
        </form>
        <ul id="extend" class="main-menu submenu">
          <li class="settings"><a href="#"><img src="templates/admin/img/settings.png" border=1 alt="<?php echo $lang['Settings']; ?>" /></a>
            <ul>
              <li><a href="?p=tools-config"><?php echo $lang['Settings']; ?></a></li>

              <li><a href="?p=logout"><?php echo $lang['log_out']; ?></a></li>
            </ul>
          </li>
        </ul>
      </div>

      <div id="logos" class="submenu">
        <img  src="<?php echo $config['dir_templates']; ?>admin/img/shopsec.jpg" width="105" style="border:1px solid black; position: relative; left: 42%; padding: 3px 3px 3px 3px; margin: 7px 7px 7px 7px;" heigth="74" /></a>

      </div>
      <div class="clear"></div>

      <!-- menu under_logo start -->
      <div id="menuBar">
        <ul class="main-menu">
          <li<?php echo ( isset( $aSelectMenu['bDashboard'] ) ? ' class="selected"' : null ); ?>><a href="?p="><span class="dashboard"><?php echo $lang['Dashboard']; ?></span></a></li>
          <li onmouseover="return buttonClick( event, 'pages' ); buttonMouseover( event, 'pages' );"<?php echo ( isset( $aSelectMenu['bPages'] ) ? ' class="selected"' : null ); ?>><a href="?p=pages-list"><span class="pages"><?php echo $lang['Pages']; ?></span></a></li>
          <li onmouseover="return buttonClick( event, 'products' ); buttonMouseover( event, 'products' );"<?php echo ( isset( $aSelectMenu['bProducts'] ) ? ' class="selected"' : null ); ?>><a href="?p=products-list"><span class="products"><?php echo $lang['Products']; ?></span></a></li>
          <li onmouseover="return buttonClick( event, 'orders' ); buttonMouseover( event, 'orders' );"<?php echo ( isset( $aSelectMenu['bOrders'] ) ? ' class="selected"' : null ); ?>><a href="?p=orders-list"><span class="orders"><?php echo $lang['Orders']; ?></span></a></li>
          <!-- main menu -->

        </ul>
        
      </div>

      <!-- submenu under_logo start -->
      <div id="pages" class="menu" onmouseover="menuMouseover( event );">
        <a href="?p=pages-form"><?php echo $lang['New_page']; ?></a>
        <!-- menu pages -->
      </div>

      <div id="products" class="menu" onmouseover="menuMouseover( event );">
        <a href="?p=products-form"><?php echo $lang['New_product']; ?></a>
        <!-- menu products -->
      </div>
      <div id="orders" class="menu" onmouseover="menuMouseover( event );">
        <a href="?p=orders-list&amp;iStatus=1"><?php echo $lang['Orders_pending']; ?></a>
        <span class="sep"></span>
        <a href="?p=shipping-list"><?php echo $lang['Shipping']; ?></a>
        <a href="?p=shipping-form"><?php echo $lang['New_shipping']; ?></a>
        <span class="sep"></span>
        <a href="?p=payments-list"><?php echo $lang['Payment_methods']; ?></a>
        <a href="?p=payments-form"><?php echo $lang['New_payment_method']; ?></a>
        <!-- menu orders -->
      </div>
      <!-- menu under_logo end -->

    </div>
    <div class="clear"></div>
    <div id="body">