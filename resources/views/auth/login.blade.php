@extends('layouts.frontend')

@section('content')
    <div class="row text-center">
        <div class="offset-md-3 col-md-6 col-sm-8 offset-sm-2 col-lg-6 offset-lg-3">
            <form class="form-horizontal" method="POST" id="loginForm" action="{{ route('api.login') }}" id="">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                    <input id="email" type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" placeholder="Enter email" required autofocus>

                </div>
                <span class="login-error text-center text-danger m-3"></span>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                    <input id="password" type="password" class="form-control form-control-lg" name="password" placeholder="Enter password" required>

                </div>


                <div class="form-group">
                        <button type="submit" class="btn btn-outline-success btn-lg mt-3">
                            Login
                        </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
           $(document).on("submit","#loginForm",function(event){
                event.preventDefault();
                let data = $(this).serialize();
                let url = "{{  route('api.login') }}";
                let errorElement = $(".login-error");

                $.ajax({
                    url:url,
                    type:'POST',
                    data:data,
                    dataType:'json',
                    success:function(response){
                        errorElement.html('');
                        var token = response.data.token;
                        localStorage.setItem('auth_token',token)

                        let redirectUrl = "{{ route('dashboard') }}";
                        window.location.href = redirectUrl;
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        errorElement.html((XMLHttpRequest.responseJSON.error));
                    }

                });
           });
        });
    </script>
@endpush
