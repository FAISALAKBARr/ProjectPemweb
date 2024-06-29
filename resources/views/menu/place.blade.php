@extends('layouts.app')

@section('title', 'Choose Place')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-3">Choose Your Level</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form method="POST" action="{{ route('places.select') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="place" class="form-label">Select Level Place:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    <select class="form-select" id="place" name="place" required>
                                        <option value="Regular">Regular</option>
                                        <option value="Pro">Pro</option>
                                        <option value="VIP">VIP</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Proceed to PC Selection</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="text-center mt-5 mb-3">Level Place Detail</h3>
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <div class="accordion" id="placeDetailsAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingRegular">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRegular" aria-expanded="true" aria-controls="collapseRegular">
                                Regular
                            </button>
                        </h2>
                        <div id="collapseRegular" class="accordion-collapse collapse show" aria-labelledby="headingRegular" data-bs-parent="#placeDetailsAccordion">
                            <div class="accordion-body">
                                <p>Regular places are perfect for casual users looking for a reliable and affordable option. These areas are equipped with standard computers that provide good performance for everyday tasks and moderate gaming.</p>
                                <ul>
                                    <li>Standard PC with moderate specs</li>
                                    <li>Comfortable seating</li>
                                    <li>Basic peripherals (keyboard, mouse)</li>
                                    <li>Affordable pricing</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingPro">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePro" aria-expanded="false" aria-controls="collapsePro">
                                Pro
                            </button>
                        </h2>
                        <div id="collapsePro" class="accordion-collapse collapse" aria-labelledby="headingPro" data-bs-parent="#placeDetailsAccordion">
                            <div class="accordion-body">
                                <p>Pro places are designed for users who demand higher performance for gaming, creative work, and professional tasks. These areas are equipped with high-spec computers that can handle resource-intensive applications.</p>
                                <ul>
                                    <li>High-spec PC with powerful hardware</li>
                                    <li>Ergonomic seating</li>
                                    <li>Advanced peripherals (mechanical keyboard, high-DPI mouse)</li>
                                    <li>Moderate pricing</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingVIP">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVIP" aria-expanded="false" aria-controls="collapseVIP">
                                VIP
                            </button>
                        </h2>
                        <div id="collapseVIP" class="accordion-collapse collapse" aria-labelledby="headingVIP" data-bs-parent="#placeDetailsAccordion">
                            <div class="accordion-body">
                                <p>VIP places offer the ultimate experience for users who seek luxury and top-tier performance. These areas are equipped with the best computers and amenities to provide an exceptional user experience.</p>
                                <ul>
                                    <li>Top-tier PC with the latest hardware</li>
                                    <li>Luxurious seating</li>
                                    <li>Premium peripherals (customizable keyboard, gaming mouse)</li>
                                    <li>Exclusive access and premium pricing</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection