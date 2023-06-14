<template>
  <nav :class="['navbar', 'navbar-expand-xl', navbarClass]">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html"></a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-auto">
          <li class="nav-item px-5">
            <a
              class="nav-link active"
              @click="$router.push('/')"
              aria-current="page"
              href="/"
              ><img class="logo" src="../assets/logo.png" alt=""
            /></a>
          </li>
          <li class="nav-item px-5 py-2">
            <a class="nav-link" @click="$router.push('/').push('/about')" href="about"
              >Giới Thiệu</a
            >
          </li>
          <li class="nav-item px-5 py-2">
            <a class="nav-link" @click="$router.push('/').push('/popular')" href="popular"
              >Thịnh Hành</a
            >
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input
            class="form-control me-2"
            data-bs-toggle="modal"
            data-bs-target="#staticBackdrop"
            @click="$emit('toggle-get-link')"
            type="search"
            placeholder="Search"
            aria-label="Search"
          />
          <button
            class="btn btn-outline-success position-relative"
            type="submit"
          >
            Search
          </button>
        </form>
        <div
          class="list-group position-absolute w-25"
          style="top: 80%; right: 0"
        ></div>
      </div>
    </div>
  </nav>
  <div
    class="modal fade"
    id="staticBackdrop"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="false"
  >
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
              v-model="keyword"
              @input="$emit('input-change', keyword)"
            />
          </h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            @click="$emit('toggle-get-link')"
          ></button>
        </div>
        <div class="modal-body" v-for="item in items">
          <a
            :href="getLink(item.id)"
            class="list-group-item list-group-item-action show_result"
            >{{ item.name }} </a
          >
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.logo {
  width: 100px;
  height: 100px;
  justify-content: center;
  align-items: center;
  margin: -15px 0;
}

.show_result{
  color: blue;
}

.show_result:hover{
  color: red;
  border-bottom: 1px rgb(255, 0, 157) solid;
}
</style>

<script>
import { toValue } from 'vue';

export default {
  data() {
    return {
      items: [],
      keyword: "",
    };
  },
  props: {
    navbarClass: {
      type: String,
      default: "navbar-dark",
    },
  },
  watch: {
    keyword() {
      this.getDataSearch();
    }
  },
  methods: {
    async getDataSearch() {
      if (this.keyword != "") {
        try {
        this.items = [];
        const response = await axios.get(`http://localhost:82/get_link_4share/public/api/search/${this.keyword}`);
        this.items = response.data;
      } catch (error) {
        console.log(error);
      }
      }
      else{
        this.items = [];
      }
    },
    getLink(id) {
      return `/info/${id}`;
    },
  }
};


</script>
