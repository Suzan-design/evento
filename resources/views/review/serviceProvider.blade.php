@extends('layout.master')
@section('title')
    Service Provider Review
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
                        <h6 class="text-white text-capitalize ps-3">Service Provider Review table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Title</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">User</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Rate</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Review</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if($service_provider_reviews->count() > 0)
                                @foreach($service_provider_reviews as $service_provider_review)
                                    <tr>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">{{ $service_provider_review->service_provider->name }}</p></td>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">{{ $service_provider_review->mobile_user->first_name }}  {{$service_provider_review->mobile_user->last_name}}</p></td>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">{{ $service_provider_review->rate }}</p></td>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">{{ $service_provider_review->comment }}</p></td>
                                        <td class="align-middle">
                                            <div class="d-flex flex-row">
                                                <div class="btn-group" role="group" aria-label="Basic example">

                                                    <form action="{{ route('service_provider_review.destroy', $service_provider_review) }}" method="POST" type="button" class="btn btn-danger btn-sm p-0" onsubmit="return confirm('Delete?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm m-0"><i class="fas fa-trash-alt"></i> Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="7">Review not found</td>
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
        .btn {
            /* padding: 2px 5px; */
            margin: 2px;
        }
        .icon-size {
            width: 32px; /* or any desired width */
            height: 32px; /* or any desired height */
            display: block; /* to ensure it takes the full width of the cell */
            margin: 10px ; /* to center the image in the cell */
            display: block;
            margin-left: auto;
            margin-right: auto;
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
        td{
            text-align: center;
        }
        th {
            position: relative; /* Allows absolute positioning of pseudo-elements relative to the th */
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
