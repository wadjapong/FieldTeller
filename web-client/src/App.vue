<template>
  <div id="app">
    <!-- Page Loader -->
    <!-- <page-loader v-if="!isConsoleHidden"/> -->
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay" v-if="!isConsoleHidden"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <search-bar v-if="!isConsoleHidden" />
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <app-navbar v-if="!isConsoleHidden" />
    <!-- #Top Bar -->
    <section v-if="!isConsoleHidden">
      <!-- Left Sidebar -->
      <left-aside :isActive="0" />
      <!-- #END# Left Sidebar -->
      <!-- Right Sidebar -->
      <right-aside />
      <!-- #END# Right Sidebar -->
    </section>

    <section class="content" v-if="!isConsoleHidden">
      <div class="container-fluid">
        <div class="block-header">
          <!-- <h2>
                  <b>{{pageDetails.name}}</b> - 
                  {{pageDetails.description}}
              </h2> -->
        </div>

        <router-view
          @set-page-details="setPageDetails"
          @hide-console="hideConsole"
        />
      </div>
    </section>
    <router-view
      v-else
      @set-page-details="setPageDetails"
      @hide-console="hideConsole"
    />
  </div>
</template>

<script>
import SearchBar from "@/components/SearchBar";
import LeftAside from "@/components/LeftAside";
import RightAside from "@/components/RightAside";
import AppNavbar from "@/components/AppNavbar";
// import PageLoader from '@/components/PageLoader'
export default {
  name: "app",
  data() {
    return {
      pageDetails: {
        name: "",
        description: "",
      },
      workspaceName: "",
      isConsoleHidden: false,
    };
  },
  methods: {
    setPageDetails(details) {
      this.pageDetails = details;
    },
    hideConsole(data) {
      this.isConsoleHidden = data;
    },
  },
  components: {
    SearchBar,
    LeftAside,
    RightAside,
    AppNavbar,
    // PageLoader
  },
};
</script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap');

button {
  font-family: "Montserrat", sans-serif !important;
}
</style>



