<template>
  <div id="app">
    <h1 class="module-name">{{ msg }}</h1>
      <el-tabs type="border-card">
      <el-tab-pane label="Shop" name="first">
        <span slot="label"><i class="el-icon-information"></i>
        Shop
        </span>
        1. Shop name
      </el-tab-pane>
      <el-tab-pane label="Config" name="second">Config</el-tab-pane>
      <el-tab-pane label="Role" name="third">Role</el-tab-pane>
      <el-tab-pane label="Task" name="fourth">Task</el-tab-pane>
      </el-tabs>
  </div>
</template>

<script>
export default {
  name: 'app',
  data () {
    return {
      msg: ps_module
    }
  }
}
</script>

<style lang="scss">

</style>
