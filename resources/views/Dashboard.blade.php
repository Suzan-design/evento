@extends('layout.master')
<title>Evento Dashboard</title>
@section('content')
<div class="dashboard-title">Evento Dashboard</div>
<div class="container-fluid py-4 users">
  <h3 class="subtitle">User and Event Statistics</h3>
  {{-- start row --}}
  <div class="row mt-4">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">person</i>
          </div>
          <div class="text-end pt-1">
            <H1 class="text-sm mb-0 text-capitalize">Users</H1>
            <h4 class="font-weight-bolder">{{ $user_count ?? 'N/A' }}</h4>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
        <i class="material-icons opacity-10">event</i> 
          </div>
          <div class="text-end pt-1">
            <H1 class="text-sm mb-0 text-capitalize">Events</H1>
            <h4 class="font-weight-bolder">{{ $event_count ?? 'N/A' }}</h4>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
        <i class="material-icons opacity-10">receipt</i> 
          </div>
          <div class="text-end pt-1">
            <H1 class="text-sm mb-0 text-capitalize">Booking</H1>
            <h4 class="font-weight-bolder">{{ $booking_count ?? 'N/A' }}</h4>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-warning shadow-success text-center border-radius-xl mt-n4 position-absolute">
        <i class="material-icons opacity-10">people</i> 
          </div>
          <div class="text-end pt-1">
            <H1 class="text-sm mb-0 text-capitalize">Organizers</H1>
            <h4 class="font-weight-bolder">{{ $organizer_count ?? 'N/A' }}</h4>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
        </div>
      </div>
    </div>
  </div>
  {{-- end row --}}

  {{-- start row --}}
  <div class="row mt-4">

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-success text-center border-radius-xl mt-n4 position-absolute">
        <i class="material-icons opacity-10">business</i> 
          </div>
          <div class="text-end pt-1">
            <H1 class="text-sm mb-0 text-capitalize">Service Providers</H1>
            <h4 class="font-weight-bolder">{{ $serviceProvider_count ?? 'N/A' }}</h4>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-secondary shadow-success text-center border-radius-xl mt-n4 position-absolute">
        <i class="material-icons opacity-10">groups</i> 
          </div>
          <div class="text-end pt-1">
            <H1 class="text-sm mb-0 text-capitalize">Today's Users</H1>
            <h4 class="font-weight-bolder">{{ $today_users_count ?? 'N/A' }}</h4>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-info  shadow-success text-center border-radius-xl mt-n4 position-absolute">
        <i class="material-icons opacity-10">today</i> 
          </div>
          <div class="text-end pt-1">
            <H1 class="text-sm mb-0 text-capitalize">Today's Event</H1>
            <h4 class="font-weight-bolder">{{ $todaysEventsCount ?? 'N/A' }}</h4>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
        </div>
      </div>
    </div>

  </div>
  {{-- end row --}}

</div>

      {{-- new container --}}
<hr class="dark horizontal my-0">

