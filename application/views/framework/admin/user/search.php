<div class="container pad-top double">
	
	<div class="row">
		<div class="one fourths padded border">
			<div class="row"><h1>User</h1></div>
			Search user<br>
			Create new user<br>
		</div>
		
		<div class="three fourths padded border-left">
			<h2>Search User</h2>
			<?=form_open('admin/user/result')?>
				<div class="row padded">
					<label class="one fourths align-right">Username : </label>
					<div class="one fourths"><input type="text" name="username" /></div>
				</div>
				<div class="row padded">
					<div class="one fourths skip-one"><input type="submit" value="Search" /></div>
				</div>
			</form>
		</div>
	</div>
	
</div>