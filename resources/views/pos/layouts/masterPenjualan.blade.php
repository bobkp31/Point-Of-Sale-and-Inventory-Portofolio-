<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="{{ url('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- styles -->
    <link href="{{ url('css/styles.css') }}" rel="stylesheet">
    <!-- custom -->
    <link href="{{ url('css/custom.css') }}" rel="stylesheet">
    <!-- DataTables Css plugins  -->
    {{-- <link href="css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <link href="{{ url('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {{-- <script src="{{ url('js/jquery-3.1.1.min.js') }}"></script>  --}}
    <script src="{{ url('js/jquery.js') }}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ url('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/custom.js') }}"></script>
    <!-- Data tables Jquery plugin-->
    <script src="{{ url('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('js/dataTables.bootstrap.min.js') }}"></script>

    <!-- bootstrap-datetimepicker -->
    <link href="{{ url('vendor/date-picker/datetimepicker.css') }}" rel="stylesheet">
    <script src="{{ url('vendor/date-picker/bootstrap-datetimepicker.js') }}"></script>


  </head>
  <body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.html">Aditiya Mart</a></h1>
	              </div>
	           </div>

             <!-- Anak Barawang -->
             <div class="col-md-5">
	           </div>

	           <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                
	                    </ul>
	                  </nav>
	              </div>
	           </div>

	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
        {{-- Content Here --}}
        @yield('content')
      </div>
    </div>

    <!-- Footer -->
    @include('pos.includes.footer')
  </body>
</html>
