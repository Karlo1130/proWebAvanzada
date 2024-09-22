<script setup>
  import { ref, onMounted } from "vue";

  const email = ref('');
  const password = ref('');
  var hasAccess = ref(false);
  const user = ref(null);
  const users = ref([]);
  const usersPropertys = ref([]);
  const addNewUserForm = ref(false);

  const newBalance = ref("");
  const newPicture = ref("");
  const newAge = ref("");
  const newName = ref("");
  const newGender = ref("");
  const newCompany = ref("");
  const newEmail = ref("");
  const newPassword = ref("");

  // Función para manejar el login
  const onSubmit = async () => {
    try {
      const response = await fetch("/users.json");

      if (!response.ok) {
        throw new Error("Error al cargar el archivo JSON");
      }

      const json = await response.json();

      json.forEach(u => {
        if (u.email === email.value) {
          if (u.password === password.value) {
            user.value = u;
            hasAccess.value = true;
  
            sessionStorage.setItem('user', JSON.stringify({
              name: u.name,
              email: u.email
            }));

            loadUsers();
          }
        }
      });

      if (!hasAccess.value) {
        alert('Acceso denegado, correo o contraseña incorrectos');
      }
    } catch (error) {
      console.error(error);
    }
  };

  // Función para cargar usuarios si hay acceso
  const loadUsers = async () => {

    if(users.value.length == 0) {
      try {
        const response = await fetch("/users.json");
  
        if (!response.ok) {
          throw new Error("Error al cargar el archivo JSON");
        }
  
        const json = await response.json();
  
        users.value = json;
  
        usersPropertys.value = Object.keys(users.value[0]);
      } catch (error) {
        console.error(error);
      }
      console.log(users.value); 

    }
    
  };

  onMounted(() => {

    const sessionUser = sessionStorage.getItem('user');
    if (sessionUser) {
      
      hasAccess.value = true;
      loadUsers();
    }
  });

  const saveNewUser = () => {
    let newUser = {
      balance: newBalance.value,
      picture: newPicture.value,
      age: newAge.value,
      name: newName.value,
      gender: newGender.value,
      company: newCompany.value,
      email: newEmail.value,
      password: newPassword.value
    };

    users.value.push(newUser);
    console.log(users.value);
    

    newBalance.value = "";
    newPicture.value = "";
    newAge.value = "";
    newName.value = "";
    newGender.value = "";
    newCompany.value = "";
    newEmail.value = "";
    newPassword.value = "";

    addNewUserForm.value = false;
  };
</script>

<template>
  <div v-if="!hasAccess">
    <form @submit.prevent="onSubmit">
      <fieldset>
        <label>Correo:</label>
        <input v-model="email" type="email" placeholder="Correo" required value="a@a.com">
      </fieldset>

      <fieldset>
        <label>Contraseña:</label>
        <input v-model="password" type="password" placeholder="Contraseña" required value="12345">
      </fieldset>

      <button type="submit">Acceder</button>
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
      <tr v-for="user in users" :key="user.Email">
        <td v-for="property in usersPropertys" style="text-align: center; border-style: solid;">{{ user[property] }}</td>
        <td style="text-align: center; border-style: solid;"><button>Modify</button></td>
        <td style="text-align: center; border-style: solid;"><button>Delete</button></td>
      </tr>
    </table>

    <div v-if="addNewUserForm">
      <form @submit.prevent="saveNewUser">
        <fieldset>
          <label>balance:</label>
          <input v-model="newBalance" type="text" required>
        </fieldset>

        <fieldset>
          <label>picture:</label>
          <input v-model="newPicture" type="text" required>
        </fieldset>

        <fieldset>
          <label>age:</label>
          <input v-model="newAge" type="text" required>
        </fieldset>

        <fieldset>
          <label>name:</label>
          <input v-model="newName" type="text" required>
        </fieldset>

        <fieldset>
          <label>gender:</label>
          <input v-model="newGender" type="text" required>
        </fieldset>

        <fieldset>
          <label>company:</label>
          <input v-model="newCompany" type="text" required>
        </fieldset>

        <fieldset>
          <label>email:</label>
          <input v-model="newEmail" type="email" required>
        </fieldset>

        <fieldset>
          <label>password:</label>
          <input v-model="newPassword" type="text" required>
        </fieldset>

        <button type="submit">Agregar</button>
      </form>
      <button type="button" @click="addNewUserForm = false">Regresar</button>
    </div>
  </div>
</template>
