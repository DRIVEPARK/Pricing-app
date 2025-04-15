<template>
    <v-app>
      <!-- Pasek nawigacyjny -->
      <v-app-bar app color="primary" dark>
        <v-app-bar-nav-icon @click="drawer = !drawer">
         <img src="../logo.svg" width="30px" alt="">
        </v-app-bar-nav-icon>
        <v-toolbar-title>Przykładowe Menu</v-toolbar-title>
      </v-app-bar>
  
      <!-- Menu boczne -->
      <v-navigation-drawer v-model="drawer" app>
        <v-list dense>
          <v-list-item-group>
            <v-list-item v-for="item in menuItems" :key="item.text">
              <v-list-item-icon>
                <v-icon>{{ item.icon }}</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <router-link :to="item.route">
                  <v-list-item-title>{{ item.text }}</v-list-item-title>
                </router-link>
              </v-list-item-content>
            </v-list-item>
          </v-list-item-group>
        </v-list>
      </v-navigation-drawer>
  
      <!-- Główna zawartość -->
      <v-main>
        <v-container>
          <router-view></router-view>
        </v-container>
      </v-main>
  
      <!-- Pasek narzędziowy -->
      <v-footer app>
        <span>&copy; 2024 Twoja firma</span>
      </v-footer>
    </v-app>
  </template>
  
  <script>
  export default {
    data() {
      return {
        drawer: false,
        menuItems: [
          { icon: 'mdi-home', text: 'Main Page', route: '/' },
          { icon: 'mdi-account', text: 'Clients', route: '/clients' },
          { icon: 'mdi-help-circle', text: 'Pricing', route: '/pricing' },
          { icon: 'mdi-help-circle', text: 'Projects', route: '/projects' },
        ]
      };
    }
  };
  </script>
  
  