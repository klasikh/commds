<template>

    <admin-layout>

        <template #header>
            <h1 class="m-0">Messagerie</h1>
        </template>

        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">John Doe</div>
                        <!-- <div class="card card-primary"> -->
                            <!-- <form :action="route('admin.users.store')" method="post"> -->
                            <!-- {{ csrf_field }} -->
                                        <!-- {{ sender_id }} -->
                            <div class="card-body chat-row">
                                <div id="msgBody"  class="chat-content" style="max-height:250px; overflow-y:scroll">
                                    <div class="card-content">

                                        <div class="flex flex-col h-full overflow-x-auto mb-4">
                                            <div class="flex flex-col h-full">
                                            <div class="grid grid-cols-12 gap-y-2">
                                                <div class="col-start-6 p-1 rounded-lg msg" style="float:left; left:0px; margin-left:0px; background-color:#ececca; word-wrap:break-word; display:inline-block; border-radius:12px; max-width:70%" >
                                                    <!-- {{ message.content }} -->
                                                    <!-- <div class="flex flex-row items-center">
                                                        <div class="relative ml-3 bg-white py-2 px-4 shadow rounded-xl">
                                                            
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <div class="col-start-6 p-1 rounded-lg msg" style="float:right; right:0px; margin-right:0px; background-color:lightblue; word-wrap:break-word; display:inline-block; border-radius:12px; max-width:70%" >
                                                    <!-- {{ message.content }} -->
                                                    <!-- <div class="flex items-center justify-start flex-row-reverse">
                                                        <div
                                                        class="relative ml-3 py-1 px-2 shadow rounded-xl" >
                                                        
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="chat-section">

                                    <form @submit.prevent="submitMessage">
                                        <div class="form-group chat-box">
                                            <input type="hidden" v-model="form.sender_id" id="sender_id">
                                            <input type="hidden" v-model="form.receiver_id" id="receiver_id">
                                            <textarea name="" class="chat-input form-control" id="chatContent" contenteditable="" rows="6" v-model="form.content" :class="{ 'is-invalid' : form.errors.content }" autocomplete="on" autofocus="autofocus"></textarea>

                                            <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.content}" minlength="12">
                                                {{ form.errors.content }}
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary" id="sendM" style="float:right" :disabled="!form.content || form.processing">
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
        </section>
    </admin-layout>

</template>

<script>

import AdminLayout from "@/Layouts/AdminLayout"

import {ref, onMounted} from 'vue';
import Pusher from 'pusher-js';
// import { Router } from '@inertiajs/inertia/types/router';

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
                receiver_id: 65,
                content: '',
            }),
            messages: this.messages,
        }
    },

    methods: {

        newf(){
            const receiver_id = document.getElementById('receiver_id')
        },

        

        submitMessage() {
   let ip_address = '127.0.0.1';
                    let socket_port = '3000';
                    let socket = io(ip_address + ':' + socket_port);

                    let chatInput = $('#sendM');

                    chatInput.keyup(function(e) {
                        let message = $("#chatContent").val();
                        console.log(message);
                        if(e.which === 13 && !e.shiftKey) {
                            socket.emit('sendChatToServer', message);
                            message.val("");
                            return false;
                        }
                    });

                    socket.on('sendChatToClient', (message) => {
                        $('.chat-content .msg').append(`<div>${message}</div>`);
                    });
             $.ajax({
                url: this.form.post(this.route('messages.store')),
                // method: "POST",
                data:{
                    sender_id: $("#sender_id").val(),
                    receiver_id: $("#receiver_id").val(),
                    content: $("#content").val()
                },
                dataType: "text",
                success:function(data){
                    $("#content").val("");
                 
                        }
                    });
            this.form.content = '';

            
            
            // setInterval(function(){
            //     $.ajax({
            //         url: '/getMessages.php',
            //         // method:"GET",
            //         data:{
            //             sender_id:$("#sender_id").val(),
            //             receiver_id:$("#receiver_id").val()
            //         },
            //         dataType: "text",
            //         success:function(data){
            //             // this.messages
            //             $("#msgBody").html(data);

            //         }
            //     });
            // }, 700);

        }
    },

}

</script>

<style>
.scrollarea {
  min-height: 500px;
}
</style>
