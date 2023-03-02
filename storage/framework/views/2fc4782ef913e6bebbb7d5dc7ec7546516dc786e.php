<?php
   $language = DB::table('languages')->latest()->first();
    $alert_product = DB::table('products')->where('is_active', true)->whereColumn('alert_quantity', '>', 'qty')->count();
    $general_setting = DB::table('general_settings')->latest()->first();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo e($general_setting->site_title); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap-datepicker.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap-select.min.css') ?>" type="text/css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo asset('vendor/font-awesome/css/font-awesome.min.css') ?>" type="text/css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="<?php echo asset('css/fontastic.css') ?>" type="text/css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="<?php echo asset('css/grasp_mobile_progress_circle-1.0.0.min.css') ?>" type="text/css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="<?php echo asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') ?>" type="text/css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo asset('css/style.default.css') ?>" id="theme-stylesheet" type="text/css">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo asset('css/custom-'.$general_setting->theme) ?>" type="text/css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery-ui.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery/bootstrap-datepicker.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/popper.js/umd/popper.min.js') ?>">
    </script>
    <script type="text/javascript" src="<?php echo asset('vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/bootstrap/js/bootstrap-select.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/grasp_mobile_progress_circle-1.0.0.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery.cookie/jquery.cookie.js') ?>">
    </script>
    <script type="text/javascript" src="<?php echo asset('vendor/chart.js/Chart.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery-validation/jquery.validate.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/charts-home.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/front.js') ?>"></script>
  </head>

  <body>
    <div class="page login-page" style="background-image: url('<?php echo asset('images/fondo_inicio/fondo_edit2.png') ?>');">
      <div class="container">
        <div class="form-outer text-center d-flex align-items-center">
          <div class="form-inner" style="background-color: rgb(2 2 2 / 39%)"> 
         <h1 style="color:white">LAZARO-ERP </h1>
            <?php if(session()->has('delete_message')): ?>
            <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('delete_message')); ?></div>
            <?php endif; ?>
            <form method="POST" action="<?php echo e(route('login')); ?>" id="login-form">
              <?php echo e(csrf_field()); ?>

              <div class="form-group-material">
                <input id="login-username" type="text" name="email" required class="form-control" value="" placeholder="Usuario">
              <!--  <label for="login-username" class=""><?php echo e(trans('file.UserName')); ?></label>-->
                <?php if($errors->has('email')): ?>
                    <p>
                        <strong><?php echo e($errors->first('email')); ?></strong>
                    </p>
                <?php endif; ?>
              </div>

              <div class="form-group-material">
                <input id="login-password" type="password" name="password" required class="form-control" placeholder="Constraseña" value="">
                  <!--<label for="login-password" class=""><?php echo e(trans('file.Password')); ?></label>-->
                <?php if($errors->has('email')): ?>
                    <p>
                        <strong><?php echo e($errors->first('email')); ?></strong>
                    </p>
                <?php endif; ?>
              </div>
              <button type="submit" class="btn btn-primary"><?php echo e(trans('file.LogIn')); ?></button>
            </form>

            <!--<a   style="color: dodgerblue;" href="<?php echo e(route('password.request')); ?>" class="forgot-pass"><?php echo e(trans('file.Forgot Password?')); ?></a>
            <p style="color: dodgerblue;"><?php echo e(trans('file.Do not have an account?')); ?></p><a style="color: darkblue;" href="<?php echo e(url('register')); ?>" class="signup"><?php echo e(trans('file.Register')); ?></a>-->
          </div>
         <!-- <div class="copyrights text-center">
            <strong><h1 style="color: black;">By <a href="#" class="external">Otech Soluciones Informáticas</a></h1></strong>
          </div>-->
        </div>
      </div>
    </div>
  </body>
</html>

<script type="text/javascript">

  /*  $('.admin-btn').on('click', function(){
        $("input[name='name']").focus().val('admin');
        $("input[name='password']").focus().val('admin');
    });

  $('.staff-btn').on('click', function(){
      $("input[name='name']").focus().val('staff');
      $("input[name='password']").focus().val('staff');
  });*/
</script>
<?php /**PATH C:\laragon\www\PROYECTO-LAZARO\PUBLICO_GENERAL\nueva-version\resources\views/auth/login.blade.php ENDPATH**/ ?>