<template>
  <div>
    <h2 class="text-2xl mb-4">{{ $t('app.billing.invoices.title') }}</h2>

    <LoadingScreen :ready="ready">
      <div v-if="supported">

        <div class="alert-error" v-if="showError">
          {{ $t('app.billing.invoices.error_message') }}
        </div>

        <table class="table table-striped">
          <thead>
          <tr>
            <th>{{ $t('app.billing.invoices.list.amount_due') }}</th>
            <th>{{ $t('app.billing.invoices.list.created_at') }}</th>
            <th>{{ $t('app.billing.invoices.list.status') }}</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="invoice in invoices">
            <td>{{ displayCurrency(invoice.amount) }} {{ invoice.currency }}</td>
            <td>{{ displayTime(invoice.created_at) }}</td>
            <td>
              <span class="badge--green" v-if="invoice.paid">{{ $t('app.billing.invoices.list.paid') }}</span>
              <span class="badge--red"  v-else>{{ $t('app.billing.invoices.list.unpaid') }}</span>
            </td>
            <td>
              <SubmitButton :in-progress="downloadInProgress" @click="download(invoice.id)" v-if="invoice.paid">{{ $t('app.billing.invoices.list.download') }}</SubmitButton>
              <SubmitButton :in-progress="downloadInProgress" @click="charge(invoice)" v-else>{{ $t('app.billing.invoices.list.charge') }}</SubmitButton>

            </td>
          </tr>
          </tbody>
        </table>
      </div>
      <div v-else>
        This feature is currently only supported if you're using <a href="https://billabear.com/?utm_source=parthenon&utm_medium=inapp" target="_blank">BillaBear</a>.
      </div>
    </LoadingScreen>
  </div>

</template>

<script>
import axios from "axios";
import currency from "currency.js";
import moment from "moment";

export default {
  name: "BillingInvoices",
  data() {
    return {
      ready: false,
      supported: true,
      invoices: [],
      downloadInProgress: false,
      showError: false,
    }
  },
  mounted() {
    axios.get("/api/billing/invoices").then((response) => {
      this.ready = true;
      this.invoices = response.data.invoices;
      this.supported = response.data.supported;
    })
  },
  methods: {
    displayTime: function(date) {
      return moment.utc(date).local().format('YYYY-MM-DD HH:mm:ss');
    },
    displayCurrency: function (value) {
      return currency(value, { fromCents: true }).format({symbol: ''});
    },
    charge: function (invoice) {

      this.downloadInProgress = true;
      this.showError = false;
      axios.post('/api/billing/invoices/'+invoice.id+'/charge').then(response => {
        invoice.paid = response.data.paid;
        this.downloadInProgress = false;
      }).catch(error => {
        this.showError= true;
        this.downloadInProgress = false;
      })
    },
    download: function (id) {

      this.downloadInProgress = true;
      this.showError = false;
      axios.get('/api/billing/invoices/'+id+'/download', {  responseType: 'blob'}).then(response => {
        var fileDownload = require('js-file-download');
        fileDownload(response.data, 'invoice-'+id+'.pdf');
        this.downloadInProgress = false;
      }).catch(error => {
        var that = this;
        let errorString = async function getString() {
          const str = await error.response.data.text();
          const errorString = JSON.parse(str);
          return str;
        }
        errorString();

        this.showError= true;
        this.downloadInProgress = false;
      })
    },
  }
}
</script>


<style scoped>

</style>
