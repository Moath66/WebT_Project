<template>
  <div id="app-layout">
    <!-- Sidebar Navigation -->
    <aside class="sidebar">
      <h2>💰 Finance App</h2>

      <router-link to="/" class="nav-btn"> 📊 Dashboard </router-link>

      <router-link to="/add" class="nav-btn purple">
        ➕ Add Transaction
      </router-link>

      <button class="clear-btn" @click="clearTransactions">
        🗑️ Clear All Data
      </button>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <router-view />
    </main>
  </div>
</template>

<script>
import axios from "axios";

export default {
  methods: {
    async clearTransactions() {
      if (confirm("Are you sure you want to clear all transactions?")) {
        try {
          await axios.delete(
            "http://localhost:8085/personal-finance-tracker_CODE/finance-backend/api/transactions/delete_all.php"
          );
          alert("✅ All transactions cleared!");
          location.reload(); // Or emit an event to refresh only
        } catch (error) {
          console.error("Clear All Error:", error);
          alert("❌ Failed to clear transactions.");
        }
      }
    },
  },
};
</script>

<style lang="scss">
#app-layout {
  display: flex;
  min-height: 100vh;
  font-family: Avenir, Helvetica, Arial, sans-serif;
  background-color: #121d2b;
  color: #ffffff;
}

/* Sidebar Styles */
.sidebar {
  width: 220px;
  background-color: #1f2a40;
  padding: 20px 25px;
  display: flex;
  flex-direction: column;
  gap: 20px;
  border-right: 2px solid #42b983;
}

.sidebar h2 {
  margin-bottom: 20px;
  font-size: 20px;
  color: #42b983;
}

/* Reusable Sidebar Button Style */
.nav-btn {
  display: block;
  text-align: center;
  padding: 10px;
  font-weight: bold;
  background-color: #2d3e50;
  border-radius: 5px;
  color: #42b983;
  text-decoration: none;
  transition: all 0.3s;
}

.nav-btn:hover {
  background-color: #364f6b;
  color: #7ee2b6;
}

.nav-btn.router-link-exact-active {
  background-color: #42b983;
  color: white;
}

/* Add Transaction in different color (optional) */
.nav-btn.purple {
  color: #b388ff;
}

.nav-btn.purple:hover {
  color: #d6b3ff;
}

/* Red Clear Button */
.clear-btn {
  margin-top: 480px;
  padding: 10px;
  background: #ff4d4f;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
  transition: background 0.3s ease;
}

.clear-btn:hover {
  background-color: #ff7875;
}

/* Main content area */
.main-content {
  flex: 1;
  padding: 30px;
}
</style>
