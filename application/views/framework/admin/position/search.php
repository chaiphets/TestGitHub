<div class="container pad-top double">
	
<div class="row">
	<div class="one fourths padded border">
		<div class="row"><h1>Position</h1></div>
		<div class="row submenu">
			<div class="two thirds"><a href="<?=site_url('admin/position/search')?>"><p>Search position</p></a></div>
			<div class="two thirds"><a href="<?=site_url('admin/position/add')?>"><p>Create new position</p></a></div>
		</div>
	</div>
	
	<div class="three fourths padded border-left">
		<div class="row" id="searchForm">
			<h2>Search Position</h2>
			<?=form_open('admin/position/search')?>
				<div class="row padded">
					<label class="one fourths align-right">Position : </label>
					<div class="one fourths"><input type="text" name="position" value="<?=isset($position)?$position:""?>" /></div>
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
				<?=form_open('admin/position/edit', $attr)?>
				<input type="hidden" name="position_id" id="position_id" />
				<table>
					<thead>
						<tr>
							<th></th>
							<th>ID</th>
							<th>Position</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
			<?php	foreach($result as $row){?>
						<tr>
							<td><a href="javascript:$('#position_id').val('<?=$row->position_id?>');$('#addEdit').submit();"><?=($row->position_name!='admin')?'edit':'edit admin'?></a></td>
							<td><?=$row->position_id?></td>
							<td><?=$row->position_name?></td>
							<td><?=$row->position_description?></td>
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