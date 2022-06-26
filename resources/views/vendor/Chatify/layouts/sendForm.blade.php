<div class="px-6 w-full h-full">
    <div class="messenger-sendCard w-full">
        <form id="message-form" method="POST" action="{{ route('send.message') }}" enctype="multipart/form-data">
            @csrf
            <label class="border-t-[1px] rounded-l-md nesto"><span class="fas fa-paperclip"></span><input disabled='disabled' type="file" class="upload-attachment" name="file" accept=".{{implode(', .',config('chatify.attachments.allowed_images'))}}, .{{implode(', .',config('chatify.attachments.allowed_files'))}}" /></label>
            <textarea readonly='readonly' name="message" class="m-send app-scroll border-l-transparent border-r-transparent" placeholder="Type a message.."></textarea>
            <button disabled='disabled' class=" border-t-[1px] rounded-r-md nesto"><span class="fas fa-paper-plane"></span></button>
        </form>
    </div>
</div>