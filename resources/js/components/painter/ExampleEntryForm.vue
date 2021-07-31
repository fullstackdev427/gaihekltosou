<template>
  <div class="create-form">
    <form id="form" @submit.prevent="submitForm" method="post">
      <div class="form-div" v-for="(param, key) in form_params" :key="key">
        <label :for="param.name">{{param.title}}</label>
          <TextInput 
            :id="param.id"
            :name="param.name"
            :type="param.type"
            :title="param.title"
            :placeholder="param.placeholder"
            :errors="param.errors"
            v-model="param.value"
          ></TextInput>
      </div>

      <div class="form-div">
        <label>工事内容</label>
        <multiselect v-model="selected" tag-placeholder="" placeholder="" label="name" track-by="id" :options="options" :multiple="true" :taggable="true" :searchable="false" :show-labels="false" @input="onSelect"></multiselect>
      </div>

       <div class="form-div" v-for="(param, key) in form_params2" :key="key">
        <label :for="param.name">{{param.title}}</label>
          <SelectInput 
            :id="param.id"
            :name="param.name"
            :options="param.options"
            :errors="param.errors"
            v-model="param.value"
          ></SelectInput>
      </div>

      <div class="form-div guarantee-div">
        <label>保証内容</label>
          <div class="guarantee-area">
            <div class="guarantee-form-div" v-for="(param, key) in form_params3" :key="key">
              <div class="label-area" v-if="param.name=='ohters'">
                <TextInput 
                  :id="param.id"
                  :name="param.name"
                  type="text"
                  :title="param.title"
                  :placeholder="param.title"
                  :errors="param.errors"
                  v-model="param.value2"
                ></TextInput>
              </div>
              <label v-else class="label-area" :for="param.name">{{param.title}}</label>
                <SelectInput 
                  :id="param.id"
                  :name="param.name"
                  :options="param.options"
                  :errors="param.errors"
                  v-model="param.value"
                ></SelectInput>
            </div> 
          </div>
      </div>

      <div class="form-div" v-for="(param, key) in form_params4" :key="key">
        <label :for="param.name">{{param.title}}</label>
          <SelectInput 
            :id="param.id"
            :name="param.name"
            :options="param.options"
            :errors="param.errors"
            v-model="param.value"
          ></SelectInput>
      </div>    
      <div class="form-div">
        <label>完工日</label>
          <select name="year" v-model="year" v-on:change="modify">
            <option v-for="year in getYears()" name="year" :value="year">{{ year }}</option>
          </select>
          <label>年</label>
  
          <select name="month"  v-model="month" v-on:change="modify">
            <option v-for="month in months" name="month" :value="month">{{ month }}</option>
          </select>
          <label>月</label>
      </div>    
      <div class="form-div picture-label">
        <label> 写真の追加</label>     
      </div>
      <div class="row picture-area">
        <div v-for="(param, key) in image_files" :key="key" class="col-md-4 mb-3">
        <label>{{param.title}}</label>
          <div class="card" @click="onClick(param.name)">
            <div class="card-body d-flex justify-content-center align-items-center mypage-property-image" :style="{ backgroundImage: 'url(' + param.src + ')' }">
              <h5 v-show="!param.src.length" class="card-title">+</h5>
              <input type="file" style="display: none;" accept="image/gif,image/jpeg,image/png" :name="param.name" :ref="param.name" @change="onChange($event, param.name)">
            </div>
          </div>
        </div>
      </div>

      <div class="form-div picture-label">
        <label>施工紹介</label>     
      </div>
      <div class="form-div">
        <TextArea cols="20" rows="5" v-for="(param, key) in form_params5" :key="key"
          :id="param.id"
          :name="param.name"
          :type="param.type"
          :title="param.title"
          :placeholder="param.placeholder"
          :errors="param.errors"
          v-model="param.value"
        ></TextArea>
      </div>
      <div class="button-div">
        <button type="submit" class="btn-confirm-edit">登録する</button>
      </div>
    </form>
  </div>
</template>

