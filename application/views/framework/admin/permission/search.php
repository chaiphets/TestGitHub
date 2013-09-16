<div class="container pad-top double">
	
<div class="row">
	<div class="one fourths padded border">
		<div class="row"><h1>Permission</h1></div>
		<div class="row submenu">
			<div class="two thirds"><a href="<?=site_url('admin/permission/search')?>"><p>Search permission</p></a></div>
			<div class="two thirds"><a href="<?=site_url('admin/permission/add')?>"><p>Create new permission</p></a></div>
		</div>
	</div>
	
	<div class="three fourths padded border-left">
		<div class="row" id="searchForm">
			<h2>Search Permission</h2>
			<?=form_open('admin/permission/search')?>
				<div class="row padded">
					<label class="one fourths align-right">Permission : </label>
					<div class="one fourths"><input type="text" name="permission" value="<?=isset($permission)?$permission:""?>" /></div>
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
				<?=form_open('admin/permission/edit', $attr)?>
				<input type="hidden" name="permission_id" id="permission_id" />
				<table>
					<thead>
						<tr>
							<th></th>
							<th>ID</th>
							<th>Permission</th>
							<th>Controller</th>
						</tr>
					</thead>
					<tbody>
			<?php	foreach($result as $row){?>
						<tr>
							<td><a href="javascript:$('#permission_id').val('<?=$row->permission_id?>');$('#addEdit').submit();"><?=($row->permission_name!='admin')?'edit':'edit admin'?></a></td>
							<td><?=$row->permission_id?></td>
							<td><?=$row->permission_name?></td>
							<td><?=$row->controller?></td>
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