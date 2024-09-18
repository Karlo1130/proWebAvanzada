<script setup>
import { ref } from "vue";

const email = ref('')
const password = ref('')

const hasAccess = ref(false);
const user = ref(null)

const onSubmit = async () => {

try {
  const response = await fetch("/users.json");

  if (!response.ok) {
    throw new Error("Error al cargar el archivo JSON");
  }
  const json = await response.json();
  json.forEach(u => {
    console.log(u.email);
    if(u.email === email.value){
      if(u.password === password.value){
        user.value = u;
        hasAccess.value = true;
      }
    }
  });

  if(!hasAccess.value)(
    alert('Acceso denegado, correo o contraseña incorrectos')
  )
  } catch (error) {
  console.error(error);
  }
}
</script>


<template>

  <div v-if="!hasAccess">
    <form @submit.prevent="onSubmit">
      <fieldset>
        <label>
          Correo:
        </label>
        <input v-model="email" type="email" placeholder="Correo" required>
      </fieldset>
  
      <fieldset>
        <label>
          Contraseña:
        </label>
        <input v-model="password" type="password" placeholder="Contraseña" required>
        <label>a@a.com</label>
      </fieldset>
    
      <button type="submit">Acceder</button>
  
    </form>
  </div>

  <label v-else>Bienvenido {{ user.name }}</label>

</template>
