@extends('layout.master')

@section('title')
    Edit Venue
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
    <h2>Edit Venue</h2>
    <hr />
    <form action="{{ route('venues.update', $venue->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
            <label>Name</label>
            <div class="col">
                <input type="text" required name="name" class="form-control" placeholder="Name" maxlength="255" value="{{ $venue->name }}">
            </div>
        </div>
        <div class="row mb-3">
            <label>Name AR</label>
            <div class="col">
                <input type="text" required name="name_ar" value="{{$venue->name_ar }}" class="form-control" placeholder="Name AR" maxlength="255">
            </div>
        </div>
        <div class="row mb-3">
            <label>Capacity</label>
            <div class="col">
                <input type="number" required name="capacity" class="form-control" placeholder="Capacity" min="0" value="{{ $venue->capacity }}">
            </div>
        </div>

        <div class="row mb-3">
            <label>Governorate</label>
            <div class="col">
                <select name="governorate" id="governorate" class="form-control" required>
                    <option value="">Select Governorate</option>
                    @foreach(['Aleppo', 'Al-Ḥasakah', 'Al-Qamishli', 'Al-Qunayṭirah', 'Al-Raqqah', 'Al-Suwayda', 'Damascus', 'Daraa', 'Dayr al-Zawr', 'Ḥamah', 'Homs', 'Idlib', 'Latakia', 'Rif Dimashq'] as $governorate)
                        <option value="{{ $governorate }}" {{ $venue->governorate == $governorate ? 'selected' : '' }}>{{ $governorate }}</option>
                    @endforeach
                </select>
            </div>
        </div>



        <div class="row mb-3">
            <label>Location Description</label>
            <div class="col">
                <textarea name="location_description" class="form-control" required maxlength="1000">{{ old('location_description' , $venue->location_description) }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label>Location Description AR</label>
            <div class="col">
                <textarea name="location_description_ar" class="form-control" required maxlength="1000">{{ old('location_description_ar' , $venue->location_description_ar) }}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label>Map</label>
            <div class="col">
                <div id="map" style="height: 400px;"></div>
            </div>
        </div>

        <div class="row mb-3">
            <label>Latitude</label>
            <div class="col">
                <input type="text" id="latitude" name="latitude" class="form-control" placeholder="Latitude" required value="{{ $venue->latitude }}">
            </div>
        </div>

        <div class="row mb-3">
            <label>Longitude</label>
            <div class="col">
                <input type="text" id="longitude" name="longitude" class="form-control" placeholder="Longitude" required value="{{ $venue->longitude }}">
            </div>
        </div>

        <div class="row mb-3">
            <label>Contact Number</label>
            <div class="col">
                <input type="text" required name="contact_number" class="form-control" placeholder="Contact Number" maxlength="20" value="{{ $venue->contact_number }}">
            </div>
        </div>

        <div class="row mb-3">
            <label>Description</label>
            <div class="col">
                <textarea name="description" class="form-control" required maxlength="1000">{{ $venue->description }}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label>Description AR</label>
            <div class="col">
                <textarea name="description_ar" class="form-control" required maxlength="1000">{{ $venue->description_ar }}</textarea>
            </div>
        </div>

        <!-- Images Upload -->
        <div class="row mb-3">
            <label>Profile</label>
            <div class="col">
                <input type="file"  name="profile" class="form-control" accept="image/*">
                @if($venue->profile)
                    <img src="{{ asset('storage/'.$venue->profile) }}" alt="Current Icon" style="width: 100px; height: auto;">
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

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCA7gH--Lsl3iK1KcjHVBJtV-WPpMBPenE&callback=initMap" async defer></script>
    <script>
        function initMap() {
            var mapOptions = {
                zoom: 8,
                center: new google.maps.LatLng({{ $venue->latitude }}, {{ $venue->longitude }})
            };

            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            var marker = new google.maps.Marker({
                position: { lat: {{ $venue->latitude }}, lng: {{ $venue->longitude }} },
                map: map
            });

            map.addListener('rightclick', function(event) {
                var latitude = event.latLng.lat();
                var longitude = event.latLng.lng();

                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;

                if(marker) marker.setMap(null);

                marker = new google.maps.Marker({
                    position: event.latLng,
                    map: map
                });
            });
        }
    </script>
@endsection
