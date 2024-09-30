@extends('layout.master')

@section('title')
    Edit Event
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .addClassBtn,
        .addServiceProviderBtn {
            background-color: #5cb85c;
            border: none;
            color: white;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            font-weight: bold;
            font-size: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            margin-left: 10px;
        }

        .addClassBtn:hover,
        .addServiceProviderBtn:hover {
            background-color: #4cae4c;
        }

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
            font-weight: bold;
        }

        .form-control,
        .form-select {
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
            border: none;
            font-weight: bold;
        }

        form {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .select2-container .select2-selection--single {
            height: 38px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px;
        }

        .select2-dropdown {
            border-color: #ddd;
            border-top: none;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #5cb85c;
            color: white;
        }

        .custom-control-input:checked~.custom-control-label::before {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .custom-control-input:focus~.custom-control-label::before {
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .custom-switch .custom-control-label::before {
            border-radius: 0.25rem;
        }

        .upload-box {
            width: 100px;
            height: 100px;
            border: 2px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 10px;
            margin: 10px;
        }

        .upload-icon {
            font-size: 24px;
        }

        .form-section {
            background: #f9f9f9;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        .form-section h5 {
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        #preview-images img,
        #preview-videos video {
            width: 100px;
            height: 100px;
            margin-right: 10px;
            object-fit: cover;
            border-radius: 10px;
        }

        .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border-radius: 50%;
            cursor: pointer;
            padding: 2px 5px;
        }

        .preview-image,
        .preview-video {
            position: relative;
            display: inline-block;
            margin: 5px;
        }

        .remove-btn {
            color: red;
            font-weight: bold;
            cursor: pointer;
            margin-left: 10px;
            font-size: 20px;
        }

        .img-circle {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            object-fit: cover;
            /* Added to prevent stretching */
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            margin-right: 5px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice img {
            border-radius: 50%;
            margin-right: 5px;
            width: 20px;
            height: 20px;
        }

        .classGroup {
            flex-grow: 1;
            padding-right: 10px;
        }

        .row-between {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
@endsection

@section('content')
    <hr />
    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data" id="eventForm">
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
        <div class="form-section">
            <h5>Event Details</h5>
            <div class="row mb-3">
                <label>Title</label>
                <div class="col">
                    <input type="text" required name="title" value="{{ $event->title }}" class="form-control"
                        placeholder="Title" maxlength="255">
                </div>
            </div>
            <div class="row mb-3">
                <label>Title AR</label>
                <div class="col">
                    <input type="text" required name="title_ar" value="{{ $event->title_ar }}" class="form-control"
                        placeholder="Title AR" maxlength="255">
                </div>
            </div>
            <div class="row mb-3">
                <label>Capacity</label>
                <div class="col">
                    <input type="number" required name="capacity" value="{{ $event->capacity }}" class="form-control"
                        placeholder="Capacity" min="0">
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="row-between mb-3">
                <h5>Organizer & Venue</h5>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="organizer_id" class="form-label">Organizer</label>
                    <select id="organizer_id" name="organizer_id" class="form-control" required>
                        <option value="" disabled selected>Select Organizer</option>
                        @foreach ($organizers as $organizer)
                            <option value="{{ $organizer->id }}" data-src="{{ asset('storage/' . $organizer->profile) }}"
                                @if ($organizer->id === $event->organizer_id) selected @endif>{{ $organizer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col" id="organizer-photo"></div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="venue_id" class="form-label">Venue</label>
                    <select id="venue_id" name="venue_id" class="form-control" required
                        onchange="if(this.value === 'addNew'){window.location.href='{{ url('venues/create') }}';}">
                        <option value="" disabled selected>Select Venue</option>
                        @foreach ($venues as $venue)
                            <option value="{{ $venue->id }}" @if ($venue->id === $event->venue_id) selected @endif
                                data-src="{{ asset('storage/' . $venue->profile) }}">{{ $venue->name }}</option>
                        @endforeach
                        <option value="addNew" style="font-weight:bold; color:green;">+ Add New Venue</option>
                    </select>
                </div>
                <div class="col" id="venue-photo"></div>
            </div>
        </div>

        <!-- Service Providers Section -->
        <div class="row mb-3">
            <div class="Service">
                <label>Service Providers</label>
            </div>
            <div class="col" id="serviceProvidersContainer">

                <div class="serviceProviderGroup" data-index="new">
                    <div class="service_providers">
                        <select name="service_providers[new]" class="form-control mb-2 service-provider-select">
                            <option value="">Select Service Provider</option>
                            @foreach ($serviceProviders as $provider)
                                <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="selected-provider-name mt-2"></div>
                    <hr>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h5>Categories & Amenities</h5>
            <div class="row mb-3">
                <label>Categories</label>
                <div class="col">
                    <select name="category_ids[]" class="form-control" id="categoryDropdown" required multiple>
                        <option value="" disabled>Select Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if (in_array($category->id, $event->categories->pluck('id')->toArray())) selected @endif
                                data-icon="{{ asset('storage/' . $category->icon) }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label>Amenity</label>
                <div class="col">
                    <select name="amenity[]" id="amenitySelect" class="form-control" required multiple>
                        <option value="" disabled>Select Amenity</option>
                        @foreach ($amenities as $amenity)
                            <option value="{{ $amenity->id }}" @if (in_array($amenity->id, $event->amenities->pluck('id')->toArray())) selected @endif
                                data-icon="{{ asset('storage/' . $amenity->icon) }}">{{ $amenity->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="dynamicFieldsContainer"></div> <!-- Container for dynamic fields -->
        </div>

        <div class="form-section">
            <div class="row-between mb-3">
                <h5>Classes</h5>
                <button type="button" id="addClassBtn" class="addClassBtn">+</button>
            </div>
            <div id="classesContainer">
                @foreach ($event->classes as $index => $class)
                    <div class="classGroup mt-3">
                        <h5>Class {{ $index + 1 }}</h5>
                        <div class="mb-3">
                            <label for="code_{{ $index }}" class="form-label">Code:</label>
                            <input type="text" id="code_{{ $index }}"
                                name="classes[{{ $index }}][code]" class="form-control" required
                                value="{{ old('classes.' . $index . '.code', $class->code) }}">
                        </div>
                        <div class="mb-3">
                            <label for="description_{{ $index }}" class="form-label">Description:</label>
                            <input type="text" id="description_{{ $index }}"
                                name="classes[{{ $index }}][description]" class="form-control" required
                                value="{{ old('classes.' . $index . '.description', $class->description) }}">
                        </div>
                        <div class="mb-3">
                            <label for="description_ar_{{ $index }}" class="form-label">Description AR:</label>
                            <input type="text" id="description_ar_{{ $index }}"
                                name="classes[{{ $index }}][description_ar]" class="form-control" required
                                value="{{ old('classes.' . $index . '.description_ar', $class->description_ar) }}">
                        </div>
                        <div class="mb-3">
                            <label for="ticket_price_{{ $index }}" class="form-label">Ticket Price:</label>
                            <input type="number" id="ticket_price_{{ $index }}"
                                name="classes[{{ $index }}][ticket_price]" class="form-control" required
                                min="0"
                                value="{{ old('classes.' . $index . '.ticket_price', $class->ticket_price) }}">
                        </div>
                        <div class="mb-3">
                            <label for="ticket_number_{{ $index }}" class="form-label">Number of Ticket:</label>
                            <input type="number" id="ticket_number_{{ $index }}"
                                name="classes[{{ $index }}][ticket_number]" class="form-control" required
                                min="0"
                                value="{{ old('classes.' . $index . '.ticket_number', $class->ticket_number) }}">
                        </div>
                        <div class="mb-3">
                            <label for="amenity_{{ $index }}" class="form-label">Amenity:</label>
                            <select id="amenity_{{ $index }}" name="classes[{{ $index }}][amenity_ids][]"
                                data-placeholder="Select Amenity" class="form-select" multiple required>
                                @foreach ($amenities as $amenity)
                                    <option value="{{ $amenity->id }}"
                                        {{ in_array($amenity->id, old('classes.' . $index . '.amenity_ids', $class->amenities->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $amenity->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="btn btn-danger removeClassBtn">Remove Class</button>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-section">
            <h5>Event Dates</h5>
            <div class="row mb-3">
                <label>Start Date</label>
                <div class="col">
                    <input type="datetime-local" name="start_date"
                        value="{{ \Carbon\Carbon::parse($event->start_date)->format('Y-m-d\TH:i') }}"
                        class="form-control" required min="{{ now()->format('Y-m-d\TH:i') }}">
                </div>
            </div>
            <div class="row mb-3">
                <label>End Date</label>
                <div class="col">
                    <input type="datetime-local" name="end_date"
                        value="{{ \Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i') }}" class="form-control"
                        required>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h5>Pricing & Taxes</h5>
            <div class="row mb-3">
                <label>Ticket Price: (SP)</label>
                <div class="col">
                    <input type="number" required name="ticket_price" class="form-control"
                        value="{{ $event->ticket_price }}" placeholder="Ticket Price" min="0">
                </div>
            </div>
            <div class="row mb-3">
                <label>E-Cash Taxes Amount</label>
                <div class="col">
                    <input type="number" id="ecash" name="ecash_taxes" class="form-control"
                        value="{{ $event->ticket_price }}" placeholder="Ecash Taxes Amount">
                </div>
            </div>
            <div class="row mb-3">
                <label>App Taxes Type</label>
                <div class="col">
                    <select id="app_taxes_type" name="app_taxes_type" class="form-control" required>
                        <option value="">Select App Taxes Type</option>
                        <option value="percent" @if ($event->app_taxes_type === 'percent') selected @endif>Percent %</option>
                        <option value="amount" @if ($event->app_taxes_type === 'amount') selected @endif>Fixed Amount</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label>App Taxes</label>
                <div class="col">
                    <input type="number" id="app_taxes_percent" name="app_taxes" value="{{ $event->app_taxes }}"
                        class="form-control" placeholder="App Taxes">
                </div>
            </div>
        </div>

        <div class="form-section">
            <label>Event Program</label>
            <div class="col" id="eventTripsContainer">
                @foreach ($event->eventTrips as $index => $eventTrip)
                    <div class="eventTripGroup" data-index="{{ $index }}">
                        <input type="datetime-local" name="event_trips[{{ $index }}][start_date]"
                            class="form-control mb-2" value="{{ $eventTrip->start_date }}" required>
                        <input type="datetime-local" name="event_trips[{{ $index }}][end_date]"
                            class="form-control mb-2" value="{{ $eventTrip->end_date }}" required>
                        <textarea name="event_trips[{{ $index }}][description]" class="form-control mb-2" required>{{ $eventTrip->description }}</textarea>
                        <textarea name="event_trips[{{ $index }}][description_ar]" class="form-control mb-2" required>{{ $eventTrip->description_ar }}</textarea>
                        <button type="button" class="btn btn-danger removeEventTripBtn">Remove Event Trip</button>
                    </div>
                    <hr>
                @endforeach
            </div>
            <button type="button" id="addEventTripBtn" class="btn btn-primary">Add Event Program</button>
        </div>

        <div class="form-section">
            <h5>Media Uploads</h5>
            <div class="row mb-3">
                @if ($event->images)
                    @foreach (json_decode($event->images) as $index => $image)
                        <div class="image-container">
                            <img src="{{ asset('storage/' . $image) }}" alt="EVENT Image">
                            <button type="button" class="btn btn-danger removeImageBtn"
                                data-index="{{ $index }}">
                                <i class="bi bi-x"></i>
                            </button>

                            <input type="hidden" name="existing_images[]" value="{{ $image }}">
                        </div>
                    @endforeach
                @else
                    <div class="detail-value">No images available</div>
                @endif
            </div>

            <div class="row mb-3">
                <label>Upload Videos</label>
                <div class="col">
                    <div id="video-upload" class="upload-box">
                        <span class="upload-icon">+</span>
                    </div>
                    @if ($event->videos)
                        @foreach (json_decode($event->videos) as $index => $video)
                            <div class="video-container">
                                <video width="200" controls>
                                    <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <button type="button" class="btn btn-danger removeVideoBtn"
                                    data-index="{{ $index }}"><i class="bi bi-x"></i></button>
                                <input type="hidden" name="existing_videos[]" value="{{ $video }}">
                            </div>
                        @endforeach
                    @else
                        <div class="detail-value">No videos available</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-section">
            <h5>Event Description</h5>
            <div class="row mb-3">
                <label>Description</label>
                <div class="col">
                    <textarea name="description" class="form-control" required maxlength="1000">{{ $event->description }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label>Description AR</label>
                <div class="col">
                    <textarea name="description_ar" class="form-control" required maxlength="1000">{{ $event->description_ar }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h5>Event Links</h5>
            <div class="row mb-3">
                <label>Website</label>
                <div class="col">
                    <input type="url" name="website" value="{{ $event->website }}" class="form-control"
                        placeholder="Website URL">
                </div>
            </div>

            <div class="row mb-3">
                <label>Instagram</label>
                <div class="col">
                    <input type="url" name="instagram" value="{{ $event->instagram }}" class="form-control"
                        placeholder="Instagram URL">
                </div>
            </div>

            <div class="row mb-3">
                <label>Facebook</label>
                <div class="col">
                    <input type="url" name="facebook" value="{{ $event->facebook }}" class="form-control"
                        placeholder="Facebook URL">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h5>Policies</h5>
            <div class="row mb-3">
                <div class="col">
                    <label>Refund Policy</label>
                    <textarea name="refund_policy" class="form-control" placeholder="Refund Policy" required>{{ $event->refund_policy }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label>Refund Policy (AR)</label>
                    <textarea name="refund_policy_ar" class="form-control" placeholder="Refund Policy in Arabic" required>{{ $event->refund_policy_ar }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label>Cancellation Time (hrs)</label>
                    <input type="number" name="cancellation_time" value="{{ $event->cancellation_time }}"
                        class="form-control" placeholder="Cancellation Time" required></input>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label>Cancellation Policy</label>
                    <textarea name="cancellation_policy" class="form-control" placeholder="Cancellation Policy" required>{{ $event->cancellation_policy }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label>Cancellation Policy (AR)</label>
                    <textarea name="cancellation_policy_ar" class="form-control" placeholder="Cancellation Policy in Arabic" required>{{ $event->cancellation_policy_ar }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-section" style="background-color: #fff3cd; border: 1px solid #ffeeba;">
            <label class="form-label"><strong>Event Type (Important)</strong></label>
            <div class="col">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="eventTypeSwitch" name="type"
                        value="featured">
                    <label class="custom-control-label" for="eventTypeSwitch">Toggle for Featured Event</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Update Event</button>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
$(document).ready(function() {
    let globalIndexCounter = {{ count($event->serviceProviders) }};
    const serviceProvidersContainer = $('#serviceProvidersContainer');

    // Function to handle the addition of a new service provider
    function addServiceProvider(selectedValue, selectedText) {
        globalIndexCounter++;

        const newTag = `
            <div class="input-group mb-2">
                <input type="text" name="service_providers[${globalIndexCounter}]" class="form-control" value="${selectedValue}" readonly hidden>
                <input type="text" style="width: 50%;" class="form-control" value="${selectedText}" readonly>
                <button class="remove-provider-btn btn btn-outline-danger">✖</button>
            </div>
        `;
        serviceProvidersContainer.append(newTag);
    }

    // Initializing select2 for dynamic fields
    $('select').select2();

    // Event handler for change on service-provider-select
    serviceProvidersContainer.on('change', '.service-provider-select', function() {
        const selectedValue = $(this).val();
        const selectedText = $(this).find('option:selected').text();

        if (selectedValue) {
            addServiceProvider(selectedValue, selectedText);

            // Reset the select field
            $(this).val('').trigger('change');
        }
    });

    // Event delegation to handle click event on dynamically added remove buttons
    serviceProvidersContainer.on('click', '.remove-provider-btn', function() {
        $(this).closest('.input-group').remove();
    });

    // Initialize existing service providers
    @foreach($event->serviceProviders as $index => $serviceProvider)
        addServiceProvider('{{ $serviceProvider->id }}', '{{ $serviceProvider->name }}');
    @endforeach
});
</script>

    <script>

    document.addEventListener('DOMContentLoaded', function () {
        const eventForm = document.getElementById('eventForm');

        eventForm.addEventListener('submit', function (event) {
            // Preventing the form from submitting if the dates are incorrect
            const startDate = new Date(document.querySelector('[name="start_date"]').value);
            const endDate = new Date(document.querySelector('[name="end_date"]').value);
            if (endDate <= startDate) {
                alert('End date must be after start date.');
                event.preventDefault();
                return false;
            }

            // Validating total tickets against capacity
            let totalTickets = 0;
            document.querySelectorAll('[name^="classes"][name$="[ticket_number]"]').forEach(input => {
                totalTickets += parseInt(input.value) || 0; // Sum up all ticket numbers, defaulting to 0 if NaN
            });

            const capacity = parseInt(document.querySelector('[name="capacity"]').value) || 0; // Get the capacity, defaulting to 0 if NaN
            if (totalTickets !== capacity) {
                alert('The total number of tickets for all classes must equal the specified capacity.');
                event.preventDefault(); // Prevent form submission
            }

            let isValid = true;
            const errors = [];

            // New validation for amenities in classes
            const selectedAmenities = Array.from(document.querySelectorAll('#amenitySelect option:checked')).map(option => option.value);
            const selectedAmenityNames = Array.from(document.querySelectorAll('#amenitySelect option:checked')).map(option => option.text);
            const classAmenities = [];

            document.querySelectorAll('[name^="classes"]').forEach(classGroup => {
                const amenities = Array.from(classGroup.querySelectorAll('[name$="[amenity_ids][]"] option:checked')).map(option => option.value);
                classAmenities.push(...amenities);
            });

            const invalidAmenities = classAmenities.filter(amenity => !selectedAmenities.includes(amenity));
            const uniqueInvalidAmenityNames = invalidAmenities.map(amenity => {
                const index = selectedAmenities.indexOf(amenity);
                return index !== -1 ? selectedAmenityNames[index] : amenity; // Get the name or return the amenity if not found
            }).filter(name => name !== undefined); // Filter out undefined values

            if (uniqueInvalidAmenityNames.length > 0) {
                uniqueInvalidAmenityNames.forEach(name => {
                    errors.push(`Amenity [${name}] not from selected amenities.`);
                });
                isValid = false;
            }

            // Display errors if any
            if (!isValid) {
                event.preventDefault();
                alert('Errors: \n' + errors.join('\n'));
            }
        });
    });
        $(document).ready(function() {
            // Initialize a global index counter


            $('select').select2();

            updateInterestFields();

            $('#amenitySelect').on('change', function() {
                updateInterestFields();
            });

            function updateInterestFields() {
                $('#dynamicFieldsContainer').empty();
                $('#amenitySelect').find('option:selected').each(function() {
                    var amenityId = $(this).val();
                    var amenityText = $(this).text();
                    var existingValues = getExistingValues(amenityId);
                    var dynamicFieldsHtml = generateInterestFields(amenityId, amenityText, existingValues);
                    $('#dynamicFieldsContainer').append(dynamicFieldsHtml);
                });
            }

            function getExistingValues(amenityId) {
                const existingAmenities = @json($event->amenities->keyBy('id'));
                const amenity = existingAmenities[amenityId] || {};

                return {
                    description: amenity.pivot ? amenity.pivot.description : '',
                    description_ar: amenity.pivot ? amenity.pivot.description_ar : '',
                    price: amenity.pivot ? amenity.pivot.price : ''
                };
            }

            function generateInterestFields(amenityId, amenityText, existingValues = {}) {
                const {
                    description = '',
                    description_ar = '',
                    price = ''
                } = existingValues;

                return `
                    <div class="dynamicFields" data-amenity-id="${amenityId}">
                        <h5>${amenityText}</h5>
                        <div class="row mb-3">
                            <label>Description for ${amenityText}</label>
                            <div class="col">
                                <input type="text" name="amenity[${amenityId}][description]" class="form-control" placeholder="Description" value="${description}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label>Description AR for ${amenityText}</label>
                            <div class="col">
                                <input type="text" name="amenity[${amenityId}][description_ar]" class="form-control" placeholder="Description AR" value="${description_ar}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label>Price for ${amenityText}</label>
                            <div class="col">
                                <input type="number" name="amenity[${amenityId}][price]" class="form-control" placeholder="Price" value="${price}" required min="0">
                            </div>
                        </div>
                    </div>
                `;
            }

            // Add Class
            $('#addClassBtn').click(function () {
                const classesContainer = $('#classesContainer');
                const newClassIndex = classesContainer.children().length;

                const newClassHtml = `
                    <div class="classGroup mt-3">
                        <h5>Class ${newClassIndex + 1}</h5>
                        <div class="mb-3">
                            <label for="code_${newClassIndex}" class="form-label">Code:</label>
                            <input type="text" id="code_${newClassIndex}" name="classes[${newClassIndex}][code]" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description_${newClassIndex}" class="form-label">Description:</label>
                            <input type="text" id="description_${newClassIndex}" name="classes[${newClassIndex}][description]" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description_ar_${newClassIndex}" class="form-label">Description AR:</label>
                            <input type="text" id="description_ar_${newClassIndex}" name="classes[${newClassIndex}][description_ar]" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="ticket_price_${newClassIndex}" class="form-label">Ticket Price:</label>
                            <input type="number" id="ticket_price_${newClassIndex}" name="classes[${newClassIndex}][ticket_price]" class="form-control" required min="0">
                        </div>
                        <div class="mb-3">
                            <label for="ticket_number_${newClassIndex}" class="form-label">Number of Ticket:</label>
                            <input type="number" id="ticket_number_${newClassIndex}" name="classes[${newClassIndex}][ticket_number]" class="form-control" required min="0">
                        </div>
                        <div class="mb-3">
                            <label for="amenity_${newClassIndex}" class="form-label">Amenity:</label>
                            <select id="amenity_${newClassIndex}" name="classes[${newClassIndex}][amenity_ids][]" data-placeholder="Select Amenity" class="form-select" multiple required>
                                @foreach($amenities as $amenity)
                                    <option value="{{ $amenity->id }}">{{ $amenity->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="btn btn-danger removeClassBtn">Remove Class</button>
                    </div>
                `;

                classesContainer.append(newClassHtml);
                classesContainer.find('select').last().select2({
                    placeholder: function () {
                        $(this).data('placeholder');
                    },
                    allowClear: true
                });

            });

            // Remove Class
            $('body').on('click', '.removeClassBtn', function() {
                $(this).closest('.classGroup').remove();
            });

            // Add Event Trip
            $('#addEventTripBtn').click(function() {
                var index = $('#eventTripsContainer .eventTripGroup').length;
                var eventTripHtml = `
                    <div class="eventTripGroup" data-index="${index}">
                        <input type="datetime-local" name="event_trips[${index}][start_date]" class="form-control mb-2" required>
                        <input type="datetime-local" name="event_trips[${index}][end_date]" class="form-control mb-2" required>
                        <textarea name="event_trips[${index}][description]" class="form-control mb-2" required></textarea>
                        <textarea name="event_trips[${index}][description_ar]" class="form-control mb-2" required></textarea>
                        <button type="button" class="btn btn-danger removeEventTripBtn">Remove Event Trip</button>
                    </div>
                    <hr>
                `;
                $('#eventTripsContainer').append(eventTripHtml);
            });

            // Remove Event Trip
            $('body').on('click', '.removeEventTripBtn', function() {
                $(this).closest('.eventTripGroup').remove();
            });

            // Remove Image
            $('body').on('click', '.removeImageBtn', function() {
                $(this).closest('.image-container').remove();
            });

            // Remove Video
            $('body').on('click', '.removeVideoBtn', function() {
                $(this).closest('.video-container').remove();
            });

            // Prevent empty amenities from being submitted
            $('form').submit(function() {
                $('#amenitySelect').find('option:selected').each(function() {
                    var amenityId = $(this).val();
                    if (!hasDetailFields(amenityId)) {
                        $(this).prop('selected', false);
                    }
                });
            });

            function hasDetailFields(amenityId) {
                const dynamicField = $(`[data-amenity-id="${amenityId}"]`);
                const description = dynamicField.find(`input[name="amenity[${amenityId}][description]"]`).val();
                const description_ar = dynamicField.find(`input[name="amenity[${amenityId}][description_ar]"]`).val();
                const price = dynamicField.find(`input[name="amenity[${amenityId}][price]"]`).val();
                return description && description_ar && price;
            }

            // Show/Hide APP Taxes input fields based on the selected type
            $('#app_taxes_type').on('change', function() {
                toggleAppTaxesFields();
            });

            toggleAppTaxesFields(); // Initial call to set the correct fields visibility

            function toggleAppTaxesFields() {
                const selectedType = $('#app_taxes_type').val();
                if (selectedType === 'percent') {
                    $('#appTaxesPercentContainer').show();
                    $('#appTaxesAmountContainer').hide();
                } else if (selectedType === 'amount') {
                    $('#appTaxesPercentContainer').hide();
                    $('#appTaxesAmountContainer').show();
                }
            }
        });
    </script>
@endsection

