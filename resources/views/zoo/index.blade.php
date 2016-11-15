@extends('layouts.master')

@section('content')


    <div class="panel panel-info">
        <div class="panel-heading">Animal status</div>
        <div class="panel-body">
            <p class="lead">Time: <span id="time">{{ $time }}</span> Hours have passed</p>
            <div class="btn-group" role="group">
                <button class="btn btn-primary btn-sm" id="advanceTime">Advance Time</button>
                <button class="btn btn-success btn-sm"  id="feed">Feed Animals</button>
            </div>
            <div class="container"><p>{{ $cache }}</p></div>
        </div>
        <div class="table-responsive" id="data_table">
        @include('zoo.table', ['animals' => $animals])
    </div>
    </div>
@endsection
