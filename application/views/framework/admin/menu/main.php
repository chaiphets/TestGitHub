<div class="container pad-top double">

<div class="row">
	<div class="one fourths padded border">
		<div class="row"><h1>Menu</h1></div>
		<div class="row submenu">
			<div class="two thirds"><a href="<?=site_url('admin/menu/reorder')?>"><p>Reorder menu</p></a></div>
			<div class="two thirds"><a href="<?=site_url('admin/menu/main')?>"><p>Create new main menu</p></a></div>
			<div class="two thirds"><a href="<?=site_url('admin/menu/sub')?>"><p>Create new sub menu</p></a></div>
			<div class="two thirds"><a href="<?=site_url('admin/menu/edit')?>"><p>Edit menu name and path</p></a></div>
		</div>
	</div>
	
	<div class="three fourths padded border-left">
		<h2>Create new main menu</h2>
		<?=form_open('admin/menu/main')?>
			<input type="hidden" name="save" value="save" />
			<div class="row padded">
				<label class="one fourths align-right">Permission : </label>
				<div class="one fourths">
					<select name="permission">
						<option disabled <?=$permission?'':'selected'?>>None</option>
						<?php foreach($permissions as $row):?>
							<option value="<?=$row->permission_id?>" <?=$permission==$row->permission_id?'selected':''?> path="<?=strtolower($row->controller).'/'?>">
								<?=$row->permission_name?>
							</option>
						<?php endforeach;?>
					</select>
				</div>
			</div>
			<div class="row padded">
				<label class="one fourths align-right">Menu name : </label>
				<div class="one fourths"><input type="text" name="menuName" value="<?=$menuName?>" /></div>
			</div>
			<div class="row padded">
				<label class="one fourths align-right">Path : </label>
				<div class="one sixths"><input type="text" name="ppath" readonly class="prefix" id="prefixpath" /></div>
				<div class="one fourths"><input type="text" name="path" value="<?=$path?>" /></div>
			</div>
			<div class="row padded">
				<label class="one fourths align-right">Show Sub Menu : </label>
				<div class="one fourths"><input type="checkbox" name="subMenu" <?=$subMenu=='on'?'checked':''?> /></div>
			</div>
			<input type="submit" value="Save" />
		</form>
	</div>
</div>

</div>
<?=isset($dump_var)?var_dump($dump_var):'No variable $dump_var'?>


<script>
$(function() {
	$("#prefixpath").val($("option:selected", this).attr("path"));
	
	$("select[name='permission']").change(function(){
		$("#prefixpath").val($("option:selected", this).attr("path"));
	});
});
</script>