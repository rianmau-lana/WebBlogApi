@extends('layouts.main')

@section('title', 'New Article')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3 bg-light p-3" style="border-radius: 15px">
        <h3 class="text-center">New Article</h3> <br>
        <form method="post">
            @csrf

            <div class="mb-3">
                <label for="frm-title" class="form-label">Title</label>
                <input type="text" class="form-control" id="frm-title" name="frm-title">
            </div>
            <div class="mb-3">
                <label for="frm-content" class="form-label">Content</label>
                <textarea class="form-control" id="frm-content" name="frm-content" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-outline-success form-control">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection