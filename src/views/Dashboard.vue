<!-- Developed and connected all components, handled data flow between dashboard and form - Moath Morsy -->
<template>
  <div class="dashboard">
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
    <TransactionList :transactions="transactions" />
  </div>
</template>

<script>
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
        .reduce((sum, t) => sum + t.amount, 0);
    },
    totalExpenses() {
      return this.transactions
        .filter((t) => t.type === "expense")
        .reduce((sum, t) => sum + t.amount, 0);
    },
    categoryTotals() {
      const result = {};
      this.transactions
        .filter((t) => t.type === "expense")
        .forEach((t) => {
          result[t.category] = (result[t.category] || 0) + t.amount;
        });
      return result;
    },
    monthlyExpenses() {
      const result = {};
      this.transactions
        .filter((t) => t.type === "expense")
        .forEach((t) => {
          const month = new Date(t.date).toLocaleString("default", {
            month: "short",
          });
          result[month] = (result[month] || 0) + t.amount;
        });
      return result;
    },
  },
  mounted() {
    const stored = localStorage.getItem("transactions");
    this.transactions = stored ? JSON.parse(stored) : [];
  },
};
</script>

<style scoped>
.dashboard {
  padding: 30px;
  background-color: #121d2b;
  color: #fff;
  min-height: 100vh;
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
