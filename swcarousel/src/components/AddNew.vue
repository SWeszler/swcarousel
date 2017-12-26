<template>
	<el-form label-width="120px">
		<el-form-item label="Title">
			<el-input v-model="object.title"></el-input>
		</el-form-item>
		<el-form-item label="url">
			<el-input v-model="object.url"></el-input>
		</el-form-item>
		<el-form-item v-if="!editmode">
			<el-button type="success" @click="addNew">Add New</el-button>
		</el-form-item>
		<el-form-item v-if="editmode">
			<el-button type="primary" @click="updateItem">Update</el-button>
		</el-form-item>
		<el-form-item v-if="object.id" :label="'Image: ' + object.id">
			<el-upload
			  drag
			  :action="RURI"
			  :on-change="sliceList"
			  :on-success="refreshList"
			  :file-list="fileList1"
			  list-type="picture"
			  :multiple="false"
			  :data="{ajax: 1, action: 'upload', id_image: object.id}">
			  <i class="el-icon-upload"></i>
			  <div class="el-upload__text">Drop file here or <em>click to upload</em></div>
			  <div class="el-upload__tip" slot="tip">jpg/png files with a size less than 500kb</div>
			</el-upload>
		</el-form-item>
	</el-form>
</template>

<script type = "text/javascript" >
	import Event from '../main.js'
	export default {
		name: 'AddNew',
		props: {
			editmode: false,
			object: {
				id: false,
				id_image: false,
				title: '',
				url: '',
				src: ''
			}
		},
		data() {
			return {
				RURI: RURI,
				fileList1: []
			}
		},
		methods: {
			addNew: function(){
				var self = this;
				$.post(RURI, {ajax: 1, action: "add-new", object: this.object}, function(d){
					var data = $.parseJSON(d);
					self.$emit('newlist', data.new_list);
					self.$emit('newobject', data.object);
				});
			},
			updateItem: function(){
				var self = this;
				self.$emit('editmodeOff');
				$.post(RURI, {ajax: 1, action: "update", object: this.object}, function(d){
					var data = $.parseJSON(d);
					self.$emit('newlist', data.new_list);
				});
			},
			sliceList: function(file, fileList) {
				var self = this;
				self.fileList1 = fileList.slice(-1);
			},
			refreshList: function() {
				var self = this;
				$.post(RURI, {ajax: 1, action: "get-all"}, function(d){
					var data = $.parseJSON(d);
					self.$emit('newlist', data.new_list);
				});
			}
		}
	};
</script>

<style lang="scss">
	.el-upload {
		&__input {
			display: none !important;
		}
	}
	.el-upload-list__item-thumbnail {
		object-fit: contain;
	}
</style>