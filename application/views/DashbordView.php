<?php 
include('layouts/header.php');

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">     

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
               <?php 
              $query = $this->db->query('SELECT * FROM users');
              ?>
              <h3><?php echo $query->num_rows();?></h3>
              <p>Users </p>
            </div>
            <div class="icon">
             <i class="ion ion-person-add"></i> 
            </div>
            <a href="<?php echo site_url('UsersController');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
               <?php 
              $query = $this->db->query('SELECT * FROM videos');
              ?>
              <h3><?php echo $query->num_rows();?></h3>
              <p>videos</p>
            </div>
            <div class="icon">
              <i class="fa fa-video-camera"></i> 
            
            </div>
            <a href="<?php echo site_url('VedioController');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!--  <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
               <?php 
              $query = $this->db->query('SELECT * FROM users');
              ?>
              <h3><?php echo $query->num_rows();?></h3>
              <p>Bus</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people"></i> 
            
            </div>
            <a href="<?php echo site_url('UsersController');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>  -->
      <!--  <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
               <?php 
              $query = $this->db->query('SELECT * FROM users');
              ?>
              <h3><?php echo $query->num_rows();?></h3>
              <p>Form Submission</p>
            </div>
            <div class="icon">
             <i class="fa fa-reply"></i> 
            </div>
            <a href="<?php echo site_url('UsersController');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>   -->
         <!-- <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-orange">
            <div class="inner">
               <?php 
              $query = $this->db->query('SELECT * FROM users');
              ?>
              <h3><?php echo $query->num_rows();?></h3>
              <p>Form Submission</p>
            </div>
            <div class="icon">
             <i class="fa fa-money"></i> 
            </div>
            <a href="<?php echo site_url('UsersController');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>  -->
         </section>
    <!-- /.content -->
  </div>

    </section>
  </div>


<?php
include('layouts/footer.php');
?>
