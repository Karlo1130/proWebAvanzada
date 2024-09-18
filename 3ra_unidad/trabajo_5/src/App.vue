<script setup>
  import { ref, onMounted } from "vue";

  const email = ref('')
  const password = ref('')

  const hasAccess = ref(false);
  const user = ref(null)
  const users = ref([])
  const usersPropertys = ref([])
  const addNewUserForm = ref(false)

  const newBalance = ref("")
  const newPicture = ref("")
  const newAge = ref("")
  const newName = ref("")
  const newGender = ref("")
  const newCompany = ref("")
  const newEmail = ref("")
  const newPassword = ref("")

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

  const addNewUser = () => {

    let newUser = {
      
      Balance : newBalance.value,
      Picture : newPicture.value,
      Age : newAge.value,
      Name : newName.value,
      Gender : newGender.value,
      Company : newCompany.value,
      Email : newEmail.value,
      Password : newPassword.value

    }

    console.log(newUser);
    console.log(users.value);
    
    

    users.value.push(newUser)

    newBalance.value = "";
    newPicture.value = "";
    newAge.value = "";
    newName.value = "";
    newGender.value = "";
    newCompany.value = "";
    newEmail.value = "";
    newPassword.value = "";
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
    
      <button type="submit">Acceder</button>a@a.com
  
    </form>
  </div>

  <div v-else>

    <button v-if="!addNewUserForm" @click="addNewUserForm = true">Add</button>

    <table v-if="!addNewUserForm">
      <tr>
        <th v-for="property in usersPropertys" style="text-align: center; border-style: solid;">{{ property }}</th>
        <th style="text-align: center; border-style: solid;">Modify button</th>
        <th style="text-align: center; border-style: solid;">Delete button</th>

      </tr>
      <tr v-for="user in users">
        <th style="text-align: center; border-style: solid;">{{ user.name }}</th>
        <th style="text-align: center; border-style: solid;"><button>Modify</button></th>
        <th style="text-align: center; border-style: solid;"><button>Delete</button></th>
      </tr>

    </table>

    <div v-if="addNewUserForm" >
      
      <form @submit.prevent="addNewUser">
        <fieldset>
          <label>
            balance:
          </label>
          <input v-model="newBalance" type="text" placeholder="" required>
        </fieldset>
    
        <fieldset>
          <label>
            picture:
          </label>
          <input v-model="newPicture" type="text" placeholder="" required>
        </fieldset>
  
        <fieldset>
          <label>
            age:
          </label>
          <input v-model="newAge" type="text" placeholder="" required>
        </fieldset>
  
        <fieldset>
          <label>
            name:
          </label>
          <input v-model="newName" type="text" placeholder="" required>
        </fieldset>
  
        <fieldset>
          <label>
            gender:
          </label>
          <input v-model="newGender" type="text" placeholder="" required>
        </fieldset>
  
        <fieldset>
          <label>
            company:
          </label>
          <input v-model="newCompany" type="text" placeholder="" required>
        </fieldset>
  
        <fieldset>
          <label>
            email:
          </label>
          <input v-model="newEmail" type="text" placeholder="" required>
        </fieldset>
  
        <fieldset>
          <label>
            password:
          </label>
          <input v-model="newPassword" type="text" placeholder="" required>
        </fieldset>
      
        <button type="submit">agregar</button>
        
      </form>
      <button type="button" @click="addNewUserForm = false">regresar</button>
    </div>

  </div>

</template>
