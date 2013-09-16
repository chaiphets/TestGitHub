<div class="container pad-top double">
	
<div class="row">
	<div class="one fourths padded border">
		<div class="row"><h1>Role</h1></div>
		<div class="row submenu">
			<div class="two thirds"><a href="<?=site_url('admin/role/search')?>"><p>Search role</p></a></div>
			<div class="two thirds"><a href="<?=site_url('admin/role/add')?>"><p>Create new role</p></a></div>
		</div>
	</div>
	
	<div class="three fourths padded border-left">
		<div class="row" id="searchForm">
			<h2>Search Role</h2>
			<?=form_open('admin/role/search')?>
				<div class="row padded">
					<label class="one fourths align-right">Role : </label>
					<div class="one fourths"><input type="text" name="role" value="<?=isset($role)?$role:""?>" /></div>
				</div>
				<div class="row padded">
					<div class="one fourths skip-one"><input type="submit" value="Search" /></div>
				</div>
			</form>
		</div>
		
		<?php	if(isset($result)){?>
		<?php 		if(!empty($result)){?>
		<div class="row gap-top triple" id="searchResult">
			<h2>Result</h2>
			<div class="three fourths centered">
				<?php $attr = array('id'=>'addEdit');?>
				<?=form_open('admin/role/edit', $attr)?>
				<input type="hidden" name="role_id" id="role_id" />
				<table>
					<thead>
						<tr>
							<th></th>
							<th>ID</th>
							<th>Role</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
			<?php	foreach($result as $row){?>
						<tr>
							<td><a href="javascript:$('#role_id').val('<?=$row->role_id?>');$('#addEdit').submit();"><?=($row->role_name!='admin')?'edit':'edit admin'?></a></td>
							<td><?=$row->role_id?></td>
							<td><?=$row->role_name?></td>
							<td><?=$row->role_description?></td>
						</tr>
			<?php 	}?>
					</tbody>
				</table>
				</form>
			</div>
		</div>
		<?php 		} else {?>
		<div class="three fourths centered">
			<p class="warning message gap-top triple">Not found user</p>
		</div>
		<?php 		}?>
		<?php 	}?>
	</div>
</div>
	
</div>