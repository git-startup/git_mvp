<template>
	<div>
		<button id="accept_btn" @click="accept_btn()" class="btn btn-primary">قبول طلب العمل</button>
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
					document.getElementById('accept_btn').innerHTML = 'تم قبول الطلب';
					document.getElementById('accept_btn').style.backgroundColor = 'green';
				});
			}
		}
	}
</script>