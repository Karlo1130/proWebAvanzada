<script setup>
  import { ref, onMounted } from "vue";

  const username = ref('');
  const password = ref('');
  const hasAccess = ref(false);
  const movies = ref(null)
  const movieDetails = ref(null)
  const isMovieDetails = ref(false)
  const selectedValue = ref(null)

  // Función para manejar el login
  const onSubmit = async () => {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    myHeaders.append("Authorization", "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5YTZiZDFhOTcyM2EzY2VhMDI2YTllMjUyMDQ2YjMxNiIsIm5iZiI6MTcyNzIyOTY5MC43OTM1OTQsInN1YiI6IjY2ZjJmNWYwYTk3ODgwMTQ4ZjNiOTBiNSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.fZfgCHZz_ePmrG_w_m4-p4_wbnkBfoUD1N1DKRDDMh4");

    const raw = JSON.stringify({
      "username": username.value,
      "password": password.value,
      "request_token": ""
    });

    const requestOptions = {
      method: "POST",
      headers: myHeaders,
      body: raw,
      redirect: "follow"
    };

    try {
      fetch("https://api.themoviedb.org/3/authentication/token/validate_with_login", requestOptions)
        .then((response) => response.json())
        .then((result) => {
          if (result.success) {
            sessionStorage.setItem('user', JSON.stringify({
              username : username.value,
              password : password.value
            }))
  
            hasAccess.value = true;
            if (!hasAccess.value) {
              alert('Acceso denegado, correo o contraseña incorrectos');
            }
          }
        })
      
    } catch (error) {
      
    }


  };


  onMounted(() => {

    const requestOptions = {
      method: "GET",
      redirect: "follow"
    };

    fetch("https://api.themoviedb.org/3/discover/movie?api_key=9a6bd1a9723a3cea026a9e252046b316", requestOptions)
      .then((response) => response.json())
      .then((result) => {
        movies.value = result.results
      })
      .catch((error) => console.error(error));

    const sessionUser = sessionStorage.getItem('user');
    if (sessionUser) {
      hasAccess.value = true;
    }

  });

  const seeMovieDetails = async (movieId) => {

    try {
      const requestOptions = {
        method: "GET",
        redirect: "follow"
      };
  
      fetch(`https://api.themoviedb.org/3/movie/${movieId}?api_key=9a6bd1a9723a3cea026a9e252046b316`, requestOptions)
        .then((response) => response.json())
        .then((result) => {
          movieDetails.value = result

          if (movieDetails.value) {
            isMovieDetails.value = true;
          }

        })
        .catch((error) => console.error(error));
      
    } catch (error) {
      console.error(error);
    }

    
  }

  const rateMovie = (rate) => {
     try {
      const myHeaders = new Headers();
      myHeaders.append("Content-Type", "application/json");
      myHeaders.append("Authorization", "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5YTZiZDFhOTcyM2EzY2VhMDI2YTllMjUyMDQ2YjMxNiIsIm5iZiI6MTcyNzIyOTY5MC43OTM1OTQsInN1YiI6IjY2ZjJmNWYwYTk3ODgwMTQ4ZjNiOTBiNSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.fZfgCHZz_ePmrG_w_m4-p4_wbnkBfoUD1N1DKRDDMh4");

      const raw = JSON.stringify({
        "value": rate
      });

      const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
      };

      fetch(`https://api.themoviedb.org/3/movie/${movieDetails.value.id}/rating`, requestOptions)
        .then((response) => response.text())
        .then((result) => console.log(result))
        .catch((error) => console.error(error));

     } catch (error) {
      console.error(error)
     }
  }

  const deleteRate = () => {
    try {
      const myHeaders = new Headers();
      myHeaders.append("Authorization", "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5YTZiZDFhOTcyM2EzY2VhMDI2YTllMjUyMDQ2YjMxNiIsIm5iZiI6MTcyNzIyOTY5MC43OTM1OTQsInN1YiI6IjY2ZjJmNWYwYTk3ODgwMTQ4ZjNiOTBiNSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.fZfgCHZz_ePmrG_w_m4-p4_wbnkBfoUD1N1DKRDDMh4");

      const requestOptions = {
        method: "DELETE",
        headers: myHeaders,
        redirect: "follow"
      };

      fetch(`https://api.themoviedb.org/3/movie/${movieDetails.value.id}/rating`, requestOptions)
        .then((response) => response.text())
        .then((result) => console.log(result))
        .catch((error) => console.error(error));

    } catch (error) {
      console.error(error)
    }
  }

</script>

<template>
  <div v-if="!hasAccess">
    <form @submit.prevent="onSubmit">
      <fieldset>
        <label>Nombre:</label>
        <input v-model="username" type="text" placeholder="nombre" required value="karlo1130">
      </fieldset>

      <fieldset>
        <label>Contraseña:</label>
        <input v-model="password" type="password" placeholder="Contraseña" required value="karlod1130">
      </fieldset>

      <button type="submit">Acceder</button>
    </form>
  </div>

  <div v-if="hasAccess && !isMovieDetails">

    <div v-for="movie in movies" class="card">
      <div class="card-body">
        <img :src="'https://image.tmdb.org/t/p/w500' + movie.poster_path">
        <h5 class="card-title">{{ movie.title }}</h5>
        <p class="card-text">{{ movie.overview }}</p>
        <button @click="seeMovieDetails(movie.id)" type="button" class="btn btn-primary">More details</button>
      </div>
    </div>

  </div>

  <div v-if="isMovieDetails">
    <h1>{{ movieDetails.title }}</h1>
    <h3>{{ movieDetails.tagline }}</h3>
    <img :src="'https://image.tmdb.org/t/p/w500' + movieDetails.poster_path">
    <h3>Vote average</h3>
    <h3>{{ movieDetails.vote_average }}</h3>
    <h4>Rate the movie:</h4>
    <form>
      <div v-for="n in 10">
        <input type="radio" v-model="selectedValue" :value="n">
        <label >{{ n }}</label>
      </div>
      
      <button type="button" @click="rateMovie(selectedValue)">Rate movie</button>
      <button type="button" @click="deleteRate()">Delete rate</button>
      <button type="button" @click="isMovieDetails = false">Return</button>
    </form>
  </div>
</template>
