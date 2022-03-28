<template>

    <admin-layout>

        <template #header>
            <h1 class="m-0">Messagerie</h1>
        </template>

        <section class="content">

    <div class="row chat-row">
        <div class="col-md-3">
            <div class="users">
                <h5>Contacts</h5>

                <ul class="list-group list-chat-item">
                    <!-- @if($users->count())
                        @foreach($users as $user) -->
                            <li class="chat-user-list
                                @if($user->id == $friendInfo->id) active @endif">
                                <!-- <a href="{{ route('message.conversation', $user->id) }}"> -->
                                <a>
                                    <div class="chat-image">
                                        <!-- {!! makeImageFromName($user->name) !!} -->
                                        <!-- <i class="fa fa-circle user-status-icon user-icon-{{ $user->id }}" title="away"></i> -->
                                        <i class="fa fa-circle user-status-icon user-icon" title="away"></i>
                                    </div>

                                    <div class="chat-name font-weight-bold">
                                        <!-- {{ $user->name }} -->
                                    </div>
                                </a>
                            </li>
                        <!-- @endforeach
                    @endif -->
                </ul>
            </div>

            <div class="groups mt-5">
                <h5>Groups <i class="fa fa-plus btn-add-group ml-3"></i></h5>

                <ul class="list-group list-chat-item">
                    <!-- @if($groups->count())
                        @foreach($groups as $group) -->
                            <li class="chat-user-list">
                                <!-- <a href="{{ route('message-groups.show', $group->id) }}"> -->
                                <a>
                                <!-- {{ $group->name }} -->
                                </a>
                            </li>
                        <!-- @endforeach
                    @endif -->
                </ul>
            </div>

        </div>

        <div class="col-md-9 chat-section">
            <div class="chat-header">
                <div class="chat-image">
                    <!-- {!! makeImageFromName($user->name) !!} -->
                </div>

                <div class="chat-name font-weight-bold">
                    <!-- {{ $user->name }} -->
                    <!-- <i class="fa fa-circle user-status-head" title="away"
                       id="userStatusHead{{$friendInfo->id}}"></i> -->
                    <i class="fa fa-circle user-status-head" title="away"
                       id="userStatusHead"></i>
                </div>
            </div>

            <div class="chat-body" id="chatBody">
                <div class="message-listing" id="messageWrapper">

                </div>
            </div>

            <div class="chat-box">
                <div class="chat-input bg-white" id="chatInput" contenteditable="">

                </div>

                <div class="chat-input-toolbar">
                    <button title="Add File" class="btn btn-light btn-sm btn-file-upload">
                        <i class="fa fa-paperclip"></i>
                    </button> |

                    <button title="Bold" class="btn btn-light btn-sm tool-items"
                            onclick="document.execCommand('bold', false, '');">
                        <i class="fa fa-bold tool-icon"></i>
                    </button>

                    <button title="Italic" class="btn btn-light btn-sm tool-items"
                            onclick="document.execCommand('italic', false, '');">
                        <i class="fa fa-italic tool-icon"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="addGroupModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <form action="{{ route('message-groups.store') }}" method="post"> -->
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Group Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        <div class="form-group">
                            <label for="">Select Member</label>
                            <select id="selectMember" class="form-control" name="user_id[]" multiple="multiple">
                                <!-- @foreach($users as $user) -->
                                    <!-- <option value="{{ $user->id }}"> -->
                                    <option value="">
                                        <!-- {{ $user->name }} -->
                                    </option>
                                <!-- @endforeach -->
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        </section>
    </admin-layout>

</template>

<script>

import AdminLayout from "@/Layouts/AdminLayout"

import {ref, onMounted} from 'vue';
// import Pusher from 'pusher-js';
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
            search: this.$inertia.form({
                query: this.query
            }),
            query: this.query,
            messages: this.messages,
        }
    },

    methods: {

        newf(){
            const receiver_id = document.getElementById('receiver_id')
        },

        // SCRIPT FOR SEARCH BUTTON FOR CHAT

        takeUsers(){

            var url = this.search.get(this.route('messages.searchUsers'));
            $('#searchbox').on('keyup', function(){
                var query = $(this).val();

                if(query.length > 0){

                    $.ajax({
                        // type: 'POST',
                        url: url,
                        data: {
                            query: query
                        },
                        beforeSend: function(){
                            $("#spinner").show();
                        },
                        success: function(data){
                            $("#spinner").hide();
                            $("#display-results").html(data).show();
                        }
                    });

                }else{
                    $("#display-results").hide();
                }

            });

        },
        submitMessage() {
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

            setInterval(function(){
                $.ajax({
                    url: '/getMessages.php',
                    // method:"GET",
                    data:{
                        sender_id:$("#sender_id").val(),
                        receiver_id:$("#receiver_id").val()
                    },
                    dataType: "text",
                    success:function(data){
                        // this.messages
                        $("#msgBody").html(data);

                    }
                });
            }, 700);

        }
    },

}

</script>

<style>
/* .scrollarea {
  min-height: 500px;
}

.chat-row {
    margin: 50px;
}
.chat-input {
    border: 1px soild lightgray;
    border-top-right-radius: 10px;
    border-top-left-radius: 10px;
    padding: 8px 10px;
    color:#fff;
}     */
.select2-container {
    width: 100% !important;
}
</style>
