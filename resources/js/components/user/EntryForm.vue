<template>
  <div>
    <form @submit.prevent="submitForm">
      <FormInput v-for="(param, key) in form_params" :key="key"
        :id="param.id"
        :name="param.name"
        :type="param.type"
        :title="param.title"
        :placeholder="param.placeholder"
        :label_description="param.label_description"
        :errors="param.errors"
        v-model="param.value"
      ></FormInput>
      <button type="submit" class="btn-send mt-5">登録</button>
    </form>
  </div>
</template>

<script>
import { Api } from "js/route/user.js";
import FormInput from "js/components/form/FormInput.vue";

export default {
  data() {
    return {
      form_params: {
        name1: {
          id: "name1",
          name: "name1",
          type: "text",
          title: "お名前（姓）",
          value: "",
          placeholder: "姓",
          errors: [],
        },
        name2: {
          id: "name2",
          name: "name2",
          type: "text",
          title: "お名前（名）",
          value: "",
          placeholder: "名",
          errors: [],
        },
        email: {
          id: "email",
          name: "email",
          type: "email",
          title: "メールアドレス",
          value: "",
          placeholder: "",
          errors: [],
        },
        password: {
          id: "password",
          name: "password",
          type: "password",
          title: "パスワード",
          value: "",
          placeholder: "",
          label_description: "※8〜12の英数字で入力してください",
          errors: [],
        },
        password_confirmation: {
          id: "password_confirmation",
          name: "password_confirmation",
          type: "password",
          title: "パスワード（確認用）",
          value: "",
          placeholder: "",
          label_description: "※コビーをせず入力してください",
          errors: [],
        },
      },
    };
  },
  methods: {
    submitForm() {
      axios.post(Api.entry, this.getFormParams()).then(response => {
        location.href = response.data.next;
      }).catch(error => {
        if (error.response) {
          if (error.response.status == 422) {
            this.setParamErrors(error.response.data);
          }
        }
      });
    },
    getFormParams() {
      const params = new URLSearchParams();
      Object.keys(this.form_params).forEach(key => {
        params.append(this.form_params[key].name, this.form_params[key].value);
      });

      return params;
    },
    setParamErrors(responseData) {
      if (responseData.errors) {
        this.resetErrors();
        Object.keys(responseData.errors).forEach(key => {
          if (key in this.form_params) {
            this.$set(this.form_params[key], 'errors', responseData.errors[key]);
          }
        });
      }
    },
    resetErrors() {
      Object.keys(this.form_params).forEach(key => {
        this.$set(this.form_params[key], 'errors', []);
      });
    },
  },
  components: {
    FormInput,
  },
};
</script>