<template>
	<div>
		<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Category</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="#">Home</a></li>
	              <li class="breadcrumb-item active">Category</li>
	            </ol>
	          </div>
	        </div>
	      </div>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="container-fluid">
	        <div class="row ">
	        	<!-- justify-content-around -->
	          <!-- left column -->
	          <div class="col-md-8">
	            <!-- general form elements -->
	            <div class="card card-info">
	              <div class="card-header">
	                <h3 class="card-title">Edit Category</h3>
	              </div>
	              <!-- /.card-header -->
	              <!-- form start -->
	              <form role="form" >
	                <div class="card-body">
	                  <div class="form-group">
	                    <label for="name">Category Name</label>
	                    <input type="text" name="name" v-model="form.name" class="form-control" id="name" placeholder="Add New Category" :class="{ 'is-invalid': form.errors.has('name') }">
	                    <has-error :form="form" field="name"></has-error>
	                  </div>
	                  
	                </div>
	                <!-- /.card-body -->

	                <div class="card-footer">
	                  <button type="button" @click.prevent="addCategory()" class="btn btn-info">Update</button>
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
		mounted(){
			axios.get("/category/"+this.$route.params.categoryid+"/edit")
			.then((response)=>{
				this.form.fill(response.data.category)
			})
		},
		data(){
			return{
				form: new Form({
					name:'',
				})
			}
		},
		methods: {
			addCategory(){
				this.form.post("/category/"+this.$route.params.categoryid+"/update")
					.then((response)=>{
						this.$router.push('/category');
						Toast.fire({
						  icon: 'success',
						  title: 'Category updated successfully'
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