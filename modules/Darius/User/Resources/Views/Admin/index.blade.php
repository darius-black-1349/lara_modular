@extends('Dashboard::master')

@section('breadcrumb')
    <li><a href="{{  route('users.index')  }}" title="کاربران">کاربران</a></li>
@endsection

@section('content')
    <div class="row no-gutters  ">
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">کاربران</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>نام و نام خانوادگی</th>
                        <th>ایمیل</th>
                        <th>موبایل</th>
                        <th>نقش کاربری</th>
                        <th>تاریخ عضویت</th>
                        <th>آی پی</th>
                        <th>وضعیت حساب</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $key => $user)
                        <tr role="row" class="">
                            <td><a href="">{{  $user->id  }}</a></td>
                            <td>{{  $user->name  }}</td>
                            <td>{{  $user->email  }}</td>
                            <td>{{  $user->mobile  }}</td>
                            <td>
                                <ul>
                                    @foreach($user->roles as $userRole)
                                        <li class="deletable-list-item">@lang($userRole->name)
                                            <a href="" class="item-delete mlg-15 d-none" title="حذف"
                                               onclick="event.preventDefault();
                                                   deleteItem(event, '{{  route('users.removeRole',
                                                            ['user' => $user->id, 'role' => $userRole->name])  }}', 'li'
                                                   )"
                                            ></a>
                                        </li>
                                    @endforeach
                                    <li><a href="#select-role" rel="modal:open" onclick="setFormAction({{  $user->id  }})">
                                            افزودن نقش کاربری</a></li>
                                </ul>
                            </td>
                            <td>{{  $user->created_at  }}</td>
                            <td>{{  $user->ip  }}</td>
                            <td class="confirmation_status">{!! $user->hasVerifiedEmail() ?
                                "<span class='text-success'>تایید شده</span>" :
                                "<span class='text-error'>تایید نشده</span>" !!}</td>
                            <td>
                                <a href=""
                                   onclick="event.preventDefault();
                                       deleteItem(event, '{{  route('users.destroy', $user->id)  }}')"
                                   class="item-delete mlg-15" title="حذف"></a>
                                <a href="{{  route('users.edit', $user->id)  }}" class="item-edit" title="ویرایش"></a>
                                <a href="" onclick="updateConfirmationStatus(event, '{{ route('users.manualVerify', $user->id) }}',
                                    'آیا از تایید این آیتم اطمینان دارید؟' , 'تایید شده')" class="item-confirm mlg-15" title="تایید"></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                {{--Modal--}}
                <div id="select-role" class="modal">
                    <form action="{{  route('users.addRole', 0)  }}" method="POST" id="select-role-form">
                        @csrf
                        <select name="role" id="">
                            <option value="">یک رول را انتخاب کنید</option>
                            @foreach($roles as $role)
                                <option value="{{  $role->name  }}">{{  $role->name  }}</option>
                            @endforeach
                        </select>

                        <button class="btn mt-2">افزودن</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        function setFormAction(userId) {
            let action = '{{  route('users.addRole', 0)  }}'
            $('#select-role-form').attr('action', action.replace('/0/', '/' + userId + '/'))
        }

        @include('Common::layouts.feedbacks')
    </script>
@endsection


