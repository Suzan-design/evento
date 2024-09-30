<?php $__env->startSection('title'); ?>
    Create Event
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .addClassBtn, .addServiceProviderBtn {
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

        .addClassBtn:hover, .addServiceProviderBtn:hover {
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

        .form-control, .form-select {
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
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
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

        .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .custom-control-input:focus ~ .custom-control-label::before {
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

        #preview-images img, #preview-videos video {
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

        .preview-image, .preview-video {
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
            object-fit: cover; /* Added to prevent stretching */
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <hr/>
    <form action="<?php echo e(route('events.store')); ?>" method="POST" enctype="multipart/form-data" id="eventForm">
        <?php echo csrf_field(); ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="form-section">
            <h5>Event Details</h5>
            <div class="row mb-3">
                <label>Title</label>
                <div class="col">
                    <input type="text" required name="title" class="form-control" placeholder="Title" maxlength="255">
                </div>
            </div>
            <div class="row mb-3">
                <label>Title AR</label>
                <div class="col">
                    <input type="text" required name="title_ar" class="form-control" placeholder="Title AR" maxlength="255">
                </div>
            </div>
            <div class="row mb-3">
                <label>Capacity</label>
                <div class="col">
                    <input type="number" required name="capacity" class="form-control" placeholder="Capacity" min="0">
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
                        <?php $__currentLoopData = $organizers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $organizer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($organizer->id); ?>" data-src="<?php echo e(asset('storage/'.$organizer->profile)); ?>"><?php echo e($organizer->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col" id="organizer-photo"></div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="venue_id" class="form-label">Venue</label>
                    <select id="venue_id" name="venue_id" class="form-control" required onchange="if(this.value === 'addNew'){window.location.href='<?php echo e(url('venues/create')); ?>';}">
                        <option value="" disabled selected>Select Venue</option>
                        <?php $__currentLoopData = $venues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($venue->id); ?>" data-src="<?php echo e(asset('storage/'.$venue->profile)); ?>"><?php echo e($venue->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <option value="addNew" style="font-weight:bold; color:green;">+ Add New Venue</option>
                    </select>
                </div>
                <div class="col" id="venue-photo"></div>
            </div>
        </div>

        <div class="form-section">
            <div class="row-between mb-3">
                <h5>Service Providers</h5>
                <button type="button" id="addServiceProviderBtn" class="addServiceProviderBtn">+</button>
            </div>
            <div id="serviceProviderContainer"></div>
        </div>

        <div class="form-section">
            <h5>Categories & Amenities</h5>
            <div class="row mb-3">
                <label>Categories</label>
                <div class="col">
                    <select name="category_ids[]" class="form-control" id="categoryDropdown" required multiple>
                        <option value="" disabled>Select Categories</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" data-icon="<?php echo e(asset('storage/' . $category->icon)); ?>"><?php echo e($category->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label>Amenity</label>
                <div class="col">
                    <select name="amenity[]" id="amenitySelect" class="form-control" required multiple>
                        <option value="" disabled>Select Amenity</option>
                        <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($amenity->id); ?>" data-icon="<?php echo e(asset('storage/' . $amenity->icon)); ?>"><?php echo e($amenity->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <div class="classGroup mt-3 d-flex align-items-start">
                    <div class="flex-grow-1">
                        <h5>Class 1</h5>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="code_0" class="form-label">Code:</label>
                                <input type="text" id="code_0" name="classes[0][code]" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="description_0" class="form-label">Description:</label>
                                <textarea id="description_0" name="classes[0][description]" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="description_ar_0" class="form-label">Description AR:</label>
                                <textarea id="description_ar_0" name="classes[0][description_ar]" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="ticket_price_0" class="form-label">Ticket Price: (SP)</label>
                                <input type="number" id="ticket_price_0" name="classes[0][ticket_price]" class="form-control" required min="0">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="ticket_number_0" class="form-label">Number of Ticket: (no)</label>
                                <input type="number" id="ticket_number_0" name="classes[0][ticket_number]" class="form-control" required min="0">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="amenity_0" class="form-label">Amenity :</label>
                                <select id="amenity_0" name="classes[0][amenity_ids][]" data-placeholder="Select Amenity" class="form-select" multiple required>
                                    <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($amenity->id); ?>" data-icon="<?php echo e(asset('storage/' . $amenity->icon)); ?>"><?php echo e($amenity->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="form-section">
            <h5>Event Dates</h5>
            <div class="row mb-3">
                <label>Start Date</label>
                <div class="col">
                    <input type="datetime-local" name="start_date" class="form-control" required min="<?php echo e(now()->format('Y-m-d\TH:i')); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label>End Date</label>
                <div class="col">
                    <input type="datetime-local" name="end_date" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h5>Pricing & Taxes</h5>
            <div class="row mb-3">
                <label>Ticket Price: (SP)</label>
                <div class="col">
                    <input type="number" required name="ticket_price" class="form-control" placeholder="Ticket Price" min="0">
                </div>
            </div>
            <div class="row mb-3">
                <label>E-Cash Taxes Amount</label>
                <div class="col">
                    <input type="number" id="ecash" name="ecash_taxes" class="form-control" placeholder="Ecash Taxes Amount">
                </div>
            </div>
            <div class="row mb-3">
                <label>App Taxes Type</label>
                <div class="col">
                    <select id="app_taxes_type" name="app_taxes_type" class="form-control" required>
                        <option value="">Select App Taxes Type</option>
                        <option value="percent">Percent %</option>
                        <option value="amount">Fixed Amount</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label>App Taxes</label>
                <div class="col">
                    <input type="number" id="app_taxes_percent" name="app_taxes" class="form-control" placeholder="App Taxes">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h5>Event Program</h5>
            <button type="button" id="addEventTripBtn" class="addClassBtn">+</button>
            <div id="eventTripContainer"></div>
        </div>

        <div class="form-section">
            <h5>Media Uploads</h5>
            <div class="row mb-3">
                <label>Upload Images</label>
                <div class="col">
                    <div id="image-upload" class="upload-box">
                        <span class="upload-icon">+</span>
                    </div>
                    <input type="file" name="images[]" id="image-input" class="form-control-file" accept="image/*" required multiple style="display: none;">
                    <div id="preview-images" class="d-flex mt-2"></div>
                </div>
            </div>

            <div class="row mb-3">
                <label>Upload Videos</label>
                <div class="col">
                    <div id="video-upload" class="upload-box">
                        <span class="upload-icon">+</span>
                    </div>
                    <input type="file" name="videos[]" id="video-input" class="form-control-file" accept="video/*" multiple style="display: none;">
                    <div id="preview-videos" class="d-flex mt-2"></div>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h5>Event Description</h5>
            <div class="row mb-3">
                <label>Description</label>
                <div class="col">
                    <textarea name="description" class="form-control" required maxlength="1000"></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label>Description AR</label>
                <div class="col">
                    <textarea name="description_ar" class="form-control" required maxlength="1000"></textarea>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h5>Event Links</h5>
            <div class="row mb-3">
                <label>Website</label>
                <div class="col">
                    <input type="url" name="website" class="form-control" placeholder="Website URL">
                </div>
            </div>

            <div class="row mb-3">
                <label>Instagram</label>
                <div class="col">
                    <input type="url" name="instagram" class="form-control" placeholder="Instagram URL">
                </div>
            </div>

            <div class="row mb-3">
                <label>Facebook</label>
                <div class="col">
                    <input type="url" name="facebook" class="form-control" placeholder="Facebook URL">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h5>Policies</h5>
            <div class="row mb-3">
                <div class="col">
                    <label>Refund Policy</label>
                    <textarea name="refund_policy" class="form-control" placeholder="Refund Policy" required></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label>Refund Policy (AR)</label>
                    <textarea name="refund_policy_ar" class="form-control" placeholder="Refund Policy in Arabic" required></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label>Cancellation Time (hrs)</label>
                    <input type="number" name="cancellation_time" class="form-control" placeholder="Cancellation Time" required></input>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label>Cancellation Policy</label>
                    <textarea name="cancellation_policy" class="form-control" placeholder="Cancellation Policy" required></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label>Cancellation Policy (AR)</label>
                    <textarea name="cancellation_policy_ar" class="form-control" placeholder="Cancellation Policy in Arabic" required></textarea>
                </div>
            </div>
        </div>

        <div class="form-section" style="background-color: #fff3cd; border: 1px solid #ffeeba;">
            <label class="form-label"><strong>Event Type (Important)</strong></label>
            <div class="col">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="eventTypeSwitch" name="type" value="featured">
                    <label class="custom-control-label" for="eventTypeSwitch">Toggle for Featured Event</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
$(document).ready(function() {
    $('select').select2();

    const eventForm = document.getElementById('eventForm');
    eventForm.addEventListener('submit', function(event) {
        let isValid = true;
        const errors = [];

        // Validating 'title'
        const title = document.querySelector('[name="title"]');
        if (!title.value.trim()) {
            errors.push('Title is required.');
            isValid = false;
        } else if (title.value.length > 255) {
            errors.push('Title must not exceed 255 characters.');
            isValid = false;
        }

        // Validating 'capacity'
        const capacity = document.querySelector('[name="capacity"]');
        if (!capacity.value.trim()) {
            errors.push('Capacity is required.');
            isValid = false;
        } else if (isNaN(capacity.value) || parseInt(capacity.value) < 0) {
            errors.push('Capacity must be a non-negative integer.');
            isValid = false;
        }

        // Validating date fields
        const startDate = new Date(document.querySelector('[name="start_date"]').value);
        const endDate = new Date(document.querySelector('[name="end_date"]').value);
        if (startDate >= endDate) {
            errors.push('End date must be after start date.');
            isValid = false;
        }

        // Validating ticket price
        const ticketPrice = document.querySelector('[name="ticket_price"]');
        if (!ticketPrice.value.trim()) {
            errors.push('Ticket price is required.');
            isValid = false;
        } else if (isNaN(ticketPrice.value) || parseFloat(ticketPrice.value) < 0) {
            errors.push('Ticket price must be a non-negative number.');
            isValid = false;
        }

        // Validating total tickets against capacity
        let totalTickets = 0;
        document.querySelectorAll('[name^="classes"][name$="[ticket_number]"]').forEach(input => {
            totalTickets += parseInt(input.value) || 0;
        });
        if (totalTickets !== parseInt(capacity.value)) {
            errors.push('The total number of tickets for all classes must equal the specified capacity.');
            isValid = false;
        }

        // New validation for amenities in classes
        const selectedAmenities = Array.from(document.querySelectorAll('#amenitySelect option:checked')).map(option => option.value);
        const selectedAmenityNames = Array.from(document.querySelectorAll('#amenitySelect option:checked')).map(option => option.text);
        const classAmenities = [];

        document.querySelectorAll('[name^="classes"]').forEach(classGroup => {
            const amenities = Array.from(classGroup.querySelectorAll('[name$="[amenity_ids][]"] option:checked')).map(option => option.value);
            classAmenities.push(...amenities);
        });

        const invalidAmenities = classAmenities.filter(amenity => !selectedAmenities.includes(amenity));
        const invalidAmenityNames = invalidAmenities.map(amenity => {
            const index = selectedAmenities.indexOf(amenity);
            return index !== -1 ? selectedAmenityNames[index] : amenity; // Get the name or return the amenity if not found
        }).filter(name => name !== undefined); // Filter out undefined values

        if (invalidAmenityNames.length > 0) {
            invalidAmenityNames.forEach(name => {
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
            // Initialize select2 for existing select elements
            $('select').select2({
                placeholder: function() {
                    $(this).data('placeholder');
                },
                allowClear: true,
                templateResult: formatState,
                templateSelection: formatState
            });

            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }
                var iconUrl = $(state.element).data('icon');
                if (iconUrl) {
                    var $state = $(
                        '<span><img src="' + iconUrl +
                        '" class="img-flag" style="width: 20px; margin-right: 10px;" /> ' + state.text +
                        '</span>'
                    );
                    return $state;
                }
                return state.text;
            }

            $('#amenitySelect').change(function() {
                $('.dynamicFields').remove();
                var selectedOptions = $(this).find('option:selected');
                selectedOptions.each(function() {
                    var amenityId = $(this).val();
                    var amenityText = $(this).text();

                    var dynamicFieldsHtml = `
                        <div class="dynamicFields">
                            <h5>${amenityText}</h5>
                            <div class="row mb-3">
                                <label>Description for ${amenityText}</label>
                                <div class="col">
                    <input type="text" name="amenity[${amenityId}][description]" class="form-control" placeholder="Description" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label>Description AR for ${amenityText}</label>
                                <div class="col">
                    <input type="text" name="amenity[${amenityId}][description_ar]" class="form-control" placeholder="Description" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label>Price for ${amenityText} (SP)</label>
                                <div class="col">
                                    <input type="number" name="amenity[${amenityId}][price]" class="form-control" placeholder="Price" required min="0">
                                </div>
                            </div>
                        </div>
                    `;

                    $('#dynamicFieldsContainer').append(dynamicFieldsHtml);
                });
            });

            $('#addClassBtn').click(function() {
                const classesContainer = $('#classesContainer');
                const newClassIndex = classesContainer.children().length;

                const newClassHtml = `
            <div class="classGroup mt-3 d-flex align-items-start">
                <div class="flex-grow-1">
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
                        <label for="description_ar_${newClassIndex}" class="form-label">Description AR :</label>
                        <input type="text" id="description_ar_${newClassIndex}" name="classes[${newClassIndex}][description_ar]" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="ticket_price_${newClassIndex}" class="form-label">Ticket Price:</label>
                        <input type="number" id="ticket_price_${newClassIndex}" name="classes[${newClassIndex}][ticket_price]" class="form-control" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="ticket_number_${newClassIndex}" class="form-label">Number of Ticket: (no)</label>
                        <input type="number" id="ticket_number_${newClassIndex}" name="classes[${newClassIndex}][ticket_number]" class="form-control" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="amenity_${newClassIndex}" class="form-label">Amenity :</label>
                        <select id="amenity_${newClassIndex}" name="classes[${newClassIndex}][amenity_ids][]" data-placeholder="Select Amenity" class="form-select" multiple required>
                            <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($amenity->id); ?>"><?php echo e($amenity->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <span class="remove-btn" onclick="removeClass(this)">x</span>
        </div>
        `;

                classesContainer.append(newClassHtml);
                classesContainer.find('select').last().select2({
                    placeholder: function() {
                        $(this).data('placeholder');
                    },
                    allowClear: true
                });

            });

            $('#addServiceProviderBtn').click(function() {
                const serviceProviderContainer = $('#serviceProviderContainer');
                const newServiceProviderIndex = serviceProviderContainer.children().length;

                // Modified Option Structure to fit the format seen in the screenshot
                let optionsHtml = '<option value="" disabled selected>Select Service Provider</option>';
                <?php $__currentLoopData = $serviceProviders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceProvider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    optionsHtml +=
                        `<option value="<?php echo e($serviceProvider->id); ?>" data-src="<?php echo e(asset('storage/' . $serviceProvider->profile)); ?>"><?php echo e($serviceProvider->name); ?></option>`;
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                const newServiceProviderHtml =
                    `
    <div class="serviceProviderGroup mt-3">
        <label for="service_provider_${newServiceProviderIndex}" class="form-label">Service Provider ${newServiceProviderIndex + 1}:</label>
        <select id="service_provider_${newServiceProviderIndex}" name="service_providers[${newServiceProviderIndex}]">
            ${optionsHtml}
        </select>
    </div>`;

                serviceProviderContainer.append(newServiceProviderHtml);

                // Use the formatState function for the templateResult and templateSelection properties of the select2 initialization
                function formatState(state) {
                    if (!state.id) {
                        return state.text;
                    }
                    var imgSrc = $(state.element).data('src');
                    var imgWidth = "32px"; // Adjust the image width
                    var imgHeight = "32px"; // Adjust the image height
                    var $state = $(
                        '<span><img src="' + imgSrc + '" class="img-flag" width="' + imgWidth +
                        '" height="' + imgHeight + '" /> ' + state.text + '</span>'
                    );
                    return $state;
                };

                serviceProviderContainer.find('select').last().select2({
                    templateResult: formatState,
                    templateSelection: formatState
                });
            });

            $('#addEventTripBtn').click(function() {
                const eventTripContainer = $('#eventTripContainer');
                const newEventTripIndex = eventTripContainer.children().length;

                const newEventTripHtml = `
        <div class="eventTripGroup mt-3">
            <h5>Event Program ${newEventTripIndex + 1}</h5>
            <div class="mb-3">
                <label for="trip_date_${newEventTripIndex}" class="form-label">Program Start Date:</label>
                <input type="datetime-local" id="trip_date_${newEventTripIndex}" name="event_trips[${newEventTripIndex}][start_date]" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="trip_date_${newEventTripIndex}" class="form-label">Program End Date:</label>
                <input type="datetime-local" id="trip_date_${newEventTripIndex}" name="event_trips[${newEventTripIndex}][end_date]" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="trip_description_${newEventTripIndex}" class="form-label">Description:</label>
                <textarea id="trip_description_${newEventTripIndex}" name="event_trips[${newEventTripIndex}][description]" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="trip_description_${newEventTripIndex}" class="form-label">Description AR:</label>
                <textarea id="trip_description_${newEventTripIndex}" name="event_trips[${newEventTripIndex}][description_ar]" class="form-control" required></textarea>
            </div>
        </div>
    `;

                eventTripContainer.append(newEventTripHtml);
            });

            $('#image-upload').click(function() {
                $('#image-input').click();
            });

            $('#image-input').change(function() {
                previewFiles(this, '#preview-images');
            });

            $('#video-upload').click(function() {
                $('#video-input').click();
            });

            $('#video-input').change(function() {
                previewFiles(this, '#preview-videos');
            });

            document.getElementById('eventTypeSwitch').addEventListener('change', function() {
                if (this.checked) {
                    this.nextElementSibling.innerHTML = '<strong>Featured Event</strong>';
                } else {
                    this.nextElementSibling.innerHTML = '<strong>Toggle for Featured Event</strong>';
                }
            });


            function previewFiles(input, previewContainer) {
                var files = input.files;
                $(previewContainer).empty(); // Clear the preview

                for (var i = 0; i < files.length; i++) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var img = $('<img>').attr('src', e.target.result).addClass('img-thumbnail').css({
                            'width': '100px',
                            'height': '100px'
                        });
                        var div = $('<div>').addClass('preview-image').append(img);
                        var removeBtn = $('<span>').text('X').addClass('remove-image');

                        removeBtn.click(function() {
                            $(this).parent().remove();
                        });

                        div.append(removeBtn);
                        $(previewContainer).append(div);
                    }

                    reader.readAsDataURL(files[i]);
                }
            }
            $('form').on('submit', function() {
                $('#amenitySelect').prop('disabled', true);
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('categoryDropdown');
            const options = select.options;

            for (let i = 0; i < options.length; i++) {
                const option = options[i];
                const iconUrl = option.getAttribute('data-icon');

                if (iconUrl) {
                    const img = document.createElement('img');
                    img.src = iconUrl;
                    img.alt = 'Category Icon';
                    img.style.width = '20px'; // Adjust size as needed
                    img.style.marginRight = '10px'; // Adjust spacing as needed

                    const text = document.createTextNode(' ' + option.text);

                    const span = document.createElement('span');
                    span.appendChild(img);
                    span.appendChild(text);

                    option.innerHTML = ''; // Clear the existing text
                    option.appendChild(span);
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('select').select2();

            $('#amenitySelect').change(function() {
                $('#dynamicFieldsContainer').empty(); // Clear previous fields
                var selectedOptions = $(this).find('option:selected');
                selectedOptions.each(function() {
                    var amenityId = $(this).val();
                    var amenityText = $(this).text();

                    var dynamicFieldsHtml = `
                        <div class="dynamicFields">
                            <h5>${amenityText}</h5>
                            <div class="row mb-3">
                                <label>Description for ${amenityText}</label>
                                <div class="col">
                                    <input type="text" name="amenity[${amenityId}][description]" class="form-control" placeholder="Description" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label>Description AR for ${amenityText}</label>
                                <div class="col">
                                    <input type="text" name="amenity[${amenityId}][description_ar]" class="form-control" placeholder="Description" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label>Price for ${amenityText} (SP)</label>
                                <div class="col">
                                    <input type="number" name="amenity[${amenityId}][price]" class="form-control" placeholder="Price" required min="0">
                                </div>
                            </div>
                        </div>
                    `;

                    $('#dynamicFieldsContainer').append(dynamicFieldsHtml);
                });
            });

            // Other scripts go here
            // ... [Your existing JS code] ...
        });

        // Function to remove class group
        function removeClass(element) {
            $(element).closest('.classGroup').remove();
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Suzan\Downloads\evento\evento\resources\views/events/create.blade.php ENDPATH**/ ?>