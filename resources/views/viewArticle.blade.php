@extends('layouts.main')

@section('title')
{{ $data->title }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 bg-light p-3" style="border-radius: 15px">
        <h3 class="text-center">{{ $data->title }}</h3> <br>
        <small>Author By &nbsp;: {{ $author->name}}</small><br> 
        <small>Created At : {{date('d F Y H:i', strtotime($data->created_at))}}</small> <br>
        <hr>
        <p class="content p-2">{!! $data->content !!}</p>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-5 bg-light p-3" style="border-radius: 15px">
        <h3 class="text-center">Action</h3>
        <div class="row">
            <div class="col-sm-6" >
                <a style="float:right" href="{{ url('/articles/update/' . $data->id) }}" class="btn btn-sm btn-outline-warning" >Edit</a>
            </div>
            <div class="col-sm-6">
                <form method="POST">
                    @csrf
                    @method('DELETE')
                    <a style="float:left" href="{{ url('/articles/delete/' . $data->id) }}"  class="btn btn-sm btn-outline-danger">Delete</a>
                </form>
            </div>
        </div>
        <hr>
        <form method="post" action="{{ route('new_comment') }}">
            @csrf
            <h3 class="text-center">Comment</h3>
            <div class="mb-3">
                <div class="col-md-12">
                    <input type="hidden" class="form-control" id="frm-article-id" name="frm-article-id" value="{{ $data->id }}">
                </div>
            </div>
            <div class="mb-3">
                <div class="col-md-12">
                    <label for="frm-author" class="form-label"><small>Author Name</small></label>
                    <input type="text" class="form-control" id="frm-author" name="frm-author" value="{{ session()->get('name') }}" readonly>
                </div>
            </div>
            <div class="mb-3">
                <div class="col-md-12">
                    <label for="frm-author" class="form-label"><small>Author Email</small></label>
                    <input type="text" class="form-control" id="frm-author" name="frm-author" value="{{ session()->get('email')}}" readonly>
                </div>
            </div>
            <div class="mb-3">
                <label for="frm-comment" class="form-label"><small>Comment</small></label>
                <textarea class="form-control" id="frm-comment" name="frm-comment" placeholder="Type text in here..." rows="3"></textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-info form-control text-white">Comment</button>
            </div>
        </form>
        <ul class="timeline">
            @foreach ($comment as $record)
                <li>
                    <p style="float:right">{{date('d F Y H:i', strtotime($record->created_at))}}</p>
                    <p>{!! $record->content !!}</p>
                </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection