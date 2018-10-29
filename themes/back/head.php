<meta charset="utf-8">
<title> Dinas Pem. Desa</title>
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="shortcut icon" href="<?= linkLogoKab($row_din->logo); ?>" type="image/x-icon">
<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>assets/css/smartadmin-production-plugins.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>assets/css/smartadmin-production.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>assets/css/smartadmin-skins.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>assets/css/smartadmin-rtl.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>assets/css/demo.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>assets/css/color.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>assets/css/lockscreen.min.css">
<!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/croppie.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/error.css" />
<!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap.min.css" />-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/froala_style.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/froala_editor.pkgd.min.css" />
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">--> 

<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />-->
<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />-->
<style> 
    /*@import url(https://fonts.googleapis.com/css?family=Quicksand);*/
    body.smart-style-3 #logo-group>span#logo:before{font-size:17px;color:#fff;font-weight:300;margin-top:1px;display:block}
    html {
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    .table-borderless > tbody > tr > td,
    .table-borderless > tbody > tr > th,
    .table-borderless > tfoot > tr > td,
    .table-borderless > tfoot > tr > th,
    .table-borderless > thead > tr > td,
    .table-borderless > thead > tr > th {
        border: none;
    }
    #main #content{
        height:100%;
    }

    .smart-style-3 .btn-header>:first-child>a{background:#1264ed;border:1px solid #fff;color:#fff!important;cursor:pointer!important}
    select.select2{
        position: static !important;
        outline:none !important;
    }
    #main{
        background-image: url('<?php echo base_url(); ?>assets/img/mybg.png') !important; 
        background-size: auto;
        -webkit-background-size: 100% 100%;
        /*background-repeat : no-repeat;*/
        background-attachment:fixed ; 
        min-height: calc(100vh - 5em);
        overflow: auto;
        overflow-x: hidden;
        overflow-y: hidden;
    }
    .form-check{
        display:inline-block; 
        position:relative; 
        width:40px; 
        height:20px;
    }
    .form-radio{
        display:inline-block; 
        position:relative; 
        width:30px; 
        height:20px;
    }
    .ajax-loader {
        visibility: hidden;
        background-color: rgba(255,255,255,0.7);
        position: absolute;
        z-index: +100 !important;
        width: 100%;
        height:100%;
    }

    .ajax-loader img {
        position: relative;
        top:50%;
        left:50%;
    }

    #notiv {
        width: 40%;
        position: absolute;
        z-index: 999;
    }

    #notivs {
        width: 50%;
        position: absolute;
        z-index: 999;
        top: 10px;
        right: 10px;
    }

    .table thead tr th 
    {
        text-align:center ;
        vertical-align: top;
        background-color:#A6A4A4;
        color:#000;
        font-weight: bold;
    }

    note{
        font-size: 8pt;
    }

    .table tfoot tr th 
    {
        text-align:center ;
        vertical-align: top;
        background-color:#dedede;
        color:#000;
        font-weight: bold;
    }
    
    .table tbody tr td
    {
        vertical-align: top;
        color:#000;
        font-size: 10pt
    }

    #garis_1{
        border-style:solid;
    }

    .modal-header{
        background-color: #e89002
    }
    .modal-footer{
        background-color: #e89002
    }
    .btn-success{
        background-color:#5a995a;
        color:#000;
        border: 1px solid
    }

    .numberCircle {
        border-radius: 50%;
        behavior: url(PIE.htc);
        /* remove if you don't care about IE8 */
        width: 20px;
        height: 20px;
        padding: 1px;
        background: #ededed;
        border: 2px solid #dedede;
        color: #000;
        text-align: center;
        font: 11pt Arial, sans-serif;
    }

    /*    td
    {
        font-size: 10pt;
    }*/
    /*    .table{
            border: 1px solid;
        }*/
    .active {background-color:#ededed};
    .bag1{background:#000;opacity:0.4;filter:alpha(opacity=40);}
    .bag2 {background:rgba(0,0,0,0.4);}
    .bg {  background: #F0FFFF;}
    .bag { background-color:rgba(255,255,255,0.8);}
    body { font-family: Arial;
           color:#000000; }
    .row-table {
        display: table;
        border-radius: 10px;
        border-radius: 10px;
        table-layout: fixed;
        width: 100%;
        height: 100%;
    }
    .group {
        display: block;
        margin-bottom: 1.5em
    }

    input {
        border: 2px solid #ddd;
        border-radius:4px;
        font-family: 'Roboto', Arial, Sans-serif;
        font-size: 16px;
        outline: none;
        padding: .5em 1em;
    }

    .btn-default{
        border: solid 2px; 
        border-color: #dedede;
    }

    .preloader {
        /*        background: url(https://2.bp.blogspot.com/-gwEckHVvyvM/VnbiQdPPZSI/AAAAAAAADcE/wwKnP62ARpc/s1600/loading.gif) no-repeat center;*/
        /*background: url(<?= base_url('assets/img/ajax-loader.gif'); ?>) no-repeat center;*/
        background-color: rgba(0, 0, 0, 0.36);
        width: 100%;
        height: 100%;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1000;
    }
    .preloader .loading {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
        font: 14px arial;
    }

    input[data-readonly] {
        pointer-events: none;
    }

    td {
        padding: 5px;
        font-size: 11pt;
    }
    th {
        padding: 5px ;
        font-size: 11pt;
    }

    table, table .main {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
    }
    table, table .main tr th {
        font-size: 11pt;
    }
    .center { text-align: center;}
    .putus { border-bottom: 1px dotted #666; border-top: 1px dotted #666; }
    .bawah { border-bottom: 0px ; }
    .atas { border-top: 0px ; }
    .kanan { border-right: 0px ; }
    .kiri { border-left: 0px ; }
    .all { border: 1px solid #666; }
</style>