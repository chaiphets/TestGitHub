<div class="container pad-top double">
	
<div class="row">
	<div class="one fourths padded border">
		<div class="row"><h1>Role</h1></div>
		<div class="row submenu">
			<div class="two thirds"><a href="<?=site_url('admin/role/search')?>"><p>Search role</p></a></div>
			<div class="two thirds"><a href="<?=site_url('admin/role/add')?>"><p>Create new role</p></a></div>
		</div>
	</div>
	<?php //echo var_dump($temp)?>
	<div class="three fourths padded border-left">
		<div id="addEditUser">
			<h2><?=($action=='add'?'Add ':'Edit')?> Role</h2>
			<?=form_open('admin/role/'.$action)?>
				<input type="hidden" name="save" value="<?=$action?>" />
				<div class="row padded valid">
					<label class="one fourths align-right">ID : </label>
					<div class="one fourths"><input type="text" name="role_id" value="<?=$role_id?>" readonly /></div>
				</div>
				<div class="row padded">
					<label class="one fourths align-right">Role : </label>
					<div class="one fourths"><input type="text" name="role_name" value="<?=$role_name?>" /></div>
				</div>
				<div class="row padded">
					<label class="one fourths align-right">Description : </label>
					<div class="two fourths"><input type="text" name="description" value="<?=$description?>" /></div>
				</div>
				
				<div class="row padded">
					<input type="hidden" name="selectedPermissions" id="selectedPermissions" />
					<label class="one fourths align-right">Permission : </label>
					<div class="pad-top">
						<div class="one fourths align-center gapped">
							<label class="one whole">Selected</label>
							<ul class="one whole connectedSortable bordered padded" id="selected" style="margin: 0">
								<?php if(is_array($selectedPermissions)):?>
								<?php foreach($selectedPermissions as $permission){?>
									<li class="one whole info button gap-bottom" value="<?=$permission->permission_id?>"><?=$permission->permission_name?></li>
								<?php }?>
								<?php endif;?>
							</ul>
						</div>
						<div class="one fourths align-center gapped">
							<label class="one whole">Available</label>
							<ul class="one whole connectedSortable bordered padded" id="available" style="margin: 0">
								<?php foreach($availablePermissions as $permission){?>
									<li class="one whole info button gap-bottom" value="<?=$permission->permission_id?>"><?=$permission->permission_name?></li>
								<?php }?>
							</ul>
						</div>
					</div>
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