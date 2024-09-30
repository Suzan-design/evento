@extends('layout.master')

@section('title')
    Users
@endsection

@section('content')


    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <!-- ... -->
                <div class="card-body px-0 pb-2">
                    <!-- Search & Filter Form -->
                    <form method="GET" action="{{ route('users.search') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="Search" class="form-control" placeholder="Search"  value="{{ request()->input('Search') }}">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>

                        </div>
                    </form>
                    <!-- End Search & Filter Form -->

                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Users table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Gender</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Birthdate</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">Phone Number</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">State</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($users->count()>0)
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->id }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->first_name }} {{ $user->last_name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->gender }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->birth_date }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->phone_number }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->state }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->type }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex flex-row justify-content-around">
                                                <div class="btn-group" role="group" aria-label="Basic example">
            <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt" style="position: relative; bottom: 1px;"></i> Delete</button>
            </form>
            <form action="{{ route('users.changeActiveType', $user->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-{{ $user->active_type == 'normal' ? 'warning' : 'success' }} btn-sm">
                    {{ $user->active_type == 'normal' ? 'Block' : 'Activate' }}
                </button>
            </form>
        </div>
    </div>
</td>


                                    </tr>
                                @endforeach
                            @else
                                    <tr>
                                        <td class="text-center" colspan="7">Users not found</td>
                                    </tr>
                            @endif

                            </tbody>
                        </table>

    {{ $users->links() }}
@endsection

@section('css')
        <style>
        .btn {
            /* padding: 2px 5px; */
            margin: 2px;
        }
        td{
            text-align: center;
        }
            /* General Input and Select Styling */
            input[type="text"],
            input[type="number"],
            select {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
                margin-bottom: 10px;
                font-size: 16px;
            }

            /* Focus State Styling */
            input[type="text"]:focus,
            input[type="number"]:focus,
            select:focus {
                border-color: #4A90E2;
                box-shadow: 0 0 8px rgba(74, 144, 226, 0.3);
                outline: none;
            }

            /* Placeholder Styling */
            input[type="text"]::placeholder,
            input[type="number"]::placeholder {
                color: #aaa;
            }

            /* Select Box Styling */
            select {
                appearance: none;
                background-image: url('your_dropdown_icon_url');
                background-repeat: no-repeat;
                background-position: right center;
                cursor: pointer;
            }

            /* Tooltip Styling */
            [data-tooltip] {
                position: relative;
                cursor: pointer;
            }

            [data-tooltip]:before {
                content: attr(data-tooltip);
                position: absolute;
                bottom: 100%;
                left: 50%;
                transform: translateX(-50%);
                background-color: #333;
                color: #fff;
                border-radius: 4px;
                padding: 5px;
                opacity: 0;
                pointer-events: none;
                transition: opacity 0.3s ease-in-out;
                white-space: nowrap;
            }
            .cursor-pointer {
                cursor: pointer;
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

            [data-tooltip]:hover:before {
                opacity: 1;
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
