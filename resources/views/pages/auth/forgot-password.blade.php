@extends('layouts.metronic.guest')
@section('title', __('Quên mật khẩu'))
@section('content')
<div class="card rounded-3 w-md-400px mx-auto">
<!--begin::Card body-->
<div class="card-body d-flex flex-column ">
    <!--begin::Wrapper-->
    <div class="d-flex flex-center flex-column-fluid">
        <!--begin::Form-->
        <form method="POST" action="{{ route('password.email') }}" class="form w-100">
            @csrf
            <!--begin::Heading-->
            <div class="text-center mb-11">
                <div class="symbol symbol-70px symbol-circle ">
                    <img src="/assets/media/logos/favicon.ico" alt="" />
                </div>
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder mb-5">Quên mật khẩu</h1>
                <!--end::Title-->
                <!--begin::Link-->
                <div class="text-gray-500 fw-semibold fs-6">Nhập email của bạn để thiết lập lại mật khẩu.
                </div>
                <!--end::Link-->
            </div>
            <!--begin::Heading-->
            <!--begin::Input group=-->
            <div class="fv-row mb-8">
                <!--begin::Email-->
                <input type="text" placeholder="Email" name="email" autocomplete="Nhập email"
                class="form-control bg-transparent @error('email') is-invalid @enderror" />
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
                <!--end::Email-->
            </div>
            <!--begin::Actions-->
            <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                <button type="submit" id="kt_password_reset_submit" class="btn btn-primary me-4">
                    <!--begin::Indicator label-->
                    <span class="indicator-label">Đổi mật khẩu</span>
                    <!--end::Indicator label-->
                    <!--begin::Indicator progress-->
                    <span class="indicator-progress">Please wait...
                        <span
                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    <!--end::Indicator progress-->
                </button>
                <a href="{{ route('login') }}"
                    class="btn btn-light">Cancel</a>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Wrapper-->
    <!--begin::Footer-->
    <div class="w-lg-500px d-flex flex-stack">
        <!--begin::Languages-->
        <div class="me-10">
            <!--begin::Toggle-->
            <button
                class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base"
                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                data-kt-menu-offset="0px, 0px">
                <img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3"
                    src="assets/media/flags/united-states.svg" alt="" />
                <span data-kt-element="current-lang-name" class="me-1">English</span>
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                <span class="svg-icon svg-icon-5 svg-icon-muted rotate-180 m-0">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                            fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </button>
            <!--end::Toggle-->
            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7"
                data-kt-menu="true" id="kt_auth_lang_menu">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link d-flex px-5" data-kt-lang="English">
                        <span class="symbol symbol-20px me-4">
                            <img data-kt-element="lang-flag" class="rounded-1"
                                src="assets/media/flags/united-states.svg" alt="" />
                        </span>
                        <span data-kt-element="lang-name">English</span>
                    </a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link d-flex px-5" data-kt-lang="Spanish">
                        <span class="symbol symbol-20px me-4">
                            <img data-kt-element="lang-flag" class="rounded-1"
                                src="assets/media/flags/spain.svg" alt="" />
                        </span>
                        <span data-kt-element="lang-name">Spanish</span>
                    </a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link d-flex px-5" data-kt-lang="German">
                        <span class="symbol symbol-20px me-4">
                            <img data-kt-element="lang-flag" class="rounded-1"
                                src="assets/media/flags/germany.svg" alt="" />
                        </span>
                        <span data-kt-element="lang-name">German</span>
                    </a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link d-flex px-5" data-kt-lang="Japanese">
                        <span class="symbol symbol-20px me-4">
                            <img data-kt-element="lang-flag" class="rounded-1"
                                src="assets/media/flags/japan.svg" alt="" />
                        </span>
                        <span data-kt-element="lang-name">Japanese</span>
                    </a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link d-flex px-5" data-kt-lang="French">
                        <span class="symbol symbol-20px me-4">
                            <img data-kt-element="lang-flag" class="rounded-1"
                                src="assets/media/flags/france.svg" alt="" />
                        </span>
                        <span data-kt-element="lang-name">French</span>
                    </a>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Languages-->
    </div>
    <!--end::Footer-->
</div>
<!--end::Card body-->
</div>
@endsection
