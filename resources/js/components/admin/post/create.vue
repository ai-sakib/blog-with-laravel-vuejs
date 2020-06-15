<template>
	<div>
	    <!-- Main content -->
	    <section style="margin-top:10px" class="content">
	      <div class="container-fluid">
	        <div class="row ">
	        	<!-- justify-content-around -->
	          <!-- left column -->
	          <div class="col-md-8">
	            <!-- general form elements -->
	            <div class="card card-info">
	              <div class="card-header">
	                <h3 class="card-title">Add Post</h3>
	              </div>
	              <!-- /.card-header -->
	              <!-- form start -->
	              <form role="form" enctype="multipart/form-data" method="post">
	                <div class="card-body">
	                  <div class="form-group">
	                    <label for="category_id">Category</label>
	                    <select v-model="form.category_id" class="form-control" :class="{ 'is-invalid': form.errors.has('category_id') }">
	                    	<option disabled value=""> --- Select --- </option>
	                    	<option :value="category.id" v-for="category in categories">{{ category.name }}</option>
	                    </select>
	                    <has-error :form="form" field="name"></has-error>
	                  </div>
	                  <div class="form-group">
	                    <label for="title">Title</label>
	                    <input type="text" name="title" v-model="form.title" class="form-control" id="title" placeholder="Add New Post" :class="{ 'is-invalid': form.errors.has('title') }">
	                    <has-error :form="form" field="title"></has-error>
	                  </div>
	                  <div class="form-group">
	                    <label for="description">Description</label>
	                    <textarea name="description" v-model="form.description" class="form-control" id="description" placeholder="Add New Post" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
	                    <!-- <v-md-editor v-model="form.description" height="400px"></v-md-editor> -->
	                    <has-error :form="form" field="description"></has-error>
	                  </div>
	                  <div class="form-group">
	                    <label for="image">File input</label>
		                    <div class="input-group">
		                      <div class="custom-file">
		                        <input @change="changeImage($event)" name="image" :class="{ 'is-invalid': form.errors.has('image') }" type="file" class="custom-file-input" id="image">
		                        <label class="custom-file-label" for="image">Choose file</label>
		                      </div>
		                      <div class="input-group-append">
		                        <span class="input-group-text" id="">Upload</span>
		                      </div>
		                    </div>
		                    <img :src="form.image" style="max-height: 100px; max-width: 200px">
		                    <has-error :form="form" field="image"></has-error>
	                  </div>
	                  
	                </div>
	                <!-- /.card-body -->

	                <div class="card-footer">
	                  <button type="button" @click.prevent="addPost()" class="btn btn-info">Submit</button>
	                </div>
	              </form>
	            </div>
	            <!-- /.card -->

	          </div>
	          <!--/.col (left) -->
	          
	        </div>
	        <!-- /.row -->
	      </div><!-- /.container-fluid -->
	    </section>
	</div>
</template>
<script>
	export default {
		name:"Add",
		data(){
			return{
				form: new Form({
					category_id:'',
					title:'',
					description:'',
					image:'',

				})
			}
		},
		mounted(){
			this.$store.dispatch('allCategory')
		},
		computed:{
			categories(){
				return this.$store.getters.getCategory
			}
		},
		methods: {
			changeImage(event){
				let file = event.target.files[0];
				//console.log(file.type.split('/')[0]);
				if(file.size > 4194304){
					swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Sorry, the image is too large!',
					  // footer: '<a href>Why do I have this issue?</a>'
					})
				}else if(file.type.split('/')[0] != 'image'){
					swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Sorry, the file is not image!',
					  // footer: '<a href>Why do I have this issue?</a>'
					})
				}
				else{
					let reader = new FileReader();
					reader.onload = (event)=>{
						this.form.image = event.target.result;
					}
					reader.readAsDataURL(file);
				}
				
			},

			addPost(){
				this.form.post('/add-post')
					.then((response)=>{
						this.$router.push('/post');
						Toast.fire({
						  icon: 'success',
						  title: 'Post added successfully'
						})
					})
					.catch(()=>{
						console.log('error');
					})
			}
		}
	}
</script>
<style scoped>
</style>