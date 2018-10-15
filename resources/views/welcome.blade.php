@extends('layouts.frontend')

@section('content')
    <div class="row text-center">
        <div class="offset-md-3 col-md-6 col-sm-8 offset-sm-2 col-lg-6 offset-lg-3">
            <span class="error-element text-danger"></span>
            <div class="shorted-url-container" style="display: none;">
                <h3 class="text-success">Shorted url</h3>
                <h3 class="shorted-url"></h3>
            </div>
            <form class="mt-3 text-center" id="urlForm">
                {{ csrf_field() }}
                <div class="form-group">
                    <textarea required class="form-control form-control-lg" name="actual_url" rows="3" placeholder="Enter url here..."></textarea>
                </div>

                <button type="submit" class="btn btn-outline-success btn-lg mt-3">Make It Short</button>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {

            $(document).on('submit','#urlForm',function(event){
                event.preventDefault();
                let errorElement = $(".error-element");
                var data = $(this).serialize();
                let url = '{{ route('url.short-url') }}';
                $.ajax({
                    url:url,
                    type:'post',
                    data:data,
                    success:function (response) {
                        errorElement.html('');
                        if(response.status == 1) {
                            $(".shorted-url-container").show();
                            $('.shorted-url').html('<a href='+response.url+'>'+response.url+'</a>');
                        } else {
                            errorElement.html(response.message);
                        }
                        console.log(response);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        if (errorThrown == 'Unprocessable Entity') {
                            errorElement.html(XMLHttpRequest.responseJSON.errors.actual_url[0]);
                        }
                    }
                });
            });

        });
    </script>
@endpush