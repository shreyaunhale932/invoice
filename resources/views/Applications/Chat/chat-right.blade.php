<div class="chat-cont-right">
    <div class="chat-header">
        <a id="back_user_list" href="javascript:void(0)" class="back-user-list">
            <i class="fa fa-chevron-left"></i>
        </a>
        <div class="chat-block d-flex">
            <div class="media-img-wrap">
                <div class="avatar avatar-online">
                    <img src="{{ URL::asset('/public/assets/img/profiles/avatar-02.jpg') }}" alt="User Image"
                        class="avatar-img rounded-circle">
                </div>
            </div>
            <div class="media-body">
                <div class="user-name">Brian Johnson</div>
                <div class="user-status">online</div>
            </div>
        </div>
        <div class="chat-options">
            <a href="javascript:void(0)">
                <span><i class="fe fe-phone"></i></span>
            </a>
            <a href="javascript:void(0)">
                <span><i class="fe fe-video"></i></span>
            </a>
            <a href="javascript:void(0)">
                <span><i class="fe fe-more-vertical"></i></span>
            </a>
        </div>
    </div>
    @livewire('chat')
    <div class="chat-footer">
        <div class="input-group">
            <div class="input-group-prefix">
                <div class="btn-file btn">
                    <i class="fas fa-paperclip"></i>
                    <input type="file">
                </div>
            </div>
            <input type="text" class="input-msg-send form-control" placeholder="Type something">
            <div class="input-group-addon">
                <button type="button" class="btn msg-send-btn"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</div>
