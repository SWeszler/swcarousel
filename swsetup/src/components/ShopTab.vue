<template>
	  <el-form label-width="120px" class="demo-ruleForm">
	    <el-form-item label="Shop name" prop="pass">
	      <el-input v-model="shopData.name"></el-input>
	    </el-form-item>
	    <el-form-item>
	      <el-button type="primary" @click="saveData">Save</el-button>
	    </el-form-item>
	  </el-form>
</template>

<script type = "text/javascript" >
	export default {
		name: 'ShopTab',
		data() {
			return {
				shopData: {
					name: ps_shop_name
				}
			}
		},
		methods: {
			saveData: function (){
				$.post(RURI, {action: "save-shop", name: this.shopData.name}, function(data){
					this.shopData = JSON.parse(data);
				}, 'json');
			}
		}
	};
</script>

<style>
</style>