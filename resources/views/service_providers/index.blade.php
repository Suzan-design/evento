@extends('layout.master')
@section('title')
    Providers
@endsection
@section('content')

    <hr />
    <div class="d-flex align-items-center justify-content-end">
        <a href="{{ route('service-providers.create') }}" class="btn btn-primary" >Add Service Provider</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Providers table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center table-hover mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">User</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Provider Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Category</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Governorate</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($serviceProviders->count() > 0)
                                @foreach($serviceProviders as $service_provider)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if($service_provider->user)
                                                    {{ $service_provider->user->first_name }} {{ $service_provider->user->last_name }}
                                                @endif
                                            </p>
                                        </td>

                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $service_provider->name }}</p>
                                        </td>

                                        @if($service_provider->category_id)
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $service_provider->category->title }}</p>
                                            </td>
                                        @else
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">null</td></p>
                                        @endif
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $service_provider->location_work_governorate }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex flex-row justify-content-around">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{ route('service-providers.show' , $service_provider) }}" type="button" class="btn btn-secondary btn-sm"><i class="fas fa-eye" style="position: relative; bottom: 1px;"></i> Detail</a>
                                                    <a href="{{ route('service-providers.edit', $service_provider) }}" type="button" class="btn btn-warning btn-sm"><i class="fas fa-edit" style="position: relative; bottom: 1px;"></i> Edit</a>
                                                    <form action="{{ route('service-providers.destroy', $service_provider) }}" method="POST" type="button" class="btn btn-danger btn-sm p-0" onsubmit="return confirm('Delete?')">
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
                                    <td class="text-center" colspan="7">Service Provider not found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        {{$serviceProviders->links()}}
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
        .btn-primary{
            margin: 10px ;
            width: 300px;
        }
        .cursor-pointer {
            cursor: pointer;
        }
        th {
            position: relative; /* Allows absolute positioning of pseudo-elements relative to the th */
            text-align: center;
        }
        td{
            text-align: center
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
