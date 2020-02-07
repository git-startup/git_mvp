<template>
    <div>
        <form action="/mvp/add" method="post" enctype="multipart/form-data">
            <div class="w3-right-align">
                <div>
                    <h4 class="w3-margin-top w3-margin-bottom">ابدأ مشروعك معنا الان</h4> <hr>
                </div>
                <div class="add_project_Slides">

                    <div class="form-group">
                        <label>اسم المشروع</label>
                        <validation-provider name="name" rules="required|max:25" v-slot="{ errors }">
                            <input class="form-control w3-border w3-margin-bottom w3-right-align" type="text" name="name" v-model="name">
                            <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
                              {{ errors[0] }} 
                            </span>
                        </validation-provider>
                    </div>
                    <div class="form-group">
                        <label>نوع المشروع</label>
                        <select class="form-control w3-border w3-margin-bottom w3-right-align" name="type"v-model="type">
                            <option value="web">موقع الكتروني </option>
                            <option value="app">تطبيق هاتف </option>
                            <option value="system">نظام</option>
                            <option value="design">تصميم</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label> وصف عام عن المشروع  </label>
                        <validation-provider name="description" rules="required|max:250|min:50" v-slot="{ errors }">
                            <textarea rows="8" class="form-control w3-border w3-right-align" name="description" v-model="description"></textarea>
                            <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
                                {{ errors[0] }} 
                            </span>
                        </validation-provider>
                    </div>
                </div>
                    
                <hr>
                <div class="add_project_Slides">
                    <div class="form-group">
                        <validation-provider name="image_one" rules="required" v-slot="{ errors }">
                            <div class="upload-btn-wrapper">
                                <button class="btn"> صورة للمشروع   </button>
                                <input class="form-control w3-border w3-margin-bottom w3-right-align" type="file"  name="image_one">
                            </div>
                            <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
                                {{ errors[0] }} 
                            </span>
                        </validation-provider>
                    </div>
                    <div class="form-group">
                        <validation-provider name="image_two" v-slot="{ errors }">
                            <div class="upload-btn-wrapper">
                                <button class="btn"> صورة ثانية للمشروع - اختياري  </button>
                                <input class="form-control w3-border w3-margin-bottom w3-right-align" type="file"  name="image_two">
                            </div>
                            <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
                                {{ errors[0] }} 
                            </span>
                        </validation-provider>
                    </div>
                    <div class="form-group">
                        <validation-provider name="image_three" v-slot="{ errors }">
                            <div class="upload-btn-wrapper">
                                <button class="btn"> صورة ثالثة للمشروع - اختياري  </button>
                                <input class="form-control w3-border w3-margin-bottom w3-right-align" type="file"  name="image_three">
                            </div>
                            <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
                                {{ errors[0] }} 
                            </span>
                        </validation-provider>
                    </div>
                    <div class="form-group">
                        <validation-provider name="how_to_use_file" rules="required" v-slot="{ errors }">
                            <div class="upload-btn-wrapper">
                                <button class="btn"> ملف يحوي طريقة الاستحدام  </button>
                                <input class="form-control w3-border w3-margin-bottom w3-right-align" type="file"  name="how_to_use_file">
                            </div>
                            <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
                                {{ errors[0] }} 
                            </span>
                        </validation-provider>
                    </div>
                    <div class="form-group">
                        <validation-provider name="mvp_file" rules="required" v-slot="{ errors }">
                            <div class="upload-btn-wrapper">
                                <button class="btn">ملف المشروع </button>
                                <input class="form-control w3-border w3-margin-bottom w3-right-align" type="file"  name="mvp_file">
                            </div>
                            <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
                                {{ errors[0] }} 
                            </span>
                        </validation-provider>
                    </div>
                    <div class="form-group">
                        <label>  سعر التحميل بالدولار  </label>
                        <validation-provider name="price" rules="required" v-slot="{ errors }">
                            <input class="form-control w3-border w3-margin-bottom w3-right-align" type="number"  name="price">
                            <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
                                {{ errors[0] }} 
                            </span>
                        </validation-provider>
                    </div>
                    <div class="form-group">
                        <label> اسم فريد للمشروع </label>
                        <validation-provider name="slug" rules="required" v-slot="{ errors }">
                            <input class="form-control w3-border w3-margin-bottom w3-right-align" type="text"  name="slug" v-model="slug">
                            <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
                                {{ errors[0] }} 
                            </span>
                        </validation-provider>
                    </div>
                </div>

                <div class="add_project_Slides">
                    <div class="form-group">
                        <label> الادوات المستخدمة في التطوير </label>
                        <validation-provider name="dev_tools" rules="required" v-slot="{ errors }">
                            <textarea rows="8" class="form-control w3-border w3-margin-bottom w3-right-align" name="dev_tools" v-model="dev_tools" ></textarea>
                            <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
                                {{ errors[0] }} 
                            </span>
                        </validation-provider>
                    </div>
                    <input type="hidden" name="_token" :value="csrf">
                    <button class="w3-button custom-bg w3-hover-black w3-section w3-padding w3-right w3-hover-black" type="submit">اضف المشروع</button>
                </div>

            </div>
        </form>
    </div>
</template>


<script>
    import { ValidationProvider } from 'vee-validate';

	export default {
        components: {
            ValidationProvider
        },
        props: {
            user: {
                type: Object,
                required: true
            }
        },
		data() {
			return {
                name: '',
                type: '',
                description: '',
                image: '',
                slug: '',
                dev_tools: '',
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
			}
        },

	}
</script>


<style scoped>
  .error{
    position: relative;
    top: 20px;
  }
  .upload-btn-wrapper {
      position: relative;
      overflow: hidden;
      display: inline-block;
    }

    .btn {
      border: 2px solid gray;
      color: gray;
      background-color: white;
      padding: 8px 20px;
      border-radius: 8px;
      font-size: 20px;
      font-weight: bold;
      margin-top: 15px;
    }

    .upload-btn-wrapper input[type=file] {
      font-size: 100px;
      position: absolute;
      left: 0;
      top: 0;
      opacity: 0;
    }
</style>