    <div class="messenger-sendCard mb-4 border-[1px] nesto rounded-md w-full ml-[5%]" style="width: 90%!important;">
        <form id="message-form" method="POST" action="{{ route('send.message') }}" enctype="multipart/form-data">
            @csrf
            <label class="border-0 rounded-l-md nesto"><span class="fas fa-paperclip"></span><input disabled='disabled' type="file" class="upload-attachment" name="file" accept=".{{implode(', .',config('chatify.attachments.allowed_images'))}}, .{{implode(', .',config('chatify.attachments.allowed_files'))}}" /></label>
            <textarea readonly='readonly' name="message" class="border-0 m-send app-scroll border-l-transparent border-r-transparent" placeholder="Type a message.."></textarea>
            <button disabled='disabled' class="  rounded-r-md nesto"><span class="fas fa-paper-plane"></span></button>
        </form>
    </div>
