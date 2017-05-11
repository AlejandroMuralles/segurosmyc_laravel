<html>
<head>  
	<link href="{{asset('assets/css/core.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/components.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/custom_reports.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/tables.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
	<style>
	    @page { margin: 125px 50px; }
    	#header { position: fixed; left: 0px; top: -125px; right: 0px; height: 100px; text-align: center; padding-top: 10px;}
    	#footer { position: fixed; left: 0px; bottom: -100px; right: 0px; height: 75px; text-align: center; display: block; font-size: 12px}
    	#footer .page:after { content: counter(page); }
    	.logo { float: left; height: 100px;  }
    	.table-bordered td { border-top: 1px solid #ddd !important; border-bottom: 1px solid #ddd !important; width: 8.33% }
    	.table-bordered td, th {border-color: black !important}
    	.table { margin: 0; }
    	body { background: white; }
	</style>
	@yield('css')
</head>
<body>
<div id="header">
	<img src="{{asset('assets/images/logo_sm.png')}}" class="logo" style="vertical-align: middle;">
	<h1>@yield('title')</h1>
</div>
<div id="footer">
	<p style="font-weight: bold;">
		"La respuesta amiga a tu confianza" <br/>
		12 calle 2-04 zona 9, Edificio Plaza del sol, 1er. Nivel, Oficina 107 PBX: 2360-9686 - FAX: 2381-8738
	</p>
</div>
@yield('content')
@yield('js')
</body>
</html>