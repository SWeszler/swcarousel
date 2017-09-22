<template>
  <div id="app">
    <h1 class="module-name">{{ msg }}</h1>
      <el-tabs type="border-card">
      <el-tab-pane label="Shop" value="active">
        <span slot="label"><i class="el-icon-information"></i>
        Shop
        </span>
        <shop-tab></shop-tab>
      </el-tab-pane>
      <el-tab-pane label="Config">Config</el-tab-pane>
      <el-tab-pane label="Role">Role</el-tab-pane>
      <el-tab-pane label="Task">Task</el-tab-pane>
      </el-tabs>
  </div>
</template>

<script>
export default {
  name: 'app',
  data () {
    return {
      msg: ps_module,
    }
  }
}
</script>

<style lang="scss">
.el-button {
  line-height: 1 !important;
}
</style>
