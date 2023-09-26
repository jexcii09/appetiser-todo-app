import './bootstrap';
import 'bootstrap/dist/js/bootstrap.min.js'

import { createApp } from 'vue/dist/vue.esm-bundler';

import ExampleComponent from './components/ExampleComponent.vue';
import HeaderComponent from './components/HeaderComponent.vue';

import LoginComponent from './components/pages/login/LoginComponent.vue';
import RegisterComponent from './components/pages/login/RegisterComponent.vue';
import ListTodoComponent from './components/pages/todo/ListTodoComponent.vue';
import FormTodoComponent from './components/pages/todo/FormTodoComponent.vue';
import ArchivesTodoComponent from './components/pages/todo/ArchivesTodoComponent.vue';

const app = createApp({});


app.component('ExampleComponent', ExampleComponent);
app.component('HeaderComponent', HeaderComponent);

app.component('LoginComponent', LoginComponent);
app.component('RegisterComponent', RegisterComponent);
app.component('ListTodoComponent', ListTodoComponent);
app.component('FormTodoComponent', FormTodoComponent);
app.component('ArchivesTodoComponent', ArchivesTodoComponent);

app.mount("#app");