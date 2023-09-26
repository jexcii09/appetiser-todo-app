<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        Todo List
                        <a href="/todo/archives" class="link-danger float-end">See Archives &gt;</a>
                    </div>
                </div>

                <!-- SORTING -->
                <div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <strong>Sorting: </strong>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <select class="form-select form-select-sm" v-model="filter.order_by" @change="search">
                                <option value="" selected>Order By</option>
                                <option value="asc" >Ascending</option>
                                <option value="desc" >Descending</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select form-select-sm" v-model="filter.status_id" @change="search">
                                <option value="" selected>Order By Status</option>
                                <option value="1" >Todo</option>
                                <option value="2" >Completed</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <select class="form-select form-select-sm" v-model="filter.priority_level_id" @change="search">
                                <option value="" selected>Order By Priority</option>
                                <option value="1" >Urgent</option>
                                <option value="2" >High</option>
                                <option value="3" >Normal</option>
                                <option value="4" >Low</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="date" class="form-control form-control-sm" v-model="filter.due_date" @change="search"/>
                        </div>
                    </div>
                </div>

                <!-- Filter -->
                <div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <strong>Filter: </strong>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <select class="form-select form-select-sm" v-model="filter.filter_status_id" @change="search">
                                <option value="" selected>Order By Status</option>
                                <option v-for="(status, key) in statuses" :key="key" :value="status.id">
                                    {{ status.name }}
                                </option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <select class="form-select form-select-sm" v-model="filter.filter_priority_level_id" @change="search">
                                <option value="" selected>Order By Priority</option>
                                <option v-for="(priorityLevel, key) in priorityLevels" :key="key" :value="priorityLevel.id">
                                    {{ priorityLevel.name }}
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6 pr-0">
                            <div class="input-group">
                                <input type="search" class="form-control form-control-sm pr-0" v-model="filter.keyword" placeholder="Search"/>
                                <button class="btn btn-sm btn-info" @click="search">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            From: <input type="date" class="form-control form-control-sm" v-model="filter.filter_due_date_from" @change="search"/>
                        </div>
                        <div class="col-md-3">
                            To: <input type="date" class="form-control form-control-sm" v-model="filter.filter_due_date_to" @change="search"/>
                        </div>
                        <div class="col-md-3 mt-4 pt-1">
                            <a href="javascript:void(0)" class="text-danger text-decoration-none" @click="clearFilter()">
                                <small>Clear All</small>
                            </a>
                        </div>
                        <div class="col-md-3 mt-3">
                            <a href="/todo/create" class="btn btn-success btn-sm float-end" @click="">Add Todo</a>
                        </div>
                    </div>
                </div>
                
                
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th width="5%">Status</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Due Date</th>
                        <th class="text-center">Priority Level</th>
                        <th class="text-center">Options</th>
                    </thead>
                    <tbody>
                        <tr v-if="todos.total == 0">
                            <td colspan="5">No Results.</td>
                        </tr>
                        <tr v-for="(todo, key) in todos.data" :key="key" :class="{'table-success' : todo.status_id == 2}">
                            <td>
                                <input class="form-check-input me-2" type="checkbox" 
                                :value="todo.status_id" 
                                :checked="todo.status_id == 2" 
                                @change="updateStatus($event, todo.id)"/>
                            </td>
                            <td class="text-center strikeout">{{ todo.name }}</td>
                            <td class="text-center">{{ todo.due_date }}</td>
                            <td class="text-center" 
                            :class="{'text-danger': todo.priority_level_id == 1, 'text-success': todo.priority_level_id == 2,'text-primary': todo.priority_level_id == 3}">
                                {{ todo.priority_level?.name }}
                            </td>
                            <td class="text-center">
                                <a class="text-primary" :href="'/todo/edit/' + todo.id">Edit</a>
                                 | 
                                <a class="text-danger" href="javascript:void(0)" @click="archive(todo)"> Archive</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="row">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item" v-for="(value, key) in todos.links" 
                            :class="{'active' : value.active == true, 'disabled' : value.url == null}" 
                            :key="key">
                                <a class="page-link" href="javascript:void(0)" @click="paginate(value.url)" v-html="value.label"></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>


<script src="./ListTodoComponent.js"></script>