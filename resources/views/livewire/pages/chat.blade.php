<div>
    <div class="container">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <strong>Chat room </strong>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox chat-view">
                <div class="ibox-title">
                    {{$highlightMessage}}
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-9 ">
                            <div class="chat-discussion">
                                @foreach ($messages as $message)
                                    <div class="chat-message {{ $message->sender_user_id == auth()->id() ? 'right' : 'left' }}">
                                        <img class="message-avatar" src="{{ 'assets/img/default-avatar.jpg' }}" alt="Imagem de perfil de {{ $message->sender_name }}">
                                        <div class="message">
                                            <a class="message-author" href="#"> {{ $message->sender_name }} </a>
                                            <span class="message-date"> {{ formatDate($message->created_at) }} </span>
                                            <span class="message-content">{{ $message->content }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="chat-users">
                                <div class="users-list">
                                    @foreach ($users as $user)
                                    
                                        <div class="chat-user">
                                            
                                            <span 
                                                id="user-status-{{ $user->id }}" 
                                                class="pull-right label label-primary"
                                            >{{ $user->last_seen ? 'Online' : 'Offline' }}</span>
                                            
                                            <a wire:click="setTalk({{ $user->id }})" href="#">
                                                <img class="chat-avatar" 
                                                    src="{{ 'assets/img/default-avatar.jpg'}}" 
                                                    alt="Image and link to {{ $user->name }}'s profile"
                                                >
                                            </a>
                                            
                                            <div class="chat-user-name">
                                                <a wire:click="setTalk({{ $user->id }})" href="#">{{ $user->name }}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <form wire:submit.prevent="sendMessage">
                            @csrf
                            <div class="col-lg-12">
                                <div class="chat-message-form">
                                    <div class="form-group">
                                        <textarea 
                                            type="text"
                                            wire:model="newMessage"
                                            class="form-control message-input" 
                                            placeholder="Enter message text and press enter" >
                                        </textarea>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>