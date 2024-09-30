@extends('layout.master')
@section('title')
    Events
@endsection
@section('content')
@php
    use Carbon\Carbon;
@endphp
    <hr />
    <div class="d-flex align-items-center justify-content-end">
        <a href="{{ route('events.create') }}" class="btn btn-primary">Add Event</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Events table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Title</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Venue</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Capacity</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Start Date</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">End Date</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Ticket Price</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($events->count() > 0)
                                    @foreach($events as $event)
                                        <tr class="{{ !is_null($event->deleted_at) ? 'deleted-event' : '' }} {{ Carbon::parse($event->end_date)->isFuture() ? 'future-event' : '' }}">
                                            <td class="text-xs font-weight-bold mb-0">
                                                <div class="d-flex flex-column justify-content-center break-word">
                                                    {{ $event->title }} 
                                                    @if(!is_null($event->deleted_at))
                                                        <span class="status-marker">Deleted</span>
                                                    @endif
                                                    @if(! Carbon::parse($event->end_date)->isFuture())
                                                        <span class="status-marker">Ended</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-xs font-weight-bold mb-0 break-word">
                                                {{ $event->Venue->name }} {{ $event->deleted_at }}
                                            </td>
                                            <td class="align-middle text-xs font-weight-bold mb-0 break-word">
                                                {{ $event->capacity }}
                                            </td>
                                            <td class="align-middle text-xs font-weight-bold mb-0 break-word">
                                                {{ $event->start_date }}
                                            </td>
                                            <td class="align-middle text-xs font-weight-bold mb-0 break-word">
                                                {{ $event->end_date }}
                                            </td>
                                            <td class="align-middle break-word">
                                                <span class="badge badge-sm bg-gradient-success">{{ $event->ticket_price }}</span>
                                            </td>
                                            <td class="align-middle break-word">
                                                <div class="d-flex flex-row justify-content-around">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{ route('events.show', $event) }}" type="button" class="btn btn-secondary btn-sm"><i class="fas fa-eye" style="position: relative; bottom: 1px;"></i> Detail</a>
                                                        <a href="{{ route('events.edit', $event) }}" type="button" class="btn btn-warning btn-sm"><i class="fas fa-edit" style="position: relative; bottom: 1px;"></i> Edit</a>
                                                        @if(is_null($event->deleted_at))
                                                            <form action="{{ route('events.destroy', $event) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt" style="position: relative; bottom: 1px;"></i> Delete</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{ route('event_ticket', $event->id) }}" type="button" class="btn btn-warning btn-sm">Show Ticket -></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="7">Events not found</td>
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
        .cursor-pointer {
            cursor: pointer;
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
        tr {
            text-align: center;
        }
        .deleted-event {
            background-color: #f8d7da;
        }
        .future-event {
            background-color: #d1ecf1;
        }
        .status-marker {
            font-size: 0.8em;
            color: #dc3545;
            margin-left: 5px;
        }
        .break-word {
            word-break: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }
        body, html {
            overflow-x: hidden;
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
