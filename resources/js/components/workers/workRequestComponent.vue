<template>
	<div>
        <button @click="send_request_btn()" id="send_request_btn" class="btn btn-primary w3-margin">ارسال طلب عمل</button>
	</div>
</template> 

<script>
	export default{
		props: {
			user : {
				type: Object,
				required: true,
			} 
		}, 
		data(){
			return { 

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
				axios.get('/workers/add/'+ this.user.id,{

				}).then((response) => {
					document.getElementById('send_request_btn').innerHTML = 'تم ارسال الطلب ';
					document.getElementById('send_request_btn').style.backgroundColor = 'green';
				});
			},
			hasRequest(user){
				var counter = parseInt(document.getElementById('work_notifi').innerText);
                document.getElementById('work_notifi').innerHTML = counter + 1;
			}
		}
	}
</script>