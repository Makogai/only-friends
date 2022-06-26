@include('Chatify::layouts.headLinks')
<style>
    body{background-color: black!important;}

</style>
<div class="max-w-6xl mx-auto" style="height:calc(100vh - 110px)">
    <div class="grid grid-cols-3 bg-black py-5 gap-24 place-content-center max-w-6xl mb-6 mx-auto">
        <div class="flex items-center">
            <div class="relative text-gray-600 focus-within:text-gray-400">
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </span>
                <input type="search" name="q" class="py-2 text-sm text-white bg-gray-900 rounded-md pl-10 focus:outline-none " placeholder="Search..." autocomplete="off">
            </div>
        </div>
        <div class=""><img src="https://i.imgur.com/zHGQSCd.png" alt=""></div>
        <div class=" grid grid-cols-5 place-content-center">
        <div>😊</div>
        <div>😍</div>
        <div>🍆</div>
        <div>🤡</div>
        <div>😋</div>
        </div>

    </div>
    <div class="messenger">
        {{-- ----------------------Users/Groups lists side---------------------- --}}
        <div class="messenger-listView">
            {{-- Header and search bar --}}
            <div class="m-header">
                <nav>
                    <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle ">MESSAGES</span> </a>
                    {{-- header buttons --}}
                    <nav class="m-header-right">
                        <a href="#"><i class="fas fa-cog settings-btn"></i></a>
                        <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                    </nav>
                </nav>
                {{-- Search input --}}
                <div class="flex items-center px-4">
                    <div class="relative text-gray-600 focus-within:text-gray-400">
                        <span class="absolute inset-y-0 left-0 flex items-center ">
                            <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </button>
                        </span>
                        <input type="search" name="q" class="messenger-search py-2 text-sm text-white bg-gray-900 rounded-md pl-10 focus:outline-none " placeholder="Search..." autocomplete="off">
                    </div>
                </div>
                {{-- Tabs --}}
                <div class="messenger-listView-tabs mt-6">
                    <a href="#" @if($type == 'user') class="active-tab" @endif data-view="users">
                        <span class="far fa-user"></span> People</a>
                    <!-- <a href="#" @if($type == 'group') class="active-tab" @endif data-view="groups">
                        <span class="fas fa-users"></span> Groups</a> -->
                </div>
            </div>
            {{-- tabs and lists --}}
            <div class="m-body contacts-container">
            {{-- Lists [Users/Group] --}}
            {{-- ---------------- [ User Tab ] ---------------- --}}
            <div class="@if($type == 'user') show @endif messenger-tab users-tab app-scroll" data-view="users">

                {{-- Favorites --}}
                <div class="favorites-section mt-3">
                    <p class="messenger-title">Favorites</p>
                    <div class="messenger-favorites app-scroll-thin messenger-listView-tabs">

                    </div>
                </div>

                {{-- Saved Messages --}}
                {!! view('Chatify::layouts.listItem', ['get' => 'saved']) !!}

                {{-- Contact --}}
                <div class="listOfContacts" style="width: 100%;height: calc(100% - 200px);position: relative;"></div>

            </div>

            {{-- ---------------- [ Group Tab ] ---------------- --}}
            <div class="@if($type == 'group') show @endif messenger-tab groups-tab app-scroll" data-view="groups">
                    {{-- items --}}
                    <p style="text-align: center;color:grey;margin-top:30px">
                        <a target="_blank" style="color:{{$messengerColor}};" href="https://chatify.munafio.com/notes#groups-feature">Click here</a> for more info!
                    </p>
                </div>

                {{-- ---------------- [ Search Tab ] ---------------- --}}
            <div class="messenger-tab search-tab app-scroll" data-view="search">
                    {{-- items --}}
                    <p class="messenger-title">Search</p>
                    <div class="search-records">
                        <p class="message-hint center-el"><span>Type to search..</span></p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ----------------------Messaging side---------------------- --}}
        <div class="messenger-messagingView">
            {{-- header title [conversation name] amd buttons --}}
            <div class="m-header m-header-messaging mb-3">
                <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                    {{-- header back button, avatar and user name --}}
                    <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center my-2">
                        <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                        <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                        </div>
                        <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                    </div>
                    {{-- header buttons --}}
                    <nav class="m-header-right">
                        <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                        <a href="/"><i class="fas fa-home"></i></a>
                        <a href="#" class=""><i class="fas fa-info-circle"></i></a>
                    </nav>
                </nav>
            </div>
            {{-- Internet connection --}}
            <div class="internet-connection mt-5">
                <span class="ic-connected">Connected</span>
                <span class="ic-connecting">Connecting...</span>
                <span class="ic-noInternet">No internet access</span>
            </div>
            {{-- Messaging area --}}
            <div class="m-body messages-container app-scroll">
                <div class="messages">
                    <p class="message-hint center-el"><span>Please select a chat to start messaging</span></p>
                </div>
                {{-- Typing indicator --}}
                <div class="typing-indicator">
                    <div class="message-card typing">
                        <p>
                            <span class="typing-dots">
                                <span class="dot dot-1">aaa</span>
                                <span class="dot dot-2"></span>
                                <span class="dot dot-3"></span>
                            </span>
                        </p>
                    </div>
                </div>
                {{-- Send Message Form --}}
                @include('Chatify::layouts.sendForm')
            </div>
        </div>
        {{-- ---------------------- Info side ---------------------- --}}
        <div class="messenger-infoView app-scroll">
            {{-- nav actions --}}
            <nav>
                <!-- <a href="#"><i class="fas fa-times"></i></a> -->
            </nav>
            {!! view('Chatify::layouts.info')->render() !!}
        </div>
    </div>
</div>
@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')
