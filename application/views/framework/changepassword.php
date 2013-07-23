<div class="container pad-top double">
	
	<div class="row">
		<div class="one fourths padded border">
			<div class="row"><h1>Change Password</h1></div>
		</div>
		
		<div class="three fourths padded border-left">
			<h2 class="pad-top triple">Change Password</h2>
			<?=form_open('changepassword/change')?>
				<div class="row">
					<label class="one fourths align-right">Old password : </label>
					<div class="one fourths"><input type="password" name="oldpassword" /></div>
				</div>
				<div class="row pad-top triple">
					<label class="one fourths align-right">New password : </label>
					<div class="one fourths"><input type="password" name="newpassword" /></div>
				</div>
				<div class="row pad-top">
					<label class="one fourths align-right">Re-type password : </label>
					<div class="one fourths"><input type="password" name="repassword" /></div>
				</div>
				<div class="row padded">
					<div class="one fourths skip-one"><input type="submit" value="Change" /></div>
				</div>
			</form>
		</div>
	</div>
	
</div>