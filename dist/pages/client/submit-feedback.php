<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div class="app-content">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Submit Feedback</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content-body">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">New Feedback</h3>
            </div>
            <form action="../../includes/feedback.php" method="post" class="needs-validation" novalidate>
              <div class="card-body">
                <?php if(isset($_GET['error'])): ?>
                  <div class="alert alert-danger"><?=$_GET['error']?></div>
                <?php endif; ?>
                
                <?php if(isset($_GET['success'])): ?>
                  <div class="alert alert-success"><?=$_GET['success']?></div>
                <?php endif; ?>
                
                <div class="mb-3">
                  <label for="category" class="form-label">Category</label>
                  <select class="form-select" id="category" name="category_id" required>
                    <option value="" selected disabled>Select a category</option>
                    <?php
                      include '../../includes/connection.php';
                      $sql = "SELECT * FROM categories";
                      $result = mysqli_query($db, $sql);
                      while($row = mysqli_fetch_assoc($result)){
                        echo "<option value='".$row['id']."'>".$row['name']."</option>";
                      }
                    ?>
                  </select>
                  <div class="invalid-feedback">Please select a category</div>
                </div>
                
                <div class="mb-3">
                  <label for="content" class="form-label">Feedback Content</label>
                  <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                  <div class="invalid-feedback">Please provide your feedback</div>
                </div>
                
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="autoDetectLocation" checked>
                    <label class="form-check-label" for="autoDetectLocation">
                      Auto-detect my location
                    </label>
                  </div>
                </div>
                
                <div class="mb-3" id="manualLocationDiv" style="display: none;">
                  <label for="location" class="form-label">Location</label>
                  <input type="text" class="form-control" id="manualLocation" name="manual_location">
                </div>
                
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
                <input type="hidden" id="detected_location" name="detected_location">
              </div>
              <div class="card-footer">
                <button type="submit" name="submit_feedback" class="btn btn-primary">Submit Feedback</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Form validation
  (() => {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach((form) => {
      form.addEventListener('submit', (event) => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  })();
  
  // Location detection
  document.addEventListener('DOMContentLoaded', function() {
    const autoDetectCheckbox = document.getElementById('autoDetectLocation');
    const manualLocationDiv = document.getElementById('manualLocationDiv');
    const manualLocationInput = document.getElementById('manualLocation');
    const latitudeInput = document.getElementById('latitude');
    const longitudeInput = document.getElementById('longitude');
    const detectedLocationInput = document.getElementById('detected_location');
    
    autoDetectCheckbox.addEventListener('change', function() {
      if (this.checked) {
        manualLocationDiv.style.display = 'none';
        manualLocationInput.required = false;
        detectLocation();
      } else {
        manualLocationDiv.style.display = 'block';
        manualLocationInput.required = true;
        latitudeInput.value = '';
        longitudeInput.value = '';
        detectedLocationInput.value = '';
      }
    });
    
    function detectLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          function(position) {
            latitudeInput.value = position.coords.latitude;
            longitudeInput.value = position.coords.longitude;
            
            // Get location name from coordinates using reverse geocoding
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${position.coords.latitude}&lon=${position.coords.longitude}`)
              .then(response => response.json())
              .then(data => {
                const locationName = data.display_name || 'Unknown location';
                detectedLocationInput.value = locationName;
              })
              .catch(error => {
                console.error('Error getting location name:', error);
                detectedLocationInput.value = `${position.coords.latitude}, ${position.coords.longitude}`;
              });
          },
          function(error) {
            console.error('Error getting location:', error);
            autoDetectCheckbox.checked = false;
            manualLocationDiv.style.display = 'block';
            manualLocationInput.required = true;
          }
        );
      } else {
        alert("Geolocation is not supported by this browser.");
        autoDetectCheckbox.checked = false;
        manualLocationDiv.style.display = 'block';
        manualLocationInput.required = true;
      }
    }
    
    // Initial location detection
    if (autoDetectCheckbox.checked) {
      detectLocation();
    }
  });
</script>

<?php include 'footer.php'; ?>