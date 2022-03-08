{{-- @if (count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif --}}

@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    {{ session()->forget('success') }}
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    {{ session()->forget('error') }}
@endif

{{-- ERROR --}}
{{--@if(session('error'))
    <div class="modal show z-depth-0 valign-wrapper rounded col-12 col-md-4" data-backdrop="true">
        <div class="modal-content">
            <div><button class="close right" data-dismiss="modal">&times;</button></div>
            <i class="icon-error text-center"></i>
            <h5 class="text-center">{{ session('error') }}</h5>
            <div class="modal-footer p-4">
                <button class="btn yellow accent-3 waves-effect waves-dark grey-text text-darken-3" type="button" data-dismiss="modal" autofocus><i class="fa fa-thumbs-up"></i> OK</button>
            </div>
        </div>
    </div>
    {{ session()->forget('error') }}
@endif--}}

{{-- SUCCESS --}}
{{--@if(session('success'))
    <div class="modal show z-depth-0 valign-wrapper rounded col-12 col-md-4" data-backdrop="true">
        <div class="modal-content">
            <div><button class="close right" data-dismiss="modal">&times;</button></div>
            <i class="icon-error text-center"></i>
            <h5 class="text-center">{{ session('success') }}</h5>
            <div class="modal-footer p-4">
                <button class="btn yellow accent-3 waves-effect waves-dark grey-text text-darken-3" type="button" data-dismiss="modal" autofocus><i class="fa fa-thumbs-up"></i> OK</button>
            </div>
        </div>
    </div>
    {{ session()->forget('success') }}
@endif--}}
