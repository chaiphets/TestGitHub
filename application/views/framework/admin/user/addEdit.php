<div class="container pad-top double">
	
<div class="row">
	<div class="one fourths padded border">
		<div class="row"><h1>User</h1></div>
		<div class="row submenu">
			<div class="two thirds"><a href="<?=site_url('admin/user/search')?>"><p>Search user</p></a></div>
			<div class="two thirds"><a href="<?=site_url('admin/user/add')?>"><p>Create new user</p></a></div>
		</div>
	</div>
	
	<div class="three fourths padded border-left">
		<div id="addEditUser">
			<h2><?=($action=='add'?'Add ':'Edit')?> User</h2>
			<?=form_open('admin/user/'.$action)?>
				<input type="hidden" name="save" value="<?=$action?>" />
				<div class="row padded <?=($action=='add'?'':'valid')?>">
					<label class="one fourths align-right">Username : </label>
					<div class="one fourths"><input type="text" name="username" value="<?=$username?>" <?=$action=='add'?'':'readonly'?>/></div>
				</div>
				<div class="row padded">
					<label class="one fourths align-right">Position : </label>
					<div class="one fourths">
						<select name="position">
							<option disabled <?=$userPosition?'':'selected'?>>None</option>
						<?php	foreach($positions as $row){?>
									<option value="<?=$row->position_id?>" <?=$userPosition==$row->position_id?'selected':''?>><?=$row->position_name?></option>
						<?php 	}?>
						</select>
					</div>
				</div>
				<div class="row padded">
					<label class="one fourths align-right">Active : </label>
					<div class="one fourths"><input type="checkbox" name="active" <?=$userActive=='on'?'checked':''?> /></div>
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