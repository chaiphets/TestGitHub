<script type="text/javascript">
	function doNothing(){}
</script>

<?php if($this->session->userdata('userSession') != null):?>
<div class="container">
	
	<div class="row padded blue">
		<div class="two fourths">
			<?php if($menu != null){?>
			<nav class="inline nav menu">
				<ul>
					<?php 	for($i=0;$i<sizeof($menu);$i++){
								$m = $menu[$i];
								if($m->menu_order % 100 == 0){?>
									<li <?=($m->showSubMenu==1)?"class=\"menu\"":""?>>
										<a href="<?=site_url($m->path)?>"><?=$m->menu_name?></a>
					<?php			if(($i+1)<sizeof($menu) && $menu[$i+1]->menu_order % 100 == 0){?>
										</li>
					<?php 			}?>
					<?php		} else {
									if($i!=0 && $menu[$i-1]->menu_order % 100 == 0){?>
										<ul>
					<?php			}?>
									<li><a href="<?=site_url($m->path)?>"><?=$m->menu_name?></a></li>
					<?php			if($i+1==sizeof($menu) || $menu[$i+1]->menu_order % 100 == 0){?>
										</ul>
					<?php 			}
								}
							}?>
				</ul>
			</nav>
			<?php }?>
		</div>
		
		<div class="one fourths align-right">
			<h2>Log in as <?=$this->session->userdata('userSession')['username']?></h2>
		</div>
		
		<div class="one fourths align-right">
			<?=form_open('authentication/logout')?>
				<input type="submit" value="Logout">
			</form>
		</div>
	</div>
	
</div>
<?php endif;?>
<?php //=var_dump($this->session->all_userdata())?>