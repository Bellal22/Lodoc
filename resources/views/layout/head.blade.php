@php
session()->regenerate();
if(Session('id')==null){
    
return redirect('/');

}else{

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>لودوك - لوحة تحكم التطبيق </title>
    <link href={{asset("css/bootstrap.min.css")}} rel="stylesheet">
    <meta name="google-site-verification" content="hYgsIi14Fac8-Pvr4_rt7oshb94W4dfW2tDaZmtiv4c"/>
    <!-- MetisMenu CSS -->
    <link href={{asset("css/plugins/metisMenu/metisMenu.min.css")}} rel="stylesheet">

    <!-- Timeline CSS -->
    <link href={{asset("css/plugins/timeline.css")}} rel="stylesheet">

    <!-- Custom CSS -->
    <link href={{asset(("css/sb-admin-2.css"))}} rel="stylesheet">
    <link href={{asset(("css/adminpanel.css"))}} rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href={{asset("css/plugins/morris.css")}} rel="stylesheet">

    <!-- Custom Fonts -->
    <link href={{asset("vendor/font-awesome-4.7.0/css/font-awesome.min.css")}} rel="stylesheet" type="text/css">

    {{--vue element--}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    {{--<link rel="stylesheet" href="//unpkg.com/element-ui/lib/theme-chalk/index.css">--}}
    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
    <link rel="stylesheet" href="//unpkg.com/element-ui@2.3.9/lib/theme-chalk/index.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->




</head>
<body>
@php

@endphp