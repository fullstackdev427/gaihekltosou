<template>
  <div v-if="!isDetails">
    <div>
      <!--<div class="row mt-3 mb-3">
        <h3 class="col-md-10"></h3>
        <div class="col-md-2 d-flex justify-content-end">
          <button type="button" class="btn btn-primary" @click="onSearch()">検索</button>
        </div>
      </div>-->

      <div class="row favlist-area">
        <div class="col-12" style="padding:15px 7px"  v-for="(painter, index) in painters" :key="painter.id">
          <div class="card" @click="onDetails(index,$event)">
            <div class="row mt-2 mb-2">
              <div class="col-4">
                <img v-if="painter.image_file==null"  class="card-img-top" alt="Card image cap" src="/image/mypageimg.PNG">
                <img v-else  class="card-img-top" alt="Card image cap" :src=painter.image_file>  
              </div>
              <div class="col-8" style="padding-left:0px">
                <div class="company-name-area">
                  <div>
                    <p class="company-address">{{painter.prefectures}}{{painter.city}}</p>
                    <p class="company-name">{{painter.name}}</p>
                    <div class="work-type">
                      <div class="item">
                          外壁塗装
                      </div>
                      <div class="item">
                          防水工事
                      </div>
                    </div>
                  </div>
                  <div class="favorite" v-if="!painter.user_id">
                    <p class="favorite-label">お気に入り登録</p>
                    <div id="fav-icon" class="favorite-icon" @click="onFavorite(index)"></div>
                  </div>
                  <div class="favorite" v-else>
                    <p class="favorite-label">お気に入り解除</p>
                    <div id="fav-icon" class="unfavorite-icon" @click="onNoFavorite(index)"></div>
                  </div>
                </div>
                <div class="rate">
                  <p class="label">総合評価</p>
                  <StarRating :isIndicatorActive="false" :rating="painter.rank"/>
                  <p class="total-number">({{painter.prefectures}}件)</p>
                </div>
                
              </div>
            </div>
            <div class="company-comment" style="white-space: pre-line;">{{painter.catch_copy}}</div>
            <div class="row">
              <!--<div class="col-4 type-col">
                <div class="type">
                  <div class="name">年間施工実績数</div>
                  <div class="number">{{ painter.annual_constructions }}<span class="unit"> 棟</span></div>
                </div>
              </div>-->
              <div class="col-4 type-col">
                <div class="type">
                  <div class="name">口コミ数</div>
                  <div class="number">{{ painter.eva_count }}<span class="unit"> 件</span></div>
                </div>
              </div>
              <div class="col-4 type-col">
                <div class="type">
                  <div class="name">施工事例数</div>
                  <div class="number">{{ painter.constructions }}<span class="unit"> 件</span></div>
                </div>
              </div>
              <div class="col-4 type-col">
                <div class="type">
                  <div class="name">コラム数</div>
                  <div class="number">{{ painter.col_count }}<span class="unit"> 件</span></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

     <!--ロード中-->
     <div v-if="loading">
       <div class="text">取得中...</div>
     </div>
    </div>
  </div>

  <div class="painter-detail" v-else-if="isDetails && !isEvaluations && !iscolumns && !isExamples">
    <Slider :items="images"/>
    
    <div class="address">
      <div class="address-name">
        <h4>{{painters[detailindex].city}}</h4>
        <h2>{{painters[detailindex].name}}</h2>
      </div>
      <div style="width:50%">
        <div class="address-number">
          <h3>施工実績数</h3>
          <span v-if="painters[detailindex].constructions!=null">
            <h4 v-for="(number,index) in `${painters[detailindex].constructions}`.split('')" :key="index">{{number}}</h4>
          </span>
          <span v-else>
            <h4>0</h4>
          </span>
        </div>
        <div class="address-number">
          <h3>年間施工実績数</h3>
          <span v-if="painters[detailindex].annual_constructions!=null">
            <h4 v-for="(number,index) in `${painters[detailindex].annual_constructions}`.split('')" :key="index">{{number}}</h4>
          </span>
          <span v-else>
            <h4>0</h4>
          </span>
        </div>
      </div>
    </div>

    <div class="consult-txt" style="white-space: pre-line;">
      <h4>{{painters[detailindex].pr_copy}}
      </h4>
      <div class="btn-body">
        <a href="" class="btn-confirm" @click="onConsultation()">相談する</a>
        <div class="btn-img-part" v-if="!painters[detailindex].user_id">
          <h4 class="btn-img-txt">お気に入り登録</h4>
          <img src="/image/favorite1.png" alt="" @click="onFavorite(detailindex)">
        </div>
        <div class="btn-img-part" v-else>
          <h4 class="btn-img-txt">お気に入り解除</h4>
          <img src="/image/favorite2.png" alt="" @click="onNoFavorite(detailindex)">
        </div>
      </div>
    </div>
    <div class="profile">
      <div class="contain">
        <div class="profile-title">
          <h2>PROFILE</h2>
        </div>
        <div class="profile-body" style="white-space: pre-line;">
          <p>{{painters[detailindex].catch_copy}}</p>
        </div>
      </div>
    </div>
    <div class="company">
      <div class="company-title">
        <h2>会社概要</h2>
      </div>
      <div class="company-body">
        <table>
          <tbody>
            <tr>
              <th>名称</th>
              <td>{{painters[detailindex].name}}</td>
            </tr>
            <tr>
              <th>代表者</th>
              <td>{{painters[detailindex].ceo_name}}</td>
            </tr>
            <tr>
              <th>所在地</th>
              <td>{{ painters[detailindex].address1 }}{{ painters[detailindex].address2 }}</td>
            </tr>
            <tr>
              <th>TEL</th>
              <td>{{painters[detailindex].tel}}</td>
            </tr>
            <tr>
              <th>FAX</th>
              <td>{{ painters[detailindex].fax }}</td>
            </tr>
            <tr>
              <th>従業員数</th>
              <td>{{ painters[detailindex].employees }}</td>
            </tr>
            <tr>
              <th>設立</th>
              <td>{{ painters[detailindex].established }}</td>
            </tr>
            <tr>
              <th>資本金</th>
              <td>{{ painters[detailindex].capital }}円</td>
            </tr>
            <tr>
              <th>建設業許可</th>
              <td>{{ painters[detailindex].permission }}</td>
            </tr>
            <tr>
              <th>事業内容</th>
              <td>{{ painters[detailindex].type }}</td>
            </tr>
            <tr>
              <th>加盟団体</th>
              <td>{{ painters[detailindex].organization }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="example">
      <div class="example-title">
        <h2>施工事例</h2>
      </div>
      <div class="example-body">
        <div class="example-part">

        </div>
      </div>
      <button type="button" class="detail-btn" @click="onExamples">施工事例を見る</button>
    </div>

    <div class="logomi">
      <div class="logomi-contain">
        <img src="/image/logomi.png" alt="">
      
        <div class="col-12" style="padding:5px 7px 0 7px"  v-for="(evaluation, index) in evaluations" :key="evaluation.id">
          <div class="logomi-title">
            <h3>{{ evaluation.user_name }}</h3>
            <div class="logomi-img">
            <StarRating :isIndicatorActive="false" :rating="evaluation.correspondence"/>
            </div>
          </div>
          <div class="logomi-body">
            <p>{{ evaluation.evaluation }}</p>
          </div>
        </div>
      </div>
      <button type="button" class="detail-btn" @click="onReadEvaluations">口コミを見る</button>
    </div>

    <div class="column"  v-if="columns.length">
      <div class="column-contain">
        <div class="column-img">
          <img alt="" :src=columns[0].image_file1>
        </div>
        <div class="column-date">
          <h4>{{columns[0].updated_at}}</h4>
        </div>
        <div class="column-subtitle">
          <h4>{{categorys[columns[0].category]}}</h4>
        </div>
        <div class="column-title">
          <h2>{{columns[0].title}}</h2>
        </div>        
        <div class="column-body" style="white-space: pre-line;">
          <p>{{columns[0].contents}}</p>
        </div>
      </div>
      <button type="button" class="detail-btn" @click="onColumns">コラムを見る</button>
    </div> 
     
    <div class="back-button">
      <button type="button" class="text-white btn-regester" @click="onNoDetails">一覧に戻る </button>
    </div>
  </div>

  <div v-else-if="isExamples">

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
        
    <div class="back-button" style="margin-bottom:120px">
      <button type="button" class="text-white btn-regester" @click="onNoExamples">詳細に戻る </button>
    </div>
  </div>

  <div v-else-if="isEvaluations">
    <div class="bor_bottom bg_yellow">
        <h3 class="text-blue text-center">{{painters[detailindex].name}}</h3>
    </div>
    <div class="bor_bottom">
        <h3 class="text-blue text-center">総合評価</h3>
        <div class="star">
            <StarRatingTotal :rating="painters[detailindex].rank"></StarRatingTotal>
        </div>
    </div>
    <div class="bor_bottom">
        <h3 class="text-blue text-center">採点分布</h3>
        <div class="star_bar"><StarRating :isIndicatorActive="false" :rating="5"/><div style="width: 30%;"><div class="bar" :style="evaluationbar5"></div></div><div style="width:40px">{{ evaluation5 }}件</div></div>
        <div class="star_bar"><StarRating :isIndicatorActive="false" :rating="4"/><div style="width: 30%;"><div class="bar" :style="evaluationbar4"></div></div><div style="width:40px">{{ evaluation4 }}件</div></div>
        <div class="star_bar"><StarRating :isIndicatorActive="false" :rating="3"/><div style="width: 30%;"><div class="bar" :style="evaluationbar3"></div></div><div style="width:40px">{{ evaluation3 }}件</div></div>
        <div class="star_bar"><StarRating :isIndicatorActive="false" :rating="2"/><div style="width: 30%;"><div class="bar" :style="evaluationbar2"></div></div><div style="width:40px">{{ evaluation2 }}件</div></div>
        <div class="star_bar"><StarRating :isIndicatorActive="false" :rating="1"/><div style="width: 30%;"><div class="bar" :style="evaluationbar1"></div></div><div style="width:40px">{{ evaluation1 }}件</div></div>
    </div>
    <div class="evaluation_content" v-for="(evaluation, index) in evaluationsAll" :key="evaluation.id">
        <div class="part">
            <div class="part_title">
                <h5>{{ evaluation.user_name }}</h5>
                <StarRating :isIndicatorActive="false" :rating="evaluation.correspondence"/>
            </div>
            <div class="part_text" style="white-space: pre-line;">
                {{ evaluation.evaluation }}
            </div>
        </div>
    </div>
        
    <div class="back-button" style="margin-bottom:120px">
      <button type="button" class="text-white btn-regester" @click="onNoEvaluations">詳細に戻る </button>
    </div>
  </div>

  <div v-else-if="iscolumns && !iscolumnsDetails">
    <div class="column-list-all">
      <div class="header">
        <p class="header-main-txt">{{painters[detailindex].name}}</p>
        <p class="header-sub-txt" @click="onColumnsDetailsAll">すべての記事&nbsp;( {{columns.length}} )</p>
      </div>
      <div v-for="(column, index) in columns" :key="column.id">
        <div class="part" @click="onColumnsDetails(index)">
          <div class="part-left">
            <p class="part-date">{{column.updated_at}}</p>
            <p class="part-title">{{column.title}}</p>
          </div>
          <div class="part-right">
              <img alt="" :src=column.image_file1>
          </div>
        </div>
      </div>
    </div>

        
    <div class="back-button" style="margin-bottom:120px">
      <button type="button" class="text-white btn-regester" @click="onNoColumns">詳細に戻る </button>
    </div>
  </div>

  <div v-else-if="iscolumnsDetails">
    <div class="column-list">
         <div class="header">
            <img class="header-img" alt="" :src=columns[columnsdetailindex].image_file1 />
            <p class="header-txt">{{painters[detailindex].name}}</p>
         </div>
         <div class="part">
            <p class="part-date">{{columns[columnsdetailindex].updated_at}}</p>
            <p class="part-title">{{columns[columnsdetailindex].title}}</p>
<!--
            <p class="part-subtitle">{{categorys[columns[columnsdetailindex].category]}}</p>
-->
            <Slider :items="columns[columnsdetailindex].images"/>
            <div class="part-txt" style="white-space: pre-line;">
                <p>
                {{columns[columnsdetailindex].contents}}
                </p>
            </div>
        </div>
    </div>
        
    <div class="back-button" style="margin-bottom:120px">
      <button type="button" class="text-white btn-regester" @click="onNoColumnsDetails">コラムに戻る </button>
    </div>
  </div>

  <div v-else-if="iscolumnsDetailsAll">
    <div class="bor_bottom bg_yellow">
        <h3 class="text-blue text-center">{{painters[detailindex].name}}</h3>
    </div>

    
    <div class="column-list">
      <div class="col-12" style="padding:15px 7px"  v-for="(column, index) in columns" :key="column.id">
         <div class="header">
            <img class="header-img" alt="" :src=column.image_file1 />
            <p class="header-txt">{{painters[detailindex].name}}</p>
         </div>
         <div class="part">
            <p class="part-date">{{column.updated_at}}</p>
            <p class="part-title">{{column.title}}</p>
<!--
            <p class="part-subtitle">{{categorys[column.category]}}</p>
-->
            <Slider :items="column.images"/>
            <div class="part-txt" style="white-space: pre-line;">
                <p>
                {{column.contents}}
                </p>
            </div>
        </div>
      </div>
    </div>
        
    <div class="back-button" style="margin-bottom:120px">
      <button type="button" class="text-white btn-regester" @click="onNoColumnsDetails">コラムに戻る </button>
    </div>
  </div>

</template>

<script>
import { Api } from "js/route/user.js";
import { mapGetters } from 'vuex';
import StarRating from "js/components/user/StarRating.vue";
import StarRatingTotal from 'js/components/user/StarRatingTotal.vue';
import Slider from "js/components/Slider.vue";

export default {
  data(){
      return {
          painters: [],
          addpainters: [],
          categorys: [],
          evaluations: [],
          evaluationsAll: [],
          columns: [],
          examples: [],
          periods: [],

          evaluation1: 0,
          evaluation2: 0,
          evaluation3: 0,
          evaluation4: 0,
          evaluation5: 0,

          evaluationbar1: '',
          evaluationbar2: '',
          evaluationbar3: '',
          evaluationbar4: '',
          evaluationbar5: '',

          //詳細表示
          isDetails: false,
          //詳細Index
          detailindex: 0,

          //非同期で取得中 通常: false, 通信中: true
          itemLoading: false,
          //ロード中の表示
          loading: false,
          //最終データチェック
          isLastPage: false,

          //スクロールカウント
          count: 0,

          //初期表示数
          limit: 20,

          //口コミ表示
          isEvaluations: false,

          //実行中
          isProcess: false,

          //コラム表示
          iscolumns: false,
          //コラム詳細表示
          iscolumnsDetails: false,
          //コラム詳細全表示
          iscolumnsDetailsAll: false,
          //コラム詳細Index
          columnsdetailindex: 0,

          //施工事例表示
          isExamples: false,

          images: [],
          image_files: {
            image_file1: {
              img: true,
              src: '',
            },
            image_file2: {
              img: true,
              src: '',
            },
            image_file3: {
              img: true,
              src: '',
            },
            image_file4: {
              img: true,
              src: '',
            },
            image_file5: {
              img: true,
              src: '',
            },
            image_file6: {
              img: true,
              src: '',
            },
          },
      }
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
      await axios.get(Api.favorite).then(response => {
            this.painters = response.data;
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
    onDetails(index,event) {
      if(event.target.id=="fav-icon") return
      //詳細表示
      this.isDetails = true;
      //詳細Index
      this.detailindex = index;

      //画像読み込み
      this.getImages();
      //評価読み込み
      this.getEvaluations();
      this.getEvaluationsAll();
      this.getEvaluationsCount();
      //施工事例読み込み
      this.getExamples();
      //コラム読み込み
      this.getColumns();
	  scrollTo(0, 0);
    },
    onNoDetails() {
      //詳細表示
      this.isDetails = false;
      //詳細Index
      detailindex = 0;
    },
    onReadEvaluations() {
      //評価表示
      this.isEvaluations = true;
	  scrollTo(0, 0);
    },
    onNoEvaluations() {
      //評価表示
      this.isEvaluations = false;
    },
    onExamples() {
      //施工事例表示
      this.isExamples = true;
	  scrollTo(0, 0);
    },
    onNoExamples() {
      //施工事例表示
      this.isExamples = false;
    },
    onColumns() {
      //コラム表示
      this.iscolumns = true;
	  scrollTo(0, 0);
    },
    onNoColumns() {
      //コラム表示
      this.iscolumns = false;
    },
    onColumnsDetails(index) {
      //コラム詳細表示
      this.iscolumnsDetails = true;
      //コラム詳細Index
      this.columnsdetailindex = index;
      
	  scrollTo(0, 0);
    },
    onNoColumnsDetails() {
      //コラム詳細表示
      this.iscolumnsDetails = false;
      //コラム詳細全表示
      this.iscolumnsDetailsAll = false;
    },
    onColumnsDetailsAll() {
      //コラム詳細全表示
      this.iscolumnsDetailsAll = true;
	  scrollTo(0, 0);
    },
    onFavorite(index) {
      if (!this.isProcess) {
        this.isProcess = true;
            let params = new URLSearchParams();
            params.append("painter_id", this.painters[index].id);
      axios.get(Api.addfavorite, {params: params }).then(response => {

            //お気に入り登録
            this.$set(this.painters[index], 'user_id', 1);
            this.isProcess = false;

      }).catch(error => {
        if (error.response) {
          if (error.response.status == 422) {
          }
        }
      });
      }
    },
    onNoFavorite(index) {
      if (!this.isProcess) {
        this.isProcess = true;
            let params = new URLSearchParams();
            params.append("painter_id", this.painters[index].id);
      axios.get(Api.deletefavorite, {params: params }).then(response => {

            //お気に入り解除
            this.$set(this.painters[index], 'user_id', 0);
            this.isProcess = false;
            
      }).catch(error => {
        if (error.response) {
          if (error.response.status == 422) {
          }
        }
      });
      }
    },
    async getSeats() {
      if (this.itemLoading) return; //読込中は再読み込み防止
      if (this.isLastPage) return;  //取得データがもう存在しない場合は行わない

      //読込中 true
      this.itemLoading = true;
      //ロード中の表示
      this.loading = true;

      this.count += this.limit;

      var params = new URLSearchParams();
      params.append("limit", this.limit);
      params.append("skip", this.count);

      await axios.get(Api.favorite, {params: params }).then(response => {

            if (response.data.length == 0){
                //ローディング非表示
                this.loading = false;
                //読込中 false
                this.itemLoading = false;
                //取得データがもう存在しない
                this.isLastPage = true;  
                return;
            }

            this.addpainters = response.data;
            for (let i in this.addpainters) {
                  this.painters.push(this.addpainters[i]);
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
    async getImages() {
      let params = new URLSearchParams();
      params.append("id", this.painters[this.detailindex].id);
      
      await axios.get(Api.painterimages, {params: params }).then(response => {

        var i = 0;
        var j = 0;
        for (var k in response.data) {
           i += 1;
           j = 0;
           Object.keys(this.image_files).forEach(key => {
             j += 1;
             if (i == j) {
                 this.$set(this.image_files[key], 'src', response.data[k]);
                 this.images.push(this.image_files[key]);
             }
           });
        }
      }).catch(error => {
        if (error.response) {
          if (error.response.status == 422) {
          }
        }
      });

    },
    getEvaluations() {
      let params = new URLSearchParams();
      params.append("painter_id", this.painters[this.detailindex].id);
      params.append("limit", '3');
      
      axios.get(Api.getevaluation, {params: params }).then(response => {
            this.evaluations = response.data;

      }).catch(error => {
        if (error.response) {
          if (error.response.status == 422) {
          }
        }
      });

    },
    getEvaluationsAll() {
      let params = new URLSearchParams();
      params.append("painter_id", this.painters[this.detailindex].id);
      params.append("limit", '0');
      
      axios.get(Api.getevaluation, {params: params }).then(response => {
            this.evaluationsAll = response.data;

      }).catch(error => {
        if (error.response) {
          if (error.response.status == 422) {
          }
        }
      });

    },
    getEvaluationsCount() {
      let params = new URLSearchParams();
      params.append("painter_id", this.painters[this.detailindex].id);
      
      axios.get(Api.getevaluationcount, {params: params }).then(response => {
        this.evaluation1 = response.data.count1;
        this.evaluation2 = response.data.count2;
        this.evaluation3 = response.data.count3;
        this.evaluation4 = response.data.count4;
        this.evaluation5 = response.data.count5;
        
        let max = response.data.count1 + response.data.count2 + response.data.count3 + response.data.count4 + response.data.count5;

        this.evaluationbar1 = 'width:' + Math.floor(response.data.count1 * 100/ max) + '%;';
        this.evaluationbar2 = 'width:' + Math.floor(response.data.count2 * 100/ max) + '%;';
        this.evaluationbar3 = 'width:' + Math.floor(response.data.count3 * 100/ max) + '%;';
        this.evaluationbar4 = 'width:' + Math.floor(response.data.count4 * 100/ max) + '%;';
        this.evaluationbar5 = 'width:' + Math.floor(response.data.count5 * 100/ max) + '%;';

      }).catch(error => {
        if (error.response) {
          if (error.response.status == 422) {
          }
        }
      });

    },

    getColumns() {
      let params = new URLSearchParams();
      params.append("painter_id", this.painters[this.detailindex].id);
      
      axios.get(Api.getcolumn, {params: params }).then(response => {
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

    getExamples() {
      let params = new URLSearchParams();
      params.append("painter_id", this.painters[this.detailindex].id);
      
      axios.get(Api.examplelist, {params: params }).then(response => {
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
      }).catch(error => {
        if (error.response) {
          if (error.response.status == 422) {
          }
        }
      });

    },
    getyymmdd(str) {
      var ret = str;
      
      return ret.substring(0, 10);
    },

  },
  components: {
    StarRating,
    Slider,
    StarRatingTotal
  },
};
</script>