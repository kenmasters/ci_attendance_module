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
              <th>Duration in hours</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php

              foreach ($user_shifts as $v) {
                $timein = nice_date($v->timein, 'D, d M Y H:i');
                $timeout = nice_date($v->timeout, 'D, d M Y H:i');
                $timein_notes = $v->timein_note;
                $timeout_notes = $v->timeout_note;
                $duration_in_hours = (strtotime($v->timeout) - strtotime($v->timein)) / 3600;
                $duration_in_hours = round($duration_in_hours, 2);
                

                echo "<tr>
                        <td>$timein</td>
                        <td>$timein_notes</td>
                        <td>$timeout</td>
                        <td>$timeout_notes</td>
                        <td>$duration_in_hours</td>
                        <td><a class='btn btn-default btn-sm' href='?attendance=".$v->id."'>View Details</a></td>
                      </tr>";
              }

            ?>
          </tbody>
    </table>
  </div>

  <?php if (isset($attendance_details) && $attendance_details) { ?>
      <div class="panel panel-default">
        <div class="panel-heading"></div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-condensed table-hover">
              <thead>
                    <tr>
                      <th>Label</th>
                      <th>Start</th>
                      <th>Start Note</th>
                      <th>End</th>
                      <th>End Note</th>
                      <th>Duration in minutes</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                      foreach ($attendance_details as $v) {
                        $label = $v->label;
                        $start = nice_date($v->start, 'H:i');
                        $start_note = $v->start_note;
                        $end = nice_date($v->end, 'H:i');;
                        $end_note = $v->end_note;
                        $duration_in_min = (strtotime($end) - strtotime($start)) / 60;
                        $duration_in_mins = round($duration_in_min, 2);


                        echo "<tr>
                                <td>$label</td>
                                <td>$start</td>
                                <td>$start_note</td>
                                <td>$end</td>
                                <td>$end_note</td>
                                <td>$duration_in_mins</td>
                              </tr>";
                      }

                    ?>
                  </tbody>
            </table>
          </div>
        </div>
      </div>
     
  <?php } ?>
</div>