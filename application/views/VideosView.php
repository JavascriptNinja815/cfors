<?php 
include('layouts/header.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         videos
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-briefcase"></i> Master </a></li>
        <li><a href="#"> videos </a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
           <div class="box">
            <div class="box-header">
              <h3 class="box-title">videos Master</h3>
            </div> 

            <!-- /.box-header -->
            <div class="box-body" style="overflow-x:auto;">
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th> No. </th>
                    <th> Videos </th> 
                    <th> Capture Date</th>
                    <th> Latitude </th>
                    <th> Longitude </th>
                  </tr> 
                </thead>
                <tbody>
                <?php
                  $no=0;
                  foreach ($videos as $data) 
                  {
                    $no++;
                    $video_array = explode(',', $data['videos']);
                    $video_count = 0;
                    for ($i=0; $i<count($video_array); $i++)
                    {
                      if ($video_array[$i] != '')
                      {
                        $video_count++;
                ?>
                <input type="hidden" id="video_path_<?php echo $no; ?>_<?php echo $i; ?>" value="<?php echo VIDEO_PATH_PREFIX.$video_array[$i]; ?>" />
                <?php
                    }
                  }
                ?>
                <input type="hidden" id="video_count_<?php echo $no; ?>" value="<?php echo $video_count; ?>" />
                <input type="hidden" id="video_index_<?php echo $no; ?>" value="0" />
                <tr>
                  <td><?php echo $data['videoName'] == '' ? $data['id'] : $data['videoName']; ?></td>
                  <td>
                    <video id="video_<?php echo $no; ?>" width="320" height="240" controls preload="none" onended="onVideoEnded(<?php echo $no; ?>)";>
                      <source src="<?php echo VIDEO_PATH_PREFIX.$video_array[0]; ?>" type="video/mp4">
                    </video>
                  </td>
                  <td><?php echo $data['uploadedDate']; ?></td>    
                  <td><?php echo $data['lat']; ?></td>
                  <td><?php echo $data['lng']; ?></td> 
                </tr>
                <?php
                  }
                ?>               
                </tbody>
                <tfoot>
                   <tr>
                    <th> No. </th>
                    <th> Videos </th> 
                    <th> Capture Date</th>
                    <th> Latitude </th>
                    <th> Longitude </th>    
                    <th></th>
                  </tr> 
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <script>
      function onVideoEnded(no)
      {
          var video_count = document.getElementById("video_count_" + no).value;
          var video_index = document.getElementById("video_index_" + no).value;
          var video_player = document.getElementById("video_" + no);
          if (video_index < video_count - 1)
          {
              video_index++;
              video_player.setAttribute("src", document.getElementById("video_path_" + no + "_" + video_index).value);
              video_player.play();
          }
          else
          {
              video_index = 0;
              video_player.setAttribute("src", document.getElementById("video_path_" + no + "_" + video_index).value);
          }
          document.getElementById("video_index_" + no).value = video_index;
      }
  </script>
  <?php
include('layouts/footer.php');
?>
