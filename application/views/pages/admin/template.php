

<?php $this->load->view("template/header"); ?>
<!-- page list devise -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
		
		<?php $this->load->view("pages/admin/nav_left") ?>
        <!-- Layout container -->
        <div class="layout-page">
			<?php $this->load->view("pages/admin/nav_top") ?>

			
			<?php $this->load->view($content); ?> <!-- content -->
		</div>
        <!-- / Layout container -->
    </div>
</div>
<!-- / Layout wrapper -->
<?php $this->load->view("template/footer"); ?>
