@extends('layout.master')
@section('title')
    Event Offers
@endsection
@section('content')

<hr />
<div class="d-flex align-items-center justify-content-end mb-3">
    <a href="{{ route('events-offers.create') }}" class="btn btn-primary">Add Offer</a>
</div>
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Offers Table</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Title</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Amount</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Discount Type</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($offers->count() > 0)
                                @foreach($offers as $offer)
                                    <tr>
                                        <td class="align-middle text-xs font-weight-bold mb-0 break-word">{{ $offer->event->title }}</td>
                                        <td class="align-middle text-xs font-weight-bold mb-0 break-word">{{ $offer->percent }}</td>
                                        <td class="align-middle text-xs font-weight-bold mb-0 break-word">
                                            @if($offer->discount_type == 'percent')
                                                %
                                            @else
                                                SYP
                                            @endif
                                        </td>
                                        <td class="align-middle break-word">
                                            <div class="d-flex justify-content-center">
                                                <form action="{{ route('events-offers.destroy', $offer) }}" method="POST" class="m-0" onsubmit="return confirm('Delete?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt" style="position: relative; bottom: 1px;"></i> Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="4">Event Offer Not found</td>
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
    .btn-primary {
        margin: 10px;
        width: 180px;
    }
    .cursor-pointer {
        cursor: pointer;
    }
    th {
        position: relative; /* Allows absolute positioning of pseudo-elements relative to the th */
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
    .table {
        width: 100%; /* Ensure the table takes full width */
        table-layout: fixed; /* Fix the layout to split columns evenly */
    }
    th, td {
        text-align: center; /* Center align text in table cells */
        overflow: hidden; /* Prevent overflow */
        white-space: nowrap; /* Prevent text wrapping */
        text-overflow: ellipsis; /* Add ellipsis for overflowed text */
    }
    .table-responsive {
        padding: 20px; /* Add padding to the table container */
    }
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add subtle shadow to the card */
    }
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }
    tr:hover {
        background-color: #f2f2f2; /* Highlight row on hover */
    }
    th, td {
        padding: 15px; /* Add padding to table cells for better spacing */
    }
    .break-word {
        word-break: break-word;
        overflow-wrap: break-word;
        white-space: normal;
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
