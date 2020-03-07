<template>
	<div>
		<button :id="`accept_btn_${user_id}`" @click="accept_btn()" class="btn btn-primary">قبول طلب العمل</button>
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
			}
		}
	}
</script>
