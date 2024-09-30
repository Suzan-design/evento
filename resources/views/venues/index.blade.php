@extends('layout.master')
@section('title')
    Venues
@endsection
@section('content')

    <hr />
    <div class="d-flex align-items-center justify-content-end">
        <a href="{{ route('venues.create') }}" class="btn btn-primary" >Add Venue</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Venues table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center table-hover mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Name AR</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Capacity</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Governorate</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Contact Number</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($venues->count() > 0)
                                @foreach($venues as $venue)
                                    <tr>

                                        <td class="align-middle"><p class="text-xs font-weight-bold mb-0 break-word">{{ $venue->name }}</p></td>
                                        <td class="align-middle"><p class="text-xs font-weight-bold mb-0 break-word">{{ $venue->name_ar }}</p></td>
                                        <td class="align-middle"><p class="text-xs font-weight-bold mb-0 break-word">{{ $venue->capacity }}</p></td>
                                        <td class="align-middle"><p class="text-xs font-weight-bold mb-0 break-word">{{ $venue->governorate }}</p></td>
                                        <td class="align-middle"><p class="text-xs font-weight-bold mb-0 break-word">{{ $venue->contact_number }}</p></td>

                                        <td class="align-middle">
                                            <div class="d-flex flex-row justify-content-around">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{ route('venues.show' , $venue) }}" type="button" class="btn btn-secondary btn-sm"><i class="fas fa-eye" style="position: relative; bottom: 1px;"></i> Detail</a>
                                                    <a href="{{ route('venues.edit', $venue) }}" type="button" class="btn btn-warning btn-sm"><i class="fas fa-trash-alt" style="position: relative; bottom: 1px;"></i> Edit</a>
                                                    <form action="{{ route('venues.destroy', $venue) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm m-0"><i class="fas fa-trash-alt" style="position: relative; bottom: 1px;"></i> Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="7">Venues not found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <ul class="pagination">
    {{-- Previous Page Link --}}
    @if ($venues->onFirstPage())
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span class="page-link arrow" aria-hidden="true">&lsaquo;</span>
        </li>
    @else
        <li class="page-item">
            <a class="page-link arrow" href="{{ $venues->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
        </li>
    @endif

    {{-- Pagination Elements --}}
    

    {{-- Next Page Link --}}
    @if ($venues->hasMorePages())
        <li class="page-item">
            <a class="page-link arrow" href="{{ $venues->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
        </li>
    @else
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span class="page-link arrow" aria-hidden="true">&rsaquo;</span>
        </li>
    @endif
</ul>

<p class="pagination-summary">
    Showing {{ $venues->firstItem() }} to {{ $venues->lastItem() }} of {{ $venues->total() }} results
</p>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
<style>
.pagination .arrow {
    font-size: 1.5em; /* Adjust the font size to make the arrows bigger */
}
.pagination .page-item.disabled .arrow {
    color: #6c757d; /* Ensure disabled arrows are styled appropriately */
}
.pagination-summary {
    margin-top: 10px;
    text-align: center;
}
.pagination {
    justify-content: center;
}
</style>

    <style>
        .btn {
            /* padding: 2px 5px; */
            margin: 3px;
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
            text-align: center;
        }
        tr{
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
