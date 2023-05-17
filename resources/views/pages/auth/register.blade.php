@extends('layouts.metronic.guest')
@section('title', __('Đăng kí'))
@section('content')
    <div class="card rounded-3 w-md-400px mx-auto">
        <div class="card-body d-flex flex-column">
            <div class="d-flex flex-center flex-column-fluid ">
                <form method="POST" action="{{ route('register') }}" class="form w-100">
                    @csrf
                    <div class="text-center mb-11">

                        <h1 class="text-dark fw-bolder mb-3">Đăng ký</h1>
                    </div>
                    <div class="fv-row mb-8">
                        <input type="text" placeholder="Tên" name="name" autocomplete="Nhập tên"
                            class="form-control bg-transparent @error('name') is-invalid @enderror" />
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="fv-row mb-8">
                        <input type="text" placeholder="Email" name="email" autocomplete="Nhập email"
                            class="form-control bg-transparent @error('email') is-invalid @enderror" />
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="fv-row mb-8" data-kt-password-meter="true">
                        <div class="mb-1">
                            <div class="position-relative mb-3">
                                <input type="password" placeholder="Password" name="password" autocomplete="Nhập mật khẩu"
                                    class="form-control bg-transparent @error('password') is-invalid @enderror" />
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                </div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                </div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                </div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                            </div>
                        </div>
                    </div>
                    <div class="fv-row mb-8">
                        <input type="password" placeholder="Repeat password" name="password_confirmation"
                            autocomplete="Nhập mật khẩu"
                            class="form-control bg-transparent @error('password_confirmation') is-invalid @enderror" />
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-grid mb-10">
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Đăng kí</span>
                            <span class="indicator-progress">Đang tải...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <div class="text-gray-500 text-center fw-semibold fs-6">bạn đã có tài khoản đăng nhập?
                        <a href="{{ route('login') }}" class="link-primary fw-semibold">Đăng nhập</a>
                    </div>
                </form>
            </div>
            <div class="w-lg-500px d-flex flex-stack">
                <!--begin::Languages-->
                <div class="me-10">
                    <button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base"
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
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
                                    <img data-kt-element="lang-flag" class="rounded-1" src="assets/media/flags/spain.svg"
                                        alt="" />
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
                                    <img data-kt-element="lang-flag" class="rounded-1" src="assets/media/flags/japan.svg"
                                        alt="" />
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
