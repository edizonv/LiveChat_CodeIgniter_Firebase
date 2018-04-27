<div class="container">
	<div class="content col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 text-center">
		<div id="chatHeader">Group Chat</div>
		<div id="chatBody"></div>
		<div id="chatBox">
			<?php if($this->session->userdata('userSessId') ): ?>
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