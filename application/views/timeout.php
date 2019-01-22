<h3></h3>
<div class="container"> 
    <div class="row">
      <div class="col-sm-6">
        <div class="panel panel-default">
          <div class="panel-heading"><h4>Time Out</h4></div>
          <div class="panel-body">
        
            <?php echo form_open('attendance/timeout', ['class'=>'form-horizontal']); ?>
            <?php echo form_hidden('attendance_id', $dtr->id); ?>
            <div class="form-group">
              <label class="control-label col-sm-2" for="email">Time In</label>
              <div class="col-sm-10">
                <label class="control-label"><?php echo nice_date($dtr->timein, 'D, d M Y H:i'); ?></label>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="email">Time In Note</label>
              <div class="col-sm-10">
                <label class="control-label"><?php echo $dtr->timein_note; ?></label>
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
                if (!$on_break) { ?>
                  <?php 
                  echo form_open('attendance/add-break'); 
                  echo form_hidden('attendance_id', $dtr->id); 

                  ?>
                  <div class="col-sm-8">
                  <select name="type" id="" class="form-control">
                    <option value="coffee">Coffee</option>
                    <option value="launch">Launch</option>
                    <option value="bathroom">Bathroom</option>
                  </select>
                  </div>
                  <div class="col-sm-4">
                    <?php echo form_submit('add-break', 'Start Break Time', ['class'=>'btn btn-default']); ?>
                  </div>
                  <?php echo form_close(); ?>

                <?php 
                } else { ?>
                  <div class="col-sm-12">
                    <p>Status: On break (<?=$break_type?>)</p>
                    <p>Started: <?=$break_start_time?></p>
                    <?php echo form_open('attendance/end-break'); ?>
                    <?php echo form_hidden('id', $break_id); ?>
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
                    if ($todays_break) {
                      foreach($todays_break as $today) { ?> 
                        <tr>
                          <td><?=$today->break_start_time?></td>
                          <td><?=$today->break_end_time?></td>
                          <td><?=$today->type?></td>
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