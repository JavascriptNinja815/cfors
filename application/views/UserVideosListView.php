<?php 
include('layouts/header_user.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="width: 100%; margin-left: 0px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Video List : <?=count($videos)?> Videos
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
           <div class="box">
            <div class="box-body" style="overflow-x:auto;">
              <form action="<?php echo site_url('userVideoController/search'); ?>" method="post">
                <select style="width: 20%;" name="filter" id="filter" title="Filter">
                  <option value="-1" <? if ($filter == -1) echo 'selected'; ?>>All</option>
                  <? $stateArray = unserialize(VIDEO_STATE_ARRAY);
                    for ($i=0; $i<sizeof($stateArray); $i++) { ?>
                    <option value="<?=$i?>" <? if ($filter == $i) echo 'selected'; ?>><?=$stateArray[$i]?></option>
                  <? } ?>
                </select>
                <button type="submit" class="btn btn-primary btn-xs">
                  <i class="fa fa-search"></i>&nbsp;&nbsp;&nbsp;Search
                </button>
              </form>
              <br/><br/>
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th> No.</th>
                    <th> User Name</th>
                    <th> Video  </th> 
                    <th> Capture Date</th>                  
                    <th> Latitude </th>
                    <th> Longitude </th>
                    <th> State </th>
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
                  <td><?php echo $data['uName']; ?></td>  
                  <td>
                    <video id="video_<?php echo $no; ?>" width="320" height="240" controls preload="none" onended="onVideoEnded(<?php echo $no; ?>)";>
                      <source src="<?php echo VIDEO_PATH_PREFIX.$video_array[0]; ?>" type="video/mp4">
                    </video>
                    <br/>
                    <a id="download_video_<?php echo $no; ?>" style="display: none;"></a>
                    <button onclick="downloadCurVideo(<?php echo $no;?>);">Download Video</button>
                    <button onclick="downloadAllVideos(<?php echo $no;?>);">Download Video Set</button>
                    <br/>
                    <span id="video_total_index_<?php echo $no; ?>" style="font-size: 20px;">1 / <?php echo $video_count;?></span>
                    <br/>
                    <a style="cursor: pointer;" onclick="setPrevVideoIndex(<?php echo $no;?>);">Prev</a>&nbsp;&nbsp;&nbsp;
                    <?php
                      for ($video_index=0; $video_index<$video_count; $video_index++)
                      {
                    ?>
                    <a style="cursor: pointer;" onclick="setVideoIndex(<?php echo $no;?>, <?php echo $video_index; ?>);"><?php echo $video_index + 1; ?></a>&nbsp;&nbsp;&nbsp;
                    <?php
                      }
                    ?>
                    <a style="cursor: pointer;" onclick="setNextVideoIndex(<?php echo $no;?>);">Next</a>&nbsp;&nbsp;&nbsp;
                  </td>
                  <td><?php echo $data['uploadedDate']; ?></td>    
                  <td><?php echo $data['lat']; ?></td>
                  <td><?php echo $data['lng']; ?></td> 
                  <td>
                    <form action="<?php echo site_url('userVideoController/saveVideoState/'.$data['id']); ?>" method="post">
                      <select style="width: 100%;" name="state_<?php echo $data['id']; ?>" id="state_<?php echo $data['id']; ?>" title="Video State">
                        <? $stateArray = unserialize(VIDEO_STATE_ARRAY);
                          for ($i=0; $i<sizeof($stateArray); $i++) { ?>
                          <option value="<?=$i?>" <? if ($data['state'] == $i) echo 'selected'; ?>><?=$stateArray[$i]?></option>
                        <? } ?>
                      </select>
                      <p>
                        <button type="submit" class="btn btn-primary btn-xs">
                          <i class="fa fa-save"></i>&nbsp;&nbsp;&nbsp;Modify State
                        </button>
                      </p>
                    </form>
                  </td>
                </tr>
                <?php
                }
                ?>               
                </tbody>
                <tfoot>
                   <tr>
                    <th> No.</th>
                    <th> User Name</th>
                    <th> Video  </th> 
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

      function downloadCurVideo(no)
      {
        var video_index = document.getElementById("video_index_" + no).value;
        var video_path = document.getElementById("video_path_" + no + "_" + video_index).value;

        var a = document.querySelector("#download_video_" + no);
        a.download = '';
        a.href = video_path;
        a.click();
      }

      function downloadAllVideos(no)
      {
        var video_count = document.getElementById("video_count_" + no).value;
        for (var video_index=0; video_index<video_count; video_index++)
        {
          var video_path = document.getElementById("video_path_" + no + "_" + video_index).value;
          var a = document.querySelector("#download_video_" + no);
          a.download = '';
          a.href = video_path;
          a.click();
        }
      }

      function setPrevVideoIndex(no)
      {
          var video_index = document.getElementById("video_index_" + no).value;
          var video_count = document.getElementById("video_count_" + no).value;
          var video_player = document.getElementById("video_" + no);
          if (video_index > 0)
          {
              video_index--;
          }
          else
          {
              video_index = video_count - 1;
          }
          setVideoIndex(no, video_index);
      }

      function setNextVideoIndex(no)
      {
          var video_index = document.getElementById("video_index_" + no).value;
          var video_count = document.getElementById("video_count_" + no).value;
          var video_player = document.getElementById("video_" + no);
          if (video_index < video_count - 1)
          {
              video_index++;
          }
          else
          {
              video_index = 0;
          }
          setVideoIndex(no, video_index);
      }

      function setVideoIndex(no, video_index)
      {
          var video_count = document.getElementById("video_count_" + no).value;
          var video_player = document.getElementById("video_" + no);
          video_player.setAttribute("src", document.getElementById("video_path_" + no + "_" + video_index).value);
          video_player.play();
          document.getElementById("video_index_" + no).value = video_index;
          document.getElementById("video_total_index_" + no).innerHTML = (video_index + 1) + " / " + video_count;
      }

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
          document.getElementById("video_total_index_" + no).innerHTML = (video_index + 1) + " / " + video_count;
      }

      function check()
      {
        if (confirm("Do you want to delete the video(s)?") == false)
        {
          return false;
        }
        return true;
      }

      function is_one_checked(chk_name, isval)
      {
        var chk = document.getElementsByName(chk_name);
        if(chk != null)
        {
          for(var i=0; i < chk.length;i++)
          {
            if(chk[i].checked == isval)
            {
              return true;
            }
          }
        }
        return false;
      }

      function AllChk(chkAllObjName, chkArrName, chkval)
      {
        if (chkval!=undefined)
        {
          chkAllObjName.checked = chkval;
        }

        var isAllCheck = chkAllObjName.checked;
        var chk = document.getElementsByName(chkArrName);

        if(chk != null)
        {
          for(var i=0; i < chk.length;i++)
          {
            chk[i].checked = isAllCheck;
          }
        }
      }

      function checkoneInAll(chkAllObjName, chkArrName)
      {
        chkAllObj = document.getElementById(chkAllObjName);
        chkAllObj.checked = !is_one_checked(chkArrName, false)
      }
  </script>
