<template>
  <div class="construction-list" v-if="!isEdits">
  <div class="col-12" style="padding:5px 7px 0 7px">
      <div class="button-div bg-dark">
        <button type="button" class="btn-regester btn-round" @click="clickEntryBtn()">
          サイト外案件登録
        </button>
      </div>
  </div>
  <div class="col-12" style="padding:0px 7px 0 7px"  v-for="(example, index) in examples" :key="example.id">
    <div class="header">
      <div class="header-img">
        <img src="/image/home01-icon.png" alt="">
      </div>
      <div class="header-body">
        <p class="header-date">{{ example.complete_date }}</p>
        <div class="header-txt">
          <div>
            <p>{{ getyymmdd(example.updated_at) }}</p>            
          </div>
          <div class="m-name">
            <p >{{ example.name }}</p>
            <button type="button" class="btn-round" @click="clickEditBtn(index)">
              編集
            </button>
            <button type="button" class="btn-round" @click="clickDeleteBtn(index)">
              削除
            </button>
          </div>
        </div>
      </div>
    </div>
    <Slider :items="example.images"/>
    <div class="main">      
      <div class="main-img-back">
        <div class="main-img">
          <img alt="" :src=example.image_file1>
        </div>
      </div>
      <div class="main-img-txt">
        施工前
      </div>
      <div class="part">
        <div class="part-left">
          場&nbsp;&nbsp;所
        </div>
        <div class="part-right">
          {{ example.address }}
        </div>
      </div>
      <div class="part">
        <div class="part-left">
          工事内容
        </div>
        <div class="part-right">
          {{ example.category }}
        </div>
      </div>
      <div class="part">
        <div class="part-left">
          期&nbsp;&nbsp;間
        </div>
        <div class="part-right">
          {{ periods[example.period] }}
        </div>
      </div>
      <div class="part">
        <div class="part-left">
          保&nbsp;&nbsp;証
        </div>
        <div class="part-right">
          <p>{{ example.warranty }}</p>
        </div>
      </div>
      <div class="part">
        <div class="part-txt" style="white-space: pre-line;">
          {{ example.comment }}
        </div>
      </div>
    </div>
  </div>


  </div>

  <div class="example-entry" v-else>
    <div class="example-detail">
        <div class="building">
          <div class="building-img">
              <img alt="" :src=examples[editindex].image_file1>
          </div>
          <div class="building-text">
              {{ examples[editindex].name }}
          </div>
        </div>
        <div class="input-field d-flex">
          <div class="input-private">
              非公開
          </div>
          <div class="input-part">
            <div class="input-group d-flex">
                <div class="input-title">
                    住所
                </div>
                <div class="input-text">
                    {{ examples[editindex].address }}
                </div>
            </div>
<!--
            <div class="input-group d-flex">
                <div class="input-title">
                    TEL1
                </div>
                <div class="input-text">
                    {{ examples[editindex].address }}
                    052-304-9313
                </div>
            </div>
            <div class="input-group d-flex">
                <div class="input-title">
                    {{ examples[editindex].address }}
                    TEL2
                </div>
                <div class="input-text">
                    0120-168-323
                </div>
            </div>
            <div class="input-group d-flex">
                <div class="input-title">
                    Mail
                </div>
                <div class="input-text">
                    1234@gorokunanahachl.jp
                </div>
            </div>
            <div class="input-group d-flex">
                <div class="input-title">
                    完工日
                </div>
                <div class="input-text">
                    {{ examples[editindex].complete_date }}
                </div>
            </div>
-->
            <div class="input-group d-flex">
                <div class="input-title">
                    金額
                </div>
                <div class="input-text">
                    {{ examples[editindex].contract_amount }}
                </div>
            </div>
            <div class="input-group d-flex">
                <div class="input-title">
                    敷地面積
                </div>
                <div class="input-text">
                    {{ examples[editindex].area }}
                </div>
            </div>
            <div class="input-group d-flex">
                <div class="input-title">
                    建坪
                </div>
                <div class="input-text">
                    {{ examples[editindex].area_b }}
                </div>
            </div>
            <div class="input-group d-flex">
                <div class="input-title">
                    外壁の種類
                </div>
                <div class="input-text">
                    {{ Walls[examples[editindex].type_wall] }}
                </div>
            </div>
            <div class="input-group d-flex">
                <div class="input-title">
                    屋根の種類
                </div>
                <div class="input-text">
                    {{ Roofs[examples[editindex].type_roof] }}
                </div>
            </div>
          </div>
        </div>
    </div>
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

  </div>

  
</template>

<script>
import { Api } from "js/route/painter.js";
import { mapGetters } from 'vuex';
import Slider from "js/components/Slider.vue";
import TextInput from "js/components/form/TextInput.vue";
import SelectInput from "js/components/form/SelectInput.vue";
import TextArea from "js/components/form/TextArea.vue";
import Multiselect from 'vue-multiselect';

