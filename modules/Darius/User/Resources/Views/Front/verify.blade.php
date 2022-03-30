@extends('User::Front.master')

@section('content')

    <div class="account act">
        <form action="{{  route('verification.verify')  }}" class="form" method="post">
            @csrf
            <a class="account-logo" href="/">
                <img src="{{  asset('img/weblogo.png')  }}" alt="">
            </a>
            <div class="card-header">
                <p class="activation-code-title">کد فرستاده شده به ایمیل  <span>darius134966@gmail.com</span>
                    را وارد کنید . ممکن است ایمیل به پوشه spam فرستاده شده باشد
                </p>
            </div>
            <div class="form-content form-content1">
                <input name="verify_code" required class="activation-code-input @error('verify_code') is-invalid @enderror" placeholder="فعال سازی">

                @error('verify_code')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
                <br>
                <button class="btn i-t">تایید</button>
                <a href="" onclick="event.preventDefault(); document.querySelector('#resend-code').submit();">ارسال مجدد کد</a>

            </div>
            <div class="form-footer">
                <a href="{{  route('register')  }}">صفحه ثبت نام</a>
            </div>
        </form>

        <form action="{{  route('verification.resend')  }}" method="POST" id="resend-code">
            @csrf
        </form>
    </div>

@endsection

@section('scripts')
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/activation-code.js"></script>
@endsection
