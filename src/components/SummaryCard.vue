<!-- SummaryCard.vue - Contributed by Mohammed Salghi -->
<template>
  <div class="summary-card" :class="type">
    <h3>{{ title }}</h3>
    <p class="amount">{{ formattedAmount }}</p>
  </div>
</template>

<script>
export default {
  name: "SummaryCard",
  props: {
    title: String,
    amount: Number,
    type: {
      type: String, // "income", "expense", "balance"
      default: "balance",
    },
  },
  computed: {
    formattedAmount() {
      return "RM " + Number(this.amount).toFixed(2);
    },
  },
};
</script>

<style scoped>
.summary-card {
  padding: 20px;
  border-radius: 12px;
  color: #ffffff;
  min-width: 220px;
  text-align: left;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  transition: 0.3s;
}

/* Themed backgrounds */
.summary-card.income {
  background: linear-gradient(135deg, #27ae60, #2ecc71);
}
.summary-card.expense {
  background: linear-gradient(135deg, #c0392b, #e74c3c);
}
.summary-card.balance {
  background: linear-gradient(135deg, #2980b9, #3498db);
}

.summary-card h3 {
  font-size: 1.2rem;
  font-weight: 600;
  margin-bottom: 10px;
}

.summary-card .amount {
  font-size: 1.8rem;
  font-weight: bold;
}
</style>
