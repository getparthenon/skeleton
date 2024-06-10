<template>
  <div>
    <h2 class="text-2xl mb-4">{{ $t('app.billing.invoices.title') }}</h2>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>{{ $t('app.billing.invoices.list.amount_due') }}</th>
          <th>{{ $t('app.billing.invoices.list.created_at') }}</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="invoice in invoices">
          <td>{{ displayCurrency(invoice.amount) }} {{ invoice.currency }}</td>
          <td>{{ displayTime(invoice.created_at) }}</td>
          <td><SubmitButton :in-progress="downloadInProgress" @click="download(invoice.id)">Download</SubmitButton></td>
        </tr>
      </tbody>
    </table>
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
      invoices: [],
      downloadInProgress: false
    }
  },
  mounted() {
    axios.get("/api/billing/invoices").then((response) => {
      this.invoices = response.data.invoices;
    })
  },
  methods: {
    displayTime: function(date) {
      return moment.utc(date).local().format('YYYY-MM-DD HH:mm:ss');
    },
    displayCurrency: function (value) {
      return currency(value, { fromCents: true }).format({symbol: ''});
    },
    download: function (id) {

      this.downloadInProgress = true;
      axios.get('/api/billing/invoices/'+id+'/download', {  responseType: 'blob'}).then(response => {
        var fileDownload = require('js-file-download');
        fileDownload(response.data, 'example.pdf');
        this.downloadInProgress = false;
      }).catch(error => {
        var that = this;
        let errorString = async function getString() {
          const str = await error.response.data.text();
          const errorString = JSON.parse(str);
          that.templateError = errorString.raw_message;
          that.options.modelValue = true;
          return str;
        }
        errorString();

        this.downloadInProgress = false;
      })
    },
  }
}
</script>


<style scoped>

</style>
