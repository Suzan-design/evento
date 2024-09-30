@extends('layout.master')

@section('title')
    Promo Codes
@endsection

@section('content')
    <hr />
    <div class="beneficiaries-info">
        <div class="user-count">Users: 0</div>
        <div class="events-count">Events: 0</div>
        <span class="beneficiaries-label">Beneficiaries of this Promo Code</span>
    </div>

    <form action="{{ route('promo_code.store') }}" method="POST" enctype="multipart/form-data">
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
        <div class="form-group">
            <label for="code">Title:</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="code">Description:</label>
            <input type="text" class="form-control" id="description" name="description">
        </div>
        <div class="row mb-3">
            <label>Image</label>
            <div class="col">
                <input type="file" required name="image" class="form-control" accept="image/*">
            </div>
        </div>
        <div class="form-group">
            <label for="discount">Discount:%</label>
            <input type="number" class="form-control" id="discount" max="100" name="discount">
        </div>
        <div class="form-group">
            <label for="code">Code:</label>
            <input type="text" class="form-control" id="code" name="code">
        </div>
        <div class="form-group">
            <label for="limit">Limit of benefit: (SP)</label>
            <div class="input-group">
                <input type="number" class="form-control" id="limit" name="limit">
            </div>
        </div>
        <div class="form-group">
            <label for="start-date">Start Date:</label>
            <input type="datetime-local" class="form-control" id="start-date" name="start-date">
        </div>
        <div class="form-group">
            <label for="end-date">End Date:</label>
            <input type="datetime-local" class="form-control" id="end-date" name="end-date">
        </div>
        <hr />
        <h4>User Level</h4>
        <div class="form-group">
            <label for="city">City:</label>
            <select class="form-control" id="user_city" name="user_city[]" multiple>
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
            <select name="user_interest_ids[]" id="user_interest" class="form-control" multiple>
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
            <p>Selected Booking Range: <span id="bookingRangeDisplay">18 - 60</span> booking</p>
        </div>
        <hr />
        <div class="form-group">
            <label for="limit">Limit of User Beneficiaries:</label>
            <input type="text" class="form-control" id="limit" name="user_limit">
        </div>
        <hr />
        <h4>Event Level</h4>
        <div class="form-group">
            <label for="city">City:</label>
            <select class="form-control" id="event_city" name="event_city[]" multiple>
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
            <label for="event_category">Event Category:</label>
            <select name="event_category_ids[]" id="event_category" class="form-control" multiple>
                <option value="" disabled>Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="multivalueInput">Specific Event ID:</label>
            <div class="events">
                <select id="eventSelector" class="form-control mb-2">
                    <option value="">Select Event ID</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->id }}</option>
                    @endforeach
                </select>
            </div>
            <div id="multivalueContainer" class="hidden"></div>
        </div>
        <div class="form-group">
            <label for="limit">Limit of Targeted Event:</label>
            <input type="text" class="form-control" id="limit" name="event_limit">
        </div>
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

        .hidden {
            display: none;
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
            $('#user_interest').select2();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle event selection
            var eventSelector = document.getElementById('eventSelector');
            var multivalueContainer = document.getElementById('multivalueContainer');

            eventSelector.addEventListener('change', function() {
                var selectedOption = eventSelector.options[eventSelector.selectedIndex];
                if (selectedOption.value) {
                    var selectedEvent = document.createElement('div');
                    selectedEvent.classList.add('tag');
                    selectedEvent.textContent = selectedOption.text;
                    multivalueContainer.appendChild(selectedEvent);

                    var hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'events_id[]';
                    hiddenInput.value = selectedOption.value;
                    multivalueContainer.appendChild(hiddenInput);

                    // Remove hidden class to show the container
                    multivalueContainer.classList.remove('hidden');

                    eventSelector.value = ''; // Reset the selector
                }
            });
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
            // Function to update the count
            function updateCount() {
                $.ajax({
                    url: '{{ route("code-count") }}',
                    type: 'POST',
                    data: $('form').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('.user-count').text(`Users: ${data.user_count}`);
                        $('.events-count').text(`Events: ${data.eventsCount}`);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error occurred: " + error);
                    }
                });
            }

            // Trigger updateCount when any input field changes
            $('input, select').on('change', function() {
                updateCount();
            });
        });
    </script>
@endsection
