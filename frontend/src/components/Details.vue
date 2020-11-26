<template>
  <div v-if="carregando === false" class="hello">
    <router-link to="/">Voltar</router-link>
    <h2>Movie Details</h2>
    <img :src="urlimage + movie.backdrop_path" height="200px">
    <h3>Title: {{movie.title}} -  <span>{{ movie.release_date }}</span></h3>
    <p>Site: <a :href="movie.homepage" target="_blank">{{movie.homepage}}</a> </p>
    <hr>
    <h4>Genres</h4>
      <ul v-for="genre in movie.genres" :key="genre.id">
        <li>{{genre.name}}</li>
      </ul>
    <hr>
    <h4>Overview</h4>
    <p>{{movie.overview}}</p>
    <img :src="urlimage + movie.poster_path" height="200px">
  </div>
</template>

<script>
import api from '../router/api'
export default {
  data () {
    return {
      movie: [],
      urlimage: 'https://image.tmdb.org/t/p/w500',
      carregando: true
    }
  },
  mounted () {
    api
      .get(`details/${this.$route.params.id}`)
      .then((resp) => {
        this.movie = resp.data
        this.carregando = false
      })
      .catch((e) => {
        console.log(e)
      })
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
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
  color: #42b983;
}
</style>
