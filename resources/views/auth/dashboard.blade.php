@extends('layouts.backend')

@section('content')
    <div class="backend-body-section">
        <h4>Url Details</h4>
        <div class="table">
            <table class="table table-bordered table-striped" id="urlRecordTable">
                <thead>
                    <tr>
                        <th>Actual Url</th>
                        <th>Short Url</th>
                        <th>Url Counter</th>
                        <th>Expiration Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <div class="modal" id="addExpiration" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Expiration Time</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="expirationForm">
                    <input type="hidden" name="id">
                    <div class="modal-body text-left">
                        <span class="error-message"></span>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control" date min="{{ date('Y-m-d') }}" required>
                        </div>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Time</label>
                            <input type="time" name="time" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            let authToken = localStorage.getItem('auth_token');

            let table = $("#urlRecordTable").DataTable();
            let baseUrl = "{{ url('') }}";
            function postUrlRecordsToTable() {
                let url = "{{ route('api.get-all-url') }}";
                $.ajax({
                    url:url,
                    type:'get',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('Authorization', 'Bearer '+authToken);
                    },
                    success:function (response) {
                        if(response.length > 0) {
                            $.each(response,function(key,val){
                                let expirationTime = val.expiration_time;

                                if(expirationTime == null) {
                                    expirationTime = '<button class="btn btn-sm add-expiration btn-success">Add</button>';
                                }

                                let hiddenId = '<input type="hidden" class="data-id" value="'+val.id+'">';

                                table.row.add([hiddenId+val.actual_url,baseUrl+'/'+val.url_code,val.url_counter,expirationTime,"--"
                                ]).draw();

                            });
                        }
                    }
                });
            }

            postUrlRecordsToTable();

            $(document).on("click",".add-expiration",function () {
                let modal = $("#addExpiration");
                let id = $(this).closest('tr').find('.data-id').val();
                modal.attr('data-Id',id);
                modal.modal();
            });

            $(document).on('submit',"#expirationForm",function(event){
                event.preventDefault();
                let th = $(this);
                th.find('input[name="id"]').val(th.closest('.modal').attr('data-Id'));
                let data = th.serialize();
                let url = "{{ route('api.add-expiration-time-to-url') }}";
                let errorElement = th.closest('.modal').find('.error-message');

                $.ajax({
                    url:url,
                    type: 'post',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('Authorization', 'Bearer '+authToken);
                    },
                    data:data,
                    success:function (response) {
                        if (response.status == 1) {
                            errorElement.html('<span class="text-success">'+response.message+'</span>');
                            setTimeout(function(){
                                window.location.reload();
                            },1000);

                        } else {
                            errorElement.html('<span class="text-danger">'+response.message+'</span>');
                        }

                    }
                });
            });
        });
    </script>
@endpush