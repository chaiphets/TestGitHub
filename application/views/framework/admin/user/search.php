<div class="container pad-top double">
	
<div class="row">
	<div class="one fourths padded border">
		<div class="row"><h1>User</h1></div>
		<div class="row submenu">
			<div class="two thirds"><a href="<?=site_url('admin/user/search')?>"><p>Search user</p></a></div>
			<div class="two thirds"><a href="<?=site_url('admin/user/addEdit')?>"><p>Create new user</p></a></div>
		</div>
	</div>
	
	<div class="three fourths padded border-left">
		<div class="row" id="searchForm">
			<h2>Search User</h2>
			<?=form_open('admin/user/search')?>
				<div class="row padded">
					<label class="one fourths align-right">Username : </label>
					<div class="one fourths"><input type="text" name="username" value="<?=isset($username)?$username:""?>" /></div>
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
				<?=form_open('admin/user/addEdit', $attr)?>
				<input type="hidden" name="username" id="username" />
				<table>
					<thead>
						<tr>
							<th></th>
							<th>Username</th>
							<th>Position</th>
							<th>Active</th>
						</tr>
					</thead>
					<tbody>
			<?php	foreach($result as $row){?>
						<tr>
							<td><a href="javascript:$('#username').val('<?=$row->username?>');$('#addEdit').submit();"><?=($row->username!='admin')?'edit':'edit admin'?></a></td>
							<td><?=$row->username?></td>
							<td><?=$row->position_name?></td>
							<td><?=($row->enable_flag==1)?'True':'False'?></td>
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