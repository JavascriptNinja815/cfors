<?php 
include('layouts/header.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Master
        <small> Admin  </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-briefcase"></i> Master </a></li>
        <li><a href="#"> Admin  </a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <?php echo validation_errors(); ?>

            <?php echo form_open_multipart('UserAuthentication/update') ?>

              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"> Change Information
                    <small></small>
                  </h3><br /><br />                 
                  <input type="hidden" name="id" value="<?php echo $admin[0]['id'] ?>">
                  <div class="col-md-4">
                     <label> Email</label> 
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" name="email"  class="form-control" value="<?php echo $admin[0]['email'] ?>">                                                       
                      </div>
                  </div>
                  <div class="col-md-4">
                     <label> password </label> 
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input type="text" name="password"  class="form-control" value="<?php echo $admin[0]['password'] ?>">                                                        
                      </div>
                  </div>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn bg-primary margin"><i class="fa  fa-save"></i>  Save  </button>
                     <button type="button" class="btn btn-danger margin"><i class="fa fa-ban"> </i><a href="<?php echo site_url('UserAuthentication/profile/');?>" style="color:white">     Cancel</a> </button>
                </div>
                </div>

                </form>
              </div>
        </div>
      </div>
    </section>
    </div> 
  
  <?php
include('layouts/footer.php');
?>
