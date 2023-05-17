@extends('layouts.metronic.guest')
@section('title', 'Tài khoản đã bị khóa')
@section('content')
    <div class="card card-flush ">
        <div class="card-body d-flex flex-column flex-center text-center">
            <h1 class="fw-bolder fs-2hx text-gray-900 mb-4">
                Oops!
            </h1>
            <div class="fw-semibold fs-6 text-gray-400 mb-9">
                Tài khoản đã bị khóa
            </div>
            <div class="mb-9">
                <img src="/assets/media/error/loi-401-1.jpg" class="mw-100 mh-300px ">
            </div>
            <div class="mb-2">
                <form method="POST" action="{{ route('logout') }}" class="menu-link px-5" x-data>
                    @csrf
                    <button href="#" class="btn btn-primary px-5" type="submit">Quay lại</button>
                </form>
            </div>
            <!--end::Link-->

        </div>
    </div>
@endsection
