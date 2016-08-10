<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Pagina Principal</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
<?php 
$array =array_values($this->session->all_userdata());
  echo '<h3>Bienvenido '.$array[2].' '.$array[3].'</h3>';
 ?> 
</div>
<!-- /#page-wrapper -->