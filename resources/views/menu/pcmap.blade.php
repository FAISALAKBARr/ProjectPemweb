@extends('layouts.app')

@section('title', 'Today - Dotlist')

@section('content')
    @php
        $selectedPlace = session('selected_place');
    @endphp

    @if (!$selectedPlace)
        <script>window.location = "{{ route('places.show') }}";</script>
    @else
    <div class="container mt-5">
        <h1 class="text-center mb-4">Select Your Computer</h1>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <button type="button" class="btn btn-outline-primary w-100" onclick="showModal(1)">
                            <i class="fas fa-desktop"></i> Computer 1
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <button type="button" class="btn btn-outline-primary w-100" onclick="showModal(2)">
                            <i class="fas fa-desktop"></i> Computer 2
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <button type="button" class="btn btn-outline-primary w-100" onclick="showModal(3)">
                            <i class="fas fa-desktop"></i> Computer 3
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <button type="button" class="btn btn-outline-primary w-100" onclick="showModal(4)">
                            <i class="fas fa-desktop"></i> Computer 4
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <button type="button" class="btn btn-outline-primary w-100" onclick="showModal(5)">
                            <i class="fas fa-desktop"></i> Computer 5
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <button type="button" class="btn btn-outline-primary w-100" onclick="showModal(6)">
                            <i class="fas fa-desktop"></i> Computer 6
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <button type="button" class="btn btn-outline-primary w-100" onclick="showModal(7)">
                            <i class="fas fa-desktop"></i> Computer 7
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <button type="button" class="btn btn-outline-primary w-100" onclick="showModal(8)">
                            <i class="fas fa-desktop"></i> Computer 8
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule Modal -->
    <div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scheduleModalLabel">Select Schedule for Computer <span id="modalItemNumber"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="scheduleForm">
                        <input type="hidden" id="itemNumber" name="item_number">
                        <div class="form-group mb-3">
                            <label for="date">Date:</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="time">Time:</label>
                            <input type="time" class="form-control" id="time" name="time" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="duration">Duration:</label>
                            <select class="form-select" id="duration" name="duration" onchange="toggleCustomDuration()">
                                <option value="30">30 minutes</option>
                                <option value="60">1 hour</option>
                                <option value="120">2 hours</option>
                                <option value="custom">Custom</option>
                            </select>
                            <input type="number" class="form-control mt-2" id="customDuration" name="custom_duration" min="30" placeholder="Enter duration in minutes" style="display: none;">
                        </div>
                        <h5>Schedules for Computer <span id="modalItemNumber"></span>:</h5>
                        <ul id="scheduleList" class="list-group mb-3"></ul>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveSchedule()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Overlap Modal -->
    <div class="modal fade" id="overlapModal" tabindex="-1" aria-labelledby="overlapModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="overlapModalLabel">Schedule Overlap</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Failed to save the schedule. The selected time slot overlaps with an existing schedule.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showModal(itemNumber) {
            document.getElementById('modalItemNumber').textContent = itemNumber;
            document.getElementById('itemNumber').value = itemNumber;
            $('#scheduleModal').modal('show');

            fetch('/schedules/by-item-number?item_number=' + itemNumber)
                .then(response => response.json())
                .then(data => {
                    const scheduleList = document.getElementById('scheduleList');
                    scheduleList.innerHTML = '';
                    if (data.schedules.length > 0) {
                        data.schedules.forEach(schedule => {
                            if (schedule.confirmed) { // Only show confirmed schedules
                                const listItem = document.createElement('li');
                                listItem.textContent = `${schedule.date} - ${schedule.time} (${schedule.duration} minutes)`;
                                listItem.classList.add('list-group-item');
                                scheduleList.appendChild(listItem);
                            }
                        });
                    } else {
                        scheduleList.textContent = 'No schedules found.';
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function toggleCustomDuration() {
            const durationSelect = document.getElementById('duration');
            const customDurationInput = document.getElementById('customDuration');
            if (durationSelect.value === 'custom') {
                customDurationInput.style.display = 'block';
            } else {
                customDurationInput.style.display = 'none';
                customDurationInput.value = '';
            }
        }

        function saveSchedule() {
            const form = document.getElementById('scheduleForm');
            const formData = new FormData(form);

            const selectedPlace = '{{ $selectedPlace }}';
            const itemNumber = document.getElementById('itemNumber').value;
            const date = document.getElementById('date').value;
            const time = document.getElementById('time').value;
            const duration = document.getElementById('duration').value;
            const customDuration = document.getElementById('customDuration').value;

            const finalDuration = duration === 'custom' ? customDuration : duration;

            fetch(`/schedules/check-overlap?place=${selectedPlace}&item_number=${itemNumber}&date=${date}&time=${time}&duration=${finalDuration}`)
                .then(response => response.json())
                .then(data => {
                    if (data.overlap) {
                        $('#overlapModal').modal('show');
                    } else {
                        const urlParams = new URLSearchParams({
                            place: selectedPlace,
                            item_number: itemNumber,
                            date: date,
                            time: time,
                            duration: finalDuration
                        });

                        window.location.href = `/payment?${urlParams.toString()}`;
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
    @endif
@endsection
