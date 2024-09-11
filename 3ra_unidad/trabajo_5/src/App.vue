<script setup>
import { ref } from "vue";
const name = ref('')
const count = ref(0)
const num1 = ref(0)
const num2 = ref(0)
const result = ref(0)
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

</template>
