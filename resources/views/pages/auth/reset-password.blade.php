@extends('layouts.metronic.guest')
@section('title', __('Đổi mật khẩu'))
@section('content')
    <div class="card rounded-3 w-md-400px mx-auto">
        <div class="card-body d-flex flex-column">
            <div class="d-flex flex-center flex-column-fluid ">
                <form method="POST" action="{{ route('password.update') }}" class="form w-100">
                    @csrf
                    <div class="text-center mb-11">
                        <h1 class="text-dark fw-bolder mb-3">Tạo lại mật khẩu</h1>
                    </div>
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="fv-row mb-8" data-kt-password-meter="true">
                        <div class="fv-row mb-8">
                            <input id="name"  type="text" class="form-control bg-transparent" placeholder="Email" name="email"
                             :value="old('email', $request->email)" required autofocus/>
                        </div>
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
                            <span class="indicator-label">Đổi mật khẩu</span>
                            <span class="indicator-progress">Đang tải...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
