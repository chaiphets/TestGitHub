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
		<h2>Create new sub menu</h2>
		<?=form_open('admin/menu/sub')?>
			<input type="hidden" name="save" value="save" />
			<div class="row padded">
				<label class="one fourths align-right">Main Menu : </label>
				<div class="one fourths">
					<select name="main">
						<option disabled <?=$main?'':'selected'?>>None</option>
						<?php foreach($mainMenus as $row):?>
							<option value="<?=$row->menu_name?>" <?=$main==$row->menu_name?'selected':''?> path="<?=strtolower($row->controller).'/'?>">
								<?=$row->menu_name?>
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
			<input type="submit" value="Save" />
		</form>
	</div>
</div>

</div>
<?=isset($dump_var)?var_dump($dump_var):'No variable $dump_var'?>


<script>
$(function() {
	$("#prefixpath").val($("option:selected", this).attr("path"));
	
	$("select[name='main']").change(function(){
		$("#prefixpath").val($("option:selected", this).attr("path"));
	});
});
</script>