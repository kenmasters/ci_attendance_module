<h3></h3>
<div class="container">
  <?php if ($this->session->flashdata('err')['status']) { ?>
  <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error!</strong> <?php echo $this->session->flashdata('err')['msg'];?>
  </div>
  <?php } ?>
  <h3>User Attendance</h3>
  <?php $this->load->view('attendance/searchform'); ?>
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
              if ($user_attendance_list) {
                foreach ($user_attendance_list as $v) {
                  $timein = nice_date(unix_to_human($v->timein), 'D, d M Y H:i');
                  $timeout = nice_date(unix_to_human($v->timeout), 'D, d M Y H:i');
                  $timein_notes = $v->timein_note;
                  $timeout_notes = $v->timeout_note;
                  $duration_in_hours = round($v->duration_in_hours, 2);
                  ?>
                 <tr class="<?=$v->id == $selected?'active':''?>">
                    <td><?=$timein;?></td>
                    <td><?=$timein_notes;?></td>
                    <td><?=$timeout;?></td>
                    <td><?=$timeout_notes;?></td>
                    <td><?=$duration_in_hours;?></td>
                    <td><a class='btn btn-default btn-xs <?=$v->id == $selected?'disabled':''?>' href='?attendance=<?=$v->id;?>'>View Details</a></td>
                  </tr>
                <?php
                }
              } else {
              ?>
              <tr>
                <td colspan="6" class="text-center">No result found</td>
              </tr>
              <?php
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
                        $start = unix_to_human($v->start);
                        $start_note = $v->start_note;
                        $end = unix_to_human($v->end);
                        $end_note = $v->end_note;
                        $duration_in_mins = round($v->duration_in_mins, 2);
                        ?>
                        <tr>
                          <td><?=$label;?></td>
                          <td><?=$start;?></td>
                          <td><?=$start_note;?></td>
                          <td><?=$end;?></td>
                          <td><?=$end_note;?>e</td>
                          <td><?=$duration_in_mins;?></td>
                        </tr>
                        <?php
                      }
                    ?>
                  </tbody>
            </table>
          </div>
        </div>
      </div>
     
  <?php } ?>
</div>