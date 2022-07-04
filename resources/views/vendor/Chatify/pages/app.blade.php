@include('Chatify::layouts.headLinks')
<style>
    body{background-color: black!important;}

</style>
<div class="max-w-6xl mx-auto" style="height:calc(100vh - 120px)">
{{--<div class="grid grid-cols-3 bg-black py-5 gap-24 place-content-center max-w-6xl mb-6 mx-auto">--}}
{{--        <div class="flex items-center">--}}
{{--            <div class="relative text-gray-600 focus-within:text-gray-400">--}}
{{--                <span class="absolute inset-y-0 left-0 flex items-center pl-2">--}}
{{--                    <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">--}}
{{--                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>--}}
{{--                    </button>--}}
{{--                </span>--}}
{{--                <input type="search" name="q" class="py-2 text-sm text-white bg-gray-900 rounded-md pl-10 focus:outline-none " placeholder="Search..." autocomplete="off">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class=""><img src="https://i.imgur.com/zHGQSCd.png" alt=""></div>--}}
{{--        <div class=" grid grid-cols-5 place-content-center">--}}
{{--          <div>--}}
{{--            <svg width="20" height="19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.5 5c1.461-1.461 3.094-2.581 4.198-3.26a2.474 2.474 0 0 1 2.605 0C12.406 2.42 14.039 3.54 15.5 5c3.169 3.168 3 5 3 8 0 1.41-.11 2.599-.227 3.463-.124.91-.917 1.537-1.834 1.537H15a2 2 0 0 1-2-2v-2a3 3 0 0 0-6 0v2a2 2 0 0 1-2 2H3.562c-.918 0-1.711-.627-1.834-1.537A25.995 25.995 0 0 1 1.5 13c0-3-.168-4.832 3-8Z" fill="transparent"/><path d="m12.121 11.879.53-.53-.53.53ZM1.501 13H.75h.75Zm.227 3.463.743-.1-.743.1Zm16.545 0-.744-.1.744.1ZM8.698 1.741l.392.639-.392-.64Zm2.605 0 .392-.64-.392.64Zm5.136 15.509H15v1.5h1.439v-1.5ZM13.75 16v-2h-1.5v2h1.5Zm0-2a3.75 3.75 0 0 0-1.098-2.652l-1.06 1.061c.421.422.658.994.658 1.591h1.5Zm-1.098-2.652A3.75 3.75 0 0 0 10 10.25v1.5a2.25 2.25 0 0 1 1.591.659l1.06-1.06ZM10 10.25a3.75 3.75 0 0 0-2.652 1.098L8.41 12.41A2.25 2.25 0 0 1 10 11.75v-1.5Zm-2.652 1.098A3.75 3.75 0 0 0 6.25 14h1.5c0-.597.237-1.169.66-1.591l-1.062-1.06ZM6.25 14v2h1.5v-2h-1.5ZM5 17.25H3.562v1.5H5v-1.5ZM8.305 1.102c-1.131.695-2.817 1.85-4.335 3.368l1.06 1.06c1.405-1.404 2.984-2.489 4.06-3.15l-.785-1.278ZM16.03 4.47c-1.518-1.518-3.204-2.673-4.335-3.368L10.91 2.38c1.077.661 2.655 1.746 4.06 3.15l1.06-1.06ZM2.47 16.363A25.242 25.242 0 0 1 2.25 13H.75c0 1.448.114 2.671.234 3.564l1.487-.201ZM17.75 13c0 1.371-.107 2.526-.22 3.363l1.486.2c.12-.891.234-2.114.234-3.563h-1.5ZM3.97 4.47C2.328 6.11 1.49 7.467 1.09 8.856.701 10.21.751 11.546.751 13h1.5c0-1.546-.036-2.626.282-3.73.308-1.068.97-2.213 2.497-3.74L3.97 4.47ZM19.25 13c0-1.454.05-2.79-.341-4.144-.4-1.39-1.237-2.745-2.879-4.386l-1.06 1.06c1.527 1.527 2.19 2.672 2.498 3.74.317 1.104.282 2.184.282 3.73h1.5ZM3.562 17.25c-.582 0-1.023-.387-1.091-.887l-1.487.2c.179 1.32 1.324 2.187 2.578 2.187v-1.5ZM6.25 16c0 .69-.56 1.25-1.25 1.25v1.5A2.75 2.75 0 0 0 7.75 16h-1.5ZM15 17.25c-.69 0-1.25-.56-1.25-1.25h-1.5A2.75 2.75 0 0 0 15 18.75v-1.5Zm1.439 1.5c1.253 0 2.398-.867 2.577-2.186l-1.487-.201c-.067.5-.509.887-1.09.887v1.5ZM9.09 2.38a1.724 1.724 0 0 1 1.82 0l.785-1.278a3.224 3.224 0 0 0-3.39 0L9.09 2.38Z" fill="#fff"/></svg>--}}
{{--          </div>--}}
{{--          <div>--}}
{{--            <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 1C3.118 1 1 2.647 1 8c0 3.738 1.033 5.67 4 6.494V19l4.012-4.012c.318.008.647.012.988.012 6.882 0 9-1.647 9-7s-2.118-7-9-7Z" fill="#fff"/><path d="M6 5.25a.75.75 0 0 0 0 1.5v-1.5Zm8 1.5a.75.75 0 0 0 0-1.5v1.5Zm-8 2.5a.75.75 0 0 0 0 1.5v-1.5Zm5 1.5a.75.75 0 0 0 0-1.5v1.5Zm-6 3.744h.75a.75.75 0 0 0-.55-.723l-.2.723Zm4.012.494.02-.75a.75.75 0 0 0-.55.22l.53.53ZM5 19h-.75a.75.75 0 0 0 1.28.53L5 19ZM6 6.75h8v-1.5H6v1.5Zm0 4h5v-1.5H6v1.5ZM1.75 8c0-2.608.521-4.053 1.63-4.915C4.55 2.174 6.564 1.75 10 1.75V.25c-3.446 0-5.933.4-7.541 1.65C.788 3.2.25 5.256.25 8h1.5Zm16.5 0c0 2.608-.521 4.053-1.63 4.915-1.17.911-3.184 1.335-6.62 1.335v1.5c3.446 0 5.933-.4 7.541-1.65 1.671-1.3 2.209-3.355 2.209-6.1h-1.5ZM10 1.75c3.436 0 5.45.424 6.62 1.335 1.109.862 1.63 2.307 1.63 4.915h1.5c0-2.745-.538-4.8-2.209-6.1C15.933.65 13.446.25 10 .25v1.5ZM5.2 13.771c-1.349-.375-2.163-.97-2.669-1.816-.526-.88-.781-2.136-.781-3.955H.25c0 1.92.261 3.499.993 4.724.753 1.26 1.938 2.043 3.556 2.492l.402-1.445Zm4.8.479c-.335 0-.657-.004-.968-.012l-.04 1.5c.326.008.661.012 1.008.012v-1.5Zm-5.75.244V19h1.5v-4.506h-1.5Zm1.28 5.036 4.013-4.012-1.061-1.06L4.47 18.47l1.06 1.06Z" fill="#00ADEA"/></svg>--}}
{{--          </div>--}}
{{--          <div>--}}
{{--            <div class="cursor-pointer relative">--}}
{{--                <div class="">--}}
{{--                    <Menu as="div" class="t">--}}
{{--                        <div>--}}
{{--                            <MenuButton--}}
{{--                                class=""--}}
{{--                            >--}}
{{--                                <PlusIcon class="text-white w-6 h-6"></PlusIcon>--}}
{{--                            </MenuButton>--}}
{{--                        </div>--}}

{{--                        <transition--}}
{{--                            enter-active-class="transition duration-100 ease-out"--}}
{{--                            enter-from-class="transform scale-95 opacity-0"--}}
{{--                            enter-to-class="transform scale-100 opacity-100"--}}
{{--                            leave-active-class="transition duration-75 ease-in"--}}
{{--                            leave-from-class="transform scale-100 opacity-100"--}}
{{--                            leave-to-class="transform scale-95 opacity-0"--}}
{{--                        >--}}
{{--                            <MenuItems--}}
{{--                                class="absolute mt-2 w-56 origin-top divide-y divide-gray-100 rounded-md bg-gray-800 				shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none p-4"--}}
{{--                                style="right: 50%; transform: translateX(50%)">--}}
{{--                                <div class="grid grid-cols-2 place-items-center text-gray-100">--}}
{{--                                    <div class="bg-primary" @click="openModal(1)">TEXT</div>--}}
{{--                                    <div class="bg-secondary" @click="openModal(2)">MEDIA</div>--}}
{{--                                </div>--}}
{{--                            </MenuItems>--}}
{{--                        </transition>--}}
{{--                    </Menu>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--          <div>--}}
{{--            <svg width="22" height="21" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.85 1c.631 0 1.261.09 1.86.29 3.691 1.2 5.021 5.25 3.91 8.79a12.728 12.728 0 0 1-3.009 4.81 38.456 38.456 0 0 1-6.331 4.96l-.25.15-.26-.16a38.094 38.094 0 0 1-6.369-4.96 12.933 12.933 0 0 1-3.011-4.8c-1.13-3.54.2-7.59 3.931-8.81.29-.1.589-.17.889-.21h.12c.281-.04.56-.06.84-.06h.11c.63.02 1.24.13 1.831.33h.059c.04.02.07.04.09.06.221.07.43.15.63.26l.38.17c.092.05.195.124.284.189.056.04.107.078.146.101l.05.03c.085.05.175.101.25.16A6.263 6.263 0 0 1 14.85 1Zm2.66 7.2c.41-.01.76-.34.79-.76v-.12a3.3 3.3 0 0 0-2.11-3.16.8.8 0 0 0-1.01.5c-.14.42.08.88.5 1.03.641.24 1.07.87 1.07 1.57v.03a.86.86 0 0 0 .19.62c.14.17.35.27.57.29Z" fill="#000"/><path d="m16.71 1.29-.16.474.005.002.155-.476ZM14.85 1l-.004.5h.004V1Zm5.77 9.08.472.165.003-.008.002-.007-.477-.15Zm-3.009 4.81.348.358.006-.005-.354-.354Zm-6.331 4.96.259.427.007-.004-.266-.424Zm-.25.15-.263.425.26.161.262-.158L11.03 20Zm-.26-.16-.264.424.264-.425Zm-6.369-4.96-.355.352.008.007.347-.36Zm-3.011-4.8-.476.152.002.008.003.007.471-.167Zm3.931-8.81.156.474.007-.002-.163-.473Zm.889-.21v-.5h-.032l-.032.004.064.496Zm.12 0v.5h.036l.036-.005-.072-.495ZM7.28 1l.015-.5H7.28V1Zm1.831.33-.161.474.078.026h.083v-.5Zm.059 0L9.385.88 9.283.83H9.17v.5Zm.09.06-.344.362.082.078.11.035.152-.476Zm.63.26-.24.438.017.01.019.009.204-.457Zm.38.17.235-.441-.015-.008-.016-.007-.204.456Zm.284.189-.294.404.294-.404Zm.146.101-.26.427.006.004.254-.43Zm.05.03-.252.431.252-.432Zm.25.16-.304.396.303.233.305-.233L11 2.3Zm7.3 5.14.499.035.001-.018v-.018h-.5Zm-.79.76-.048.498.03.003.031-.001-.013-.5Zm.79-.88-.5-.01v.01h.5Zm-2.11-3.16.177-.467-.007-.003-.007-.003-.163.473Zm-1.01.5-.471-.168-.003.01.474.158Zm.5 1.03.175-.47-.008-.002-.167.471Zm1.07 1.6.498.042.002-.021v-.02h-.5Zm.12-6.474A6.342 6.342 0 0 0 14.85.5v1c.585 0 1.16.083 1.701.264l.318-.948Zm4.227 9.414c1.167-3.719-.205-8.106-4.232-9.415l-.31.95c3.355 1.091 4.643 4.804 3.588 8.165l.954.3Zm-3.132 5.013a13.227 13.227 0 0 0 3.127-4.998l-.944-.33a12.227 12.227 0 0 1-2.89 4.62l.707.708Zm-6.42 5.03a38.957 38.957 0 0 0 6.414-5.025l-.696-.718a37.96 37.96 0 0 1-6.249 4.896l.532.847Zm-.256.155.25-.15-.518-.857-.25.151.518.856Zm-.782-.164.26.161.526-.85-.26-.16-.526.85ZM4.054 15.24a38.59 38.59 0 0 0 6.452 5.025l.528-.85a37.594 37.594 0 0 1-6.286-4.895l-.694.72ZM.919 10.247a13.432 13.432 0 0 0 3.127 4.985l.71-.705A12.433 12.433 0 0 1 1.86 9.913l-.942.334ZM5.165.794C1.101 2.124-.275 6.509.914 10.232l.952-.304c-1.071-3.357.213-7.072 3.61-8.184l-.31-.95Zm.98-.23a5.02 5.02 0 0 0-.987.232l.326.946c.258-.09.524-.151.79-.186L6.146.564ZM6.33.56h-.12v1h.12v-1ZM7.17.5c-.303 0-.606.02-.912.065l.144.99c.256-.037.51-.055.768-.055v-1Zm.11 0h-.11v1h.11v-1Zm1.992.357A6.737 6.737 0 0 0 7.295.5l-.03 1c.58.017 1.141.119 1.685.304l.322-.947ZM9.17.83h-.059v1h.059v-1Zm.434.197a.846.846 0 0 0-.22-.148l-.429.903-.01-.006a.223.223 0 0 1-.03-.024l.69-.725Zm.527.185a4.02 4.02 0 0 0-.718-.299l-.306.952c.205.066.381.135.542.223l.482-.876Zm.343.152-.38-.17-.408.913.38.17.408-.913Zm.374.24c-.081-.059-.214-.156-.343-.225l-.47.882c.055.03.128.082.225.152l.588-.809Zm.112.08a2.26 2.26 0 0 1-.112-.08l-.588.81c.05.035.12.086.18.123l.52-.854Zm.042.023-.048-.027-.508.86.052.031.504-.864Zm.302.195c-.105-.08-.223-.148-.302-.195l-.504.864c.091.054.152.09.198.125l.608-.794ZM14.854.5a6.763 6.763 0 0 0-4.158 1.402l.608.794A5.763 5.763 0 0 1 14.846 1.5l.008-1ZM17.8 7.404a.323.323 0 0 1-.304.296l.026 1A1.322 1.322 0 0 0 18.8 7.475l-.998-.071ZM17.8 7.32v.12h1v-.12h-1Zm-1.787-2.692A2.8 2.8 0 0 1 17.8 7.309l1 .022a3.8 3.8 0 0 0-2.433-3.638l-.354.935Zm-.362.2a.301.301 0 0 1 .376-.195l.326-.946a1.3 1.3 0 0 0-1.644.805l.942.336Zm.196.39a.318.318 0 0 1-.193-.4l-.948-.316a1.318 1.318 0 0 0 .807 1.658l.334-.942Zm1.403 2.041c0-.9-.552-1.723-1.395-2.038l-.35.936c.44.165.745.605.745 1.102h1Zm0 .031v-.03h-1v.03h1Zm.076.302a.36.36 0 0 1-.078-.26l-.996-.083c-.03.355.077.706.302.979l.772-.636Zm.232.11a.34.34 0 0 1-.232-.11l-.772.636c.236.287.576.438.909.47l.095-.996Z" fill="#fff"/></svg>--}}
{{--          </div>--}}
{{--          <div>--}}
{{--            <div class="avatar chatify-d-flex h-[20px] w-[20px] items-start" style="background-image: url('http://localhost/storage/users-avatar/http://localhost/storage/users-avatar/avatar.png');">--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}

{{--    </div>--}}
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
