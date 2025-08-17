@extends('layout')

@section('title', 'detail')

@section('content')
<div id="event-detail-app">
    <event-detail :event-token="{{ json_encode($eventToken) }}"></event-detail>
</div>
@endsection