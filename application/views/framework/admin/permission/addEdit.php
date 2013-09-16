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
		<div id="addEditUser">
			<h2><?=($action=='add'?'Add ':'Edit')?> Permission</h2>
			<?=form_open('admin/permission/'.$action)?>
				<input type="hidden" name="save" value="<?=$action?>" />
				<div class="row padded valid">
					<label class="one fourths align-right">ID : </label>
					<div class="one fourths"><input type="text" name="permission_id" value="<?=$permission_id?>" readonly /></div>
				</div>
				<div class="row padded">
					<label class="one fourths align-right">Permission : </label>
					<div class="one fourths"><input type="text" name="permission_name" value="<?=$permission_name?>" /></div>
				</div>
				<div class="row padded">
					<label class="one fourths align-right">Controller : </label>
					<div class="two fourths"><input type="text" name="controller" value="<?=$controller?>" /></div>
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

<script>
$(function() {
	$( "#selected, #available" ).sortable({
		connectWith: ".connectedSortable",
		stop: selectedAvailableChange
	}).disableSelection();

	var selected = $("#selected").height() + 22;
	var available = $("#available").height() + 22;
	if(selected < available){
		selected = available;
	} else if(selected > available) {
		available = selected;
	} else {
		selected += 40;
		available += 40;
	}
	$("#selected").css("minHeight", selected+"px");
	$("#available").css("minHeight", available+"px");

	var arr = [];
	$("#selected li").each(function(){
		arr.push($(this).attr('value'));
	});
	$('#selectedPermissions').val(arr.join(','));
});

function selectedAvailableChange(){
	var selected = $("#selected").css("minHeight");
	selected = selected.substr(0, selected.length-2);
	if(selected < $("#selected").height()){
		selected = $("#selected").height() + 22;
	}

	var available = $("#available").css("minHeight");
	available = available.substr(0, available.length-2);
	if(available < $("#available").height()){
		available = $("#available").height() + 22;
	}

	if(selected < available){
		selected = available;
	} else if(selected > available) {
		available = selected;
	}

	$("#selected").css("minHeight", selected+"px");
	$("#available").css("minHeight", available+"px");

	var arr = [];
	$("#selected li").each(function(){
		arr.push($(this).attr('value'));
	});
	$('#selectedPermissions').val(arr.join(','));
}
</script>