<template>
  <select class="form-control" :id="id" :name="name" :aria-describedby="error_aria" :disabled="disabled" :value="value" @change="$emit('input', $event.target.value)">
    <option v-if="placeholder.length > 0" disabled value="">{{ placeholder }}</option>
    <option v-for="( text, index ) in options" :key="index" :value="index">
      {{ text }}
    </option>
  </select>
</template>

<script>
export default {
  props: {
    id: {
      type: String,
      default: '',
    },
    name: {
      type: String,
      default: '',
    },
    value: {
      type: String,
      default: '',
    },
    placeholder: {
      type: String,
      default: '',
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    options: {
      type: [Array, Object],
      default: () => [],
    },
    error_aria: {
      type: String,
      default: '',
    },
  },
};
</script>