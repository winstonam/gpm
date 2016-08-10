<div id="page-wrapper">
	<div class="row  page-header">
		<div class="col-lg-12">
			  <?php
			  $array= array_values($this->session->all_userdata());
			   echo '<h1 > Pagina Principal '.$array[8].' </h1>';
			    ?>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<?php 
		$datos=array_values($this->session->all_userdata());
		echo '<h3>Bienbenido '.$datos[3].' '.$datos[4].'</h3>'
	?>
</div>
<!-- /#page-wrapper -->