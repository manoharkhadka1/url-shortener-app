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
                                table.row.add([val.actual_url,baseUrl+'/'+val.url_code,val.url_counter,"--","--"
                                ]).draw();
                            });
                        }
                    }
                });
            }

            postUrlRecordsToTable();
        });
    </script>
@endpush