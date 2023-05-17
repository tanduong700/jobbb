 <!--begin::Search-->
 <div class="app-navbar-item align-items-stretch ms-1 ms-md-3">
    <!--begin::Search-->
    @include('layouts.metronic.partials.header.right.seach')
    <!--end::Search-->
</div>
<!--end::Search-->
<!--begin::Activities-->
<div class="app-navbar-item ms-1 ms-md-3">
    <!--begin::Activities-->
     @include('layouts.metronic.partials.header.right.acvities')
    <!--end::Activities-->
</div>
<!--end::Activities-->
<!--begin::Notifications-->
<div class="app-navbar-item ms-1 ms-md-3">
    <!--begin::Menu- wrapper-->
    @livewire('user-notification')
</div>
<!--end::Notifications-->
<!--begin::Chat-->
<div class="app-navbar-item ms-1 ms-md-3">
    <!--begin::Menu wrapper-->
    @include('layouts.metronic.partials.header.right.chat')
    <!--end::Menu wrapper-->
</div>
<!--end::Chat-->
<!--begin::My apps links-->
<div class="app-navbar-item ms-1 ms-md-3">
    <!--begin::Menu wrapper-->
    @include('layouts.metronic.partials.header.right.myApp')
    <!--end::Menu wrapper-->
</div>
<!--end::My apps links-->
<!--begin::Theme mode-->
<div class="app-navbar-item ms-1 ms-md-3">
    <!--begin::Menu-->
    @include('layouts.metronic.partials.header.right.theme')
    <!--end::Menu-->
</div>
<!--end::Theme mode-->
<!--begin::User menu-->
<div class="app-navbar-item ms-1 ms-md-3" id="kt_header_user_menu_toggle">
    <!--begin::Menu wrapper-->
    @include('layouts.metronic.partials.header.right.user')
    <!--end::Menu wrapper-->
</div>
<!--end::User menu-->
