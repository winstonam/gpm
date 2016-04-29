    <div class="container" style="background-color:#136686;">

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">

                    <!-- Logo -->
                    <a href="" class="logo">
                        <!-- logo for regular state and mobile devices -->
                        <span class="logo-lg"> <figure><img class="img-responsive" src="<?php echo base_url().('assets/imgs/logo-gpm.jpg') ?>"></figure>
                        </span>
                    </a>
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center" >GPM Web App</h3>
                    </div>
                    <div class="panel-body">
                        <?php if($this->session->flashdata('mensaje')) { ?>
                            <div id="alerta" class="alert alert-warning">
                                <p><?= $this->session->flashdata('mensaje') ?></p>
                            </div>
                        <?php } ?>
                        <form role="form" method="POST" action="<?php echo base_url('acceso/autenticar') ?>">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" name="usuario" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="contrasena" type="password" value="">
                                </div>
                               <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block" type="submit">Iniciar sesi&oacute;n</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
