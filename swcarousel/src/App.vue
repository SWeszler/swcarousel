<template>
  <div id="app">
    <h1 class="module-name">{{ t_name }}</h1>
      <el-tabs type="border-card">
        <el-tab-pane label="Images">
          <span slot="label"><i class="el-icon-information"></i>
          Images
          </span>
          <images-tab></images-tab>
        </el-tab-pane>
        <el-tab-pane label="Settings">
          <span slot="label"><i class="el-icon-setting"></i>
          Settings
          </span>
          <setting-tab></setting-tab>
        </el-tab-pane>
      </el-tabs>
  </div>
</template>

<script>
export default {
  name: 'app',
  data () {
    return {
      t_name: ps_module
    }
  }
}
</script>

<style lang="scss">
.el-button {
  line-height: 1 !important;
  border-radius: 100px;
}
.el-card {
  margin-bottom: 20px;
}
</style>
