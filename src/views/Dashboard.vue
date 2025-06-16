<!-- Contributed by Moath Morsy – Final UI-integrated Dashboard.vue -->
<template>
  <div class="app-layout">
    <!-- Main Dashboard Area -->
    <main class="dashboard">
      <h2>📊 Personal Finance Dashboard</h2>

      <!-- Summary Cards -->
      <div class="cards">
        <SummaryCard title="Income" :amount="totalIncome" />
        <SummaryCard title="Expenses" :amount="totalExpenses" />
        <SummaryCard title="Balance" :amount="totalIncome - totalExpenses" />
      </div>

      <!-- Charts Section -->
      <div class="charts">
        <SpendingChart :data="categoryTotals" />
        <SpendingTrend :monthlyData="monthlyExpenses" />
      </div>

      <!-- Recent Transactions -->
      <TransactionList
        :transactions="transactions"
        @refresh="fetchTransactions"
      />
    </main>
  </div>
</template>

<script>
import axios from "axios";
import SummaryCard from "@/components/SummaryCard.vue";
import SpendingChart from "@/components/SpendingChart.vue";
import SpendingTrend from "@/components/SpendingTrend.vue";
import TransactionList from "@/components/TransactionList.vue";

export default {
  name: "Dashboard",
  components: {
    SummaryCard,
    SpendingChart,
    SpendingTrend,
    TransactionList,
  },
  data() {
    return {
      transactions: [],
    };
  },
  computed: {
    totalIncome() {
      return this.transactions
        .filter((t) => t.type === "income")
        .reduce((sum, t) => sum + Number(t.amount), 0);
    },
    totalExpenses() {
      return this.transactions
        .filter((t) => t.type === "expense")
        .reduce((sum, t) => sum + Number(t.amount), 0);
    },
    categoryTotals() {
      const result = {};
      this.transactions
        .filter((t) => t.type === "expense")
        .forEach((t) => {
          result[t.category] = (result[t.category] || 0) + Number(t.amount);
        });
      return result;
    },
    monthlyExpenses() {
      const result = {};
      this.transactions
        .filter((t) => t.type === "expense")
        .forEach((t) => {
          const date = new Date(t.date);
          const month = date.toLocaleString("default", {
            month: "short",
            year: "numeric",
          });
          result[month] = (result[month] || 0) + Number(t.amount);
        });
      return result;
    },
  },
  mounted() {
    this.fetchTransactions();
  },
  methods: {
    async fetchTransactions() {
      try {
        const res = await axios.get(
          "http://localhost:8085/personal-finance-tracker_CODE1/finance-backend/api/transactions/get.php"
        );
        if (res.data.success) {
          this.transactions = res.data.data;
        } else {
          console.error("API returned failure:", res.data.message);
        }
      } catch (err) {
        console.error("Failed to fetch transactions:", err);
      }
    },
  },
};
</script>

<style scoped>
.app-layout {
  display: flex;
  min-height: 100vh;
  background-color: #121d2b;
  color: #fff;
  font-family: Avenir, Helvetica, Arial, sans-serif;
}

/* Sidebar */
.sidebar {
  width: 220px;
  background-color: #1f2a40;
  padding: 20px;
  display: flex;
  flex-direction: column;
  gap: 15px;
  border-right: 2px solid #42b983;
}

.sidebar .logo {
  font-size: 24px;
  font-weight: bold;
  color: #42b983;
  margin-bottom: 30px;
}

.sidebar a {
  color: #ffffff;
  text-decoration: none;
  font-weight: bold;
  transition: color 0.3s;
}

.sidebar a.router-link-exact-active {
  color: #42b983;
}

.sidebar button {
  background: transparent;
  color: #f56c6c;
  border: 1px solid #f56c6c;
  padding: 8px 12px;
  cursor: pointer;
  font-weight: bold;
  border-radius: 5px;
  transition: all 0.3s ease;
}

.sidebar button:hover {
  background-color: #f56c6c;
  color: #fff;
}

/* Main dashboard area */
.dashboard {
  flex: 1;
  padding: 30px;
  background-color: #121d2b;
}

.cards {
  display: flex;
  justify-content: space-around;
  margin-bottom: 30px;
  flex-wrap: wrap;
  gap: 20px;
}

.charts {
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
  gap: 20px;
  margin-bottom: 40px;
}
</style>
