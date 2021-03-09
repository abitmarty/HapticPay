<?php
if( !defined( 'ADMIN_PAGE' ) )
  exit;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $config['admin_lang']; ?>" lang="<?php echo $config['admin_lang']; ?>">
<head>
  <title><?php echo $lang['Admin'].' - '.$config['title']; ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $config['charset']; ?>" />
  <meta name="Robots" content="noindex, nofollow, noarchive" />
  <meta name="Description" content="" />
  <meta name="Keywords" content="" />
  

  <script type="text/javascript" src="<?php echo $config['dir_core']; ?>common.js"></script>
  <script type="text/javascript" src="<?php echo $config['dir_core']; ?>common-admin.js"></script>
  <script type="text/javascript" src="<?php echo $config['dir_core']; ?>check-form.js"></script>
  <script type="text/javascript" src="<?php echo $config['dir_plugins']; ?>lert.js"></script>
  <link rel="stylesheet" href="<?php echo $config['dir_templates']; ?>admin/style.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo $config['dir_plugins'] ?>valums-file-uploader/client/fileuploader.css" type="text/css" />
  <script type="text/javascript">
    var cfLangNoWord      = "<?php echo $lang['cf_no_word']; ?>";
    var cfLangMail        = "<?php echo $lang['cf_mail']; ?>";
    var cfWrongValue      = "<?php echo $lang['cf_wrong_value']; ?>";
    var cfToSmallValue    = "<?php echo $lang['cf_to_small_value']; ?>";
    var cfTxtToShort      = "<?php echo $lang['cf_txt_to_short']; ?>";

    var delShure = "<?php echo $lang['Operation_sure_delete']; ?>";
    var confirmShure = "<?php echo $lang['Operation_sure']; ?>";
    var yes = "<?php echo $lang['yes']; ?>";
    var no = "<?php echo $lang['no']; ?>";
    var Cancel = "<?php echo $lang['Cancel']; ?>";
    var Yes = "<?php echo $lang['Yes']; ?>";
    var YesWithoutFiles = "<?php echo $lang['Yes_without_files']; ?>";
    var aDelTxt = Array( Yes, YesWithoutFiles );
    var sVersion = '<?php echo VERSION; ?>';
    var sExtNotice = '<?php echo $config['admin_lang'] == 'pl' ? '' : ''; ?>';
    var sExtDemo = '<?php echo $config['admin_lang'] == 'pl' ? '' : ''; ?>';
  </script>
</head>