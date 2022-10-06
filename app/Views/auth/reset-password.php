<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../../">
    <meta charset="utf-8" />
    <title><?= $title; ?></title>
    <meta name="description" content="Sign-in" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="<?= base_url(); ?>/theme/dist/assets/css/pages/login/login-3.css" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="<?= base_url(); ?>/theme/dist/assets/plugins/global/plugins.bundle.css" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url(); ?>/theme/dist/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url(); ?>/theme/dist/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <link rel="shortcut icon" href="<?= base_url(''); ?>/logo/stori.ico" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #3F7EB3;">
                <!--begin::Aside Top-->
                <div class="d-flex flex-column-auto flex-column pt-lg-30 pt-15">
                    <!--begin::Aside header-->
                    <a href="javascript:" class="login-logo text-center pb-10">
                        <img src="<?= base_url(''); ?>/logo/logos.png" alt="" class="logo-default max-h-60px" />
                    </a>
                    <!--end::Aside header-->
                    <!--begin::Aside Title-->
                    <h1 class="font-weight-bolder text-center font-size-h1 line-height-xl" style="color: #986923;">
                        Fulfillment Center</h1>
                    <!--end::Aside Title-->
                </div>
                <!--end::Aside Top-->
                <!--begin::Aside Bottom-->
                <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center"
                    style="background-position-y: calc(100%); background-image: url(<?= base_url(); ?>/theme/dist/assets/media/bg/ikon_web_stori-01.png);">
                </div>
                <!--end::Aside Bottom-->
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div class="login-content flex-row-fluid d-flex flex-column p-10">
                <!--begin::Top-->
                <div class="text-right d-flex justify-content-center">
                    <div class="top-signin text-right d-flex justify-content-end pt-5 pb-lg-0 pb-10">
                    </div>
                </div>
                <!--end::Top-->
                <!--begin::Wrapper-->
                <div class="d-flex flex-row-fluid flex-center">
                    <!--begin::Signin-->
                    <div class="login-form">
                        <?= session()->getFlashdata('message'); ?>
                        <!--begin::Form-->
                        <form class="form" id="kt_login_forgot_form"
                            action="<?= base_url('auth/reset_password/'.@$user->user_id); ?>" method="post">
                            <!--begin::Title-->
                            <div class="pb-5 pb-lg-15">
                                <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Reset Your
                                    Password</h3>
                                <div class="text-muted font-weight-bold font-size-h5">Please enter your new Password to
                                    login into Fulfillment Center System</div>
                            </div>
                            <!--begin::Title-->
                            <!--begin::Form group-->
                            <div class="form-group">
                                <label class="font-size-h6 font-weight-bolder text-dark">Password</label>
                                <input
                                    class="form-control h-auto py-7 px-6 font-size-h5 rounded-lg border-0 <?= ($validation->getError('user_password')) ? 'is-invalid' : ''; ?>"
                                    type="password" name="user_password" id="user_password" autocomplete="off" />
                                <?php if($validation->getError('user_password')){ echo '<div class="invalid-feedback">'.$validation->getError('user_password').'</div>'; } ?>
                            </div>
                            <!--end::Form group-->
                            <!--begin::Form group-->
                            <div class="form-group">
                                <div class="d-flex justify-content-between mt-n5">
                                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">Re-enter
                                        Password</label>
                                </div>
                                <input
                                    class="form-control h-auto py-7 px-6 rounded-lg border-0 font-size-h5 <?= ($validation->getError('user_repassword')) ? 'is-invalid' : ''; ?>"
                                    type="password" name="user_repassword" autocomplete="off" />
                                <?php if($validation->getError('user_repassword')){ echo '<div class="invalid-feedback">'.$validation->getError('user_repassword').'</div>'; } ?>
                            </div>
                            <!--end::Form group-->
                            <!--begin::Action-->
                            <div class="pb-lg-0 pb-5">
                                <button type="submit" id="kt_login_singin_form_submit_button"
                                    class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Confirm</button>
                            </div>
                            <!--end::Action-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Signin-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->
    <script>
    var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1400
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#6993FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };
    </script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="<?= base_url(); ?>/theme/dist/assets/plugins/global/plugins.bundle.js"></script>
    <script src="<?= base_url(); ?>/theme/dist/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
    <script src="<?= base_url(); ?>/theme/dist/assets/js/scripts.bundle.js"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Scripts(used by this page) validasi -->
    <!-- <script src="<?= base_url(); ?>/theme/dist/assets/js/pages/custom/login/login-3.js"></script> -->
    <!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>