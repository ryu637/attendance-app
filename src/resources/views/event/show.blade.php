@extends('layout')

@section('title', 'show')

@section('content')
<div id="event-show-app">
    <event-show :event-token="'{{ $eventToken }}'"></event-show>
</div>
@endsection