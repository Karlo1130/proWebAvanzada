<script setup>
import { ref } from "vue";

const email = ref('')
const password = ref('')

</script>

<script>
export default {
  data() {
    return { users: 
      [
        {
          name:"joel",
          job:"driver"
        },
        {
          name:"wade",
          job:"doctor"
        }
      ] 
    }
  },
  methods: {

    async onSubmit(email, password) {
      console.log(email);
      console.log(password);
      console.log("hola");

      // const response = await fetch("./assets/users.json");

      // const json = await response.json();
      // console.log(json);

      const response = await fetch("users.json")
      console.log(response);
      
      const json = await response.json();
      console.log(json);
    },
  },
}
</script>

<template>

  <form @subit.prevent=onSubmit>
    <fieldset>
      <label>
        Correo:
      </label>
      <input v-model="email" type="email" placeholder="Correo" required name="">
    </fieldset>

    <fieldset>
      <label>
        Contraseña:
      </label>
      <input v-model="password" type="password" placeholder="Contraseña" required name="">
    </fieldset>
  
    <button @click="onSubmit(email, password)">Acceder</button>
  </form>


</template>