<!-- Contributed by Yusuf Zain: Developed the transaction list layout with dynamic rendering -->
<template>
  <div class="transaction-list">
    <h4>🧾 Recent Transactions</h4>
    <ul>
      <li v-for="t in transactions" :key="t.id">
        <span class="date">{{ t.date }}</span>
        <span class="category">{{ t.category }}</span>
        <span :class="t.type"
          >{{ t.type === "income" ? "+" : "-" }}RM
          {{ t.amount.toFixed(2) }}</span
        >
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "TransactionList",
  props: ["transactions"],
};
</script>

<style scoped>
.transaction-list {
  background: #1f2a40;
  color: #fff;
  padding: 20px;
  border-radius: 10px;
  margin-bottom: 30px;
}
.transaction-list ul {
  list-style: none;
  padding: 0;
}
.transaction-list li {
  display: flex;
  justify-content: space-between;
  padding: 8px 0;
  border-bottom: 1px solid #444;
}
.transaction-list .income {
  color: #4caf50;
}
.transaction-list .expense {
  color: #f44336;
}
</style>
