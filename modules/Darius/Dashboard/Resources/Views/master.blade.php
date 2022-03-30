<!DOCTYPE html>
<html lang="en">

@include('Dashboard::layout.head')

<body>

@include('Dashboard::layout.sidebar')

<div class="content">

    @include('Dashboard::layout.header')

    @include('Dashboard::layout.breadcrumb')

    <div class="main-content">
        @yield('content')
    </div>
</div>
</body>

@include('Dashboard::layout.footer')

{{--Delete Row Table Function--}}
<script>
    function deleteItem(event, route, element = 'tr') {
        if(confirm('آیا از حذف این آیتم اطمینان دارید ؟')) {
            $.post(route, {_method: "delete", _token: "{{  csrf_token()  }}" })
                .done(function (response) {
                    event.target.closest(element).remove();
                    $.toast({
                        heading: 'عملیات موفق',
                        text: response.message,
                        showHideTransition: 'slide',
                        icon: 'success'
                    })
                })
                .fail(function (response) {
                    $.toast({
                        heading: 'عملیات ناموفق',
                        text: response.message,
                        showHideTransition: 'slide',
                        icon: 'error'
                    })
                })
        }
    }
</script>

{{--Update Confirmation Status Row Table Function --}}
<script>
    function updateConfirmationStatus(event, route, message, status, field = 'confirmation_status') {
        if(confirm(message)) {
            $.post(route, {_method: "patch", _token: "{{  csrf_token()  }}" })
                .done(function (response) {
                    $(event.target).closest('tr').find('td.' + field).text(status)
                    $.toast({
                        heading: 'عملیات موفق',
                        text: response.message,
                        showHideTransition: 'slide',
                        icon: 'success'
                    })
                })
                .fail(function (response) {
                    $.toast({
                        heading: 'عملیات ناموفق',
                        text: response.message,
                        showHideTransition: 'slide',
                        icon: 'error'
                    })
                })
        }
    }
</script>

</html>