<script>
import { Api } from "js/route/painter.js";
import { mapGetters } from 'vuex';
import TextInput from "js/components/form/TextInput.vue";
import SelectInput from "js/components/form/SelectInput.vue";
import TextArea from "js/components/form/TextArea.vue";
import Multiselect from 'vue-multiselect';
export default {
 data() {
    return {
      selected: null,
        options: [],
      Warrantys: [],
      months: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
      year: 0,
      month: 0,
        
      form_params: {
        name: {
          id: "name",
          name: "name",
          type: "text",
          title: "案件名",
          value: "",
          placeholder: "戸建 M様",
          errors: [],
        },
        address: {
          id: "address",
          name: "address",
          type: "text",
          title: "場所",
          value: "",
          placeholder: "市区町村までを入力",
          errors: [],
        },
      },
      form_params2:{
        type: {
          id: "type",
          name: "type",
          type: "select",
          title: "建物",
          value: "",
          options: [],
          errors: [],
        },
      },

      form_params3:{
        exterierwall: {
          id: "exterier-wall",
          name: "exterier-wall",
          type: "select",
          title: "外壁塗装",
          value: "",
          options: [],
          errors: [],
        },
        roof: {
          id: "roof",
          name: "roof",
          type: "select",
          title: "屋根塗装",
          value: "",
          options: [],
          errors: [],
        },
        rooftop: {
          id: "roof-top",
          name: "roof-top",
          type: "select",
          title: "屋上防水",
          value: "",
          options: [],
          errors: [],
        },
        veranda: {
          id: "veranda",
          name: "veranda",
          type: "select",
          title: "ベランダ防水",
          value: "",
          options: [],
          errors: [],
        },
        ohters: {
          id: "ohters",
          name: "ohters",
          type: "select",
          title: "その他",
          value: "",
          value2: "",
          options: [],
          errors: [],
        }
      },

      form_params4:{
        amount: {
          id: "amount",
          name: "amount",
          type: "select",
          title: "金額",
          value: "",
          options: [],
          errors: [],
        },
        period: {
          id: "period",
          name: "period",
          type: "select",
          title: "工事期間",
          value: "",
          options: [],
          errors: [],
        },
      },

      form_params5: {
        comment: {
          id: "comment",
          name: "comment",
          type: "text",
          value: "",
          placeholder: "施工紹介コメントを入力",
          errors: [],
        },
      },

      form_params6: {
        category: {
          id: "category",
          name: "category",
          type: "select",
          title: "工事内容",
          value: "",
          options: [],
          errors: [],
        },
      },

      image_files: {
        image_file1: {
          id: "image_file1",
          name: "image_file1",
          title: "施工前",
          description: "",
          src: '',
          errors: [],
        },
        image_file2: {
          id: "image_file2",
          name: "image_file2",
          type: "file",
          title: "外観",
          description: "",
          src: '',
          errors: [],
        },
        image_file3: {
          id: "image_file3",
          name: "image_file3",
          type: "file",
          title: "右側面",
          description: "",
          src: '',
          errors: [],
        },
        image_file4: {
          id: "image_file4",
          name: "image_file4",
          type: "file",
          title: "左側面",
          description: "",
          src: '',
          errors: [],
        },
        image_file5: {
          id: "image_file5",
          name: "image_file5",
          type: "file",
          title: "裏面",
          description: "",
          src: '',
          errors: [],
        },
        image_file6: {
          id: "image_file6",
          name: "image_file6",
          type: "file",
          title: "その他",
          description: "",
          src: '',
          errors: [],
        },
      },

    };
  },

  computed: {
    ...mapGetters('Config', [
      'category',
      'property',
      'Warranty',
      'amount',
      'constructionperiod',
    ]),
  },
  mounted() {
    let today = new Date();
    this.year = today.getFullYear();
    this.month = today.getMonth() + 1;


    this.$store.dispatch('Config/loadSelect').then(() => {
      this.form_params2.type.options = this.property;
      this.form_params3.exterierwall.options = this.Warranty;
      this.form_params3.roof.options = this.Warranty;
      this.form_params3.rooftop.options = this.Warranty;
      this.form_params3.veranda.options = this.Warranty;
      this.form_params3.ohters.options = this.Warranty;
      this.form_params4.amount.options = this.amount;
      this.form_params4.period.options = this.constructionperiod;
      this.Warrantys = this.Warranty;


      this.form_params6.category.options = this.category;
      var i = 0;
      Object.keys(this.form_params6.category.options).forEach(key => {
        this.options.push({ id: i, name: this.form_params6.category.options[key] })
        i += 1;
      });
      

    }).finally(() => {
      if (this.property_id != null) {
        this.setFormParams(this.findProperty(this.property_id));
      }
    });
  },

  methods: {
    onSelect() {
    },

    getYears() {
      let today = new Date();
      let goBackYears = 10;
      let currentYear = today.getFullYear();
      let startYear = currentYear - goBackYears;
      return [...Array(goBackYears + 1).keys()].map(x => x + startYear);
    },

    onClick(name) {
      this.$refs[name][0].click();
    },
    onChange(e, name) {
      const files = e.target.files ? e.target.files : e.dataTransfer.files;
      console.log(name)
      if (files[0]) {
        this.renderImage(files[0], name);
      }
    },
    renderImage(file, name) {
      const reader = new FileReader();
      reader.onload = (e) => {
        this.image_files[name].src = e.target.result;
      };

      reader.readAsDataURL(file);
    },
    submitForm() {
      axios.post(Api.exampleentry, this.getFormParams()).then(response => {
        location.href = response.data.next;
      }).catch(error => {
        if (error.response) {
          if (error.response.status == 422) {
            this.setParamErrors(error.response.data);
          } else if (error.response.status == 401) {
            this.setParamErrors(error.response.data);
          }
        }
      });
    },
    getFormParams() {
      const params = new FormData();
      Object.keys(this.form_params).forEach(key => {
        params.append(this.form_params[key].name, this.form_params[key].value);
      });
      Object.keys(this.form_params2).forEach(key => {
        params.append(this.form_params2[key].name, this.form_params2[key].value);
      });
      var val = "";
      Object.keys(this.form_params3).forEach(key => {
        if (this.form_params3[key].name == "ohters"){
          if (this.form_params3[key].value) {
            if (this.form_params3[key].value != 0) {
              if (this.form_params3[key].value2) {
                params.append("warranty_title", this.form_params3[key].value2);
                val = val + this.form_params3[key].value2 + this.Warrantys[this.form_params3[key].value] + " ";
              }
            }
          }
        } else {
          if (this.form_params3[key].value) {
            if (this.form_params3[key].value != 0) {
              val = val + this.form_params3[key].title + this.Warrantys[this.form_params3[key].value] + " ";
            }
          }
        }
      });
      params.append("warranty", val);

      Object.keys(this.form_params4).forEach(key => {
        params.append(this.form_params4[key].name, this.form_params4[key].value);
      });
      Object.keys(this.form_params5).forEach(key => {
        params.append(this.form_params5[key].name, this.form_params5[key].value);
      });
      var str = "";
      Object.keys(this.selected).forEach(key => {
        str = str + this.selected[key].name + " ";
      });
      params.append("category", str);

      var ym = "";
      ym = ym + this.year + "/";
      ym = ym + this.month + "/1";
      params.append("complete_date", ym);

      Object.keys(this.image_files).forEach(key => {
        if (this.image_files[key].src?.length) {
          params.append(this.image_files[key].name, this.$refs[this.image_files[key].name][0].files[0]);
        }
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
          else if (key in this.form_params2) {
            this.$set(this.form_params2[key], 'errors', responseData.errors[key]);
          }
          else if (key in this.form_params3) {
            this.$set(this.form_params3[key], 'errors', responseData.errors[key]);
          }
          else if (key in this.form_params4) {
            this.$set(this.form_params4[key], 'errors', responseData.errors[key]);
          }
          else if (key in this.form_params5) {
            this.$set(this.form_params5[key], 'errors', responseData.errors[key]);
          }
          else if (key in this.form_params6) {
            this.$set(this.form_params6[key], 'errors', responseData.errors[key]);
          }
          else if (key in this.image_files) {
            this.$set(this.image_files[key], 'errors', responseData.errors[key]);
          }
        });
      }
    },
    resetErrors() {
      Object.keys(this.form_params).forEach(key => {
        this.$set(this.form_params[key], 'errors', []);
      });
      Object.keys(this.form_params2).forEach(key => {
        this.$set(this.form_params2[key], 'errors', []);
      });
      Object.keys(this.form_params3).forEach(key => {
        this.$set(this.form_params3[key], 'errors', []);
      });
      Object.keys(this.form_params4).forEach(key => {
        this.$set(this.form_params4[key], 'errors', []);
      });
      Object.keys(this.form_params5).forEach(key => {
        this.$set(this.form_params5[key], 'errors', []);
      });
      Object.keys(this.form_params6).forEach(key => {
        this.$set(this.form_params6[key], 'errors', []);
      });
      Object.keys(this.image_files).forEach(key => {
        this.$set(this.image_files[key], 'errors', []);
      });
    },
  },
  components: {
    TextInput,
    SelectInput,
    TextArea,
    Multiselect,

  },
};
</script>