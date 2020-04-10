<?php 
include('layouts/header.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Master
        <small>Users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-briefcase"></i> Master </a></li>
        <li><a href="#"> Users </a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
           <div class="box">
            <div class="box-header">
              <h3 class="box-title">Users Master</h3>
            <!--  <p align="right">
              <a href="<?php echo site_url('UsersController/Add');?>">
                <button type="submit" class="btn bg-primary margin"><i class="fa fa-plus"></i>  Add  </button></a> 
              </p>  -->
            </div> 

            <!-- /.box-header -->
            <div class="box-body" style="overflow-x:auto;">
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th> Sr.No</th>
                    <th> User Name </th>
                    <th> Surname </th>
                    <th> Email</th> 
                   <!--  <th> Lat</th>                  
                    <th> Lag</th> -->
                    <th>Action</th>     
                  </tr> 
                </thead>
                <tbody>
                <?php
                $no=0;
                foreach ($users as $data) 
                  {
                   $no++; 
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['username']; ?></td>
                  <td><?php echo $data['surname']; ?></td>
                  <td><?php echo $data['email']; ?></td>   
                <!--   <td><?php echo $data['lat']; ?></td>
                  <td><?php echo $data['lng']; ?></td>  -->
                  <td>
                    <small class="label label-warning1">
                      <a href="<?php echo base_url().'index.php/UsersController/loadVedioView/'.$data['id']; ?>">
                        <i class="fa fa-eye fa-2x" aria-hidden="true"></i>
                      </a>
                    </small>
                   </td>             
                <!--   <td><?php 
                    $id = $data['id'];
                    $status = $data['status'];                    
                    if($data['status']==1) {
                      echo "<a href=ClientController/updateStatus/".$id."/".$status.">Active</a>";
                    } else {
                      echo "<a href=ClientController/updateStatus/".$id."/".$status.">Deactive</a>";
                    }
                  ?></td> -->
                   <!-- <td>
                    <small class="label label-warning">
                      <a href="<?php echo base_url().'index.php/ClientController/load/'.$data['id']; ?>">
                        <i class="fa fa-edit"></i>
                      </a>
                    </small>
                   </td> -->
                <!--    <td>
                    <a id="deleted" 
                    onclick="deleted(<?php echo $data['id'];?>)" href='#'><b> <small class="label label-danger"><i class="fa fa-trash"></i></small></b></a>
                  </td>  -->
                </tr>
                <?php
              }
              ?>               
                </tbody>
                <tfoot>
                 <tr>
                    <th> Sr.No</th>
                    <th> User Name </th> 
                    <th> Email</th> 
                  <!--   <th> Lat</th>                  
                    <th> Lag</th> -->
                    <th>Action</th>     
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
function deleted(id)
{ 
  // alert(id);
swal({
  title: "Are you sure to delete?",
  text: "Once deleted, you will not be able to recover this!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    $.ajax({
        url: "<?php echo site_url('ClientController/delete');?>",
        type: "post",
        data: {'id':id},
        success: function (response) {
         
          swal(response, {
            icon: "success",
          });
          var URL = "<?php echo site_url('ClientController');?>";
          setTimeout(function(){ window.location = URL; }, 1000);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
    
  } else {
    swal("Your record is safe!");
  }
});
}
</script>
  <?php
include('layouts/footer.php');
?>
