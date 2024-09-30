@extends('layout.master')
@section('title')
    Bookings
@endsection
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <hr />
{{--    <div class="d-flex align-items-center justify-content-end">--}}
{{--        <a href="#" class="btn btn-primary" >Add Booking</a>--}}
{{--    </div>--}}
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Bookings table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Phone Number</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Class</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Class Price</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Amenity Price</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Offer</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Promo Code</th>
                                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Promo Code Limit</th>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($bookings->count() > 0)
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td class="align-middle">{{ $booking->first_name }} {{$booking->last_name}}</td>
                                        <td class="align-middle">{{ $booking->phone_number }}</td>
                                        <td class="align-middle">{{ $booking->class_type }}</td>
                                        <td class="align-middle">{{ $booking->class_price }}</td>
                                        <td class="align-middle">{{ $booking->amenityPrice }}</td>
                                        <td class="align-middle">{{ $booking->offer ? $booking->offer->percent . '%': 'N/A' }} </td>
                                        <td class="align-middle">{{ $booking->promoCode ? $booking->promoCode->discount . '%' : 'N/A' }} </td>
                                                                                <td class="align-middle">{{ $booking->promoCode ? $booking->promoCode->limit  : 'N/A' }} </td>

                                        <td class="align-middle">{{ $booking->class_ticket_price  }} </td>
                                    </tr>
                                @endforeach

                            @else
                                <tr>
                                    <td class="text-center" colspan="7">Booking</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <style>
        .icon-size {
            width: 32px; /* or any desired width */
            height: 32px; /* or any desired height */
            display: block; /* to ensure it takes the full width of the cell */
            margin: 10px ; /* to center the image in the cell */
        }
        .btn-primary{
            margin: 10px ;
            width: 180px;
        }
        .cursor-pointer {
            cursor: pointer;
        }
        th {
            position: relative; /* Allows absolute positioning of pseudo-elements relative to the th */
        }
        th.asc::after {
            content: " 🔼";
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
        }
        th.desc::after {
            content: " 🔽";
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
        }
        .deleted-event {
            background-color: #f8d7da; /* Soft red to indicate deletion */
        }
        .future-event {
            background-color: #d1ecf1; /* Soft blue to indicate future events */
        }
        .status-marker {
            font-size: 0.8em;
            color: #dc3545; /* Dark red color for emphasis */
            margin-left: 5px;
        }
    </style>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const table = document.querySelector('.table');
        const headers = table.querySelectorAll('th');
        const tableBody = table.querySelector('tbody');
        const rows = tableBody.querySelectorAll('tr');

        const handleSorting = (rows, index, asc) => {
            return Array.from(rows).sort(function(a, b) {
                const aVal = a.querySelector(`td:nth-child(${index + 1})`).textContent.trim();
                const bVal = b.querySelector(`td:nth-child(${index + 1})`).textContent.trim();

                if (aVal === bVal) return 0;
                if (aVal > bVal) return asc ? 1 : -1;
                return asc ? -1 : 1;
            });
        };

        headers.forEach((header, index) => {
            header.addEventListener('click', () => {
                const asc = header.classList.toggle('asc');
                const sortedRows = handleSorting(rows, index, asc);
                headers.forEach(h => { h.classList.remove('asc', 'desc'); });
                header.classList.add(asc ? 'asc' : 'desc');
                sortedRows.forEach(row => tableBody.appendChild(row));
            });
        });
    });
</script>
