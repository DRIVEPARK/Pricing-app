<template>
  <div>
    <h1>Pricings</h1>
    <v-container>
      <v-select placeholder="Choose Person" v-model="filterClient" :items="clients" :item-title="'name'" :item-value="'id'"
        @update:modelValue="updatePricingClient"></v-select>
      <v-text-field v-model="filterDateFrom" label="From Date(YYYY-MM-DD)" placeholder="2024-01-01"></v-text-field>
      <v-text-field v-model="filterDateTo" label="To Date(YYYY-MM-DD)" placeholder="2024-12-31"></v-text-field>
      <v-btn color="primary" @click="filterByData">Filter By Date</v-btn>
    </v-container>
    <v-data-table v-model="pricingTable" :items="pricingView" :headers="headers">

    </v-data-table>
  </div>
  <p>Summary of amounts: {{ summary }}</p><br>
  <v-container>
    <v-card>
      <v-card-title>
        <h1>Add Pricing</h1>
      </v-card-title>
      <v-card-text>
        <v-form @submit.prevent="addPricing">
          <v-select placeholder="Choose Person" v-model="newPricing.client_id" :items="clients" :item-title="'name'" :item-value="'id'"
            @update:modelValue="clientUpdate"></v-select>
          <v-select placeholder="Choose Project" v-model="newPricing.project_id" :items="projectsView" :item-title="'name'" :item-value="'id'">
          </v-select>
          <v-text-field v-model="newPricing.description" label="Description" placeholder="description"></v-text-field>
          <v-text-field v-model="newPricing.amount" label="Amount" placeholder="10000"></v-text-field>

          <v-btn color="primary" type="submit">Add pricing</v-btn>
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
      pricing: [],
      pricingView: [],
      summary: 0,
      filterClient: null,
      filterDateFrom: '',
      filterDateTo: '',
      projects: [],
      projectsView: [],
      clients: [],

      pricingTable: null,
      newPricing: {
        id: '',
        description: '',
        amount: 0,
        project_id: null,
        client_id: null,
      },
      //['id','description', 'amount',
      headers: [

        { title: 'ID', value: 'id' },
        { title: 'Description', value: 'description' },
        { title: 'Amount', value: 'amount' },
        { title: 'Project id', value: 'project_id' },
        { title: 'Client id', value: 'client_id' },
        { title: 'Created at', value: 'created_at' }
      ]
    };
  },
  mounted() {
    this.fetchPricing()
    this.fetchClients()
    this.fetchProjects()
  },
  methods: {
    async fetchPricing() {
      const response = await axios.get(`api/pricing`)
      this.pricing = response.data.map(item => ({
        id: item.id,
        description: item.description,
        amount: item.amount,
        project_id: item.project_id,
        client_id: item.client_id,
        created_at: item.created_at.split('T')[0]
      }))
      this.pricingView = this.pricing
      this.summaryUpdate()
    },
    clientUpdate() {
      this.projectsView = this.projects.filter(item => item.client_id == this.newPricing.client_id)
      console.log("e many")

    },
    summaryUpdate(){
      this.summary = 0
      for (let i = 0; i < this.pricingView.length;i++){
        this.summary += parseFloat( this.pricingView[i].amount)
      }
      console.log(this.pricingView)
      
    },
    filterByData() {
      if (this.filterClient) {
        this.pricingView = this.pricingView.filter(item => {
          const itemDate = item.created_at.split('T')[0];
          return itemDate >= this.filterDateFrom && itemDate <= this.filterDateTo;
        })

      }
      else{
        this.pricingView = this.pricing.filter(item => {
          const itemDate = item.created_at.split('T')[0];
          return itemDate >= this.filterDateFrom && itemDate <= this.filterDateTo;
        })
      }
      summaryUpdate()
    },
    updatePricingClient() {
      this.pricingView = this.pricing.filter(item => item.client_id == this.filterClient)
      this.summaryUpdate()
    },
    async fetchProjects() {
      const response = await axios.get(`api/projects`)
      this.projects = response.data
      this.pricing.map(item => ({
        id: item.id,
        name: item.name

      }))
    },
    async fetchClients() {
      const response = await axios.get(`api/clients`)
      this.clients = response.data
      this.clients.map(item => ({
        id: item.id,
        name: item.name

      }))
    },
    addPricing() {
      axios.post(`api/pricing`, this.newPricing)
        .then(response => {
          console.log('Nowy projekt dodany:', response.data);
          alert('Projekt został dodany!'); // Wyświetl informację o sukcesie
          this.newProject = {
            id: '',
            amount: 0,
            description: ''
          }; // Wyczyść formularz
        })
        .catch(error => {
          console.error('Błąd przy dodawaniu projektu:', error);
          alert('Wystąpił problem przy dodawaniu projektu.');
        });
    }
  }
};
</script>