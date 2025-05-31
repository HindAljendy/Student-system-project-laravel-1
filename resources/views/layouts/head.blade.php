<!-- Title -->
<title> Valex -  Premium dashboard ui bootstrap rwd admin html5 template </title>
<!-- Favicon -->
<link rel="icon" href="{{URL::asset('assets/img/brand/favicon.png')}}" type="image/x-icon"/>
<!-- Icons css -->
<link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet">
<!--  Custom Scroll bar-->
<link href="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>

<!--  Sidebar css -->
<link href="{{URL::asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">

<!-- Sidemenu css -->
//!  customise css Style to combitable with arabic and english Css files: in assets (css , css-rtl)
@if (App::getLocale() == 'en')
<link rel="stylesheet" href="{{URL::asset('assets/css/sidemenu.css')}}">
@else
<link rel="stylesheet" href="{{URL::asset('assets/css-rtl/sidemenu.css')}}">
@endif@yield('css')

<!--- Style css -->
//! css wizard 
<link href="{{URL::asset('wizard/wizard.css')}}" rel="stylesheet" id="bootstrap-css">

//!  customise css Style to combitable with arabic and english Css files: in assets (css , css-rtl)
@if (App::getLocale() == 'en')
<link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet">
@else
<link href="{{URL::asset('assets/css-rtl/style.css')}}" rel="stylesheet">
@endif


<!--- Dark-mode css -->
<link href="{{URL::asset('assets/css-rtl/style-dark.css')}}" rel="stylesheet">
<!---Skinmodes css-->
<link href="{{URL::asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet">