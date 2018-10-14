@extends('layouts.frontend')

@section('content')
    <div class="row text-center">
        <div class="offset-md-3 col-md-6 col-sm-8 offset-sm-2 col-lg-6 offset-lg-3">
            <form class="mt-3 text-center">
                <div class="form-group">
                    <textarea class="form-control form-control-lg" url="complete_url" rows="3" placeholder="Enter url here..."></textarea>
                </div>

                <button type="submit" class="btn btn-outline-success btn-lg mt-3">Make It Short</button>
            </form>
        </div>
    </div>
@endsection