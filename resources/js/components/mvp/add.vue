<template>
    <div>
      <div class="w3-right-align">
          <div>
              <h4 class="w3-margin-top text-right w3-margin-bottom"> اضافة مشروع جديد  </h4> <br>
          </div>
          <div class="row" >
              <div class="col-md-6">
                  <div class="form-group">
                    <label>اسم المشروع</label>
                    <validation-provider name="name" rules="required|max:25" v-slot="{ errors }">
                        <input class="form-control w3-border w3-margin-bottom w3-right-align" type="text" name="name" v-model="name">
                        <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
                          {{ errors[0] }}
                        </span>
                    </validation-provider>
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label>نوع المشروع</label>
                    <select class="form-control w3-border w3-margin-bottom w3-right-align" name="type"v-model="type">
                        <option v-for="type in mvp_types" :value="type.slug"> {{ type.name }}  </option>
                    </select>
                </div>
              </div>
              <div class="col-md-12">
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
              <div class="col-md-6">
                <div class="form-group">
                    <validation-provider name="mvp_link" rules="required" v-slot="{ errors }">
                            <label> رابط المشروع  </label>
                            <input class="form-control w3-border w3-margin-bottom w3-right-align" type="text"  name="mvp_link">
                        <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
                            {{ errors[0] }}
                        </span>
                    </validation-provider>
                </div>
              </div>
              <div class="col-md-6">
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
              <div class="col-md-12">
                <div class="form-group">
                    <label> الادوات المستخدمة في التطوير </label>
                    <validation-provider name="dev_tools" rules="required" v-slot="{ errors }">
                        <textarea rows="8" class="form-control w3-border w3-margin-bottom w3-right-align" name="dev_tools" v-model="dev_tools" ></textarea>
                        <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
                            {{ errors[0] }}
                        </span>
                    </validation-provider>
                </div>
                <button id="add_file" class="w3-button w3-black w3-hover-black w3-section w3-padding w3-right w3-hover-black" type="submit">اضف المشروع</button>
            </div>
          </div>
      </div>

    </div>
</template>


<script>
    import { ValidationProvider } from 'vee-validate';

	export default {
        components: {
            ValidationProvider
        },
        props: {
            mvp_types: {
              type: Array,
              required: true
            },
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
        client_id
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
