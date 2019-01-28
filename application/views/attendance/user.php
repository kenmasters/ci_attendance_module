<h3></h3>
<!-- <pre>
  <?php
  print_r($user_shifts);
  ?>
</pre> -->
<div class="container">

  <h3>User Attendance</h3>
  <div class="table-responsive">
    <table class="table table-condensed table-hover">
      <thead>
            <tr>
              <th>Time In</th>
              <th>Time In Note</th>
              <th>Time Out</th>
              <th>Time Out Note</th>
              <th>Duration</th>
            </tr>
          </thead>
          <tbody>
            <?php

              foreach ($user_shifts as $value) {
                $timein = nice_date($value->timein, 'D, d M Y H:i');
                $timeout = nice_date($value->timeout, 'D, d M Y H:i');
                $timein_notes = $value->timein_note;
                $timeout_notes = $value->timeout_note;
                $duration_in_hours = (strtotime($value->timeout) - strtotime($value->timein)) / 3600;
                $duration_in_hours = round($duration_in_hours, 2);

                echo "<tr>
                        <td>$timein</td>
                        <td>$timein_notes</td>
                        <td>$timeout</td>
                        <td>$timeout_notes</td>
                        <td>$duration_in_hours</td>
                      </tr>";
              }

            ?>
          </tbody>
    </table>
  </div>
</div>