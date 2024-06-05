<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Grid Layout</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-3">
        <button type="button" class="btn btn-light" onclick="showModal(1)">1</button>
      </div>
      <div class="col-3">
        <button type="button" class="btn btn-light" onclick="showModal(2)">2</button>
      </div>
      <div class="col-3">
        <button type="button" class="btn btn-light" onclick="showModal(3)">3</button>
      </div>
      <div class="col-3">
        <button type="button" class="btn btn-light" onclick="showModal(4)">4</button>
      </div>
    </div>
    <div class="row">
      <div class="col-3">
        <button type="button" class="btn btn-light" onclick="showModal(5)">5</button>
      </div>
      <div class="col-3">
        <button type="button" class="btn btn-light" onclick="showModal(6)">6</button>
      </div>
      <div class="col-3">
        <button type="button" class="btn btn-light" onclick="showModal(7)">7</button>
      </div>
      <div class="col-3">
        <button type="button" class="btn btn-light" onclick="showModal(8)">8</button>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="scheduleModalLabel">Select Schedule for Item <span id="modalItemNumber"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="scheduleForm">
            <input type="hidden" id="itemNumber" name="item_number">
            <div class="form-group">
              <label for="date">Date:</label>
              <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
              <label for="time">Time:</label>
              <input type="time" class="form-control" id="time" name="time" required>
            </div>
            <div class="form-group">
              <label for="duration">Duration:</label>
              <select class="form-control" id="duration" name="duration" onchange="toggleCustomDuration()">
                <option value="30">30 minutes</option>
                <option value="60">1 hour</option>
                <option value="120">2 hours</option>
                <option value="custom">Custom</option>
              </select>
              <input type="number" class="form-control mt-2" id="customDuration" name="custom_duration" min="30" placeholder="Enter duration in minutes" style="display: none;">
            </div>
            <h5>Schedules for Item <span id="modalItemNumber"></span>:</h5>
            <ul id="scheduleList"></ul>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="saveSchedule()">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
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
                        const listItem = document.createElement('li');
                        listItem.textContent = `${schedule.date} - ${schedule.time} (${schedule.duration} minutes)`;
                        scheduleList.appendChild(listItem);
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

      const duration = formData.get('duration');
      if (duration === 'custom') {
        formData.set('duration', formData.get('custom_duration'));
        formData.delete('custom_duration');
      }

      fetch('/schedules', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json',
        },
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        alert(data.message);
        $('#scheduleModal').modal('hide');
        form.reset();
      })
      .catch(error => console.error('Error:', error));
    }
  </script>
</body>
</html>