<div class="container-fluid py-4">
  <h3 class="subtitle">Promotions and Feedback</h3>
  <div class="row mt-4">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card h-100">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">code</i>
          </div>
          <div class="text-end pt-1">
            <h1 class="text-sm mb-0 text-capitalize">Promo Codes</h1>
            <h4 class="font-weight-bolder">{{ $PromoCodes ?? 'N/A' }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card h-100">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">local_offer</i>
          </div>
          <div class="text-end pt-1">
            <h1 class="text-sm mb-0 text-capitalize">Offers</h1>
            <h4 class="font-weight-bolder">{{ $Offers ?? 'N/A' }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card h-100">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">rate_review</i>
          </div>
          <div class="text-end pt-1">
            <h1 class="text-sm mb-0 text-capitalize">Reviews</h1>
            <h4 class="font-weight-bolder">{{ $Reviews ?? 'N/A' }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card h-100">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">notifications</i>
          </div>
          <div class="text-end pt-1">
            <h1 class="text-sm mb-0 text-capitalize">Notifications</h1>
            <h4 class="font-weight-bolder">{{ $Notifications ?? 'N/A' }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card h-100">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-danger shadow-danger text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">movie</i>
          </div>
          <div class="text-end pt-1">
            <h1 class="text-sm mb-0 text-capitalize">Reels</h1>
            <h4 class="font-weight-bolder">{{ $reels ?? 'N/A' }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>
  </div>
</div>

<hr class="horizontal dark my-3">
  
 <div class="container-fluid py-4">
  <h3 class="subtitle">Event and Service Categories</h3>
  <div class="row mt-4">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">event</i> 
          </div>
          <div class="text-end pt-1">
            <h1 class="text-sm mb-0 text-capitalize">Total Event Categories</h1>
            <h4 class="font-weight-bolder">{{ $TotalEventCategories ?? 'N/A' }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">category</i>
          </div>
          <div class="text-end pt-1">
            <h1 class="text-sm mb-0 text-capitalize">Service Categories</h1>
            <h4 class="font-weight-bolder">{{ $ServiceCategories_count ?? 'N/A' }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">category</i>
          </div>
          <div class="text-end pt-1">
            <h1 class="text-sm mb-0 text-capitalize">Custom Event Categories</h1>
            <h4 class="font-weight-bolder">{{ $events_request_categories ?? 'N/A' }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">room_service</i>
          </div>
          <div class="text-end pt-1">
            <h1 class="text-sm mb-0 text-capitalize">Amenities</h1>
            <h4 class="font-weight-bolder">{{ $Amenities ?? 'N/A' }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-danger shadow-danger text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">location_on</i>
            </div>
          <div class="text-end pt-1">
            <h1 class="text-sm mb-0 text-capitalize">Venues</h1>
            <h4 class="font-weight-bolder">{{ $Venues ?? 'N/A' }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>
  </div>
</div>

<hr class="dark horizontal my-0">

<div class="container-fluid py-4">
  <h3 class="subtitle">Requests</h3>
  <div class="row mt-4">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">event</i>
          </div>
          <div class="text-end pt-1">
            <h1 class="text-sm mb-0 text-capitalize">Event Requests</h1>
            <h4 class="font-weight-bolder">{{ $EventRequests ?? 'N/A' }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">widgets</i>
          </div>
          <div class="text-end pt-1">
            <h1 class="text-sm mb-0 text-capitalize">Service Provider Requests</h1>
            <h4 class="font-weight-bolder">{{ $ServiceProviderRequests ?? 'N/A' }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">people</i>
          </div>
          <div class="text-end pt-1">
            <h1 class="text-sm mb-0 text-capitalize">Organizer Requests</h1>
            <h4 class="font-weight-bolder">{{ $OrganizerRequests ?? 'N/A' }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>
  </div>
  {{-- <hr class="dark horizontal my-0"> --}}
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <!-- Add your table here -->
      <table class="table">
        <!-- Table contents -->
      </table>
    </div>
  </div>
</div>

<hr class="dark horizontal my-0">



<div class="container-fluid py-4">
  <h3 class="subtitle">Ticketing</h3>
  {{-- start row --}}
  <div class="row mt-4">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">event_seat</i>
          </div>
          <div class="text-end pt-1">
            <h1 class="text-sm mb-0 text-capitalize">Total Tickets Number</h1>
            <h4 class="font-weight-bolder">{{ $totalTicketsNumber ?? 'N/A' }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">confirmation_number</i>
          </div>
          <div class="text-end pt-1">
            <h1 class="text-sm mb-0 text-capitalize">Total Booked Tickets</h1>
            <h4 class="font-weight-bolder">{{ $totalBookedTickets ?? 'N/A' }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-danger shadow-danger text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">cancel</i>
          </div>
          <div class="text-end pt-1">
            <h1 class="text-sm mb-0 text-capitalize">Total Cancelled Tickets</h1>
            <h4 class="font-weight-bolder">{{ $totalCancelledTickets ?? 'N/A' }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">credit_card</i>
          </div>
          <div class="text-end pt-1">
            <h1 class="text-sm mb-0 text-capitalize">Total Booked Tickets Price</h1>
            <h4 class="font-weight-bolder">{{ $totalBookedTicketsPrice ?? 'N/A' }} <span class="text-secondary">SP</span></h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>
  </div>
  {{-- end row --}}

  {{-- start row --}}
  <div class="row mt-4">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-danger shadow-danger text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">cancel</i>
          </div>
          <div class="text-end pt-1">
            <h1 class="text-sm mb-0 text-capitalize">Total Cancelled Tickets Price</h1>
            <h4 class="font-weight-bolder">{{ $totalCancelledTicketsPrice ?? 'N/A' }} <span class="text-secondary">SP</span></h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>
  </div>
  {{-- end row --}}
</div>

@endsection

<style>
  .dashboard-title {
    text-align: center;
    font-size: 36px; /* Increase the font size */
    font-weight: bold;
    transition: color 0.3s ease;
  }

  .dashboard-title:hover {
    color: #007bff; /* Change to your desired color */
  }

  .subtitle {
    text-align: left;
    font-size: 18px; /* Decrease the font size */
    font-weight: 600; /* Thicker font weight */
    padding-top: 10px;
    padding-bottom: 10px;
  }

  /* .container-fluid{
    margin:90px;
  }
  .users{
    margin-bottom: 90px; 
  } */
</style>
