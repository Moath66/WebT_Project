<!-- Developed and connected all components, handled data flow between dashboard and form - Moath Morsy -->

<template>
  <div id="app">
    <nav>
      <router-link to="/">📊 Dashboard</router-link>
      <router-link to="/update">➕ Add Transaction</router-link>
    </nav>
    <router-view />
  </div>
</template>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  background-color: #121d2b;
  min-height: 100vh;
  color: #ffffff;
}

nav {
  background-color: #1f2a40;
  padding: 20px;
  margin-bottom: 20px;
  border-bottom: 2px solid #42b983;

  a {
    font-weight: bold;
    color: #ffffff;
    margin: 0 15px;
    text-decoration: none;

    &.router-link-exact-active {
      color: #42b983;
      border-bottom: 2px solid #42b983;
      padding-bottom: 4px;
    }

    &:hover {
      color: #7ee2b6;
    }
  }
}
</style>
