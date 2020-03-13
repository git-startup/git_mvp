<template>
	<!-- status section -->
      <!-- To Output Users Status -->

      <div>
	      <div  v-for="status in statuses" :key="status.id" class="row">
	        <div class="col-lg-3">
	          <div class="card-body bg-white w3-margin">
	           <a :href="`/profile/${ status.user.username }`"> <p class="w3-text-blue">{{ status.user.name }}</p>
	           <img v-if="status" :src="status.user.image" class="w3-circle" height="55" width="55" alt="user avatar">
	            </a>
	          </div>
	        </div>

	        <div class="col-lg-9">

	          <div class="card-body bg-white w3-margin-top">
	            <span class="w3-left w3-opacity"> {{ moment(status.created_at).fromNow() }}  </span>
	            <span class="fa fa-comment custom-color w3-right" @click="comment_section( status.id )" id="social_send_message"></span>
	            <br>
	            <p dir="auto" class="w3-right-align user_text">{{ status.body }}</p>

	            <a href="javascript:void(0)" @click="like( status.id )" class="w3-left w3-text-blue"><span class="fa fa-thumbs-o-up"></span> Like </a>

	            <span :id="`likes-${ status.id }`" class="badge badge-default btn w3-right" style="display: block;">
	            	{{ status.likes }} Likes
	            </span>

	            <!-- comments section -->
	            <div :id="`commentfor-${status.id}`" class="comments-wrap" style="display: none;">
	            	<div v-for="comment in status.comments" id="comment-box" :key="comment.id" class="w3-light-grey w3-padding">
		            	<div class="w3-right">
		                    <a :href="`/profile/${ comment.user.username }`">
		                        <img :src="comment.user.image" id="comment_userImage" :value="comment.user.image" class="w3-circle" height="55" width="55" :alt="comment.user.name">
		                        <p class="w3-text-blue" id="comment_userName">{{ comment.user.name}}</p>
		                    </a>
		                </div>
	                    <div class="w3-clear">
	                        <p dir="auto" class="w3-right-align user_text">{{ comment.content }}</p>
	                        <ul class="list-inline">
	                            <li>{{ comment.created_at }}</li>
	                        </ul>
	                    </div>
	                </div>
                    <br>
	                <div class="bg-white post_comment">
	                  <form action="/social" method="post" @submit.prevent>
	                  	<validation-provider rules="required" v-slot="{ errors }">
		                    <textarea dir="auto" class="form-control w3-right-align w3-margin-bottom" placeholder="اترك تعليق " :name="comment" v-model="comment" id="comment"></textarea>
		                    <span>{{ errors[0] }}</span>
						 </validation-provider>
	                    <input type="hidden" name="to"  :value="status.user_id" />

	                    <input type="hidden" name="_token" :value="csrf">

	                    <input  type="submit" name="btn_comment" class='btn custom-bg w3-right w3-margin-bottom' value="نشر " @click="post_comment( status.id, status.user_id )">
	                  </form>
	                </div>
	            </div>

                <br>
	            <div :id="`message_success-${status.id}`" class="alert alert-success" style="display: none;">تم ارسال الرسالة بنجاح</div>

	            <div :id="`message_error-${status.id}`" class="alert alert-danger" style="display: none;">
	            	لا يمكنك ارسال رسالة لنفسك
	            </div>

	          </div>

	        </div>
	      </div>
	      <br>
	    <!-- To Output admin posts -->

	    <br>
 	</div>
</template>

<script>

	var moment = require('moment');

	export default {
		props: {
			statuses: {
				type: Array,
				required: true
			},
            likes: {
                type: Number,
            }
        },
		data() {
			return {
				moment: moment,
				likes: '',
				comment: '',
				csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
			}
		},
		methods: {
			pushComment(){
				var comment_div = document.getElementById('comment-box');
				var userName = document.getElementById('comment_userName');
				var userImage = document.getElementById('comment_userImage').getAttribute('value');
				var commentText = document.getElementById('comment');

			    let newComment = document.createElement('div');
			    newComment.classList.add('comment');
			    newComment.innerHTML = `
			    	<div class="w3-right">
		                <img src="${userImage}" class="w3-circle" height="55" width="55" alt="${userName.innerHTML}">
		                <p class="w3-text-blue" id="comment_userName">${userName.innerHTML}</p>
		            </div>
		            <div class="w3-clear">
                        <p class="w3-right-align user_text">${commentText.value}</p>
                    </div>
                    `;
			    comment_div.parentElement.appendChild(newComment);
			        userName.value = '';
			        commentText.value = '';
			},
			post_comment(status_id,user_id){
				axios.post('/status/'+status_id+'/comment',{
					content: this.comment,
					status_id: status_id,
					user_id: user_id,
					_token: this.csrf
				}).then((response) => {
					this.comment = '';
					this.pushComment();
                    //document.getElementById('comment').value = '';
				});
			},
			like(status_id){
				axios.get('/status/' + status_id + '/like',{

				}).then((response) => {
					this.likes = response.data;
					if(response.data > 0){
						document.getElementById('likes-' + status_id ).innerHTML = response.data + ' Likes';
					}
				});
			},
			comment_section(statusId){
		      var commentSection = document.getElementById("commentfor-" + statusId);
		      if (commentSection.style.display === 'block') {
		          commentSection.style.display = 'none';
		      } else {
		          commentSection.style.display = 'block';
		      }
		    }
		},
		mounted() {
		}

	}
</script>


<style>


</style>
