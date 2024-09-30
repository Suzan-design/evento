@extends('layout.master')
@section('title')
    Organizer Requests
@endsection
@section('content')

    <hr />
    <div class="d-flex align-items-center justify-content-end"></div>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Organizer Requests Table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <table class="table align-items-center table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">User Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Organizer Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Bio</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Category</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Other Category</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Covering Area</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($organizers->count() > 0)
                                @foreach($organizers as $organizer)
                                    <tr>
                                        <td class="align-middle text-xs font-weight-bold mb-0 text-ellipsis">
                                            {{ $organizer->mobileUser->first_name }} {{$organizer->mobileUser->last_name}}
                                        </td>
                                        <td class="align-middle text-xs font-weight-bold mb-0 text-ellipsis">
                                            {{ $organizer->name }}
                                        </td>
                                        <td class="align-middle text-xs font-weight-bold mb-0 text-ellipsis">
                                            {{ $organizer->bio }}
                                        </td>
                                        @if($organizer->categories)
                                            <td class="align-middle text-xs font-weight-bold mb-0 break-word">{{ $organizer->categories[0]->title }}</td>
                                        @else
                                            <td class="align-middle text-xs font-weight-bold mb-0"></td>
                                        @endif
                                        <td class="align-middle text-xs font-weight-bold mb-0 text-ellipsis">
                                            {{ $organizer->other_category }}
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 break-word">{{ $organizer->covering_area }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            {{-- <div class="d-flex flex-row justify-content-center"> --}}
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{ route('organizer-requests.show', $organizer->id) }}" type="button" class="btn btn-secondary btn-sm"><i class="fas fa-eye" style="position: relative; bottom: 1px;"></i> Detail</a>
                                                    <form action="{{ route('organizer-requests.destroy', $organizer) }}" method="POST" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm m-0"><i class="fas fa-trash-alt" style="position: relative; bottom: 1px;"></i> Delete</button>
                                                    </form>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            {{ $organizer->type ?: 'Update Status' }}
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            @foreach(['Approved', 'Pending'] as $status)
                                                                <li>
                                                                    <form action="{{ route('organizer-requests.update', $organizer) }}" method="POST" onsubmit="return confirm('Update status to {{ $status }}?')">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden" name="type" value="{{ $status }}">
                                                                        <button type="submit" class="dropdown-item">{{ $status }}</button>
                                                                    </form>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            {{-- </div> --}}
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
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <style>
        .btn {
            margin: 2px;
        }
        .icon-size {
            width: 32px;
            height: 32px;
            display: block;
            margin: 10px auto;
        }
        .btn-primary {
            margin: 10px;
            width: 180px;
        }
        .btn-group {
            margin-left: 90px;
        }
        .cursor-pointer {
            cursor: pointer;
        }
        td, th {
            text-align: center;
        }
        th {
            position: relative;
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
        /* .text-ellipsis {
            max-width: 150px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        } */
        .break-word {
            word-break: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }
    </style>
@endsection

@section('scripts')
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
@endsection
غ