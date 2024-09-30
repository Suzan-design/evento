@extends('layout.master')
@section('title')
    Cancelled Bookings Requests
@endsection
@section('content')

    <hr />
    <div class="d-flex align-items-center justify-content-end">
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Cancel Bookings Requests table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    {{-- <div class="table-responsive p-0"> --}}
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">User Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">User Phone Number</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Event Title</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Amount</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Reason</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($cancelled_bookings->count() > 0)
                                @foreach($cancelled_bookings as $booking)
                                    <tr>


                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">{{ $booking->first_name }}  {{$booking->last_name}}</p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">{{ $booking->user_phone_number }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">{{ $booking->event_title }}</p>
                                        </td>
                                            <td class="align-middle"><p class="text-xs font-weight-bold mb-0">{{ $booking->amount }}</p>
                                            </td>
                                            <td class="align-middle"><p class="text-xs font-weight-bold mb-0">{{ $booking->reason }}</p>
                                            </td>

                                        <td class="align-middle">
                                                <div class="d-flex flex-row justify-content-center w-100">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{ route('acceptCancel' , $booking->id) }}" type="button" class="btn btn-secondary btn-sm"><i class="fas fa-eye" style="position: relative; bottom: 1px;"></i> Accept</a>
                                                    {{-- <form action="{{ route('event-requests.destroy', $booking) }}" method="POST" type="button" class="btn btn-danger btn-sm p-0" onsubmit="return confirm('Delete?')"> --}}
                                                    <a href="{{ route('rejectCancel' , $booking->id) }}" type="button" class="btn btn-danger btn-sm"><i class="fas fa-eye" style="position: relative; bottom: 1px;"></i> Reject</a>
                                                    {{-- <form action="{{ route('event-requests.destroy', $booking) }}" method="POST" type="button" class="btn btn-danger btn-sm p-0" onsubmit="return confirm('Delete?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm m-0"><i class="fas fa-trash-alt" style="position: relative; bottom: 1px;"></i> Delete</button>
                                                    </form>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                                        {{ $booking->status ?: 'Update Status' }} <!-- Display current status as default value -->
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            @foreach(['Pending','In Progress'] as $status)
                                                                <li>
                                                                    <form action="{{ route('event-requests.update', $booking) }}" method="POST" onsubmit="return confirm('Update status to {{ $status }}?')">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden" name="status" value="{{ $status }}">
                                                                        <button type="submit" class="dropdown-item">{{ $status }}</button>
                                                                    </form>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div> --}}
                                                </div>
                                                <!-- Dropdown for updating status -->
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="7">Requests not found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <style>
        body, html {
            overflow-x: hidden;
        }
        .btn {
            /* padding: 2px 5px; */
            margin: 2px;
        }
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
        .btn-group{
            margin-left : 90px ;
        }
        .cursor-pointer {
            cursor: pointer;
        }
        th {
            position: relative; /* Allows absolute positioning of pseudo-elements relative to the th */
            text-align: center
        }
        td{
            text-align: center;
        }
        th.asc::after {
            content: "⭡⭣";
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
        }
        th.desc::after {
            content: "⭣⭡";
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
@endsection
<script>
$(document).ready(function() {
            $('.dropdown-toggle').on('click', function() {
                var $dropdownMenu = $(this).siblings('.dropdown-menu');
                var buttonOffset = $(this).offset();
                var dropdownHeight = $dropdownMenu.outerHeight();

                // Calculate the new position for the dropdown to appear above the button
                var newTop = buttonOffset.top - dropdownHeight;
                var newLeft = buttonOffset.left;

                // Apply the new position
                $dropdownMenu.css({
                    top: newTop + 'px',
                    left: newLeft + 'px',
                    display: 'block'
                }).toggleClass('show');
            });

            // Close the dropdown when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.btn-group').length) {
                    $('.dropdown-menu').removeClass('show').css('display', 'none');
                }
            });
        });
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
