
<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 9 & VueJS Admin Dashboard Theme
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
	<head><base href="">
		<meta charset="utf-8" />
		<title>Home</title>
		@yield('token')
		<meta name="description" content="Updates and statistics" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendors Styles(used by this page)-->
		<link href="{{asset('demo8/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.3')}}" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="{{asset('demo8/dist/assets/plugins/global/plugins.bundle.css?v=7.0.3')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('demo8/dist/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.3')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('demo8/dist/assets/css/style.bundle.css?v=7.0.3')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="{{asset('demo8/dist/assets/media/logos/favicon.ico')}}" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed subheader-enabled page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--begin::Header Mobile-->
					<div id="kt_header_mobile" class="header-mobile">
						<!--begin::Logo-->
						<a href="index.html">
							<img alt="Logo" src="{{asset('demo8/dist/assets/media/logos/logo-default.png')}}" class="max-h-30px" />
						</a>
						<!--end::Logo-->
						<!--begin::Toolbar-->
						<div class="d-flex align-items-center">
							<button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
								<span></span>
							</button>
							<button class="btn p-0 ml-2" id="kt_header_mobile_topbar_toggle">
								<span class="svg-icon svg-icon-xl">
									<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24" />
											<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
											<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
										</g>
									</svg>
									<!--end::Svg Icon-->
								</span>
							</button>
						</div>
						<!--end::Toolbar-->
					</div>
					<!--end::Header Mobile-->
					<!--begin::Header-->
					<div id="kt_header" class="header header-fixed">
						<!--begin::Container-->
						<div class="container">
							<!--begin::Left-->
							<div class="d-none d-lg-flex align-items-center mr-3">
								<!--begin::Logo-->
								<a href="index.html" class="mr-20">
									<img alt="Logo" src="{{asset('demo8/dist/assets/media/logos/logo-default.png')}}" class="logo-default max-h-35px" />
								</a>
								<!--end::Logo-->
							</div>
							<!--end::Left-->
							<!--begin::Topbar-->
							<div class="topbar topbar-minimize">
								
								<!--begin::User-->
								<div class="dropdown">
									<!--begin::Toggle-->
									<div class="topbar-item" data-toggle="dropdown" data-offset="0px,0px">
										<div class="btn btn-icon btn-clean h-40px w-40px btn-dropdown">
											<span class="svg-icon svg-icon-lg">
												<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<polygon points="0 0 24 0 24 24 0 24" />
														<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
														<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>
										</div>
									</div>
									<!--end::Toggle-->
									<!--begin::Dropdown-->
									<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg p-0">
										<!--begin::Header-->
										<div class="d-flex align-items-center p-8 rounded-top">
											<!--begin::Symbol-->
											<div class="symbol symbol-md bg-light-primary mr-3 flex-shrink-0">
												<!-- <img src="{{asset('demo8/dist/assets/media/users/300_21.jpg')}}" alt="" /> -->
                                                <img src="" alt="" id="profile_photo"/>
											</div>
											<!--end::Symbol-->
											<!--begin::Text-->
											<div class="text-dark m-0 flex-grow-1 mr-3 font-size-h5">
                                                @if(Session::has('name'))
                                                    {{Session('name')}}
                                                @endif
                                            </div>
											
											<!--end::Text-->
										</div>
										<div class="separator separator-solid"></div>
										<!--end::Header-->
										<!--begin::Nav-->
										<div class="navi navi-spacer-x-0 pt-5">
											<!--begin::Item-->
											<a href="/myprofileview" class="navi-item px-8">
												<div class="navi-link">
													<div class="navi-icon mr-2">
														<i class="flaticon2-calendar-3 text-success"></i>
													</div>
													<div class="navi-text">
														<div class="font-weight-bold">My Profile</div>
														<!-- <div class="text-muted">Account settings and more -->
														<span class="label label-light-danger label-inline font-weight-bold">update</span>
                                                    <!-- </div> -->
													</div>
												</div>
											</a>
											<!--end::Item-->
											
											<!-- begin:: notification -->
											<a href="/mypendingtasks" class="navi-item px-8">
												<div class="navi-link">
												<div class="navi-icon mr-2">
                									<i class="flaticon2-hourglass text-primary"></i>
           										 </div>
													<div class="navi-text">
														<div class="font-weight-bold">Pending Tasks</div>
														<div class="text-muted">Inbox</div>
													</div>
												</div>
											</a>
											<!-- end:: notification -->
											<!--begin::Footer-->
											<div class="navi-separator mt-3"></div>
											<div class="navi-footer px-8 py-5">
												<a href="/logout"  class="btn btn-light-primary font-weight-bold">Sign Out</a>
											</div>
											
											<!--end::Footer-->
										</div>
										<!--end::Nav-->
										
									</div>
									<!--end::Dropdown-->
								</div>
								<!--end::User-->
							</div>
							<!--end::Topbar-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->
					<!--begin::Header Menu Wrapper-->
					<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
						<div class="container">
							<!--begin::Header Menu-->
							<div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default header-menu-root-arrow">
								<!--begin::Header Nav-->
								<ul class="menu-nav">
									<li class="menu-item 
									@if(Request::is('home')) 
									  menu-item-open menu-item-here 
									  @endif"  aria-haspopup="true">
										<a href="/home" class="menu-link ">
											<span class="menu-text">Dashboard</span>
											
										</a>
										
									</li>
									<li class="menu-item 
									@if(Request::is('blogs')) mmenu-item-open menu-item-here
									@endif"  aria-haspopup="true">
										<a href="/blogs" class="menu-link">
											<span class="menu-text">Blogs</span>
											
										</a>
										
									</li>
									<li class="menu-item 
									@if(Request::is('tags')) menu-item-open menu-item-here
									@endif"  aria-haspopup="true">
										<a href="/tags" class="menu-link ">
											<span class="menu-text">Tags</span>
											
										</a>
										
									</li>

									@role('admin')

									<li class="menu-item 
									@if(Request::is('users')) menu-item-open menu-item-here
									@endif"  aria-haspopup="true">
										<a href="/users" class="menu-link ">
											<span class="menu-text">Users</span>
										</a>
										
									</li>
									@endrole
								</ul>
								<!--end::Header Nav-->
							</div>
							<!--end::Header Menu-->
						</div>
					</div>
					<!--end::Header Menu Wrapper-->
					<!--begin::Container-->
					<div class="d-flex flex-row flex-column-fluid container">
						<!--begin::Content Wrapper-->
						<div class="main d-flex flex-column flex-row-fluid">
							
							<div class="content flex-column-fluid" id="kt_content">
								<!--begin::Dashboard-->
													
								
							    @yield('content')
								
								
								<!--end::Dashboard-->
							</div>
							<!--end::Content-->
						</div>
						<!--begin::Content Wrapper-->
					</div>
					<!--end::Container-->
					
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Main-->
		
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop">
			<span class="svg-icon">
				<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
						<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
					</g>
				</svg>
				<!--end::Svg Icon-->
			</span>
		</div>
		<!--end::Scrolltop-->
		
        <!-- jquey cdn -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		
		<script>var HOST_URL = "https://keenthemes.com/metronic/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#8950FC", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#6993FF", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#EEE5FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#E1E9FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="{{asset('demo8/dist/assets/plugins/global/plugins.bundle.js?v=7.0.3')}}"></script>
		<script src="{{asset('demo8/dist/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.3')}}"></script>
		<script src="{{asset('demo8/dist/assets/js/scripts.bundle.js?v=7.0.3')}}"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Vendors(used by this page)-->
		<script src="{{asset('demo8/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.3')}}"></script>
		<!--end::Page Vendors-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="{{asset('demo8/dist/assets/js/pages/widgets.js?v=7.0.3')}}"></script>
		<!--end::Page Scripts-->
		<script src="{{asset('demo8/dist/assets/js/pages/crud/file-upload/image-input.js?v=7.2.9')}}"></script>
        <script src="{{asset('scripts/all-page.js')}}"></script>

        @yield('script')
	</body>
	<!--end::Body-->
</html>