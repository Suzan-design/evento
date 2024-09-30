@extends('layout.master')
@section('title')
Organizers
@endsection
@section('content')

    <hr />
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">organizers table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center table-hover mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Bio</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Covering Area</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Other Category</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($organizers->count() > 0)
                                @foreach($organizers as $organizer)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 break-word">{{ $organizer->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 break-word">{{ $organizer->bio }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 break-word">{{ $organizer->covering_area }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $organizer->other_category }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex flex-row justify-content-around">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{ route('organizers.show', $organizer) }}" type="button" class="btn btn-secondary btn-sm"><i class="fas fa-eye" style="position: relative; bottom: 1px;" ></i> Detail</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="5">Organizers not found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        {{-- {{$organizers->links()}} --}}
                    </div>
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
            margin: 2px;
        }
        .btn-primary {
            margin: 10px;
            width: 300px;
        }
        .cursor-pointer {
            cursor: pointer;
        }
        th, td {
            text-align: center;
            white-space: nowrap;
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
        .break-word {
            word-break: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }
        .table-responsive {
            overflow-x: auto;
        }
        /* .table {
            width: 100%;
        } */
    </style>
@endsection
