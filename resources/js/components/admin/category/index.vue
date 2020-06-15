<template>
	<div>
		<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Category &nbsp;
	            	<router-link to="add-category">
	            		<button class="btn btn-sm bg-success"><i class="fas fa-plus"></i> Add</button>
	            	</router-link>
	            	
	            </h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="#">Home</a></li>
	              <li class="breadcrumb-item active">Category</li>
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="container-fluid">
	        <div class="row">
	          <div class="col-12">

	            <div class="card">
	              <div class="card-header">
	                <h3 class="card-title">Category List</h3>
	                <!-- <h3 class="card-tools">
	                	<div class=" btn btn-primary">Add Category</div>
	                </h3> -->
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body">
	                <table id="example1" class="table table-bordered table-striped">
	                  <thead>
	                  <tr>
	                    <th>SL</th>
	                    <th>Category Name</th>
	                    <th>Created At</th>
	                    <th>Actions</th>
	                  </tr>
	                  </thead>
	                  <tbody>
	                  	<tr v-for="(category,index) in categories" :key="category.id">
		                  	<td>{{ index+1 }}</td>
		                    <td>{{ category.name }}</td>
		                    <td>{{ category.created_at | timeformat }}</td>
		                    <td><router-link v-bind:to="'category/' + category.id+'/edit'">Edit</router-link>
		                    	<a href="" @click.prevent="deleteCategory(category.id)">Delete</a>
		                    </td>
		                </tr>
		                <!-- <tr >
		                  	<td></td>
		                    <td>{{ categories }}</td>
		                    <td>Edit</td>
		                </tr> -->
	                  </tbody>
	                  
	                </table>
	              </div>
	              <!-- /.card-body -->
	            </div>
	            <!-- /.card -->
	          </div>
	          <!-- /.col -->
	        </div>
	        <!-- /.row -->
	      </div>
	      <!-- /.container-fluid -->
	    </section>
	</div>
</template>
<script>
	export default {
		name:"List",
		mounted(){
			this.$store.dispatch("allCategory")
		},
		computed:{
			categories(){
				return this.$store.getters.getCategory
			}
		},
		methods:{
			deleteCategory(id){
				axios.get('/category/'+id)
					.then(()=>{
						this.$store.dispatch("allCategory")
						Toast.fire({
						  icon: 'success',
						  title: 'Category deleted successfully'
						})
					})
			}
		}
	}
</script>
<style scoped>
</style>