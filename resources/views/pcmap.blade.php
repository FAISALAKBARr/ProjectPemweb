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
          <form>
            <div class="form-group">
              <label for="date">Date:</label>
              <input type="date" class="form-control" id="date" required>
            </div>
            <div class="form-group">
              <label for="time">Time:</label>
              <input type="time" class="form-control" id="time" required>
            </div>
            <div class="form-group">
              <label for="duration">Duration:</label>
              <select class="form-control" id="duration" onchange="toggleCustomDuration()">
                <option value="30">30 minutes</option>
                <option value="60">1 hour</option>
                <option value="120">2 hours</option>
                <option value="custom">Custom</option>
              </select>
              <input type="number" class="form-control mt-2" id="customDuration" min="30" placeholder="Enter duration in minutes" style="display: none;">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    function showModal(itemNumber) {
      document.getElementById('modalItemNumber').textContent = itemNumber;
      $('#scheduleModal').modal('show');
    }

    function toggleCustomDuration() {
      const durationSelect = document.getElementById('duration');
      const customDurationInput = document.getElementById('customDuration');
      if (durationSelect.value === 'custom') {
        customDurationInput.style.display = 'block';
      } else {
        customDurationInput.style.display = 'none';
      }
    }
  </script>
</body>
</html>
