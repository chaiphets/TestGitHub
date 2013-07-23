<div class="container pad-top double">
	
	<div class="row">
		<div class="one fourths padded border">
			<div class="row"><h1>User</h1></div>
			Search user<br>
			Create new user<br>
		</div>
		
		<div class="three fourths padded border-left">
			<!-- add edit user -->
			<div id="addEditUser">
				<h2>Add/Edit User</h2>
				<?=form_open('admin/user/addEdit')?>
					<div class="row padded">
						<label class="one fourths align-right">Username : </label>
						<div class="one fourths"><input type="text" name="username" /></div>
					</div>
					<div class="row padded">
						<label class="one fourths align-right">Position : </label>
						<div class="one fourths">
							<select name="position">
								<option value disabled selected>None</option>
							</select>
						</div>
					</div>
					<div class="row padded">
						<label class="one fourths align-right">Active : </label>
						<div class="one fourths"><input type="checkbox" name="active" checked /></div>
					</div>
					<div class="row padded">
						<div class="one fourths skip-one">
							<input type="submit" value="Save" class="icon-save" />
						</div>
					</div>
				</form>
			</div>
			
			
		</div>
	</div>
	
</div>