<template>
    <Flickity class="carousel" v-if="Object.keys(items).length > 0" ref="flickity" :options="flickityOptions">
      <div  class="carousel-cell" v-for="(item, index) in items"  :key="index" >
        <img class="" :src="item.src" alt="">
      </div>
    </Flickity>
</template>

<script>
  import Flickity from 'vue-flickity'
  export default {
    components: {
      Flickity
    },
    props: {
      items: {
        type: Array,
        default: [],
      }
    },
      data() {
        return {
          flickityOptions: {
            "pageDots": true,
            "resize": true,
            "prevNextButtons": false,
            "wrapAround": true
          }
        }
      },
   methods: {
    next() {
      this.$refs.flickity.next();
    },
    
    previous() {
      this.$refs.flickity.previous();
    }
    }
  };
</script>