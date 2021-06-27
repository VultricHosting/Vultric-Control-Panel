<?php
   session_start();
   
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
   header("location: ../login.php");
   exit;
   }

   require_once "../requires/config.php";
   $strSQL = "SELECT plan, ftpaccounts, subdomains, addondomains, parkeddomains, mysqldbs, diskspace, diskused, diskrem, bandwith, bandused, bandrem, maindomain, ftphost, ftpuser, mysqlhost, mysqluser, svrnum, panelv  FROM users WHERE id = '".$_SESSION['id']."'";
   $rs = mysqli_query($link, $strSQL);
   
   while($row = mysqli_fetch_array($rs)) {
       $plan = $row['plan'];
       $ftpaccounts = $row['ftpaccounts'];
       $subdomains = $row['subdomains'];
       $addondomains = $row['addondomains'];
       $parkeddomains = $row['parkeddomains'];
       $mysqldbs = $row['mysqldbs'];
       $diskspace = $row['diskspace'];
       $diskused = $row['diskused'];
       $diskrem = $row['diskrem'];
       $bandwith = $row['bandwith'];
       $bandused = $row['bandused'];
       $bandrem = $row['bandrem'];
       $maindomain = $row['maindomain'];
       $ftphost = $row['ftphost'];
       $ftpuser = $row['ftpuser'];
       $mysqlhost = $row['mysqlhost'];
       $mysqluser = $row['mysqluser'];
       $svrnum = $row['svrnum'];
       $panelv = $row['panelv'];
       $Package = "";
       $remdisk = "";
       $remband = "";
   }
   
      if($plan == "Unmetered Hosting"){
         $Package = "Unlimited";
     }elseif ($plan == "Amethyst Hosting"){
         $Package = "10 GB";
         $remband = $bandwith - $bandused;
         $remdisk = $diskspace - $diskrem; 
   }elseif ($plan == "Golden Hosting"){
         $Package = "15 GB";
         $remband = $bandwith - $bandused;
         $remdisk = $diskspace - $diskrem; 
   }
   
   $size = $diskused;

function convertToReadableSize($size){
  $base = log($size) / log(1024);
  $suffix = array("", "KB", "MB", "GB", "TB");
  $f_base = floor($base);
  return round(pow(1024, $base - floor($base)), 1) . $suffix[$f_base];
}
   
   mysqli_close($link);
?>
   
