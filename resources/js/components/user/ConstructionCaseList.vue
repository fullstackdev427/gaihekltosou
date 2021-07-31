<template>
  <div class="construction-list">
  <div class="col-12" style="padding:5px 7px 0 7px"  v-for="(example, index) in examples" :key="example.id">
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
            <p >{{ example.pname }}</p>
            <a href="">{{example.name}}</a>
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


  
</template>

<script>
import { Api } from "js/route/user.js";
import { mapGetters } from 'vuex';
import Slider from "js/components/Slider.vue";

export default {
  data() {
    return {
        name:"お客様と記念に",
         
        categorys: [],
        periods: [],
        examples: [],
        addexamples: [],

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
    };
  },
  computed: {
    ...mapGetters('Config', [
      'category',
      'constructionperiod',
    ]),
  },
  mounted() {
    this.$store.dispatch('Config/loadSelect').then(() => {
      this.categorys = this.category;
      this.periods = this.constructionperiod;
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
    async onSearch() {
      await axios.get(Api.examplelist).then(response => {
            this.examples = response.data;
            console.log(response.data)
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

//      this.getImageURL();

    },
    async getSeats() {
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

//      this.getImageURLappend();
    },
    getyymmdd(str) {
      var ret = str;
      
      return ret.substring(0, 10);
    },
    async getImageURL() {
        for (let i in this.examples) {
      
          let params = new URLSearchParams()
            if (this.examples[i].image_file1 != ''){
              params.append('image_file1', this.examples[i].image_file1);
            }
            if (this.examples[i].image_file2 != ''){
              params.append('image_file2', this.examples[i].image_file2);
            }
            if (this.examples[i].image_file3 != ''){
              params.append('image_file3', this.examples[i].image_file3);
            }
            if (this.examples[i].image_file4 != ''){
              params.append('image_file4', this.examples[i].image_file4);
            }
            if (this.examples[i].image_file5 != ''){
              params.append('image_file5', this.examples[i].image_file5);
            }
            if (this.examples[i].image_file6 != ''){
              params.append('image_file6', this.examples[i].image_file6);
            }
      
          await axios.get(Api.exampleimageurl, {params: params }).then(response => {
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
            if(response.data.image_file1 != ''){
              this.$set(imagefile1, 'src', response.data.image_file1);
              sliderimage.push(imagefile1);
            }
            if(response.data.image_file2 != ''){
              this.$set(imagefile2, 'src', response.data.image_file2);
              sliderimage.push(imagefile2);
            }
            if(response.data.image_file3 != ''){
              this.$set(imagefile3, 'src', response.data.image_file3);
              sliderimage.push(imagefile3);
            }
            if(response.data.image_file4 != ''){
              this.$set(imagefile4, 'src', response.data.image_file4);
              sliderimage.push(imagefile4);
            }
            if(response.data.image_file5 != ''){
              this.$set(imagefile5, 'src', response.data.image_file5);
              sliderimage.push(imagefile5);
            }
            if(response.data.image_file6 != ''){
              this.$set(imagefile6, 'src', response.data.image_file6);
              sliderimage.push(imagefile6);
            }

            this.$set(this.examples[i], 'images', sliderimage);

          }).catch(error => {
            if (error.response) {
              if (error.response.status == 422) {
              }
            }
          });

      }

    },
    async getImageURLappend() {
        for (let i in this.addexamples) {
      
          let params = new URLSearchParams()
            if (this.addexamples[i].image_file1 != ''){
              params.append('image_file1', this.addexamples[i].image_file1);
            }
            if (this.addexamples[i].image_file2 != ''){
              params.append('image_file2', this.addexamples[i].image_file2);
            }
            if (this.addexamples[i].image_file3 != ''){
              params.append('image_file3', this.addexamples[i].image_file3);
            }
            if (this.addexamples[i].image_file4 != ''){
              params.append('image_file4', this.addexamples[i].image_file4);
            }
            if (this.addexamples[i].image_file5 != ''){
              params.append('image_file5', this.addexamples[i].image_file5);
            }
            if (this.addexamples[i].image_file6 != ''){
              params.append('image_file6', this.addexamples[i].image_file6);
            }
      
          await axios.get(Api.exampleimageurl, {params: params }).then(response => {
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
            if(response.data.image_file1 != ''){
              this.$set(imagefile1, 'src', response.data.image_file1);
              sliderimage.push(imagefile1);
            }
            if(response.data.image_file2 != ''){
              this.$set(imagefile2, 'src', response.data.image_file2);
              sliderimage.push(imagefile2);
            }
            if(response.data.image_file3 != ''){
              this.$set(imagefile3, 'src', response.data.image_file3);
              sliderimage.push(imagefile3);
            }
            if(response.data.image_file4 != ''){
              this.$set(imagefile4, 'src', response.data.image_file4);
              sliderimage.push(imagefile4);
            }
            if(response.data.image_file5 != ''){
              this.$set(imagefile5, 'src', response.data.image_file5);
              sliderimage.push(imagefile5);
            }
            if(response.data.image_file6 != ''){
              this.$set(imagefile6, 'src', response.data.image_file6);
              sliderimage.push(imagefile6);
            }

            this.$set(this.addexamples[i], 'images', sliderimage);
            this.examples.push(this.addexamples[i]);

          }).catch(error => {
            if (error.response) {
              if (error.response.status == 422) {
              }
            }
          });

      }

    },
  },
  components: {
    Slider,
  },
};
</script>