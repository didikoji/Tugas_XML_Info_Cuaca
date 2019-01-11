<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Weather</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>W</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Weather</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->


      <!-- search form (Optional) -->

      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- Optionally, you can add icons to the links -->
        <li><a href="?halaman=current"><i class="fa fa-sun-o"></i> <span>Informasi Cuaca</span></a></li>
        <li><a href="?halaman=perkiraan"><i class="fa fa-sun-o"></i> <span>Perkiraan Cuaca</span></a></li>
        <!-- <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li> -->
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <?php

            if ( !isset( $_GET['halaman'] ) || $_GET['halaman'] === 'current' )
            {
              include 'halaman/current.php';
            }
            if ( isset($_GET['halaman']) && $_GET['halaman']  = 'perkiraan' )
            {
              include 'halaman/perkiraan.php';
            }

        ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->


  <!-- Control Sidebar -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script>

    $('#currentweather').submit(function(e)
    {
        e.preventDefault();
        let kota = $('#kota').val();
        let urlApi = "http://api.openweathermap.org/data/2.5/weather?q="+kota+"&appid=b518e0578a7cf635ad59824beea04f80&units=metric"
        $.ajax({
          url: urlApi,
          type: "POST",
          dataType: "JSON",
          success: function(data)
          {
            $('#namakota').html("Informasi Cuaca di "+data.name);
            $('#suhu').html(": " + data.main.temp + "&deg;C");
            $('#tekanan').html(": " +data.main.pressure);
            $('#kelembaban').html(": " +data.main.humidity);
            $('#cuaca').html(": " +data.weather[0].main);
            $('#icon').attr("src", "http://openweathermap.org/img/w/"+ data.weather[0].icon +".png");
          }
        });
    });

    $('#pilihkotaperkiraan').submit(function(e)
    {
        e.preventDefault();

        let kota = $('#kotaperkiraan').val();
        let urlApi = "http://api.openweathermap.org/data/2.5/forecast?q="+kota+"&appid=b518e0578a7cf635ad59824beea04f80&units=metric";
        $.ajax({
          url: urlApi,
          type: "POST",
          dataType: "JSON",
          success: function(data)
          {
            let output="";
            let no = 0;
            let urlImage = "http://openweathermap.org/img/w/";
            $('#namakotaperkiraancuaca').html( "Kota " + data.city.name );
            for (let i = 0; i < data.list.length; i++) {
              output += "<tr>";
              output += "<td>"+ data.list[i].dt_txt +"</td>";
              output += "<td>"+data.list[i].weather[0].main+ " <img src='"+ urlImage + data.list[i].weather[0].icon + ".png'>" +"</td>";
              output += "<td>"+data.list[i].main.temp+"&deg;C</td>";
              output += "<td>"+data.list[i].main.humidity+"</td>";
              output += "</tr>";
            }
            
            $('#informasiperkiraan').html(output);
          }
        });
    });
</script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>