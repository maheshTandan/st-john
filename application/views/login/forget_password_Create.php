<?php include('application/views/Header/header.php') ?>
<?php 

 $email = $stuff['email1']; 
 $id = $stuff['id'];

?>
 <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url();?>Signup_controller/login"><i class="fa fa-sign-out fa-fw"></i>Login</a>
                        </li>
                    </ul>
                </li>
            
            </ul>
        </nav>

<div id="page-wrapper">
<table cellpadding="0" cellspacing="0" style="width:100%;text-align:center;border-collapse:collapse;background-color:#ffffff;max-width:600px;margin:0 auto;border:1px solid #eee;font-family:sans-serif;font-size:16px;">
	<tbody>
		<tr>
			<td>
			<table cellpadding="0" cellspacing="0" style="width:100%;border-collapse:collapse;">
				<tbody>
					<tr>
						<td>
						<table cellpadding="0" cellspacing="0" style="margin:0 auto;width:100%;max-width:600px;border-collapse:collapse;background: #f5f5f5;">
							<tbody>
							
							<tr>
									<td style="padding:20px;text-align:left;font-size:15px;line-height:23px;width:100%;color:#464545;background: #fff;">
								
									<p> Please check your mail for set your new password </p>

									</td>
								</tr>
								
							</tbody>
						</table>
						</td>
					</tr>
				</tbody>
			</table>
			</td>
		</tr>
	</tbody>
</table>
    
</form>
</div>

      <?php include('application/views/Footer/footer.php') ?>