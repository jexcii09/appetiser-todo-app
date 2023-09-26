<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Create Task
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control form-control-sm" id="name" v-model="data.name" 
                        placeholder="Input Name">
                        <div v-if="errors && errors.name" class="text-danger">
                            <small v-for="(value, key) in errors.name" :key="key">* {{value}}</small>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-12">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control form-control-sm" id="description" v-model="data.description" 
                        placeholder="Input Description">
                        <div v-if="errors && errors.description" class="text-danger">
                            <small v-for="(value, key) in errors.description" :key="key">* {{value}}</small>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" class="form-control" v-model="data.due_date" id="due_date" :min="minDate">
                        <div v-if="errors && errors.due_date" class="text-danger">
                            <small v-for="(value, key) in errors.due_date" :key="key">* {{value}}</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="priority_level_id" class="form-label">Priority Level</label>
                        <select class="form-control" v-model="data.priority_level_id">
                            <option value="" selected disabled>Select Priority Level</option>
                            <option v-for="(priorityLevel, key) in priorityLevels" :key="key" :value="priorityLevel.id">
                                {{ priorityLevel.name }}
                            </option>
                        </select>
                        <div v-if="errors && errors.priority_level_id == 'true'" class="text-danger">
                            <small v-for="(value, key) in errors.priority_level_id" :key="key">* {{value}}</small>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <label>Upload File</label>
                    <div class="col-md-12"> 
                        <input type="file" @change="uploadFile" class="form-control" ref="file"
                        accept=".png, .jpg, .jpeg, .svg, .mp4, .csv, .txt, .doc, .docx" multiple>
                        <small class="text-danger">Accepted File: .svg, .jpg, .png, .mp4, .csv, .txt, .doc and .docx only</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div v-for="(file, key) in data.images" :key="key">
                            <span class="badge bg-secondary">{{file.file_name}}</span>
                            <small><a href="javascript:void(0)" class="text-danger text-decoration-none" @click="removeImage(key)"> | Remove</a></small>
                        </div>
                    </div>
                </div>

                <div class="row mb-2 mt-3">
                    <label>Tags</label>
                    <div class="col-md-6"> 
                        <div class="input-group">
                            <input type="search" class="form-control form-control-sm pr-0" v-model="tag.name" placeholder="Add Tag"/>
                            <button class="btn btn-sm btn-success" @click="addTag">Add</button>
                        </div>
                    </div>
                </div>

                <div class="row mb-2 mt-3">
                    <div class="col-md-12">
                        <span class="badge bg-secondary space-right" v-for="(value, key) in tags.names" :key="key">
                            {{value.name}} | 
                            <small>
                                <a href="javascript:void(0)" class="text-danger text-decoration-none" @click="removeTag(key)">X</a>
                            </small>
                        </span>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="/todo" class="btn btn-outline-danger">Back</a>
                        <a class="btn btn-success" v-if="!this.pathId" @click="store$()">Submit</a>
                        <a class="btn btn-primary" v-if="this.pathId" @click="update$()">Update</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="./FormTodoComponent.js"></script>