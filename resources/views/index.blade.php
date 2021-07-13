@extends('layouts.main')

@section('title', 'Home')

@section('content')

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h4>Latest Blog</h4>
        <ul class="timeline">
            @foreach ($data as $record)
                <li>
                    <a href="{{url('/articles/'. $record->id)}}">{{$record->title}}</a>
                    <a href="{{url('/articles/'. $record->id)}}" style="float:right">{{date('d F Y H:i', strtotime($record->created_at))}}</a>
                    <p>{!! $record->content !!}</p>
                    <a href="{{ url('/articles/update/' . $record->id) }}" >Edit</a>
                    <form method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ url('/articles/delete/' . $record->id) }}">Delete</a>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection