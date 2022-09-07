<template>
  <div class="lg:flex  main-background">
    <div class="dashboard-sidebar menu-background">
      <Menu>
        <MenuGroup :name="$t('app.menu.main.title')">
          <MenuItem route-name="app.home"><i class="fa-solid fa-house"></i> {{ $t('app.menu.main.home') }}</MenuItem>
          <MenuItem route-name="app.team"><i class="fa-solid fa-user"></i> {{ $t('app.menu.main.team') }}</MenuItem>
        </MenuGroup>
      </Menu>
    </div>
    <div class="w-full h-full lg:p-4 lg:m-8 p-2 overflow-y-auto">
      <router-view></router-view>
    </div>
  </div>

</template>

<script>
export default {
  name: "InternalApp"
}
</script>

<style scoped>

</style>