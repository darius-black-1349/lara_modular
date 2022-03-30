@extends('User::Front.master')


@section('content')

    @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{  session('status')  }}
        </div>
    @endif

    <form action="{{  route('password.sendVerifyCodeEmail')  }}" class="form">
        <a class="account-logo" href="/">
            <img src="{{  asset('img/weblogo.png')  }}" alt="">
        </a>
        <div class="form-content form-account">
            <input type="email"
                   name="email"
                   class="txt-l txt  @error('email') is-invalid @enderror" value="{{  old('email')  }}"
                   required
                   autocomplete="email"
                   autofocus
                   placeholder="ایمیل"
            >

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{  $message  }}</strong>
                </span>
            @enderror
            <br>
            <button type="submit" class="btn btn-recoverpass">بازیابی</button>
        </div>
        <div class="form-footer">
            <a href="{{  route('login')  }}">صفحه ورود</a>
        </div>
    </form>
@endsection
