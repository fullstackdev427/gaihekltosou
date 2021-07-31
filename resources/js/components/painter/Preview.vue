<template>
  <Detail v-if="loaded" :painter_id="painter_id">
    <template v-slot:btn_consul>
      <a href="" class="btn-confirm" @click="onConsultation()">相談する</a>
    </template>

    <template v-slot:btn_favorite>
      <div class="btn-img-part" v-if="!is_favorite">
        <h4 class="btn-img-txt">お気に入り登録</h4>
        <img src="/image/favorite1.png" alt="" @click="toggleFavorite()">
      </div>
      <div class="btn-img-part" v-else>
        <h4 class="btn-img-txt">お気に入り解除</h4>
        <img src="/image/favorite2.png" alt="" @click="toggleFavorite()">
      </div>
    </template>
  </Detail>
</template>

<script>
import { mapGetters } from "vuex";
import Detail from "js/components/painter/Detail.vue";

export default {
  props: {
    painter_id: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      loaded: false,
      is_favorite: false,
    };
  },
  computed: {
    ...mapGetters("Painter", [
      "findPainter",
    ]),
  },
  created() {
    this.$store.dispatch('Painter/loadPreview').then(() => {
      this.loaded = true;
    }).catch(error => {
      console.log(error);
    });
  },
  method: {
    toggleFavorite() {
      this.is_favorite = !this.is_favorite;
    },
    onConsultation() {},
  },
  components: {
    Detail,
  },
};
</script>