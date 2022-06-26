<template>
   <div class="max-w-4xl mx-auto  ">
  <div class="grid grid-cols-3 bg-black py-5 px-5 gap-24 place-content-center">
    <div class="flex items-center">
      <input type="text" placeholder="🔍 Search" class="bg-transparent px-3 rounded-lg py-1 bg-gray-800 placeholder:text-gray-600">
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
  <div class="grid grid-cols-6 p-5 gap-5">
      <div class="bg-blue-600 rounded-lg h-40"><img src="https://images.pexels.com/photos/1391498/pexels-photo-1391498.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt=""></div>
      <div class="bg-blue-400 "><img src="https://images.pexels.com/photos/2811501/pexels-photo-2811501.jpeg" alt=""></div>
      <div class="bg-blue-300"><img src="https://images.pexels.com/photos/1308885/pexels-photo-1308885.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt=""></div>
      <div class="bg-blue-200"><img src="https://images.pexels.com/photos/1321909/pexels-photo-1321909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt=""></div>
      <div class="bg-blue-100"><img src="" alt=""><img src="https://images.pexels.com/photos/1187822/pexels-photo-1187822.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt=""></div>
      <div class="bg-blue-600"><img src="https://images.pexels.com/photos/139829/pexels-photo-139829.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt=""></div>
  </div>
  <div class="grid grid-cols-6 px-5 mt-10 text-gray-200">
    <div class=" rounded-full w-24 h-24 mx-auto overflow-hidden"><img src="https://i1.sndcdn.com/avatars-000021591077-eandvo-t500x500.jpg" alt=""></div>
    <div class=" col-span-4 flex flex-col justify-center px-1 ">
      <p>Kathryn Murphy</p>
      <p>Art</p>
    </div>
    <dir class="">
      <p class="text-xl justify-center">...</p>
    </dir>
  </div>
  <div class="grid grid-cols-6 pl-5 pr-20 p-5">
    <dir></dir>
    <div class="bg-blue-300 col-span-5 overflow-hidden  rounded-3xl glow">
      <img src="https://images.pexels.com/photos/2811501/pexels-photo-2811501.jpeg" alt="" class="w-full ">
    </div>
    
  </div>
</div>
</template>
<script>
export default {
    props: {
        text: {
            type: String,
            default: "Button"
        },
        hasIcon: {
            type: Boolean,
            default: false
        }
    },
    setup() {
        
    },
}
</script>