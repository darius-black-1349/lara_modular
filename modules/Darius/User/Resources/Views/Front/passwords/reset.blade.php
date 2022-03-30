@extends('User::Front.master')


@section('content')

    <form action="{{  route('password.update')  }}" method="POST" class="form">
        @csrf

        <a class="account-logo" href="/">
            <img src="{{  asset('img/weblogo.png')  }}" alt="">
        </a>

        <div class="form-content form-account">

            <input
                class="txt txt-l @error('password') is-invalid @enderror"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="رمز عبور جدید"
            >


            <input
                class="txt txt-l"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder=" تایید رمز عبور جدید"
            >

            <span class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.</span>
            @error('password')
            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
            @enderror

            <br>
            <button class="btn continue-btn">تغییر رمز عبور</button>
        </div>


    </form>

@endsection