<!DOCTYPE html>
<html lang="en" dir="ltr" data-style="basic">
   <head></head>
   <body id="panel_body" class="yui-skin-sam">
      <title></title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width">
      <meta name="theme-color" content="#282828">
      <meta name="mobile-web-app-capable" content="yes">
      <meta name="mobile-web-app-status-bar-style" content="default">
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="apple-mobile-web-app-status-bar-style" content="default">
      <link rel="shortcut icon" href="/panel/pl-res/favicon.ico" type="image/x-icon">
      <link rel="stylesheet" type="text/css" href="../assets/css/w.css">
      <link rel="stylesheet" type="text/css" href="../assets/css/g.css">
      <script type="text/javascript" src="../assets/js/g.js"></script>
      <script type="text/javascript" src="../assets/js/w.js"></script>
      <style> 
         #rcorners1 {
         border-radius: 25px;
         background: #282828;
         padding: 20px; 
         width: 200000000px;
         height: 150px;  
      </style>
      <style type="text/css">
         #panel_body{max-width:none}.panel-widget{border-radius:3px;box-shadow:0 0 3px rgba(0,0,0,.2);height:auto;border:0;margin-bottom:15px;display:table;width:100%;max-width:100%}.widget-heading{border:1px solid #293a4a;background-color:rgba(8, 8, 8, 0.95);color:#fff;text-transform:uppercase}.widget-heading .close{color:#fff;opacity:1}.widget-draggable{cursor:move}.group-header-indicator{cursor:pointer}html[dir="rtl"] .pull-right{float:left!important}.alert-list{margin:0;padding:0;width:100%}.alert-item{padding:0 8px;display:inline-block;width:50%;vertical-align:top;float:left;zoom:1;*display:inline}html[dir="rtl"] .alert-item{float:right}@media(max-width:767px){.alert-item{width:100%;padding:0 8px}}.drag{opacity:.5}.drag+.drag-over,#content .drag-hidden{margin:0;height:0;outline-style:none}.drag-over{outline-style:dashed;height:80px;margin:10px 0}.drop-area{padding:5px 0}#jump-search{margin-bottom:5px}.icon-menu-section{margin-bottom:5px}.icon-container-body{padding-left:15px;padding-top:15px;clear:both;margin-left:0;margin-right:0;overflow:hidden;width:100%}html[dir="rtl"] .icon-container-body{padding-right:15px;padding-left:0}.item{float:left;height:60px;padding:0;text-align:left}html[dir="rtl"] .item{text-align:right;float:right}.icon{display:block;margin:auto}.itemContentWrapper{padding:0;width:100%}.itemImageWrapper{display:inline-block;vertical-align:middle}.itemTextWrapper{padding:10px 0 10px 5px;display:inline-block;vertical-align:middle;width:200px}html[dir="rtl"] .itemTextWrapper{padding:10px 5px 10px 0}.icon-menu-section .close,.icon-menu-section .close:hover,.icon-menu-section .close:active,.icon-menu-section .close:focus{opacity:1;color:#fff}@media(min-width:992px){html[dir="ltr"] #stats{padding-left:0}html[dir="rtl"] #stats{padding-right:0}}.app-name{text-transform:capitalize;padding:0 0 5px 0;display:block;word-break:break-all}.general-info-label{text-transform:capitalize;display:block}.general-info-value{display:block}.progress{margin:5px 0 5px 0}.progress-bar-disabled{background-color:#282828}.progress{height:4px;border-radius:0;box-shadow:none;background:#282828}.progress .progress-bar{box-shadow:none}.warning .app-stat-upgrade .fa-exclamation-triangle{color:#8a6d3b}.danger .app-stat-upgrade .fa-exclamation-triangle{color:#a94442}.success .progress-bar{background-color:#5cb85c}.info .progress-bar{background-color:#5bc0de}.warning .progress-bar{background-color:#f0ad4e}.danger .progress-bar{background-color:#d9534f}#statsSection tr.success.app-stat-row,#statsSection tr.info.app-stat-row{border-left:none}#statsSection tr.success td,#statsSection tr.info td{background:0}#statsSection .app-stat-upgrade{width:50px;padding:0;line-height:75px;text-align:center}.app-stat-upgrade a{display:none;height:100%;width:100%;text-align:center;color:#282828;background-color:#428bca}.warning>.app-stat-upgrade>a>i,.danger>.app-stat-upgrade>a>i{vertical-align:middle}.warning>.app-stat-upgrade>a,.danger>.app-stat-upgrade>a{display:inline-block}.updating-elements{display:inline-block}.application-list-loading-indicator{margin:auto;font-weight:500;font-size:36px;text-align:center;vertical-align:middle;padding:20px 0}
         .localytics-chosen.loading+.chosen-container-multi .chosen-choices{background-image:url('images/spinner.gif');background-repeat:no-repeat;background-position:98%}html[dir="rtl"] .localytics-chosen.loading+.chosen-container-multi .chosen-choices{background-position:2%}.localytics-chosen.loading+.chosen-container-single .chosen-single span{background:url('images/spinner.gif') no-repeat right}html[dir="rtl"] .localytics-chosen.loading+.chosen-container-single .chosen-single span{background:url('images/spinner.gif') no-repeat left}.localytics-chosen.loading+.chosen-container-single .chosen-single .search-choice-close{display:none}        
      </style>
      <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="app/index.dist" src=""></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="frameworksBuild" src="/frontend/paper_lantern/libraries/cjt2-dist/frameworks.cmb.js?version=1475577486"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="locale" src="/frontend/paper_lantern/libraries/cjt2-dist/plugins/locale.js?version=1475577486"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="app/index.cmb" src="/frontend/paper_lantern/home/index.cmb.min.js?version=1475577486"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="/frontend/paper_lantern/libraries/cjt2-dist/cjt2.cmb.min.js?locale=en" src="/frontend/paper_lantern/libraries/cjt2-dist/cjt2.cmb.min.js?locale=en&amp;version=1475577486"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="master/master" src="/frontend/paper_lantern/_assets/master.min.js?version=1475577486"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="jquery-chosen" src="/frontend/paper_lantern/libraries/chosen/1.5.1/chosen.jquery.min.js?version=1475577486"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="bootstrap" src="/frontend/paper_lantern/libraries/bootstrap/optimized/js/bootstrap.min.js?version=1475577486"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="angular-chosen" src="/frontend/paper_lantern/libraries/angular-chosen/1.4.0/dist/angular-chosen.min.js?version=1475577486"></script><script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="master/views/applicationListController" src="/frontend/paper_lantern/_assets/views/applicationListController.min.js?version=1475577486"></script>
      <div id="wrap" data-dashlane-rid="a1ba78467141712b" data-form-type="search">
         <header id="masterAppContainer" ng-controller="applicationListController" class="ng-scope">
            <div class="navbar navbar-inverse navbar-panel navbar-fixed-top" role="navigation">
               <div class="navbar-header">
                  <div class="btn-group">
                     <button id="btnUserPref" data-toggle="dropdown" class="btn dropdown-toggle user-preferences-btn">
                     <span id="lblUserNameTxt" class="hidden-inline-xs"><?php echo htmlspecialchars($_SESSION["username"]); ?></span>
                     </button>
                  </div>
                  <a id="lnkHeaderHome" class="navbar-brand" target="_top" href="./pages/main.php" title="Home">
                  <img id="imgLogo" class="navbar-brand-logo" src="../assets/images/vultric.png" alt="">
                  </a>
                  <script type="text/ng-template" id="customTemplate.html">
                     <a href="{{ match.model.url }}" ng-attr-target="{{match.model.target}}" ng-bind-html="match.model.name">
                     </a>
                  </script>
                  <div class="navbar-preferences form-inline">
                     <div class="btn-group">
                     </div>
                     <a id="lnkHeaderLogout" target="_top" href="https://webpanel.vultrichosting.com/panel/logout.php" class="btn link-buttons">
                     <span id="lblLogout" class="hidden-inline-xs">Log Out</span>
                     </a>
                  </div>
               </div>
            </div>
            <div id="include-global-header"></div>
         </header>
         <br><br>
         <div style="position: float;left:100px; vertical-align:middle;"></div>
         <div id="content" class="container-fluid">
            <div growl="" limit-messages="1">
               <div class="growl-container growl-fixed top-right" ng-class="wrapperClasses()"></div>
            </div>
            <div class="row">
               <div id="main" class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                  <div ng-controller="applicationListController">
                     <div class="application-list-loading-indicator ng-hide" ng-show="::false">
                     </div>
                     <div id="jump-search" class="">
                        <div class="panel panel-widget">
                        </div>
                        <div align="center">
                        </div>
                     </div>
                     <div id="boxes" class="">
                        <div drop-area="" drop="handleDrop" id="top-drop-area" class="drop-area"></div>
                        <div ng-repeat="group in applicationList track by group.group" ng-show="([group] | filter:searchGroup).length" class="">
                           <div drop-area="" drop="handleDrop" id="files-drop-area" class="drop-area"></div>
                        </div>
                        <!-- Start Of File Manager !-->
                        <div id="files-group" data-group-name="files" class="panel panel-widget icon-menu-section" role="group">
                           <div class="panel-heading widget-heading widget" ng-dblclick="toggleGroup(files)">
                              <span role="heading" aria-level="3" id="files-header" class="group-header">Files</span>
                           </div>
                           <div id="files-body" data-group-body="files" class="panel-body widget-collapsible">
                              <div class="icon-container-body">
                                 <div class="item" data-item-search-text="File Manager file-manager File Manager" data-item-group="files">
                                    <a id="icon-file_manager" aria-label="File Manager" class="itemImageWrapper integrations_icon spriteicon_img icon-file_manager" href="filemanager/index.html" target="file_manager">
                                    <img src="../assets/images/FileManager.png" alt="files" width="50" height="50">
                                    </a>
                                    <a id="item_file_manager" class="itemTextWrapper link" href="filemanager.php" target="file_manager">File Manager</a>
                                 </div>
                                 <div class="item" data-item-search-text="Backup Wizard restore Backup Wizard" data-item-group="files">
                                    <a id="icon-backup_wizard" aria-label="Backup Wizard" class="itemImageWrapper integrations_icon spriteicon_img icon-backup_wizard" href="backup.php">
                                    <img src="../assets/images/backup.png" alt="files" width="50" height="50">
                                    </a>
                                    <a id="item_backup_wizard" class="itemTextWrapper link" href="backup.php">Backup Manager</a>
                                 </div>
                                 <div class="item" data-item-search-text="Git version control vcs repositories repository repo master checkout check out branch clone remote source code commit head gitweb history log publish deployment build continuous integration Git™ Version Control Git™ Version Control" data-item-group="files">
                                    <a id="icon-version_control" aria-label="Git™ Version Control" class="itemImageWrapper integrations_icon spriteicon_img icon-version_control" href="version_control/index.html"></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- End Of File Manager !-->
                        <div ng-repeat="group in applicationList track by group.group" ng-show="([group] | filter:searchGroup).length" class="">
                           <div drop-area="" drop="handleDrop" id="email-drop-area" class="drop-area"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="stats" class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                  <div id="statsSection" class="panel panel-widget">
                     <div id="statsHeaderSection" class="panel-heading widget-heading">
                        Statistics                
                     </div>
                     <table class="table" id="stats" cellspacing="0" cellpadding="0">
                        <tbody>
                           <tr class="row-odd">
                              <td class="stats_left">Plan:</td>
                              <td class="stats_right"><?php print($plan); ?></td>
                              </td>
                           </tr>
                           <tr class="row-even">
                              <td class="stats_left">FTP accounts:</td>
                              <td class="stats_right"><?php print($ftpaccounts); ?> / Unlimited</td>
                           </tr>
                           <tr class="row-odd">
                              <td class="stats_left">Sub-Domains:</td>
                              <td class="stats_right">
                                 <?php print($subdomains); ?> / Unlimited
                                 <div class="stats_progress_bar">
                                    <div class="panel_widget_progress_bar_percent" style="display:none">0</div>
                                 </div>
                              </td>
                           </tr>
                           <tr class="row-even">
                              <td class="stats_left">Add-on Domains:</td>
                              <td class="stats_right">
                                 <?php print($addondomains); ?> / Unlimited
                                 <div class="stats_progress_bar">
                                    <div class="panel_widget_progress_bar_percent" style="display:none">0</div>
                                 </div>
                              </td>
                           </tr>
                           <tr class="row-odd">
                              <td class="stats_left">Parked Domains:</td>
                              <td class="stats_right">
                                 <?php print($parkeddomains); ?> / Unlimited
                                 <div class="stats_progress_bar">
                                    <div class="panel_widget_progress_bar_percent" style="display:none">0</div>
                                 </div>
                              </td>
                           </tr>
                           <tr class="row-even">
                              <td class="stats_left">MySQL Databases:</td>
                              <td class="stats_right">
                                 <?php print($mysqldbs); ?> / Unlimited
                                 <div class="stats_progress_bar">
                                    <div class="panel_widget_progress_bar_percent" style="display:none">0</div>
                                 </div>
                              </td>
                           </tr>
                           <tr class="row-odd">
                              <td class="stats_left">Disk Quota:</td>
                              <td class="stats_right">
                                 <?php print($Package); ?>
                              </td>
                           </tr>
                           <tr class="row-even">
                              <td class="stats_left">Disk Space Used:</td>
                              <td class="stats_right">
                                 <?php print(convertToReadableSize($size)); ?> / <?php print($Package); ?>
                                 <div class="stats_progress_bar">
                                    <div class="panel_widget_progress_bar_percent" style="display:none">0</div>
                                 </div>
                              </td>
                           </tr>
                           <tr class="row-odd">
                              <td class="stats_left">Disk Remaining:</td>
                              <td class="stats_right">
                                 <?php if($plan == "Amethyst Hosting" or $plan == "Golden Hosting") {print($diskused); ?> / <?php print($Package); }else print($Package); ?>
                              </td>
                           </tr>
                           <tr class="row-odd">
                              <td class="stats_left">Bandwidth:</td>
                              <td class="stats_right"><?php print($Package); ?></td>
                           </tr>
                           <tr class="row-odd">
                              <td class="stats_left">Bandwidth used:</td>
                              <td class="stats_right">
                                 <?php print($bandused); ?> / <?php print($Package); ?>
                                 <div class="stats_progress_bar">
                                    <div class="panel_widget_progress_bar_percent" style="display:none">0 </div>
                                 </div>
                              </td>
                           </tr>
                           <tr class="row-even">
                              <td class="stats_left">Bandwidth remaining:</td>
                              <td class="stats_right">
                                  <?php if($plan == "Amethyst Hosting" or $plan == "Golden Hosting") {print($bandused); ?> / <?php print($Package); }else print($Package); ?>
                              </td>
                           </tr>
                           <tr class="row-odd">
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div id="statsSection" class="panel panel-widget">
                     <div id="statsHeaderSection" class="panel-heading widget-heading">
                        Account Details  
                     </div>
                     <div id="content-stats" class="newContent">
                        <div id="stats-header">
                        </div>
                     </div>
                     <table class="table" id="stats" cellspacing="0" cellpadding="0">
                        <tbody>
                           <tr class="row-odd">
                              <td class="stats_left">Main Domain</td>
                              <td class="stats_right"><?php print($maindomain); ?></td>
                           </tr>
                           <tr class="row-even">
                              <td class="stats_left">FTP hostname:</td>
                              <td class="stats_right"><?php echo htmlspecialchars($_SESSION["username"]); ?></td>
                           </tr>
                           <tr class="row-odd">
                              <td class="stats_left">FTP username:</td>
                              <td class="stats_right"><?php echo htmlspecialchars($_SESSION["username"]); ?></td>
                           </tr>
                           <tr class="row-even">
                              <td class="stats_left">MySQL hostname:</td>
                              <td class="stats_right"><?php print($mysqlhost); ?></td>
                           </tr>
                           <tr class="row-odd">
                              <td class="stats_left">MySQL username:</td>
                              <td class="stats_right"><?php echo htmlspecialchars($_SESSION["username"]); ?></td>
                           </tr>
                           <tr class="row-even">
                              <td class="stats_left">Server Number</td>
                              <td class="stats_right"><?php print($svrnum); ?></td>
                           </tr>
                           <tr class="row-even">
                              <td class="stats_left">Panel Version</td>
                              <td class="stats_right"><?php print($panelv); ?></td>
                        </tbody>
                     </table>
                     <table class="table" id="stats" cellspacing="0" cellpadding="0">
                        <tbody>
                        </tbody>
                     </table>
                  </div>
                  <div style="text-align:left; position: float;right:00px; vertical-align:left;"></div>
               </div>
            </div>
         </div>
         <div>
         </div>
      </div>
   </body>
</html>
