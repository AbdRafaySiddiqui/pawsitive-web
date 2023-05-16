<!DOCTYPE html>
<html>
  <head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="Pawsitiv Website Admin Panel" name="keywords">
    <meta content="Inspedium Corporation PVT LTD" name="author">
    <meta content="Pawsitiv Web Admin Panel" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="{{ asset('public/favicon.png') }}" rel="shortcut icon">
    {{-- <link href="apple-touch-icon.png" rel="apple-touch-icon"> --}}
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <link href="{{ asset('public/bower_components/dropzone/dist/dropzone.css')}}" rel="stylesheet">
    {{-- <link href="{{ asset('public/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"> --}}
    <link href="{{ asset('public/bower_components/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/bower_components/slick-carousel/slick/slick.css')}}" rel="stylesheet">
    <link href="{{ asset('public/css/main.css?version=4.4.0')}}" rel="stylesheet">
  </head>
  <body class="auth-wrapper">
    @yield('content')
  </body>
</html>
