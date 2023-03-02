<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex">

    <title><?=$titlePag?></title>
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/img/')?>favicon-32x32.png">
    <link href="<?php echo base_url("assets") ?>/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?php echo base_url("assets") ?>/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url("assets") ?>/css/dashforge.css">
    <link rel="stylesheet" href="<?php echo base_url("assets") ?>/css/dashforge.demo.css">
    <link rel="stylesheet" href="<?php echo base_url("assets") ?>/css/skin.charcoal.css">
    <link rel="stylesheet" href="<?php echo base_url("assets") ?>/css/skin.light.css">
    <link rel="stylesheet" href="<?php echo base_url("assets") ?>/css/dashforge.auth.css">
    <link rel="stylesheet" href="<?php echo base_url("assets") ?>/css/dashforge.dashboard.css">
    <link rel="stylesheet" href="<?php echo base_url("assets") ?>/css/dashforge.calendar.css">
    <link rel="stylesheet" href="<?php echo base_url("assets") ?>/css/dashforge.profile.css">
    <link rel="stylesheet" href="<?php echo base_url("assets") ?>/css/administrador.css?ver=33">
    <link rel="stylesheet" href="<?php echo base_url("assets") ?>/lib/dropzone/dropz.css">
    <link rel="stylesheet" href="<?php echo base_url("assets") ?>/css/css-file-icons.css">

    <link href="<?php echo base_url("assets/emoji/") ?>emoji.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url("assets") ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url("assets") ?>/lib/dropzone/dropzone.js"></script>
    <script type="text/javascript" src="<?php echo base_url("assets") ?>/js/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url("assets") ?>/js/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets") ?>/css/daterangepicker.css" />
    <script type="text/javascript" src="<?php echo base_url("assets") ?>/js/jquitelight.js"></script>
    <script src="<?php echo base_url("assets") ?>/js/fancybox.js"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets") ?>/css/fancybox.css" />


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <link rel="stylesheet" href="<?php echo base_url("assets") ?>/css/github.min.css"/>
    <script src="<?php echo base_url("assets") ?>/js/highlight.min.js"></script>
    <script charset="UTF-8" src="<?php echo base_url("assets") ?>/js/xml.min.js"></script>

    <link href="<?php echo base_url("assets") ?>/lib/quill/quill.core.css" rel="stylesheet">
    <link href="<?php echo base_url("assets") ?>/lib/quill/quill.snow.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url("assets") ?>/lib/quill/quill.min.js"></script>


    <script type="text/javascript" src="<?php echo base_url("assets") ?>/js/loadingoverlay.min.js"></script>
    <link href="<?php echo base_url("assets") ?>/css/spectrum.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url("assets") ?>/js/spectrum.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/libraries/jquery.validate.min.js')?>" ></script>
    <script src="<?php echo base_url("assets") ?>/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets") ?>/css/bootstrap-datetimepicker.min.css">
    <link href="<?php echo base_url("assets") ?>/css/lineicons.css" rel="stylesheet">
    <link href="<?php echo base_url("assets") ?>/css/select2.min.css" rel="stylesheet" />
    <script src="<?php echo base_url("assets") ?>/js/select2.min.js"></script>
    <link href="<?php echo base_url("assets") ?>/css/select2-bootstrap4.min.css" rel="stylesheet">
    <script src="<?php echo base_url("assets/lib/") ?>flatpickr/flatpickr.min.js"></script>
    <script src="<?php echo base_url("assets/lib/") ?>flatpickr/es.js"></script>
    <script src="<?php echo base_url("assets/lib/") ?>flatpickr/month-select.js"></script>
    <script src="<?php echo base_url("assets/lib/") ?>flatpickr/confirm-date.js"></script>
    <link href="<?php echo base_url("assets/lib/") ?>flatpickr/flatpickr.min.css" rel="stylesheet">
    <link href="<?php echo base_url("assets/lib/") ?>flatpickr/month-select.css" rel="stylesheet">
    <link href="<?php echo base_url("assets/lib/") ?>flatpickr/confirm-date.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/lib/") ?>flatpickr/airbnb.css">
    <link href="<?php echo base_url("assets") ?>/css/toastr.min.css" rel="stylesheet">
    <script src="<?php echo base_url("assets") ?>/js/toastr.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url("assets/lib/") ?>bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="<?php echo base_url("assets/js/") ?>cropper.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/") ?>cropper.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css"/>
    <style>
        @font-face {
            font-family: 'Circular Std';
            src: url("<?php echo base_url('assets/fonts/circular/'); ?>Circular_Air-Book-1601bfce1c9652eb33ea807d817a30dd.eot");
            src: url("<?php echo base_url('assets/fonts/circular/'); ?>Circular_Air-Book-1601bfce1c9652eb33ea807d817a30dd.eot?#") format("eot"), url("<?php echo base_url('assets/fonts/circular/'); ?>Circular_Air-Book-f016908d84431f0566776240dc8652fc.woff2") format("woff2"), url("<?php echo base_url('assets/fonts/circular/'); ?>Circular_Air-Book-a81fe8415c30ad3049cfb08d3623587d.woff") format("woff"), url("<?php echo base_url('assets/fonts/circular/'); ?>Circular_Air-Book-43e1d462e585f16e90b5d27423fc5d8b.svg") format("svg");
            font-weight: normal;
            font-style: normal
        }
        @font-face {
            font-family: 'Circular Std';
            src: url("<?php echo base_url('assets/fonts/circular/'); ?>Circular_Air-Book_Italic-35e1cf57d93dc4eb3db11cc2448cb91f.eot");
            src: url("<?php echo base_url('assets/fonts/circular/'); ?>Circular_Air-Book_Italic-35e1cf57d93dc4eb3db11cc2448cb91f.eot?#") format("eot"), url("<?php echo base_url('assets/fonts/circular/'); ?>Circular_Air-Book_Italic-4909b413294f9048153d6dee23438b24.woff2") format("woff2"), url("<?php echo base_url('assets/fonts/circular/'); ?>Circular_Air-Book_Italic-1db902f5b85bbb0964e2994434edbe16.woff") format("woff"), url("<?php echo base_url('assets/fonts/circular/'); ?>Circular_Air-Book_Italic-0d9eb203b260869dc2470ae35162fc1e.svg") format("svg");
            font-weight: normal;
            font-style: italic
        }
        @font-face {
            font-family: 'Circular Std';
            src: url("<?php echo base_url('assets/fonts/circular/'); ?>Circular_Air-Bold-44d43ca7b4c3bf5364285df6282fbe52.eot");
            src: url("<?php echo base_url('assets/fonts/circular/'); ?>Circular_Air-Bold-44d43ca7b4c3bf5364285df6282fbe52.eot?#") format("eot"), url("<?php echo base_url('assets/fonts/circular/'); ?>Circular_Air-Bold-c6b068854263ae24ccc36a2b944d7017.woff2") format("woff2"), url("<?php echo base_url('assets/fonts/circular/'); ?>Circular_Air-Bold-0dba9a8cc666f696e92eff76a5d753f1.woff") format("woff"), url("<?php echo base_url('assets/fonts/circular/'); ?>Circular_Air-Bold-9ae13155a0bad6697556e3713a89795b.svg") format("svg");
            font-weight: 700;
            font-style: normal
        }
        @font-face {
            font-family: 'Circular Std';
            src: url("<?php echo base_url('assets/fonts/circular/'); ?>Circular_Air-Light-c4695b2827a2478e391c155781777f66.eot");
            src: url("<?php echo base_url('assets/fonts/circular/'); ?>Circular_Air-Light-c4695b2827a2478e391c155781777f66.eot?#") format("eot"), url("<?php echo base_url('assets/fonts/circular/'); ?>Circular_Air-Light-328fc4c742a91de3477978911e384410.woff2") format("woff2"), url("<?php echo base_url('assets/fonts/circular/'); ?>Circular_Air-Light-f76c67e53b97895a8f31fc8f0246ab7f.woff") format("woff"), url("<?php echo base_url('assets/fonts/circular/'); ?>Circular_Air-Light-d1ee89419dc527be163d0151af5b087e.svg") format("svg");
            font-weight: 200;
            font-style: normal
        }
        @font-face {
            font-family: 'Circular Std';
            src: url("<?php echo base_url('assets/fonts/circular/'); ?>circularstd-medium.eot");
            src: url("<?php echo base_url('assets/fonts/circular/'); ?>circularstd-medium.eot#") format("eot"),
            url("<?php echo base_url('assets/fonts/circular/'); ?>circularstd-medium.woff2") format("woff2"),
            url("<?php echo base_url('assets/fonts/circular/'); ?>circularstd-medium.woff") format("woff"),
            url("<?php echo base_url('assets/fonts/circular/'); ?>circularstd-medium.svg") format("svg");
            font-weight: 500;
            font-style: normal
        }
    </style>

    <script src="https://code.highcharts.com/stock/highstock.js"></script>
</head>
<body>

<div class="loading text-center centered">
    <div style="transform: translateY(50%);" class="h-100">
        <div class="spinner-border centered text-center" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>

<script>
    var BASE_URL = "<?php echo base_url(); ?>";
    let loading = $(".loading");
</script>
