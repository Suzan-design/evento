@extends('layout.master')

@section('title')
    Show Organizer
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        h5 {
            color: #007bff;
            margin-bottom: 15px;
        }

        p, label, .list-group-item {
            color: #555;
        }

        .list-group-item {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }

        .form-control-static {
            background-color: #f9f9f9;
            border: none;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        .classGroup, .media-container img, video {
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .media-container img, video {
            width: 100%;
            max-width: 200px;
            height: auto;
        }

        .media-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
                margin: 20px auto;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5">
        <hr/>
        <div class="form-style">
            <div class="row mb-3">
                <label>Name</label>
                <div class="col">
                    <p class="form-control-static">{{ $organizer->name}}</p>
                </div>
            </div>
            <div class="row mb-3">
                <label>Bio</label>
                <div class="col">
                    <p class="form-control-static">{{ $organizer->bio}}</p>
                </div>
            </div>
            <hr />

            <div class="row mb-3">
                <label>Covering Area</label>
                <div class="col">
                    <p class="form-control-static">{{ $organizer->covering_area }}</p>
                </div>
            </div>
            @if($organizer->other_category)
            <hr />
            <div class="row mb-3">
                <label>Other Category</label>
                <div class="col">
                    <p class="form-control-static">{{ $organizer->other_category }}</p>
                </div>
            </div>
            @endif
            <hr />
            <div class="row mb-3">
                <div class="detail-label">profile</div>
                <div class="media-container">
                    @if($organizer->profile)
                            <img src="{{ asset('storage/' . $organizer->profile) }}" alt="EVENT Image">
                    @else
                        <div class="detail-value">No images available</div>
                    @endif
                </div>                
            </div>


            <div class="row mb-3">
                <label>type</label>
                <div class="col">
                    <p class="form-control-static">{{ $organizer->type }}</p>
                </div>
            </div>
            
        </div>
    </div>
@endsection
