<template>
	<div>
		<button :id="`accept_btn_${user_id}`" @click="accept_btn()" class="btn btn-success w3-round" style="padding: 7px 15px">
			<i class="fa fa-check w3-margin-left-8"></i> موافقة
		</button>
		<button :id="`delete_btn_${user_id}`" @click="delete_btn()"  class="btn btn-danger w3-round" style="padding: 7px 15px;">
			<i class="fa fa-close"></i> حذف
		</button>
	</div>
</template>

<script>
	export default{
		props: {
			user_id : {
				required: true,
			}
		},
		data(){
			return {

			}
		},
		methods: {
			accept_btn(){
				axios.get('/workers/accept/'+ this.user_id,{

				}).then((response) => {
					document.getElementById('accept_btn_' + this.user_id).innerHTML = 'تم قبول الطلب';
					document.getElementById('accept_btn_' + this.user_id).style.backgroundColor = 'green';

					var counter = parseInt(document.getElementById('work_notifi').innerText);
	                document.getElementById('work_notifi').innerHTML = counter - 1;
				});
			},
			delete_btn(){
				axios.post('/workers/delete/'+ this.user_id,{

				}).then((response) => {
					document.getElementById('delete_btn_' + this.user_id).innerHTML = ' تم حذف الطلب ';
					document.getElementById('delete_btn_' + this.user_id).style.backgroundColor = 'green';

					var counter = parseInt(document.getElementById('work_notifi').innerText);
	                document.getElementById('work_notifi').innerHTML = counter - 1;
				});
			}
		}
	}
</script>
