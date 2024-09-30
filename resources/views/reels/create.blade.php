@extends('layout.master')

@section('title')
    Reels Create
@endsection

@section('content')
    <hr />
    <form action="{{ route('reels.store') }}" method="POST" enctype="multipart/form-data">
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
            <label for="type">Type</label>
            <div class="col">
                <select name="type" id="type" class="form-select form-select-lg" required>
                    <option value="" disabled selected>Select type</option>
                    <option value="organizer">Organizer</option>
                    <option value="venue">Venue</option>
                    <option value="event">Event</option>
                </select>
            </div>
        </div>

        <div class="row mb-3" id="dynamic-field-container" style="display:none;">
            <!-- Select field will be dynamically inserted here -->
        </div>

        <div class="row mb-3">
            <label>Upload Videos</label>
            <div class="col">
                <div id="video-upload" class="upload-box">
                    <span class="upload-icon">+</span>
                </div>
                <input type="file" name="videos[]" id="video-input" class="form-control-file" required accept="video/*" multiple style="display: none;">
                <div id="preview-videos" class="grid-gallery mt-2"></div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="description" class="form-label">Description</label>
            <div class="col">
                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter description..."></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="description_ar" class="form-label">Description AR</label>
            <div class="col">
                <textarea name="description_ar" id="description_ar" class="form-control" rows="3" placeholder="Enter description..."></textarea>
            </div>
        </div>

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
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
            margin-bottom: 10px;
        }

        .upload-icon {
            font-size: 24px;
        }

        .grid-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 30px; /* زيادة المسافة بين الفيديوهات */
        }

        .grid-item {
            position: relative;
            width: 150px;
            height: 150px;
            margin-right: 30px; /* تقليل المسافة بين الفيديوهات */
        }

        .grid-item video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 5px;
            display: block;
        }

        .remove-video-btn {
            position: absolute;
            top: 50%;
            right: -50px; /* زيادة المسافة بين الزر والفيديو */
            transform: translateY(-50%);
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px; /* جعل الزر مربعًا */
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            z-index: 10;
            padding: 0;
        }
        
    </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#type').change(function() {
                var type = $(this).val();
                var optionsHtml = '';
                $('#dynamic-field-container').empty().hide();

                switch(type) {
                    case 'organizer':
                        optionsHtml = buildSelectOptions(@json($organizers->map->only('id', 'name')->toArray()), 'Select Organizer');
                        break;
                    case 'venue':
                        optionsHtml = buildSelectOptions(@json($venues->map->only('id', 'name')->toArray()), 'Select Venue');
                        break;
                    case 'event':
                        optionsHtml = buildSelectOptions(@json($events->map->only('id', 'title')->toArray()), 'Select Event');
                        break;
                    default:
                        return;
                }
                if (optionsHtml) {
                    var selectHtml = '<select name="' + type + '_id" id="dynamic-field" class="form-select form-select-lg">' + optionsHtml + '</select>';
                    $('#dynamic-field-container').html(selectHtml).show();
                }
            });

            $('#video-upload').click(function() {
                $('#video-input').click();
            });

            $('#video-input').change(function() {
                previewFiles(this, '#preview-videos', 'video');
            });
        });

        function buildSelectOptions(data, placeholder) {
            var options = '<option value="" disabled selected>' + placeholder + '</option>';
            data.forEach(function(item) {
                var label = item.name || item.title;
                options += '<option value="' + item.id + '">' + label + '</option>';
            });
            return options;
        }

        function previewFiles(input, previewContainer, type) {
            var files = input.files;
            $(previewContainer).empty(); // Clear the preview

            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var content;
                    if (type === 'video') {
                        content = $('<video>').attr('src', e.target.result).attr('controls', true);
                    }

                    var div = $('<div>').addClass('grid-item').append(content);
                    var removeBtn = $('<button>')
                        .addClass('remove-video-btn')
                        .html('<i class="bi bi-x"></i>');

                    removeBtn.click(function() {
                        $(this).parent().remove();
                    });

                    div.append(removeBtn);
                    $(previewContainer).append(div);
                }

                reader.readAsDataURL(files[i]);
            }
        }
    </script>
@endsection
