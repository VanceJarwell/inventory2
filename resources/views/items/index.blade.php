@extends('layouts.master')
@section('content')
	<div class="container" id="app">
		<div style="float: right;">
  			<a class="btn btn-primary" data-toggle="modal" data-target="#additem">Add New Item</a>
		</div>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Id</th>
					<th scope="col">Name</th>
					<th scope="col">Quantity</th>
					<th scope="col">Category</th>
					<th scope="col">Actions</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				
					<tr v-for='item in items'>
						<td>@{{item.id }}</td>
						<td>@{{item.name }}</td>
						<td>@{{item.quantity }}</td>
						<td>@{{item.category }}</td>
						<td ><a class="btn btn-primary" data-toggle="modal" data-target="#edititem" v-on:click='editItem(item)'>Edit</a></td>
						<td><a class="btn btn-primary" v-on:click='deleteItem(item)'>Delete</a></td>
					</tr>
			
			</tbody>
		</table>
	<!--Add item Modal-->
	<div class="modal" id ="additem" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Add Item</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	       
		 	<div class="form-group">
		    <br>
		    <input type="text" class="form-control" v-model='new_item.name' name='name'  placeholder="Item Name">
		    <br>
		    <input type="text" class="form-control" v-model='new_item.quantity' name='quantity' v-model='quantity'  placeholder="Quantity">
		    <br>
		    <select class="custom-select custom-select-lg mb-3"  v-model='new_item.category' name ="category"> 
		    	@foreach ($category as $category)
		    	<option class="option"  value='{{ $category->name }} '>
		    		{{ $category->name }}</option>
		    	@endforeach
		    </select>
		    <br>
		  </div>
		  <button type='Submit' v-on:click="postNewItem" class="btn btn-primary">Submit</button>
		
	    </div>
	  </div>
		</div>
	</div>
	<!--Edit item Modal-->
	<div class="modal" id ="edititem" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Edit Item</h5>
	        <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	       
		 	<div class="form-group">
		    <br>
		    <input type="text" class="form-control" v-model='new_item.name' name='name' >
		    <br>
		    <input type="text" class="form-control" v-model='new_item.quantity' name='quantity'>
		    <br>
		    
		    <br>
		  </div>
		  <button type='Submit' v-on:click="updateItem" class="btn btn-primary">Submit</button>
		
	    </div>
	  </div>
		</div>
	</div>
	
	</div>
@endsection
@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script>
		var items = @json($items);
	</script>
	<script type="text/javascript">
		var vm = new Vue({
			el:'#app',
			data:{
				items:items,
				new_item: {
					id: '',
					name:'',
					quantity:'',
					category:'',
				}
			},
			methods: {
				postNewItem() {
					
					axios.post('/items/store', this.new_item)
						.then(({data})=>{
							this.items.push(data);
							this.new_item.name = '';
							this.new_item.quantity = '';
							this.new_item.category = '';
							console.log(data);
						});
				},
				editItem(item) {
					this.new_item.id=item.id;
					this.new_item.name=item.name;
					this.new_item.quantity=item.quantity;	
					this.new_item.category=item.category;

				},
				updateItem() {
					axios.post('/items/'+new_item.id+'/update')
						.then(({data})=>{
							this.new_item.name=item.name;
							this.new_item.quantity=item.quantity;	
							this.new_item.category=item.category;
							console.log(data);
						});		
				},
				
				deleteItem(item) {
					axios.post('/items/'+item.id+'/delete')
						.then(function(response){
							var index = vm.items.indexOf(item);
							vm.items.splice(index, 1);
						});
				}
			}
			
		});
	</script>
@endsection