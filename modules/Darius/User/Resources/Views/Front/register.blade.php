@extends('User::Front.master')


@section('content')
    <form  action="{{  route('register')  }}" class="form" method="post">
        @csrf
    <a class="account-logo" href="index.html">
        <img src="{{  asset('img/weblogo.png')  }}" alt="">
    </a>
    <div class="form-content form-account">

        <input type="text"  class="txt @error('name') is-invalid @enderror"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       autocomplete="name"
                       autofocus
                       placeholder="نام و نام خانوادگی"
                >
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                <input type="email"
                       class="txt txt-1 @error('email') is-invalid @enderror"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autocomplete="email"
                       placeholder="ایمیل"
                >

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                <input type="mobile"
                       class="txt txt-1 @error('mobile') is-invalid @enderror"
                       type="text"
                       name="mobile"
                       value="{{ old('mobile') }}"
                       autocomplete="mobile"
                       placeholder="موبایل"
                >

                @error('mobile')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror

                <input
                       class="txt txt-l @error('password') is-invalid @enderror"
                       type="password"
                       name="password"
                       required
                       autocomplete="new-password"
                       placeholder="رمز عبور"
                >


                <input
                    class="txt txt-l"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder=" تایید رمز عبور"
                >

                <span class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.</span>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror


                <br>
                <button class="btn continue-btn">ثبت نام و ادامه</button>

    </div>
    <div class="form-footer">
        <a href="{{  route('login')  }}">صفحه ورود</a>
    </div>
</form>
@endsection
