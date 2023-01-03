<template>
    <div>
      <h1 class="page-title">{{ $t('app.billing.main.title') }}</h1>

      <div class="lg:flex mt-5 card-body">
        <div class="flex flex-col lg:w-80 border-r-1">
          <ul>
            <li><router-link :to="{name: 'app.billing.details'}">{{ $t('app.billing.main.details') }}</router-link></li>
            <li><router-link :to="{name: 'app.billing.methods'}">{{ $t('app.billing.main.methods') }}</router-link></li>
            <li>{{ $t('app.billing.main.invoices') }}</li>
          </ul>
        </div>

        <div class="w-full">
          <router-view></router-view>
        </div>

      </div>
    </div>
</template>

<script>
export default {
  name: "Billing"
}
</script>

<style scoped>

</style>
