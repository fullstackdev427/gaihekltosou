<template>
  <div class="painter-detail">
    <Slider v-if="images.length > 0" :items="images"/>
    <div class="address">
      <div class="address-name">
        <h4>{{ painter.prefecture_name }}{{ painter.city }}</h4>
        <h2>{{ painter.name }}</h2>
      </div>
       <div style="width:100%; display:flex">
        <div class="address-number">
          <h3>施工実績数</h3>
          <span v-if="painter.constructions!=null">
            <h4 v-for="(number,index) in `${painter.constructions}`.split('')" :key="index">{{number}}</h4>
          </span>
          <span v-else>
            <h4>0</h4>
          </span>
        </div>
        <div class="address-number">
          <h3>年間施工実績数</h3>
          <span v-if="painter.annual_constructions!=null">
            <h4 v-for="(number,index) in `${painter.annual_constructions}`.split('')" :key="index">{{number}}</h4>
          </span>
          <span v-else>
            <h4>0</h4>
          </span>
        </div>
      </div>
    </div>

    <div class="consult-txt" style="white-space: pre-line">
      <h4>{{ painter.pr_copy }}</h4>
      <div class="btn-body">
        <slot name="btn_consul"></slot>
        <slot name="btn_favorite"></slot>
      </div>
    </div>
    <div class="profile">
      <div class="contain">
        <div class="profile-title">
          <h2>プロフィール</h2>
        </div>
        <div class="profile-body" style="white-space: pre-line">
          <p>{{ painter.catch_copy }}</p>
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
              <td>{{ painter.name }}</td>
            </tr>
            <tr>
              <th>代表者</th>
              <td>{{ painter.ceo_name }}</td>
            </tr>
            <tr>
              <th>所在地</th>
              <td>{{ painter.prefecture_name }}{{ painter.city }}{{ painter.address1 }}{{ painter.address2 }}</td>
            </tr>
            <tr>
              <th>TEL</th>
              <td>{{ painter.tel }}</td>
            </tr>
            <tr>
              <th>FAX</th>
              <td>{{ painter.fax }}</td>
            </tr>
            <tr>
              <th>設立</th>
              <td>{{ painter.established }}年</td>
            </tr>
            <tr>
              <th>事業内容</th>
              <td>{{ painter.type }}</td>
            </tr>
            <tr>
              <th>加盟団体</th>
              <td>{{ painter.organization }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="example">
      <div class="logomi-contain">
        <div class="container-header">
          <div class="title">
            施工事例
          </div>
        </div>
        <div class="example-body">
          <div class="example-part">
          </div>
        </div>
      </div>
      <button type="button" class="detail-btn" >施工事例を見る</button>
    </div>

    <div class="logomi">
      <div class="logomi-contain">
       <div class="container-header">
          <div class="title">
            <img src="/image/megahon.png" alt="">
            口コミ
          </div>
        </div>
        <div class="col-12" style="padding:5px 7px 0 7px"  v-for="(evaluation, index) in evaluations" :key="evaluation.id">
          <div class="logomi-title">
            <h3>{{ evaluation.user_name }}</h3>
            <div class="logomi-img">
            <StarRating :isIndicatorActive="false" :rating="evaluation.correspondence"/>
            </div>
          </div>
          <div class="logomi-body" style="white-space: pre-line;">
            <p>{{ evaluation.evaluation }}</p>
          </div>
        </div>
      </div>
      <button type="button" class="detail-btn" >口コミを見る</button>
    </div>

    <div class="column" >
      <div class="column-contain">
        <div class="container-header">
          <div class="title">
            <img src="/image/column.png" alt="">
            コラム
          </div>
        </div>
        <div  v-if="columns.length">
          <div class="column-date">
            <h4>{{columns[0].updated_at}}</h4>
          </div>
          <div class="column-subtitle">
            <h4>{{categorys[columns[0].category]}}</h4>
          </div>
          <div class="column-title">
            <h2>{{columns[0].title}}</h2>
          </div>
          <Slider :items="columns[columnsdetailindex].images"/>
          <div class="column-body" style="white-space: pre-line;">
            <p>{{columns[0].contents}}</p>
          </div>
        </div>
      </div>
      <button type="button" class="detail-btn">コラムを見る</button>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import Slider from "js/components/Slider.vue";
import {Api} from "js/route/user.js";

export default {
  props: {
    painter_id: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      painter: {},
      evaluations: [],
      columns: [],
    };
  },
  computed: {
    ...mapGetters("Painter", [
      "findPainter",
    ]),
    images() {
      let result = [];
      const imagefiles = [
        this.painter.profile_image,
        this.painter.image_file1,
        this.painter.image_file2,
        this.painter.image_file3,
        this.painter.image_file4,
      ];

      imagefiles.forEach(elem => {
        if (elem && elem.length > 0) {
          result.push({
            img: true,
            src: elem,
          });
        }
      });

      return result;
    }
  },
  methods: {
    getEvaluations() {
      let params = new URLSearchParams();
      params.append("painter_id", this.painter_id);
      params.append("limit", '3');
      console.log("EVA")
      axios.get(Api.getevaluation, {params: params }).then(response => {
            this.evaluations = response.data;

      }).catch(error => {
        if (error.response) {
          if (error.response.status == 422) {
          }
        }
      });
    },
    getColumns() {
      let params = new URLSearchParams();
      params.append("painter_id", this.painter_id);
      
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
    }
  },
  mounted() {
    this.painter = this.findPainter(this.painter_id);
    this.evaluations = this.getEvaluations();
    //this.columns = this.getColumns();
  },
  components: {
    Slider,
  },
};
</script>