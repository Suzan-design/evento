<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-1 bg-gradient-dark" id="sidenav-main">

    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#" target="_blank">
            <img src="<?php echo e(\Illuminate\Support\Facades\URL::asset('assets/img/evento_logo.png')); ?>" class="navbar-brand-img h-100" alt="main_logo">
        </a>
    </div>

    <hr class="horizontal light mt-0 mb-2">

    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('dashboard')); ?>">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>

                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('events.index')); ?>" >

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">event</i>
                    </div>

                    <span class="nav-link-text ms-1">Events</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('events-offers.index')); ?>">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">local_offer</i>
                    </div>

                    <span class="nav-link-text ms-1">Events Offer</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('event-requests.index')); ?>">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">playlist_add</i>
                    </div>

                    <span class="nav-link-text ms-1">Event Requests</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('cancelled_bookings')); ?>">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">playlist_add</i>
                    </div>

                    <span class="nav-link-text ms-1">Cancel Bookings Requests</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('organizers.index')); ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">group</i>
                    </div>
                    <span class="nav-link-text ms-1">Organizers</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('organizer-requests.index')); ?>">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person_add</i>
                    </div>

                    <span class="nav-link-text ms-1">Organizer Requests</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('updatedOrganizerRequests')); ?>">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person_add</i>
                    </div>

                    <span class="nav-link-text ms-1">Organizer Update Requests</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('serviceProvider-requests.index')); ?>">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">build</i>
                    </div>

                    <span class="nav-link-text ms-1">Service Provider Requests</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('venues.index')); ?>">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">place</i>
                    </div>

                    <span class="nav-link-text ms-1">Venues</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('service-providers.index')); ?>">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">business_center</i>
                    </div>

                    <span class="nav-link-text ms-1">Service Provider</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('events-request-categories.index')); ?>">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">category</i>
                    </div>

                    <span class="nav-link-text ms-1">Customize Event Category</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('services-categories.index')); ?>">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">list</i>
                    </div>

                    <span class="nav-link-text ms-1">Service Categories</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('events-categories.index')); ?>">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">event_note</i>
                    </div>

                    <span class="nav-link-text ms-1">Event Categories</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('interest.index')); ?>">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">local_activity</i>
                    </div>

                    <span class="nav-link-text ms-1">Amenity</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('reels.index')); ?>">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">video_library</i>
                    </div>

                    <span class="nav-link-text ms-1">Reels</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('promo_code.index')); ?>">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">local_offer</i>
                    </div>

                    <span class="nav-link-text ms-1">Promo Code</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('service_provider.review')); ?>">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">rate_review</i>
                    </div>

                    <span class="nav-link-text ms-1">Service Provider Reviews</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('event.review')); ?>">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">stars</i>
                    </div>

                    <span class="nav-link-text ms-1">Event Reviews</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('venue.review')); ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">location_on</i>
                    </div>
                    <span class="nav-link-text ms-1">Venue Reviews</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('notification.index')); ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">notifications</i>
                    </div>
                    <span class="nav-link-text ms-1">Notification Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="<?php echo e(route('users.index')); ?>">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">people</i>
                    </div>

                    <span class="nav-link-text ms-1">Users</span>
                </a>
            </li>


        </ul>
    </div>
</aside>
<?php /**PATH C:\Users\Suzan\Downloads\evento\evento\resources\views/layout/main-sidebar.blade.php ENDPATH**/ ?>