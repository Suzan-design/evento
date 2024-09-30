@extends('layout.master')

@section('title')
    Notification Dashboard
@endsection

@section('content')
    <hr />
    <div class="beneficiaries-info">
        <div class="user-count">Users: 0</div>
        <span class="beneficiaries-label">Beneficiaries of this Notification</span>
    </div>

    <form action="{{ route('sent_notification') }}" method="POST" enctype="multipart/form-data">
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
                <select name="type" id="type" class="form-control" required>
                    <option value="" disabled selected>Select type</option>
                    <option value="organizer">Organizer</option>
                    <option value="venue">Venue</option>
                    <option value="event">Event</option>
                </select>
            </div>
        </div>
        <div class="row mb-3" id="dynamic-field-container" style="display:none;">
        </div>

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" >
        </div>
        <div class="form-group">
            <label for="title_ar">Title: AR</label>
            <input type="text" class="form-control" id="title_ar" name="title_ar" >
        </div>

        <div class="form-group">
            <label for="description">description: </label>
            <input type="text" class="form-control" id="description" name="description" >
        </div>
        <div class="form-group">
            <label for="description_ar">description: AR</label>
            <input type="text" class="form-control" id="description_ar" name="description_ar" >
        </div>

        <hr />
        <h4>User Level</h4>
        <div class="form-group">
            <label for="city">City:</label>
            <select class="form-control" id="user_city" name="user_city[]" multiple >
                <option value="Aleppo">Aleppo</option>
                <option value="Al-Ḥasakah">Al-Ḥasakah</option>
                <option value="Al-Qamishli">Al-Qamishli</option>
                <option value="Al-Qunayṭirah">Al-Qunayṭirah</option>
                <option value="Al-Raqqah">Al-Raqqah</option>
                <option value="Al-Suwayda">Al-Suwayda</option>
                <option value="Damascus">Damascus</option>
                <option value="Daraa">Daraa</option>
                <option value="Dayr al-Zawr">Dayr al-Zawr</option>
                <option value="Ḥamah">Ḥamah</option>
                <option value="Homs">Homs</option>
                <option value="Idlib">Idlib</option>
                <option value="Latakia">Latakia</option>
                <option value="Rif Dimashq">Rif Dimashq</option>
            </select>
        </div>


        <div class="form-group">
            <label for="user_interest">User Interest:</label>
            <select name="user_interest_ids[]" id="user_interest" class="form-control"  multiple>
                <option value="" disabled>Select Interest</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>

        <hr />

        <div class="form-group">
            <label for="ageRange">Age Range:</label>
            <input type="range" class="form-control-range" id="ageRangeStart" name="ageRangeStart" min="0" max="100" value="18">
            <input type="range" class="form-control-range" id="ageRangeEnd" name="ageRangeEnd" min="0" max="100" value="60">
            <p>Selected Age Range: <span id="ageRangeDisplay">18 - 60</span> years</p>
        </div>

        <div class="form-group">
            <label for="bookingRange">Booking Range:</label>
            <input type="range" class="form-control-range" id="bookingRangeStart" name="bookingRangeStart" min="0" max="1000" value="18">
            <input type="range" class="form-control-range" id="bookingRangeEnd" name="bookingRangeEnd" min="0" max="1000" value="60">
            <p>Selected booking Range: <span id="bookingRangeDisplay">18 - 60</span> booking</p>
        </div>

        <hr />

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            font-size: 16px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 100%;
            height: auto;
        }

        .btn-primary {
            background-color: #5cb85c;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        form {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 10px;
            border-radius: 5px;
        }
        .content-wrapper {
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            gap: 20px;
        }


        .beneficiaries-info {
            position: -webkit-sticky;
            position: sticky;
            top: 5px;
            flex-basis: 45%;
            text-align: center;
            margin-bottom: 20px;
            padding: 15px;
            background-color: #e7f5ff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .promo-form {
            flex-basis: 45%;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        select[multiple] {
            height: auto;
            padding: 10px;
            overflow-y: auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        select[multiple] option:hover {
            background-color: #f0f0f0;
        }

        #multivalueContainer {
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            min-height: 40px;
            margin-top: 5px;
        }

        .tag {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            margin-right: 5px;
            border-radius: 3px;
            margin-top: 5px;
        }
        .form-control-range {
            width: 100%; /* Full-width */
            margin: 15px 0; /* Add some margin */
        }
        .input-group-text {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-left: 0;
        }
    </style>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection

@section('scripts')
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Initialize Select2 -->
    <script>
        $(document).ready(function() {
            $('#user_city').select2();
            $('#event_city').select2();
            $('#event_category').select2();
            $('#user_interest').select2() ;
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('multivalueInput');
            const container = document.getElementById('multivalueContainer');

            input.addEventListener('keyup', function (e) {
                if (e.key === ' ') {
                    const value = input.value.trim().replace(/,$/, '');
                    if (value) {
                        addTag(value);
                    }
                    input.value = '';
                }
            });

            function addTag(value) {
                // Create the visible tag
                const tag = document.createElement('span');
                tag.className = 'tag';
                tag.textContent = value;
                container.appendChild(tag);

                // Create a hidden input for the form
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'events_id[]';
                hiddenInput.value = value;
                container.appendChild(hiddenInput);
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ageRangeStart = document.getElementById('ageRangeStart');
            const ageRangeEnd = document.getElementById('ageRangeEnd');
            const ageRangeDisplay = document.getElementById('ageRangeDisplay');

            function updateAgeDisplay() {
                ageRangeDisplay.textContent = `${ageRangeStart.value} - ${ageRangeEnd.value}`;
            }

            ageRangeStart.addEventListener('input', updateAgeDisplay);
            ageRangeEnd.addEventListener('input', updateAgeDisplay);

            updateAgeDisplay(); // Initialize display
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const bookingRangeStart = document.getElementById('bookingRangeStart');
            const bookingRangeEnd = document.getElementById('bookingRangeEnd');
            const bookingRangeDisplay = document.getElementById('bookingRangeDisplay');

            function updateAgeDisplay() {
                bookingRangeDisplay.textContent = `${bookingRangeStart.value} - ${bookingRangeEnd.value}`;
            }

            bookingRangeStart.addEventListener('input', updateAgeDisplay);
            bookingRangeEnd.addEventListener('input', updateAgeDisplay);

            updateAgeDisplay(); // Initialize display
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#type').change(function() {
                var type = $(this).val(); // Corrected line
                var optionsHtml = ''; // Initialize the options HTML string
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
                    var selectHtml = '<select name="' + type + '_id" id="dynamic-field" class="form-control">' + optionsHtml + '</select>';
                    $('#dynamic-field-container').html(selectHtml).show();
                }
            });

            // Function to update the count
            function updateCount() {
                $.ajax({
                    url: '{{ route("user_count_notification") }}',
                    type: 'POST',
                    data: $('form').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('.user-count').text(`Users: ${data.user_count}`);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error occurred: " + error);
                    }
                });
            }
            function buildSelectOptions(data, placeholder) {
                var options = '<option value="" disabled selected>' + placeholder + '</option>';
                data.forEach(function(item) {
                    var label = item.name || item.title; // Adjust to accommodate both 'name' and 'title'
                    options += '<option value="' + item.id + '">' + label + '</option>';
                });
                return options;
            }
            // Trigger updateCount when any input field changes
            $('input, select').on('change', function() {
                updateCount();
            });
        });
    </script>

@endsection
