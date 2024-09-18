<script setup>
  import { ref, onMounted } from "vue";

  const email = ref('')
  const password = ref('')

  const hasAccess = ref(false);
  const user = ref(null)
  const users = ref(null)
  const usersPropertys = ref([])

  const onSubmit = async () => {

    try {
      const response = await fetch("/users.json");

      if (!response.ok) {
        throw new Error("Error al cargar el archivo JSON");
      }

      const json = await response.json();

      json.forEach(u => {
        if(u.email === email.value){
          if(u.password === password.value){
            user.value = u;
            hasAccess.value = true;

            for(var i in user.value){
              usersPropertys.value.push(i)
            }

            sessionStorage.setItem('user', JSON.stringify(u));
          }
        }
      });

      if(hasAccess.value){
        users.value = json
      }

      if(!hasAccess.value){
        alert('Acceso denegado, correo o contraseña incorrectos')
      }
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
      </fieldset>
    
      <button type="submit">Acceder</button>
  
    </form>
  </div>

  <div v-else>

    <table>
      <tr>
        <th v-for="property in usersPropertys" style="text-align: center; border-style: solid;">{{ property }}</th>
        <th style="text-align: center; border-style: solid;">Modify button</th>
        <th style="text-align: center; border-style: solid;">Delete button</th>

      </tr>
      <tr v-for="user in users">
        <th v-for="property in usersPropertys" style="text-align: center; border-style: solid;">{{ user[property] }}</th>
        <th style="text-align: center; border-style: solid;"><button>Modify</button></th>
        <th style="text-align: center; border-style: solid;"><button>Delete</button></th>
      </tr>
      

    </table>

  </div>

</template>
