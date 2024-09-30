@extends('layout.master')

@section('title')
    Event Request Category
@endsection

@section('css')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        label {
            border: 2px solid pink;
            padding: 5px;
            display: inline-block;
            margin-bottom: 10px;
        }

        .form-control {
            font-size: 16px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
            width: 100%;
        }

        .btn-primary {
            background-color: #5cb85c;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
        }

        form {
            width: 50%;
            margin: auto;
        }
    </style>
@endsection

@section('content')
    <h2>Add Event Category</h2>
    <hr />
    <form action="{{ route('events-request-categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row mb-3">
            <label>Title</label>
            <div class="col">
                <input type="text" required name="title" class="form-control" placeholder="Title">
            </div>
        </div>
        <div class="row mb-3">
            <label>Title Ar</label>
            <div class="col">
                <input type="text" required name="title_ar" class="form-control" placeholder="Title AR">
            </div>
        </div>
        <div class="row mb-3">
            <label>Icon</label>
            <div class="col">
                <input type="file" required name="icon" class="form-control" accept="image/*">
            </div>
        </div>

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
