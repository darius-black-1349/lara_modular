<p class="box__title">ایجاد نقش کاربری جدید</p>
<form action="{{  route('role-permissions.store')  }}" method="post" class="padding-30">
    @csrf
    <input type="text" name="name" value="{{  old('name')  }}"
           required placeholder="نام نقش" class="text @error('name') is-invalid @enderror">
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
                @if( is_array(old('permissions')) && array_key_exists($permission->name, old('permissions')) )
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
    <button class="btn btn-brand" style="margin-top: 10px;">اضافه کردن</button>
</form>
