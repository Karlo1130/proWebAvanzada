<script setup>
import { ref } from "vue";
const name = ref('')
const count = ref(0)
const num1 = ref(0)
const num2 = ref(0)
const result = ref(0)
const newUserName = ref('')
const newUserJob = ref('')

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
    addUsers(name, job) {
      this.users.push(
        {
          name: name,
          job: job
        }
      )
      console.log({
          name: name,
          job: job
        })
    }
  },
}
</script>

<template>

  <h1>nombre: {{ name }}</h1>
  
  <br>

  <input v-model="name">
  
  <br>

  <button @click="count++">Count is: {{ count }}</button>

  <br>

  <form>
    <input v-model="num1" type="number">
    <br>
    <input v-model="num2" type="number">
  </form>


  <button @click="result = parseInt(num1) + parseInt(num2)">suma</button>

  <h2>El resultado es: {{ result }}</h2>

  <br>

  <li v-for="user in users">
    Nombre: {{ user.name }} - Trabajo: {{ user.job }}
  </li>

  <form>
    <input v-model="newUserName">
    <br>
    <input v-model="newUserJob">
  </form>

  <button @click="addUsers(newUserName, newUserJob)">agregar nuevo usuario</button> 

</template>