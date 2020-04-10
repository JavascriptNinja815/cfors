<?php 
include('layouts/header.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         videos List
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-briefcase"></i> Master </a></li>
        <li><a href="#"> videos List </a></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
           <div class="box">
            <div class="box-header">
              <h3 class="box-title">videos List Master</h3>
            </div> 
            <!-- /.box-header -->
            <form action="<?php echo site_url('VedioController/deleteVideos'); ?>" method="post" onsubmit="return check();">
            <div class="box-body" style="overflow-x:auto;">
              <table width="100%">
                <tr>
                  <td height="50px" align="right">
                    <input type="submit" value="Delete Video(s)" />
                  </td>
                </tr>
              </table>
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><input id="_check_all" onclick="AllChk(this,'video_checks[]');" name="_check_all" value="" type="checkbox"></th>
                    <th> No.</th>
                    <th> User Name</th>
                    <th> Video  </th> 
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
                  <td><input type="checkbox" name="video_checks[]" value="<?php echo $data['id'];?>"  onClick="checkoneInAll('_check_all', 'video_checks')"/></td>
                  <td><?php echo $data['videoName'] == '' ? $data['id'] : $data['videoName']; ?></td>
                  <td><?php echo $data['uName']; ?></td>  
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
                    <th>&nbsp;</th>
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
            </form>
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
  <?php
include('layouts/footer.php');
?>
