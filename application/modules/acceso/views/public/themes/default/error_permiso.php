<!-- Main content -->
<section class="content">
    <div class="error-page">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <h2 class="headline text-red text-center"><i class="fa fa-hand-paper-o fa-3x"></i></h2>
                <h3 class="text-center text-red">Acceso restringido</h3>
                <p class="text-center">
                    <?php echo ($mensaje = $this->session->flashdata('mensaje')) ? $mensaje : 'No tiene permisos para la p&aacute;gina solicitada' ?>
                </p>
            </div>
        </div>
    </div>
</section><!-- /.content -->