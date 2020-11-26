<template>
  <div v-if="carregando === false" class="hello">
    <h4>Filter Genres</h4>
      <ul v-for="genre in genres.genres" :key="genre.id">
        <li>{{genre.name}}</li>
      </ul>
    <hr>
  </div>
</template>

<script>
import api from '../router/api'
export default {
  data () {
    return {
      genres: [],
      carregando: true
    }
  },
  mounted () {
    api
      .get(`genres`)
      .then((resp) => {
        this.genres = resp.data
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
