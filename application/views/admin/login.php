<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
			<form class="login100-form validate-form" action="./login" method="POST">
				<p class="errors"><?=$errors?></p>
				<span class="login100-form-title p-b-55">
					Admin Login
				</span>

				<div class="wrap-input100 validate-input m-b-16" data-validate = "Login is required">
					<input class="input100" type="text" name="login" placeholder="Login" autocomplete="off">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-user" aria-hidden="true"></i>
					</span>
				</div>

				<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
					<input class="input100" type="password" name="password" placeholder="Password">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-lock" aria-hidden="true"></i>
					</span>
				</div>

				<div class="contact100-form-checkbox m-l-4">
					<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember">
					<label class="label-checkbox100" for="ckb1">
						Remember me
					</label>
				</div>

				<div class="container-login100-form-btn p-t-25">
					<button class="login100-form-btn">
						Login
					</button>
				</div>


			</form>
		</div>
	</div>
</div>
