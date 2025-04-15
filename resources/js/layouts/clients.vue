<template>
  <v-container>
    <v-card>
      <v-card-title>
        <h1>Klienci</h1>
      </v-card-title>
      <v-card-text>
        <v-data-table :headers="headers" :items="clients" class="elevation-1" :search="search" :items-per-page="10">
          <template v-slot:top>
            <v-toolbar flat>
              <v-toolbar-title>Lista Klientów</v-toolbar-title>
              <v-divider inset vertical></v-divider>
              <v-spacer></v-spacer>
              <v-text-field v-model="search" label="Szukaj" class="mx-4" solo></v-text-field>
              <v-btn @click="fetchClients">Odśwież</v-btn>
            </v-toolbar>
          </template>
        </v-data-table>
      </v-card-text>
    </v-card>
  </v-container>
  <v-container>
    <v-card>
      <v-card-title>
        <h1>Add Client</h1>
      </v-card-title>
      <v-card-text>
        <v-form @submit.prevent="addClient">
          <v-text-field v-model="newClient.name" label="Imię i nazwisko" placeholder="John Kowalski"
            required></v-text-field>
          <v-text-field v-model="newClient.email" label="Adres e-mail" placeholder="johndoe@gmail.com" type="email"
            required></v-text-field>
          <v-text-field v-model="newClient.company_name" label="Nazwa firmy" placeholder="XYZ z.o.o"></v-text-field>
          <v-text-field v-model="newClient.address" label="Adres"
            placeholder="John Doe, 456 Elm Street, Suite 3, Los Angeles, CA 90001, USA"></v-text-field>
          <v-btn color="primary" type="submit">Dodaj klienta</v-btn>
        </v-form>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      newClient: {
        name: '',
        email: '',
        company_name: '',
        address: ''
      },
      clients: [],
      search: '',
      headers: [

        { title: 'ID', value: 'id' },
        { title: 'Nazwa', value: 'name' },
        { title: 'Email', value: 'email' },
        { title: 'Firma', value: 'company_name' },
        { title: 'Adres', value: 'address' }
      ]
    };
  },
  created() {
    this.fetchClients();
  },
  mounted(){
    console.log(this.headers)
  },
  methods: {
    async fetchClients() {
      const response =  await axios.get(`api/clients`)
      this.clients = response.data
    },
    addClient() {
      axios.post('api/clients', this.newClient)
        .then(response => {
          console.log('Nowy klient dodany:', response.data);
          alert('Klient został dodany!'); // Wyświetl informację o sukcesie
          this.newClient = { name: '', email: '', company_name: '', address: '' }; // Wyczyść formularz
        })
        .catch(error => {
          console.error('Błąd przy dodawaniu klienta:', error);
          alert('Wystąpił problem przy dodawaniu klienta.');
        });
    }
  }
};
</script>

<!--
data() {
  return {
      client: null // Zmienna na przechowywanie danych klienta
  };
},
methods: {
  addClient() {
      axios.post('http://localhost/api/clients', {
          name: 'John Doe',
          email: 'john.doe@example.com',
          company_name: 'Firma XYZ',
          address: '123 Main St'
      })
      .then(response => {
          this.client = response.data; // Przypisanie odpowiedzi do zmiennej client
          console.log('Dodano klienta:', this.client);
      })
      .catch(error => {
          console.error('Błąd przy dodawaniu klienta:', error.response || error.message);
      });
  }
}-->