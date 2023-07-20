@if(session('download'))
    <?php if(strpos(url()->current(), 'public') !== false) $public = '../'; else $public = '';  ?>
    <meta http-equiv="refresh" content="2; url=../storage/downloads/{{ session('download') }}">
    {{ session()->forget('download') }}
@endif
