<template>
    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>

                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">User ID</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="!users.length">
                                    <td colspan="5" style="vertical-align: middle;" align="center">No data available.</td>
                                </tr>
                                <tr v-for="user in users" :key="user.id">
                                    <th scope="row">{{ user.id }}</th>
                                    <td>{{ user.username }}</td>
                                    <td>{{ user.first_name }}</td>
                                    <td>{{ user.last_name }}</td>
                                    <td>
                                        <a href="#" @click.prevent="showEditForm(user)">Edit</a> / <a href="#" @click.prevent="showConfirmDelete(user)">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button @click="showCreateUserForm" type="button" class="btn btn-default">Add New User</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create User Modal -->
        <div class="modal fade" id="modal-create-user" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Create User
                        </h4>
                    </div>

                    <div class="modal-body">
                    	<!-- Form Success -->
		                <div class="alert alert-success" v-if="createForm.success">
		                    <p>{{ createForm.success }}</p>
		                </div>

                        <!-- Form Errors -->
                        <div class="alert alert-danger" v-if="createForm.errors.length || createForm.message">
                            <p>{{ createForm.message }}</p>
                            <div  v-if="createForm.errors.length">
                                <br>
                                <ul>
                                    <li v-for="(error, index) in createForm.errors" :key="index">
                                        {{ error }}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Create User Form -->
                        <form class="form-horizontal" role="form">
                            <!-- First Name -->
                            <div class="form-group">
                                <label class="col-md-4 control-label">First Name</label>

                                <div class="col-md-6">
                                    <input id="create-user-last-name" type="text" class="form-control" 
                                        @keyup.enter="createUser" v-model="createForm.first_name">
                                </div>
                            </div>
                            <!-- Last Name -->
                            <div class="form-group">
                                <label class="col-md-4 control-label">Last Name</label>

                                <div class="col-md-6">
                                    <input id="create-user-first-name" type="text" class="form-control" 
                                        @keyup.enter="createUser" v-model="createForm.last_name">
                                </div>
                            </div>
                            <!-- Username -->
                            <div class="form-group">
                                <label class="col-md-4 control-label">Username</label>

                                <div class="col-md-6">
                                    <input id="create-user-username" type="text" class="form-control" 
                                        @keyup.enter="createUser" v-model="createForm.username">
                                </div>
                            </div>

                            <!-- New Password -->
                            <div class="form-group">
                                <label class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="create-user-password" 
                                        @keyup.enter="createUser" v-model="createForm.password">
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click="createUser" :disabled="loading">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit User Modal -->
        <div class="modal fade" id="modal-edit-user" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Edit User
                        </h4>
                    </div>

                    <div class="modal-body">
                    	<!-- Form Success -->
		                <div class="alert alert-success" v-if="editForm.success">
		                    <p>{{ editForm.success }}</p>
		                </div>

                        <!-- Form Errors -->
                        <div class="alert alert-danger" v-if="editForm.errors.length || editForm.message">
                            <p>{{ editForm.message }}</p>
                            <div v-if="editForm.errors.length">
                                <br>
                                <ul>
                                    <li v-for="(error, index) in editForm.errors" :key="index">
                                        {{ error }}
                                    </li>
                                </ul>    
                            </div>
                        </div>

                        <!-- Edit User Form -->
                        <form class="form-horizontal" role="form">
                            <!-- First Name -->
                            <div class="form-group">
                                <label class="col-md-4 control-label">First Name</label>

                                <div class="col-md-6">
                                    <input id="edit-user-first-name" type="text" class="form-control" 
                                        @keyup.enter="updateUser" v-model="editForm.first_name">
                                </div>
                            </div>
                            <!-- Last Name -->
                            <div class="form-group">
                                <label class="col-md-4 control-label">Last Name</label>

                                <div class="col-md-6">
                                    <input id="edit-user-first-last-name" type="text" class="form-control" 
                                        @keyup.enter="updateUser" v-model="editForm.last_name">
                                </div>
                            </div>
                            <!-- Username -->
                            <div class="form-group">
                                <label class="col-md-4 control-label">Username</label>

                                <div class="col-md-6">
                                    <input id="edit-user-username" type="text" class="form-control" 
                                        @keyup.enter="updateUser" v-model="editForm.username">
                                </div>
                            </div>
                            <!-- New Password -->
                            <div class="form-group">
                                <label class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="edit-user-password" 
                                        @keyup.enter="updateUser" v-model="editForm.password" :disabled="!change_password">
                                    <div class="checkbox">
                                        <label><input type="checkbox" v-model="change_password">Change Password</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click="updateUser" :disabled="loading">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete User Modal -->
        <div class="modal fade" id="modal-delete-user" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Delete User
                        </h4>
                    </div>

                    <div class="modal-body">
                    	<!-- Form Success -->
                        <div class="alert alert-success" v-if="destroyForm.success">
                            <p>{{ destroyForm.success }}</p>
                        </div>

                        <!-- Form Errors -->
                        <div class="alert alert-danger" v-if="destroyForm.errors.length || destroyForm.message">
                            <p>{{ destroyForm.message }}</p>
                            <div v-if="destroyForm.errors.length">
                                <br>
                                    <ul>
                                        <li v-for="(error, index) in destroyForm.errors" :key="index">
                                            {{ error }}
                                        </li>
                                    </ul>
                            </div>
                        </div>
                        <p>Are you sure you want to delete <i><strong>{{ destroyForm.first_name }} {{ destroyForm.last_name }}</strong></i>?</p>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-danger" :disabled="loading" @click="destroyUser">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loading: false,
                change_password: false,
                createForm: {
                    errors: [],
                    message: '',
                    success: '',
                    first_name: '',
                    last_name: '',
                    username: '',
                    password: ''
                },
                editForm: {
                    errors: [],
                    message: '',
                    success: '',
                    first_name: '',
                    last_name: '',
                    username: '',
                    password: ''
                },
                destroyForm: {
                	errors: [],
                	message: '',
                	success: '',
                	id: null,
                    first_name: '',
                    last_name: ''
                },
                users: []
            }
        },
        ready() {
            this.prepareComponent();
        },
		mounted() {
            this.prepareComponent();
        },
        methods: {
            prepareComponent() {
                this.getUsers();
            },
            getUsers() {
				axios.get(`/users`)
	                .then((response) => {
	                    this.users = response.data.users;
	                })
	                .catch(() => {
	                    console.log('handle server error from here');
	                });
            },
            showCreateUserForm() {
            	this.createForm = {
                    errors: [],
                    message: '',
                    success: '',
                    first_name: '',
                    last_name: '',
                    username: '',
                    password: ''
                };

            	$('#modal-create-user').modal('show');
            },
            showEditForm(user) {
                this.editForm = {};
                this.editForm.errors = [];
                this.editForm.message = '';
                this.editForm.success = '';

                this.editForm.id = user.id;
                this.editForm.first_name = user.first_name;
                this.editForm.last_name = user.last_name;
                this.editForm.username = user.username;
                this.editForm.password = '';

                this.change_password = false;

                $('#modal-edit-user').modal('show');
            },
            showConfirmDelete(user) {
            	this.destroyForm.errors = [];
            	this.destroyForm.message = '';
            	this.destroyForm.success = '';

            	this.destroyForm.id = user.id;
                this.destroyForm.first_name = user.first_name;
                this.destroyForm.last_name = user.last_name;
                $('#modal-delete-user').modal('show');
            },
            createUser() {
            	this.persistUser(
                    'post', `/users`,
                    this.createForm,
                    '#modal-create-user',
                    1000,
                    true
                );
            },
            updateUser() {
                if(!this.change_password) delete this.editForm.password;
                this.persistUser(
                    'put', `/users/${this.editForm.id}`,
                    this.editForm,
                    '#modal-edit-user',
                    1000,
                    true
                );
            },
            destroyUser() {
            	this.persistUser(
                    'delete', `/users/${this.destroyForm.id}`,
                    this.destroyForm,
                    '#modal-delete-user',
                    0,
                    true
                );
            },
            persistUser(method, uri, form, modal, timeout = 0, fetchUsers = false) {
            	if(this.loading) return false;
            	this.loading = true;
                form.errors = [];

                axios[method](uri, form)
                    .then(response => {
                    	if (fetchUsers) this.getUsers();
                        form.success = '';

                        form.errors = [];
                        form.message = '';

                        if (modal) {
                        	setTimeout(function() {
	                        	$(modal).modal('hide');	
	                        }, timeout);
                        }

                        this.loading = false;
                    })
                    .catch(error => {
                        console.log(error.response);
                    	this.loading = false;
                        if (typeof error.response.data === 'object') {
                            form.success = '';
                            form.errors = _.flatten(_.toArray(error.response.data.errors));
                            form.message = error.response.data.message;
                        } else {
                            form.success = '';
                            form.errors = ['Something went wrong. Please try again.'];
                            form.message = '';
                        }
                    });
            }
        }
    }
</script>

