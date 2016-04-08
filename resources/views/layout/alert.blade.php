@if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        <i class="fa fa-check-square-o"></i> {!! Session::get('success') !!}
    </div>
@endif
@if (Session::has('info'))
    <div class="alert alert-info" role="alert">
        <i class="fa fa-folder-o"></i> {!! Session::get('info') !!}
    </div>
@endif
@if (Session::has('warning'))
    <div class="alert alert-warning" role="alert">
        <i class="fa fa-warning"></i> {!! Session::get('warning') !!}
    </div>
@endif