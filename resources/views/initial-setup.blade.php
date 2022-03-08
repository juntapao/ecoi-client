@extends('layouts.big')

@section('content')
    <div class="text-center text-muted mb-4">
        <span>Syncing Data</span><br />
        <small>Please wait while this terminal is being updated</small>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="list-group">
                
                @foreach(session('update-process') as $update)
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start p-2">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ ucwords(str_replace('_', ' ', $update['name'])) }}</h5>
                            <small>{{ ucwords($update['status']) }}</small>
                        </div>
                        @if($update['status'] == 'loading')
                            @include('includes.loading')
                        @endif
                    </a>
                @endforeach

            </div>
        </div>
    </div>
@endsection

@section('more-scripts')
<script>
    $(document).ready(function() {
        setTimeout(location.reload.bind(location), 5000);
    });
</script>
@endsection
