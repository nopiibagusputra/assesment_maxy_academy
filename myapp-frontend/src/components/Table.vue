<script setup>
import { defineProps } from 'vue';

const { columns, rows, onEditRow, onDeleteRow } = defineProps(['columns', 'rows', 'onEditRow', 'onDeleteRow']);

const handleAction = (action, row) => {
  if (action === 'edit' && onEditRow) {
    onEditRow(row);
  } else if (action === 'delete' && onDeleteRow) {
    onDeleteRow(row);
  }
};
</script>

<template>
  <div class="container">
    <vue-good-table :columns="columns" :rows="rows" :search-options="{ enabled: true }"
      :pagination-options="{ enabled: true, mode: 'records' }" :line-numbers="true">
      <template #table-row="{ column, row }">
        <div v-if="column.field === 'action'" class="flex items-center">
          <button @click="handleAction('edit', row)"
            class="mr-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
            Edit
          </button>
          <button @click="handleAction('delete', row)"
            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
            Hapus
          </button>
        </div>
        <div v-else>
          {{ row[column.field] }}
        </div>
      </template>
    </vue-good-table>
  </div>
</template>

