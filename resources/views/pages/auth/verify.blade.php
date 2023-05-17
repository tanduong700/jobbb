@extends('layouts.metronic.guest')
@section('title', 'Xác thực email')
@section('content')
    <div class="card card-flush">
        <div class="card-body d-flex flex-column flex-center text-center">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <div class="mb-14">
                    <a href="/assets/demo1/index.html" class="">
                        <img alt="Logo" src="/assets/media/logos/custom-2.svg" class="h-30px">
                    </a>
                </div>

                <h1 class="fw-bolder text-gray-900 mb-5">
                    Xác nhận email của bạn
                </h1>

                <div class="fs-6 mb-7">
                    <span class="fw-semibold text-gray-500">Không nhận được email?</span>

                    <a href="" class="link-primary fw-bold">
                        Thử lại</a>
                </div>

                <button type="submit" class="btn btn-primary me-2">
                    <span class="indicator-label">nhận email</span>
                </button>


                <div class="mb-0">
                    <img src="/assets/media/auth/please-verify-your-email.png" class="mw-100 mh-250px theme-light-show"
                        alt="">
                    <img src="/assets/media/auth/please-verify-your-email-dark.png" class="mw-100 mh-250px theme-dark-show"
                        alt="">
                </div>

            </form>
        </div>

    </div>
@endsection
