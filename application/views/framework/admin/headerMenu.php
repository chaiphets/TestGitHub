<script type="text/javascript">
	function doNothing(){}
</script>


<div class="container">
	
	<h1>Admin Page</h1>
	<div class="row padded">
		<div class="one fourths">
			<nav class="inline nav menu">
				<ul>
					<li class="menu"><a href="javascript:doNothing();">Maintain</a>
						<ul>
							<li><a href="#user">User</a></li>
							<li><a href="#position">Position</a></li>
							<li><a href="#role">Role</a></li>
							<li><a href="#permission">Permission</a></li>
						</ul>
					</li>
					<li class="disabled"><a href="#config">Config</a></li>
				</ul>
			</nav>
		</div>
		<div class="one fourths skip-two align-right">
			<?=form_open('authentication/logout')?>
				<input type="submit" value="Logout">
			</form>
		</div>
	</div>
	
</div>
