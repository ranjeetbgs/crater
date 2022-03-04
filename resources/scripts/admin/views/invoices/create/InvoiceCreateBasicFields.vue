<template>
  <div class="grid grid-cols-12 gap-8 mt-6 mb-8">
    <div class="col-span-12 lg:col-span-5 ">
    <BaseCustomerSelectPopup
      v-model="invoiceStore.newInvoice.customer"
      :valid="v.customer_id"
      :content-loading="isLoading"
      type="invoice"
    />
    <BaseInputGrid class="col-span-12 md:grid-cols-2 mt-6">
      <BaseInputGroup :label="$tc('invoices.reverse_charge')">
          <BaseMultiselect
            :options="['Yes','No']"
            v-model="invoiceStore.newInvoice.reverse_charge"
            open-direction="right"
          />

        </BaseInputGroup>
        <BaseInputGroup :label="$tc('invoices.place_of_supply')">
          <BaseMultiselect
            v-model="invoiceStore.newInvoice.place_of_supply"
            :options="states"
            label="name"
            value-prop="code"
            :can-deselect="true"
            :can-clear="false"
            searchable
            track-by="name"
            open-direction="right"
          />
        </BaseInputGroup>
    </BaseInputGrid>
    </div>
    <div class="col-span-12 lg:col-span-7 ">
    <BaseInputGrid class=" md:grid-cols-3">
    <BaseInputGroup :label="$tc('invoices.type')">
          <BaseMultiselect
            :options="company.invoice_types"
            v-model="invoiceStore.newInvoice.invoice_type"
            label="label"
            value-prop="code"
            track-by="code"
            open-direction="right"
          />
        </BaseInputGroup>
        <BaseInputGroup :label="$tc('invoices.tax_format')">
          <BaseMultiselect
            :options="company.tax_formats"
            v-model="invoiceStore.newInvoice.tax_format"
            label="label"
            value-prop="code"
            track-by="code"
            open-direction="right"
          />
        </BaseInputGroup>
        <BaseInputGroup
        :label="$t('invoices.invoice_number')"
        :content-loading="isLoading"
        :error="v.invoice_number.$error && v.invoice_number.$errors[0].$message"
        required
      >
        <BaseInput
          v-model="invoiceStore.newInvoice.invoice_number"
          :content-loading="isLoading"
          @input="v.invoice_number.$touch()"
        />
      </BaseInputGroup>

      <BaseInputGroup
        :label="$t('invoices.invoice_date')"
        :content-loading="isLoading"
        required
        :error="v.invoice_date.$error && v.invoice_date.$errors[0].$message"
      >
        <BaseDatePicker
          v-model="invoiceStore.newInvoice.invoice_date"
          :content-loading="isLoading"
          :calendar-button="true"
          calendar-button-icon="calendar"
        />
      </BaseInputGroup>

      <BaseInputGroup
        :label="$t('invoices.due_date')"
        :content-loading="isLoading"
      >
        <BaseDatePicker
          v-model="invoiceStore.newInvoice.due_date"
          :content-loading="isLoading"
          :calendar-button="true"
          calendar-button-icon="calendar"
        />
      </BaseInputGroup>
      <BaseInputGroup
        :label="$t('invoices.delivery_date')"
        :content-loading="isLoading"
      >
        <BaseDatePicker
          v-model="invoiceStore.newInvoice.delivery_date"
          :content-loading="isLoading"
          :calendar-button="true"
          calendar-button-icon="calendar"
        />
      </BaseInputGroup>

      

      <BaseInputGroup
        :label="$t('invoices.ref_number')"
        :content-loading="isLoading"
      >
        <BaseInput
          v-model="invoiceStore.newInvoice.ref_number"
          :content-loading="isLoading"
        />
      </BaseInputGroup>

      <BaseInputGroup
        :label="$t('invoices.po_number')"
        :content-loading="isLoading"
      >
        <BaseInput
          v-model="invoiceStore.newInvoice.po_number"
          :content-loading="isLoading"
        />
      </BaseInputGroup>

      <BaseInputGroup
        :label="$t('invoices.chalan_number')"
        :content-loading="isLoading"
      >
        <BaseInput
          v-model="invoiceStore.newInvoice.chalan_number"
          :content-loading="isLoading"
        />
      </BaseInputGroup>

      <ExchangeRateConverter
        :store="invoiceStore"
        store-prop="newInvoice"
        :v="v"
        :is-loading="isLoading"
        :is-edit="isEdit"
        :customer-currency="invoiceStore.newInvoice.currency_id"
      />


      
    
    
    
    </BaseInputGrid>
    <div v-if="company.has_transport_option">
    <h4 class="col-span-12 mt-4 mb-2">Transport Detail</h4>
    <BaseInputGrid class=" md:grid-cols-3">
      <BaseInputGroup
        :label="$t('invoices.transport.e_way_number')"
        :content-loading="isLoading"
      >
        <BaseInput
          v-model="invoiceStore.newInvoice.e_way_number"
          :content-loading="isLoading"
        />
      </BaseInputGroup>
      <BaseInputGroup
        :label="$t('invoices.transport.gr_number')"
        :content-loading="isLoading"
      >
        <BaseInput
          v-model="invoiceStore.newInvoice.gr_number"
          :content-loading="isLoading"
        />
      </BaseInputGroup>
      <BaseInputGroup
        :label="$t('invoices.transport.id')"
        :content-loading="isLoading"
      >
        <BaseInput
          v-model="invoiceStore.newInvoice.transport_id"
          :content-loading="isLoading"
        />
      </BaseInputGroup>
      <BaseInputGroup
        :label="$t('invoices.transport.name')"
        :content-loading="isLoading"
      >
        <BaseInput
          v-model="invoiceStore.newInvoice.transport_name"
          :content-loading="isLoading"
        />
      </BaseInputGroup>
      <BaseInputGroup
        :label="$t('invoices.transport.vehicle_number')"
        :content-loading="isLoading"
      >
        <BaseInput
          v-model="invoiceStore.newInvoice.vehicle_number"
          :content-loading="isLoading"
        />
      </BaseInputGroup>
    </BaseInputGrid>
    </div>
    </div>
  </div>
</template>

<script setup>
import ExchangeRateConverter from '@/scripts/admin/components/estimate-invoice-common/ExchangeRateConverter.vue'
import { useInvoiceStore } from '@/scripts/admin/stores/invoice'
import { useCompanyStore } from '@/scripts/admin/stores/company'
import { useGlobalStore } from '@/scripts/admin/stores/global'

const props = defineProps({
  v: {
    type: Object,
    default: null,
  },
  isLoading: {
    type: Boolean,
    default: false,
  },
  isEdit: {
    type: Boolean,
    default: false,
  },
})

const invoiceStore = useInvoiceStore()
const company = useCompanyStore().selectedCompanySettings;
const states = useGlobalStore().config.states;

</script>
