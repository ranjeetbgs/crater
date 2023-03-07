<template>


      <div
        v-if="userStore.hasAbilities(abilities.VIEW_INVOICE)"
        class="mt-6"
        style="zoom:95%"
      >
        <div class="relative z-10 flex items-center justify-between mb-3">
          <h6 class="mb-0 text-xl font-semibold leading-normal">
            Ledger
          </h6>

          
        </div>
  
        <BaseTable
          :data="customerStore.selectedViewCustomer.ledger"
          :columns="ledgerColumns"
          :loading="customerStore.isFetchingViewData"
        >
          
        <template #cell-notes="{ row }">
        <span v-html="row.data.notes" :title="row.data.notes"></span>
        </template>

          <template #cell-credit="{ row }">
            <BaseFormatMoney
              :amount="row.data.credit" v-if="row.data.credit"
              :currency="customerStore.selectedViewCustomer.currency"
            />
          </template>

          <template #cell-debit="{ row }">
            <BaseFormatMoney v-if="row.data.debit"
              :amount="row.data.debit"
              :currency="customerStore.selectedViewCustomer.currency"
            />
          </template>

         
        </BaseTable>
      </div>

    
</template>

<script setup>
import { computed, ref } from 'vue'
import { useCustomerStore } from '@/scripts/admin/stores/customer'
import { useI18n } from 'vue-i18n'
import { useUserStore } from '@/scripts/admin/stores/user'
import abilities from '@/scripts/admin/stub/abilities'

const customerStore = useCustomerStore()

const { t } = useI18n()
const userStore = useUserStore()



const ledgerColumns = computed(() => {
  return [
    {
      key: 'id',
      label: t('dashboard.recent_invoices_card.due_on'),
      sortable: false,
    },
    {
      key: 'formatted_date',
      label: 'Date',
      sortable: false,
    },
    {
      key: 'notes',
      label: 'Note',
      thClass: 'extra w-10 pr-0',
      tdClass: 'truncate max-w-xs',
      sortable: false,
    },
    {
      key: 'credit',
      label: 'Credit',
      sortable: false,
    },
    {
      key: 'debit',
      label: 'Debit',
      sortable: false,
    },

   
  ]
})



</script>
