<template>
  <div v-if="!isEdits">
    <div class="col-12" style="padding:5px 7px 0 7px">
        <div class="button-div bg-white">
          <button type="button" class="btn-regester btn-round" @click="clickEntryBtn()">
            新規投稿する
          </button>
        </div>
    </div>
 
  <div class="column-list-all">
    <div class="header bg-white" style="height:50px">
      <p class="header-sub-txt">すべての記事&nbsp;( {{columns.length}} )</p>
    </div>
   
      <div v-for="(column, index) in columns" :key="column.id">      
       <div class="part">
         <div class="part-left">
             <div class="m-name">
                <button type="button" class="btn-round btn-gray" @click="clickEditBtn(index)">
                  編集
                </button>
                <button type="button" class="btn-round btn-gray" @click="clickDeleteBtn(index)">
                  削除
                </button>
             </div>
           <div class="part-date">
            <p>{{column.updated_at}}</p>
           </div>
           <p class="part-title">{{column.title}}</p>
          
         </div>
         <div class="part-right">
             <img alt="" :src=column.image_file1>
         </div>
       </div>
      </div>
    
  </div>

  </div>

  <div v-else>
  <div class="create-form">
    <form id="form" @submit.prevent="submitForm" method="post">
      <div class="form-div" v-for="(param, key) in form_params" :key="key">
        <label :for="param.name">タイトル</label>
          <FormInput 
            :id="param.id"
            :name="param.name"
            :type="param.type"
            :title="param.title"
            :placeholder="param.placeholder"
            :prepend="param.prepend"
            :errors="param.errors"
            v-model="param.value"
          ></FormInput>
      </div>
      <div class="form-div">
        <FormInput cols="20" rows="5" maxlength="5" v-for="(param, key) in form_params3" :key="key"
          :id="param.id"
          :name="param.name"
          :type="param.type"
          :title="param.title"
          :placeholder="param.placeholder"
          :prepend="param.prepend"
          :errors="param.errors"
          v-model="param.value"
        ></FormInput>
      </div>
<!--
      <div class="form-div">
          <label>#ハッシュタグの設定をする</label>
        <button type="button">設定</button>
      </div>
      <div class="form-div">
          <label class="description">#外壁塗装 </label>
          <label class="description">#防水工事 </label>
      </div>
-->
      <div class="form-div">
          <label>写真の追加</label>
      </div>
      <div class="row">
        <div v-for="(param, key) in image_files" :key="key" class="col-md-4 mb-3">
          <div class="card" @click="onClick(param.name)">
            <div class="card-body d-flex justify-content-center align-items-center mypage-property-image" :style="{ backgroundImage: 'url(' + param.src + ')' }">
              <h5 v-show="!param.src.length" class="card-title">+</h5>
              <input type="file" style="display: none;" accept="image/gif,image/jpeg,image/png" :name="param.name" :ref="param.name" @change="onChange($event, param.name)">
            </div>
          </div>
        </div>
      </div>
      <br>
<!--
      <div class="form-div">
          <label>動画リンク</label>
        <FormInput v-for="(param, key) in form_params4" :key="key"
          
          :id="param.id"
            :name="param.name"
            :type="param.type"
            :title="param.title"
            :placeholder="param.placeholder"
            :prepend="param.prepend"
            :errors="param.errors"
            v-model="param.value"
        ></FormInput>
      </div>
      <br>
-->
      <div class="button-div">
        <button type="submit" class="btn-submit">投稿する</button>
      <br>
      <br>
      <br>
      </div>
    </form>

  </div>

  </div>

  
</template>

<script>
import { Api } from "js/route/painter.js";
import { mapGetters } from 'vuex';
import Slider from "js/components/Slider.vue";
import FormInput from "js/components/form/FormInputGroupText.vue";

