<template>
	<div>
		<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Posts &nbsp;
	            	<router-link to="add-post">
	            		<button class="btn btn-sm bg-success"><i class="fas fa-plus"></i> Add</button>
	            	</router-link>
	            	
	            </h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="#">Home</a></li>
	              <li class="breadcrumb-item active">Post</li>
	            </ol>
	          </div>
	        </div>
	      </div>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="container-fluid">
	        <div class="row">
	          <div class="col-12">

	            <div class="card">
	              <!-- <div class="card-header">
	                <h3 class="card-title">Post List</h3>
	                <h3 class="card-tools">
	                	<div class=" btn btn-primary">Add Post</div>
	                </h3>
	              </div> -->
	              <!-- /.card-header -->
	              <div class="card-body">
	                <table id="example1" class="table table-bordered table-striped">
	                  <thead>
	                  <tr>
	                    <th>SL</th>
	                    <th>Category</th>
	                    <th>Title</th>
	                    <th>Description</th>
	                    <th>User</th>
	                    <th>Image</th>
	                    <th>Created At</th>
	                    <th>Actions</th>
	                  </tr>
	                  </thead>
	                  <tbody>
	                  	<tr v-for="(post,index) in posts" :key="post.id">
		                  	<td>{{ index+1 }}</td>
		                    <td><span  v-if="post.category">{{ post.category.name }}</span></td>
		                    <td>{{ post.title | textshort(15,'...')}}</td>
		                    <td>{{ post.description | textshort(40,'...') }}</td>
		                    <td v-if="post.user">{{ post.user.name }}</td>
		                    <td><img style="max-height:50px; max-width:100px" :src="showImage(post.image)"></td>
		                    <td>{{ post.created_at | timeformat }}</td>
		                    <td><router-link v-bind:to="'post/' + post.id+'/edit'">Edit</router-link>
		                    	<a href="" @click.prevent="deletePost(post.id)">Delete</a>
		                    </td>
		                </tr>
		                <!-- <tr >
		                  	<td></td>
		                    <td>{{ categorie>
s }}</td>
		                    <td>Edit</td		                </tr> -->
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
			this.$store.dispatch("allPosts")
		},
		computed:{
			posts(){
				return this.$store.getters.getPost
			}
		},
		methods:{
			deletePost(id){
				swalWithBootstrapButtons.fire({
				  title: 'Are you sure?',
				  text: "You won't be able to revert this!",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonText: 'Yes, delete it!',
				  cancelButtonText: 'No, cancel!',
				  reverseButtons: true
				}).then((result) => {
				  if (result.value) {
				  	axios.get('/post/'+id)
					  	.then(()=>{
							this.$store.dispatch("allPosts")
							swalWithBootstrapButtons.fire(
						      'Deleted!',
						      'Your file has been deleted.',
						      'success'
						    )
						})
				    
				  }else if (result.dismiss === swal.DismissReason.cancel) {
				    swalWithBootstrapButtons.fire(
				      'Cancelled',
				      'Your imaginary file is safe :)',
				      'error'
				    )
				  }
				})
				// axios.get('/post/'+id)
				// 	.then(()=>{
				// 		this.$store.dispatch("allPosts")
				// 		Toast.fire({
				// 		  icon: 'success',
				// 		  title: 'Post deleted successfully'
				// 		})
				// 	})
			},
			showImage(image){
				return "public/images/"+image;
			}
		}
	}
</script>
<style scoped>
</style>