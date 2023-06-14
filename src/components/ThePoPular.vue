<template>
  <div class="list-group">
    <h3 class="list-group-item list-group-item-action" v-for="link in links"><a  class="link_popular" :href="getLink(link.id)"> {{ link.name }} <br> <i class="fa-solid fa-eye"></i> {{ link.access_count }} </a></h3>
      <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-end">
        <li class="page-item page-link disabled text-danger"> Page {{ index + 1 }} </li>
        <li class="page-item" :class="{ disabled: index === 0 }">
          <a class="page-link" href="#" @click="prevPage">Previous</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#" @click="nextPage">Next</a>
        </li>
      </ul>
    </nav>
    </div>
</template>


<style scoped>
.link_popular{
  text-decoration: none;
}

.link_popular:hover{
  color: red;
  background: transparent;
}
</style>

<script>
export default {
  data() {
    return {
      links: [],
      index: 0,
    };
  },
  created() {
    this.getPopularLinks();
  },
  methods: {
    async getPopularLinks() {
      axios.post('http://localhost:82/get_link_4share/public/api/popular', { index: this.index }).then(response => {
        this.links = response.data;
      })
        .catch(error => {
          console.error(error);
        });
    },
    prevPage() {
      if (this.index > 0) {
        this.index--;
        this.getPopularLinks();
      }
    },
    nextPage() {
      this.index++;
      this.getPopularLinks();
    },
    getLink(id) {
      return `/info/${id}`;
    },
  },
}
</script>
  