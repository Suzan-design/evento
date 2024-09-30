@extends('layout.master')

@section('title')
    Edit Aminety
@endsection


@section('content')
    <hr/>
    <form action="{{ route('interest.update', $interest->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- This specifies the HTTP verb to use for the form submission --}}
        @if($errors->any())
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
                <input type="text" required name="title" class="form-control" placeholder="Title" value="{{ old('title', $interest->title) }}">
            </div>
        </div>

        <div class="row mb-3">
            <label>Title AR</label>
            <div class="col">
                <input type="text" required name="title_ar" class="form-control" placeholder="Title AR" value="{{ old('title_ar', $interest->title_ar) }}">
            </div>
        </div>

        <div class="row mb-3">
            <label>Icon</label>
            <div class="col">
                <input type="file" name="icon" class="form-control" accept="image/*">
                @if($interest->icon)
                    <img src="{{ asset('storage/'.$interest->icon) }}" alt="Current Icon" style="width: 100px; height: auto;">
                @endif
            </div>
        </div>

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
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
