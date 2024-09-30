@extends('layout.master')

@section('title')
    Create Venue
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
        .upload-box {
            width: 100px;
            height: 100px;
            border: 2px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .upload-icon {
            font-size: 32px;
            color: #ccc;
        }

        .preview-image {
            position: relative;
            margin-right: 5px;
        }

        .remove-image {
            position: absolute;
            top: 0;
            right: 0;
            cursor: pointer;
            background-color: #ff6666;
            color: #fff;
            border-radius: 50%;
            padding: 2px 5px;
        }
    </style>
@endsection

@section('content')
    <hr />
    <form action="{{ route('venues.store') }}" method="POST" enctype="multipart/form-data">
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
            <label>Name</label>
            <div class="col">
                <input type="text" required name="name" value="{{ old('name') }}" class="form-control" placeholder="Name"  maxlength="255">
            </div>
        </div>
        <div class="row mb-3">
            <label>Name AR</label>
            <div class="col">
                <input type="text" required name="name_ar" value="{{ old('name_ar') }}" class="form-control" placeholder="Name AR" maxlength="255">
            </div>
        </div>
        <div class="row mb-3">
            <label>Capacity</label>
            <div class="col">
                <input type="number" required name="capacity" value="{{ old('capacity') }}" class="form-control" placeholder="Capacity" min="0">
            </div>
        </div>

        <div class="row mb-3">
            <label>Governorate</label>
            <div class="col">
                <select name="governorate" id="governorate" class="form-select form-select-lg" required>
                    <option value="">Select Governorate</option>
                    @foreach(['Aleppo', 'Al-Ḥasakah', 'Al-Qamishli', 'Al-Qunayṭirah', 'Al-Raqqah', 'Al-Suwayda', 'Damascus', 'Daraa', 'Dayr al-Zawr', 'Ḥamah', 'Homs', 'Idlib', 'Latakia', 'Rif Dimashq'] as $governorate)
                        <option value="{{ $governorate }}" {{ old('governorate') == $governorate ? 'selected' : '' }}>{{ $governorate }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label>Location Description</label>
            <div class="col">
                <textarea name="location_description" class="form-control" required maxlength="1000">{{ old('location_description') }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label>Location Description AR</label>
            <div class="col">
                <textarea name="location_description_ar" class="form-control" required maxlength="1000">{{ old('location_description_ar') }}</textarea>
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
                <input type="text" id="latitude" name="latitude" class="form-control" placeholder="Latitude" required>
            </div>
        </div>

        <div class="row mb-3">
            <label>Longitude</label>
            <div class="col">
                <input type="text" id="longitude" name="longitude" class="form-control" placeholder="Longitude" required>
            </div>
        </div>

        <div class="row mb-3">
            <label>Contact Number</label>
            <div class="col">
                <input type="text" required name="contact_number" value="{{ old('contact_number') }}" class="form-control" placeholder="Contact Number" maxlength="20">
            </div>
        </div>

        <div class="row mb-3">
            <label>Description</label>
            <div class="col">
                <textarea name="description" class="form-control" required maxlength="1000">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label>Description AR</label>
            <div class="col">
                <textarea name="description_ar" class="form-control" required maxlength="1000">{{ old('description_ar') }}</textarea>
            </div>
        </div>
        <!-- Images Upload -->
        <div class="row mb-3">
            <label>Profile</label>
            <div class="col">
                <input type="file" required name="profile" class="form-control" accept="image/*">
            </div>
        </div>

        <div id="albums-container"></div>


        <button type="button" id="add-album" class="btn btn-secondary">Add Album</button>

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCA7gH--Lsl3iK1KcjHVBJtV-WPpMBPenE&callback=initMap" async defer></script>
    <script>
        function initMap() {
            // Set up map options
            var mapOptions = {
                zoom: 8,
                center: new google.maps.LatLng(33.5138, 36.2765) // Centered at Damascus
            };

            // Create map
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            // Initialize a variable to hold the marker
            var marker;

            // Add a right-click event listener to the map
            map.addListener('rightclick', function(event) {

                // Get the latitude and longitude of the clicked location
                var latitude = event.latLng.lat();
                var longitude = event.latLng.lng();

                console.log('Map Right Clicked: ', latitude, longitude);

                // Set the latitude and longitude values to the input fields
                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;

                // If a marker already exists, remove it
                if(marker) marker.setMap(null);

                // Place a new marker at the clicked location
                marker = new google.maps.Marker({
                    position: event.latLng,
                    map: map
                });
            });
        }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            let albumCounter = 0;

            $('#add-album').click(function() {
                albumCounter++;
                $('#albums-container').append(createAlbumHtml(albumCounter));
            });

            function createAlbumHtml(albumIndex) {
                return `
                    <div class="album" id="album-${albumIndex}">
                        <div class="form-group">
                            <label for="album-${albumIndex}-name">Album Name:</label>
                            <input type="text" id="album-${albumIndex}-name" name="album-${albumIndex}-name" class="form-control" placeholder="Enter album name">
                        </div>
                        <div class="form-group">
                            <label>Upload Images:</label>
                            <input type="file" name="album-${albumIndex}-images[]" class="form-control-file" multiple  accept="image/jpeg, image/png, image/gif">
                        </div>
                        <div class="form-group">
                            <label>Upload Videos:</label>
                            <input type="file" name="album-${albumIndex}-videos[]" class="form-control-file" multiple accept="video/mp4, video/mpeg">
                        </div>
                    </div>
                `;
            }
        });
    </script>

@endsection
