<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Archive List
                <a href="/todo" class="link-danger float-end">&lt; Back</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Due Date</th>
                        <th class="text-center">Options</th>
                    </thead>
                    <tbody>
                        <tr v-for="(todo, key) in todos.data" :key="key" :class="{'table-success' : todo.status_id == 2}">
                            <td>{{ todo.details.name }}</td>
                            <td>{{ todo.details.due_date }}</td>
                            <td class="text-center">
                                <a class="text-success" href="javascript:void(0)" @click="restore(todo)"> Restore</a> | 
                                <a class="text-danger" href="javascript:void(0)" @click="delete$(todo.id)"> Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="row">
                </div>
            </div>
        </div>
    </div>
</template>


<script src="./ArchivesTodoComponent.js"></script>