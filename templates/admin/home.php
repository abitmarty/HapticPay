<?php
if( !defined( 'ADMIN_PAGE' ) )
  exit( '' );

$oFile = FilesAdmin::getInstance( );
$oPage = PagesAdmin::getInstance( );
$oProduct = ProductsAdmin::getInstance( );
$oOrder = new OrdersAdmin( );

$aSelectMenu['bDashboard'] = true;
require_once DIR_TEMPLATES.'admin/_header.php'; // include headers
require_once DIR_TEMPLATES.'admin/_menu.php'; // include menu
?>
<h1><?php echo $lang['Dashboard']; ?></h1>
<div class="mainPage">
  <table border="1" cellspacing="0" id="mainPage">
    <?php if( !empty( $sNotifications ) ){ ?>
      <tr>
        <td colspan="2">

        </td>
      </tr>
    <?php } ?>
    <tr>
      <td id="eventsLinks">
        <div id="newEventsBox" class="homeBox">
          <h2><?php echo $lang['New_events']; ?></h2>

          <div id="tabs">
            <ul id="tabsNames">
              <!-- tabs start -->
              <li class="tabProducts"><a href="#more" onclick="displayTab( 'tabProducts' )"><?php echo $lang['Products']; ?></a></li>
              <li class="tabPages"><a href="#more" onclick="displayTab( 'tabPages' )"><?php echo $lang['Pages']; ?></a></li>
              <li class="tabFiles"><a href="#more" onclick="displayTab( 'tabFiles' )"><?php echo $lang['Files']; ?></a></li>
              <li class="tabOrders"><a href="#more" onclick="displayTab( 'tabOrders' )"><?php echo $lang['Orders']; ?></a></li>
              <!-- tabs end -->
            </ul>
            <div id="tabsForms">
              <!-- tabs list start -->
              <div class="tab" id="tabProducts">
                <?php echo $oProduct->listLastProducts( ); ?>
              </div>
              <div class="tab" id="tabPages">
                <?php echo $oPage->listLastPages( ); ?>
              </div>
              <div class="tab" id="tabFiles">
                <?php echo $oFile->listLastFiles( ); ?>
              </div>
              <div class="tab" id="tabOrders">
                <?php echo $oOrder->listLastOrders( ); ?>
              </div>
            </div>
          </div>
          <script type="text/javascript">
          AddOnload( getTabsArray );
          AddOnload( checkSelectedTab );
          <?php echo javascriptLanguages( ); ?>
          firstNotice( );

          </script>
        </div>


      
      </td>
      <td id="news">

      </td>
    </tr>
  </table>
</div>
<?php
require_once DIR_TEMPLATES.'admin/_footer.php'; // include footer
?>