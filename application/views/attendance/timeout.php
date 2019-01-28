<h3></h3>
<div class="container"> 
    <div class="row">
      <div class="col-sm-6">
        <div class="panel panel-default">
          <div class="panel-heading"><h4>Time Out</h4></div>
          <div class="panel-body">
        
            <?php echo form_open('', ['class'=>'form-horizontal']); ?>
            <?php echo form_hidden('attendance_id', $attendance_current->id); ?>
            <div class="form-group">
              <label class="control-label col-sm-2" for="email">Time In</label>
              <div class="col-sm-10">
                <label class="control-label"><?php echo nice_date($attendance_current->timein, 'D, d M Y H:i'); ?></label>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="email">Time In Note</label>
              <div class="col-sm-10">
                <label class="control-label"><?php echo $attendance_current->timein_note; ?></label>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="email">Date</label>
              <div class="col-sm-10">
                <input type="hidden" name="date" value="<?php echo $current_date; ?>">
                <label class="control-label"><?php echo $current_date; ?></label>

              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Time</label>
              <div class="col-sm-10"> 
                <input type="hidden" name="time" value="<?php echo $current_time; ?>">
                <label class="control-label"><?php echo $current_time; ?>&nbsp;HH:MM</label>
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-sm-2" for="pwd">Note</label>
              <div class="col-sm-10"> 
                <textarea name="timeout_note" class="form-control" rows="3"></textarea>
              </div>
            </div>
            <div class="form-group"> 
              <div class="col-sm-offset-1 col-sm-10">
                <?php echo form_submit('timeout', 'Time Out', ['class'=>'btn btn-default']); ?>
              </div>
            </div>
          <?php echo form_close(); ?>
          </div>
        </div>

      </div>
      <div class="col-sm-6">
        
        <div class="panel panel-default">
          <div class="panel-heading"><h4>Todays Break</h4></div>
          <div class="panel-body">
            <div class="form-group">
              <div class="row">
                <?php

                if (!$current_break) { ?>
                  <?php 
                  echo form_open('attendance/breakstart'); 
                  echo form_hidden('attendance_id', $attendance_current->id); 
                  ?>
                  <div class="col-sm-8">
                  <select name="type" id="" class="form-control">
                    <?php 
                    if( isset($breaks)) {
                      foreach($breaks as $break) {  ?>
                      <option value="<?=$break->id?>"><?=$break->label;?></option>
                    <?php 
                      } 
                    } 
                    ?>
                  </select>
                  </div>
                  <div class="col-sm-4">
                    <?php echo form_submit('add-break', 'Start Break Time', ['class'=>'btn btn-default']); ?>
                  </div>
                  <?php echo form_close(); ?>

                <?php 
                } else { ?>
                  <div class="col-sm-12">
                    <p>Status: On break (<?=$current_break->label?>)</p>
                    <p>Started: <?=$current_break->start?></p>
                    <?php echo form_open('attendance/breakend'); ?>
                    <?php echo form_hidden('id', $current_break->id); ?>
                    <?php echo form_submit('end-break', 'End Break Time', ['class'=>'btn btn-default']); ?>
                    <?php echo form_close(); ?>
                  </div>
                </div>
                <?php
                }
                ?>
            </div>

            <div class="table-responsive">
              <table class="table">
                  <thead>
                    <tr>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>Type</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    if ($shift_details) {
                      foreach($shift_details as $details) {   ?> 
                        <tr>
                          <td><?=$details->start?></td>
                          <td><?=$details->end?></td>
                          <td><?=$details->label?></td>
                        </tr>
                <?php 
                      } 
                    } 
                ?>
                  </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>