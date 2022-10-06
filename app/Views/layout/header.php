<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 11 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../">
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta name="description" content="Aside light theme example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="<?= base_url(); ?>/theme/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="<?= base_url(); ?>/theme/dist/assets/plugins/global/plugins.bundle.css" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url(); ?>/theme/dist/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url(); ?>/theme/dist/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="<?= base_url(); ?>/theme/dist/assets/css/themes/layout/header/base/light.css" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url(); ?>/theme/dist/assets/css/themes/layout/header/menu/dark.css" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url(); ?>/theme/dist/assets/css/themes/layout/brand/dark.css" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url(); ?>/theme/dist/assets/css/themes/layout/aside/dark.css" rel="stylesheet"
        type="text/css" />
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="<?= base_url(); ?>/theme/dist/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet"
        type="text/css" />
    <!--end::Layout Themes-->
    <!-- chart js -->
    <script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/chartjs/chart.min.js"></script>
    <!--  -->
    <link rel="shortcut icon" href="<?= base_url(); ?>/logo/logo.ico" />
    <script>
    var base_url = '<?php echo base_url(); ?>';
    </script>
    <style>
        .disabled {
            pointer-events:none; 
            opacity:0.6;
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->
<?php 
use App\Models\PrivilegeModel; 
use App\Models\OwnersMarketModel;
use App\Models\OwnersModel;
use App\Models\BankModel;
?>
<?php 
$this->privilege = new PrivilegeModel();
$this->market = new OwnersMarketModel();
$this->owners = new OwnersModel();
$this->bank = new BankModel(); 
?>
<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading aside-minimize">
    <!--begin::Main-->
    <!--begin::Header Mobile-->
    <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
        <!--begin::Logo-->
        <?php if(session()->get('user_type')==1){ ?>
            <a href="<?= base_url('dashboard_seller'); ?>">
                <img alt="Logo" src="<?= base_url('/logo/white poslog panjang.png');?>" class="logo-default max-h-50px" />
            </a>
        <?php } else { ?>
            <a href="<?= base_url('dashboard'); ?>">
                <img alt="Logo" src="<?= base_url('/logo/white poslog panjang.png');?>" class="logo-default max-h-50px" />
            </a>
        <?php } ?>
        <!--end::Logo-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Aside Mobile Toggle-->
            <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                <span></span>
            </button>
            <!--end::Aside Mobile Toggle-->
            <!--begin::Header Menu Mobile Toggle-->
            <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
                <span></span>
            </button>
            <!--end::Header Menu Mobile Toggle-->
            <!--begin::Topbar Mobile Toggle-->
            <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                <span class="svg-icon svg-icon-xl">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path
                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                            <path
                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
            </button>
            <!--end::Topbar Mobile Toggle-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Aside-->
            <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
                <!--begin::Brand-->
                <div class="brand flex-column-auto" id="kt_brand">
                    <!--begin::Logo-->
                    <?php if(session()->get('user_type')==1){ ?>
                        <a href="<?= base_url('dashboard_seller');?>" class="brand-logo">
                            <img alt="Logo" src="<?= base_url('/logo/white poslog panjang.png');?>" class="logo-default max-h-60px" />
                        </a>
                    <?php } else { ?>
                        <a href="<?= base_url('dashboard'); ?>" class="brand-logo">
                            <img alt="Logo" src="<?= base_url('/logo/white poslog panjang.png');?>" class="logo-default max-h-60px" />
                        </a>
                    <?php } ?>
                    <!--end::Logo-->
                    <!--begin::Toggle-->
                    <button class="brand-toggle btn btn-sm px-0 active" id="kt_aside_toggle">
                        <span class="svg-icon svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path
                                        d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                                    <path
                                        d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3"
                                        transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </button>
                    <!--end::Toolbar-->
                </div>
                <!--end::Brand-->
                <!--begin::Aside Menu-->
                <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                    <!--begin::Menu Container-->
                    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
                        data-menu-dropdown-timeout="500">
                        <!--begin::Menu Nav-->
                        <ul class="menu-nav">
                            <?php $menu = $this->privilege->get_user_access(session()->get('level_id'));?>
                            <?php if (@$menu) :
                                $no = 0;
                                $index = 0;
                                $level_id = null;
                                $menu_id = null;
                                $submenu_id = null;
                                $access = "";
                                $access2 = null;
                                $cek_access = null;

                                foreach ($menu as $row) :
                                $no++; 
                            ?>
                                <?php if($row->is_parent == 0) {
                                        $level_id = session()->get('level_id');
                                        $disable = "";
                                        $menu_id = $row->id;
                                        
                                        $cek_access = $this->privilege->get_user_access_byid($level_id, $menu_id, $submenu_id);
                                        // echo json_encode($cek_access);
                                        if(!empty(@$cek_access)) {
                                            $access = "checked";
                                        }else{
                                            $access2 = "checked";
                                        }

                                        $bank = $this->bank->get_accountByOwner(session()->get('owners_id'));
                                        $market = $this->market->get_owner_markets(session()->get('owners_id'));
                                        $owners = $this->owners->get_owner_byid(session()->get('owners_id'));
                                        if($level_id == 'LV006'){
                                            if(@$owners == null or @$market == null or @$bank == null){ 
                                                $disable = 'disabled';
                                            }else{
                                                $disable = '';
                                            }
                                        }
                                    ?>
                                    <li class="menu-item <?php echo $disable;?>" <?php //(@$title == 'Allocation Plan' ? 'menu-item-active' : '') ?>
                                        aria-haspopup="true">
                                        <a href="<?= base_url(''.$row->controller.''); ?>" class="menu-link">
                                            <div class="mr-4 flex-shrink-0 text-left" style="width: 21px;">
                                                <i class="icon-lg <?= $row->icon ?>"></i>
                                            </div>
                                            <span class="menu-text"><?= $row->menu_name ?></span>
                                        </a>
                                    </li>
                                    <?php 
                                        $index++; 
                                        $level_id = null;
                                        $menu_id = null;
                                        $submenu_id = null;
                                        $cek_access = null;
                                        $access = "";
                                        $access2 = null;
                                      } else { 
                                    ?>
                                    <li class="menu-item menu-item-submenu <?php #(@$title == 'Inbound Report' || @$title == 'Outbound Report' ? 'menu-item-open' : '') ?>"
                                        aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="javascript:;" class="menu-link menu-toggle">
                                            <div class="mr-4 flex-shrink-0 text-left" style="width: 21px;">
                                                <i class="icon-lg <?= $row->icon ?>"></i>
                                            </div>
                                            <span class="menu-text"><?= $row->menu_name ?></span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                        <div class="menu-submenu">
                                            <i class="menu-arrow"></i>
                                                        <ul class="menu-subnav">
                                                <?php $submenus = $this->privilege->get_all_sub_menu(@$row->menu_id); ?>
                                                <?php if(@$submenus) {?>
                                                    <?php 
                                                        foreach(@$submenus as $rowS) { 
                                                            $level_id = session()->get('level_id');
                                                            $menu_id = $row->menu_id;
                                                            $submenu_id = $rowS->id;
                                                            $disable = '';
                                                            $cek_access = $this->privilege->get_user_access_byid($level_id, $menu_id, $submenu_id);
                                                            $bank = $this->bank->get_accountByOwner(session()->get('owners_id'));
                                                            $market = $this->market->get_owner_markets(session()->get('owners_id'));
                                                            $owners = $this->owners->get_owner_byid(session()->get('owners_id'));
                                                            if($level_id == 'LV006'){
                                                                if(@$owners == null or @$market == null or @$bank == null){ 
                                                                    $disable = 'disabled';
                                                                }else{
                                                                    $disable = '';
                                                                }
                                                            }
                                                    ?>  
                                                            <?php if(!empty(@$cek_access)) { ?>
                                                                <li class="menu-item menu-item <?php echo $disable;?>"
                                                                aria-haspopup="true">
                                                                    <a href="<?= base_url($rowS->controller); ?>" class="menu-link">
                                                                        <i class="menu-bullet menu-bullet-dot">
                                                                            <span></span>
                                                                        </i>
                                                                        <span class="menu-text"><?= $rowS->submenu_name ?></span>
                                                                    </a>
                                                                </li>
                                                            <?php } else { ?> 
                                                                
                                                            <?php } ?>
                                                            
                                                        
                                                
                                                    <?php   
                                                        $level_id = null;
                                                        $menu_id = null;
                                                        $submenu_id = null;
                                                        $cek_access = null;
                                                        $access = "";
                                                        $access2 = null;
                                                    };
                                                    ?>
                                                    </ul>
                                                </div>
                                            <?php 
                                                }; 
                                            ?>
                                    </li>
                                    <?php } ?>
                                <?php
                                endforeach;
                                endif;
                            ?>
                            <?php if(session()->get('level_id') == 'LV001') { ?>
                            <li class="menu-item menu-item-submenu <?= (@$title == 'users' || @$title == 'hris' || @$title == 'level' || @$title == 'Privilege' || @$title == 'menu' || @$title == 'Submenu' ? 'menu-item-open' : '') ?>"
                                aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                
                                    <div class="mr-4 flex-shrink-0 text-left" style="width: 21px;">
                                        <i class="icon-lg fas fa-user-cog"></i>
                                    </div>
                                    <span class="menu-text">User Access</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        <li class="menu-item menu-item <?= (@$title == 'level' ? 'menu-item-active' : '') ?>"
                                            aria-haspopup="true">
                                            <a href="<?= base_url('level'); ?>" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">User Level</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item <?= (@$title == 'hris' ? 'menu-item-active' : '') ?>"
                                            aria-haspopup="true">
                                            <a href="<?= base_url('userhris'); ?>" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">User HRIS Level</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item <?= (@$title == 'users' ? 'menu-item-active' : '') ?>"
                                            aria-haspopup="true">
                                            <a href="<?= base_url('users'); ?>" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">System's User</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item <?= (@$title == 'Privilege' ? 'menu-item-active' : '') ?>"
                                            aria-haspopup="true">
                                            <a href="<?= base_url('privilege'); ?>" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">User Privilege</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item <?= (@$title == 'menu' ? 'menu-item-active' : '') ?>"
                                            aria-haspopup="true">
                                            <a href="<?= base_url('menu'); ?>" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Master Menu</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item <?= (@$title == 'Submenu' ? 'menu-item-active' : '') ?>"
                                            aria-haspopup="true">
                                            <a href="<?= base_url('submenu'); ?>" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Master Sub Menu</span>
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                        <!--end::Menu Nav-->
                    </div>
                    <!--end::Menu Container-->
                </div>
                <!--end::Aside Menu-->
            </div>
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header header-fixed">
                    <!--begin::Container-->
                    <div class="container-fluid d-flex align-items-stretch justify-content-between">
                        <!--begin::Header Menu Wrapper-->
                        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                            <!--begin::Header Menu-->
                            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                                <!--begin::Header Nav-->
                                <ul class="menu-nav">

                                </ul>
                                <!--end::Header Nav-->
                            </div>
                            <!--end::Header Menu-->
                        </div>
                        <!--end::Header Menu Wrapper-->
                        
                        <!--begin::Topbar-->
                        <div class="topbar">
                            <!-- start of notification bar -->
                            <?php 
                                if(session()->get('user_type') == 1){
                            ?>
                            <div class="dropdown">
                                <?php     
                                    $materialsize_notif_data = get_materialsize_dm(session()->get('owners_id'));
                                    $count_materialsize_notif_data = count($materialsize_notif_data);
                                    $invoice_notif_data = get_invoice_npy(session()->get('owners_id'));
                                    $count_invoice_notif_data = count($invoice_notif_data);
                                ?>
                                <!--begin::Toggle-->
                                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary">
                                        <span class="svg-icon svg-icon-xl svg-icon-primary">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <path d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z" fill="#000000"/>
                                                    <rect fill="#000000" opacity="0.3" x="10" y="16" width="4" height="4" rx="2"/>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="label label-sm label-rounded label-danger mr-2 mt-1" style="position: absolute; top: -2px; right: -2px;"><?= $count_materialsize_notif_data + $count_invoice_notif_data ?></span> 
                                        <!-- jumlah total notifikasi di luar -->
                                        <span class="pulse-ring"></span>
                                    </div>
                                </div>
                                <!--end::Toggle-->
                                <!--begin::Dropdown-->
                                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                                    <form>
                                        <!--begin::Header-->
                                        <div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url(<?= base_url() ?>/theme/dist/assets/media/misc/bg-1.jpg)">
                                            <!--begin::Title-->
                                            <h4 class="d-flex flex-center rounded-top">
                                                <span class="text-white">User Notifications</span>
                                                <span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2"><?= $count_materialsize_notif_data + $count_invoice_notif_data ?> new</span>
                                                <!-- jml notifikasi di dalam -->
                                            </h4>
                                            <!--end::Title-->
                                            <!--begin::Tabs-->
                                            <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_alerts">Material Data
                                                    <?php if($count_materialsize_notif_data > 0){ ?>
                                                        <span class="label label-sm label-rounded label-danger"><?= $count_materialsize_notif_data ?></span> 
                                                    <?php } ?>
                                                    </a>
                                                    
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#topbar_notifications_invoice">Invoices
                                                    <?php if($count_invoice_notif_data > 0){ ?>
                                                        <span class="label label-sm label-rounded label-danger"><?= $count_invoice_notif_data ?></span> 
                                                    <?php } ?>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!--end::Tabs-->
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Content-->
                                        <div class="tab-content">
                                            <!--begin::Tabpane-->
                                            <div class="tab-pane active" id="topbar_notifications_alerts" role="tabpanel">
                                                <!--begin::Nav-->
                                                <div class="navi navi-hover scroll my-4" data-scroll="true" data-height="300" data-mobile-height="200">
                                                    <!--begin::Item-->
                                                    <?php 
                                                        // $getNotificationByRecipient = getNotificationByRecipient(session()->get('user_id'));
                                                        foreach ($materialsize_notif_data as $key => $value) {
                                                    ?>
                                                    <a href="<?= base_url('materialsize')."/edit/".$value->material_id ?>" class="navi-item">
                                                        <div class="navi-link">
                                                            <div class="navi-icon mr-2">
                                                                <i class="flaticon2-exclamation text-danger icon-lg font-weight-bold "></i>
                                                            </div>
                                                            <div class="navi-text">
                                                                <div class="font-weight-bold" style="font-size: 12px;"><?= $value->material_name ?> | <?= "Material data and actual size doesn't match" ?></div>
                                                                <div class="text-muted">
                                                                    <?php 
                                                                        $today = date_create(date("Y/m/d H:i:s"));
                                                                        $tgl = date_create($value->update_date);
                                                                        $selisih = null;
                                                                        $selisih = date_diff($tgl, $today);
                                                                        if($selisih->days > 0){
                                                                            echo $selisih->days . " Day and ". $selisih->h . " hour ago";
                                                                        } else {
                                                                            if($selisih->h > 0){
                                                                                echo $selisih->h . " Hour ago";
                                                                            } else {
                                                                                echo "Less than an hour ago";
                                                                            }
                                                                        }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <?php 
                                                        } 
                                                    ?>
                                                    <!--end::Item-->
                                                    
                                                </div>
                                                <!--end::Nav-->
                                            </div>
                                            <!--end::Tabpane-->

                                            <!--begin::Tabpane-->
                                            <div class="tab-pane" id="topbar_notifications_invoice" role="tabpanel">
                                                <div class="navi navi-hover scroll my-4" data-scroll="true" data-height="300" data-mobile-height="200">
                                                    <?php 
                                                        // $getNotificationByRecipient2 = getNotificationByRecipient2(session()->get('department_id'));
                                                        foreach ($invoice_notif_data as $key => $value) {
                                                    ?>
                                                        <a href="<?= base_url('outboundpo')."/invoice/".$value->po_outbound_id ?>" class="navi-item">
                                                            <div class="navi-link">
                                                                <div class="navi-icon mr-2">
                                                                    <i class="flaticon-price-tag text-danger icon-lg font-weight-bold"></i>
                                                                </div>
                                                                <div class="navi-text">
                                                                    <div class="font-weight-bold" style="font-size: 12px;">Bill for Transaction with ID <b><?= $value->po_outbound_id ?></b> and customer <b><?= $value->customer_name ?></b> has not been approved</div>
                                                                    <div class="text-muted">
                                                                    <?php 
                                                                        $today = date_create(date("Y/m/d H:i:s"));
                                                                        $tgl = date_create($value->po_create_date);
                                                                        $selisih = null;
                                                                        $selisih = date_diff($tgl, $today);
                                                                        if($selisih->days > 0){
                                                                            echo $selisih->days . " Day and ". $selisih->h . " hour ago";
                                                                        } else {
                                                                            if($selisih->h > 0){
                                                                                echo $selisih->h . " Hour ago";
                                                                            } else {
                                                                                echo "Less than an hour ago";
                                                                            }
                                                                        }
                                                                    ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    <?php 
                                                     } 
                                                    ?>
                                                </div>
                                            </div>
                                            <!--end::Tabpane-->
                                        </div>
                                        <!--end::Content-->
                                    </form>
                                </div>
                                <!--end::Dropdown-->
                            </div>
                            <!-- end of notification bar -->
                            <?php 
                                }
                            ?>
                            <!--begin::User-->
                            <div class="topbar-item">
                                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
                                    id="kt_quick_user_toggle">
                                    <span
                                        class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                                    <span
                                        class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"><?= session()->get('fullname'); ?></span>
                                        <span class="symbol symbol-lg-35 symbol-25 symbol-light-primary">
                                            
                                        <div class="symbol-label">
										<!-- <img src="<?= base_url(); ?>/logo/svg/balance.svg" /> -->
										<span class="svg-icon svg-icon-md svg-icon-primary">
											<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Notification2.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                                </g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</div>
                                    </span>
                                </div>
                            </div>
                            <!--end::User-->
                        </div>
                        <!--end::Topbar-->
                        
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->