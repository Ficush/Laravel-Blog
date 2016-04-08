@extends('layout.main')

@section('content')
@include('layout.alert')
    <div class="panel admin-panel">
        <div class="panel-heading">友情链接</div>
        <div class="panel-body">
        @if (!empty($linkList))
            <table class="table">
                <thead>
                <tr>
                    <th width="25%">站名</th>
                    <th width="75%">描述</th>
                </tr>
                </thead>
                <tbody>
                @foreach($linkList as $link)
                    <tr>
                        <td><a href="{{ $link -> url }}">{{ $link -> name }}</a></td>
                        <td>{{ $link -> description }}</td>
                    </tr>
                @endforeach
            </table>
        @endif
        </div>
	</div>
@endsection
