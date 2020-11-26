<template>
  <div class="hello" v-if="carregando === false">
    <h2>Movies List</h2>
    Filter: <input v-model="searchTitle" placeholder="Search Title">
    <button  v-on:click="getSearch()">Filtrar</button>

    <div v-if="filter === true">
      <p>Filter True</p>
      <b-button @click="removeFilter()" size="sm">Remove Filter</b-button>
    </div>

    <div class="container">
      <b-row>
        <b-col>
          <div class="mt-3">
            <b-card-group deck id="my-card">
              <div v-for="movie in movies.results" :key="movie.id">
                <b-card
                  :title="movie.title"
                  :img-src="urlimage + movie.poster_path"
                  img-alt="title"
                  img-top
                  style="max-width: 15rem; max-height: 100rem"
                  class="mb-2"
                >
                  <span>{{ movie.release_date }}</span>
                  <b-card-text>
                    {{ movie.overview }}
                  </b-card-text>
                  <p>Genres</p>
                  <ul v-for="genre in movie.genre_ids" :key="genre.id">
                  <li><span>{{genre}}</span></li>
                  </ul>
                  <router-link :to="`details/${movie.id}`">Details</router-link>
                </b-card>
              </div>
            </b-card-group>
          </div>
        </b-col>
        <b-col col lg="2">
          <genres></genres>
        </b-col>
      </b-row>
      <div class="overflow-auto">
        <div>
          <b-pagination
            v-model="currentPage"
            :total-rows="rows"
            :per-page="perPage"
            first-text="First"
            prev-text="Prev"
            next-text="Next"
            last-text="Last"
            aria-controls="my-card"
            @change="(e) => pagination(e)"
          ></b-pagination>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from '../router/api'

export default {
  data () {
    return {
      movies: [],
      urlimage: 'https://image.tmdb.org/t/p/w500',
      currentPage: 1,
      rows: 0,
      perPage: 0,
      carregando: true,
      genres: [],
      searchTitle: '',
      setpagination: false,
      filter: false
    }
  },
  mounted () {
    this.dataList()
  },
  methods: {
    dataList () {
      if (this.setpagination === false) {
        api
          .get('list-movie')
          .then((resp) => {
            this.movies = resp.data
            this.rows = resp.data.total_pages
            this.perPage = resp.data.results.length
            this.carregando = false
            this.setpagination = false
          })
          .catch((e) => {
            console.log(e)
          })
      }
    },
    pagination (page) {
      if (this.filter === false) {
        api
          .get(`list-movie-pagination/${page}`)
          .then((resp) => {
            this.movies = resp.data
            this.setpagination = true
            this.rows = resp.data.total_pages
            this.perPage = resp.data.results.length
            window.scroll(0, 0)
          })
          .catch((e) => {
            console.log(e)
          })
      } else {
        api
          .get(`search-name-pagination/${this.searchTitle}/${page}`)
          .then((resp) => {
            this.movies = resp.data
            this.rows = resp.data.total_pages
            this.perPage = resp.data.results.length
            window.scroll(0, 0)
          })
          .catch((e) => {
            console.log(e)
          })
      }
    },
    getSearch () {
      api
        .post('search-name', {title: this.searchTitle})
        .then((resp) => {
          this.movies = resp.data
          this.currentPage = resp.data.page
          this.rows = resp.data.total_pages
          this.perPage = resp.data.results.length
          this.filter = true
        })
        .catch((e) => {
          console.log(e)
        })
    },
    removeFilter () {
      this.currentPage = 1
      this.filter = false
      this.searchTitle = ''
      this.dataList()
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1,
h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #424ab9;
}
</style>
