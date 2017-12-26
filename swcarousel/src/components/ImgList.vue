<template>
	<div class="list-scroll">
		<div v-for="element in elements">
			<el-card>
		      <img :src="domain + element.src" class="image">
		      <div style="padding: 14px;">
		        <span>{{element.id_image}}. {{element.title}}</span>
		        <div class="bottom clearfix">
		          <time class="time">{{element.date_update}}</time>
		        </div>
		      </div>
		      <el-button type="primary" @click="editImage(element)">Edit</el-button>
		      <el-button type="danger" @click="confirmDelete(element.id_image)">Delete</el-button>
		    </el-card>
		</div>
	</div>
</template>

<script type = "text/javascript" >
	export default {
		name: 'ImgList',
		props: {
			elements: {}
		},
		data() {
			return {
				domain: base_uri
			}
		},
		methods: {
			editImage: function(val) {
				this.$emit('edititem', val);
			},
			confirmDelete(val) {
				var self = this;
				this.$confirm('This will permanently delete the file. Continue?', 'Warning', {
					confirmButtonText: 'OK',
					cancelButtonText: 'Cancel',
					type: 'warning'
				}).then(() => {
					var then = this;
					$.post(RURI, {ajax: 1, action: 'delete', id_image: val}, function(d){
						var data = $.parseJSON(d);
						self.$emit('newlist', data.new_list);
						if(data.status)
							then.$message({
								type: 'success',
								message: 'Delete completed'
							});
						else
							then.$message({
								type: 'error',
								message: 'Delete failed'
							});
					});
				}).catch(() => {
					this.$message({
						type: 'info',
						message: 'Delete canceled'
					});
				});
			}
		}
	};
</script>

<style lang="scss">
.image {
	max-width: 100%;
}
.list-scroll {
	max-height: 100vh;
    overflow-y: auto;
}
</style>