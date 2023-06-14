<template>
    <div class="top-0 position-fixed w-100">
        <nav><TheNavbar navbarClass="navbar-light"  /></nav>
    </div>
  <div class="w-100 h-auto d-block container">
    <h1 class=""><i class="fa-solid fa-star-half-stroke text-danger"></i> Top link đang được cộng đồng quan tâm</h1>
    <ThePoPular />
</div>
</template> 

<script setup>
import TheNavbar from "../components/TheNavbar.vue";
import ThePoPular from "../components/ThePoPular.vue";
</script>

<style scoped>
.text-black {
  color: black;
}
</style>
