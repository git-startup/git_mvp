<template>
	<div id="agreement_model" class="w3-modal" style="display: none;">
			<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="">
					<div class="w3-margin row" style="padding-top: 30px">
							<div class="form-group col-md-12">
								<label for="work_title">اسم تعريفي للمشروع</label>
								<validation-provider name="work_title" rules="required|max:150" v-slot="{ errors }">
									<input type="text" id="work_title" name="work_title" v-model="work_title" class="form-control">
									<span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
										{{ errors[0] }}
									</span>
								</Validation-Provider>
							</div>
							<div class="form-group col-md-6">
								<label for="end_of_agreement"> بداية ونهاية فترة العمل  </label>
								<date-picker v-model="range" range  lang="en" type="date" formate="YYYY-MM-dd" style="width: 100%"></date-picker>
							</div>
							<div class="form-group col-md-6">
								<label> تكلفة التطوير </label>
								<vue-slider
	                v-model="price"
	                :min="0"
	                :max="400"
	                :interval="1" >
	              </vue-slider>
							</div>
							<div class="form-group col-md-12">
								<label for="agreement">اكتب اتفاق العمل بالتفصيل </label>
								<validation-provider name="agreement" rules="required|min:250" v-slot="{ errors }">
									<textarea id="agreement" name="agreement" class="form-control" v-model="agreement" rows="8" cols="80"></textarea>
									<span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
										{{ errors[0] }}
									</span>
								</Validation-Provider>
							</div>
					</div>

					<footer class="w3-container" dir="rtl" style="margin-right: 15px">
							<div class="w3-section w3-right">
									<button tabindex="1" title="ارسال" type="button"  @click="send_request_btn()" id="send_request_btn"  value="ارسال الطلب" class="btn btn-primary w3-round" style="padding: 7px 15px">
											<i class="fa fa-send w3-margin-left-8"></i><span>ارسال الطلب</span></span></button>
									<span tabindex="2" title="إلغاء" onclick="document.getElementById('agreement_model').style.display='none'"  class="btn w3-light-grey w3-round" style="padding: 7px 15px;">
											<i class="fa fa-times w3-margin-left-8"></i><span>إلغاء</span></span></button>
							</div>
					</footer>

			</div>
	</div>
</template>

<script>
import { ValidationProvider } from 'vee-validate';
// to import datepicker component
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
// to import slider component
import VueSlider from 'vue-slider-component';
import 'vue-slider-component/theme/antd.css';

	export default{
		components: {
				ValidationProvider,
				DatePicker,
				VueSlider
		},
		props: {
			user : {
				type: Object,
				required: true,
			}
		},
		data(){
			return {
				work_title: '',
				agreement: '',
				range: [],
				price: 0,
				end_of_agreement: ''
			}
		},
		mounted() {
            Echo.private(`work-request.${this.user.id}`)
                .listen('workNotification', (e) => {
                    this.hasRequest(e.user);
                });
        },
		methods: {
			send_request_btn(){
				axios.post('/workers/add',{
					worker_id: this.user.id,
					work_title: this.work_title,
					agreement: this.agreement,
					date_range: this.range,
					price: this.price,
					_token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
				}).then((response) => {
					document.getElementById('send_request_btn').innerHTML = 'تم ارسال الطلب ';
					document.getElementById('send_request_btn').style.backgroundColor = 'green';
					document.getElementById('agreement').value = '';
				});
			},
			hasRequest(user){
				var counter = parseInt(document.getElementById('work_notifi').innerText);
                document.getElementById('work_notifi').innerHTML = counter + 1;
			}
		}
	}
</script>
