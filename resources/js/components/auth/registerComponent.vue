<template>
		<div class="w3-margin-top">
			<div class="form-group text-right">
					<validation-provider name="name" rules="required|max:25|string" v-slot="{ errors }">
						<input class="form-control text-right"  placeholder="الاسم" type="text" name="name"  v-model="name">
						<span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
							{{ errors[0] }}
						</span>
					</validation-provider>
				</div>

				<div class="form-group text-right">
						<validation-provider name="email" rules="required|max:25|email" v-slot="{ errors }">
	            <input class="form-control text-right"  placeholder="البريد اللكتروني" type="email" name="email"  v-model="email">
							<span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
								{{ errors[0] }}
							</span>
						</validation-provider>
          </div>

					<div class="form-group text-right">
							<validation-provider name="phone" rules="required|max:15" v-slot="{ errors }">
		            <input class="form-control text-right"  placeholder="رقم الهاتف" type="text" name="phone"  v-model="phone">
								<span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
									{{ errors[0] }}
								</span>
							</validation-provider>
	          </div>

          <div class="form-group text-right">
						<validation-provider name="password" rules="required|min:6" v-slot="{ errors }">
	            <input class="form-control text-right"  placeholder="كلمة المرور" type="password" id="password"  name="password" v-model="password">
							<span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
								{{ errors[0] }}
							</span>
						</Validation-Provider>
          </div>

					<div class="form-group text-right">
						<validation-provider name="password_confirmation" rules="required|min:6" v-slot="{ errors }">
	            <input class="form-control text-right"  placeholder="اعد كتابة كلمة المرور" type="password" id="password_confirmation"  name="password_confirmation" v-model="password_confirmation">
							<span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
								{{ errors[0] }}
							</span>
						</Validation-Provider>
          </div>

					<div class="form-group text-right">
						<validation-provider name="type" rules="required" v-slot="{ errors }">
							<select class="form-control text-right" name="type" v-model="type">
								<option value="developer">مطور</option>
								<option value="project_owner">صاحب مشروع</option>
							</select>
							<span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
								{{ errors[0] }}
							</span>
						</Validation-Provider>
          </div>


					<div class="form-group text-right">
							<p class="gender">
									<label for="male" >ذكر</label>
									<input class="w3-border w3-right-align" type="radio" name="gender" id="male" value="male" checked>
							</p>
							<p class="gender">
									<label for="female">انثى</label>
									<input class="w3-border w3-right-align" type="radio" name="gender" id="female" value="female">
							</p>
					</div>
    </div>
</template>


<script>
	import { ValidationProvider } from 'vee-validate';
	export default {
		components: {
				ValidationProvider
		},
	}
</script>


<style>


</style>
