<template>
  <div class="top-0 position-fixed w-100">
    <nav>
      <TheNavbar navbarClass="navbar-light" />
    </nav>
  </div>
  <div class="info-link">
    <h3 class="name_link">{{ result["name"] }}</h3>
    <h2 class="size_link">
      <i class="fa-solid fa-hard-drive"></i> {{ formatSize(result["size"]) }}
    </h2>
    <p class="original_link">{{ result["link"] }}</p>
    <a :href="downloadlink" @click="updateAcessCount" class="btn btn-download" target="_blank"
      >Download
    </a>
  </div>
</template>

<style scoped>
.info-link {
  margin: 0 auto;
  padding: 2em 0;
}

.btn-download {
  margin-top: 30px;
  border: 1px solid #1097b2;
  border-radius: 20px;
  background-image: linear-gradient(
      to bottom,
      #fff9,
      transparent 50% 90%,
      #f5cbbc99
    ),
    repeating-linear-gradient(60deg, #0539bc55 0 10px, transparent 10px 20px),
    linear-gradient(to bottom, #08e0ef, #6cc7ee);
  color: #fff;
  font-family: monospace;
  font-weight: bold;
  text-shadow: 0 1px 0 #efb7de;
  box-shadow: 0 10px 0 rgba(0, 0, 0, 0.333), 0 5px 0 #1395bd,
    0 4px 0 7px transparent, 0 0 30px 10px #60d1e2;
  transition: 0.5s;
}

.btn-download:active {
  box-shadow: 0 0px 0 #0005, 0 0px 0 #1376bd, 0 0px 0 7px transparent,
    0 0 30px 30px #60dee2;
  transform: translateY(7px);
}

.name_link {
  color: #3796e6;
}

.size_link {
  padding-top: 30px;
}

.original_link {
  padding-top: 30px;
  color: #f03c3c;
}
</style>

<script setup>
import TheNavbar from "../components/TheNavbar.vue";
</script>

<script>
export default {
  data() {
    return {
      id: this.$route.params.id,
      result: [],
      downloadlink: "",
    };
  },
  created() {
    this.getInfoById();
  },
  methods: {
    async getInfoById() {
      try {
        this.result = [];
        this.downloadlink = [];
        const response = await axios.get(
          `http://localhost:82/get_link_4share/public/api/infofile/${this.id}`
        );
        this.result = response.data;
        this.downloadlink = response.data["link__vip"]["link_download_vip"];
      } catch (error) {
        console.log(error);
      }
    },
    async updateAcessCount() {
      axios
        .post("http://localhost:82/get_link_4share/public/api/updateaccess", {
          id: this.id,
        })
        .catch((error) => {
          console.error(error);
        });
    },
    formatSize(size) {
      return (size / 1073741824).toFixed(5) + " GB";
    },
  },
};
</script>
