<template>
    <div class="column-list">
         <div class="header">
            <img class="header-img" src="/image/mypageimg.PNG" alt=""/>
            <p class="header-txt">株式会社&nbsp;七色</p>
         </div>
         <div class="part">
            <p class="part-date">2021.03.03.wed 15:30</p>
            <p class="part-title">外壁塗装あれこれ</p>
            <p class="part-subtitle">#外壁塗装&nbsp;#屋根塗装&nbsp;#ベランダ防水&nbsp;#塗替え道場</p>
            <Slider :items="images"/>
            <div class="part-txt">
                <p>
                ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。ここにコラム本文が入ります。
                </p>
            </div>
            <div class="main-btn">
                <a href="">施工事例を見る</a>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import Slider from "js/components/Slider.vue";

export default {
  data() {
    return {
        images: [
          {
            img: true,
            src:
              "https://mdbootstrap.com/img/Photos/Slides/img%20(68).jpg",
            mask: "black-light",
            alt: "First Slide",
            caption: {
              title: "First slide"
            }
          },
          {
            img: true,
            src:
              "https://mdbootstrap.com/img/Photos/Slides/img%20(6).jpg",
            mask: "black-strong",
            caption: {
              title: "Second slide"
            }
          },
          {
            img: true,
            src:
              "https://mdbootstrap.com/img/Photos/Slides/img%20(9).jpg",
            mask: "black-slight",
            caption: {
              title: "Third slide"
            }
          }
        ],
        name:"お客様と記念に"
    };
  },
  components: {
    Slider,
  },
};
</script>