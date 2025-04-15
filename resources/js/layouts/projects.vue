<template>
  <div>
    <h1>Projects</h1>
    <v-data-table v-model="projectsTable" :items="projects" :headers="headers">

    </v-data-table>
  </div>
  <v-container>
    <v-card>
      <v-card-title>
        <h1>Add Project</h1>
      </v-card-title>
      <v-card-text>
        <v-form @submit.prevent="addProject">
          <v-text-field v-model="newProject.name" label="Name of Project" placeholder="Snake"
            required></v-text-field>
            <v-select placeholder="Choose Person" v-model="newProject.client_id" :items="clients" :item-title="'name'" :item-value="'id'"></v-select>
          <v-text-field v-model="newProject.description" label="Description" placeholder="description"></v-text-field>
          
          <v-btn color="primary" type="submit">Add project</v-btn>
        </v-form>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  props: ['clientId'], // Przyjmowanie ID klienta jako props
  data() {
    return {
      projects: [],
      clients:[],
      newProject: {
        name: '',
        client_id: null,
        description: ''
      },
      projectsTable: null,

      headers: [

        { title: 'ID', value: 'id' },
        { title: 'Name', value: 'name' },
        { title: 'Client id', value: 'client_id' },
        { title: 'Description', value: 'description' }
      ]
    };
  },
  mounted() {
    this.fetchProjects()
    this.fetchClients()
  },
  methods: {
    async fetchProjects() {
      const response = await axios.get(`api/projects`)
      this.projects = response.data
    },
    addProject() {
      axios.post('api/projects', this.newProject)
        .then(response => {
          console.log('Nowy projekt dodany:', response.data);
          alert('Projekt został dodany!'); // Wyświetl informację o sukcesie
          this.newProject = {
            name: '',
            client_id: '',
            description: ''
          }; // Wyczyść formularz
        })
        .catch(error => {
          console.error('Błąd przy dodawaniu projektu:', error);
          alert('Wystąpił problem przy dodawaniu projektu.');
        });
    },
    async fetchClients() {
      const response =  await axios.get(`api/clients`)
      this.clients = response.data
      this.clients.map(item=>({
        id: item.id,
        name: item.name

      }))
    }

  }
};
</script>
