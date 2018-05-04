<div class="container">
	<div class="row">
		<?php if($this->session->userdata('userPositionSessId') == "0"): ?>
		<div class="col-md-3">
			<ul id="users">
			</ul>
		</div>
		<?php endif; ?>
		<div class="content col-md-9 text-center">
			<div id="chatHeader">Group Chat</div>
			<div id="chatBody"></div>
			<div id="chatBox">
				<?php if($this->session->userdata('userSessId') ): ?>
					<?php if($this->session->userdata('userPositionSessId') == "0"): ?>
						<input type="hidden" name="chatTo" id="chatTo">
					<?php else: ?>
						<input type="hidden" name="chatToAdmin" id="chatToAdmin">
					<?php endif; ?>
					<input type="hidden" name="user" id="user" value="<?php echo $this->session->userdata('userSessId'); ?>">
					<textarea name="chatMsg" id="chatMsg" class="form-control" placeholder="Start typing..."></textarea>
					<button class="btn btn-danger" onclick="saveUser()"><i class="fa fa-send"></i></button>
				<?php else: ?>
					<div id="authMsg">
						<p>Please <a href="/users"><b>Login</b></a> to send a message.</p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>