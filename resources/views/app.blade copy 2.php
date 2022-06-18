<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<!-- begin::Head -->
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
        @inertiaHead
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700","Asap+Condensed:500"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<!--end::Web font -->
        <!--begin::Base Styles -->
        <!--begin::Page Vendors -->
		<link href="assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors -->
		<link href="assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/demo/demo8/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="assets/demo8/demo/media/img/logo/favicon.ico" />
	</head>
	<!-- end::Head -->
    <!-- end::Body -->
	<body style="background-image: url(assets/app/media/img/bg/bg-7.jpg)"  class="m-page--fluid m-page--loading-enabled m-page--loading m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default"  >
        <!-- begin::Page loader -->
        <div class="m-page-loader m-page-loader--base">
            <div class="m-blockui">
                <span>
                    Please wait...
                </span>
                <span>
                    <div class="m-loader m-loader--brand"></div>
                </span>
            </div>
        </div>
        <!-- end::Page Loader -->
        @inertia

        @env ('local')
            <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
        @endenv
		<!-- begin::Quick Nav -->
    	<!--begin::Base Scripts -->
		<script src="assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="assets/demo/demo8/base/scripts.bundle.js" type="text/javascript"></script>
		<!--end::Base Scripts -->
        <!--begin::Page Vendors -->
		<script src="assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
		<!--end::Page Vendors -->
        <!--begin::Page Snippets -->
		<script src="assets/app/js/dashboard.js" type="text/javascript"></script>
		<!--end::Page Snippets -->
        <!-- begin::Page Loader -->
		<script>
            $(window).on('load', function() {
                $('body').removeClass('m-page--loading');
            });
		</script>
		<!-- end::Page Loader -->
	</body>
	<!-- end::Body -->
</html>
