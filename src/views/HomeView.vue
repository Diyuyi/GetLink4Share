<script setup>
import TheHome from "../components/TheHome.vue";
import TheNavbar from "../components/TheNavbar.vue";
import TheGetLink from "../components/TheGetLink.vue";
</script>

<template>
  <div class="top-0 position-fixed container-fluid">
    <TheNavbar @toggle-get-link="onVisibleTheGetLink" />
  </div>
  <div><TheHome /></div>
  <div class="m-auto w-50 display-6">
    <TheGetLink v-if="visibleTheGetLink" :link4Share="link4Share" />
  </div>
</template>

<script>
export default {
  data() {
    return {
      visibleTheGetLink: true,
    };
  },
  methods: {
    onVisibleTheGetLink() {
      this.visibleTheGetLink = !this.visibleTheGetLink;
    },
  },
  props: {
    link4Share: String,
  },
};
</script>
