@extends('layout.master')

@section('title')
    Offers
@endsection

@section('css')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        label {
            border: 2px solid pink;
            padding: 5px;
            display: inline-block;
            margin-bottom: 10px;
        }

        .form-control {
            font-size: 16px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
            width: 100%;
        }

        .btn-primary {
            background-color: #5cb85c;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
        }

        form {
            width: 50%;
            margin: auto;
        }
    </style>
@endsection

@section('content')
    <h2>Add Offer</h2>
    <hr />
    <form action="{{ route('events-offers.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row mb-3">
        <label>Event</label>
        <div class="col">
            <select name="event_id" class="form-select form-select-lg" required>
                <option value="">Select Event</option>
                @foreach ($events as $event)
                    <option value="{{ $event->id }}">{{ $event->title }} - Start Date: {{ $event->start_date }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <label>Discount Type</label>
        <div class="col">
            <select id="discount_type" name="discount_type" class="form-select form-select-lg" required>
                <option value="">Select Discount Type</option>
                <option value="percent">Percent %</option>
                <option value="amount">Fixed Amount (SP)</option>
            </select>
        </div>
    </div>

    <div class="row mb-3" id="discountPercentContainer" style="display:none;">
        <label>Percent %</label>
        <div class="col">
            <input type="number" id="discount_percent" name="discount_percent" class="form-control" placeholder="Offer Percent" max="100">
        </div>
    </div>

    <div class="row mb-3" id="discountAmountContainer" style="display:none;">
        <label>Fixed Amount</label>
        <div class="col">
            <input type="number" id="discount_amount" name="discount_amount" class="form-control" placeholder="Offer Amount">
        </div>
    </div>

    <div class="row">
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const discountType = document.getElementById('discount_type');
        const discountPercentContainer = document.getElementById('discountPercentContainer');
        const discountAmountContainer = document.getElementById('discountAmountContainer');

        discountType.addEventListener('change', function () {
            if (this.value === 'percent') {
                discountPercentContainer.style.display = 'block';
                discountAmountContainer.style.display = 'none';
            } else if (this.value === 'amount') {
                discountPercentContainer.style.display = 'none';
                discountAmountContainer.style.display = 'block';
            }
        });
    });
</script>
        
@endsection
