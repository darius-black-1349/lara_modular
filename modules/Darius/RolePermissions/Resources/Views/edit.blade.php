@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{  route('role-permissions.index')  }}" title="نقش های کاربری ">نقش های کاربری</a></li>
    <li><a href="#" title="ویرایش نقش کاربری">ویرایش نقش کاربری</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-6 bg-white">
            <p class="box__title">ویرایش نقش کاربری </p>
            <form action="{{  route('role-permissions.update', $role->id)  }}" method="post" class="padding-30">
                @csrf
                @method('patch')
                <input type="hidden" name="id" value="{{ $role->id }}">
                <input type="text" name="name" required placeholder="نام نقش کاربری"
                       class="text @error('name') is-invalid @enderror" value="{{  $role->name  }}">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{  $message  }}</strong>
                    </span>
                @enderror
                <p class="box__title margin-bottom-15">انتخاب مجوز ها</p>

                @foreach($permissions as $permission)
                    <label class="ui-checkbox" style="padding-top: 10px;">
                        <input type="checkbox" name="permissions[{{  $permission->name  }}]"
                               class="sub-checkbox" data-id="2" value="{{  $permission->name  }}"
                               @if( $role->hasPermissionTo($permission->name) )
                               checked
                            @endif
                        >
                        <span class="checkmark"></span>
                        <p style="padding-right: 10px;">@lang($permission->name)</p>
                    </label>
                @endforeach

                @error('permissions')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{  $message  }}</strong>
                    </span>
                @enderror

                <hr>

                <button class="btn btn-brand" style="margin-top: 10px;">ویرایش</button>
            </form>
        </div>
    </div>
@endsection