export default {
  data() {
    return {
        categorys: [],
        columns: [],
        addcolumns: [],

        //編集表示
        isEdits: false,
        //編集Index
        editindex: 0,

        //非同期で取得中 通常: false, 通信中: true
        itemLoading: false,
        //ロード中の表示
        loading: false,
        //最終データチェック
        isLastPage: false,

        //スクロールカウント
        count: 0,

        //表示数
        limit: 20,

      form_params: {
        title: {
          id: "title",
          name: "title",
          type: "title",
          title: "",
          value: "",
          placeholder: "外壁塗装あれこれ",
          errors: [],
        },
      },

      form_params2: {
        category: {
          id: "category",
          name: "category",
          value: "",
          placeholder: "",
          options: [
                    '塗装施工内容について',
                    '防水工事の施工内容について',
                    'その他工事について',
                    '業者選びについて',
                    'その他',
                   ],
          errors: [],
        },
      },

      form_params3: {
        contents: {
          id: "contents",
          name: "contents",
          type: "textarea",
          title: "",
          value: "",
          placeholder: "内容 (1000文字以内)",
          errors: [],
        },
      },
      form_params4: {
        videourl: {
          id: "videourl",
          name: "videourl",
          type: "videourl",
          title: "",
          value: "",
          placeholder: "YouTube URL",
          errors: [],
        },
      },
      image_files: {
        image_file1: {
          name: "image_file1",
          src: '',
          change: false,
          errors: [],
        },
        image_file2: {
          name: "image_file2",
          src: '',
          change: false,
          errors: [],
        },
        image_file3: {
          name: "image_file3",
          src: '',
          change: false,
          errors: [],
        },
        image_file4: {
          name: "image_file4",
          src: '',
          change: false,
          errors: [],
        },
        image_file5: {
          name: "image_file5",
          src: '',
          change: false,
          errors: [],
        },
        image_file6: {
          name: "image_file6",
          src: '',
          change: false,
          errors: [],
        },
      },
    };
  },
  computed: {
    ...mapGetters('Config', [
      'category',
    ]),
  },
  mounted() {

    this.$store.dispatch('Config/loadSelect').then(() => {
      this.categorys = this.category;
    }).finally(() => {
    });

      this.onSearch();

      
    window.onscroll = () => {
      //一定位置以上スクロールされればtrueを返す
      let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight >= document.documentElement.offsetHeight;

      //trueでデータ取得
      if(bottomOfWindow) {
        //無限スクロールでデータ取得
        this.getSeats();
      }
    }
  },
  watch: {
    form_params3: {
      handler: function(val, oldVal){
        let oldvalue = this.form_params3.contents.value;
        this.form_params3.contents.value = this.charaLimit(val.contents.value);
        if ( oldvalue != this.form_params3.contents.value){
          let reviewTextarea = document.getElementById('contents');
          reviewTextarea.value = this.form_params3.contents.value;
        }
      },
      deep: true
    }
  },
  methods: {
    charaLimit(inputText) {
      return inputText.length > 1000 ? inputText.slice(0, 1000) : inputText;
    },

    clickEntryBtn() {
      axios.get(Api.getcolumnlink).then(response => {
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
  
    clickEditBtn(index) {
      //詳細表示
      this.isEdits = true;
      //詳細Index
      this.editindex = index;
      
      this.setFormParams();
	  scrollTo(0, 0);
    },

    clickDeleteBtn(index) {
      var params = new URLSearchParams()
      params.append("id", this.columns[index].id);

      axios.get(Api.deletecolumn, {params: params }).then(response => {
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

    async onSearch() {

      await axios.get(Api.getcolumn).then(response => {
        this.columns = response.data;

        var i = 0;
        var j = 0;
        for (let k in response.data) {
           i += 1;
           j = 0;
           let sliderimage = [];
            let imagefile1 = {
              img: true,
              src: '',
            };
            let imagefile2 = {
              img: true,
              src: '',
            };
            let imagefile3 = {
              img: true,
              src: '',
            };
            let imagefile4 = {
              img: true,
              src: '',
            };
            let imagefile5 = {
              img: true,
              src: '',
            };
            let imagefile6 = {
              img: true,
              src: '',
            };

            if(response.data[k].image_file1){
              this.$set(imagefile1, 'src', response.data[k].image_file1);
              sliderimage.push(imagefile1);
            }
            if(response.data[k].image_file2){
              this.$set(imagefile2, 'src', response.data[k].image_file2);
              sliderimage.push(imagefile2);
            }
            if(response.data[k].image_file3){
              this.$set(imagefile3, 'src', response.data[k].image_file3);
              sliderimage.push(imagefile3);
            }
            if(response.data[k].image_file4){
              this.$set(imagefile4, 'src', response.data[k].image_file4);
              sliderimage.push(imagefile4);
            }
            if(response.data[k].image_file5){
              this.$set(imagefile5, 'src', response.data[k].image_file5);
              sliderimage.push(imagefile5);
            }
            if(response.data[k].image_file6){
              this.$set(imagefile6, 'src', response.data[k].image_file6);
              sliderimage.push(imagefile6);
            }

           
            this.$set(this.columns[k], 'images', sliderimage);

        }
      }).catch(error => {
        if (error.response) {
          if (error.response.status == 422) {
          }
        }
      });

    },
    async getSeats() {
      if (this.isEdits) return; //編集中は再読み込み防止
      if (this.itemLoading) return; //読込中は再読み込み防止
      if (this.isLastPage) return;  //取得データがもう存在しない場合は行わない

      //読込中 true
      this.itemLoading = true;
      //ロード中の表示
      this.loading = true;

      this.count += this.limit;

      var params = new URLSearchParams()
      params.append("limit", this.limit);
      params.append("skip", this.count);

      await axios.get(Api.getcolumn, {params: params }).then(response => {
            
            if (response.data.length == 0){
                //ローディング非表示
                this.loading = false;
                //読込中 false
                this.itemLoading = false;
                //取得データがもう存在しない
                this.isLastPage = true;  
            }

            this.addcolumns = response.data;

            for (let i in this.addcolumns) {
                let sliderimage = [];
                let imagefile1 = {
                  img: true,
                  src: '',
                  caption: {
                    title: ""
                  }
                };
                let imagefile2 = {
                  img: true,
                  src: '',
                  caption: {
                    title: ""
                  }
                };
                let imagefile3 = {
                  img: true,
                  src: '',
                  caption: {
                    title: ""
                  }
                };
                let imagefile4 = {
                  img: true,
                  src: '',
                  caption: {
                    title: ""
                  }
                };
                let imagefile5 = {
                  img: true,
                  src: '',
                  caption: {
                    title: ""
                  }
                };
                let imagefile6 = {
                  img: true,
                  src: '',
                  caption: {
                    title: ""
                  }
                };
                if(this.addcolumns[i].image_file1){
                  this.$set(imagefile1, 'src', this.addcolumns[i].image_file1);
                  sliderimage.push(imagefile1);
                }
                if(this.addcolumns[i].image_file2){
                  this.$set(imagefile2, 'src', this.addcolumns[i].image_file2);
                  sliderimage.push(imagefile2);
                }
                if(this.addcolumns[i].image_file3){
                  this.$set(imagefile3, 'src', this.addcolumns[i].image_file3);
                  sliderimage.push(imagefile3);
                }
                if(this.addcolumns[i].image_file4){
                  this.$set(imagefile4, 'src', this.addcolumns[i].image_file4);
                  sliderimage.push(imagefile4);
                }
                if(this.addcolumns[i].image_file5){
                  this.$set(imagefile5, 'src', this.addcolumns[i].image_file5);
                  sliderimage.push(imagefile5);
                }
                if(this.addcolumns[i].image_file6){
                  this.$set(imagefile6, 'src', this.addcolumns[i].image_file6);
                  sliderimage.push(imagefile6);
                }

                this.$set(this.addcolumns[i], 'images', sliderimage);
                this.columns.push(this.addcolumns[i]);

            }


            //ローディング非表示
            this.loading = false;
            //読込中 false
            this.itemLoading = false;

            if (response.data.length < this.limit){
                //取得データがもう存在しない
                this.isLastPage = true;  
            }
            
      }).catch(error => {
        if (error.response) {
          if (error.response.status == 422) {
          }
        }

          //ローディング非表示
          this.loading = false;
          //読込中 false
          this.itemLoading = false;
      });

    },

    onClick(name) {
      this.$refs[name][0].click();
    },
    onChange(e, name) {
      const files = e.target.files ? e.target.files : e.dataTransfer.files;

      if (files[0]) {
        this.renderImage(files[0], name);
      }
    },
    renderImage(file, name) {
      const reader = new FileReader();
      reader.onload = (e) => {
        this.image_files[name].src = e.target.result;
        this.image_files[name].change = true;
      };

      reader.readAsDataURL(file);
    },
    submitForm() {
      axios.post(Api.columnupload, this.getFormParams()).then(response => {
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
//      Object.keys(this.form_params2).forEach(key => {
//        params.append(this.form_params2[key].name, this.form_params2[key].value);
//      });
      Object.keys(this.form_params3).forEach(key => {
        params.append(this.form_params3[key].name, this.form_params3[key].value);
      });
      Object.keys(this.image_files).forEach(key => {
        if (this.image_files[key].src?.length) {
          params.append(this.image_files[key].name, this.$refs[this.image_files[key].name][0].files[0]);
        }
      });

      params.append("id", this.columns[this.editindex].id);

      return params;
    },
    setFormParams() {
    
      Object.keys(this.columns[this.editindex]).forEach(key => {
        if (key in this.form_params) {
          const value = Number.isFinite(this.columns[this.editindex][key]) ? String(this.columns[this.editindex][key]) : this.columns[this.editindex][key];
          this.$set(this.form_params[key], 'value', value);
        }
//        if (key in this.form_params2) {
//          const value = Number.isFinite(this.columns[this.editindex][key]) ? String(this.columns[this.editindex][key]) : this.columns[this.editindex][key];
//          this.$set(this.form_params2[key], 'value', value);
//        }
        if (key in this.form_params3) {
          const value = Number.isFinite(this.columns[this.editindex][key]) ? String(this.columns[this.editindex][key]) : this.columns[this.editindex][key];
          this.$set(this.form_params3[key], 'value', value);
        }

        if (key in this.image_files) {
          if (this.columns[this.editindex][key]) {
            this.$set(this.image_files[key], 'src', this.columns[this.editindex][key]);
          }
        }

      });
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
      Object.keys(this.image_files).forEach(key => {
        this.$set(this.image_files[key], 'errors', []);
      });
    },
  },
  components: {
    FormInput,
    Slider,
  },
};
</script>