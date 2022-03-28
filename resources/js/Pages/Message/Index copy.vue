<template>

    <admin-layout>

        <template #header>
            <h1 class="m-0">Messagerie</h1>
        </template>

        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <!-- <a href="" @click="showReq()"> -->
                    <a class="list-group-item d-flex justify-content-between align-items-center">

                        John Doe 
                        <span class="badge badge-pill badge-primary">0</span>
                    </a>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">John Doe</div>
                        <!-- <div class="card card-primary"> -->
                            <!-- <form :action="route('admin.users.store')" method="post"> -->
                            <!-- {{ csrf_field }} -->
                            <div class="card-body">
                                <div style="max-height:220px; overflow-y:scroll">
                                    <div class="card-content" v-for="(message, index) in messages" :key="index">
                                        
                                        <div v-if="message.sender_id === user_id || message.receiver_id === user_id">
                                            <div v-if="message.receiver_id === user.id" style="float:left">
                                                {{ message.content }}
                                            </div>
                                            <br>
                                            <div v-if="message.sender_id === user.id" style="float:right;" class="badge-primary" >
                                                {{ message.content }}
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="">
                                    
                                    <form @submit.prevent="sendMessage">
                                        <div class="form-group">
                                            <input type="hidden" v-model="form.sender_id">
                                            <input type="hidden" v-model="form.receiver_id">
                                            <textarea name="" class="form-control" id="" rows="6" v-model="form.content" :class="{ 'is-invalid' : form.errors.content }" autocomplete="on" autofocus="autofocus"></textarea>
                                            
                                            <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.content}" minlength="12">
                                                {{ form.errors.content }}
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary" style="float:right" :disabled="!form.content">
                                                <i class="fa fa-paper-plane"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <!-- </div> -->
                    </div>

                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->

            </div><!--/. container-fluid -->



              <div id="msgBody" style="max-height:250px; overflow-y:scroll">
                                    <div class="card-content" v-for="(message, index) in messages" :key="index">

                                        <div class="flex flex-col h-full overflow-x-auto mb-4">
                                            <div class="flex flex-col h-full">
                                            <div class="grid grid-cols-12 gap-y-2" v-if="message.sender_id === user_id || message.receiver_id === user_id">
                                                <div class="col-start-1 col-end-8 p-3 rounded-lg">
                                                    <div class="flex flex-row items-center">
                                                        <div class="relative ml-3 bg-white py-2 px-4 shadow rounded-xl" v-if="message.receiver_id === user.id" style="float:left; left:0px; margin-left:0px;">
                                                            {{ message.content }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-start-6 p-1 rounded-lg">
                                                    <div class="flex items-center justify-start flex-row-reverse">
                                                        <div
                                                        class="relative ml-3 py-1 px-2 shadow rounded-xl" v-if="message.sender_id === user.id" style="float:right; right:0px; margin-right:0px; background-color:lightblue; word-wrap:break-word; display:inline-block; border-radius:12px; max-width:70%">
                                                            <p> {{ message.content }} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                >
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">John Doe</div>
                        <!-- <div class="card card-primary"> -->
                            <!-- <form :action="route('admin.users.store')" method="post"> -->
                            <!-- {{ csrf_field }} -->
                                        <!-- {{ sender_id }} -->
                            <div class="card-body">
                                
            <div class="row chat-row">
                              
                                <div class="chat-content">
                                    <ul>
                                    
                                    </ul>
                                </div>
                                <div class="chat-section">

                                    <!-- <form @submit.prevent="submitMessage"> -->
                                        <div class="form-group">
                                            <input type="hidden" v-model="user.id" id="sender_id">
                                            <input type="hidden" v-model="form.receiver_id" id="receiver_id">
                                            <!-- <textarea name="" class="form-control chat-input" rows="6" v-model="form.content" :class="{ 'is-invalid' : form.errors.content }" autocomplete="on" autofocus="autofocus"></textarea> -->
                                                <div class="chat-box">
                                                    <div  class="form-control chat-input" id="chatInput" autocomplete="on" autofocus="autofocus" contenteditable="">

                                                    </div>
                                                </div>

                                            <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.content}" minlength="12">
                                                {{ form.errors.content }}
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary" id="send" style="float:right" :disabled="!form.content">
                                                <i class="fa fa-paper-plane"></i>
                                            </button>
                                        </div>
                                    <!-- </form> -->
                                </div>
                            </div>
                        <!-- </div> -->
                    </div>
                    </div>

                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->

                    <div class="container">
            <div class="row chat-row">
                <div class="chat-content">
                    <ul>
                      
                    </ul>
                </div>

                <div class="chat-section">
                    <div class="chat-box">
                        <textarea class="chat-input bg-primary" id="chatContent" contenteditable="">

                        </textarea>
                        <button id="sendM">Envoyer</button>
                    </div>
                </div>
            </div>
        </div>

        </section>
    </admin-layout>

</template>

<script>

import AdminLayout from "@/Layouts/AdminLayout"

export default {
    props: ['user', 'user_id', 'messages'],
    
    components: {
        AdminLayout,
    },
    data() {
        return {
            form: this.$inertia.form({
                id: '',
                sender_id: this.user.id,
                receiver_id: 5,
                content: '',
            })
        }
    },
    methods: {
        sendMessage() {
            this.form.post(this.route('user.messages.store'), {
                preserveScroll: true,
                // onSuccess:() => {
                //     Toast.fire({
                //         icon: 'success',
                //         title: 'Nouvelle demande ajoutée avec succès !'
                //     })
                // }
            })
        },
    },

    setup() {
        const sender_id = ref('');
        const receiver_id = 5;
        const messages = ref([]);
        const content = ref('');

        onMounted(() => {
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            const pusher = new Pusher('0db2c00c49a5f56ad909', {
            cluster: 'eu'
            });

            const channel = pusher.subscribe('flying-waterfall-984');
            channel.bind('message',  data => {
                messages.value.push(data);
            });
        })

        const submit = async () => {
        await fetch(this.route('user.messages.store'), {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                sender_id: sender_id.value,
                receiver_id: receiver_id.value,
                content: content.value
            })
        })

        content.value = '';
        }

        return {
            // form: this.$inertia.form({
                id: '',
                sender_id,
                receiver_id: 5,
                content: '',
            // }),
            messages,
            submit
        }
    },


        mounted() {
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        const pusher = new Pusher('0db2c00c49a5f56ad909', {
        cluster: 'eu'
        });

        const channel = pusher.subscribe('flying-waterfall-984');
        // channel.bind('chat',  data => {
        //     messages.push(data);
        // console.log(messages)
        channel.bind('chat', function(data) {
        alert(JSON.stringify(data));

        });
    },

    methods: {

        newf(){
            const receiver_id = document.getElementById('receiver_id')
        },

        submitButn() { 
            this.form.post(this.route('user.messages.store'), {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({
                    sender_id: this.form.sender_id,
                    receiver_id: this.form.receiver_id,
                    content: this.form.content
                })
            })
            console.log(this.form.content);
            this.form.content = '';
            // }
        }
    },
}
</script>

<style>

</style>
