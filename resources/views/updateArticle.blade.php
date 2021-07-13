@extends('layouts.main')

@section('title', 'Update Articles')

@section('content')
<div class="col-md-6 offset-md-3 bg-light p-3" style="border-radius: 15px">
    <h3 class="text-center">Update Article</h3> <br>
    <form method="POST">
        @method('PATCH')
        @csrf

        <div class="mb-3">
            <input type="hidden" class="form-control" id="idf" name="idf" value="{{ $data->id }}" placeholder="input here...">
        </div>
        <div class="mb-3">
            <label for="frm-title" class="form-label">Title</label>
            <input type="text" class="form-control" id="frm-title" name="frm-title" value="{{ $data->title }}" placeholder="input here...">
        </div>
        <div class="mb-3">
            <label for="frm-content" class="form-label">Content</label>
            <textarea class="form-control" id="frm-content" name="frm-content" rows="3" placeholder="Type text in here...">{{ $data->content }}</textarea>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-outline-success form-control">Update</button>
        </div>
    </form>
</div>
@endsection