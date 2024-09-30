@extends('layout.master')
@section('title')
    Event Request Category
@endsection
@section('content')

    <hr />
    <div class="d-flex align-items-center justify-content-end">
    </div>
    <a href="{{ route('events-request-categories.create') }}" class="btn btn-primary" >Add Category</a>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Category table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center table-hover mb-0">
                            <thead>
                            <tr>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Icon</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Title</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Title AR</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($events_request_categories->count() > 0)
                                @foreach($events_request_categories as $events_request_category)
                                    <tr>

                                        <td class="align-middle">
                                            <img src="{{ asset('storage/'.$events_request_category->icon) }}" alt="Icon" class="icon-size">
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">{{ $events_request_category->title }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">{{ $events_request_category->title_ar }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('events-request-categories.show' , $events_request_category) }}" type="button" class="btn btn-secondary btn-sm"><i class="fas fa-eye" style="position: relative; bottom: 1px;"></i> Detail</a>
                                                <a href="{{ route('events-request-categories.edit' , $events_request_category) }}" type="button" class="btn btn-warning btn-sm"><i class="fas fa-edit" style="position: relative; bottom: 1px;"></i> Update</a>
                                                <form action="{{ route('events-request-categories.destroy', $events_request_category) }}" method="POST" type="button" class="btn btn-danger btn-sm p-0"  onsubmit="return confirm('Delete this category  ?')">
                                                @csrf
                                                @method('DELETE') <!-- Assuming you are using the DELETE method -->
                                                    <button type="submit" class="btn btn-danger btn-sm m-0"><i class="fas fa-trash-alt" style="position: relative; bottom: 1px;"></i> Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td></td> <!-- Empty cell for the third column -->
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="3">Categories not found</td>
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
