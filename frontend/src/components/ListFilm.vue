<template>
  <div class="hello" v-if="carregando === false">
    <h2>Movies List</h2>
    Filter: <input v-model="searchTitle" placeholder="Search Title">
    <button  v-on:click="getSearch()">Filtrar</button>

    <div class="container">
      <div class="mt-3">
        <b-card-group deck>
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
              <ul v-for="genre in movie.genre_ids" :key="genre.id">
               <li><span>{{genre}}</span></li>
              </ul>
              <router-link :to="`details/${movie.id}`">Details</router-link>
            </b-card>
          </div>
        </b-card-group>
      </div>
      <div class="overflow-auto">
        <div>
          <b-pagination
            v-model="page"
            :total-rows="rows"
            :per-page="perPage"
            first-number
            last-number
            change="change()"
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
      page: 0,
      rows: 0,
      perPage: 0,
      carregando: true,
      genres: [],
      searchTitle: ''
    }
  },
  mounted () {
    api
      .get('list-movie')
      .then((resp) => {
        this.movies = resp.data
        this.page = resp.data.page
        this.rows = resp.data.total_pages
        this.perPage = resp.data.results.length
        this.carregando = false
      })
      .catch((e) => {
        console.log(e)
      })
  },
  methods: {
    change () {
      console.log('teste')
    },
    getSearch () {
      api
      .post('search-name', {title: this.searchTitle})
      .then((resp) => {
        console.log(resp)
        this.movies = resp.data
        this.page = resp.data.page
        this.rows = resp.data.total_pages
        this.perPage = resp.data.results.length
      })
      .catch((e) => {
        console.log(e)
      })
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
