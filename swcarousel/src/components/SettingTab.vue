<template>
	<el-row :gutter="20">
	  	<el-col :span="12">
		  	<div class="grid-content">
		  		{{t_autoplay}}
				<el-switch
				v-model="settings.autoplay"
				on-color="#13ce66"
				off-color="#ff4949">
				</el-switch>
		  	</div>
		</el-col>
		<el-col :span="12">
			<div class="grid-content">
				
			</div>
		</el-col>
	</el-row>
</template>

<script type = "text/javascript" >
	export default {
		name: 'SettingTab',
		data() {
			return {
				t_autoplay: ps_autoplay,
				settings: {
					autoplay: autoplay
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