export default {
  data() {
    return {
        name:"お客様と記念に",
         
        categorys: [],
        periods: [],
        examples: [],
        addexamples: [],

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

      selected: null,
        options: [],
      Warrantys: [],
      Walls: [],
      Roofs: [],
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
          change: false,
          errors: [],
        },
        image_file2: {
          id: "image_file2",
          name: "image_file2",
          type: "file",
          title: "外観",
          description: "",
          src: '',
          change: false,
          errors: [],
        },
        image_file3: {
          id: "image_file3",
          name: "image_file3",
          type: "file",
          title: "右側面",
          description: "",
          src: '',
          change: false,
          errors: [],
        },
        image_file4: {
          id: "image_file4",
          name: "image_file4",
          type: "file",
          title: "左側面",
          description: "",
          src: '',
          change: false,
          errors: [],
        },
        image_file5: {
          id: "image_file5",
          name: "image_file5",
          type: "file",
          title: "裏面",
          description: "",
          src: '',
          change: false,
          errors: [],
        },
        image_file6: {
          id: "image_file6",
          name: "image_file6",
          type: "file",
          title: "その他",
          description: "",
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
      'constructionperiod',
      'property',
      'Warranty',
      'amount',
      'roof',
      'wall',
    ]),
  },
  mounted() {
    let today = new Date();
    this.year = today.getFullYear();
    this.month = today.getMonth() + 1;

    this.$store.dispatch('Config/loadSelect').then(() => {
      this.categorys = this.category;
      this.periods = this.constructionperiod;

      this.form_params2.type.options = this.property;
      this.form_params3.exterierwall.options = this.Warranty;
      this.form_params3.roof.options = this.Warranty;
      this.form_params3.rooftop.options = this.Warranty;
      this.form_params3.veranda.options = this.Warranty;
      this.form_params3.ohters.options = this.Warranty;
      this.form_params4.amount.options = this.amount;
      this.form_params4.period.options = this.constructionperiod;
      this.Warrantys = this.Warranty;
      this.Roofs = this.roof;
      this.Walls = this.wall;

      this.form_params6.category.options = this.category;
      var i = 0;
      Object.keys(this.form_params6.category.options).forEach(key => {
        this.options.push({ id: i, name: this.form_params6.category.options[key] })
        i += 1;
      });

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
  methods: {
    getYears() {
      let today = new Date();
      let goBackYears = 10;
      let currentYear = today.getFullYear();
      let startYear = currentYear - goBackYears;
      return [...Array(goBackYears + 1).keys()].map(x => x + startYear);
    },

    clickEntryBtn() {
      axios.get(Api.getexampleentrylink).then(response => {
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
      params.append("id", this.examples[index].id);

      axios.get(Api.deleteexample, {params: params }).then(response => {
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
      await axios.get(Api.examplelist).then(response => {
            this.examples = response.data;
            for (let i in this.examples) {
      
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
                if(this.examples[i].image_file1){
                  this.$set(imagefile1, 'src', this.examples[i].image_file1);
                  sliderimage.push(imagefile1);
                }
                if(this.examples[i].image_file2){
                  this.$set(imagefile2, 'src', this.examples[i].image_file2);
                  sliderimage.push(imagefile2);
                }
                if(this.examples[i].image_file3){
                  this.$set(imagefile3, 'src', this.examples[i].image_file3);
                  sliderimage.push(imagefile3);
                }
                if(this.examples[i].image_file4){
                  this.$set(imagefile4, 'src', this.examples[i].image_file4);
                  sliderimage.push(imagefile4);
                }
                if(this.examples[i].image_file5){
                  this.$set(imagefile5, 'src', this.examples[i].image_file5);
                  sliderimage.push(imagefile5);
                }
                if(this.examples[i].image_file6){
                  this.$set(imagefile6, 'src', this.examples[i].image_file6);
                  sliderimage.push(imagefile6);
                }

                this.$set(this.examples[i], 'images', sliderimage);
            }

            this.count = 0;
            //最終データチェック
            this.isLastPage = false;
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

      await axios.get(Api.examplelist, {params: params }).then(response => {
            
            if (response.data.length == 0){
                //ローディング非表示
                this.loading = false;
                //読込中 false
                this.itemLoading = false;
                //取得データがもう存在しない
                this.isLastPage = true;  
            }

            this.addexamples = response.data;


//            for (var i in response.data) {
//                this.examples.push(response.data[i]);
//            }
            for (let i in this.addexamples) {
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
                if(this.addexamples[i].image_file1){
                  this.$set(imagefile1, 'src', this.addexamples[i].image_file1);
                  sliderimage.push(imagefile1);
                }
                if(this.addexamples[i].image_file2){
                  this.$set(imagefile2, 'src', this.addexamples[i].image_file2);
                  sliderimage.push(imagefile2);
                }
                if(this.addexamples[i].image_file3){
                  this.$set(imagefile3, 'src', this.addexamples[i].image_file3);
                  sliderimage.push(imagefile3);
                }
                if(this.addexamples[i].image_file4){
                  this.$set(imagefile4, 'src', this.addexamples[i].image_file4);
                  sliderimage.push(imagefile4);
                }
                if(this.addexamples[i].image_file5){
                  this.$set(imagefile5, 'src', this.addexamples[i].image_file5);
                  sliderimage.push(imagefile5);
                }
                if(this.addexamples[i].image_file6){
                  this.$set(imagefile6, 'src', this.addexamples[i].image_file6);
                  sliderimage.push(imagefile6);
                }

                this.$set(this.addexamples[i], 'images', sliderimage);
                this.examples.push(this.addexamples[i]);

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
    getyymmdd(str) {
      var ret = str;
      
      return ret.substring(0, 10);
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
        this.image_files[name].change = true;
      };

      reader.readAsDataURL(file);
    },
    submitForm() {
      axios.post(Api.exampleupload, this.getFormParams()).then(response => {
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
//        if (this.image_files[key].src?.length) {
        if (this.image_files[key].change) {
          params.append(this.image_files[key].name, this.$refs[this.image_files[key].name][0].files[0]);
        }
      });

      params.append("id", this.examples[this.editindex].id);

      return params;
    },
    onSelect() {
    },
    setFormParams() {
    
      Object.keys(this.examples[this.editindex]).forEach(key => {
        if (key in this.form_params) {
          const value = Number.isFinite(this.examples[this.editindex][key]) ? String(this.examples[this.editindex][key]) : this.examples[this.editindex][key];
          this.$set(this.form_params[key], 'value', value);
        }
        if (key in this.form_params2) {
          const value = Number.isFinite(this.examples[this.editindex][key]) ? String(this.examples[this.editindex][key]) : this.examples[this.editindex][key];
          this.$set(this.form_params2[key], 'value', value);
        }
        if (key in this.form_params4) {
          const value = Number.isFinite(this.examples[this.editindex][key]) ? String(this.examples[this.editindex][key]) : this.examples[this.editindex][key];
          this.$set(this.form_params4[key], 'value', value);
        }
        if (key in this.form_params5) {
          const value = Number.isFinite(this.examples[this.editindex][key]) ? String(this.examples[this.editindex][key]) : this.examples[this.editindex][key];
          this.$set(this.form_params5[key], 'value', value);
        }

        if (key in this.image_files) {
          if (this.examples[this.editindex][key]) {
            this.$set(this.image_files[key], 'src', this.examples[this.editindex][key]);
          }
        }

        // その他タイトル設定
        if (key == "warranty_title") {
          this.$set(this.form_params3.ohters, 'value2', this.examples[this.editindex].warranty_title);
        }

        if (key == "warranty") {
          let value = [];
          value = this.examples[this.editindex].warranty.split(" ");

            for (let i in value) {
              let str = value[i];


              Object.keys(this.form_params3).forEach(key2 => {
                if (this.form_params3[key2].name == "ohters"){
                  if (this.examples[this.editindex].warranty_title) {
                    let paramtitle = value[i].substring(0, this.examples[this.editindex].warranty_title.length);
                    // その他はその他用タイトルと一致で年数設定
                    if (this.examples[this.editindex].warranty_title == paramtitle) {
                      let paramvalue = value[i].substring(this.examples[this.editindex].warranty_title.length);
                      paramvalue = paramvalue.substring(0, paramvalue.length - 1);
                      this.$set(this.form_params3[key2], 'value', paramvalue);
                    }
                  }
                } else {
                  // その他以外はタイトル一致で年数設定
                  let paramtitle = value[i].substring(0, this.form_params3[key2].title.length);
                  if (this.form_params3[key2].title == paramtitle) {
                    let paramvalue = value[i].substring(this.form_params3[key2].title.length);
                    paramvalue = paramvalue.substring(0, paramvalue.length - 1);
                    this.$set(this.form_params3[key2], 'value', paramvalue);
                  }
                }
              });
              
            }

        }


        if (key == "category") {
          let value = [];
          let selectvalues = [];
          value = this.examples[this.editindex].category.split(" ");
            for (let i in value) {
              for (let j in this.options) {
                if (value[i] == this.options[j].name){
                  selectvalues.push({ id: this.options[j].id, name: this.options[j].name });
                }
              }
            }
          this.selected = selectvalues;
        }

        if (key == "complete_date") {
          this.year = this.examples[this.editindex].complete_date.substring(0, 4);
          this.month = Number(this.examples[this.editindex].complete_date.substring(5, 7));
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
    Slider,
    TextInput,
    SelectInput,
    TextArea,
    Multiselect,
  },
};
</script>