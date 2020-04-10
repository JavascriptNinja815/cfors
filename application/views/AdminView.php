<?php 
include('layouts/header.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Master
        <small>Admin View</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-briefcase"></i> Master </a></li>
        <li><a href="#"> Admin View </a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
           <div class="box">

            <!-- /.box-header -->
            <div class="box-body">
               <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr.No</th>
                    <th> Username </th>
                    <th> password </th>  
                    <th> Action </th>        
                  </tr>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>  
                    <th>Edit</th>        
                  </tr>
                </thead>
                <tbody>
                <?php
                $no=0;
                foreach ($admin as $data) 
                  {
                   $no++; 
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['email']; ?></td>
                  <td><?php echo $data['password']; ?></td>
                   <td>
                    <small class="label label-warning">
                      <a href="<?php echo base_url().'index.php/UserAuthentication/load/'.$data['id']; ?>">
                        <i class="fa fa-edit"></i>
                      </a>
                    </small>
                </td>
                
                </tr>
                <?php
              }
              ?>               
                </tbody>
                <tfoot>
                    <tr>
                    <th>Sr.No</th>
                    <th>Username </th>
                    <th> password </th>  
                    <th> Action </th>        
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
  <?php
include('layouts/footer.php');
?>
