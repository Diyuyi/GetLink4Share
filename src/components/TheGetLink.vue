<template>
    <div class="mb-3">
      <label class="form-label" style="color: rgba(255, 255, 255,0.9);">Nhập Link Vào Đây </label>
      <input type="text" class="form-control input-link" v-model="link4Share">
      <button type="submit" class="btn-submit btn btn-primary" @click="getInfoURL">Submit</button>
    </div>
    <div v-if="Object.keys(result).length > 0">
  <router-link :to="{ name: 'link_info', params: { id: result[0].id_4share_vip } }" class="result-info">
    {{ result.name }} <br>
    {{ formatSize(result.size) }}
  </router-link>
</div>

</template>

<style scoped>
.btn-submit {
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
  box-shadow: 0 10px 0 rgba(0, 0, 0, 0.333), 0 5px 0 #1395bd, 0 4px 0 7px transparent,
    0 0 30px 10px #60d1e2;
  transition: 0.5s;
}

.btn-submit:active{
        box-shadow: 
            0 0px 0 #0005,
            0 0px 0 #1376bd,
            0 0px 0 7px transparent,
            0 0 30px 30px #60dee2;
        transform: translateY(7px);
    }

.input-link {
  background-color:transparent;
}

.input-link:focus{
background-color: #fff;
}

.result-info{
text-decoration: none;
overflow-wrap: break-word;
font-size: xx-large;
}

.result-info:hover{
  color: red;
}

</style>

<script>
export default {
  props: ['id'],
    data() {
      return {
        link4Share:"",
        result:[],
      };
    },
    methods: {
    async getInfoURL() {
      if (this.keyword != "") {
        try {
        this.result = [];
        const response = await axios.get(`http://localhost:82/get_link_4share/public/api/getinfo/${this.link4Share}`);
        this.result = response.data;
      } catch (error) {
        console.log(error);
      }
      }
    },
    formatSize(size) { return (size / 1073741824).toFixed(5) + " GB"; }
  }
  }
</script>