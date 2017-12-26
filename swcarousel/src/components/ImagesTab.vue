<template>
	<el-row :gutter="20">
	  	<el-col :span="8">
		  	<div class="grid-content">
		  		<img-list @edititem="editImageItem" @newlist="refreshList" :elements="elements"></img-list>
		  	</div>
		</el-col>
		<el-col :span="16">
			<div class="grid-content">
				<add-new :editmode="editmode" :object="object" @newlist="refreshList" @newobject="refreshObject" @editmodeOff="editmode = false"></add-new>
			</div>
		</el-col>
	</el-row>
</template>

<script type = "text/javascript">
	export default {
		name: 'ImagesTab',
		data() {
			return {
				elements: ps_img_list,
				object: {},
				editmode: false
			}
		},
		methods: {
			refreshList(val=this.elements){
				this.elements = val;
			},
			refreshObject(val){
				this.object = val;
			},
			editImageItem(val) {
				this.refreshList();
				this.editmode = true;
				this.object = val;
				this.object.id = val.id_image;
			}
		}
	};
</script>

<style>
</style>