@extends('layout.master')
@section('title')
    Reels
@endsection
@section('content')

    <hr />
    <div class="d-flex align-items-center justify-content-end">
        <a href="{{ route('reels.create') }}" class="btn btn-primary" >Add Reel</a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Reels table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center table-hover mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Title </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Type</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($reels->count() > 0)
                                @foreach($reels as $reel)
                                    <tr>

                                        @if($reel->venue_id)
                                            <td class="align-middle">
                                                <p class="text-xs font-weight-bold mb-0">{{$reel->venue->name}}</p>
                                            </td>
                                            <td class="align-middle">
                                                <p class="text-xs font-weight-bold mb-0">Venue</p>
                                            </td>
                                        @elseif($reel->organizer_id)
                                            <td class="align-middle">
                                                <p class="text-xs font-weight-bold mb-0">{{$reel->organizer->name}}</p>
                                            </td>
                                            <td class="align-middle">
                                                <p class="text-xs font-weight-bold mb-0">Organizer</p>
                                            </td>
                                        @elseif($reel->event_id)
                                            <td class="align-middle">
                                                <p class="text-xs font-weight-bold mb-0">{{$reel->event->title}}</p>
                                            </td>
                                            <td class="align-middle">
                                                <p class="text-xs font-weight-bold mb-0">Event</p>
                                            </td>
                                        @endif
                                        <td class="align-middle text-center">
                                            <div class="" role="group" aria-label="Basic example">
                                                <a href="{{ route('reels.show', $reel->id) }}" class="btn btn-secondary btn-sm mr-2">
                                                    <i class="fas fa-eye" style="position: relative; bottom: 1px;"></i> Details
                                                </a>
                                                <form action="{{ route('reels.destroy', $reel->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this reel?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash-alt" style="position: relative; bottom: 1px;"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="3">Reel not found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        {{ $reels->links() }}
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
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .btn-primary{
            margin: 10px ;
            width: 180px;
        }
        .btn {
            margin-right: 10px; /* Adjust as needed */
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
